<?php
$payment_settings = (!empty($form_details['payment'])) ? $form_details['payment'] : array();
$payment_enable = (!empty($payment_settings['enable'])) ? 1 : 0;
$payment_amount = (!empty($payment_settings['amount'])) ? $payment_settings['amount'] : '';
$payment_currency = (!empty($payment_settings['currency'])) ? $payment_settings['currency'] : '';
$pre_payment_status = (!empty($payment_settings['pre_payment_status'])) ? $payment_settings['pre_payment_status'] : 'draft';
$post_payment_status = (!empty($payment_settings['post_payment_status'])) ? $payment_settings['post_payment_status'] : 'publish';
$show_payment_note = isset($payment_settings['show_payment_note']) ? intval($payment_settings['show_payment_note']) : 1;
$payment_note = (!empty($payment_settings['payment_note'])) ? $payment_settings['payment_note'] : esc_html__('A payment is required after you submit.', 'frontend-post-submission-manager');
global $fpsm_library_obj;
$post_statuses = $fpsm_library_obj->get_post_statuses();
?>
<div class="fpsm-settings-each-section" data-tab="payment" style="display:none">
    <div class="fpsm-field-wrap">
        <label><?php esc_html_e('Enable Pay to Post (PayPal)', 'frontend-post-submission-manager'); ?></label>
        <div class="fpsm-field">
            <input type="checkbox" name="form_details[payment][enable]" value="1" <?php checked($payment_enable, 1); ?> />
            <p class="description"><?php esc_html_e('Require successful PayPal payment before marking the submission complete.', 'frontend-post-submission-manager'); ?></p>
        </div>
    </div>
    <div class="fpsm-field-wrap">
        <label><?php esc_html_e('Show Payment Note', 'frontend-post-submission-manager'); ?></label>
        <div class="fpsm-field">
            <input type="checkbox" name="form_details[payment][show_payment_note]" value="1" <?php checked($show_payment_note, 1); ?> />
            <p class="description"><?php esc_html_e('Toggle the display of the payment note on the form.', 'frontend-post-submission-manager'); ?></p>
        </div>
    </div>
    <div class="fpsm-field-wrap">
        <label><?php esc_html_e('Payment Note', 'frontend-post-submission-manager'); ?></label>
        <div class="fpsm-field">
            <textarea name="form_details[payment][payment_note]"><?php echo esc_textarea($payment_note); ?></textarea>
            <p class="description"><?php esc_html_e('Message shown on the form when payment is required. You can use amount/currency in the text.', 'frontend-post-submission-manager'); ?></p>
        </div>
    </div>
    <div class="fpsm-field-wrap">
        <label><?php esc_html_e('Amount', 'frontend-post-submission-manager'); ?></label>
        <div class="fpsm-field">
            <input type="number" step="0.01" min="0" name="form_details[payment][amount]" value="<?php echo esc_attr($payment_amount); ?>" />
            <p class="description"><?php esc_html_e('Amount to charge for each submission. Leave empty or 0 to skip charging.', 'frontend-post-submission-manager'); ?></p>
        </div>
    </div>
    <div class="fpsm-field-wrap">
        <label><?php esc_html_e('Currency', 'frontend-post-submission-manager'); ?></label>
        <div class="fpsm-field">
            <input type="text" name="form_details[payment][currency]" value="<?php echo esc_attr($payment_currency); ?>" />
            <p class="description"><?php esc_html_e('3-letter currency code. If left blank, the global PayPal currency is used.', 'frontend-post-submission-manager'); ?></p>
        </div>
    </div>
    <div class="fpsm-field-wrap">
        <label><?php esc_html_e('Post Status before Payment', 'frontend-post-submission-manager'); ?></label>
        <div class="fpsm-field">
            <select name="form_details[payment][pre_payment_status]">
                <?php foreach ($post_statuses as $status_key => $status_label) { ?>
                    <option value="<?php echo esc_attr($status_key); ?>" <?php selected($pre_payment_status, $status_key); ?>><?php echo esc_html($status_label); ?></option>
                <?php } ?>
            </select>
            <p class="description"><?php esc_html_e('Status used when the post is created before payment is completed.', 'frontend-post-submission-manager'); ?></p>
        </div>
    </div>
    <div class="fpsm-field-wrap">
        <label><?php esc_html_e('Post Status after Payment', 'frontend-post-submission-manager'); ?></label>
        <div class="fpsm-field">
            <select name="form_details[payment][post_payment_status]">
                <?php foreach ($post_statuses as $status_key => $status_label) { ?>
                    <option value="<?php echo esc_attr($status_key); ?>" <?php selected($post_payment_status, $status_key); ?>><?php echo esc_html($status_label); ?></option>
                <?php } ?>
            </select>
            <p class="description"><?php esc_html_e('Status to switch to after PayPal payment succeeds.', 'frontend-post-submission-manager'); ?></p>
        </div>
    </div>
    <div class="fpsm-field-wrap">
        <label><?php esc_html_e('Notes', 'frontend-post-submission-manager'); ?></label>
        <div class="fpsm-field">
            <p class="description">
                <?php esc_html_e('PayPal credentials are configured in Global Settings. Orders are created after form submission; capture completes when the payer approves.', 'frontend-post-submission-manager'); ?>
            </p>
        </div>
    </div>
</div>
