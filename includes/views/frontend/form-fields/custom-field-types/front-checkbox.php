<?php
$display_type = $field_details['display_type'];
$display_class = 'fpsm-checkbox-' . $display_type;
?>
<div class="fpsm-checkbox-list-wrap <?php echo esc_attr($display_class); ?>">
    <?php
    if (!empty($field_details['options'])) {
        foreach ($field_details['options'] as $option_count => $option) {
            ?>
            <div class="fpsm-checkbox">
                <input type="checkbox" name="<?php echo esc_attr($field_key); ?>" value="<?php echo esc_attr($field_details['values'][$option_count]); ?>" <?php echo (!empty($field_details['checked'][$option_count])) ? 'checked="checked"' : ''; ?>/>
                <label for="<?php echo esc_attr($field_key); ?>"><?php echo esc_html($option); ?></label>
            </div>
            <?php
        }
    }
    ?>
</div>