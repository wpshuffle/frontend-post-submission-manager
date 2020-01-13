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
                    selector.closest('.fpsm-field-wrap').find('.fpsm-error').html('');
                    if (multiple_upload == true && upload_limit != -1) {
                        var upload_count = selector.parent().find('.fpsm-upload-count').val();
                        var current_upload_count = upload_count;
                        upload_count++;
                        selector.closest('.fpsm-field').find('.fpsm-upload-count').val(upload_count);
                        if (upload_count > upload_limit) {
                            upload_limit_message = (upload_limit_message) ? upload_limit_message : 'Maximum number of files allowed is ' + upload_limit;
                            console.log(upload_limit_message);
                            selector.closest('.fpsm-field-wrap').find('.fpsm-error').html(upload_limit_message);
                            selector.closest('.fpsm-field').find('.fpsm-upload-count').val(current_upload_count);
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
                            var media_id = selector.closest('.fpsm-field').find('.fpsm-media-id').val();
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
                    var upload_count = selector.closest('.fpsm-field').find('.fpsm-upload-count').val();
                    upload_count--;
                    selector.closest('.fpsm-field').find('.fpsm-upload-count').val(upload_count);
                    selector.closest('.fpsm-file-preview-row').remove();
                } else {
                    alert(res.message);
                }
            }
        });
    });

    $('.fpsm-auto-complete-field').each(function () {
        var available_tags = $(this).next('.fpsm-available-tags').val();
        available_tags = available_tags.split(',');
        $(this).autocomplete({
            source: available_tags
        });
    });

    $('body').on('keyup', '.fpsm-auto-complete-field', function (event) {
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode == '13') {
            var tag = $(this).val();
            if(tag == ''){
                return;
            }
            var added_tags = $(this).parent().find('.fpsm-auto-complete-values').val();
            if(added_tags == ''){
                added_tags = [];
            }else{
                added_tags = added_tags.split(',');
            }
            
            if (added_tags.indexOf(tag) == -1) {
                added_tags.push(tag);
                added_tags = added_tags.join(',');
                $(this).parent().find('.fpsm-auto-complete-values').val(added_tags);
                var tag_html = '<div class="fpsm-each-tag"><span class="fpsm-tag-text">' + tag + '</span><span class="fpsm-tag-remove-trigger"><i class="fas fa-times-circle"></i></span></div>';
                $(this).parent().find('.fpsm-auto-complete-tags').append(tag_html);
                $(this).val('');
                $(".ui-autocomplete").hide();
            }
        }
    });

    $('body').on('click', '.fpsm-tag-remove-trigger', function () {
        var tag = $(this).parent().find('.fpsm-tag-text').html();
        var added_tags = $(this).closest('.fpsm-field').find('.fpsm-auto-complete-values').val();
        added_tags = added_tags.split(',');
        var tag_index = added_tags.indexOf(tag)
        added_tags.splice(tag_index, 1)
        added_tags = added_tags.join(',');
        $(this).closest('.fpsm-field').find('.fpsm-auto-complete-values').val(added_tags);
        $(this).closest('.fpsm-each-tag').remove();

    });
    
    $('body').on('submit','.fpsm-front-form',function(e){
        e.preventDefault();
        var selector = $(this);
        var form_data = selector.serialize();
        $.ajax({
           type:'post',
           url:fpsm_js_obj.ajax_url,
           data:{
               action:'fpsm_form_process',
               form_data:form_data,
               _wpnonce:fpsm_js_obj.ajax_nonce
           },
            beforeSend: function (xhr) {
                selector.find('.fpsm-ajax-loader').show();
            },
            success: function (data, textStatus, jqXHR) {
                 selector.find('.fpsm-ajax-loader').hide();
                data = $.parseJSON(data);
                if(data.status == 200){
                    
                }else{
                    
                }
            }
        });
    });
    initialize_uploaders();

    $('.fpsm-each-term-checkbox label').on('click', function () {
       $(this).toggleClass('checked');
    });
    
    $('.fpsm-front-datepicker').each(function(){
       var date_format = $(this).data('date-format');
       $(this).datepicker({
           dateFormat:date_format
       });
    });
});