<?php
$layout_settings = (!empty($form_details['layout'])) ? $form_details['layout'] : array();
?>
<div class="fpsm-settings-each-section fpsm-display-none" data-tab="layout">
    <div class="fpsm-field-wrap">
        <label><?php esc_html_e('Form Template', 'frontend-post-submission-manager'); ?></label>
        <div class="fpsm-field">
            <select name="form_details[layout][template]">
                <?php
                $selected_template = (!empty($layout_settings['template'])) ? $layout_settings['template'] : 'template-1';
                for ($i = 1; $i <= 22; $i++) {
                    ?>
                    <option value="template-<?php echo intval($i); ?>" <?php selected($selected_template, 'template-' . $i); ?>><?php esc_html_e(sprintf('Template %d', $i), 'frontend-post-submission-manager'); ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
    </div>
</div>