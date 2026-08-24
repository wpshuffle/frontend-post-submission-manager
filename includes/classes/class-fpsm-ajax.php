<?php

defined('ABSPATH') or die('No script kiddies please!!');
if (!class_exists('FPSM_Ajax')) {

    class FPSM_Ajax {

        function __construct() {
            /**
             * Custom Media Upload
             */
            add_action('wp_ajax_fpsm_file_upload_action', array($this, 'file_upload_action'));
            add_action('wp_ajax_nopriv_fpsm_file_upload_action', array($this, 'file_upload_action'));

            /**
             * Custom Media Delete
             */
            add_action('wp_ajax_fpsm_media_delete_action', array($this, 'media_delete_action'));
            add_action('wp_ajax_nopriv_fpsm_media_delete_action', array($this, 'media_delete_action'));

            /**
             *  Ajax Form Submission
             */
            add_action('wp_ajax_fpsm_form_process', array($this, 'ajax_form_process'));
            add_action('wp_ajax_nopriv_fpsm_form_process', array($this, 'ajax_form_process'));

            /**
             * Post Delete
             */
            add_action('wp_ajax_fpsm_post_delete_action', array($this, 'process_post_delete'));
            add_action('wp_ajax_nopriv_fpsm_post_delete_action', array($this, 'permission_denied'));

            /**
             * PayPal capture
             */
            add_action('wp_ajax_fpsm_paypal_capture', array($this, 'process_paypal_capture'));
            add_action('wp_ajax_nopriv_fpsm_paypal_capture', array($this, 'process_paypal_capture'));
        }

        function file_upload_action() {
            if ($this->admin_ajax_nonce_verify()) {

                $form_alias = (!empty($_GET['form_alias'])) ? sanitize_text_field(wp_unslash($_GET['form_alias'])) : '';
                $field_name = (!empty($_GET['field_name'])) ? sanitize_text_field(wp_unslash($_GET['field_name'])) : '';
                if (empty($form_alias) || empty($field_name)) {
                    $this->upload_error_response(esc_html__('Invalid upload request.', 'frontend-post-submission-manager'));
                }
                global $fpsm_library_obj;
                $form_row = $fpsm_library_obj->get_form_row_by_alias($form_alias);
                if (empty($form_row)) {
                    $this->upload_error_response(esc_html__('Invalid upload request.', 'frontend-post-submission-manager'));
                }
                if ($form_row->form_type == 'login_require' && !is_user_logged_in()) {
                    $this->upload_error_response(esc_html__('Unauthorized upload request.', 'frontend-post-submission-manager'));
                }
                $form_details = maybe_unserialize($form_row->form_details);
                if (empty($form_details['form']['fields'][$field_name]) || empty($form_details['form']['fields'][$field_name]['show_on_form'])) {
                    $this->upload_error_response(esc_html__('Invalid upload field.', 'frontend-post-submission-manager'));
                }
                $field_details = $form_details['form']['fields'][$field_name];
                if (!$this->is_valid_upload_field($field_name, $field_details)) {
                    $this->upload_error_response(esc_html__('Invalid upload field.', 'frontend-post-submission-manager'));
                }
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

        function is_valid_upload_field($field_name, $field_details) {
            global $fpsm_library_obj;
            if ($field_name == 'post_image') {
                $uploader_type = (!empty($field_details['uploader_type'])) ? $field_details['uploader_type'] : 'custom';
                return ($uploader_type == 'custom');
            }
            if ($field_name == 'post_content') {
                return !empty($field_details['custom_media_upload_button']);
            }
            if ($fpsm_library_obj->is_custom_field_key($field_name)) {
                return (!empty($field_details['field_type']) && $field_details['field_type'] == 'file_uploader');
            }
            return false;
        }

        function upload_error_response($message, $status_code = 403) {
            status_header($status_code);
            echo wp_json_encode(array(
                'success' => false,
                'error' => $message
            ));
            die();
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

        function media_delete_action() {
            if ($this->admin_ajax_nonce_verify() && is_user_logged_in()) {
                $media_id = intval($_POST['media_id']);
                $current_user_id = get_current_user_id();
                $media_author_id = (int) get_post_field('post_author', $media_id);
                if (empty($media_author_id)) {
                    $response['status'] = 403;
                    $response['message'] = esc_html__('Unauthorized deletion of the media.', 'frontend-post-submission-manager-lite');
                    die(json_encode($response));
                }
                if ($media_author_id !== $current_user_id) {
                    $response['status'] = 403;
                    $response['messsage'] = esc_html__('Unauthorized access', 'frontend-post-submission-manager');
                } else {
                    $media_delete_check = wp_delete_attachment($media_id, true);
                    if ($media_delete_check) {
                        $response['status'] = 200;
                        $response['messsage'] = esc_html__('Media deleted successfully.', 'frontend-post-submission-manager');
                    } else {
                        $response['status'] = 403;
                        $response['messsage'] = esc_html__('Error occurred while deleting the media.', 'frontend-post-submission-manager');
                    }
                }
                die(json_encode($response));
            } else {
                $this->permission_denied();
            }
        }

        function ajax_form_process() {
            include(FPSM_PATH . '/includes/cores/ajax-process-form.php');
        }

        /**
         * Process post delete
         */
        function process_post_delete() {
            if ($this->admin_ajax_nonce_verify()) {
                $post_id = intval($_POST['post_id']);
                $delete_key = sanitize_text_field($_POST['delete_key']);
                $verify_delete_key = md5(get_the_date('d-m-y H:i a', $post_id));
                if ($delete_key != $verify_delete_key) {
                    $response['status'] = 403;
                    $response['message'] = esc_html__('Unauthorized delete from delete key', 'frontend-post-submission-manager');
                } else {
                    $current_user_id = get_current_user_id();
                    $user_meta = get_userdata($current_user_id);
                    $user_roles = $user_meta->roles;
                    $post_author_user_id = get_post_field('post_author', $post_id);
                    $delete_flag = ($current_user_id == $post_author_user_id || in_array('administrator', $user_roles)) ? true : false;
                    /**
                     * fpsm_delete_flag
                     * 
                     * Filters delete flag varaible 
                     * 
                     * @param boolean $delete_flag
                     * 
                     * @since 1.4.2
                     */
                    $delete_flag = apply_filters('fpsm_delete_flag', $delete_flag);
                    if (!$delete_flag) {
                        $response['status'] = 403;
                        $response['message'] = esc_html__('Unauthorized delete from user', 'frontend-post-submission-manager');
                    } else {
                        $delete_check = wp_trash_post($post_id);
                        if ($delete_check) {
                            $response['status'] = 200;
                            $response['message'] = esc_html__('Post delete successfully.', 'frontend-post-submission-manager');
                        } else {
                            $response['status'] = 403;
                            $response['message'] = esc_html__('There occurred some error.', 'frontend-post-submission-manager');
                        }
                    }
                }
                die(json_encode($response));
            } else {
                $this->permission_denied();
            }
        }

        /**
         * Capture PayPal payment and update post/payment records
         */
        function process_paypal_capture() {
            if ($this->admin_ajax_nonce_verify()) {
                $order_id = sanitize_text_field($_POST['order_id']);
                $post_id = intval($_POST['post_id']);
                if (empty($order_id) || empty($post_id)) {
                    wp_send_json(array('status' => 403, 'message' => esc_html__('Invalid payment request.', 'frontend-post-submission-manager')));
                }
                $form_alias = get_post_meta($post_id, '_fpsm_form_alias', true);
                if (empty($form_alias)) {
                    wp_send_json(array('status' => 403, 'message' => esc_html__('Form reference missing for this post.', 'frontend-post-submission-manager')));
                }
                global $fpsm_library_obj;
                global $fpsm_paypal_obj;
                $form_row = $fpsm_library_obj->get_form_row_by_alias($form_alias);
                if (empty($form_row)) {
                    wp_send_json(array('status' => 403, 'message' => esc_html__('Form not found for this post.', 'frontend-post-submission-manager')));
                }
                $capture = $fpsm_paypal_obj->capture_order($order_id);
                if (empty($capture['success'])) {
                    wp_send_json(array('status' => 403, 'message' => esc_html__('PayPal capture failed. Please try again.', 'frontend-post-submission-manager')));
                }
                $capture_data = $capture['data'];
                $status = (!empty($capture_data['status'])) ? $capture_data['status'] : '';
                if ($status !== 'COMPLETED') {
                    wp_send_json(array('status' => 403, 'message' => esc_html__('Payment not completed.', 'frontend-post-submission-manager')));
                }
                $purchase_unit = (!empty($capture_data['purchase_units'][0])) ? $capture_data['purchase_units'][0] : array();
                $payments = (!empty($purchase_unit['payments']['captures'][0])) ? $purchase_unit['payments']['captures'][0] : array();
                $capture_id = (!empty($payments['id'])) ? $payments['id'] : '';
                $payer = (!empty($capture_data['payer'])) ? $capture_data['payer'] : array();
                $payer_email = (!empty($payer['email_address'])) ? $payer['email_address'] : '';
                $payer_id = (!empty($payer['payer_id'])) ? $payer['payer_id'] : '';
                $amount = (!empty($payments['amount']['value'])) ? $payments['amount']['value'] : '';
                $currency = (!empty($payments['amount']['currency_code'])) ? $payments['amount']['currency_code'] : '';
                $meta = wp_json_encode($capture_data);
                $fpsm_paypal_obj->upsert_payment(array(
                    'post_id' => $post_id,
                    'form_alias' => $form_alias,
                    'amount' => $amount,
                    'currency' => $currency,
                    'status' => 'completed',
                    'paypal_order_id' => $order_id,
                    'paypal_capture_id' => $capture_id,
                    'payer_email' => $payer_email,
                    'payer_id' => $payer_id,
                    'meta' => $meta
                ));
                update_post_meta($post_id, '_fpsm_payment_status', 'completed');
                update_post_meta($post_id, '_fpsm_payment_capture_id', $capture_id);
                $form_details = maybe_unserialize($form_row->form_details);
                $stored_payment_status = get_post_meta($post_id, '_fpsm_payment_post_status', true);
                $post_payment_status = (!empty($stored_payment_status)) ? $stored_payment_status : ((!empty($form_details['payment']['post_payment_status'])) ? $form_details['payment']['post_payment_status'] : get_post_status($post_id));
                $current_status = get_post_status($post_id);
                if ($post_payment_status != $current_status) {
                    wp_update_post(array(
                        'ID' => $post_id,
                        'post_status' => $post_payment_status
                    ));
                }
                // Trigger default success hooks/notifications now that payment is complete
                $origin_action = get_post_meta($post_id, '_fpsm_payment_origin_action', true);
                $action = (!empty($origin_action)) ? $origin_action : 'insert';
                do_action('fpsm_form_submission_success', $post_id, $form_row, $action);

                $response = array(
                    'status' => 200,
                    'message' => esc_html__('Payment completed successfully.', 'frontend-post-submission-manager')
                );
                // Reuse success redirection if configured
                if (!empty($form_details['basic']['redirection'])) {
                    if ($form_details['basic']['redirection_type'] == 'url' && !empty($form_details['basic']['redirection_url'])) {
                        $response['redirect_url'] = esc_url($form_details['basic']['redirection_url']);
                    } else {
                        $response['redirect_url'] = get_the_permalink($post_id);
                    }
                }
                wp_send_json($response);
            } else {
                $this->permission_denied();
            }
        }
    }

    new FPSM_Ajax();
}
