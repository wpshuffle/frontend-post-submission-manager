<?php

defined('ABSPATH') or die('No script kiddies please!!');
if (!class_exists('FPSM_Shortcode')) {

    class FPSM_Shortcode {

        function __construct() {
            add_shortcode('fpsm', array($this, 'output_shortcode'));
            add_action('wp_login_failed', array($this, 'login_failed'));
            add_filter('authenticate', array($this, 'verify_username_password'), 1, 3);
            add_action('login_form', array($this, 'login_extra_fields'));
            add_filter('login_form_middle', array($this, 'login_extra_fields'));
        }

        function output_shortcode($atts) {
            if (!empty($atts['alias'])) {
                global $fpsm_library_obj;
                $alias = $atts['alias'];
                $form_row = $fpsm_library_obj->get_form_row_by_alias($alias);
                // $fpsm_library_obj->print_array($form_row);
                if (!empty($form_row)) {
                    $form_details = maybe_unserialize($form_row->form_details);
                    ob_start();
                    include(FPSM_PATH . '/includes/views/frontend/form-shortcode.php');
                    $form_html = ob_get_contents();
                    ob_end_clean();
                    return $form_html;
                } else {
                    return esc_html__('Form not available for this alias.', 'frontend-post-submission-manager');
                }
            }
        }

        function redirect_login_page() {
            if (isset($_POST['requested_page'])) {
                $login_page = esc_url($_POST['requested_page']);
                $page_viewed = basename($_SERVER['REQUEST_URI']);

                if ($page_viewed == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET') {
                    wp_redirect($login_page);
                    exit;
                }
            }
        }

        function login_failed() {
            if (isset($_POST['requested_page'])) {
                $login_page = esc_url($_POST['requested_page']);
                wp_redirect($login_page . '?login=failed');
                exit;
            }
        }

        function verify_username_password($user, $username, $password) {
            if (isset($_POST['requested_page'])) {
                $login_page = esc_url($_POST['requested_page']);
                if ($username == "" || $password == "") {
                    wp_redirect($login_page . "?login=empty");
                    exit;
                } else {

                }
            }
        }

        function login_extra_fields($login_form_buttom_html) {
            if (!$this->is_login_page()) {
                global $fpsm_library_obj;
                $current_page_url = $fpsm_library_obj->get_current_page_url();
                $login_form_html = '<input type="hidden" name="requested_page" value="' . $current_page_url . '"/>';
                return $login_form_buttom_html . $login_form_html;
            } else {
                return $login_form_buttom_html;
            }
        }

        function is_login_page() {
            return in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php'));
        }

    }

    new FPSM_Shortcode();
}
