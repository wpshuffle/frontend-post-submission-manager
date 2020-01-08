<?php
defined('ABSPATH') or die('No script kiddies please!!');
$editor_type = (!empty($field_details['editor_type'])) ? $field_details['editor_type'] : 'simple';
if ($editor_type == 'simple') {
    ?>
    <textarea name="<?php echo esc_attr($field_key); ?>"></textarea>
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
    wp_editor('', 'fpsm_' . $form_row->form_alias, $editor_settings);
}
?>
