<?php

defined('ABSPATH') or die('No script kiddies please!!');
if (!class_exists('Frontend_Post_Submission_Manager')) {

    /**
     * Plugin Main Class
     *
     * @since 1.0.0
     */
    class Frontend_Post_Submission_Manager {

        /**
         * Plugin's current version.
         *
         * @var string
         */
        public $version = '1.2.2';

        /**
         * The single instance of the class.
         *
         * @since 1.0.0
         */
        protected static $_instance = null;

        /**
         * Main FPSM Instance.
         *
         * Ensures only one instance of FPSM is loaded or can be loaded.
         *
         * @since 1.0.0
         * @static
         * @return Frontend_Post_Submission_Manager - Main instance.
         */
        public static function instance() {
            if (is_null(self::$_instance)) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }

        /**
         * Throw error on object clone.
         *
         * The whole idea of the singleton design pattern is that there is a single
         * object therefore, we don't want the object to be cloned.
         *
         * @since 1.6
         * @access protected
         * @return void
         */
        public function __clone() {
            // Cloning instances of the class is forbidden.
            _doing_it_wrong(__FUNCTION__, esc_html__('No script kiddies please!!', 'frontend-post-submission-manager'), '1.6');
        }

        /**
         * Disable unserializing of the class.
         *
         * @since 1.6
         * @access protected
         * @return void
         */
        public function __wakeup() {
            // Unserializing instances of the class is forbidden.
            _doing_it_wrong(__FUNCTION__, esc_html__('No script kiddies please!!', 'frontend-post-submission-manager'), '1.6');
        }

        /**
         * Returns true if the request is a non-legacy REST API request.
         *
         * Legacy REST requests should still run some extra code for backwards compatibility.
         *
         * @todo: replace this function once core WP function is available: https://core.trac.wordpress.org/ticket/42061.
         *
         * @return bool
         */
        public function is_rest_api_request() {
            if (empty($_SERVER['REQUEST_URI'])) {
                return false;
            }

            $rest_prefix = trailingslashit(rest_get_url_prefix());
            $is_rest_api_request = ( false !== strpos($_SERVER['REQUEST_URI'], $rest_prefix) ); // phpcs:disable WordPress.Security.ValidatedSanitizedInput.MissingUnslash, WordPress.Security.ValidatedSanitizedInput.InputNotSanitized

            return $is_rest_api_request;
        }

        /**
         * What type of request is this?
         *
         * @param  string $type admin, ajax, cron or frontend.
         * @return bool
         */
        private function is_request($type) {
            switch ($type) {
                case 'admin':
                    return is_admin();
                case 'ajax':
                    return defined('DOING_AJAX');
                case 'cron':
                    return defined('DOING_CRON');
                case 'frontend':
                    return (!is_admin() || defined('DOING_AJAX') ) && !defined('DOING_CRON') && !$this->is_rest_api_request();
            }
        }

        /**
         * Plugin's initialization constructor
         *
         * @since 1.0.0
         */
        function __construct() {
            $this->define_constants();
            $this->includes();
        }

        function define_constants() {
            global $wpdb;
            defined('FPSM_VERSION') or define('FPSM_VERSION', $this->version);
            defined('FPSM_FORM_TABLE') or define('FPSM_FORM_TABLE', $wpdb->prefix . 'fpsm_forms');
            $custom_field_type_list = array(
                'textfield' => array('label' => esc_html__('Texfield', 'frontend-post-submission-manager'), 'icon' => 'fas fa-edit'),
                'textarea' => array('label' => esc_html__('Textarea', 'frontend-post-submission-manager'), 'icon' => 'fas fa-expand'),
                'select' => array('label' => esc_html__('Select Dropdown', 'frontend-post-submission-manager'), 'icon' => 'far fa-caret-square-down'),
                'checkbox' => array('label' => esc_html__('Checkbox', 'frontend-post-submission-manager'), 'icon' => 'far fa-check-square'),
                'radio' => array('label' => esc_html__('Radio Button', 'frontend-post-submission-manager'), 'icon' => 'far fa-dot-circle'),
                'number' => array('label' => esc_html__('Number', 'frontend-post-submission-manager'), 'icon' => 'fas fa-sort'),
                'email' => array('label' => esc_html__('Email', 'frontend-post-submission-manager'), 'icon' => 'fas fa-envelope'),
                'datepicker' => array('label' => esc_html__('Datepicker', 'frontend-post-submission-manager'), 'icon' => 'far fa-calendar-alt'),
                'file_uploader' => array('label' => esc_html__('File Uploader', 'frontend-post-submission-manager'), 'icon' => 'fas fa-paperclip'),
                'url' => array('label' => esc_html__('URL', 'frontend-post-submission-manager'), 'icon' => 'fas fa-globe-asia'),
                'tel' => array('label' => esc_html__('Tel', 'frontend-post-submission-manager'), 'icon' => 'fas fa-phone'),
                'youtube' => array('label' => esc_html__('Youtube Embed', 'frontend-post-submission-manager'), 'icon' => 'fab fa-youtube'),
                'hidden' => array('label' => esc_html('Hidden', 'frontend-post-submission-manager'), 'icon' => 'far fa-minus-square')
            );
            /**
             * Filters custom field type list
             *
             * @param array $custom_field_type_list
             *
             * @since 1.0.0
             */
            $custom_field_type_list = apply_filters('fpsm_custom_field_type_list', $custom_field_type_list);
            defined('FPSM_CUSTOM_FIELD_TYPE_LIST') or define('FPSM_CUSTOM_FIELD_TYPE_LIST', $custom_field_type_list);
        }

        function includes() {
            include(FPSM_PATH . '/includes/classes/class-fpsm-init.php');
            include(FPSM_PATH . '/includes/classes/class-fpsm-library.php');
            include(FPSM_PATH . '/includes/classes/class-fpsm-shortcode.php');
            include(FPSM_PATH . '/includes/classes/class-fpsm-fileuploader.php');
            include(FPSM_PATH . '/includes/classes/class-fpsm-ajax.php');
            include(FPSM_PATH . '/includes/classes/class-fpsm-frontend-hooks.php');
            include(FPSM_PATH . '/includes/classes/class-fpsm-notification.php');


            //include all the admin related classes
            if ($this->is_request('admin')) {
                include(FPSM_PATH . '/includes/classes/admin/class-fpsm-activation.php');
                include(FPSM_PATH . '/includes/classes/admin/class-fpsm-admin-enqueue.php');
                include(FPSM_PATH . '/includes/classes/admin/class-fpsm-admin.php');
                include(FPSM_PATH . '/includes/classes/admin/class-fpsm-ajax-admin.php');
                include(FPSM_PATH . '/includes/classes/admin/class-fpsm-metabox.php');
            }
        }

    }

}