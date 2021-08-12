<?php

namespace App\Http\Requests\API;

use App\Models\ProductDescription;
use InfyOm\Generator\Request\APIRequest;

class CreateProductDescriptionAPIRequest extends APIRequest
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
            'hrd_D002_id' => 'required|integer',
            'product_utilization_id' => 'required|integer',
            'description' => 'required|string|max:50',
            'description_detail' => 'nullable|string|max:120'
        ];
        
        return $rules;
    }
}
