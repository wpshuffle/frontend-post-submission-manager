<div class="fpsm-form-message"></div>
<?php
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
if (!empty($custom_field_type_list)) {
    foreach ($custom_field_type_list as $custom_field_type => $custom_field_type_label) {
        $field_name_prefix = 'form_details[form][fields][{{data.field_key}}]';
        $show_hide_toggle_class = '{{data.meta_key}}';
        $field_details['field_label'] = '{{data.label}}';
        $field_type = $custom_field_type;
        ?>
        <script type="text/html" id="tmpl-custom-<?php echo esc_attr($custom_field_type); ?>">
        <?php //include(FPSM_PATH . '/includes/views/backend/js-templates/tmpl-' . $custom_field_type . '.php');          ?>
        <?php include(FPSM_PATH . '/includes/views/backend/js-templates/tmpl-custom-field-holder.php'); ?>
        </script>
        <?php
    }
}
?>

<script type="text/html" id="tmpl-option">
    <?php include(FPSM_PATH . '/includes/views/backend/js-templates/tmpl-option.php'); ?>
</script>