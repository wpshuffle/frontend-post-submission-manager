<?php
$form_settings = (!empty($form_details['form'])) ? $form_details['form'] : array();
?>
<div class="fpsm-settings-each-section fpsm-display-none fpsm-clearfix" data-tab="form">
    <div class="fpsm-form-fields-wrap fpsm-sortable">
        <?php
        $post_type = $form_row->post_type;
        $form_type = $form_row->form_type;
        $form_fields = (!empty($form_settings['fields'])) ? $form_settings['fields'] : $fpsm_library_obj->get_default_fields($post_type, $form_type);
        // $fpsm_library_obj->print_array($form_fields);
        foreach ($form_fields as $field_key => $field_details) {
            $field_file = $fpsm_library_obj->generate_field_file($field_key);
            if (file_exists(FPSM_PATH . '/includes/views/backend/forms/form-edit-sections/form-fields/' . $field_file)) {
                $field_name = "form_details[form][fields][$field_key]";
                include(FPSM_PATH . '/includes/views/backend/forms/form-edit-sections/form-fields/' . $field_file);
            }
        }
        ?>
    </div>

    <?php include(FPSM_PATH . '/includes/views/backend/forms/form-edit-sections/custom-field-add-form.php'); ?>
</div>