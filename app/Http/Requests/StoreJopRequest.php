<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJopRequest extends FormRequest
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
            //
        'title' => 'required|max:255|unique:jobs',
        'salary' => 'required|max:20',
        'country' => 'required',
        'city' => 'required',
        'company' => 'required|max:255',
        'email' => 'required|string',
        'phone' => 'bail|required|numeric',
        'zipcode' => 'required',
        'address' => 'required',
        'responsibility' => 'required',
        'skills' => 'required',
        'jobType' => 'required',
        'jobPositions' => 'required',
        'position_1' =>'required',
        'description' => 'required',
        ];
    }
}
