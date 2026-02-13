<?php

    declare(strict_types=1);
    error_reporting(E_ALL);

    /*
    |--------------------------------------------------------------------------
    | App Info
    |--------------------------------------------------------------------------
    */

    define('APP_NAME', 'FolderStructureBase');
    define('APP_ENV', 'production'); // development | production
    define('APP_DEBUG', false);


    /*
    |--------------------------------------------------------------------------
    | Base Path
    |--------------------------------------------------------------------------
    */

    define('BASE_PATH', dirname(__DIR__));


    /*
    |--------------------------------------------------------------------------
    | Paths
    |--------------------------------------------------------------------------
    */

    define('APP_PATH', BASE_PATH . '/app');
    define('PUBLIC_PATH', 
        (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/FolderStructureBase/public'
    );
    define('VIEW_PATH', APP_PATH . '/Views');
    define('ERRORS_PATH', VIEW_PATH . '/errors');
    define('INCLUDES_PATH', VIEW_PATH . '/includes');
    define('CONFIG_PATH', BASE_PATH . '/config');
    define('STORAGE_PATH', BASE_PATH . '/storage');
    define('LOGS_DIR', STORAGE_PATH . '/logs');


    /*
    |--------------------------------------------------------------------------
    | Base URL
    |--------------------------------------------------------------------------
    | Change if needed
    */

    define('BASE_URL', 'http://localhost/FolderStructureBase/public/');


    /*
    |--------------------------------------------------------------------------
    | Timezone
    |--------------------------------------------------------------------------
    */

    define('TIMEZONE', 'Africa/Casablanca');
    date_default_timezone_set(TIMEZONE);


    /*
    |--------------------------------------------------------------------------
    | Error Reporting
    |--------------------------------------------------------------------------
    */

    // create logs dir if missing
    if(!is_dir(LOGS_DIR)) {
        mkdir(LOGS_DIR, 0755, true);
    }

    if (APP_ENV === 'development' && APP_DEBUG) {

        // Development: show all errors
        ini_set('display_errors', '1');
        ini_set('display_startup_errors', '1');
        ini_set('log_errors', '1');
        ini_set('error_log', LOGS_DIR . '/dev_error.log');

    } else {

        // Production: hide errors, log only
        ini_set('display_errors', '0');
        ini_set('display_startup_errors', '0');
        ini_set('log_errors', '1');
        ini_set('error_log', LOGS_DIR . '/error.log');
    }