var file_uploader_fields = {};

jQuery(document).ready(function ($) {
    function initialize_uploaders() {
        $('.fpsm-file-uploader').each(function () {
            var form_alias = $(this).closest('form').data('alias');
            var selector = $(this);
            var attr_element_id = $(this).attr('id');
            var arr_element_id = attr_element_id.split('-');
            var uploader_name = arr_element_id[2];
            var extensions = $(this).data('extensions');
            var extensions_array = extensions.split('|');
            var sizeLimit = $(this).data('file-size-limit');
            sizeLimit = parseInt(sizeLimit) * 1000 * 1000;
            var multiple_upload = $(this).data('multiple');
            var limit_flag = 0;
            var upload_limit = $(this).data('multiple-upload-limit');
            var uploader_label = $(this).data('upload-label');
            var upload_limit_message = $(this).data('multiple-upload-error-message');
            var extension_error_message = $(this).data('extension-error-message')
            var field_name = $(this).data('field-name');
            file_uploader_fields[uploader_name] = new qq.FileUploader({
                element: document.getElementById(attr_element_id),
                action: fpsm_js_obj.ajax_url,
                params: {
                    action: 'fpsm_file_upload_action',
                    _wpnonce: fpsm_js_obj.ajax_nonce,
                    form_alias: form_alias,
                    field_name: field_name

                },
                debug: true,
                allowedExtensions: extensions_array,
                sizeLimit: sizeLimit,
                minSizeLimit: 50,
                uploadButtonText: $(this).data('label'),
                onSubmit: function (id, fileName) {
                    selector.closest('.fpsm-field').find('.fpsm-error').html('');
                    if (multiple_upload == true && upload_limit != -1) {
                        var limit_counter = selector.parent().find('.fpsm-multiple-upload-limit').val();
                        limit_counter++;
                        selector.parent().find('.fpsm-multiple-upload-limit').val(limit_counter);
                        if (limit_counter > upload_limit) {
                            upload_limit_message = (upload_limit_message != '') ? upload_limit_message : 'Maximum number of files allowed is ' + upload_limit;
                            var test = selector.closest('.fpsm-field').find('.fpsm-error').html(upload_limit_message);
                            selector.parent().find('.fpsm-multiple-upload-limit').val(upload_limit);
                            return false;
                        }
                    }
                },
                onProgress: function (id, fileName, loaded, total) {},
                onComplete: function (id, fileName, responseJSON) {

                    if (responseJSON.success) {
                        var data = {media_url: responseJSON.media_url, media_id: responseJSON.media_id, media_name: responseJSON.media_name, media_key: responseJSON.media_key}
                        var file_preview_template = wp.template('upload-preview');
                        if (multiple_upload) {
                            var media_id = selector.next('.fpsm-media-id').val();
                            var media_id_array = media_id.split(',');
                            media_id_array.push(responseJSON.media_id);
                            var media_id = media_id_array.join(',');
                            selector.next('.fpsm-media-id').val(media_id);
                            selector.closest('.fpsm-field').find('.fpsm-file-preview-wrap').append(file_preview_template(responseJSON));
                        } else {
                            selector.next('.fpsm-media-id').val(responseJSON.media_id);
                            selector.closest('.fpsm-field').find('.fpsm-file-preview-wrap').html(file_preview_template(responseJSON));
                        }

                    } else {

                        console.log(responseJSON);
                    }


                },
                onCancel: function (id, fileName) {},
                onError: function (id, fileName, xhr) {},
                messages: {
                    typeError: extension_error_message,
                    sizeError: "{file} is too large, maximum file size is {sizeLimit}.",
                    minSizeError: "{file} is too small, minimum file size is {minSizeLimit}.",
                    emptyError: "{file} is empty, please select files again without it.",
                    onLeave: "The files are being uploaded, if you leave now the upload will be cancelled."
                },
                showMessage: function (message) {
                    alert(message);
                },
                multiple: multiple_upload
            });
        });
    }

    $('body').on('click', '.fpsm-media-delete-button', function () {
        var selector = $(this);
        var media_id = $(this).data('media-id');
        var media_key = $(this).data('media-key');
        $.ajax({
            type: 'post',
            url: fpsm_js_obj.ajax_url,
            data: {
                _wpnonce: fpsm_js_obj.ajax_nonce,
                media_id: media_id,
                media_key: media_key,
                action: 'fpsm_media_delete_action'
            },
            success: function (res) {
                res = $.parseJSON(res);
                if (res.status == 200) {
                    selector.closest('.fpsm-file-preview-row').remove();
                } else {
                    alert(res.message);
                }
            }
        });
    });
    initialize_uploaders();
});