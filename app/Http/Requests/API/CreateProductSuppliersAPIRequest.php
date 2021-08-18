<?php

namespace App\Http\Requests\API;

use App\Models\ProductSuppliers;
use InfyOm\Generator\Request\APIRequest;

class CreateProductSuppliersAPIRequest extends APIRequest
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
            'hrd_D049_Id' => 'required|integer',
            'code_supplier' => 'required|string|max:30',
            'code_supplier_formatted' => 'nullable|string|max:30',
            'product_id' => 'required|integer',
            'technical_data' => 'nullable|string|max:60'
        ];
    }
}
