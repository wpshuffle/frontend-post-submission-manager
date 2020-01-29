<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!!' );
$login_form_settings = (!empty( $form_details['login'] )) ? $form_details['login'] : array();
?>
<div class="fpsm-settings-each-section fpsm-display-none fpsm-clearfix" data-tab="login">
    <div class="fpsm-field-wrap">
        <label><?php esc_html_e( 'Login Type', 'frontend-post-submission-manager' ); ?></label>
        <div class="fpsm-field">
            <select name="form_details[login][login_type]" class="fpsm-toggle-trigger" data-toggle-class="fpsm-login-type-ref">
                <?php
                $selected_login_type = (!empty( $login_form_settings['login_type'] )) ? $login_form_settings['login_type'] : 'login_form';
                ?>
                <option value="login_form"><?php esc_html_e( 'Show Login Form', 'frontend-post-submission-manager' ); ?></option>
                <option value="login_message"><?php esc_html_e( 'Show Login Message', 'frontend-post-submission-manager' ); ?></option>
                <option value="login_page_redirect"><?php esc_html_e( 'Redirect to Login Page', 'frontend-post-submission-manager' ); ?></option>
            </select>
        </div>
    </div>
    <div class="fpsm-login-type-ref <?php echo ($selected_login_type != 'login_form') ? 'fpsm-display-none' : ''; ?>" data-toggle-ref="login_form">
        <div class="fpsm-field-wrap">
            <label><?php esc_html_e( 'Username Label', 'frontend-post-submission-manager' ); ?>></label>
            <div class="fpsm-field">
                <input type="text" name="form_details[login][username_label]" value="<?php echo (!empty( $login_form_settings['username_label'] )) ? esc_attr( $login_form_settings['username_label'] ) : ''; ?>"/>
            </div>
        </div>
        <div class="fpsm-field-wrap">
            <label><?php esc_html_e( 'Password Label', 'frontend-post-submission-manager' ); ?>></label>
            <div class="fpsm-field">
                <input type="text" name="form_details[login][password_label]" value="<?php echo (!empty( $login_form_settings['password_label'] )) ? esc_attr( $login_form_settings['password_label'] ) : ''; ?>"/>
            </div>
        </div>
        <div class="fpsm-field-wrap">
            <label><?php esc_html_e( 'Show Remember Me', 'frontend-post-submission-manager' ); ?></label>
            <div class="fpsm-field">
                <input type="checkbox" name="form_details[login][show_remember_me]" value="1" class="fpsm-checkbox-toggle-trigger" data-toggle-ref="fpsm-remember-me-label" <?php echo (!empty( $login_form_settings['show_remember_me'] )) ? 'checked="checked"' : ''; ?>/>
            </div>
        </div>
        <div class="fpsm-field-wrap fpsm-remember-me-label <?php echo (empty( $login_form_settings['show_remember_me'] )) ? 'fpsm-display-none' : ''; ?>">
            <label><?php esc_html_e( 'Remember Me Label', 'frontend-post-submission-manager' ); ?>></label>
            <div class="fpsm-field">
                <input type="text" name="form_details[login][remember_me_label]" value="<?php echo (!empty( $login_form_settings['remember_me_label'] )) ? esc_attr( $login_form_settings['remember_me_label'] ) : ''; ?>"/>
            </div>
        </div>
        <div class="fpsm-field-wrap">
            <label><?php esc_html_e( 'Login Button Label', 'frontend-post-submission-manager' ); ?></label>
            <div class="fpsm-field">
                <input type="text" name="form_details[login][login_button_label]" value="<?php echo (!empty( $login_form_settings['login_button_label'] )) ? esc_attr( $login_form_settings['login_button_label'] ) : ''; ?>"/>
            </div>
        </div>
        <div class="fpsm-field-wrap">
            <label><?php esc_html_e( 'Login error message', 'frontend-post-submission-manager' ); ?></label>
            <div class="fpsm-field">
                <input type="text" name="form_details[login][login_error_message]" value="<?php echo (!empty( $login_form_settings['login_error_message'] )) ? esc_attr( $login_form_settings['login_error_message'] ) : ''; ?>"/>
            </div>
        </div>
        <div class="fpsm-field-wrap">
            <label><?php esc_html_e( '', 'frontend-post-submission-manager' ); ?></label>
            <div class="fpsm-field">

            </div>
        </div>
    </div>
</div>


