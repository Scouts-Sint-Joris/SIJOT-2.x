<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MembersValidator extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'firstname'         => 'required',
            'lastname'          => 'required',
            'gender'            => 'required',
            'email'             => 'required',
            'birth_date'        => 'required',
            'mobile_number'     => 'required',
            'city'              => 'required',
            'street'            => 'required',
            'house_number'      => 'required',
            'country'           => 'required',
        ];
    }
}
