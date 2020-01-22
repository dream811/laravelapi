<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PolicyRequest extends FormRequest
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
        $id = $this->policy ? $this->policy->id : null;
        return [
            //'policy_no' => 'required|string|max:25|unique:policies,policy_no'.($id?",$id,id":""), //auto generated
            'n_ProductId_FK' => 'required',
            'n_OwnerId_FK' => 'required',
        ];
    }
}
