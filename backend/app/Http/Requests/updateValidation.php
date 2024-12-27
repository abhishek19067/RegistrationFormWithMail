<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateValidation extends FormRequest
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
            'Address' => 'required|max:50|min:10',
            'All_India_Rank' => 'required|min:1|max:4',
            'Alternative' => 'required|max:10|min:10',
            'BFUHS_REGISTRATION_ID' => 'required|min:4|max:4',
            'Date_Baptism' => 'required',
            'Dob' => 'required',
            'Duration_Membership' => 'required|min:1|max:10',
            'Father_Name' => 'required|min:2|max:20',
            'Gender' => 'required',
            'Landline_Number' => 'required|max:10|min:10',
            'Mobile' => 'required|max:10|min:10',
            'Member_Chruch' => 'required',
            'Mother_Name' => 'required|max:20|min:2',
            'Neet_Score' => 'required|max:720',
            'Religion' => 'required',
            'Roll_Number' => 'required|min:10|max:10',
            'State' => 'required',
            'Username' => 'required|min:4|max:120',
            'board' => 'required',
            'X_year' => 'required',
            'X_Marks' => 'required',
            'X_State' => 'required',
            'XI_Board' => 'required',
            'XI_year' => 'required',
            'XI_Marks' => 'required',
            'XI_State' => 'required',
            'XII_Board' => 'required',
            'XII_year' => 'required',
            'XII_Marks' => 'required',
            'XII_State' => 'required',
            'course' => 'required',
            'email' => 'required|email',
        ];
    }
}
