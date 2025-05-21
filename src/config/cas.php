<?php

return [
    'cas_hostname' => env('CAS_HOST', ''),
    'cas_uri' => '/cas',
    'cas_port' => 443,
    'cas_version' => '2.0',
    'server_login_uri' => '/cas/login',
    'server_logout_uri' => '/cas/logout',
    'cas_debug' => env('CAS_DEBUG', false),
    'cas_verbose_errors' => env('CAS_VERBOSE_ERRORS', false),
    'cas_service' => env('APP_URL', '') . '/cas/callback',
    'cas_redirect_path' => env('APP_URL', '') . '/cas/callback',
    'cas_validate_cn' => false,
    'cas_login_url' => env('CAS_HOST', '') . '/cas/login',
    'cas_logout_url' => env('CAS_HOST', '') . '/cas/logout',
    'cas_logout_redirect' => env('CAS_HOST', '') . '/cas/logout',
    'cas_enable_saml' => false,
    'cas_cert' => false,
    'cas_proxy' => false,
    'cas_ignore_cert' => true,
    
    /*
         * API Service Configuration
     */
    'api_endpoint' => env('CAS_API_ENDPOINT', ''),
    'api_key' => env('CAS_API_KEY', ''),
    
    /*
     * Route Configuration
     */
    'route_prefix' => env('CAS_ROUTE_PREFIX', ''),
    'route_name_prefix' => env('CAS_ROUTE_NAME_PREFIX', ''),
    
    /*
     * Redirect paths
     */
    'redirect_after_login' => env('CAS_REDIRECT_AFTER_LOGIN', '/'),
    'redirect_after_logout' => env('CAS_REDIRECT_AFTER_LOGOUT', '/'),
];