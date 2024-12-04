<?php

defined('ABSPATH') or die('No script kiddies please!!');
if (!class_exists('FPSM_Init')) {

    class FPSM_Init {

        function __construct() {
            //All tasks needed to be executed in init hooks are placed here
            add_action('init', array($this, 'init_tasks'));
        }

        function init_tasks() {
            /**
             * Fires on init hook
             *
             * @since 1.0.0
             */
            do_action('fpsm_init');

            load_plugin_textdomain('frontend-post-submission-manager', false, FPSM_LANGAUGE_PATH);
        }
    }

    new FPSM_Init();
}
