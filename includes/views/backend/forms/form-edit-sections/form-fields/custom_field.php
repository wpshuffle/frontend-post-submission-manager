<?php
$field_key_array = explode('|', $field_key);
$meta_key = end($field_key_array);
$fpsm_library_obj->print_array($field_details);
$field_label = (!empty($field_details['field_label'])) ? $field_label['field_label'] : esc_html__('Untitled Field', 'frontend-post-submission-manager');
$show_hide_toggle_class = $meta_key;
$field_type = $field_details['field_type'];
?>
<div class="fpsm-each-form-field">
    <div class="fpsm-field-head fpsm-clearfix">
        <h3 class="fpsm-field-title"><span class="dashicons dashicons-arrow-down"></span><?php echo esc_html($field_label); ?></h3>
        <a href="javascript:void(0);" class="fpsm-field-remove-trigger"><span class="dashicons dashicons-trash"></span></a>
    </div>
    <div class="fpsm-field-body fpsm-display-none">
        <input type="hidden" name="form_details[form][fields][<?php echo esc_attr($field_key); ?>][field_type]" value="<?php echo esc_attr($field_type); ?>"/>
        <?php
        if (file_exists(FPSM_PATH . '/includes/views/backend/forms/custom-field-types/' . $field_type . '.php')) {
            include(FPSM_PATH . '/includes/views/backend/forms/custom-field-types/' . $field_type . '.php');
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
