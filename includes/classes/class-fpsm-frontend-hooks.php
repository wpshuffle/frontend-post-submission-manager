<?php

defined('ABSPATH') or die('No script kiddies please!!');
if (!class_exists('FPSM_Frontend_Hooks')) {

    class FPSM_Frontend_Hooks {

        function __construct() {
            add_action('wp_footer', array($this, 'append_extra_html'));
        }

        function append_extra_html() {
            include(FPSM_PATH . '/includes/views/frontend/wp_footer.php');
        }

    }

    new FPSM_Frontend_Hooks();
}