<?php

defined('ABSPATH') or die('No script kiddies please!!');
if (!class_exists('FPSM_Frontend_Hooks')) {

    class FPSM_Frontend_Hooks {

        function __construct() {
            add_action('wp_footer', array($this, 'append_extra_html'));
            add_action('the_content', array($this, 'append_custom_fields_before'), 10);
            add_action('the_content', array($this, 'append_custom_fields_after'), 11);
            add_action('template_redirect', array($this, 'generate_form_preview'));
        }

        function append_extra_html() {
            include(FPSM_PATH . '/includes/views/frontend/wp_footer.php');
        }

        function append_custom_fields_before($content) {
            $append_content = '';
            $display_position_check = 'before_content';
            include(FPSM_PATH . '/includes/cores/post-content-append.php');
            $content = $append_content . $content;
            return $content;
        }

        function append_custom_fields_after($content) {
            $append_content = '';
            $display_position_check = 'after_content';
            include(FPSM_PATH . '/includes/cores/post-content-append.php');
            $content = $content . $append_content;
            return $content;
        }

        function generate_form_preview() {
            if (is_user_logged_in() && !empty($_GET['fpsm_form_preview']) && !empty($_GET['fpsm_form_alias']) && wp_verify_nonce($_GET['_wpnonce'], 'fpsm_preview_nonce')) {
                include(FPSM_PATH . '/includes/views/frontend/frontend-preview-template.php');
                die();
            }
        }

    }

    new FPSM_Frontend_Hooks();
}
