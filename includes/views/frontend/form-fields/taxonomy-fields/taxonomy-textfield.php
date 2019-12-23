<?php
if (!empty($field_details['auto_complete'])) {
    $terms = get_terms($taxonomy, array('hide_empty' => 0));
    $tags = array_column($terms, 'name');
    $tags = implode(',', $tags);
    ?>
    <div class="fpsm-auto-complete-tags"></div>
    <input type="text" class="fpsm-auto-complete-field"/>
    <textarea class="fpsm-available-tags fpsm-display-none"><?php echo esc_html($tags); ?></textarea>
    <input type="hidden" name="<?php echo esc_attr($field_key); ?>" class="fpsm-auto-complete-values"/>
    <?php
} else {
    ?>
    <input type="text" name="<?php echo esc_attr($field_key); ?>"/>
    <?php
}
?>

