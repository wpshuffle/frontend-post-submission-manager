<?php

defined('ABSPATH') or die('No script kiddies please!!');
if (!class_exists('FPSM_Activation')) {

    class FPSM_Activation {

        function __construct() {
            //All the activation related tasks are initialized here

            register_activation_hook(FPSM_PATH . '/frontend-post-submission-manager.php', array($this, 'activation_tasks'));
        }

        function activation_tasks() {
            $this->create_tables();
        }

        function create_tables() {
            /**
             * Necessary Table Creation on activation
             */
            if (is_multisite()) {
                global $wpdb;
                $current_blog = $wpdb->blogid;

                // Get all blogs in the network and activate plugin on each one
                $blog_ids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");
                foreach ($blog_ids as $blog_id) {
                    switch_to_blog($blog_id);

                    $charset_collate = $wpdb->get_charset_collate();
                    $form_table = $wpdb->prefix . 'fpsm_forms';
                    $form_table_sql = "CREATE TABLE $form_table (
						form_id mediumint(9) NOT NULL AUTO_INCREMENT,
						form_title varchar(255),
						form_alias varchar(255),
						form_details longtext,
                                                post_type varchar(255),
                                                form_type varchar(255),
						form_status mediumint(9) NOT NULL DEFAULT 1,
						PRIMARY KEY form_id (form_id)
					  ) $charset_collate;";

                    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
                    dbDelta($form_table_sql);


                    restore_current_blog();
                }
            } else {
                global $wpdb;

                $charset_collate = $wpdb->get_charset_collate();
                $form_table = FPSM_FORM_TABLE;
                $form_table_sql = "CREATE TABLE $form_table (
						form_id mediumint(9) NOT NULL AUTO_INCREMENT,
						form_title varchar(255),
						form_alias varchar(255),
						form_details longtext,
                                                post_type varchar(255),
                                                form_type varchar(255),
						form_status mediumint(9) NOT NULL DEFAULT 1,
						PRIMARY KEY form_id (form_id)
					  ) $charset_collate;";
                require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
                dbDelta($form_table_sql);
            }
        }

    }

    new FPSM_Activation();
}