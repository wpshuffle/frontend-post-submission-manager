<?php

defined('ABSPATH') or die('No script kiddies please!!');
if (!class_exists('FPSM_Admin')) {

    class FPSM_Admin {

        function __construct() {
            add_action('admin_menu', array($this, 'add_admin_menus'));
            add_action('admin_footer', array($this, 'add_extra_html'));
        }

        function add_admin_menus() {
            add_menu_page(esc_html__('Frontend Post Submission', 'frontend-post-submission-manager'), esc_html__('Frontend Post Submission', 'frontend-post-submission-manager'), 'manage_options', 'fpsm', array($this, 'form_lists'), 'dashicons-format-aside');
            add_submenu_page('fpsm', esc_html__('All Forms', 'frontend-post-submission-manager'), esc_html__('All Forms', 'frontend-post-submission-manager'), 'manage_options', 'fpsm', array($this, 'form_lists'));
            add_submenu_page('fpsm', esc_html__('Add New Form', 'frontend-post-submission-manager'), esc_html__('Add New Form', 'frontend-post-submission-manager'), 'manage_options', 'fpsm-add-new-form', array($this, 'form_adder'));
        }

        function form_lists() {
            if (isset($_GET['action'])) {
                $action = $_GET['action'];
                switch ($action) {
                    case 'edit_form':
                        include(FPSM_PATH . '/includes/views/backend/forms/form-edit.php');
                        break;
                }
            } else {
                include(FPSM_PATH . '/includes/views/backend/forms/form-list.php');
            }
        }

        function form_adder() {
            include(FPSM_PATH . '/includes/views/backend/forms/form-add.php');
        }

        function add_extra_html() {
            include(FPSM_PATH . '/includes/views/backend/admin-footer.php');
        }

    }

    new FPSM_Admin();
}