<?php
$hidden_field_type = $field_details['hidden_field_type'];
global $fpsm_library_obj;
switch( $hidden_field_type ) {
    case 'current_page_url':
        $hidden_value = $fpsm_library_obj->get_current_page_url();
        break;
    case 'user_ip':
        $hidden_value = $fpsm_library_obj->get_public_ip();
        break;
    case 'request':
        if ( !empty( $field_details['url_parameter_key'] ) ) {
            $hidden_value = sanitize_text_field( $_REQUEST[$field_details['url_parameter_key']] );
        } else {

        }
        break;
    case 'prefilled':
        break;
}
$custom_field_array = explode( '|', $field_key );
$custom_field_meta_key = end( $custom_field_array );
$custom_field_saved_value = (!empty( $edit_post )) ? get_post_meta( $post_id, $custom_field_meta_key, true ) : '';
?>
<input type="hidden" name="<?php echo esc_attr( $field_key ); ?>" value="<?php echo esc_attr( $custom_field_saved_value ); ?>"/>