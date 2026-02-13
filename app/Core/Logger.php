<?php
    declare(strict_types=1);

    namespace App\Core;

    class Logger
    {
        /**
         * Logs directory
         */
        private static string $logsDir = LOGS_DIR;

        /**
         * Write log entry
         */
        private static function write(string $filename, string $level, string $message): void
        {
            $dir = rtrim(self::$logsDir, '/\\');

            // Create logs directory if missing
            if (!is_dir($dir)) {
                mkdir($dir, 0755, true);
            }

            // Full file path
            $filePath = $dir . DIRECTORY_SEPARATOR . $filename;

            // Format message
            $date = date('Y-m-d H:i:s');

            $log = sprintf(
                "[%s] [%s] %s%s",
                $date,
                $level,
                $message,
                PHP_EOL
            );

            // Write safely (lock file)
            file_put_contents($filePath, $log, FILE_APPEND | LOCK_EX);
        }

        /**
         * Info log
         */
        public static function info(string $message): void
        {
            self::write('info.log', 'INFO', $message);
        }

        /**
         * Warning log
         */
        public static function warning(string $message): void
        {
            self::write('warning.log', 'WARNING', $message);
        }

        /**
         * Error log
         */
        public static function error(string $message): void
        {
            self::write('error.log', 'ERROR', $message);
        }
    }
