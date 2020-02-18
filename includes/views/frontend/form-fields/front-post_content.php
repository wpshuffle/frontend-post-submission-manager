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
    $media_upload = (!empty($field_details)) ? true : false;
    $editor_settings = array(
        'textarea_name' => $field_key,
        'media_buttons' => $media_upload,
        'teeny' => $teeny,
        'wpautop' => true,
        'quicktags' => $show_quicktags,
        'editor_class' => apply_filters('fpsm_editor_class', 'fpsm-post-content-editor')
    );
    wp_editor($post_content, 'fpsm_' . $form_row->form_alias, $editor_settings);
}
?>
