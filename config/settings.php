<?php
$jsonPath = base_path('settings.json');
$settings = file_exists($jsonPath) ? json_decode(file_get_contents($jsonPath), true) : [];
return [
    'catalogos' => $settings
];