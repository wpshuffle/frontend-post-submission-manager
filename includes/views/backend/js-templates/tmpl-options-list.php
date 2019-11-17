<div class="fpsm-field">
    <div class="fpsm-dropdown-list-wrap fpsm-sortable">
        <div class="fpsm-each-dropdown">
            <input type="text" name="form_details[form][fields][{{data.field_key}}][options][]" placeholder="<?php esc_html_e('Option 1', 'frontend-post-submission-manager'); ?>"/>
            <input type="text" name="form_details[form][fields][{{data.field_key}}][values][]" placeholder="<?php esc_html_e('Value 1', 'frontend-post-submission-manager'); ?>"/>
            <span class="dashicons dashicons-trash fpsm-delete-dropdown-trigger"></span>
        </div>
        <div class="fpsm-each-dropdown">
            <input type="text" name="form_details[form][fields][{{data.field_key}}][options][]" placeholder="<?php esc_html_e('Option 2', 'frontend-post-submission-manager'); ?>"/>
            <input type="text" name="form_details[form][fields][{{data.field_key}}][values][]" placeholder="<?php esc_html_e('Value 2', 'frontend-post-submission-manager'); ?>"/>
            <span class="dashicons dashicons-trash fpsm-delete-dropdown-trigger"></span>
        </div>
    </div>
    <input type="button" class="button-secondary fpsm-add-option-trigger" value="<?php esc_html_e('Add Option', 'frontend-post-submission-manager'); ?>" data-field-key="{{data.field_key}}"/>
</div>