<?php

defined('ABSPATH') or die('No script kiddies please!!');
if ($this->admin_ajax_nonce_verify()) {
    $form_data = $_POST['form_data'];
    $form_data = stripslashes_deep($form_data);
    parse_str($form_data, $form_data);
    global $fpsm_library_obj;
    $form_data = $fpsm_library_obj->sanitize_array($form_data, array('post_content' => 'html'));
    $form_alias = $form_data['form_alias'];
    $form_row = $fpsm_library_obj->get_form_row_by_alias($form_alias);
    if (empty($form_row)) {
        die(esc_html__('No form found for this alias.', 'frontend-post-submission-manager'));
    }
    $form_details = maybe_unserialize($form_row->form_details);
    //  $fpsm_library_obj->print_array($form_details);
    $form_fields = $form_details['form']['fields'];
    $error_flag = 0;
    $error_details = array();
    $response = array();
    if (!empty($form_fields)) {
        $taxonomy_lists = array();
        $custom_field_lists = array();
        foreach ($form_fields as $field_key => $field_details) {
            if ($fpsm_library_obj->is_taxonomy_key($field_key)) {
                $taxonomy_lists[] = $field_key;
            }
            // if field is enabled in backend
            if (!empty($field_details['show_on_form'])) {
                $required_message = (!empty($field_details['required_error_message'])) ? esc_html__($field_details['required_error_message']) : esc_html__('This field is requied', 'frontend-post-submission-manager');
                // if the field is required
                if (!empty($field_details['required']) && empty($form_data[$field_key])) {
                    $error_flag = 1;
                    $error_details[$field_key] = $required_message;
                } else {
                    // Other validations are done here
                    $field_recog_key = $field_key;
                    if ($fpsm_library_obj->is_custom_field_key($field_key)) {
                        $field_recog_key = 'custom_field';
                    }
                    switch ($field_key) {
                        case 'post_title':
                        case 'post_content':
                        case 'post_excerpt':
                            if (!empty($field_details['character_limit'])) {
                                $field_value_length = strlen(sanitize_text_field($form_data[$field_key]));
                                if ($field_value_length > $field_value_length) {
                                    $character_limit_error_message = (!empty($field_details['character_limit_error_message'])) ? esc_html__($field_details['character_limit_error_message']) : esc_html__(sprintf('Max characters allowed is %d', $field_details['character_limit']), 'frontend-post-submission-manager');
                                    $error_flag = 1;
                                    $error_details[$field_key] = $character_limit_error_message;
                                }
                            }
                            break;
                        case 'custom_field':
                            $custom_field_lists[] = $field_key;
                            break;
                    }
                }
            }
        }
        if ($error_flag == 1) {
            $response['status'] = 403;
            $response['error_details'] = $error_details;
            $response['message'] = (!empty($form_details['validation_error_message'])) ? esc_html($form_details['validation_error_message']) : esc_html__('Form validation error occurred.', 'frontend-post-submission-manager');
        } else {
            //Lets process the form
            $post_id = (!empty($form_data['post_id'])) ? intval($form_data['post_id']) : 0;
            $post_title = (!empty($form_data['post_title'])) ? $form_data['post_title'] : '';
            $post_content = (!empty($form_data['post_content'])) ? $form_data['post_content'] : '';
            $post_type = $form_row->post_type;
            $post_excerpt = (!empty($form_data['post_excerpt'])) ? $form_data['post_excerpt'] : '';
            $post_status = $form_details['basic']['post_status'];
            if ($form_row->form_type == 'login_require') {
                //if the form is login require form and user is logged in
                if (is_user_logged_in()) {
                    $post_author_id = get_current_user_id();
                } else {
                    // if  the form is login require form but users are not logged in
                    $response['status'] = 403;
                    $response['message'] = esc_html__('Invalid form submission', 'frontend-post-submission-manager');
                    die(json_encode($response));
                }
            } else {
                $post_author_id = $form_details['basic']['post_author'];
            }
            // Lets insert post into DB
            $postarr = array(
                'ID' => $post_id,
                'post_author' => $post_author_id,
                'post_content' => $post_content,
                'post_title' => $post_title,
                'post_excerpt' => $post_excerpt,
                'post_status' => $post_status
            );
            /**
             * Filters the post array before inserting the post into db
             *
             * @param array $postarr
             * @param array $form_data
             * @param obj $form_row
             *
             * @since 1.0.0
             */
            $postarr = apply_filters('fpsm_insert_postdata', $postarr, $form_data, $form_row);
            $insert_update_post_id = wp_insert_post($postarr);
            if (!empty($insert_update_post_id)) {
                // Lets assign taxonomy terms
                if (!empty($taxonomy_lists)) {
                    foreach ($taxonomy_lists as $taxonomy_key) {
                        $taxonomy_settings = $form_details['form']['fields'][$taxonomy_key];
                        // If taxonomy is enabled in the form
                        if (!empty($taxonomy_settings['show_on_form'])) {
                            $taxonomy_array = explode('|', $taxonomy_key);
                            $taxonomy_name = end($taxonomy_array);
                            if (is_array($form_data[$taxonomy_key])) {
                                $post_assign_terms = implode(',', $form_data[$taxonomy_key]);
                            } else {
                                $post_assign_terms = $form_data[$taxonomy_key];
                            }
                            wp_set_post_terms($insert_update_post_id, $post_assign_terms);
                        }

                        // If explicit auto assign of the terms is enabled
                        if (!empty($taxonomy_settings['auto_assign'])) {
                            $auto_assign_terms = implode(',', $taxonomy_settings['auto_assign']);
                            wp_set_post_terms($insert_update_post_id, $auto_assign_terms, true);
                        }
                    }
                    $response['status'] = 200;
                    $response['message'] = (!empty($form_details['form_success_message'])) ? esc_html($form_details['form_success_message']) : esc_html__('Form submission successful.', 'frontend-post-submission-manager');
                    // If redirection is enabled
                    if (!empty($form_details['basic']['redirection'])) {
                        if ($form_details['basic']['redirection_type'] == 'url') {
                            if (!empty($form_details['basic']['redirection_url'])) {
                                $response['redirect_url'] = esc_url($form_details['basic']['redirection_url']);
                            }
                        } else {
                            $post_url = get_the_permalink($insert_update_post_id);
                            $response['redirect_url'] = $post_url;
                        }
                    }
                } else {
                    $response['status'] = 403;
                    $response['message'] = esc_html__('There occurred some error.', 'frontend-post-submission-manager');
                }
            }
        }
    } else {
        $response['status'] = 403;
        $response['message'] = esc_html__('Invalid form submission', 'frontend-post-submission-manager');
    }
    /**
     * Filters the form process response array
     *
     * @param array $response
     * @param array $form_data
     * @param obj $form_row
     *
     * @since 1.0.0
     */
    $response = apply_filters('fpsm_form_response', $response, $form_data, $form_row);
    echo json_encode($response);
    die();
} else {
    $this->permission_denied();
}