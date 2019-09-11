<?php

defined('ABSPATH') or die('No script kiddies please!!');
if (!class_exists('FPSM_Admin_Enqueue')) {

    class FPSM_Admin_Enqueue {

        function __construct() {
            add_action('admin_enqueue_scripts', array($this, 'register_backend_assets'));
        }

        function register_backend_assets() {
            wp_enqueue_style('fpsm-backend-style', FPSM_URL . '/assets/css/fpsm-backend-style.css', array(), FPSM_VERSION);
            wp_enqueue_script('fpsm-backend-script', FPSM_URL . '/assets/js/fpsm-backend.js', array('jquery'), FPSM_VERSION);
        }

    }

    new FPSM_Admin_Enqueue();
}