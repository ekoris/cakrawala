<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ];
    }


    public function authorize()
    {
        return true;
    }

    protected function failedValidation($validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => 401,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }
}
