<?php

$field_key_array = explode('|', $field_key);
$taxonomy = end($field_key_array);
$taxonomy_field_type = $field_details['field_type'];
$taxonomy_details = get_taxonomy($taxonomy);
var_dump($taxonomy_field_type);
switch ($taxonomy_field_type) {
    case 'checkbox':
        include(FPSM_PATH . '/includes/views/frontend/form-fields/taxonomy-fields/taxonomy-checkbox.php');
        break;
    case 'select':
        break;
    case 'textfield':
        break;
}
?>

