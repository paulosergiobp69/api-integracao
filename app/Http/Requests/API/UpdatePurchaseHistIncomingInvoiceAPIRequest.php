<?php

namespace App\Http\Requests\API;

use App\Models\PurchaseHistIncomingInvoice;
use InfyOm\Generator\Request\APIRequest;

class UpdatePurchaseHistIncomingInvoiceAPIRequest extends APIRequest
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
            'PHO_Id' => 'integer',
            'HRD_T014_Id' => 'integer',
            'HRD_Quantidade' => 'nullable|integer',
            'HRD_Valor_Custo_Unitario' => 'nullable|numeric',
            'HRD_Flag_Cancelado' => 'nullable|string|max:1',
            'HRD_Data_Lancamento' => 'nullable'
        ];

        return $rules;
    }
}
