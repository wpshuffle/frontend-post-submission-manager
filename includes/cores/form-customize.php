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
    /**
     * Button Text Color
     */
    if ( !empty( $form_details['customize']['form']['button_text_color'] ) ) {
        $button_text_color = esc_html( $form_details['customize']['form']['button_text_color'] );
        $button_text_color_css = ".$form_alias_class  .fpsm-field input[type='submit'] {color:$button_text_color;}";
        wp_add_inline_style( 'fpsm-custom-style', $button_text_color_css );
        $fileuploader_text_color = ".$form_alias_class  .qq-upload-button {color:$button_text_color;}";
        wp_add_inline_style( 'fpsm-custom-style', $fileuploader_text_color );
    }
    /**
     * Button Background Color
     */
    if ( !empty( $form_details['customize']['form']['button_background_color'] ) ) {
        $button_background_color = esc_html( $form_details['customize']['form']['button_background_color'] );
        $button_background_color_css = ".$form_alias_class  .fpsm-field input[type='submit'] {background-color:$button_background_color;}";
        wp_add_inline_style( 'fpsm-custom-style', $button_background_color_css );
        $fileuploader_background_color = ".$form_alias_class  .qq-upload-button {background-color:$button_background_color;}";
        wp_add_inline_style( 'fpsm-custom-style', $fileuploader_background_color );
    }
    /**
     * Button Hover Text Color
     */
    if ( !empty( $form_details['customize']['form']['button_hover_text_color'] ) ) {
        $button_hover_text_color = esc_html( $form_details['customize']['form']['button_hover_text_color'] );
        $button_hover_text_color_css = ".$form_alias_class  .fpsm-field input[type='submit']:hover {color:$button_hover_text_color;}";
        wp_add_inline_style( 'fpsm-custom-style', $button_hover_text_color_css );
        $fileuploader_hover_text_color = ".$form_alias_class  .qq-upload-button:hover {color:$button_hover_text_color;}";
        wp_add_inline_style( 'fpsm-custom-style', $fileuploader_hover_text_color );
    }
    /**
     * Button Background Color
     */
    if ( !empty( $form_details['customize']['form']['button_hover_background_color'] ) ) {
        $button_hover_background_color = esc_html( $form_details['customize']['form']['button_hover_background_color'] );
        $button_hover_background_color_css = ".$form_alias_class  .fpsm-field input[type='submit']:hover {background-color:$button_hover_background_color;}";
        wp_add_inline_style( 'fpsm-custom-style', $button_hover_background_color_css );
        $fileuploader_hover_background_color = ".$form_alias_class  .qq-upload-button:hover {background-color:$button_hover_background_color;}";
        wp_add_inline_style( 'fpsm-custom-style', $fileuploader_hover_background_color );
    }
    /**
     * Field Text Color
     */
    if ( !empty( $form_details['customize']['form']['field_text_color'] ) ) {
        $field_text_color = esc_html( $form_details['customize']['form']['field_text_color'] );
        $field_text_color_css = ".$form_alias_class.fpsm-front-form input[type='text'],
                                .$form_alias_class.fpsm-front-form input[type='email'],
                                .$form_alias_class.fpsm-front-form input[type='number'],
                                .$form_alias_class.fpsm-front-form input[type='tel'],
                                .$form_alias_class.fpsm-front-form textarea,
                                .$form_alias_class.fpsm-front-form .fpsm-taxonomy-select,
                                .$form_alias_class.fpsm-field .fpsm-select-field{color:$field_text_color;}";
        wp_add_inline_style( 'fpsm-custom-style', $field_text_color_css );
    }
    /**
      /**
     * Field background Color
     */
    if ( !empty( $form_details['customize']['form']['field_background_color'] ) ) {
        $field_background_color = esc_html( $form_details['customize']['form']['field_background_color'] );
        $field_background_color_css = ".$form_alias_class.fpsm-front-form input[type='text'],
                                .$form_alias_class.fpsm-front-form input[type='email'],
                                .$form_alias_class.fpsm-front-form input[type='number'],
                                .$form_alias_class.fpsm-front-form input[type='tel'],
                                .$form_alias_class.fpsm-front-form textarea,
                                .$form_alias_class.fpsm-front-form .fpsm-taxonomy-select,
                                .$form_alias_class.fpsm-field .fpsm-select-field{background-color:$field_background_color;}";
        wp_add_inline_style( 'fpsm-custom-style', $field_background_color_css );
    }
    /**
      /**
     * Field Border Color
     */
    if ( !empty( $form_details['customize']['form']['field_border_color'] ) ) {
        $field_border_color = esc_html( $form_details['customize']['form']['field_border_color'] );
        $field_border_color_css = ".$form_alias_class.fpsm-front-form input[type='text'],
                                .$form_alias_class.fpsm-front-form input[type='email'],
                                .$form_alias_class.fpsm-front-form input[type='number'],
                                .$form_alias_class.fpsm-front-form input[type='tel'],
                                .$form_alias_class.fpsm-front-form textarea,
                                .$form_alias_class.fpsm-front-form .fpsm-taxonomy-select,
                                .$form_alias_class.fpsm-field .fpsm-select-field{border-color:$field_border_color;}";
        wp_add_inline_style( 'fpsm-custom-style', $field_border_color_css );
    }
}