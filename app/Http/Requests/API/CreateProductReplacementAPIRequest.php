<?php

namespace App\Http\Requests\API;

use App\Models\ProductReplacement;
use InfyOm\Generator\Request\APIRequest;

class CreateProductReplacementAPIRequest extends APIRequest
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
            'product_id' => 'required|integer',
            'product_utilization_id' => 'required|integer',
            'user_hrd_id' => 'required|integer',
            'code_new' => 'nullable|string|max:20',
            'code_old' => 'nullable|string|max:20',
            'date_include' => 'nullable',
            'code_formatted_old' => 'nullable|string|max:20',
            'hrd_D017_Id' => 'required|integer'
        ];
    }
}
