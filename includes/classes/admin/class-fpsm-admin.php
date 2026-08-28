<?php

defined('ABSPATH') or die('No script kiddies please!!');
if (!class_exists('FPSM_Admin')) {

    class FPSM_Admin {

        function __construct() {
            add_action('admin_menu', array($this, 'add_admin_menus'));
            add_action('admin_enqueue_scripts', array($this, 'enqueue_quick_start_assets'));
            add_action('admin_post_fpsm_dismiss_quick_start', array($this, 'dismiss_quick_start_panel'));
            add_action('admin_footer', array($this, 'add_extra_html'));
        }

        /**
         * Load Quick Start styles only on the FPSM Forms screen.
         *
         * @param string $hook_suffix Current admin page hook.
         * @since 1.5.2
         */
        function enqueue_quick_start_assets($hook_suffix) {
            if ('toplevel_page_fpsm' !== $hook_suffix || !empty($_GET['action'])) {
                return;
            }

            wp_enqueue_style(
                'fpsm-quick-start',
                FPSM_URL . '/assets/css/fpsm-quick-start.css',
                array(),
                '1.5.1'
            );
        }

        /**
         * Render the onboarding panel for administrators who have not created a form.
         *
         * @since 1.5.2
         */
        function render_quick_start_panel() {
            if (!current_user_can('manage_options') || empty($_GET['page'])) {
                return;
            }

            $page = sanitize_key(wp_unslash($_GET['page']));
            if ('fpsm' !== $page || !empty($_GET['action'])) {
                return;
            }

            if (get_user_meta(get_current_user_id(), 'fpsm_quick_start_dismissed', true)) {
                return;
            }

            global $wpdb;
            $form_table = FPSM_FORM_TABLE;
            // The table name is defined by the plugin and does not contain user input.
            $form_count = (int) $wpdb->get_var("SELECT COUNT(*) FROM {$form_table}"); // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared

            if ($form_count > 0) {
                return;
            }

            include(FPSM_PATH . '/includes/views/backend/quick-start.php');
        }

        /**
         * Persist the Quick Start dismissal for the current administrator.
         *
         * @since 1.5.2
         */
        function dismiss_quick_start_panel() {
            if (!current_user_can('manage_options')) {
                wp_die(
                    esc_html__('You are not allowed to dismiss this panel.', 'frontend-post-submission-manager'),
                    '',
                    array('response' => 403)
                );
            }

            $nonce = isset($_POST['_wpnonce']) ? sanitize_text_field(wp_unslash($_POST['_wpnonce'])) : '';
            if (!$nonce || !wp_verify_nonce($nonce, 'fpsm_dismiss_quick_start')) {
                $this->redirect_quick_start_error('nonce');
            }

            $updated = update_user_meta(get_current_user_id(), 'fpsm_quick_start_dismissed', 1);
            if (false === $updated) {
                $this->redirect_quick_start_error('save');
            }

            wp_safe_redirect(admin_url('admin.php?page=fpsm'));
            exit;
        }

        /**
         * Redirect back to the Forms screen with a recoverable Quick Start error.
         *
         * @param string $error_code Error identifier.
         * @since 1.5.2
         */
        private function redirect_quick_start_error($error_code) {
            wp_safe_redirect(
                add_query_arg(
                    'fpsm_quick_start_error',
                    sanitize_key($error_code),
                    admin_url('admin.php?page=fpsm')
                )
            );
            exit;
        }

        function add_admin_menus() {
            if (!empty($_GET['action']) && $_GET['action'] == 'edit_form') {
                $page_title = esc_html__('Edit Form', 'frontend-post-submission-manager');
            } else {
                $page_title = esc_html__('All forms', 'frontend-post-submission-manager');
            }
            add_menu_page(esc_html__('Frontend Post Submission', 'frontend-post-submission-manager'), esc_html__('Frontend Post Submission', 'frontend-post-submission-manager'), 'manage_options', 'fpsm', array($this, 'form_lists'), 'dashicons-format-aside');
            add_submenu_page('fpsm', $page_title, esc_html__('All Forms', 'frontend-post-submission-manager'), 'manage_options', 'fpsm', array($this, 'form_lists'));
            add_submenu_page('fpsm', esc_html__('Add New Form', 'frontend-post-submission-manager'), esc_html__('Add New Form', 'frontend-post-submission-manager'), 'manage_options', 'fpsm-add-new-form', array($this, 'form_adder'));
            add_submenu_page('fpsm', esc_html__('Setting', 'frontend-post-submission-manager'), esc_html__('Settings', 'frontend-post-submission-manager'), 'manage_options', 'fpsm-settings', array($this, 'render_form_settings_page'));
            add_submenu_page('fpsm', esc_html__('Payments', 'frontend-post-submission-manager'), esc_html__('Payments', 'frontend-post-submission-manager'), 'manage_options', 'fpsm-payments', array($this, 'render_payments_page'));
            add_submenu_page('fpsm', esc_html__('Help', 'frontend-post-submission-manager'), esc_html__('Help', 'frontend-post-submission-manager'), 'manage_options', 'fpsm-help', array($this, 'render_form_help_page'));
            add_submenu_page('fpsm', esc_html__('About', 'frontend-post-submission-manager'), esc_html__('About', 'frontend-post-submission-manager'), 'manage_options', 'fpsm-about', array($this, 'render_form_about_page'));
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

        function render_form_settings_page() {
            include(FPSM_PATH . '/includes/views/backend/settings.php');
        }

        function render_form_help_page() {
            include(FPSM_PATH . '/includes/views/backend/help.php');
        }

        function render_form_about_page() {
            include(FPSM_PATH . '/includes/views/backend/about.php');
        }

        function render_payments_page() {
            include(FPSM_PATH . '/includes/views/backend/payments.php');
        }

        function add_extra_html() {
            include(FPSM_PATH . '/includes/views/backend/admin-footer.php');
        }

    }

    new FPSM_Admin();
}
