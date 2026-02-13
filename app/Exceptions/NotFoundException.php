<?php

    namespace App\Exceptions;

    class NotFoundException extends AppException { 

        // statusCode
        protected int $statusCode = 404;

    }


?>