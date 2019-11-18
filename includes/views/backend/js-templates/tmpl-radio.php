<div class="fpsm-each-form-field">
    <div class="fpsm-field-head fpsm-clearfix">
        <h3 class="fpsm-field-title"><span class="dashicons dashicons-arrow-down"></span>{{data.label}} <span class="fpsm-field-type-label">- <?php esc_html_e('Radio Button', 'frontend-post-submission-manager'); ?></span></h3>
        <a href="javascript:void(0);" class="fpsm-field-remove-trigger"><span class="dashicons dashicons-trash"></span></a>
    </div>
    <div class="fpsm-field-body fpsm-display-none">
        <?php include(FPSM_PATH . '/includes/views/backend/js-templates/tmpl-common-fields.php'); ?>
        <div class="fpsm-show-fields-ref-{{data.meta_key}} fpsm-display-none">
            <div class="fpsm-field-wrap">
                <label><?php esc_html_e('Radio Button Lists', 'frontend-post-submission-manager'); ?></label>
                <div class="fpsm-field">
                    <div class="fpsm-dropdown-list-wrap fpsm-sortable">
                        <div class="fpsm-each-dropdown">
                            <label>
                                <input type="radio" name="form_details[form][fields][{{data.field_key}}][checked_radio]" class="fpsm-checked-radio-ref"/><?php esc_html_e('Checked', 'frontend-post-submission-manager'); ?>
                                <input type="hidden" name="form_details[form][fields][{{data.field_key}}][checked]" value="0" class="fpsm-checked-radio-val"/>
                            </label>
                            <input type="text" name="form_details[form][fields][{{data.field_key}}][options][]" placeholder="<?php esc_html_e('Option 1', 'frontend-post-submission-manager'); ?>"/>
                            <input type="text" name="form_details[form][fields][{{data.field_key}}][values][]" placeholder="<?php esc_html_e('Value 1', 'frontend-post-submission-manager'); ?>"/>

                            <span class="dashicons dashicons-trash fpsm-delete-dropdown-trigger"></span>
                        </div>
                        <div class="fpsm-each-dropdown">
                            <label>
                                <input type="radio" name="form_details[form][fields][{{data.field_key}}][checked_radio]" class="fpsm-checked-radio-ref"/><?php esc_html_e('Checked', 'frontend-post-submission-manager'); ?>
                                <input type="hidden" name="form_details[form][fields][{{data.field_key}}][checked]" value="0" class="fpsm-checked-radio-val"/>
                            </label>
                            <input type="text" name="form_details[form][fields][{{data.field_key}}][options][]" placeholder="<?php esc_html_e('Option 2', 'frontend-post-submission-manager'); ?>"/>
                            <input type="text" name="form_details[form][fields][{{data.field_key}}][values][]" placeholder="<?php esc_html_e('Value 2', 'frontend-post-submission-manager'); ?>"/>

                            <span class="dashicons dashicons-trash fpsm-delete-dropdown-trigger"></span>
                        </div>
                    </div>
                    <input type="button" class="button-secondary fpsm-add-option-trigger" value="<?php esc_html_e('Add Option', 'frontend-post-submission-manager'); ?>" data-field-key="{{data.field_key}}"/>
                </div>
            </div>
        </div>
    </div>
</div>