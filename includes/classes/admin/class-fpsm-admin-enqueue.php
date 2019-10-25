<?php

defined('ABSPATH') or die('No script kiddies please!!');
if (!class_exists('FPSM_Admin_Enqueue')) {

    class FPSM_Admin_Enqueue {

        function __construct() {
            add_action('admin_enqueue_scripts', array($this, 'register_backend_assets'));
        }

        function register_backend_assets() {
            $translation_strings = array(
                'ajax_message' => esc_html__('Please wait', 'frontend-post-submission-manager'),
                'upload_button_text' => esc_html__('Upload File', 'frontend-post-submission-manager'),
                'delete_form_confirm' => esc_html__('Are you sure you want to delete this form?', 'frontend-post-submission-manager'),
                'copy_form_confirm' => esc_html__('Are you sure you want to copy this form?', 'frontend-post-submission-manager'),
                'clipboad_copy_message' => esc_html__('Shortcode copied to clipboard.', 'frontend-post-submission-manager'),
                'custom_field_error' => esc_html__('Label and Meta key both are required', 'frontend-post-submission-manager'),
                'custom_field_delete_confirm' => esc_html__('Are you sure you want to delete this custom field?', 'frontend-post-submission-manager'),
            );
            $js_obj = array('ajax_url' => admin_url('admin-ajax.php'), 'plugin_url' => FPSM_URL, 'ajax_nonce' => wp_create_nonce('fpsm_backend_ajax_nonce'), 'translation_strings' => $translation_strings);
            wp_enqueue_style('fpsm-backend-style', FPSM_URL . '/assets/css/fpsm-backend-style.css', array(), FPSM_VERSION);
            wp_enqueue_style('fontawesome', FPSM_URL . '/assets/fontawesome/css/all.min.css', array(), FPSM_VERSION);
            wp_enqueue_script('fpsm-backend-script', FPSM_URL . '/assets/js/fpsm-backend.js', array('jquery', 'wp-util'), FPSM_VERSION);
            wp_localize_script('fpsm-backend-script', 'fpsm_backend_obj', $js_obj);
        }

    }

    new FPSM_Admin_Enqueue();
}