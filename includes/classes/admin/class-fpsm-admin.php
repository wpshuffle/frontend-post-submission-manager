<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!!' );
if ( !class_exists( 'FPSM_Admin' ) ) {

    class FPSM_Admin {

        function __construct() {
            add_action( 'admin_menu', array( $this, 'add_admin_menus' ) );
        }

        function add_admin_menus() {
            add_menu_page( __( 'Frontend Post Submission', 'frontend-post-submission-manager' ), __( 'Frontend Post Submission', 'frontend-post-submission-manager' ), 'manage_options', 'fpsm', array( $this, 'form_lists' ), 'dashicons-format-aside' );
            add_submenu_page( 'fpsm', __( 'All Forms', 'frontend-post-submission-manager' ), __( 'All Forms', 'frontend-post-submission-manager' ), 'manage_options', 'fpsm', array( $this, 'form_lists' ) );
            add_submenu_page( 'fpsm', __( 'Add New Form', 'frontend-post-submission-manager' ), __( 'Add New Form', 'frontend-post-submission-manager' ), 'manage_options', 'fpsm-add-new-form', array( $this, 'form_adder' ) );
        }

        function form_lists() {
            include(FPSM_PATH . '/includes/views/backend/forms/form-list.php');
        }

        function form_adder() {
            include(FPSM_PATH . '/includes/views/backend/forms/form-add.php');
        }

    }

    new FPSM_Admin();
}