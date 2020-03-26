<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!!' );
if ( !empty( $form_details['customize']['form']['enable'] ) ) {
    /**
     * Background Color
     */
    if ( $form_details['customize']['form']['background_type'] == 'color' ) {
        $background_color = esc_html( $form_details['customize']['form']['background_color'] );
        $background_css = ".$form_alias_class{background-color:$background_color;}";
        wp_add_inline_style( 'fpsm-custom-style', $background_css );
    } else {
        if ( !empty( $form_details['customize']['form']['background_image'] ) ) {
            $background_image = esc_url( $form_details['customize']['form']['background_image'] );
            $background_image_css = ".$form_alias_class{background-image:url('$background_image');}";
            wp_add_inline_style( 'fpsm-custom-style', $background_image_css );
            $background_size = esc_html( $form_details['customize']['form']['background_size'] );
            $background_size_css = ".$form_alias_class{background-size:$background_size;}";
            wp_add_inline_style( 'fpsm-custom-style', $background_size_css );
            $background_repeat = esc_html( $form_details['customize']['form']['background_repeat'] );
            $background_repeat_css = ".$form_alias_class{background-repeat:$background_repeat;}";
            wp_add_inline_style( 'fpsm-custom-style', $background_repeat_css );
        }
    }

    /**
     * Text color
     */
    if ( !empty( $form_details['customize']['form']['text_color'] ) ) {
        $text_color = esc_html( $form_details['customize']['form']['text_color'] );
        $text_color_css = ".$form_alias_class{color:$text_color;}";
        wp_add_inline_style( 'fpsm-custom-style', $text_color_css );
    }
}