<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!!' );
if ( !class_exists( 'FPSM_Enqueue' ) ) {

    class FPSM_Enqueue {

        function __construct() {
            add_action( 'wp_enqueue_scripts', array( $this, 'register_frontend_assets' ) );
        }

        function register_frontend_assets() {
            $translation_strings = array(
                'are_your_sure' => esc_html__( 'It looks like you have been editing something. If you leave before saving, your changes will be lost.', 'frontend-post-submission-manager' )
            );
            $js_obj = array(
                'ajax_url' => admin_url( 'admin-ajax.php' ),
                'ajax_nonce' => wp_create_nonce( 'fpsm_ajax_nonce' ),
                'no_preview' => FPSM_URL . '/assets/images/no-preview.jpg',
                'translation_strings' => $translation_strings
            );
            wp_enqueue_style( 'fpsm-style', FPSM_URL . '/assets/css/fpsm-frontend-style.css', array(), FPSM_VERSION );
            if ( !is_user_logged_in() ) {
                wp_enqueue_style( 'fpsm-login-style', FPSM_URL . '/assets/css/fpsm-login-form-style.css', array(), FPSM_VERSION );
            }
            wp_enqueue_style( 'jquery-ui', FPSM_URL . '/assets/css/jquery-ui.min.css', array(), FPSM_VERSION );
            wp_enqueue_style( 'fpsm-fileuploader', FPSM_URL . '/assets/css/fileuploader.css', array(), FPSM_VERSION );
            wp_enqueue_style( 'fontawesome', FPSM_URL . '/assets/fontawesome/css/all.min.css', array(), FPSM_VERSION );
            wp_enqueue_script( 'fpsm-fileuploader', FPSM_URL . '/assets/js/fpsm-fileuploader.js', array(), FPSM_VERSION );
            wp_enqueue_script( 'fpsm-are-you-sure-script', FPSM_URL . '/assets/js/jquery.are-you-sure.js', array( 'jquery' ), FPSM_VERSION );
            wp_enqueue_script( 'fpsm-script', FPSM_URL . '/assets/js/fpsm-frontend.js', array( 'jquery', 'fpsm-fileuploader', 'wp-util', 'jquery-ui-autocomplete', 'jquery-ui-datepicker', 'fpsm-are-you-sure-script' ), FPSM_VERSION );
            wp_localize_script( 'fpsm-script', 'fpsm_js_obj', $js_obj );
        }

    }

    new FPSM_Enqueue();
}