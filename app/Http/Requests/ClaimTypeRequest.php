<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClaimTypeRequest extends FormRequest
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
        $pk = $this->claim_type ? $this->claim_type->ClaimTypeId_PK : null;
        return [
            'Claim_Type_Code' => 'required|string|max:10|unique:claim_types,claim_type_code'.($pk?",$pk,ClaimTypeId_PK":""),
            'ISO_Loss_Type_Code' => 'required|string|max:20|unique:claim_types,iso_loss_type_code'.($pk?",$pk,ClaimTypeId_PK":""),
            'd_EffectiveFrom' => 'required|date',
            'd_EffectiveTo' => 'required|date'
        ];
    }
}
