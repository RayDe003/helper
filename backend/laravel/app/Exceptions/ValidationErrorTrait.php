<?php

namespace App\Exceptions;

use Illuminate\Contracts\Validation\Validator;

trait ValidationErrorTrait
{
    protected function failedValidation(Validator $validator) {
        throw new ApiException(message: $validator->errors()->all());
    }
}
