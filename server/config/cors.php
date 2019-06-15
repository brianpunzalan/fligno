<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel CORS
    |--------------------------------------------------------------------------
    |
    | allowedOrigins, allowedHeaders and allowedMethods can be set to array('*')
    | to accept any value.
    |
    */
   
    'supportsCredentials' => false,
    'allowedOrigins' => explode(',', env('CORS_ALLOWED_ORIGINS')),
    'allowedOriginsPatterns' => empty(env('CORS_ALLOWED_ORIGINS_PATTERNS')) ? [] : explode(',', env('CORS_ALLOWED_ORIGINS_PATTERNS')),
    'allowedHeaders' => ['*'],
    'allowedMethods' => ['*'],
    'exposedHeaders' => [],
    'maxAge' => 0,

];
