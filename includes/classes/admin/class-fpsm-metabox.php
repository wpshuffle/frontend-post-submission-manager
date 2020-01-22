<?php

defined('ABSPATH') or die('No script kiddies please!!');
if (!class_exists('FPSM_Metabox')) {

    class FPSM_Metabox {

        function __construct() {
            add_action('add_meta_boxes', array($this, 'register_fpsm_metabox'));
        }

        function register_fpsm_metabox() {
            add_meta_box('fpsm-metabox', esc_html__('Frontend Post Submission Manager'), array($this, 'render_fpsm_metabox'));
        }

        function render_fpsm_metabox($post) {
            include(FPSM_PATH . '/includes/cores/fpsm-metabox-render.php');
        }

    }

    new FPSM_Metabox();
}
