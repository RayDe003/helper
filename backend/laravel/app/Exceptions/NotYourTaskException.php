<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;

class NotYourTaskException extends ApiException
{
    public function __construct($code = 403, $message = 'Данная задача не принадлежит Вам.')
    {
        parent::__construct($code, $message);
    }
}
