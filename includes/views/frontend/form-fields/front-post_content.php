<?php
defined('ABSPATH') or die('No script kiddies please!!');
$editor_type = (!empty($field_details['editor_type'])) ? $field_details['editor_type'] : 'simple';
$post_content = (!empty($edit_post)) ? $edit_post->post_content : '';
if ($editor_type == 'simple') {
    ?>
    <textarea name="<?php echo esc_attr($field_key); ?>"><?php echo $fpsm_library_obj->sanitize_html($post_content); ?></textarea>
    <?php
} else {
    switch ($editor_type) {
        case 'rich':
            $teeny = false;
            $show_quicktags = true;
            break;
        case 'visual':
            $teeny = false;
            $show_quicktags = false;
            break;
            break;
        case 'html':
            $teeny = true;
            $show_quicktags = true;
            break;
    }
    $media_upload = (!empty($field_details['media_upload'])) ? true : false;
    $editor_settings = array(
        'textarea_name' => $field_key,
        'media_buttons' => $media_upload,
        'teeny' => $teeny,
        'wpautop' => true,
        'quicktags' => $show_quicktags,
        'editor_class' => apply_filters('fpsm_editor_class', 'fpsm-post-content-editor')
    );
    if ($editor_type == 'visual' || $editor_type == 'rich') {
        if ($form_row->form_type == 'guest') {
            if (!empty($field_details['custom_media_upload_button'])) {
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
                $multiple_upload = (!empty($field_details['multiple_upload'])) ? 'true' : 'false';
                $max_number_uploads = (!empty($field_details['max_number_uploads'])) ? $field_details['max_number_uploads'] : -1;
                $allowed_extensions = (!empty($field_details['file_extensions'])) ? $field_details['file_extensions'] : $default_allowed_extensions;
                ?>
                <div class="fpsm-file-uploader fpsm-custom-media-upload-button"
                     id="fpsm-file-uploader-<?php $fpsm_library_obj->generate_random_string(); ?>"
                     data-extensions="<?php echo esc_attr(implode('|', $allowed_extensions)); ?>"
                     data-file-size-limit="<?php echo esc_attr($upload_file_size_limit); ?>"
                     data-label="<?php echo esc_attr($uploader_label); ?>"
                     data-field-name="<?php echo esc_attr($field_key); ?>"
                     data-multiple='true'
                     data-multiple-upload-limit="-1">
                </div>
                <?php
            }
        } else {
            if ((!current_user_can('upload_files') || empty($field_details['media_upload'])) && !empty($field_details['custom_media_upload_button'])) {
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
                $multiple_upload = (!empty($field_details['multiple_upload'])) ? 'true' : 'false';
                $max_number_uploads = (!empty($field_details['max_number_uploads'])) ? $field_details['max_number_uploads'] : -1;
                $allowed_extensions = (!empty($field_details['file_extensions'])) ? $field_details['file_extensions'] : $default_allowed_extensions;
                ?>
                <div class="fpsm-file-uploader fpsm-custom-media-upload-button"
                     id="fpsm-file-uploader-<?php $fpsm_library_obj->generate_random_string(); ?>"
                     data-extensions="<?php echo esc_attr(implode('|', $allowed_extensions)); ?>"
                     data-file-size-limit="<?php echo esc_attr($upload_file_size_limit); ?>"
                     data-label="<?php echo esc_attr($uploader_label); ?>"
                     data-field-name="<?php echo esc_attr($field_key); ?>"
                     data-multiple='true'
                     data-multiple-upload-limit="-1">
                </div>
                <?php
            }
        }
    }
    ?>
    <?php
    wp_editor($post_content, 'fpsm_' . $form_row->form_alias, $editor_settings);
}
?>
