<div class="fpsm-custom-field-add-form">
    <h3><?php esc_html_e('Custom Field', 'frontend-post-submission-manager'); ?></h3>
    <div class="fpsm-field-wrap">
        <label><?php esc_html_e('Label', 'frontend-post-submission-manager'); ?></label>
        <div class="fpsm-field">
            <input type="text" id="fpsm-custom-field-label"/>
        </div>
    </div>
    <div class="fpsm-field-wrap">
        <label><?php esc_html_e('Meta Key', 'frontend-post-submission-manager'); ?></label>
        <div class="fpsm-field">
            <input type="text" id="fpsm-custom-field-meta-key"/>
            <p class="description"><?php esc_html_e('Please use plain text without any special characters for meta key and use underscore(_) instead of white space.', 'frontend-post-submission-manager'); ?></p>
        </div>
    </div>
    <div class="fpsm-field-wrap">
        <label><?php esc_html_e('Field Type', 'frontend-post-submission-manager'); ?></label>
        <div class="fpsm-field">
            <select id="fpsm-custom-field-type" style="display:none">
                <?php
                $custom_field_type_list = array(
                    'textfield' => array('label' => esc_html__('Texfield', 'frontend-post-submission-manager'), 'icon' => 'fas fa-edit'),
                    'textarea' => array('label' => esc_html__('Textarea', 'frontend-post-submission-manager'), 'icon' => 'fas fa-expand'),
                    'select' => array('label' => esc_html__('Select Dropdown', 'frontend-post-submission-manager'), 'icon' => 'far fa-caret-square-down'),
                    'checkbox' => array('label' => esc_html__('Checkbox', 'frontend-post-submission-manager'), 'icon' => 'far fa-check-square'),
                    'radio' => array('label' => esc_html__('Radio Button', 'frontend-post-submission-manager'), 'icon' => 'far fa-dot-circle'),
                    'number' => array('label' => esc_html__('Number', 'frontend-post-submission-manager'), 'icon' => 'fas fa-sort'),
                    'email' => array('label' => esc_html__('Email', 'frontend-post-submission-manager'), 'icon' => 'fas fa-envelope'),
                    'datepicker' => array('label' => esc_html__('Datepicker', 'frontend-post-submission-manager'), 'icon' => 'far fa-calendar-alt'),
                    'file_uploader' => array('label' => esc_html__('File Uploader', 'frontend-post-submission-manager'), 'icon' => 'fas fa-paperclip'),
                    'url_field' => array('label' => esc_html__('Url', 'frontend-post-submission-manager'), 'icon' => 'fas fa-globe-asia')
                );
                /**
                 * Filters custom field type list
                 *
                 * @param array $custom_field_type_list
                 *
                 * @since 1.0.0
                 */
                $custom_field_type_list = apply_filters('fpsm_custom_field_type_list', $custom_field_type_list);
                foreach ($custom_field_type_list as $custom_field_type => $custom_field_details) {
                    $custom_field_label = $custom_field_details['label'];
                    ?>
                    <option value="<?php echo esc_attr($custom_field_type); ?>"><?php echo esc_html($custom_field_label); ?></option>
                    <?php
                }
                ?>

            </select>
            <div class="fpsm-custom-field-btns-wrap">
                <?php
                foreach ($custom_field_type_list as $custom_field_type => $custom_field_details) {
                    $custom_field_label = $custom_field_details['label'];
                    ?>
                    <div class="fpsm-custom-fld-btn fpsm-custom-field-type-trigger-btn <?php echo ($custom_field_type == 'textfield') ? 'btn-selected' : ''; ?>" data-field-type="<?php echo esc_attr($custom_field_type); ?>">
                        <i class="<?php echo esc_attr($custom_field_details['icon']); ?>"></i> <?php echo esc_html($custom_field_label); ?>
                    </div>

                <?php }
                ?>
            </div>
        </div>
    </div>

    <div class="fpsm-field-wrap">
        <div class="fpsm-field">
            <input type="button" class="fpsm-button-secondary fpsm-custom-field-add-trigger" value="<?php esc_attr_e('Add', 'frontend-post-submission-manager'); ?>"/>
        </div>

    </div>
</div>