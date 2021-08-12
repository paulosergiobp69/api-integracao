<?php

namespace App\Http\Requests\API;

use App\Models\Product;
use InfyOm\Generator\Request\APIRequest;

class UpdateProductAPIRequest extends APIRequest
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
            'hrd_D001_Id' => 'integer',
            'product_description_id' => 'integer',
            'product_line_id' => 'integer',
            'product_group_id' => 'integer',
            'product_utilization_id' => 'integer',
            'code' => 'string|max:30',
            'reference' => 'nullable|string|max:30',
            'technical_data' => 'nullable|string',
            'application' => 'nullable|string|max:60',
            'commercial_description' => 'nullable|string|max:60',
            'unit_weight_kg' => 'numeric',
            'development_flag' => 'string|max:1',
            'development_date' => 'nullable',
            'code_formatted' => 'string|max:20',
            'reference_formatted' => 'nullable|string|max:23',
            'code_redirect' => 'nullable|string|max:30',
            'deleted_by' => 'integer',
            'deleted_at' => 'nullable'
        ];
        
        return $rules;
    }
}
