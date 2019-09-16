<?php
if (empty($_GET['form_id'])) {
    return;
}
defined('ABSPATH') or die('No script kiddies please!!');
global $fpsm_library_obj;
$form_id = intval($_GET['form_id']);
$form_row = $fpsm_library_obj->get_form_row_by_id($form_id);
if (empty($form_row)) {
    return;
}
?>
<div class="wrap fpsm-wrap fpsm-clearfix">
    <div class="fpsm-header fpsm-clearfix">
        <h1 class="fpsm-floatLeft"><?php esc_html_e('Frontend Post Submission Manager', 'frontend-post-submission-manager'); ?></h1>
        <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem</p>
        <div class="fpsm-field-wrap fpsm-shortcode-common">
            <label><?php esc_html_e('Shortcode', 'subscribe-to-download') ?></label>
            <div class="fpsm-field">
                <span class="fpsm-shortcode-preview">[fpsm alias="<?php echo esc_attr($form_row->form_alias); ?>"]</span>
                <span class="fpsm-clipboard-copy"><i class="fas fa-clipboard-list"></i></span>
            </div>
        </div>
    </div>


    <?php
    /**
     * Form Navigation
     */
    include(FPSM_PATH . '/includes/views/backend/forms/form-edit-sections/form-navigation.php');
    ?>
    <form class="fpsm-form-wrap fpsm-edit-form">

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
        <input type="submit" value="<?php esc_attr_e('Save', 'frontend-post-submission-manager'); ?>" class="fpsm-button-primary"/>
    </form>
</div>