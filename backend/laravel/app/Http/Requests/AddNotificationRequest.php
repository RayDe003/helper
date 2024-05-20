<?php

namespace App\Http\Requests;

use App\Exceptions\ValidationErrorTrait;
use Illuminate\Foundation\Http\FormRequest;

class AddNotificationRequest extends FormRequest
{
    use ValidationErrorTrait;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'not_type_id' => 'required',
            'task_id' => 'required'
        ];
    }

}
