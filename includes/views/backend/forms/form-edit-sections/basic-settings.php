<div class="fpsm-settings-each-section" data-tab="basic">
    <div class="fpsm-field-wrap">
        <label><?php esc_html_e('Form Status', 'frontend-post-submission-manager'); ?></label>
        <div class="fpsm-field">
            <input type="checkbox" name="form_status" value="1"/>
        </div>
    </div>
    <div class="fpsm-field-wrap">
        <label><?php esc_html_e('Form Title', 'frontend-post-submission-manager'); ?></label>
        <div class="fpsm-field">
            <input type="text" name="form_title"/>
        </div>
    </div>
    <div class="fpsm-field-wrap">
        <label><?php esc_html_e('Form Alias', 'frontend-post-submission-manager'); ?></label>
        <div class="fpsm-field">
            <input type="text" name="form_alias"/>
        </div>
    </div>

    <div class="fpsm-field-wrap">
        <label><?php esc_html_e('Post Status', 'frontend-post-submission-manager'); ?></label>
        <div class="fpsm-field">
            <select name="form_details[general][post_status]">
                <?php
                $post_statuses = $fpsm_library_obj->get_all_post_statuses();
                foreach ($post_statuses as $post_status => $post_status_label) {
                    ?>
                    <option value="<?php echo $post_status; ?>"><?php echo esc_attr($post_status_label); ?></option>
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
                <select name="form_details[general][post_format]">
                    <option value=""><?php esc_html_e('Standard', 'frontend-post-submission-manager'); ?></option>
                    <?php
                    $post_formats = $fpsm_library_obj->get_registered_post_formats();
                    if (is_array($post_formats[0])) {
                        foreach ($post_formats[0] as $post_format) {
                            ?>
                            <option value="<?php echo $post_format; ?>" ><?php echo ucfirst(esc_attr($post_format)); ?></option>
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