<?php
defined('ABSPATH') or die('No script kiddies please!!');
global $fpsm_library_obj;
?>
<div class="wrap fpsm-wrap">
    <div class="fpsm-header fpsm-clearfix">
        <h1 class="fpsm-floatLeft"><?php esc_html_e('Frontend Post Submission Manager', 'frontend-post-submission-manager'); ?></h1>
        <div class="fpsm-add-wrap">
        <input type="submit" value="<?php esc_html_e('Save Form', 'subscribe-to-download'); ?>"
               class="fpsm-primary-button"/>
            <a href="#" class="fpsm-button-primary btn-cancel">Cancel</a>
        </div>
    </div>
    <form class="fpsm-form">
        <h2 class="fpsm-floatRight"><?php esc_html_e('Add New Form', 'frontend-post-submission-manager'); ?></h2>
        <div class="fpsm-form-element-wrap">
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
                <label><?php esc_html_e('Post Type', 'frontend-post-submission-manager'); ?></label>
                <div class="fpsm-field">
                    <select name="post_type">
                        <?php
                        $post_types = $fpsm_library_obj->get_registered_post_types();
                        if (!empty($post_types)) {
                            foreach ($post_types as $post_type) {
                                ?>
                                <option value="<?php echo esc_attr($post_type->name); ?>"><?php echo esc_html($post_type->label); ?></option>

                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="fpsm-field-wrap">
                <label><?php esc_html_e('Form Type', 'frontend-post-submission-manager'); ?></label>
                <div class="fpsm-field">
                    <select name="form_type">
                        <option value="login_require"><?php esc_html_e('Login require form', 'subscribe-to-download'); ?></option>
                        <option value="guest"><?php esc_html_e('Guest form', 'subscribe-to-download'); ?></option>
                    </select>
                </div>
            </div>
            <div class="fpsm-field-wrap">
                <label></label>
                <div class="fpsm-field">

                </div>
            </div>
        </div>
    </form>
</div>