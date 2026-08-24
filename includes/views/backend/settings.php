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
                    <?php
                    $paypal_currencies = array(
                        'AUD' => esc_html__('Australian Dollar (AUD)', 'frontend-post-submission-manager'),
                        'BRL' => esc_html__('Brazilian Real (BRL)', 'frontend-post-submission-manager'),
                        'CAD' => esc_html__('Canadian Dollar (CAD)', 'frontend-post-submission-manager'),
                        'CNY' => esc_html__('Chinese Renminbi (CNY)', 'frontend-post-submission-manager'),
                        'CZK' => esc_html__('Czech Koruna (CZK)', 'frontend-post-submission-manager'),
                        'DKK' => esc_html__('Danish Krone (DKK)', 'frontend-post-submission-manager'),
                        'EUR' => esc_html__('Euro (EUR)', 'frontend-post-submission-manager'),
                        'HKD' => esc_html__('Hong Kong Dollar (HKD)', 'frontend-post-submission-manager'),
                        'HUF' => esc_html__('Hungarian Forint (HUF)', 'frontend-post-submission-manager'),
                        'ILS' => esc_html__('Israeli New Shekel (ILS)', 'frontend-post-submission-manager'),
                        'JPY' => esc_html__('Japanese Yen (JPY)', 'frontend-post-submission-manager'),
                        'MYR' => esc_html__('Malaysian Ringgit (MYR)', 'frontend-post-submission-manager'),
                        'MXN' => esc_html__('Mexican Peso (MXN)', 'frontend-post-submission-manager'),
                        'TWD' => esc_html__('New Taiwan Dollar (TWD)', 'frontend-post-submission-manager'),
                        'NZD' => esc_html__('New Zealand Dollar (NZD)', 'frontend-post-submission-manager'),
                        'NOK' => esc_html__('Norwegian Krone (NOK)', 'frontend-post-submission-manager'),
                        'PHP' => esc_html__('Philippine Peso (PHP)', 'frontend-post-submission-manager'),
                        'PLN' => esc_html__('Polish Zloty (PLN)', 'frontend-post-submission-manager'),
                        'GBP' => esc_html__('Pound Sterling (GBP)', 'frontend-post-submission-manager'),
                        'SGD' => esc_html__('Singapore Dollar (SGD)', 'frontend-post-submission-manager'),
                        'SEK' => esc_html__('Swedish Krona (SEK)', 'frontend-post-submission-manager'),
                        'CHF' => esc_html__('Swiss Franc (CHF)', 'frontend-post-submission-manager'),
                        'THB' => esc_html__('Thai Baht (THB)', 'frontend-post-submission-manager'),
                        'USD' => esc_html__('United States Dollar (USD)', 'frontend-post-submission-manager'),
                    );
                    $paypal_currency   = !empty($fpsm_settings['paypal_currency']) ? strtoupper($fpsm_settings['paypal_currency']) : 'USD';
                    ?>
                    <select name="fpsm_settings[paypal_currency]">
                        <?php foreach ($paypal_currencies as $currency_code => $currency_label) { ?>
                            <option value="<?php echo esc_attr($currency_code); ?>" <?php selected($paypal_currency, $currency_code); ?>><?php echo esc_html($currency_label); ?></option>
                        <?php } ?>
                    </select>
                    <p class="description"><?php esc_html_e('Choose the currency used for PayPal payments by default.', 'frontend-post-submission-manager'); ?></p>
                </div>
            </div>
        </div>
    </form>
</div>
