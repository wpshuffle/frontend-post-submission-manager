<?php

defined('ABSPATH') or die('No script kiddies please!!');
if (!class_exists('FPSM_Notification')) {

    class FPSM_Notification {

        function __construct() {
            add_action('fpsm_form_submission_success', array($this, 'trigger_admin_notification'), 10, 3);
        }

        function trigger_admin_notification($insert_update_post_id, $form_row, $action) {
            if ($action == 'insert') {
                $form_details = maybe_unserialize($form_row->form_details);
                include(FPSM_PATH . '/includes/cores/admin-email-notification.php');
            }
        }

    }

    new FPSM_Notification();
}