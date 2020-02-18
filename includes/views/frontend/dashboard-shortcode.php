<?php

defined('ABSPATH') or die('No script kiddies please!!');
if (is_user_logged_in()) {
    $current_user_id = get_current_user_id();

    if (isset($_GET['action']) && $_GET['action'] == 'edit_post' && !empty($_GET['post_id'])) {
        $post_id = intval($_GET['post_id']);
        $author_id = get_post_field('post_author', $post_id);
        $edit_post = get_post($post_id);
        echo "<pre>";
        print_r($edit_post);
        echo "</pre>";
        if ($current_user_id == $author_id) {
            include(FPSM_PATH . '/includes/views/frontend/form-html.php');
        } else {
            esc_html__('Unauthorized access', 'frontend-post-submission-manager');
        }
    } else {
        include(FPSM_PATH . '/includes/views/frontend/dashboard-html.php');
    }
} else {
    include(FPSM_PATH . '/includes/views/frontend/login-html.php');
}
