<?php

defined('ABSPATH') or die('No script kiddies please!!');
if (!class_exists('FPSM_Library')) {

    class FPSM_Library {

        /**
         * Returns all the publicly registered post types
         *
         * @return array $post_types
         *
         * @since 1.0.0
         */
        function get_registered_post_types() {
            $post_types = get_post_types(array('public' => true), 'objects');
            return $post_types;
        }

        /**
         * Returns all the registered post statuses
         *
         * @return array
         *
         * @since 1.0.0
         */
        function get_all_post_statuses() {
            return get_post_statuses();
        }

        /**
         * Prints array in pre format
         *
         * @param array $array
         *
         * @since 1.0.0
         */
        function print_array($array) {
            echo "<pre>";
            print_r($array);
            echo "</pre>";
        }

        /**
         * Prevents unauthorized access
         *
         * @since 1.0.0
         */
        function permission_denied() {
            die('No script kiddies please!!');
        }

        /**
         * Sanitizes Multi Dimensional Array
         * @param array $array
         * @param array $sanitize_rule
         * @return array
         *
         * @since 1.0.0
         */
        function sanitize_array($array = array(), $sanitize_rule = array()) {
            if (!is_array($array) || count($array) == 0) {
                return array();
            }

            foreach ($array as $k => $v) {
                if (!is_array($v)) {

                    $default_sanitize_rule = (is_numeric($k)) ? 'html' : 'text';
                    $sanitize_type = isset($sanitize_rule[$k]) ? $sanitize_rule[$k] : $default_sanitize_rule;
                    $array[$k] = $this->sanitize_value($v, $sanitize_type);
                }
                if (is_array($v)) {
                    $array[$k] = $this->sanitize_array($v, $sanitize_rule);
                }
            }

            return $array;
        }

        /**
         * Sanitizes Value
         *
         * @param type $value
         * @param type $sanitize_type
         * @return string
         *
         * @since 1.0.0
         */
        function sanitize_value($value = '', $sanitize_type = 'text') {
            switch ($sanitize_type) {
                case 'html':
                    return $this->sanitize_html($value);
                    break;
                case 'to_br':
                    return $this->sanitize_escaping_linebreaks($value);
                    break;
                default:
                    return sanitize_text_field($value);
                    break;
            }
        }

        /**
         *
         * Sanitizes HTML
         *
         * @param string $value
         *
         * @since 1.0.0
         */
        function sanitize_html($value) {
            $allowed_html = wp_kses_allowed_html('post');
            $allowed_html['option'] = array('value' => array(), 'selected' => array());
            return wp_kses($value, $allowed_html);
        }

        function sort_terms_hierarchicaly(Array &$cats, Array &$into, $parentId = 0) {
            foreach ($cats as $i => $cat) {
                if ($cat->parent == $parentId) {
                    $into[$cat->term_id] = $cat;
                    unset($cats[$i]);
                }
            }

            foreach ($into as $topCat) {
                $topCat->children = array();
                $this->sort_terms_hierarchicaly($cats, $topCat->children, $topCat->term_id);
            }
        }

        function check_parent($term, $space = '') {
            if (is_object($term)) {
                if ($term->parent != 0) {
                    $space .= str_repeat('&nbsp;', 2);
                    $parent_term = get_term_by('id', $term->parent, $term->taxonomy);
                    $space .= $this->check_parent($parent_term, $space);
                }
            }

            return $space;
        }

        /**
         * Prints terms in checkbox with hierarchical format
         *
         * @since 1.0.0
         *
         * @param array $terms
         * @param array $exclude_terms
         * @param int $hierarchical
         * @param string $form
         * @param string $field_title
         * @param array $checked_term
         * @return string
         */
        function print_checkbox($terms, $exclude_terms = array(), $hierarchical = 1, $form = '', $field_title = '', $checked_term = array()) {


            foreach ($terms as $term) {
                if (!in_array($term->slug, $exclude_terms)) {
                    $space = $this->check_parent($term);
                    $option_value = ($hierarchical == 0) ? $term->name : $term->term_id;

                    $checked = (in_array($option_value, $checked_term)) ? 'checked="checked"' : '';
                    $form .= '<label class="fpsm-checkbox-label">' . $space . '<input type="checkbox" name="' . $field_title . '[]"  value="' . $option_value . '" id="fpsm-category-' . $option_value . '" ' . $checked . '/><label for="fpsm-category-' . $option_value . '" >' . $term->name . '</label></label>';
                }


                if (!empty($term->children)) {

                    $form .= $this->print_checkbox($term->children, $exclude_terms, $hierarchical, '', $field_title, $checked_term);
                }
            }

            return $form;
        }

        /**
         * Prints terms in checkbox with hierarchical format
         *
         * @since 1.0.0
         *
         * @param array $terms
         * @param array $exclude_terms
         * @param int $hierarchical
         * @param string $form
         * @param string $field_title
         * @param string $selected_term
         * @param string $taxonomy_print
         * @return string
         */
        function print_option($terms, $exclude_terms = array(), $hierarchical = 1, $form = '', $field_title = '', $selected_term = '', $taxonomy_print = false) {

            foreach ($terms as $term) {
                if (!in_array($term->slug, $exclude_terms)) {
                    $space = $this->check_parent($term);
                    $option_value = ($hierarchical == 0) ? $term->name : $term->term_id;
                    if ($taxonomy_print) {
                        $option_value = $option_value . '|' . $term->taxonomy;
                    }
                    if (is_array($selected_term)) {
                        $selected = (in_array($option_value, $selected_term)) ? 'selected="selected"' : '';
                    } else {

                        $selected = ($selected_term == $option_value) ? 'selected="selected"' : '';
                    }

                    $form .= '<option value="' . $option_value . '" ' . $selected . '>' . $space . $term->name . '</option>';
                }


                if (!empty($term->children)) {

                    $form .= $this->print_option($term->children, $exclude_terms, $hierarchical, '', $field_title, $selected_term, $taxonomy_print);
                }
            }

            return $form;
        }

        /**
         * Returns id of first author of WordPress
         *
         * @since 1.0.0
         *
         * @return int
         */
        function get_first_author() {
            $users = get_users(array('number' => 1));
            return $users[0]->ID;
        }

        /**
         * Prints display none
         *
         * @param string $first_param
         * @param string $second_param
         *
         * @since 1.0.0
         *
         * @return void
         */
        function display_none($first_param, $second_param) {
            echo ($first_param != $second_param) ? 'style="display:none"' : '';
        }

        /**
         * Generates current page URL
         *
         * @return string $pageURL
         *
         * @since 1.0.0
         */
        function get_current_page_url() {
            $pageURL = 'http';
            if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
                $pageURL .= "s";
            }
            $pageURL .= "://";
            if ($_SERVER["SERVER_PORT"] != "80") {
                $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
            } else {
                $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
            }
            $pageURL = explode('?', $pageURL);
            $pageURL = $pageURL[0];
            return $pageURL;
        }

        /**
         * Sanitizes field by converting line breaks to <br /> tags
         *
         * @since 1.0.0
         *
         * @return string $text
         */
        function sanitize_escaping_linebreaks($text) {
            $text = implode("<br \>", array_map('sanitize_text_field', explode("\n", $text)));
            return $text;
        }

        /**
         * Outputs by converting <Br/> tags into line breaks
         *
         * @since 1.0.0
         *
         * @return string $text
         */
        function output_converting_br($text) {
            $text = implode("\n", array_map('sanitize_text_field', explode("<br \>", $text)));
            return $text;
        }

        /**
         * Returns Post Formats
         *
         * @return array
         *
         * @since 1.0.0
         */
        function get_registered_post_formats() {
            return get_theme_support('post-formats');
        }

        /**
         * Check if alias has already been used or not
         *
         * @param string $form_alias
         * @param int $form_id
         *
         * @since 1.0.0
         */
        function is_alias_available($form_alias, $form_id = 0) {
            $form_table = FPSM_FORM_TABLE;
            global $wpdb;
            if (empty($form_id)) {
                $alias_count = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $form_table WHERE form_alias like %s", $form_alias));
            } else {
                $alias_count = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $form_table WHERE form_alias like %s  AND form_id !=%d", $form_alias, $form_id));
            }
            if ($alias_count == 0) {
                return true;
            } else {
                return false;
            }
        }

        /**
         * Returns form row by form id
         *
         * @param int $form_id
         *
         * @return array $form_row
         */
        function get_form_row_by_id($form_id) {
            global $wpdb;
            $form_table = FPSM_FORM_TABLE;
            $form_row = $wpdb->get_row($wpdb->prepare("select * from $form_table where form_id = %d", $form_id));
            return $form_row;
        }

        /**
         * Returns the list of registered users
         *
         * @param array $args
         *
         * @return array $users
         */
        function get_users($args = '') {
            $users = get_users($args);
            return $users;
        }

        /**
         * Returns the default field for frontend form         *
         * @return array $default_fields
         *
         * @since 1.0.0         *
         */
        function get_default_fields($post_type = 'post', $form_type = 'login_require') {
            $default_fields = array('post_title' => array(),
                'post_content' => array(),
                'post_image' => array(),
                'post_excerpt' => array()
            );
            if ($form_type == 'guest') {
                $default_fields['author_name'] = array();
                $default_fields['author_email'] = array();
            }
            $taxonomies = get_object_taxonomies($post_type, 'objects');
            if ($post_type == 'post') {
                unset($taxonomies['post_format']);
            }

            if (!empty($taxonomies)) {
                foreach ($taxonomies as $taxonomy => $taxonomy_details) {
                    $key = '_taxonomy|' . $taxonomy;
                    $default_fields[$key] = array();
                }
            }
            /**
             * Filter the default fields for form
             * @param array $default_fields
             *
             * @since 1.0.0
             */
            return apply_filters('fpsm_default_fields', $default_fields);
        }

        /**
         * Returns the respective file name for respective field type
         *
         * @param string $field_key
         * @return string $field_file
         *
         * @since 1.0.0
         */
        function generate_field_file($field_key) {
            if (strpos($field_key, '_taxonomy') === 0) {
                $field_file = 'taxonomy.php';
            } else if (strpos($field_key, '_custom_field') === 0) {
                $field_file = 'custom_field.php';
            } else {
                $field_file = "$field_key.php";
            }
            return $field_file;
        }

        /**
         * Gets the form row as per the alias
         *
         * @param string $alias
         *
         * @return object
         *
         * @since 1.0.0
         */
        function get_form_row_by_alias($alias) {
            global $wpdb;
            $form_table = FPSM_FORM_TABLE;
            $form_row = $wpdb->get_row($wpdb->prepare("select * from $form_table where form_alias = %s", $alias));
            return $form_row;
        }

        /**
         * Generates field class from field key
         *
         * @param string $field_key
         *
         * @since 1.0.0
         */
        function generate_field_class($field_key) {
            $field_class = str_replace('|', '-', $field_key);
            $field_class = str_replace('_', '-', $field_class);
            if ($field_class[0] == '-') {
                $field_class = substr($field_class, 1, strlen($field_class));
            }
            $field_class = 'fpsm-' . $field_class;
            return $field_class;
        }

        function save_media_to_library() {
            $filetype = wp_check_filetype($filename . '.' . $ext);
            $mime_type = $filetype['type'];
            $file_url = $upload_url . '/' . $filename . '.' . $ext;
            $file_path = $uploadDirectory . $filename . '.' . $ext;
            $attachment = array(
                'post_mime_type' => $mime_type,
                'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename . '.' . $ext)),
                'post_content' => '',
                'post_status' => 'inherit',
                'guid' => $file_url
            );
            require_once( ABSPATH . 'wp-admin/includes/admin.php' );
            $attachment_id = wp_insert_attachment($attachment, $file_path);
            require_once(ABSPATH . 'wp-admin/includes/image.php');
            $attachment_data = wp_generate_attachment_metadata($attachment_id, $file_path);
            $check = wp_update_attachment_metadata($attachment_id, $attachment_data);
            $attachment_date = get_the_date("U", $attachment_id);
            $attachment_code = md5($attachment_date);
            $media_details = array('attachment_id' => $attachment_id, 'attachment_code' => $attachment_code);
            return $media_details;
        }

        /**
         * Generates random string
         *
         * @param int $length
         * @return string
         */
        function generate_random_string($length = 7) {
            $random_string = '';
            $string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
            for ($i = 1; $i <= $length; $i++) {
                $random_string .= $string[rand(0, 61)];
            }
            return $random_string;
        }

        /**
         * Formats file size
         *
         * @param int $bytes
         * @return string
         */
        function format_file_size($bytes) {
            if ($bytes >= 1073741824) {
                $bytes = number_format($bytes / 1073741824, 2) . ' GB';
            } elseif ($bytes >= 1048576) {
                $bytes = number_format($bytes / 1048576, 2) . ' MB';
            } elseif ($bytes >= 1024) {
                $bytes = number_format($bytes / 1024, 2) . ' KB';
            } elseif ($bytes > 1) {
                $bytes = $bytes . ' bytes';
            } elseif ($bytes == 1) {
                $bytes = $bytes . ' byte';
            } else {
                $bytes = '0 bytes';
            }

            return $bytes;
        }

    }

    $GLOBALS['fpsm_library_obj'] = new FPSM_Library();
}
