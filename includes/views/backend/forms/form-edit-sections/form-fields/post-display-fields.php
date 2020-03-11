<div class="fpsm-show-fields-ref-<?php echo (!empty($show_hide_toggle_class)) ? esc_attr($show_hide_toggle_class) : esc_attr($field_key); ?> <?php echo (empty($field_details['show_on_form'])) ? 'fpsm-display-none' : ''; ?>">
    <div class="fpsm-field-wrap">
        <label><?php esc_html_e('Post Detail Display', 'frontend-post-submission-manager'); ?></label>
        <div class="fpsm-field">
            <input type="checkbox" name="<?php echo esc_attr($field_name_prefix) ?>[post_detail_display]" value="1" <?php echo (!empty($field_details['post_detail_display'])) ? 'checked="checked"' : ''; ?> class="fpsm-checkbox-toggle-trigger" data-toggle-class="fpsm-post-detail-display-ref-<?php echo esc_attr($show_hide_toggle_class); ?>"/>
            <p class="description"><?php esc_html_e('Please check if you want to display this field received value in the frontend post detail page.', 'frontend-post-submission-manager'); ?></p>
        </div>
    </div>
    <div class="fpsm-post-detail-display-ref-<?php echo esc_attr($show_hide_toggle_class); ?> <?php echo (empty($field_details['post_detail_display'])) ? 'fpsm-display-none' : ''; ?>">
        <div class="fpsm-field-wrap">
            <label><?php esc_html_e('Display Position', 'frontend-post-submission-manager'); ?></label>
            <div class="fpsm-field">
                <select name="<?php echo esc_attr($field_name_prefix) ?>[display_position]">
                    <?php
                    $selected_display_position = (!empty($field_details['display_position'])) ? $field_details['display_position'] : 'after_content';
                    ?>
                    <option value="after_content" <?php selected($selected_display_position, 'after_content'); ?>><?php esc_html_e('After Content', 'frontend-post-submission-manager'); ?></option>
                    <option value="before_content" <?php selected($selected_display_position, 'before_content'); ?>><?php esc_html_e('Before Content', 'frontend-post-submission-manager'); ?></option>
                </select>

            </div>
        </div>
        <div class="fpsm-field-wrap">
            <label><?php esc_html_e('Display Label', 'frontend-post-submission-manager'); ?></label>
            <div class="fpsm-field">
                <input type="text" name="<?php echo esc_attr($field_name_prefix) ?>[display_label]" value="<?php echo (!empty($field_details['display_label'])) ? esc_attr($field_details['display_label']) : ''; ?>"/>
            </div>
        </div>
        <?php
        if ($field_details['field_type'] == 'file_uploader') {
            ?>
            <div class="fpsm-field-wrap">
                <label><?php esc_html_e('Open in new tab', 'frontend-post-submission-manager'); ?></label>
                <div class="fpsm-field">
                    <input type="checkbox" name="<?php echo esc_attr($field_name_prefix) ?>[open_in_new_tab]" value="1" <?php echo (!empty($field_details['open_in_new_tab'])) ? 'checked="checked"' : ''; ?>/>
                    <p class="description"><?php esc_html_e('Please check if you want to open the link in new tab.', 'frontend-post-submission-manager'); ?></p>
                </div>
            </div>
            <div class="fpsm-field-wrap">
                <label><?php esc_html_e('Image Size', 'frontend-post-submission-manager'); ?></label>
                <div class="fpsm-field">
                    <select name="<?php echo esc_attr($field_name_prefix) ?>[image_size]">
                        <?php
                        $selected_image_size = (!empty($field_details['image_size'])) ? $field_details['image_size'] : 'thumbnail';
                        $image_sizes = get_intermediate_image_sizes();
                        foreach ($image_sizes as $image_size) {
                            ?>
                            <option value="<?php echo esc_attr($image_size); ?>" <?php selected($selected_image_size, $image_size); ?>><?php echo esc_html($image_size); ?></option>
                            <?php
                        }
                        ?>

                    </select>
                    <p class="description"><?php esc_html_e('Please choose any desired image size from the list to display only if you are also receiving the images from this file uploader.', 'frontend-post-submission-manager'); ?></p>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>