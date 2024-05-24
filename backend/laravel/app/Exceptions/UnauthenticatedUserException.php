<?php

namespace App\Exceptions;

class UnauthenticatedUserException extends ApiException
{
    public function __construct($code = 401,$message = "Пользователь не аутентифицирован")
    {
        parent::__construct($code, $message);
    }

}
