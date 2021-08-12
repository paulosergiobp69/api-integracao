<?php

namespace App\Http\Requests\API;

use App\Models\ProductDescription;
use InfyOm\Generator\Request\APIRequest;

class UpdateProductDescriptionAPIRequest extends APIRequest
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
            'hrd_D002_id' => 'integer',
            'product_utilization_id' => 'integer',
            'description' => 'string|max:50',
            'description_detail' => 'nullable|string|max:120',
            'deleted_by' => 'integer',
            'deleted_at' => 'nullable'
        ];

        return $rules;
    }
}
