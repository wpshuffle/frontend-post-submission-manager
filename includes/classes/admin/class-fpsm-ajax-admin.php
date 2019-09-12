<?php

defined('ABSPATH') or die('No script kiddies please!!');
if (!class_exists('FPSM_Ajax_Admin')) {

    class FPSM_Ajax_Admin {

        function __construct() {
            add_action('wp_ajax_fpsm_form_add_action', array($this, 'process_form_add'));
            add_action('wp_ajax_nopriv_fpsm_form_add_action', array($this, 'permission_denied'));
        }

        function process_form_add() {
            if ($this->admin_ajax_nonce_verify()) {
                $_POST = stripslashes_deep($_POST);
                $form_data = $_POST['form_data'];
                parse_str($form_data, $form_data);
                global $fpsm_library_obj;
                //$fpsm_library_obj->print_array($form_data);
                $form_data = $fpsm_library_obj->sanitize_array($form_data);
                $form_title = $form_data['form_title'];
                $form_alias = $form_data['form_alias'];
                $post_type = $form_data['post_type'];
                $form_type = $form_data['form_type'];
                $form_status = (!empty($form_data['form_status'])) ? 1 : 0;
                if (empty($form_title) || empty($form_alias)) {
                    $response['status'] = 403;
                    $response['message'] = esc_html__('Form title or Alias cannot be empty.', 'frontend-post-submission-manager');
                } else {
                    if ($fpsm_library_obj->is_alias_available($form_alias)) {
                        global $wpdb;

                        $insert_check = $wpdb->insert(FPSM_FORM_TABLE, array('form_title' => $form_title,
                            'form_alias' => $form_alias,
                            'form_details' => '',
                            'form_status' => $form_status,
                            'form_type' => $form_type,
                            'post_type' => $post_type
                                ), array('%s', '%s', '%s', '%d', '%s', '%s')
                        );
                        if ($insert_check) {
                            $form_id = $wpdb->insert_id;
                            $response['status'] = 200;
                            $response['message'] = esc_html__('Form added successfully. Redirecting...', 'frontend-post-submission-manager');
                            $response['redirect_url'] = admin_url('admin.php?page=fpsm&action=edit_form&form_id=' . $form_id);
                        } else {
                            $response['status'] = 403;
                            $response['message'] = esc_html__('Something went wrong. Please try again later.', 'frontend-post-submission-manager');
                        }
                    } else {
                        $response['status'] = 403;
                        $response['message'] = esc_html__('Form alias already used. Please use some other alias.', 'frontend-post-submission-manager');
                    }
                }
                die(json_encode($response));
            } else {
                $this->permission_denied();
            }
        }

        function permission_denied() {
            die('No script kiddies please!!');
        }

        /**
         * Ajax nonce verification for ajax in admin
         *
         * @return bolean
         * @since 1.0.0
         */
        function admin_ajax_nonce_verify() {
            if (!empty($_POST['_wpnonce']) && wp_verify_nonce($_POST['_wpnonce'], 'fpsm_backend_ajax_nonce')) {
                return true;
            } else {
                return false;
            }
        }

    }

    new FPSM_Ajax_Admin();
}