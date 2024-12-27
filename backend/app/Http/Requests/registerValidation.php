<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class registerValidation extends FormRequest
{
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
            'Address'=>'required|max:30',
            'Alternative'=>'required|digits:10',
            'Roll_Number'=>'required|digits:10',
            'Bfhus_Id'=>'required|digits:4',
            'Dob'=>'required|before:' . date('1-1-2002').'|after:' . date('1-1-1960'),
            'date_of_baptism'=>'required|before:' . date('d-m-Y').'|after:' . date('1-1-2002'),
            'Neet_Score'=>'required|lte:720',
            'Duration_Membership'=>'required|lte:365',
            'Father_Name'=>'required|max:30',
            'Mother_Name'=>'required|max:30',
            'Landline_Number'=>'required|digits:10',
            'Mobile'=>'required|digits:10',
            'Rank'=>'required|lte:1000|max:1000',
            'State'=>'required',
            'Username'=>'alpha_dash:ascii|required',
            'course'=>'required',
            'email'=>'required|email|email:rfc,dns',
            'gender'=>'required',
            'member'=>'required|lte:1000|max:4',
            'religion'=>'required'
        ];
    }
}
