<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!!' );
if ( !class_exists( 'FPSM_Shortcode' ) ) {

    class FPSM_Shortcode {

        function __construct() {
            add_shortcode( 'fpsm', array( $this, 'output_shortcode' ) );
        }

        function output_shortcode( $atts ) {
            if ( !empty( $atts['alias'] ) ) {
                global $fpsm_library_obj;
                $alias = $atts['alias'];
                $form_row = $fpsm_library_obj->get_form_row_by_alias( $alias );
                // $fpsm_library_obj->print_array($form_row);
                if ( !empty( $form_row ) ) {
                    $form_details = maybe_unserialize( $form_row->form_details );
                    ob_start();
                    include(FPSM_PATH . '/includes/views/frontend/form-shortcode.php');
                    $form_html = ob_get_contents();
                    ob_end_clean();
                    return $form_html;
                } else {
                    return esc_html__( 'Form not available for this alias.', 'frontend-post-submission-manager' );
                }
            }
        }

    }

    new FPSM_Shortcode();
}
