<?php
defined('ABSPATH') or die('No script kiddies please!!');
if (isset($_GET['debug'])) {
    $fpsm_library_obj->print_array($form_details);
}
$form_template = (!empty($form_details['layout']['template'])) ? $form_details['layout']['template'] : 'template-1';
?>
<form method="post" class="fpsm-front-form fpsm-<?php echo esc_attr($form_template); ?>" data-alias="<?php echo esc_attr($form_row->form_alias); ?>">
    <input type="hidden" name="form_alias" value="<?php echo esc_attr($form_row->form_alias); ?>"/>
    <?php
    /**
     * Fires at the start of form
     *
     * @since 1.0.0
     */
    do_action('fpsm_form_start', $form_row);
    if (!empty($form_details['form']['fields'])) {
        foreach ($form_details['form']['fields'] as $field_key => $field_details) {

            $field_file = $fpsm_library_obj->generate_field_file($field_key);
            if (file_exists(FPSM_PATH . '/includes/views/frontend/form-fields/front-' . $field_file)) {
                // If field is enabled from the backend
                if (!empty($field_details['show_on_form'])) {
                    //  $fpsm_library_obj->print_array($field_details);
                    $field_class = $fpsm_library_obj->generate_field_class($field_key);
                    if ($fpsm_library_obj->is_taxonomy_key($field_key)) {
                        $field_type = $field_details['field_type'];
                        $field_type_class = ' fpsm-taxonomy-' . $field_type;
                    } else if ($fpsm_library_obj->is_custom_field_key($field_key)) {
                        $field_type = $field_details['field_type'];
                        $field_type_class = ' fpsm-custom-field-' . $field_type;
                    } else {
                        $field_type_class = '';
                    }
                    ?>
                    <div class="fpsm-field-wrap<?php echo esc_attr($field_type_class); ?> <?php echo esc_attr($field_class); ?>" data-field-key="<?php echo esc_attr($field_key); ?>">
                        <label><?php echo (!empty($field_details['field_label'])) ? esc_html($field_details['field_label']) : ''; ?></label>
                        <div class="fpsm-field">
                            <?php
                            include(FPSM_PATH . '/includes/views/frontend/form-fields/front-' . $field_file);
                            if (!empty($field_details['field_note'])) {
                                ?>
                                <div class="fpsm-field-note"><?php echo esc_html($field_details['field_note']); ?></div>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="fpsm-error"></div>
                    </div>
                    <?php
                }
            }
        }
    }
    ?>
    <div class="fpsm-field-wrap fpsm-has-submit-btn">
        <div class="fpsm-field">
            <input type="submit" value="<?php echo (!empty($form_details['form']['submit_button_label'])) ? esc_attr($form_details['form']['submit_button_label']) : esc_html__('Submit', 'frontend-post-submission-manager'); ?>"/>
            <img src="<?php echo FPSM_URL . '/assets/images/ajax-loader-front.gif'; ?>" class="fpsm-ajax-loader"/>
        </div>
    </div>
    <div class="fpsm-form-message fpsm-display-none"></div>
</form>
