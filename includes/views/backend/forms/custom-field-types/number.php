<?php include(FPSM_PATH . '/includes/views/backend/forms/form-edit-sections/form-fields/common-fields.php'); ?>
<div class="fpsm-show-fields-ref-<?php echo (!empty($show_hide_toggle_class)) ? esc_attr($show_hide_toggle_class) : esc_attr($field_key); ?> <?php echo (empty($field_details['show_on_form'])) ? 'fpsm-display-none' : ''; ?>">
    <div class="fpsm-field-wrap">
        <label><?php esc_html_e('Min Limit', 'frontend-post-submission-manager'); ?></label>
        <div class="fpsm-field">
            <input type="number" name="form_details[form][fields][<?php echo esc_attr($field_key); ?>][min_limit]" value="<?php echo (!empty($field_details['min_limit'])) ? intval($field_details['min_limit']) : ''; ?>"/>
        </div>
    </div>
    <div class="fpsm-field-wrap">
        <label><?php esc_html_e('Max Limit', 'frontend-post-submission-manager'); ?></label>
        <div class="fpsm-field">
            <input type="number" name="form_details[form][fields][<?php echo esc_attr($field_key); ?>][max_limit]" value="<?php echo (!empty($field_details['max_limit'])) ? intval($field_details['max_limit']) : ''; ?>"/>
        </div>
    </div>
    <div class="fpsm-field-wrap">
        <label><?php esc_html_e('Character Limit Error Message', 'frontend-post-submission-manager'); ?></label>
        <div class="fpsm-field">
            <input type="text" name="form_details[form][fields][<?php echo esc_attr($field_key) ?>][max_limit_error_message]" value="<?php echo (!empty($field_details['max_limit_error_message'])) ? esc_attr($field_details['character_limit_error_message']) : ''; ?>"/>
        </div>
    </div>
</div>