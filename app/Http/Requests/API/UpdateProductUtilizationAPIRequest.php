<?php

namespace App\Http\Requests\API;

use App\Models\ProductUtilization;
use InfyOm\Generator\Request\APIRequest;

class UpdateProductUtilizationAPIRequest extends APIRequest
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
            'hrd_C008_Id' => 'integer',
            'type' => 'string|max:20',
            'deleted_by' => 'nullable|integer',
            'deleted_at' => 'nullable'
        ];
        
        return $rules;
    }
}
