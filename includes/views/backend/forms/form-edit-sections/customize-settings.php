<div class="fpsm-settings-each-section fpsm-display-none" data-tab="customize">
    <div class="fpsm-field-wrap">
        <label><?php esc_html_e( 'Customize Form Template', 'frontend-post-submission-manager' ); ?></label>
        <div class="fpsm-field">
            <input type="checkbox" name="form_details[customize][form][enable]" value="1" <?php echo (!empty( $form_details['customize']['form']['enable'] )) ? 'checked="checked"' : ''; ?> class="fpsm-checkbox-toggle-trigger" data-toggle-class="fpsm-custom-enable-ref"/>
            <p class="description"><?php esc_html_e( 'Please check if you want to customize the choose form template.', 'frontend-post-submission-manager' ); ?></p>
        </div>
    </div>
    <div class="fpsm-custom-enable-ref <?php echo (empty( $form_details['customize']['form']['enable'] )) ? 'fpsm-display-none' : ''; ?>">
        <div class="fpsm-field-wrap">
            <label><?php esc_html_e( 'Background Type', 'frontend-post-submission-manager' ); ?></label>
            <div class="fpsm-field">
                <?php
                $selected_background_type = (!empty( $form_details['customize']['form']['background_type'] )) ? $form_details['customize']['form']['background_type'] : 'color';
                ?>
                <label><input type="radio" name="form_details[customize][form][background_type]" value="color" class="fpsm-toggle-trigger" data-toggle-class="fpsm-background-type-ref" <?php checked( $selected_background_type, 'color' ); ?>/><?php esc_html_e( 'Color', 'frontend-post-submission-manager' ); ?></label>
                <label><input type="radio" name="form_details[customize][form][background_type]" value="image" class="fpsm-toggle-trigger" data-toggle-class="fpsm-background-type-ref" <?php checked( $selected_background_type, 'image' ); ?>/><?php esc_html_e( 'Image', 'frontend-post-submission-manager' ); ?></label>
            </div>
        </div>
        <div class="fpsm-field-wrap fpsm-background-type-ref <?php echo ($selected_background_type != 'color') ? 'fpsm-display-none' : ''; ?>" data-toggle-ref="color">
            <label><?php esc_html_e( 'Background Color', 'frontend-post-submission-manager' ); ?></label>
            <div class="fpsm-field">
                <input type="text" name="form_details[customize][form][background_color]" value="<?php echo (!empty( $form_details['customize']['form']['background_color'] )) ? esc_attr( $form_details['customize']['form']['background_color'] ) : ''; ?>" class="fpsm-color-picker"/>
            </div>
        </div>
        <div class="fpsm-field-wrap fpsm-background-type-ref <?php echo ($selected_background_type != 'image') ? 'fpsm-display-none' : ''; ?>" data-toggle-ref="image">
            <label><?php esc_html_e( 'Background Image', 'frontend-post-submission-manager' ); ?></label>
            <div class="fpsm-field">
                <input type="text" name="form_details[customize][form][background_image]" value="<?php echo (!empty( $form_details['customize']['form']['background_image'] )) ? esc_url( $form_details['customize']['form']['background_image'] ) : ''; ?>"/>
                <input type="hidden" name="form_details[customize][form][background_image_id]" value="<?php echo (!empty( $form_details['customize']['form']['background_image_id'] )) ? intval( $form_details['customize']['form']['background_image_id'] ) : ''; ?>"/>
                <input type="button" class="fpsm-media-uploader button-secondary" value="<?php esc_html_e( 'Upload Image', 'frontend-post-submission-manager' ); ?>"/>
                <div class="fpsm-media-preview">
                    <?php
                    if ( !empty( $form_details['customize']['form']['background_image'] ) ) {
                        $thumbnail_url = wp_get_attachment_image_src( $form_details['customize']['form']['background_image_id'], 'thumbnail' );
                        ?>
                        <img src="<?php echo esc_url( $thumbnail_url[0] ); ?>"/>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="fpsm-field-wrap">
            <label><?php esc_html_e( 'Text Color', 'frontend-post-submission-manager' ); ?></label>
            <div class="fpsm-field">
                <input type="text" name="form_details[customize][form][text_color]" value="<?php echo (!empty( $form_details['customize']['form']['text_color'] )) ? esc_attr( $form_details['customize']['form']['text_color'] ) : ''; ?>" class="fpsm-color-picker"/>
            </div>
        </div>
        <div class="fpsm-field-wrap">
            <label><?php esc_html_e( 'Field Text Color', 'frontend-post-submission-manager' ); ?></label>
            <div class="fpsm-field">
                <input type="text" name="form_details[customize][form][field_text_color]" value="<?php echo (!empty( $form_details['customize']['form']['field_text_color'] )) ? esc_attr( $form_details['customize']['form']['field_text_color'] ) : ''; ?>" class="fpsm-color-picker"/>
            </div>
        </div>
        <div class="fpsm-field-wrap">
            <label><?php esc_html_e( 'Button Color', 'frontend-post-submission-manager' ); ?></label>
            <div class="fpsm-field">
                <input type="text" name="form_details[customize][form][field_text_color]" value="<?php echo (!empty( $form_details['customize']['form']['field_text_color'] )) ? esc_attr( $form_details['customize']['form']['field_text_color'] ) : ''; ?>" class="fpsm-color-picker"/>
            </div>
        </div>
    </div>
</div>