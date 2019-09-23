<div class="fpsm-field-wrap">
    <label><?php esc_html_e('Show on form', 'frontend-post-submission-manager'); ?></label>
    <div class="fpsm-field">
        <input type="checkbox" name="form_details[form][fields][<?php echo esc_attr($field_key); ?>][show_on_form]" value="1" <?php echo (!empty($field_details['show_on_form'])) ? 'checked="checked"' : ''; ?> class="fpsm-checkbox-toggle-trigger" data-toggle-class="fpsm-show-fields-ref"/>
    </div>
</div>
<div class="fpsm-show-fields-ref <?php echo (empty($field_details['show_on_form'])) ? 'fpsm-display-none' : ''; ?>">
    <div class="fpsm-field-wrap">
        <label><?php esc_html_e('Required', 'frontend-post-submission-manager'); ?></label>
        <div class="fpsm-field">
            <input type="checkbox" name="form_details[form][fields][<?php echo esc_attr($field_key); ?>][required]" value="1" <?php echo (!empty($field_details['required'])) ? 'checked="checked"' : ''; ?> class="fpsm-checkbox-toggle-trigger" data-toggle-class="fpsm-required-message"/>
        </div>
    </div>
    <div class="fpsm-field-wrap fpsm-required-message <?php echo (empty($field_details['required'])) ? 'fpsm-display-none' : ''; ?>">
        <label><?php esc_html_e('Required Error Message', 'frontend-post-submission-manager'); ?></label>
        <div class="fpsm-field">
            <input type="text" name="form_details[form][fields][<?php echo esc_attr($field_key); ?>][required_error_message]"/>
        </div>
    </div>
    <div class="fpsm-field-wrap">
        <label><?php esc_html_e('Field Label', 'frontend-post-submission-manager'); ?></label>
        <div class="fpsm-field">
            <input type="text" name="form_details[form][fields][<?php echo esc_attr($field_key); ?>][field_label]" value="<?php echo (!empty($field_details['field_label'])) ? esc_attr($field_details['field_label']) : ''; ?>"/>
        </div>
    </div>
    <div class="fpsm-field-wrap">
        <label><?php esc_html_e('Field Note', 'frontend-post-submission-manager'); ?></label>
        <div class="fpsm-field">
            <input type="text" name="form_details[form][fields][<?php echo esc_attr($field_key); ?>][field_note]" value="<?php echo (!empty($field_details['field_note'])) ? esc_attr($field_details['field_note']) : ''; ?>"/>
            <p class="description"><?php esc_html_e('This note will show just below the field. Pleaes leave blank if you don\'t want to display the field note.', 'frontend-post-submission-manager'); ?></p>
        </div>
    </div>
</div>