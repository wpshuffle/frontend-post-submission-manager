<?php
$field_key_array = explode('|', $field_key);
$meta_key = end($field_key_array);
//$fpsm_library_obj->print_array($field_details);
$field_label = (!empty($field_details['field_label'])) ? $field_details['field_label'] : esc_html__('Untitled Field', 'frontend-post-submission-manager');
$show_hide_toggle_class = $meta_key;
$field_type = $field_details['field_type'];
$custom_field_type_list = array(
    'textfield' => esc_html__('Texfield', 'frontend-post-submission-manager'),
    'textarea' => esc_html__('Textarea', 'frontend-post-submission-manager'),
    'select' => esc_html__('Select Dropdown', 'frontend-post-submission-manager'),
    'checkbox' => esc_html__('Checkbox', 'frontend-post-submission-manager'),
    'radio' => esc_html__('Radio Button', 'frontend-post-submission-manager'),
    'number' => esc_html__('Number', 'frontend-post-submission-manager'),
    'email' => esc_html__('Email', 'frontend-post-submission-manager'),
    'datepicker' => esc_html__('Datepicker', 'frontend-post-submission-manager'),
    'file_uploader' => esc_html__('File Uploader', 'frontend-post-submission-manager'),
);
/**
 * Filters custom field type list
 *
 * @param array $custom_field_type_list
 *
 * @since 1.0.0
 */
$custom_field_type_list = apply_filters('fpsm_custom_field_type_list', $custom_field_type_list);
?>
<div class="fpsm-each-form-field" data-meta-key="<?php echo esc_attr($meta_key) ?>">
    <div class="fpsm-field-head fpsm-clearfix">
        <h3 class="fpsm-field-title"><span class="dashicons dashicons-arrow-down"></span><?php echo esc_html($field_label); ?><span class="fpsm-field-type-label"> - <?php echo esc_html($custom_field_type_list[$field_type]); ?></span></h3>
        <a href="javascript:void(0);" class="fpsm-field-remove-trigger"><span class="dashicons dashicons-trash"></span></a>
    </div>
    <div class="fpsm-field-body fpsm-display-none">
        <input type="hidden" name="<?php echo esc_attr($field_name_prefix); ?>[field_type]" value="<?php echo esc_attr($field_type); ?>"/>
        <?php
        if (file_exists(FPSM_PATH . '/includes/views/backend/forms/custom-field-types/' . $field_type . '.php')) {
            include(FPSM_PATH . '/includes/views/backend/forms/custom-field-types/' . $field_type . '.php');
            include(FPSM_PATH . '/includes/views/backend/forms/form-edit-sections/form-fields/post-display-fields.php');
        }
        /**
         * Fires at the end of all the custom field option has been printed
         *
         * @param type string $field_key
         * @param type array $field_details
         *
         * @since 1.0.0
         */
        do_action('fpsm_custom_field_admin_end', $field_key, $field_details);
        ?>

    </div>
</div>
