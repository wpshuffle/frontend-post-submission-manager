<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!!' );
if ( !class_exists( 'FPSM_Admin_Enqueue' ) ) {

    class FPSM_Admin_Enqueue {

        function __construct() {
            add_action( 'admin_enqueue_scripts', array( $this, 'register_backend_assets' ) );
        }

        function register_backend_assets() {
            wp_enqueue_style( 'fpsm-backend-style', FPSM_URL . '/assets/css/fpsm-backend-style.css', array(), FPSM_VERSION );
        }

    }

    new FPSM_Admin_Enqueue();
}