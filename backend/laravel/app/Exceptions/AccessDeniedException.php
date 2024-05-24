<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;

class AccessDeniedException extends ApiException
{
    public function __construct($code = 403, $message = 'Доступ запрещен.')
    {
        parent::__construct($code, $message);
    }
}
