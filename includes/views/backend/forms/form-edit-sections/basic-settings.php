<?php
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
    if ($form_row->form_type == 'guest') {
        ?>
        <div class="fpsm-field-wrap">
            <label><?php esc_html_e('Post Author', 'frontend-post-submission-manager'); ?></label>
            <div class="fpsm-field">
                <select name="form_details[basic][post_author]">
                    <?php
                    $user_args = array(
                        'role__in' => array('administrator', 'author', 'editor', 'contributor'),
                        'orderby' => 'user_login',
                        'order' => 'ASC',
                        'fields' => array('ID', 'user_login'),
                        'number' => 100
                    );
                    /**
                     * Filters user arguments while fetching the users
                     *
                     * @param array $user_args
                     *
                     * @since 1.0.0
                     */
                    $user_args = apply_filters('fpsm_user_list_args', $user_args);
                    $users = $fpsm_library_obj->get_users($user_args);
                    $selected_post_author = (!empty($basic_settings['post_author'])) ? intval($basic_settings['post_author']) : $fpsm_library_obj->get_first_author();
                    if (!empty($users)) {
                        foreach ($users as $user) {
                            ?>
                            <option value="<?php echo intval($user->ID); ?>"><?php echo esc_html($user->user_login); ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>
        </div>
    <?php } ?>
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
    <div class="fpsm-field-wrap">
        <label><?php esc_html_e('Validation Error Message', 'frontend-post-submission-manager'); ?></label>
        <div class="fpsm-field">
            <textarea name="form_details[basic][validation_error_message]"><?php echo (!empty($basic_settings['validation_error_message'])) ? esc_html($basic_settings['validation_error_message']) : ''; ?></textarea>
            <p class="description"><?php esc_html_e('This message will be shown when any validation error occurs.', 'frontend-post-submission-manager'); ?></p>
        </div>
    </div>
    <div class="fpsm-field-wrap">
        <label><?php esc_html_e('Form Success Message', 'frontend-post-submission-manager'); ?></label>
        <div class="fpsm-field">
            <textarea name="form_details[basic][form_success_message]"><?php echo (!empty($basic_settings['form_success_message'])) ? esc_html($basic_settings['form_success_message']) : ''; ?></textarea>
            <p class="description"><?php esc_html_e('This message will be shown after successful form submission', 'frontend-post-submission-manager'); ?></p>
        </div>
    </div>

    <div class="fpsm-field-wrap">
        <label><?php esc_html_e('Redirection', 'frontend-post-submission-manager'); ?></label>
        <div class="fpsm-field">
            <input type="checkbox" name="form_details[basic][redirection]" value="1" <?php echo (!empty($basic_settings['redirection'])) ? 'checked="checked"' : ''; ?> class="fpsm-checkbox-toggle-trigger" data-toggle-class="fpsm-redirection-type"/>
        </div>
    </div>
    <div class="fpsm-redirection-type <?php echo (empty($basic_settings['redirection'])) ? 'fpsm-display-none' : ''; ?>" >
        <div class="fpsm-field-wrap">
            <label><?php esc_html_e('Redirection Type', 'frontend-post-submission-manager'); ?></label>
            <div class="fpsm-field">
                <?php
                $selected_redirection_type = (!empty($basic_settings['redirection_type'])) ? $basic_settings['redirection_type'] : 'url';
                ?>
                <select name="form_details[basic][redirection_type]" class="fpsm-toggle-trigger" data-toggle-class="fpsm-redirection-url">
                    <option value="url" <?php selected($selected_redirection_type, 'url'); ?>><?php esc_html_e('URL', 'frontend-post-submission-manager'); ?></option>
                    <option value="published_post" <?php selected($selected_redirection_type, 'published_post'); ?>><?php esc_html_e('Published Post', 'frontend-post-submission-manager'); ?></option>
                </select>
            </div>
        </div>
        <div class="fpsm-field-wrap fpsm-redirection-url <?php echo ($selected_redirection_type != 'url') ? 'fpsm-display-none' : ''; ?>" data-toggle-ref="url">
            <label><?php esc_html_e('Redirection URL', 'frontend-post-submission-manager'); ?></label>
            <div class="fpsm-field">
                <input type="text" name="form_details[basic][redirection_url]" value="<?php echo (!empty($basic_settings['redirection_url'])) ? esc_url($basic_settings['redirection_url']) : ''; ?>"/>
            </div>
        </div>
    </div>
</div>