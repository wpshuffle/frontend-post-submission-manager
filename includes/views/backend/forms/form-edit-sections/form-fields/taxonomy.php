<?php
$field_key_array = explode('|', $field_key);
$taxonomy = end($field_key_array);
$taxonomy_details = get_taxonomy($taxonomy);
?>
<div class="fpsm-each-form-field">
    <div class="fpsm-field-head fpsm-clearfix">
        <h3 class="fpsm-field-title"><span class="dashicons dashicons-arrow-down"></span><?php echo esc_html($taxonomy_details->label); ?></h3>
    </div>
    <div class="fpsm-field-body fpsm-display-none">
        <?php include(FPSM_PATH . '/includes/views/backend/forms/form-edit-sections/form-fields/common-fields.php'); ?>
    </div>
</div>