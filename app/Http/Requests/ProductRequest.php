<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        $pk = $this->product ? $this->product->n_ProductId_PK : null;
        return [
            's_ProductCode' => 'required|string|max:30|unique:products,product_code'.($pk?",$pk,n_ProductId_PK":""),
            's_ProductName' => 'required|string|max:50|unique:products,product_name'.($pk?",$pk,n_ProductId_PK":""),
            's_PolicyNoInitial' => 'nullable|string|max:10',
            'n_EditVersion' => 'nullable|numeric|gt:0',
            'd_EffectiveFrom' => 'required|date',
            'd_EffectiveTo' => 'required|date'
        ];
    }
}
