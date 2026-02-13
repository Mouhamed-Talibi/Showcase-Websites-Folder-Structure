<?php

    require_once __DIR__ . '/../vendor/autoload.php';
    require_once __DIR__ . '/../config/app.php';

    use App\Core\Logger;
    use App\Core\Router;
    use App\Exceptions\AppException;

    /**
     * Central exception handler
     */
    function handleException(Throwable $e): void
    {
        // Default status code
        $code = 500;

        // If it's our custom exception
        if ($e instanceof AppException) {
            $code = $e->getStatusCode();
        }

        // Log error
        Logger::error(sprintf(
            "%s in %s:%d\nTrace:\n%s",
            $e->getMessage(),
            $e->getFile(),
            $e->getLine(),
            $e->getTraceAsString()
        ));

        // Production
        if (APP_ENV === 'production') {

            http_response_code($code);
            $errorPage = ERRORS_PATH . "/{$code}.php";

            if (file_exists($errorPage)) {
                require_once $errorPage;
            } else {
                require ERRORS_PATH . '/500.php';
            }
            exit;
        }

        // Development
        echo "<pre>";
            echo $e;
        echo "</pre>";
        exit;
    }


    /**
     * Global exception handler
     */
    set_exception_handler('handleException');

    // Create router
    $router = new Router();

    // Load routes
    require_once BASE_PATH . '/routes/web.php';

    // Resolve request
    try {
        $router->resolve();

    } catch (Throwable $e) {
        // Send everything to one handler
        handleException($e);
    }
