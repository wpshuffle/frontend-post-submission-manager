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
                    if ($fpsm_library_obj->is_taxonomy_key($field_key)) {
                        $field_recog_key = 'taxonomy';
                    } else if ($fpsm_library_obj->is_custom_field_key($field_key)) {
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
                        case 'taxonomy':
                            $taxonomy_lists[] = $field_key;
                            break;
                        case 'custom_field':
                            $custom_field_lists[] = $field_key;
                            break;
                    }
                }
            }
        }
    }
    if ($error_flag == 1) {
        $response['status'] = 403;
        $response['error_details'] = $error_details;
        $response['message'] = (!empty($form_details['validation_error_message'])) ? esc_html($form_details['validation_error_message']) : esc_html__('Form validation error occurred.', 'frontend-post-submission-manager');
    } else {
        $response['status'] = 200;
        $response['message'] = (!empty($form_details['form_success_message'])) ? esc_html($form_details['form_success_message']) : esc_html__('Form submission successful.', 'frontend-post-submission-manager');
    }
    echo json_encode($response);
    die();
} else {
    $this->permission_denied();
}