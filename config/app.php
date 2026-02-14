<?php

    declare(strict_types=1);

    /*
    |--------------------------------------------------------------------------
    | Error Reporting (Default)
    |--------------------------------------------------------------------------
    */
    error_reporting(E_ALL);


    /*
    |--------------------------------------------------------------------------
    | Server Info (Dynamic Detection)
    |--------------------------------------------------------------------------
    */

    // Protocol (http / https)
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
        ? 'https'
        : 'http';

    // Host (domain / localhost)
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';

    // Public directory (/project/public)
    $publicDir = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');


    /*
    |--------------------------------------------------------------------------
    | App Info
    |--------------------------------------------------------------------------
    */

    define('APP_NAME', 'FolderStructureBase');
    define('APP_ENV', 'development'); // development | production
    define('APP_DEBUG', true);


    /*
    |--------------------------------------------------------------------------
    | Base Path (Filesystem Root)
    |--------------------------------------------------------------------------
    */

    // /var/www/project OR C:/xampp/htdocs/project
    define('BASE_PATH', dirname(__DIR__));


    /*
    |--------------------------------------------------------------------------
    | Filesystem Paths
    |--------------------------------------------------------------------------
    */

    define('APP_PATH', BASE_PATH . '/app');
    define('VIEW_PATH', APP_PATH . '/Views');
    define('ERRORS_PATH', VIEW_PATH . '/errors');
    define('INCLUDES_PATH', VIEW_PATH . '/includes');

    define('CONFIG_PATH', BASE_PATH . '/config');
    define('STORAGE_PATH', BASE_PATH . '/storage');
    define('LOGS_PATH', STORAGE_PATH . '/logs');


    /*
    |--------------------------------------------------------------------------
    | URLs (Dynamic)
    |--------------------------------------------------------------------------
    */

    // http://domain.com/project/public
    define('PUBLIC_URL', $protocol . '://' . $host . $publicDir . '/');

    // http://domain.com/project
    define('BASE_URL', $protocol . '://' . $host . dirname($publicDir));


    /*
    |--------------------------------------------------------------------------
    | Timezone
    |--------------------------------------------------------------------------
    */

    define('TIMEZONE', 'Africa/Casablanca');
    date_default_timezone_set(TIMEZONE);


    /*
    |--------------------------------------------------------------------------
    | Logs Directory
    |--------------------------------------------------------------------------
    */

    if (!is_dir(LOGS_PATH)) {
        mkdir(LOGS_PATH, 0755, true);
    }


    /*
    |--------------------------------------------------------------------------
    | Error Handling (By Environment)
    |--------------------------------------------------------------------------
    */

    if (APP_ENV === 'development' && APP_DEBUG === true) {

        // Development Mode
        ini_set('display_errors', '1');
        ini_set('display_startup_errors', '1');

        ini_set('log_errors', '1');
        ini_set('error_log', LOGS_PATH . '/dev_error.log');

    } else {

        // Production Mode
        ini_set('display_errors', '0');
        ini_set('display_startup_errors', '0');

        ini_set('log_errors', '1');
        ini_set('error_log', LOGS_PATH . '/error.log');
    }
