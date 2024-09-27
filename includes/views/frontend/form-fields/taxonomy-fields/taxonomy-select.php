<div class="fpsm-select-field <?php echo (!empty($field_details['select_multiple'])) ? 'fpsm-multiple-select' : ''; ?>">
    <select name="<?php echo esc_attr($field_key) ?><?php if (!empty($field_details['select_multiple'])) { ?>[]<?php } ?>" <?php if (!empty($field_details['select_multiple'])) { ?>multiple="multiple" <?php } ?> id="<?php echo esc_attr($field_id); ?>">
        <option value=""><?php echo (!empty($field_details['first_option_label'])) ? esc_html($field_details['first_option_label']) : esc_html__(sprintf('Choose %s', $taxonomy_details->label), 'frontend-post-submission-manager'); ?></option>
        <?php
        $child_of = !empty($field_details['child_of']) ? $field_details['child_of'] : 0;
        $terms_include = !empty($field_details['include_terms']) ? explode(',', $field_details['include_terms']) : array();
        $terms_include_ids = [];
        if (!empty($terms_include)) {

            foreach ($terms_include as $term_include_slug) {
                $term_include_obj = get_term_by('slug', $term_include_slug, $taxonomy);
                if (!empty($term_include_obj)) {
                    $terms_include_ids[] = $term_include_obj->term_id;
                }
            }
        }
        $term_args = [
            'hide_empty' => 0,
            'child_of' => $child_of
        ];
        if (!empty($terms_include_ids)) {
            $term_args['include'] = $terms_include_ids;
        }
        $terms = get_terms($taxonomy, $term_args);
        $terms_hierarchy = array();
        $fpsm_library_obj->sort_terms_hierarchicaly($terms, $terms_hierarchy, $child_of);
        $terms_exclude = !empty($field_details['exclude_terms']) ? explode(',', $field_details['exclude_terms']) : array();
        $args = array(
            'terms' => $terms_hierarchy,
            'exclude' => $terms_exclude,
            'hierarchical' => $taxonomy_details->hierarchical,
            'html' => '',
            'selected_terms' => (!empty($edit_post_terms_id)) ? $edit_post_terms_id : array()
        );
        if (count($terms_hierarchy) > 0) {
            $option = $fpsm_library_obj->print_terms_as_option($args);
            echo $fpsm_library_obj->sanitize_html($option);
        }
        ?>
    </select>
</div>