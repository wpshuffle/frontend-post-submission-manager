<div class="fpsm-login-form-wrapper fpsm-login-form-<?php echo esc_attr($form_template); ?>">
    <?php
    $username_label = (!empty($login_settings['username_label'])) ? esc_attr($login_settings['username_label']) : __('Username', 'frontend-post-submission-manager');
    $password_label = (!empty($login_settings['password_label'])) ? esc_attr($login_settings['password_label']) : __('Password', 'frontend-post-submission-manager');
    $login_button_label = (!empty($login_settings['login_button_label'])) ? esc_attr($login_settings['login_button_label']) : __('Login', 'frontend-post-submission-manager');
    $remember_me_label = (!empty($login_settings['remember_me_label'])) ? esc_attr($login_settings['remember_me_label']) : __('Remember', 'frontend-post-submission-manager');
    $login_error_message = (!empty($login_settings['login_error_message'])) ? esc_attr($login_settings['login_error_message']) : __('Invalid username or password.', 'frontend-post-submission-manager');
    global $user_login;
    $login = (isset($_GET['login']) ) ? sanitize_text_field($_GET['login']) : 0;

    // In case of a login error.
    if ($login === "failed") {
        echo '<p class="fpsm-login-msg"><strong>ERROR:</strong> ' . esc_html($login_error_message) . '</p>';
    } elseif ($login === "empty") {
        echo '<p class="fpsm-login-msg"><strong>ERROR:</strong> ' . esc_html($login_error_message) . '</p>';
    } elseif ($login === "captcha_error") {
        $captcha_error_message = (!empty($fpsm_settings['captcha']['error_message'])) ? esc_attr($fpsm_settings['captcha']['error_message']) : __('Invalid Captcha', 'frontend-post-submission-manager');
        echo '<p class="fpsm-login-msg"><strong>ERROR:</strong> ' . esc_html($captcha_error_message) . '</p>';
    }
    $args = array(
        'echo' => true,
        'redirect' => $fpsm_library_obj->get_current_page_url(),
        'form_id' => 'fpsm-login-form',
        'label_username' => $username_label,
        'label_password' => $password_label,
        'label_log_in' => $login_button_label,
        'id_username' => 'user_login',
        'id_password' => 'user_pass',
        'id_remember' => 'rememberme',
        'id_submit' => 'wp-submit',
        'remember' => true,
        'label_remember' => $remember_me_label,
        'value_username' => NULL,
        'value_remember' => false
    );

// Calling the login form.
    wp_login_form($args);
    ?>
</div>
<script>jQuery(document).ready(function ($) {
        if (window.location.href.indexOf('?') > -1) {
            history.pushState('', document.title, window.location.pathname);
        }
    });
</script>