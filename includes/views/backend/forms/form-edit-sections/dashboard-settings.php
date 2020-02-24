<?php
$dashboard_settings = (!empty($form_details['dashboard'])) ? $form_details['dashboard'] : array();
$default_display_fields = array(
    'sn' => array('show_on_table' => 1, 'display_label' => esc_html__('SN', 'frontend-post-submission-manager')),
    'post_title' => array('show_on_table' => 1, 'display_label' => esc_html__('Post Title', 'frontend-post-submission-manager')),
    'post_status' => array('show_on_table' => 1, 'display_label' => esc_html__('Post Status', 'frontend-post-submission-manager')),
    'last_modified' => array('show_on_table' => 1, 'display_label' => esc_html__('Last Modified', 'frontend-post-submission-manager')),
);
$display_fields = (!empty($dashboard_settings['display_fields'])) ? $dashboard_settings['display_fields'] : $default_display_fields;
?>
<div class="fpsm-settings-each-section" data-tab="dashboard">
    <div class="fpsm-field-wrap">
        <label><?php esc_html_e('Display Fields', 'frontend-post-submission-manager'); ?></label>
        <div class="fpsm-field">
            <div class="fpsm-each-form-field">
                <div class="fpsm-field-head fpsm-clearfix">
                    <h3 class="fpsm-field-title"><span class="dashicons dashicons-arrow-down"></span><?php esc_html_e('SN', 'frontend-post-submission-manager'); ?></h3>
                </div>
                <div class="fpsm-field-body fpsm-display-none">
                    <div class="fpsm-field-wrap">
                        <label><?php esc_html_e('Show on table', 'frontend-post-submission-manager'); ?></label>
                        <div class="fpsm-field fpsm-checkbox-toggle">
                            <input type="checkbox" name="form_details[dashboard][display_fields][sn][show_on_table]" value="1" checked="checked" class="fpsm-checkbox-toggle-trigger" data-toggle-class="fpsm-show-fields-ref-sn"><label></label>
                            <p class="description"><?php esc_html_e('Please check if you want to display SN in the post listing table in the dashboard.', 'frontend-post-submission-manager'); ?></p>
                        </div>
                    </div>
                    <div class="fpsm-field-wrap fpsm-show-fields-ref-sn">
                        <label><?php esc_html_e('Display Label', 'frontend-post-submission-manager'); ?></label>
                        <div class="fpsm-field">
                            <input type="text" name="form_details[dashboard][display_fields][sn][display_label]" value="">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>