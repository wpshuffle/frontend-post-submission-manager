<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!!' );
global $fpsm_library_obj;
?>
<div class="wrap fpsm-wrap">
    <div class="fpsm-header fpsm-clearfix">
        <h1 class="fpsm-floatLeft"><?php _e( 'Frontend Post Submission Manager', 'frontend-post-submission-manager' ); ?></h1>
        <h2 class="fpsm-floatRight"><?php _e( 'Add New Form', 'frontend-post-submission-manager' ); ?></h2>
    </div>
    <h2 class="nav-tab-wrapper wp-clearfix fpsm-nav-wrap">
        <a href="javascript:void(0);" class="nav-tab nav-tab-active"><?php _e( 'Basic Settings', 'frontend-post-submission-manager' ); ?></a>
        <a href="javascript:void(0);" class="nav-tab"><?php _e( 'Form Fields Settings', 'frontend-post-submission-manager' ); ?></a>
        <a href="javascript:void(0);" class="nav-tab"><?php _e( 'Display Settings', 'frontend-post-submission-manager' ); ?></a>
        <a href="javascript:void(0);" class="nav-tab"><?php _e( 'Notification Settings', 'frontend-post-submission-manager' ); ?></a>
        <a href="javascript:void(0);" class="nav-tab"><?php _e( 'Captcha Settings', 'frontend-post-submission-manager' ); ?></a>
        <a href="javascript:void(0);" class="nav-tab"><?php _e( 'Customize', 'frontend-post-submission-manager' ); ?></a>
        <?php
        /**
         * Fires while building the nav
         *
         * @since 1.0.0
         */
        do_action( 'fpsm_form_nav' );
        ?>
    </h2>
    <form class="fpsm-form-wrap">
        <div class="fpsm-field-wrap">
            <label><?php _e( 'Form Status', 'frontend-post-submission-manager' ); ?></label>
            <div class="fpsm-field">
                <input type="checkbox" name="form_status" value="1"/>
            </div>
        </div>
        <div class="fpsm-field-wrap">
            <label><?php _e( 'Form Title', 'frontend-post-submission-manager' ); ?></label>
            <div class="fpsm-field">
                <input type="text" name="form_title"/>
            </div>
        </div>
        <div class="fpsm-field-wrap">
            <label><?php _e( 'Form Alias', 'frontend-post-submission-manager' ); ?></label>
            <div class="fpsm-field">
                <input type="text" name="form_alias"/>
            </div>
        </div>
        <div class="fpsm-field-wrap">
            <label><?php _e( 'Post Type', 'frontend-post-submission-manager' ); ?></label>
            <div class="fpsm-field">
                <select name="form_details[general][post_type]">
                    <?php
                    $post_types = $fpsm_library_obj->get_registered_post_types();
                    if ( !empty( $post_types ) ) {
                        foreach ( $post_types as $post_type ) {
                            ?>
                            <option value="<?php echo $post_type; ?>"><?php echo esc_attr( $post_type ); ?></option>

                            <?php
                        }
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="fpsm-field-wrap">
            <label><?php _e( 'Post Status', 'frontend-post-submission-manager' ); ?></label>
            <div class="fpsm-field">
                <select name="form_details[general][post_status]">
                    <?php
                    $post_statuses = $fpsm_library_obj->get_all_post_statuses();
                    foreach ( $post_statuses as $post_status => $post_status_label ) {
                        ?>
                        <option value="<?php echo $post_status; ?>"><?php echo esc_attr( $post_status_label ); ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <?php
        if ( current_theme_supports( 'post-formats' ) ) {
            ?>
            <div class="fpsm-field-wrap">
                <label><?php _e( 'Post Format', 'frontend-post-submission-manager' ); ?></label>
                <div class="fpsm-field">
                    <select name="form_details[general][post_format]">
                        <option value=""><?php _e( 'Standard', 'frontend-post-submission-manager' ); ?></option>
                        <?php
                        $post_formats = $fpsm_library_obj->get_registered_post_formats();
                        if ( is_array( $post_formats[0] ) ) {
                            foreach ( $post_formats[0] as $post_format ) {
                                ?>
                                <option value="<?php echo $post_format; ?>" ><?php echo ucfirst( esc_attr( $post_format ) ); ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                    <p class="description"><?php _e( 'These are the post formats registered in your current active theme.', 'frontend-post-submission-manager' ); ?></p>

                </div>
            </div>
            <?php
        }
        ?>
        <div class="fpsm-field-wrap">
            <label><?php _e( 'Guest Login', 'frontend-post-submission-manager' ); ?></label>
            <div class="fpsm-field">
                <label></label>
            </div>
        </div>
    </form>
</div>