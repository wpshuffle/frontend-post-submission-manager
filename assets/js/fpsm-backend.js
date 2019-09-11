jQuery(document).ready(function($){
     "use strict";
     
     /**
     * Generates required notice
     *
     * @param {string} info_text
     * @param {string} info_type
     *
     */
    function fpsm_generate_info(info_text, info_type) {
        clearTimeout(notice_timeout);
        switch (info_type) {
            case 'error':
                var info_html = '<p class="fpsm-error">' + info_text + '</p>';
                break;
            case 'info':
                var info_html = '<p class="fpsm-info">' + info_text + '</p>';
                break;
            case 'ajax':
                var info_html = '<p class="fpsm-ajax"><img src="' + fpsm_backend_obj.plugin_url + 'images/ajax-loader.gif" class="fpsm-ajax-loader"/>' + info_text + '</p>';
            default:
                break;

        }
        $('.fpsm-form-message').html(info_html).show();
        if (info_type != 'ajax') {
            notice_timeout = setTimeout(function () {
                $('.fpsm-form-message').slideUp(1000);
            }, 5000);
        }

    }
    
    /**
     * Performs clipboard copy action
     * 
     * @param {object} element
     * @returns null
     */
    function fpsm_copyToClipboard(element) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).text()).select();
        document.execCommand("copy");
        $temp.remove();
    }

    function fpsm_title_to_alias(str) {
        str = str.replace(/^\s+|\s+$/g, ''); // trim
        str = str.toLowerCase();

        // remove accents, swap ñ for n, etc
        var from = "àáäâèéëêìíïîòóöôùúüûñç·/,:;";
        var to = "aaaaeeeeiiiioooouuuunc------";
        for (var i = 0, l = from.length; i < l; i++) {
            str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
        }

        str = str.replace(/[^a-z0-9 _]/g, '') // remove invalid chars
                .replace(/\s+/g, '_') // collapse whitespace and replace by _
                .replace(/_+/g, '_'); // collapse dashes

        return str;
    }
     
     $('body').on('submit','.fpsm-form',function(e){
        e.preventDefault();
        var form_data = $(this).serialize();
        $.ajax({
            
        });
        
     });
});