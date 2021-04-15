<?php

namespace App\Repositories;

use App\Models\PurchaseHistIncomingInvoice;
use App\Repositories\BaseRepository;

/**
 * Class PurchaseHistIncomingInvoiceRepository
 * @package App\Repositories
 * @version April 15, 2021, 11:29 am -03
*/

class PurchaseHistIncomingInvoiceRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'PHO_Id',
        'HRD_T014_Id',
        'HRD_Quantidade',
        'HRD_Valor_Custo_Unitario',
        'HRD_Flag_Cancelado',
        'HRD_Data_Lancamento',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PurchaseHistIncomingInvoice::class;
    }
}
