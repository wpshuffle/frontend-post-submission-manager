<?php
defined('ABSPATH') or die('No script kiddies please!!');
global $wpdb;
$payment_table = $wpdb->prefix . 'fpsm_payments';
$payments = $wpdb->get_results("SELECT * FROM $payment_table ORDER BY created_at DESC");
?>
<div class="wrap fpsm-wrap">
    <div class="fpsm-header fpsm-clearfix">
        <h1 class="fpsm-floatLeft"><?php esc_html_e('Payments', 'frontend-post-submission-manager'); ?></h1>
        <a href="<?php echo admin_url('admin.php?page=fpsm'); ?>" class="fpsm-button-primary btn-cancel"><?php esc_html_e('Back to Forms', 'frontend-post-submission-manager'); ?></a>
    </div>
    <div class="fpsm-grid-wrap">
        <div class="fpsm-title-wrap">
            <h2><?php esc_html_e('Submission Payments', 'frontend-post-submission-manager'); ?></h2>
        </div>
        <table class="wp-list-table widefat fixed">
            <thead>
                <tr>
                    <th><?php esc_html_e('Post', 'frontend-post-submission-manager'); ?></th>
                    <th><?php esc_html_e('Form Alias', 'frontend-post-submission-manager'); ?></th>
                    <th><?php esc_html_e('Amount', 'frontend-post-submission-manager'); ?></th>
                    <th><?php esc_html_e('Currency', 'frontend-post-submission-manager'); ?></th>
                    <th><?php esc_html_e('Status', 'frontend-post-submission-manager'); ?></th>
                    <th><?php esc_html_e('Order ID', 'frontend-post-submission-manager'); ?></th>
                    <th><?php esc_html_e('Capture ID', 'frontend-post-submission-manager'); ?></th>
                    <th><?php esc_html_e('Payer Email', 'frontend-post-submission-manager'); ?></th>
                    <th><?php esc_html_e('Updated', 'frontend-post-submission-manager'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($payments)) {
                    foreach ($payments as $payment) {
                        $post_title = (!empty($payment->post_id)) ? get_the_title($payment->post_id) : '-';
                        $post_edit_url = (!empty($payment->post_id)) ? admin_url('post.php?post=' . intval($payment->post_id) . '&action=edit') : '';
                        ?>
                        <tr>
                            <td>
                                <?php if ($post_edit_url) { ?>
                                    <a href="<?php echo esc_url($post_edit_url); ?>" target="_blank"><?php echo esc_html($post_title); ?></a>
                                <?php } else { ?>
                                    <?php echo esc_html($post_title); ?>
                                <?php } ?>
                            </td>
                            <td><?php echo esc_html($payment->form_alias); ?></td>
                            <td><?php echo esc_html(number_format((float) $payment->amount, 2)); ?></td>
                            <td><?php echo esc_html($payment->currency); ?></td>
                            <td><?php echo esc_html($payment->status); ?></td>
                            <td><?php echo esc_html($payment->paypal_order_id); ?></td>
                            <td><?php echo esc_html($payment->paypal_capture_id); ?></td>
                            <td><?php echo esc_html($payment->payer_email); ?></td>
                            <td><?php echo esc_html($payment->updated_at); ?></td>
                        </tr>
                    <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="9"><?php esc_html_e('No payment records found.', 'frontend-post-submission-manager'); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
