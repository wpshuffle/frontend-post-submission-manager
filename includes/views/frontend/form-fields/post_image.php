<?php
$default_allowed_extensions = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'BMP');
/**
 * Filters allowed extensions for image field type
 *
 * @param array $default_allowed_extensions
 *
 * @since 1.0.0
 */
$default_allowed_extensions = apply_filters('fpsm_image_allowed_extensions', $default_allowed_extensions);
$upload_file_size_limit = (!empty($field_details['upload_file_size_limit'])) ? $field_details['upload_file_size_limit'] : 5;
$uploader_label = (!empty($field_details['upload_button_label'])) ? $field_details['upload_button_label'] : esc_html__('Upload Image', 'frontend-post-submission-manager');
?>
<div class="fpsm-file-uploader" id="fpms-file-uploader-<?php echo esc_attr($fpsm_library_obj->generate_random_string()); ?>" data-extensions="<?php echo esc_attr(implode('|', $default_allowed_extensions)); ?>" data-file-size-limit="<?php echo intval($upload_file_size_limit); ?>" data-label="<?php echo esc_attr($uploader_label); ?>" data-field-name="<?php echo esc_attr($field_key); ?>" data-multiple='false'></div>
<input type="hidden" name="<?php echo esc_attr($field_key); ?>" class="fpsm-media-id"/>
<div class="fpsm-file-preview-wrap"></div>