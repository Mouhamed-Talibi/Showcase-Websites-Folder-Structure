<?php

    namespace App\Core;

    use App\Exceptions\AppException;

    class View
    {
        // Default constants
        private static string $fileExt = '.php';
        private static string $mainLayout = 'layouts/main';

        /**
         * Render view
         */
        public static function render(string $view, array $data = []): void
        {
            // Make variables available in view
            extract($data);

            // Get view file
            $viewFile = self::getViewPath($view);

            if (!file_exists($viewFile)) {
                throw new AppException("View not found: $viewFile");
            }

            // Start buffering
            ob_start();

            // Include page view
            require $viewFile;

            // Get page content
            $content = ob_get_clean();

            // Get layout
            $layoutFile = self::getLayoutPath();

            if (!file_exists($layoutFile)) {
                throw new AppException("Layout not found: $layoutFile");
            }

            // Render layout (with $content inside)
            require $layoutFile;
        }

        /**
         * Set layout
         */
        public static function setLayout(string $layout): void
        {
            self::$mainLayout = $layout;
        }

        /**
         * Get view file path
         */
        protected static function getViewPath(string $view): string
        {
            return dirname(__DIR__, 2)
                . "/app/Views/pages/"
                . $view
                . self::$fileExt;
        }

        /**
         * Get layout file path
         */
        protected static function getLayoutPath(): string
        {
            return dirname(__DIR__, 2)
                . "/app/Views/"
                . self::$mainLayout
                . self::$fileExt;
        }
    }
