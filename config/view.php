<?php

return [

    'paths' => [
        resource_path('views'),
    ],

    'compiled' => env('VIEW_COMPILED_PATH') ?: storage_path('framework/views'),

    'compiled_extension' => 'php',

    'relative_hash' => false,

    'cache' => true,

    'check_cache_timestamps' => true,

];
