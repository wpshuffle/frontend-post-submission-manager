<div class="fpsm-each-form-field">
    <div class="fpsm-field-head fpsm-clearfix">
        <h3 class="fpsm-field-title"><span class="dashicons dashicons-arrow-down"></span>{{data.label}} <span class="fpsm-field-type-label">- <?php echo esc_html($custom_field_type_label); ?></span></h3>
        <a href="javascript:void(0);" class="fpsm-field-remove-trigger"><span class="dashicons dashicons-trash"></span></a>
    </div>
    <div class="fpsm-field-body fpsm-display-none">
        <?php
        if (file_exists(FPSM_PATH . '/includes/views/backend/forms/custom-field-types/' . $custom_field_type . '.php')) {
            include(FPSM_PATH . '/includes/views/backend/forms/custom-field-types/' . $custom_field_type . '.php');
        }
        ?>
    </div>
</div>