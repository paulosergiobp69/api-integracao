<?php

namespace App\Http\Requests\API;

use App\Models\ProductLine;
use InfyOm\Generator\Request\APIRequest;

class UpdateProductLineAPIRequest extends APIRequest
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
            'hrd_D003_Id' => 'integer',
            'product_utilization_id' => 'integer',
            'name' => 'string|max:11',
            'abbreviation' => 'nullable|string|max:3',
            'active' => 'string|max:1',
            'deleted_by' => 'nullable|integer',
            'deleted_at' => 'nullable'
        ];
        
        return $rules;
    }
}
