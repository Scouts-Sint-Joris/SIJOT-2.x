<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ActivityValidator
 * @package App\Http\Requests
 */
class ActivityValidator extends FormRequest
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
            'state'       => 'required',
            'group'       => 'required',
            'date'        => 'required',
            'start_time'  => 'required',
            'end_time'    => 'required',
            'description' => 'required',
            'heading'     => 'required',
        ];
    }
}
