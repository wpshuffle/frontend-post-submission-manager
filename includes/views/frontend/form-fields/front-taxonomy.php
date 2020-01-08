<?php

$field_key_array = explode('|', $field_key);
$taxonomy = end($field_key_array);
$taxonomy_field_type = $field_details['field_type'];
$taxonomy_details = get_taxonomy($taxonomy);
switch ($taxonomy_field_type) {
    case 'checkbox':
        include(FPSM_PATH . '/includes/views/frontend/form-fields/taxonomy-fields/taxonomy-checkbox.php');
        break;
    case 'select':
        include(FPSM_PATH . '/includes/views/frontend/form-fields/taxonomy-fields/taxonomy-select.php');
        break;
    case 'textfield':
        include(FPSM_PATH . '/includes/views/frontend/form-fields/taxonomy-fields/taxonomy-textfield.php');
        break;
}
?>

