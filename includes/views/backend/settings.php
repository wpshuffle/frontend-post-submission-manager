<?php
defined('ABSPATH') or die('No script kiddies please!!');
global $fpsm_library_obj;
$fpsm_settings = get_option('fpsm_settings');
?>
<div class="wrap fpsm-wrap">
    <div class="fpsm-header fpsm-clearfix">
        <h1 class="fpsm-floatLeft"><?php esc_html_e('Frontend Post Submission Manager', 'frontend-post-submission-manager'); ?></h1>
        <div class="fpsm-add-wrap">
            <input type="button" value="<?php esc_html_e('Save Settings', 'frontend-post-submission-manager'); ?>" class="fpsm-primary-button fpsm-form-save" data-form="fpsm-settings-form" />
            <a href="<?php echo admin_url('admin.php?page=fpsm'); ?>" class="fpsm-button-primary btn-cancel">Cancel</a>
        </div>
    </div>
    <form class="fpsm-form fpsm-settings-form">
        <h2 class="fpsm-floatRight"><?php esc_html_e('Global Settings', 'frontend-post-submission-manager'); ?></h2>
        <div class="fpsm-form-element-wrap">
            <div class="fpsm-field-wrap">
                <label><?php esc_html_e('Disable Fontawesome', 'frontend-post-submission-manager'); ?></label>
                <div class="fpsm-field">
                    <input type="checkbox" name="fpsm_settings[disable_fontawesome]" value="1" <?php echo (!empty($fpsm_settings['disable_fontawesome'])) ? 'checked="checked"' : ''; ?> />
                    <p class="description"><?php esc_html_e('Please check if you want to disable fontawesome being loaded from our plugin.', 'frontend-post-submission-manager'); ?></p>
                </div>
            </div>
            <div class="fpsm-field-wrap">
                <label><?php esc_html_e('Disable jQuery UI CSS', 'frontend-post-submission-manager'); ?></label>
                <div class="fpsm-field">
                    <input type="checkbox" name="fpsm_settings[disable_jquery_ui_css]" value="1" <?php echo (!empty($fpsm_settings['disable_jquery_ui_css'])) ? 'checked="checked"' : ''; ?> />
                    <p class="description"><?php esc_html_e('Please check if you want to disable the jQuery UI css being used for datepicker.', 'frontend-post-submission-manager'); ?></p>
                </div>
            </div>
            <div class="fpsm-field-wrap">
                <label><?php esc_html_e('Disable "Are you sure?" JS', 'frontend-post-submission-manager'); ?></label>
                <div class="fpsm-field">
                    <input type="checkbox" name="fpsm_settings[disable_are_you_sure_js]" value="1" <?php echo (!empty($fpsm_settings['disable_are_you_sure_js'])) ? 'checked="checked"' : ''; ?> />
                    <p class="description"><?php esc_html_e('Please check if you want to disable "Are you sure" js which is being used to prevent user from leaving the browser without saving or submitting the form after entering or changing some data in the form.', 'frontend-post-submission-manager'); ?></p>
                </div>
            </div>
            <h3><?php esc_html_e('PayPal Settings', 'frontend-post-submission-manager'); ?></h3>
            <div class="fpsm-field-wrap">
                <label><?php esc_html_e('Mode', 'frontend-post-submission-manager'); ?></label>
                <div class="fpsm-field">
                    <select name="fpsm_settings[paypal_mode]">
                        <option value="sandbox" <?php selected('sandbox', (!empty($fpsm_settings['paypal_mode']) ? $fpsm_settings['paypal_mode'] : 'sandbox')); ?>><?php esc_html_e('Sandbox', 'frontend-post-submission-manager'); ?></option>
                        <option value="live" <?php selected('live', (!empty($fpsm_settings['paypal_mode']) ? $fpsm_settings['paypal_mode'] : 'sandbox')); ?>><?php esc_html_e('Live', 'frontend-post-submission-manager'); ?></option>
                    </select>
                    <p class="description"><?php esc_html_e('Choose Sandbox while testing and switch to Live for production.', 'frontend-post-submission-manager'); ?></p>
                </div>
            </div>
            <div class="fpsm-field-wrap">
                <label><?php esc_html_e('Client ID', 'frontend-post-submission-manager'); ?></label>
                <div class="fpsm-field">
                    <input type="text" name="fpsm_settings[paypal_client_id]" value="<?php echo (!empty($fpsm_settings['paypal_client_id'])) ? esc_attr($fpsm_settings['paypal_client_id']) : ''; ?>" />
                    <p class="description">
                        <?php
                        printf(
                            /* translators: %s: PayPal developer apps URL */
                            wp_kses_post(__('Generate REST credentials from your PayPal Developer Dashboard > Apps & Credentials: <a href="%s" target="_blank">https://developer.paypal.com/dashboard/applications</a>', 'frontend-post-submission-manager')),
                            esc_url('https://developer.paypal.com/dashboard/applications')
                        );
                        ?>
                    </p>
                </div>
            </div>
            <div class="fpsm-field-wrap">
                <label><?php esc_html_e('Secret', 'frontend-post-submission-manager'); ?></label>
                <div class="fpsm-field">
                    <input type="password" name="fpsm_settings[paypal_secret]" value="<?php echo (!empty($fpsm_settings['paypal_secret'])) ? esc_attr($fpsm_settings['paypal_secret']) : ''; ?>" autocomplete="new-password" />
                    <p class="description"><?php esc_html_e('Stored in wp_options; ensure only trusted admins can access these settings. Secret is found alongside your Client ID in the PayPal app.', 'frontend-post-submission-manager'); ?></p>
                </div>
            </div>
            <div class="fpsm-field-wrap">
                <label><?php esc_html_e('Default Currency', 'frontend-post-submission-manager'); ?></label>
                <div class="fpsm-field">
                    <input type="text" name="fpsm_settings[paypal_currency]" value="<?php echo (!empty($fpsm_settings['paypal_currency'])) ? esc_attr($fpsm_settings['paypal_currency']) : 'USD'; ?>" />
                    <p class="description"><?php esc_html_e('ISO currency code, e.g. USD, EUR, GBP.', 'frontend-post-submission-manager'); ?></p>
                </div>
            </div>
        </div>
    </form>
</div>
