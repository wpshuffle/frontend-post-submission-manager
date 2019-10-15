<?php
$field_key_array = explode('|', $field_key);
$taxonomy = end($field_key_array);
$taxonomy_details = get_taxonomy($taxonomy);
global $fpsm_library_obj;
//$fpsm_library_obj->print_array($taxonomy_details);
?>
<div class="fpsm-each-form-field">
    <div class="fpsm-field-head fpsm-clearfix">
        <h3 class="fpsm-field-title"><span class="dashicons dashicons-arrow-down"></span><?php echo esc_html($taxonomy_details->label); ?></h3>
    </div>
    <div class="fpsm-field-body fpsm-display-none">
        <?php include(FPSM_PATH . '/includes/views/backend/forms/form-edit-sections/form-fields/common-fields.php'); ?>
        <div class="fpsm-show-fields-ref-<?php echo esc_attr($taxonomy); ?> <?php echo (empty($field_details['show_on_form'])) ? 'fpsm-display-none' : ''; ?>">
            <div class="fpsm-field-wrap">
                <label><?php esc_html_e('Field Type', 'frontend-post-submission-manager'); ?></label>
                <div class="fpsm-field">
                    <select name="<?php echo esc_attr($field_name) ?>[field_type]" class="fpsm-toggle-trigger" data-toggle-class='fpsm-field-type-ref'>
                        <?php
                        $field_type = (!empty($field_details['field_type'])) ? $field_details['field_type'] : 'select';
                        ?>
                        <option value="select" <?php selected($field_type, 'select'); ?>><?php esc_html_e('Select Dropdown', 'frontend-post-submission-manager'); ?></option>
                        <option value="checkbox" <?php selected($field_type, 'checkbox'); ?>><?php esc_html_e('Checkbox', 'frontend-post-submission-manager'); ?></option>
                        <?php
                        if ($taxonomy_details->hierarchical == 0) {
                            ?>
                            <option value="textfield"><?php esc_html_e('Textfield', 'frontend-post-submission-manager'); ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="fpsm-field-wrap fpsm-field-type-ref" <?php echo $fpsm_library_obj->display_none($field_type, 'checkbox'); ?> data-toggle-ref='checkbox'>
                <label><?php esc_html_e('Display Type', 'frontend-post-submission-manager'); ?></label>
                <div class="fpsm-field">
                    <select name="<?php echo esc_attr($field_name) ?>[display_type]">
                        <?php
                        $display_type = (!empty($field_details['display_type'])) ? $field_details['display_type'] : 'inline';
                        ?>
                        <option value="inline" <?php selected($display_type, 'inline'); ?>><?php esc_html_e('Inline', 'frontend-post-submission-manager'); ?></option>
                        <option value="block" <?php selected($display_type, 'block'); ?>><?php esc_html_e('Block', 'frontend-post-submission-manager'); ?></option>
                    </select>
                </div>
            </div>
            <?php
            if ($taxonomy_details->hierarchical == 0) {
                ?>
                <div class="fpsm-field-wrap fpsm-field-type-ref" <?php echo $fpsm_library_obj->display_none($field_type, 'textfield'); ?> data-toggle-ref='textfield'>
                    <label><?php esc_html_e('Auto Complete', 'frontend-post-submission-manager'); ?></label>
                    <div class="fpsm-field">
                        <input type="checkbox" name="<?php echo esc_attr($field_name); ?>[auto_complete]" value="1" <?php echo (!empty($field_details['auto_complete'])) ? 'checked="checked"' : ''; ?>/>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>