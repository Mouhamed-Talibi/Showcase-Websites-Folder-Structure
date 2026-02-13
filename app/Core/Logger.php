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
         * Get correct log file based on environment
         */
        private static function getLogFile(string $level): string
        {
            // Development: single log file
            if (APP_ENV === 'development') {
                return 'dev_error.log';
            }

            // Production: separate logs
            return match ($level) {
                'INFO'    => 'info.log',
                'WARNING' => 'warning.log',
                'ERROR'   => 'error.log',
                default  => 'app.log',
            };
        }


        /**
         * Write log entry
         */
        private static function write(string $level, string $message): void
        {
            $dir = rtrim(self::$logsDir, '/\\');

            // Create logs directory if missing
            if (!is_dir($dir)) {
                mkdir($dir, 0755, true);
            }

            // Select file
            $filename = self::getLogFile($level);

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
            self::write('INFO', $message);
        }


        /**
         * Warning log
         */
        public static function warning(string $message): void
        {
            self::write('WARNING', $message);
        }


        /**
         * Error log
         */
        public static function error(string $message): void
        {
            self::write('ERROR', $message);
        }
    }
