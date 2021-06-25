<?php

namespace App\Http\Requests\API;

use App\Models\PurchaseHistOrders;
use InfyOm\Generator\Request\APIRequest;

class CreatePurchaseHistOrdersAPIRequest extends ResponseAPIRequest
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
            'HRD_T011_Id' => 'required|integer',
            'HRD_T012_Id' => 'required|integer',
            'HRD_T012_D009_Id' => 'required|integer',
            'HRD_T011_C007_Id' => 'required|integer',
            'HRD_T011_C004_Id' => 'required|integer',
            'HRD_T012_Quantidade' => 'nullable|integer',
            'HRD_Quantidade_Pac' => 'nullable|integer',
            'HRD_Saldo' => 'nullable|integer',
            'HRD_T012_Valor_Custo_Unitario' => 'nullable|numeric',
            'HRD_Status' => 'nullable|string|max:255',
            'HRD_Data_Lancamento' => 'nullable',
            'HRD_T012_Ajuste_Saldo' => 'nullable|integer',
            'HRD_C007_Ajuste_Saldo' => 'nullable|integer'
        ];
        return $rules;
    }
}
