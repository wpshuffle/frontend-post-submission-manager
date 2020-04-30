<div class="wrap fpsm-wrap">
    <div class="fpsm-header fpsm-clearfix">
        <h1 class="fpsm-floatLeft"><?php esc_html_e('Frontend Post Submission Manager', 'frontend-post-submission-manager'); ?></h1>
        <div class="fpsm-add-wrap">
            <a href="<?php echo admin_url('admin.php?page=fpsm-add-new-form'); ?>"><input type="button" class="fpsm-button-primary" value="<?php echo esc_html_e('Add New Form', 'frontend-post-submission-manager'); ?>"></a>
        </div>
    </div>

    <div class="fpsm-block-wrap">
        <div class="fpsm-content-block">
            <h2><?php esc_html_e('Documentation', 'frontend-post-submission-manager'); ?></h2>
            <p><?php esc_html_e('You can check our detailed documentation from below link.', 'frontend-post-submission-manager'); ?></p>
            <p><a href="http://wpshuffle.com/wordpress-documentations/frontend-post-submission-manager" target="_blank">http://wpshuffle.com/wordpress-documentations/frontend-post-submission-manager</a></p>
        </div>
        <div class="fpsm-content-block">
            <h2><?php esc_html_e('Developer Documentation', 'frontend-post-submission-manager'); ?></h2>
            <p><?php esc_html_e('If you are developer and trying to add any functionality or customize our plugin through hooks then below are the list of actions and filters available in the plugin.', 'frontend-post-submission-manager'); ?></p>
        </div>
        <div class="fpsm-content-block">
            <h2><?php esc_html_e('Available Actions', 'frontend-post-submission-manager'); ?></h2>
            <div class="fpsm-hooks-wrap">
                <pre>
/**
* Fires on init hook
*
* @since 1.0.0
*/
do_action('fpsm_init');
                </pre>
                <pre>
/**
* Fires when the successful form submission is complete
*
* @param int $insert_update_post_id
* @param array $form_row
* @param string $action
*/
do_action( 'fpsm_form_submission_success', $insert_update_post_id, $form_row, $action );
                </pre>
                <pre>
/**
* Fires at the end of all the custom field option has been printed
*
* @param type string $field_key
* @param type array $field_details
*
* @since 1.0.0
*/
do_action('fpsm_custom_field_admin_end', $field_key, $field_details);
                </pre>
                <pre>
/**
* Fires while building the nav
*
* @since 1.0.0
*/
do_action('fpsm_form_nav');
                </pre>
                <pre>
/**
* Fires on start of the form sections
*
* @since 1.0.0
*
* @param array $form_row
*
*/
do_action('fpsm_form_sections_start', $form_row);
                </pre>
                <pre>
/**
* Fires on end of the form sections
*
* @since 1.0.0
*
* @param array $form_row
*
*/
do_action('fpsm_form_sections_end', $form_row);
                </pre>
                <pre>
/**
* Fires at the start of form
*
* @since 1.0.0
*/
do_action( 'fpsm_form_start', $form_row );
                </pre>
                <pre>
/**
* Fires at the end of form
*
* @since 1.0.0
*/
do_action('fpsm_form_end', $form_row);
                </pre>
            </div>
        </div>
        <div class="fpsm-content-block">
            <h2><?php esc_html_e('Our Plugins', 'frontend-post-submission-manager'); ?></h2>
            <a href="https://wpshuffle.com/wordpress-plugins">https://wpshuffle.com/wordpress-plugins/</a>
        </div>
        <div class="fpsm-content-block">
            <h2><?php esc_html_e('Our Themes', 'frontend-post-submission-manager'); ?></h2>
            <a href="https://wpshuffle.com/wordpress-themes">https://wpshuffle.com/wordpress-themes/</a>
        </div>


    </div>
</div>