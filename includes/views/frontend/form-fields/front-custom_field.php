<?php

$field_type = $field_details['field_type'];
$field_file = 'front-' . $field_type . '.php';
if (file_exists(FPSM_PATH . '/includes/views/frontend/custom-field-types/' . $field_file)) {
    include(FPSM_PATH . '/includes/views/frontend/custom-field-types/' . $field_file);
}
?>