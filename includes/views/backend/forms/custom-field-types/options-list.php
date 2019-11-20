<div class="fpsm-field">
    <div class="fpsm-dropdown-list-wrap fpsm-field-<?php echo esc_attr($field_type); ?>">
        <?php
        if (!empty($field_details['options'])) {
            $option_count = 0;
            foreach ($field_details['options'] as $option) {
                ?>
                <div class="fpsm-each-dropdown">
                    <?php if ($field_type == 'radio') { ?>
                        <label>
                            <input type="radio" name="form_details[form][fields][<?php echo esc_attr($field_key); ?>][checked_radio]" class="fpsm-checked-radio-ref"/><?php esc_html_e('Checked', 'frontend-post-submission-manager'); ?>
                            <input type="hidden" name="form_details[form][fields][<?php echo esc_attr($field_key); ?>][checked]" value="0" class="fpsm-checked-radio-val"/>
                        </label>
                    <?php } ?>
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
    <input type="button" class="button-secondary fpsm-add-option-trigger" value="<?php esc_html_e('Add Option', 'frontend-post-submission-manager'); ?>" data-field-key="<?php echo esc_attr($field_key); ?>" data-field-type="<?php echo esc_attr($field_type); ?>"/>
</div>