<?php

return [
    'paths' => ['api/*'],
    'allowed_methods' => ['POST', 'OPTIONS'],
    'allowed_origins' => array_values(array_filter(array_map('trim', explode(',', env('FRONTEND_ORIGINS', '*'))))),
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['Accept', 'Content-Type', 'X-Requested-With'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => false,
];
