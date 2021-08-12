<?php

namespace App\Http\Requests\API;

use App\Models\ProductGroup;
use InfyOm\Generator\Request\APIRequest;

class UpdateProductGroupAPIRequest extends APIRequest
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
            'hrd_D015_Id' => 'required|integer',
            'product_utilization_id' => 'required|integer',
            'name' => 'required|string|max:30',
            'active' => 'required|string|max:1',
            'created_by' => 'nullable|integer',
            'updated_by' => 'nullable|integer',
            'deleted_by' => 'nullable|integer',
            'deleted_at' => 'nullable',
            'created_at' => 'nullable',
            'updated_at' => 'nullable'
        ];
        
        return $rules;
    }
}
