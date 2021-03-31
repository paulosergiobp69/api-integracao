<?php

namespace App\Http\Requests\API;

use App\Models\H100;
use InfyOm\Generator\Request\APIRequest;

class CreateH100APIRequest extends APIRequest
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
            'H100_D009_Id' => 'required',
            'H100_T012_Id' => 'required',
            'H100_C007_Id' => 'required',
            'H100_Quantidade' => 'nullable',
            'H100_Quantidade_Pac' => 'nullable',
            'H100_Saldo' => 'nullable',
            'H100_Valor_Unitario' => 'nullable|numeric',
            'H100_Status' => 'nullable|string|max:1',
            'H100_Data_Lancamento' => 'nullable'
        ];
        
        return $rules;
    }
}
