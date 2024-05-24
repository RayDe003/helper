<?php

namespace App\Exceptions;

use App\Exceptions\ApiException;

class TaskNotFoundException extends ApiException
{
    public function __construct($code = 404, $message = 'Данная задача не найдена.')
    {
        parent::__construct($code, $message);
    }
}
