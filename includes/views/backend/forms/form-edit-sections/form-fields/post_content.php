<div class="fpsm-each-form-field">
    <div class="fpsm-field-head fpsm-clearfix">
        <h3 class="fpsm-field-title"><span class="dashicons dashicons-arrow-down"></span><?php esc_html_e('Post Content', 'frontend-post-submission-manager'); ?></h3>
    </div>
    <div class="fpsm-field-body fpsm-display-none">
        <?php include(FPSM_PATH . '/includes/views/backend/forms/form-edit-sections/form-fields/common-fields.php'); ?>
        <div class="fpsm-show-fields-ref-<?php echo esc_attr($field_key); ?> <?php echo (empty($field_details['show_on_form'])) ? 'fpsm-display-none' : ''; ?>">
            <div class="fpsm-field-wrap">
                <label><?php esc_html_e('Editor Type', 'frontend-post-submission-manager'); ?></label>
                <div class="fpsm-field">
                    <select name="<?php echo esc_attr($field_name_prefix); ?>[editor_type]">
                        <option value="simple"><?php esc_html_e('Simple Textarea', 'frontend-post-submission-manager'); ?></option>
                        <option value="rich"><?php esc_html_e('Rich Text Editor', 'frontend-post-submission-manager'); ?></option>
                        <option value="visual"><?php esc_html_e('Visual Text Editor', 'frontend-post-submission-manager'); ?></option>
                        <option value="html"><?php esc_html_e('HTML Text Editor', 'frontend-post-submission-manager'); ?></option>
                    </select>
                </div>
            </div>
            <?php
            if ($form_row->form_type == 'login_require') {
                ?>
                <div class="fpsm-field-wrap">
                    <label><?php esc_html_e('Media Upload', 'frontend-post-submission-manager'); ?></label>
                    <div class="fpsm-field">
                        <input type="checkbox" name="<?php echo $field_name_prefix; ?>[media_upload]" value="1"/>
                        <p class="description"><?php esc_html_e('Please check if you want to enable the direct media upload to the post content for logged in users.', 'frontend-post-submission-manager'); ?></p>
                        <p class="description"><?php echo __(sprintf('Please note that media upload button only shows if logged in user role has the upload_files capabilities. Please check %s here %s for an easy reference.', '<a href="https://wordpress.org/support/article/roles-and-capabilities/#capability-vs-role-table" target="_blank">', '</a>'), 'frontend-post-submission-manager'); ?></p>
                    </div>
                </div>
            <?php } ?>
            <div class="fpsm-field-wrap">
                <label><?php esc_html_e('Custom Media Upload Button', 'frontend-post-submission-manager'); ?></label>
                <div class="fpsm-field">
                    <input type="checkbox" name="<?php echo esc_attr($field_name_prefix); ?>[custom_media_upload_button]"/>
                </div>
            </div>
            <div class="fpsm-field-wrap">
                <label><?php esc_html_e('Character Limit', 'frontend-post-submission-manager'); ?></label>
                <div class="fpsm-field">
                    <input type="number" min="0" name="<?php echo esc_attr($field_name_prefix); ?>[character_limit]" value="<?php echo (!empty($field_details['character_limit'])) ? intval($field_details['character_limit']) : ''; ?>"/>
                </div>
            </div>
            <div class="fpsm-field-wrap">
                <label><?php esc_html_e('Character Limit Error Message', 'frontend-post-submission-manager'); ?></label>
                <div class="fpsm-field">
                    <input type="text" name="form_details[form][fields][<?php echo esc_attr($field_key) ?>][character_limit_error_message]" value="<?php echo (!empty($field_details['character_limit_error_message'])) ? esc_attr($field_details['character_limit_error_message']) : ''; ?>"/>
                </div>
            </div>
        </div>
    </div>

</div>
