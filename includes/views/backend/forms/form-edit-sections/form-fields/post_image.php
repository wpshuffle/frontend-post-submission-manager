<div class="fpsm-each-form-field">
    <div class="fpsm-field-head fpsm-clearfix">
        <h3 class="fpsm-field-title"><span class="dashicons dashicons-arrow-down"></span><?php esc_html_e('Post Image', 'frontend-post-submission-manager'); ?></h3>
    </div>
    <div class="fpsm-field-body fpsm-display-none">
        <?php include(FPSM_PATH . '/includes/views/backend/forms/form-edit-sections/form-fields/common-fields.php'); ?>
        <div class="fpsm-show-fields-ref-<?php echo esc_attr($field_key); ?> <?php echo (empty($field_details['show_on_form'])) ? 'fpsm-display-none' : ''; ?>">
            <div class="fpsm-field-wrap">
                <label><?php esc_html_e('Upload Button Label', 'frontend-post-submission-manager'); ?></label>
                <div class="fpsm-field">
                    <input type="text" name="form_details[form][fields][<?php echo esc_attr($field_key); ?>][upload_button_label]" value="<?php echo (!empty($field_details['upload_button_label'])) ? esc_attr($field_details['upload_button_label']) : ''; ?>"/>
                </div>
            </div>
            <div class="fpsm-field-wrap">
                <label><?php esc_html_e('Max Image Size', 'frontend-post-submission-manager'); ?></label>
                <div class="fpsm-field">
                    <input type="number" name="form_details[form][fields][<?php echo esc_attr($field_key); ?>][max_image_size]" value="<?php echo (!empty($field_details['max_image_size'])) ? intval($field_details['max_image_size']) : ''; ?>"/> <span class="description"><?php esc_html_e('in MB', 'frontend-post-submission-manager'); ?></span>
                    <p class="description"><?php esc_html_e('Please enter the maximum size of the image which can be uploaded. Please leave blank if you don\'t want any image size restriction.', 'frontend-post-submission-manager'); ?></p>
                </div>
            </div>
            <div class="fpsm-field-wrap">
                <label><?php esc_html_e('Max Size Error Message', 'frontend-post-submission-manager'); ?></label>
                <div class="fpsm-field">
                    <input type="text" name="form_details[form][fields][<?php echo esc_attr($field_key); ?>][max_size_error_message]" value="<?php echo (!empty($field_details['max_size_error_message'])) ? esc_attr($field_details['max_size_error_message']) : ''; ?>"/>
                </div>
            </div>
        </div>
    </div>
</div>