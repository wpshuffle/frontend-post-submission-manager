<?php

defined('ABSPATH') or die('No script kiddies please!!');
if (!class_exists('FPSM_Enqueue')) {

    class FPSM_Enqueue {

        function __construct() {
            add_action('wp_enqueue_scripts', array($this, 'register_frontend_assets'));
        }

        function register_frontend_assets() {
            wp_enqueue_style('fpsm-style', FPSM_URL . '/assets/css/fpsm-frontend-style.css', array(), FPSM_VERSION);
            wp_enqueue_script('fpsm-fileuploader', FPSM_URL . '/assets/js/fpsm-fileuploader.js', array(), FPSM_VERSION);
            wp_enqueue_script('fpsm-script', FPSM_URL . '/assets/js/fpsm-frontend.js', array('jquery', 'fpsm-fileuploader'), FPSM_VERSION);
        }

    }

    new FPSM_Enqueue();
}