<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonRequest extends FormRequest
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
            's_FirstName' => 'required|string|max:50',
            's_LastOrganizationName' => 'required|string|max:255',
            's_FullLegalName' => 'string|max:255',
        ];
    }
}
