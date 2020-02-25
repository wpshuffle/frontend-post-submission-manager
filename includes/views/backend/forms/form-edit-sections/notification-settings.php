<div class="fpsm-settings-each-section fpsm-display-none" data-tab="notification">
    <div class="fpsm-each-form-field">
        <div class="fpsm-field-head fpsm-clearfix">
            <h3 class="fpsm-field-title"><span class="dashicons dashicons-arrow-down"></span><?php esc_html_e('Admin Notification', 'frontend-post-submission-manager'); ?></h3>
        </div>
        <div class="fpsm-field-body fpsm-display-none">
            <div class="fpsm-field-wrap">
                <label><?php esc_html_e('Enable', 'frontend-post-submission-manager'); ?></label>
                <div class="fpsm-field">
                    <input type="checkbox" name="form_details[notification][admin][enable]" value="1" class="fpsm-checkbox-toggle-trigger" data-toggle-class="fpsm-show-fields-ref-admin-notification" <?php echo (!empty($form_details['notification']['admin']['enable'])) ? 'checked="checked"' : ''; ?>>
                </div>
            </div>
            <div class="fpsm-show-fields-ref-admin-notification <?php echo (empty($form_details['notification']['admin']['enable'])) ? 'fpsm-display-none' : ''; ?>">
                <div class="fpsm-field-wrap">
                    <label><?php esc_html_e('Subject', 'frontend-post-submission-manager'); ?></label>
                    <div class="fpsm-field fpsm-checkbox-toggle">
                        <input type="text" name="form_details[notification][admin][subject]" value="<?php echo (!empty($form_details['notification']['admin']['subject'])) ? esc_attr($form_details['notification']['admin']['subject']) : '' ?>">
                    </div>
                </div>
                <div class="fpsm-field-wrap fpsm-required-message ">
                    <label><?php esc_html_e('From name', 'frontend-post-submission-manager'); ?></label>
                    <div class="fpsm-field">
                        <input type="text" name="form_details[notification][admin][from_name]" value="<?php echo (!empty($form_details['notification']['admin']['from_name'])) ? esc_attr($form_details['notification']['admin']['from_name']) : ''; ?>">
                    </div>
                </div>
                <div class="fpsm-field-wrap">
                    <label><?php esc_html_e('From Email', 'frontend-post-submission-manager'); ?></label>
                    <div class="fpsm-field">
                        <input type="text" name="form_details[notification][admin][from_email]" value="<?php echo (!empty($form_details['notification']['admin']['from_email'])) ? esc_attr($form_details['notification']['admin']['from_email']) : ''; ?>">
                    </div>
                </div>
                <div class="fpsm-field-wrap">
                    <label><?php esc_html_e('Message', 'frontend-post-submission-manager'); ?></label>
                    <div class="fpsm-field">
                        <textarea name="form_details[notification][admin][message]"><?php echo (!empty($form_details['notification']['admin']['message'])) ? $fpsm_library_obj->sanitize_html($form_details['notification']['admin']['message']) : $fpsm_library_obj->default_admin_notification(); ?></textarea>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="fpsm-each-form-field">
        <div class="fpsm-field-head fpsm-clearfix">
            <h3 class="fpsm-field-title"><span class="dashicons dashicons-arrow-down"></span><?php esc_html_e('Post Publish Notification', 'frontend-post-submission-manager'); ?></h3>
        </div>
        <div class="fpsm-field-body fpsm-display-none">
            <div class="fpsm-field-wrap">
                <label><?php esc_html_e('Enable', 'frontend-post-submission-manager'); ?></label>
                <div class="fpsm-field">
                    <input type="checkbox" name="form_details[notification][post_publish][enable]" value="1" class="fpsm-checkbox-toggle-trigger" data-toggle-class="fpsm-show-fields-ref-admin-notification" <?php echo (!empty($form_details['notification']['post_publish']['enable'])) ? 'checked="checked"' : ''; ?>>
                </div>
            </div>
            <div class="fpsm-show-fields-ref-admin-notification <?php echo (empty($form_details['notification']['post_publish']['enable'])) ? 'fpsm-display-none' : ''; ?>">
                <div class="fpsm-field-wrap">
                    <label><?php esc_html_e('Subject', 'frontend-post-submission-manager'); ?></label>
                    <div class="fpsm-field fpsm-checkbox-toggle">
                        <input type="text" name="form_details[notification][post_publish][subject]" value="<?php echo (!empty($form_details['notification']['post_publish']['subject'])) ? esc_attr($form_details['notification']['post_publish']['subject']) : '' ?>">
                    </div>
                </div>
                <div class="fpsm-field-wrap fpsm-required-message ">
                    <label><?php esc_html_e('From name', 'frontend-post-submission-manager'); ?></label>
                    <div class="fpsm-field">
                        <input type="text" name="form_details[notification][post_publish][from_name]" value="<?php echo (!empty($form_details['notification']['post_publish']['from_name'])) ? esc_attr($form_details['notification']['post_publish']['from_name']) : ''; ?>">
                    </div>
                </div>
                <div class="fpsm-field-wrap">
                    <label><?php esc_html_e('From Email', 'frontend-post-submission-manager'); ?></label>
                    <div class="fpsm-field">
                        <input type="text" name="form_details[notification][post_publish][from_email]" value="<?php echo (!empty($form_details['notification']['post_publish']['from_email'])) ? esc_attr($form_details['notification']['post_publish']['from_email']) : ''; ?>">
                    </div>
                </div>
                <div class="fpsm-field-wrap">
                    <label><?php esc_html_e('Message', 'frontend-post-submission-manager'); ?></label>
                    <div class="fpsm-field">
                        <textarea name="form_details[notification][post_publish][message]"><?php echo (!empty($form_details['notification']['post_publish']['message'])) ? $fpsm_library_obj->sanitize_html($form_details['notification']['post_publish']['message']) : $fpsm_library_obj->default_admin_notification(); ?></textarea>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>