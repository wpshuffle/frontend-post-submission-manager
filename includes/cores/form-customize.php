<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!!' );
if ( !empty( $form_details['customize']['form']['enable'] ) ) {
    if ( $form_details['customize']['form']['background_type'] == 'color' ) {
        $background_color = esc_html( $form_details['customize']['form']['background_color'] );
        $background_css = ".$form_alias_class{background-color:$background_color;}";
        wp_add_inline_style( 'fpsm-custom-style', $background_css );
    }
}