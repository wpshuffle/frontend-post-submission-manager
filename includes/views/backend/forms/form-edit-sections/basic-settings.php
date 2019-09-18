<?php
$form_details = (!empty($form_row->form_details)) ? $form_row->form_details : '';
$form_details = maybe_unserialize($form_details);
$basic_settings = (!empty($form_details['basic'])) ? $form_details['basic'] : array();
?>
<div class="fpsm-settings-each-section" data-tab="basic">
    <div class="fpsm-field-wrap">
        <label><?php esc_html_e('Form Status', 'frontend-post-submission-manager'); ?></label>
        <div class="fpsm-field">
                <input type="checkbox" name="form_status" value="1" <?php echo (!empty($form_row->form_status)) ? 'checked="checked"' : ''; ?>/>
        </div>
    </div>
    <div class="fpsm-field-wrap">
        <label><?php esc_html_e('Form Title', 'frontend-post-submission-manager'); ?></label>
        <div class="fpsm-field">
            <input type="text" name="form_title" value="<?php echo esc_attr($form_row->form_title); ?>"/>
        </div>
    </div>
    <div class="fpsm-field-wrap">
        <label><?php esc_html_e('Form Alias', 'frontend-post-submission-manager'); ?></label>
        <div class="fpsm-field">
            <input type="text" name="form_alias" value="<?php echo esc_attr($form_row->form_alias); ?>"/>
        </div>
    </div>

    <div class="fpsm-field-wrap">
        <label><?php esc_html_e('Post Status', 'frontend-post-submission-manager'); ?></label>
        <div class="fpsm-field">
            <select name="form_details[basic][post_status]">
                <?php
                $post_statuses = $fpsm_library_obj->get_all_post_statuses();
                $selected_post_status = (!empty($basic_settings['post_status'])) ? $basic_settings['post_status'] : 'draft';
                foreach ($post_statuses as $post_status => $post_status_label) {
                    ?>
                    <option value="<?php echo esc_attr($post_status); ?>" <?php selected($selected_post_status, $post_status); ?>><?php echo esc_attr($post_status_label); ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
    </div>
    <?php
    if (current_theme_supports('post-formats')) {
        ?>
        <div class="fpsm-field-wrap">
            <label><?php esc_html_e('Post Format', 'frontend-post-submission-manager'); ?></label>
            <div class="fpsm-field">
                <select name="form_details[basic][post_format]">
                    <?php
                    $selected_post_format = (!empty($basic_settings['post_format'])) ? $basic_settings['post_format'] : '';
                    ?>
                    <option value=""><?php esc_html_e('Standard', 'frontend-post-submission-manager'); ?></option>
                    <?php
                    $post_formats = $fpsm_library_obj->get_registered_post_formats();

                    if (is_array($post_formats[0])) {
                        foreach ($post_formats[0] as $post_format) {
                            ?>
                            <option value="<?php echo esc_attr($post_format); ?>" ><?php echo ucfirst(esc_attr($post_format)); ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
                <p class="description"><?php esc_html_e('These are the post formats registered in your current active theme.', 'frontend-post-submission-manager'); ?></p>
            </div>
        </div>
        <?php
    }
    ?>
</div>