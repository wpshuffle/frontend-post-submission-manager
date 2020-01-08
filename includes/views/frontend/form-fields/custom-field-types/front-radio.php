<?php
if (!empty($field_details['options'])) {
    foreach ($field_details['options'] as $option_count => $option) {
        ?>
        <label><input type="radio" name="<?php echo esc_attr($field_key); ?>" value="<?php echo esc_attr($field_details['values'][$option_count]); ?>" <?php echo (!empty($field_details['checked'][$option_count])) ? 'checked="checked"' : ''; ?>/><span><?php echo esc_html($option); ?></span></label>
        <?php
    }
}
?>