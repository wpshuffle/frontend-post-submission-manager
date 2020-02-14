<?php

defined('ABSPATH') or die('No script kiddies please!!');
if (is_user_logged_in()) {
    include(FPSM_PATH . '/includes/views/frontend/dashboard-html.php');
} else {
    include(FPSM_PATH . '/includes/views/frontend/login-html.php');
}
