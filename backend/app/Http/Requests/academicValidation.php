<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class academicValidation extends FormRequest
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
            'email'=>'required|email|email:rfc,dns',
           'X_Board'=>'required|max:30|min:2',
           'X_year'=>'required|digits:4|numeric',
           'X_Marks'=>'required|digits:3',
           'X_State'=>'required ',

           'Xi_Board'=>'required |max:30|min:2',
           'Xi_year'=>'required|digits:4',
           'Xi_marks'=>'required|digits:3',
           'Xi_State'=>'required',

           'Xii_Board'=>'required |max:30|min:2',
           'Xii_year'=>'required|digits:4',
           'Xii_Marks'=>'required|digits:3',
           'Xii_State'=>'required',
        ];
    }
}
