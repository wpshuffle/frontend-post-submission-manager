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
            var multiple_upload = ($(this).hasClass('fpsm-directory-gallery')) ? true : false;
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
                    form_alias:form_alias,
                    field_name:field_name

                },
                debug:true,
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
                        var extension_array = fileName.split('.');
                        var extension = extension_array.pop();
                        var preview_img = responseJSON.url;
                        var preview_html = '<div class="fpsm-pro-prev-holder"><span class="fpsm-prev-name">' + fileName + '</span><img src="' + preview_img + '" /><span class="fpsm-pro-preview-remove" data-url="' + responseJSON.url + '" data-id="' + element_id + '" data-attachment-id="' + responseJSON.attachment_id + '" data-attachment-code="' + responseJSON.attachment_code + '"><span class="lnr lnr-cross"></span></span></div>';
                        if (multiple_upload) {
                            var url = responseJSON.url;
                            var added_url = $('#' + attr_element_id).closest('.fpsm-each-frontend-field').find('.fpsm-uploaded-files').val();
                            if (added_url == '') {
                                added_url = responseJSON.attachment_id;
                            } else {
                                var added_url_array = added_url.split(',');
                                added_url_array.push(responseJSON.attachment_id);
                                added_url = added_url_array.join();
                            }
                            $('#' + attr_element_id).closest('.fpsm-each-frontend-field').find('.fpsm-uploaded-files').val(added_url);
                            $('#' + attr_element_id).closest('.fpsm-each-frontend-field').find('.fpsm-file-preview').append(preview_html);
                        } else {
                            $('#' + attr_element_id).closest('.fpsm-each-frontend-field').find('.fpsm-uploaded-files').val(responseJSON.attachment_id);
                            $('#' + attr_element_id).closest('.fpsm-each-frontend-field').find('.fpsm-file-preview').html(preview_html);
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
    initialize_uploaders();
});