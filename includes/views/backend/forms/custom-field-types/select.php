
<?php include(FPSM_PATH . '/includes/views/backend/forms/form-edit-sections/form-fields/common-fields.php'); ?>
<div class="fpsm-show-fields-ref-<?php echo (!empty($show_hide_toggle_class)) ? esc_attr($show_hide_toggle_class) : esc_attr($field_key); ?> <?php echo (empty($field_details['show_on_form'])) ? 'fpsm-display-none' : ''; ?>">
    <div class="fpsm-field-wrap">
        <label><?php esc_html_e('Dropdown Lists', 'frontend-post-submission-manager'); ?></label>
        <div class="fpsm-field">
            <div class="fpsm-dropdown-list-wrap fpsm-sortable">
                <?php
                if (!empty($field_details['options'])) {
                    $option_count = 0;
                    foreach ($field_details['options'] as $option) {
                        ?>
                        <div class="fpsm-each-dropdown">
                            <input type="text" name="form_details[form][fields][<?php echo esc_attr($field_key); ?>][options][]" placeholder="<?php esc_html_e('Option 1', 'frontend-post-submission-manager'); ?>" value="<?php echo esc_attr($option); ?>"/>
                            <input type="text" name="form_details[form][fields][<?php echo esc_attr($field_key); ?>][values][]" placeholder="<?php esc_html_e('Value 1', 'frontend-post-submission-manager'); ?>" value="<?php echo esc_attr($field_details['values'][$option_count]); ?>"/>
                            <span class="dashicons dashicons-trash fpsm-delete-dropdown-trigger"></span>
                        </div>
                        <?php
                        $option_count++;
                    }
                }
                ?>

            </div>
            <input type="button" class="button-secondary fpsm-add-option-trigger" value="<?php esc_html_e('Add Option', 'frontend-post-submission-manager'); ?>" data-field-key="<?php echo esc_attr($field_key); ?>"/>
        </div>
    </div>
</div>
