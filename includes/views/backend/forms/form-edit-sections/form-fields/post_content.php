<div class="fpsm-each-form-field">
    <div class="fpsm-field-head fpsm-clearfix">
        <h3 class="fpsm-field-title"><span class="dashicons dashicons-arrow-down"></span><?php esc_html_e('Post Content', 'frontend-post-submission-manager'); ?></h3>
    </div>
    <div class="fpsm-field-body fpsm-display-none">
        <?php include(FPSM_PATH . '/includes/views/backend/forms/form-edit-sections/form-fields/common-fields.php'); ?>
        <div class="fpsm-field-wrap">
            <label><?php esc_html_e('Editor Type', 'frontend-post-submission-manager'); ?></label>
            <div class="fpsm-field">
                <select name="form_details[form][fields][<?php echo esc_attr($field_key); ?>][editor_type]">
                    <option value="simple"><?php esc_html_e('Simple Textarea', 'frontend-post-submission-manager'); ?></option>
                    <option value="rich"><?php esc_html_e('Rich Text Editor', 'frontend-post-submission-manager'); ?></option>
                    <option value="visual"><?php esc_html_e('Visual Text Editor', 'frontend-post-submission-manager'); ?></option>
                    <option value="html"><?php esc_html_e('HTML Text Editor', 'frontend-post-submission-manager'); ?></option>
                </select>
            </div>
        </div>
        <div class="fpsm-field-wrap">
            <label><?php esc_html_e('Character Limit', 'frontend-post-submission-manager'); ?></label>
            <div class="fpsm-field">
                <input type="number" min="0" name="form_details[form][fields][<?php echo esc_attr($field_key); ?>][character_limit]" value="<?php echo (!empty($field_details['character_limit'])) ? intval($field_details['character_limit']) : ''; ?>"/>
            </div>
        </div>
        <div class="fpsm-field-wrap">
            <label><?php esc_html_e('Character Limit Error Message', 'frontend-post-submission-manager'); ?></label>
            <div class="fpsm-field">
                <input type="text" name="form_details[form][fields][<?php echo esc_attr($field_key) ?>][character_limit_error_message]" value="<?php echo (!empty($field_details['character_limit_message'])) ? esc_attr($field_details['character_limit_message']) : ''; ?>"/>
            </div>
        </div>

    </div>

</div>
