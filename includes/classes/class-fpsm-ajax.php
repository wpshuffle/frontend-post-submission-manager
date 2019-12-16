<?php

defined('ABSPATH') or die('No script kiddies please!!');
if (!class_exists('FPSM_Ajax')) {

    class FPSM_Ajax {

        function __construct() {
            add_action('wp_ajax_fpsm_file_upload_action', array($this, 'file_upload_action'));
            add_action('wp_ajax_nopriv_fpsm_file_upload_action', array($this, 'file_upload_action'));
        }

        function file_upload_action() {
            if ($this->admin_ajax_nonce_verify()) {

                $form_alias = sanitize_text_field($_GET['form_alias']);
                $field_name = sanitize_text_field($_GET['field_name']);
                global $fpsm_library_obj;
                $form_row = $fpsm_library_obj->get_form_row_by_alias($form_alias);
                $form_details = maybe_unserialize($form_row->form_details);
                $field_details = $form_details['form']['fields'][$field_name];
                $default_allowed_extensions = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'BMP');
                /**
                 * Filters allowed extensions for image field type
                 *
                 * @param array $allowed_extensions
                 *
                 * @since 1.0.0
                 */
                $default_allowed_extensions = apply_filters('fpsm_image_allowed_extensions', $default_allowed_extensions);
                if ($field_name == 'post_image') {
                    $allowed_extensions = $default_allowed_extensions;
                } else {
                    $allowed_extensions = $field_details['file_extensions'];
                    if (!empty($allowed_extensions)) {
                        $allowed_extensions = implode('|', $allowed_extensions);
                        $allowed_extensions = explode('|', $allowed_extensions);
                    } else {
                        $allowed_extensions = $default_allowed_extensions;
                    }
                }
                $upload_file_size_limit = (!empty($field_details['upload_file_size_limit'])) ? $field_details['upload_file_size_limit'] * 1000 * 1000 : 5 * 1000 * 1000;
                $uploader = new FPSM_qqFileUploaders($allowed_extensions, $upload_file_size_limit);
                $upload_dir = wp_upload_dir();

                $upload_path = $upload_dir['path'] . '/';
                $upload_url = $upload_dir['url'];

                $result = $uploader->handleUpload($upload_path, $replaceOldFile = false, $upload_url);

                echo json_encode($result);
                die();
            } else {
                $this->permission_denied();
            }
        }

        /**
         * Ajax nonce verification for ajax in admin
         *
         * @return bolean
         * @since 1.0.0
         */
        function admin_ajax_nonce_verify() {
            if (!empty($_REQUEST['_wpnonce']) && wp_verify_nonce($_REQUEST['_wpnonce'], 'fpsm_ajax_nonce')) {
                return true;
            } else {
                return false;
            }
        }

        function permission_denied() {
            die('No script kiddies please!!');
        }

    }

    new FPSM_Ajax();
}