<?php

namespace App\Http\Requests\API;

use App\Models\H101;
use InfyOm\Generator\Request\APIRequest;

class CreateH101APIRequest extends APIRequest
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
            'H101_H100_Id' => 'required',
            'H101_T014_Id' => 'required',
            'H101_Quantidade' => 'nullable',
            'H101_Flag_Cancelado' => 'nullable|string|max:1',
            'H101_Valor_Unitario' => 'nullable|numeric',
            'H101_Data_Lancamento' => 'nullable'
        ];
        return $rules;
    }
}
