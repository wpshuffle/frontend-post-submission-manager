<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!!' );
if ( defined( 'DOING_AJAX' ) ) {
    if ( $form_details['notification']['admin']['enable'] ) {
        $from_name = (!empty( $form_details['notification']['admin']['from_name'] )) ? $form_details['notification']['admin']['from_name'] : esc_html__( 'No Reply', 'frontend-post-submission-manager' );
        $from_email = (!empty( $form_details['notification']['admin']['from_email'] )) ? $form_details['notification']['admin']['from_email'] : $fpsm_library_obj->default_from_email();
        $subject = (!empty( $form_details['notification']['admin']['subject'] )) ? $form_details['notification']['admin']['subject'] : $fpsm_library_obj->default_from_email();
        $notification_message = (!empty( $form_details['notification']['admin']['notification_message'] )) ? $form_details['notification']['admin']['notification_message'] : $fpsm_library_obj->sanitize_escaping_linebreaks( $fpsm_library_obj->default_admin_notification() );
        $notification_message = str_replace( '[post_title]', get_the_title( $insert_update_post_id ), $notification_message );
        $post_edit_link = get_edit_post_link( $insert_update_post_id );
        $notification_message = str_replace( '[post_admin_link]', '<a href="' . $post_edit_link . '">' . $post_edit_link . '</a>', $notification_message );
        $admin_email = get_bloginfo('')
        $headers = array();
        $charset = get_option( 'blog_charset' );
        $headers[] = 'Content-Type: text/html; charset=' . $charset;
        $headers[] = "From: $email_from_name <$email_from_email>";
        wp_mail( $admin_email, $notification_subject, $admin_notification_message, $headers );
    }
}