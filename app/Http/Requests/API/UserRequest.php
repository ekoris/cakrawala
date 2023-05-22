<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
{
    public function rules()
    {
        return [];
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


    public function data()
    {
        $data = $this->all();
        if (isset($data['password'])) {
            $data['password'] = bcrypt($this->password);
        }

        if (isset($data['profile_picture'])) {
            $profilePicture = time().'_'.$data['profile_picture']->getClientOriginalName();
            $data['profile_picture']->storeAs('profil/'.logged_in_user()->id, $profilePicture, 'public');
            $data['profile_picture'] = $profilePicture;
        }

        return $data;
    }
}
