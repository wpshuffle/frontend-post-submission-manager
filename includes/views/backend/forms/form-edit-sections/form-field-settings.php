<?php
$form_settings = (!empty($form_details['form'])) ? $form_details['form'] : array();
?>
<div class="fpsm-settings-each-section fpsm-display-none" data-tab="form">
    <div class="fpsm-custom-field-add-form">
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
            </div>
        </div>
        <div class="fpsm-field-wrap">
            <label><?php esc_html_e('Field Type', 'frontend-post-submission-manager'); ?></label>
            <div class="fpsm-field">
                <select id="fpsm-custom-field-type">
                    <?php
                    $custom_field_type_list = array(
                        'textfield' => esc_html__('Texfield', 'frontend-post-submission-manager'),
                        'textarea' => esc_html__('Textarea', 'frontend-post-submission-manager'),
                        'select' => esc_html__('Select Dropdown', 'frontend-post-submission-manager'),
                        'checkbox' => esc_html__('Checkbox', 'frontend-post-submission-manager'),
                        'radio' => esc_html__('Radio Button', 'frontend-post-submission-manager'),
                        'number' => esc_html__('Number', 'frontend-post-submission-manager'),
                        'email' => esc_html__('Email', 'frontend-post-submission-manager'),
                        'datepicker' => esc_html__('Datepicker', 'frontend-post-submission-manager'),
                        'file_uploader' => esc_html__('File Uploader', 'frontend-post-submission-manager'),
                    );
                    /**
                     * Filters custom field type list
                     *
                     * @param array $custom_field_type_list
                     *
                     * @since 1.0.0
                     */
                    $custom_field_type_list = apply_filters('fpsm_custom_field_type_list', $custom_field_type_list);
                    foreach ($custom_field_type_list as $custom_field_type => $custom_field_label) {
                        ?>
                        <option value="<?php echo esc_attr($custom_field_type); ?>"><?php echo esc_html($custom_field_label); ?></option>
                        <?php
                    }
                    ?>

                </select>
            </div>
        </div>
        <div class="fpsm-field-wrap">
            <label></label>
            <div class="fpsm-field">
                <input type="button" class="fpsm-button-secondary fpsm-custom-field-add-trigger" value="<?php esc_attr_e('Add', 'frontend-post-submission-manager'); ?>"/>
            </div>

        </div>
    </div>
    <div class="fpsm-form-fields-wrap">
        <?php
        $post_type = $form_row->post_type;
        $form_type = $form_row->form_type;
        $form_fields = (!empty($form_settings['fields'])) ? $form_settings['fields'] : $fpsm_library_obj->get_default_fields($post_type, $form_type);
        //$fpsm_library_obj->print_array($form_fields);
        foreach ($form_fields as $field_key => $field_details) {
            $field_file = $fpsm_library_obj->generate_field_file($field_key);
            if (file_exists(FPSM_PATH . '/includes/views/backend/forms/form-edit-sections/form-fields/' . $field_file)) {
                include(FPSM_PATH . '/includes/views/backend/forms/form-edit-sections/form-fields/' . $field_file);
            }
        }
        ?>
    </div>
</div>