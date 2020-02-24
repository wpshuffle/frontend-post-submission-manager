<div class="fpsm-form-nav-wrap">
    <ul class="fpsm-form-nav">
        <li><a href="javascript:void(0);" class="fpsm-nav-item fpsm-active-nav" data-tab="basic"><span class="dashicons dashicons-admin-generic"></span><?php esc_html_e('Basic Settings', 'frontend-post-submission-manager'); ?></a></li>
        <?php if ($form_row->form_type == 'login_require') { ?>
            <li><a href="javascript:void(0);" class="fpsm-nav-item" data-tab="login"><span class="dashicons dashicons-lock"></span><?php esc_html_e('Login Settings', 'frontend-post-submission-manager'); ?></a></li>
            <li><a href="javascript:void(0);" class="fpsm-nav-item" data-tab="dashboard"><span class="dashicons dashicons-dashboard"></span><?php esc_html_e('Dashboard Settings', 'frontend-post-submission-manager'); ?></a></li>
        <?php } ?>
        <li><a href="javascript:void(0);" class="fpsm-nav-item" data-tab="form"><span class="dashicons dashicons-feedback"></span><?php esc_html_e('Form Settings', 'frontend-post-submission-manager'); ?></a></li>
        <li><a href="javascript:void(0);" class="fpsm-nav-item" data-tab="layout"><span class="dashicons dashicons-layout"></span><?php esc_html_e('Layout Settings', 'frontend-post-submission-manager'); ?></a></li>
        <li><a href="javascript:void(0);" class="fpsm-nav-item" data-tab="notification"><span class="dashicons dashicons-email"></span><?php esc_html_e('Notification Settings', 'frontend-post-submission-manager'); ?></a></li>
        <li><a href="javascript:void(0);" class="fpsm-nav-item" data-tab="security"><span class="dashicons dashicons-shield"></span><?php esc_html_e('Security Settings', 'frontend-post-submission-manager'); ?></a></li>
        <li><a href="javascript:void(0);" class="fpsm-nav-item" data-tab="custom"><span class="dashicons dashicons-admin-customizer"></span><?php esc_html_e('Customize', 'frontend-post-submission-manager'); ?></a></li>
                <?php
                /**
                 * Fires while building the nav
                 *
                 * @since 1.0.0
                 */
                do_action('fpsm_form_nav');
                ?>
    </ul>
</div>