<?php

namespace App\Http\Requests\API;

use App\Models\ProductLine;
use InfyOm\Generator\Request\APIRequest;

class CreateProductLineAPIRequest extends APIRequest
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
            'hrd_D003_Id' => 'required|integer',
            'product_utilization_id' => 'required|integer',
            'name' => 'required|string|max:11',
            'abbreviation' => 'nullable|string|max:3',
            'active' => 'required|string|max:1'
        ];
    }
}
