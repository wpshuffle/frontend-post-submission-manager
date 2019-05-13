<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!!' );
if ( !class_exists( 'FPSM_Init' ) ) {

    class FPSM_Init {

        function __construct() {
            //All tasks needed to be executed in init hooks are placed here
            add_action( 'init', array( $this, 'init_tasks' ) );
        }

        function init_tasks() {
            add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
        }

        function load_plugin_textdomain() {
            load_plugin_textdomain( 'frontend-post-submission-manager', false, FPSM_PATH . '/languages' );
            do_action( 'fpsm_init' );
        }

    }

    new FPSM_Init();
}