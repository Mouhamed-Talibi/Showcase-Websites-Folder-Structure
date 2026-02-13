<?php

    namespace App\Exceptions;

    use Exception;

    class AppException extends Exception { 

        // statusCode
        protected int $statusCode = 500;
        protected $message = "Server Error. Try again later";

        // getStatusCode
        public function getStatusCode()
        {
            return $this->statusCode;
        }

    }


?>