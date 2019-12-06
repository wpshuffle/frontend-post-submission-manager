<?php
defined('ABSPATH') or die('No script kiddies please!!');

$fpsm_library_obj->print_array($form_details);
?>
<form method="post" class="fpsm-front-form">
    <?php
    /**
     * Fires at the start of form
     *
     * @since 1.0.0
     */
    do_action('fpsm_form_start', $form_row);
    if (!empty($form_details['form']['fields'])) {
        foreach ($form_details['form']['fields'] as $field_key => $field_details) {
            $fpsm_library_obj->print_array($field_details);
            $field_file = $fpsm_library_obj->generate_field_file($field_key);
            if (file_exists(FPSM_PATH . '/includes/views/frontend/form-fields/' . $field_file)) {
                // If field is enabled from the backend
                if (!empty($field_details['show_on_form'])) {
                    $field_class = $fpsm_library_obj->generate_field_class($field_key);
                    ?>
                    <div class="fpsm-field-wrap <?php echo esc_attr($field_class); ?>">
                        <label><?php echo (!empty($field_details['field_label'])) ? esc_html($field_details['field_label']) : ''; ?></label>
                        <div class="fpsm-field">
                            <?php
                            include(FPSM_PATH . '/includes/views/frontend/form-fields/' . $field_file);
                            if (!empty($field_details['field_note'])) {
                                ?>
                                <div class="fpsm-field-note"><?php echo esc_html($field_details['field_note']); ?></div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                }
            }
        }
    }
    ?>
</form>
