<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJobApplication extends FormRequest
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
           'firstName' => 'required|max:255',
           'lastName' => 'required|max:255',
           'email' => 'required',
           'phoneNumber' => 'required',
           'address' => 'required|max:255',
           'jobPositon' => 'required',
           'zipCode' => 'required',
           'country'=> 'required',
           'city'=> 'required',
           'resume' => 'required',
           'description' => 'required',
           'dateOfBirth' => 'required',
        ];
    }
}
