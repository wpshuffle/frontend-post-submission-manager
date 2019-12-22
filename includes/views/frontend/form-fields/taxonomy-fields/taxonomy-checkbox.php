<?php

$child_of = isset($field_details['parent_term']) ? esc_attr($field_details['parent_term']) : 0;
$terms = get_terms($taxonomy, array('hide_empty' => 0, 'child_of' => $child_of));
echo "<pre>";
print_r($terms);
echo "</pre>";
$categoryHierarchy = array();
$fpsm_library_obj->sort_terms_hierarchicaly($terms, $categoryHierarchy, $child_of);
$terms_exclude = !empty($field_details['exclude_terms']) ? explode(',', $field_details['exclude_terms']) : array();

$option_count = 0;
if (count($categoryHierarchy) > 0) {
    $fpsm_library_obj->print_checkbox($categoryHierarchy, $terms_exclude, $taxonomy_details->hierarchical, '', $taxonomy);
}