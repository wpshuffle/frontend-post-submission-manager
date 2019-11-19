<div class="fpsm-each-form-field">
    <div class="fpsm-field-head fpsm-clearfix">
        <h3 class="fpsm-field-title"><span class="dashicons dashicons-arrow-down"></span>{{data.label}} <span class="fpsm-field-type-label">- <?php esc_html_e('File Uploader', 'frontend-post-submission-manager'); ?></span></h3>
        <a href="javascript:void(0);" class="fpsm-field-remove-trigger"><span class="dashicons dashicons-trash"></span></a>
    </div>
    <div class="fpsm-field-body fpsm-display-none">
        <?php include(FPSM_PATH . '/includes/views/backend/js-templates/tmpl-common-fields.php'); ?>
        <div class="fpsm-show-fields-ref-{{data.meta_key}} fpsm-display-none">
            <div class="fpsm-field-wrap">
                <label><?php esc_html_e('Upload Button Label', 'frontend-post-submission-manager'); ?></label>
                <div class="fpsm-field">
                    <input type="text" name="<?php echo esc_attr($field_name_prefix); ?>[upload_button_label]"/>
                </div>
            </div>
            <div class="fpsm-field-wrap">
                <label><?php esc_html_e('File Extensions', 'frontend-post-submission-manager'); ?></label>
                <div class="fpsm-field">
                    <?php
                    global $fpsm_library_obj;
                    $mime_types = get_allowed_mime_types();
                    if (!empty($mime_types)) {
                        foreach ($mime_types as $mime_type => $mime_type_label) {
                            ?>
                            <label class="fpsm-each-extension"><input type="checkbox" name="<?php echo esc_attr($field_name_prefix); ?>[file_extensions][]" value="<?php echo esc_attr($mime_type); ?>" class="fpsm-disable-checkbox-toggle"/><span><?php echo esc_html($mime_type); ?></label>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="fpsm-field-wrap">
                <label><?php esc_html_e('Multiple Upload', 'frontend-post-submission-manager'); ?></label>
                <div class="fpsm-field">
                    <input type="checkbox" name="<?php echo esc_attr($field_name_prefix) ?>[multiple_upload]" value="1"/>
                    <p class="description"><?php esc_html_e('Please check if you want to enable the multiple file upload.', 'frontend-post-submission-manager'); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>