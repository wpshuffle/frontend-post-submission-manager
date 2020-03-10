<?php

defined('ABSPATH') or die('No script kiddies please!!');
if (!class_exists('FPSM_Notification')) {

    class FPSM_Notification {

        function __construct() {
            add_action('fpsm_form_submission_success', array($this, 'trigger_admin_notification'), 10, 3);
            add_action('wp_trash_post', array($this, 'trigger_post_reject_notifications'));
        }

        function trigger_admin_notification($insert_update_post_id, $form_row, $action) {
            if ($action == 'insert') {
                $form_details = maybe_unserialize($form_row->form_details);
                include(FPSM_PATH . '/includes/cores/admin-email-notification.php');
            }
        }

        function trigger_post_reject_notifications($post_id) {
            $form_alias = get_post_meta($post_id, '_fpsm_form_alias', true);
            if (empty($form_alias)) {
                return;
            }
            global $fpsm_library_obj;
            $form_row = $fpsm_library_obj->get_form_row_by_alias($form_alias);
            $form_details = maybe_unserialize($form_row->form_details);
        }

    }

    new FPSM_Notification();
}