<?php
defined('ABSPATH') or die('No script kiddies please!!');
global $fpsm_library_obj;
?>
<div class="wrap fpsm-wrap">
    <div class="fpsm-header fpsm-clearfix">
        <h1 class="fpsm-floatLeft"><?php esc_html_e('Frontend Post Submission Manager', 'frontend-post-submission-manager'); ?></h1>
        <h2 class="fpsm-floatRight"><?php esc_html_e('Add New Form', 'frontend-post-submission-manager'); ?></h2>
    </div>
    <?php
    /**
     * Form Navigation
     */
    include(FPSM_PATH . '/includes/views/backend/forms/form-edit-sections/form-navigation.php');
    ?>
    <form class="fpsm-form-wrap">

        <?php
        /**
         * Basic Settings
         */
        include(FPSM_PATH . '/includes/views/backend/forms/form-edit-sections/basic-settings.php');
        ?>
        <?php
        /**
         * Form Fields Settings
         */
        include(FPSM_PATH . '/includes/views/backend/forms/form-edit-sections/form-field-settings.php');
        ?>
        <?php
        /**
         * Layout Settings
         */
        include(FPSM_PATH . '/includes/views/backend/forms/form-edit-sections/layout-settings.php');
        ?>
        <?php
        /**
         * Notification Settings
         */
        include(FPSM_PATH . '/includes/views/backend/forms/form-edit-sections/notification-settings.php');
        ?>
        <?php
        /**
         * Security Settings
         */
        include(FPSM_PATH . '/includes/views/backend/forms/form-edit-sections/security-settings.php');
        ?>
        <?php
        /**
         * Customize Settings
         */
        include(FPSM_PATH . '/includes/views/backend/forms/form-edit-sections/customize-settings.php');
        ?>
    </form>
</div>