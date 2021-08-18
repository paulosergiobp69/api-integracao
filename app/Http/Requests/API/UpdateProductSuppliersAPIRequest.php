<?php

namespace App\Http\Requests\API;

use App\Models\ProductSuppliers;
use InfyOm\Generator\Request\APIRequest;

class UpdateProductSuppliersAPIRequest extends APIRequest
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
        $rules = [            
            'hrd_D049_Id' => 'integer',
            'code_supplier' => 'string|max:30',
            'code_supplier_formatted' => 'nullable|string|max:30',
            'product_id' => 'integer',
            'technical_data' => 'nullable|string|max:60',
            'deleted_by' => 'nullable|integer',
            'deleted_at' => 'nullable'
        ];
        
        return $rules;
    }
}
