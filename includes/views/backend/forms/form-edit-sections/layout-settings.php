<?php
$layout_settings = (!empty($form_details['layout'])) ? $form_details['layout'] : array();
$selected_template = (!empty($layout_settings['template'])) ? $layout_settings['template'] : 'template-1';
$template_background_image = (!empty($layout_settings['template_background_image'])) ? $layout_settings['template_background_image'] : '';
$template_background_image_id = (!empty($layout_settings['template_background_image_id'])) ? intval($layout_settings['template_background_image_id']) : '';
$template_background_image_templates = array('template-29', 'template-35');
?>
<div class="fpsm-settings-each-section fpsm-display-none" data-tab="layout">
    <div class="fpsm-field-wrap">
        <label><?php esc_html_e('Form Template', 'frontend-post-submission-manager'); ?></label>
        <div class="fpsm-field">
            <select name="form_details[layout][template]" class="fpsm-form-template fpsm-toggle-trigger" data-toggle-class="fpsm-template-background-image-ref">
                <?php
                for ($i = 1; $i <= 35; $i++) {
                    ?>
                    <option value="template-<?php echo intval($i); ?>" <?php selected($selected_template, 'template-' . $i); ?>><?php esc_html_e(sprintf('Template %d', $i), 'frontend-post-submission-manager'); ?></option>
                    <?php
                }
                ?>
            </select>
            <div class="fpsm-form-template-preview">
                <?php
                for ($i = 1; $i <= 35; $i++) {
                    ?>
                    <img src="<?php echo FPSM_URL . '/assets/images/form-template-previews/template-' . $i . '.jpg'; ?>" data-template-id="<?php echo 'template-' . $i; ?>" class="fpsm-form-template-preview-img <?php echo ($selected_template != 'template-' . $i) ? 'fpsm-display-none' : ''; ?>" loading="lazy"/>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <div class="fpsm-field-wrap fpsm-template-background-image-ref <?php echo (!in_array($selected_template, $template_background_image_templates)) ? 'fpsm-display-none' : ''; ?>" data-toggle-ref="template-29|template-35">
        <label><?php esc_html_e('Template Background Image', 'frontend-post-submission-manager'); ?></label>
        <div class="fpsm-field">
            <input type="text" name="form_details[layout][template_background_image]" value="<?php echo esc_url($template_background_image); ?>"/>
            <input type="hidden" name="form_details[layout][template_background_image_id]" value="<?php echo esc_attr($template_background_image_id); ?>"/>
            <input type="button" class="fpsm-media-uploader button-secondary" value="<?php esc_html_e('Upload Image', 'frontend-post-submission-manager'); ?>"/>
            <p class="description"><?php esc_html_e('This image replaces the default image used by Template 29 and Template 35.', 'frontend-post-submission-manager'); ?></p>
            <div class="fpsm-media-preview">
                <?php
                if (!empty($template_background_image)) {
                    $thumbnail_url = (!empty($template_background_image_id)) ? wp_get_attachment_image_src($template_background_image_id, 'thumbnail') : false;
                    $preview_url = (!empty($thumbnail_url[0])) ? $thumbnail_url[0] : $template_background_image;
                    ?>
                    <img src="<?php echo esc_url($preview_url); ?>"/>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <div class="fpsm-field-wrap">
        <label><?php esc_html_e('Custom Fields Display Template', 'frontend-post-submission-manager'); ?></label>
        <div class="fpsm-field">
            <select name="form_details[layout][custom_field_display_template]" class="fpsm-custom-field-template-trigger">
                <?php
                $selected_template = (!empty($layout_settings['custom_field_display_template'])) ? $layout_settings['custom_field_display_template'] : 'template-1';
                for ($i = 1; $i <= 6; $i++) {
                    ?>
                    <option value="template-<?php echo intval($i); ?>" <?php selected($selected_template, 'template-' . $i); ?>><?php esc_html_e(sprintf('Template %d', $i), 'frontend-post-submission-manager'); ?></option>
                    <?php
                }
                ?>
            </select>
            <div class="fpsm-post-template-preview">
                <?php
                for ($i = 1; $i <= 6; $i++) {
                    ?>
                    <img src="<?php echo FPSM_URL . '/assets/images/post-field-previews/template-' . $i . '.jpg'; ?>" data-template-id="<?php echo 'template-' . $i; ?>" class="fpsm-post-template-preview-img <?php echo ($selected_template != 'template-' . $i) ? 'fpsm-display-none' : ''; ?>" loading="lazy"/>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
