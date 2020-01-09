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
    $fpsm_library_obj->print_array($form_details);
    $form_fields = $form_details['form']['fields'];
    $error_flag = 0;
    $error_details = array();
    $response = array();
    if (!empty($form_fields)) {
        foreach ($form_details as $field_key => $field_details) {
            $required_message = (!empty($field_details['required_error_message'])) ? esc_html__($field_details['required_error_message']) : esc_html__('This field is requied', 'frontend-post-submission-manager');
            if (!empty($field_details['required']) && empty($form_data[$field_key])) {
                $error_flag = 1;
                $error_details[$field_key] = $required_message;
            } else {
                switch ($field_key) {
                    case 'post_title':

                        break;
                }
            }
        }
    }
    die();
} else {
    $this->permission_denied();
}