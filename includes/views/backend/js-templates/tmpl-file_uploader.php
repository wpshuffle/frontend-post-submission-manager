<div class="fpsm-each-form-field">
    <div class="fpsm-field-head fpsm-clearfix">
        <h3 class="fpsm-field-title"><span class="dashicons dashicons-arrow-down"></span>{{data.label}} <span class="fpsm-field-type-label">- <?php esc_html_e('File Uploader', 'frontend-post-submission-manager'); ?></span></h3>
        <a href="javascript:void(0);" class="fpsm-field-remove-trigger"><span class="dashicons dashicons-trash"></span></a>
    </div>
    <div class="fpsm-field-body fpsm-display-none">
        <?php include(FPSM_PATH . '/includes/views/backend/js-templates/tmpl-common-fields.php'); ?>
        <div class="fpsm-show-fields-ref-{{data.meta_key}} fpsm-display-none">
            <div class="fpsm-field-wrap">
                <label><?php esc_html_e('File Extensions', 'frontend-post-submission-manager'); ?></label>
                <div class="fpsm-field">
                    <?php
                    global $fpsm_library_obj;
                    $mime_types = get_allowed_mime_types();
                    if (!empty($mime_types)) {
                        foreach ($mime_types as $mime_type => $mime_type_label) {
                            ?>
                            <label class="fpsm-each-extension"><input type="checkbox" name="<?php echo $field_name_prefix; ?>[file_extensions][]" value="<?php echo esc_attr($mime_type); ?>" class="fpsm-disable-checkbox-toggle"/><span><?php echo esc_html($mime_type); ?></label>
                                <?php
                            }
                        }
                        //$fpsm_library_obj->print_array($mime_types);
                        ?>
                </div>
            </div>
        </div>
    </div>
</div>