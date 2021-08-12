<?php

namespace App\Http\Requests\API;

use App\Models\ProductReplacement;
use InfyOm\Generator\Request\APIRequest;

class UpdateProductReplacementAPIRequest extends APIRequest
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
                'product_id' => 'integer',
                'product_utilization_id' => 'integer',
                'user_hrd_id' => 'integer',
                'code_new' => 'nullable|string|max:20',
                'code_old' => 'nullable|string|max:20',
                'date_include' => 'nullable',
                'code_formatted_old' => 'nullable|string|max:20',
                'hrd_D017_Id' => 'integer',
                'deleted_by' => 'nullable|integer',
                'deleted_at' => 'nullable'
        ];
        
        return $rules;
    }
}
