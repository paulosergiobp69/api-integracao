<?php

namespace App\Repositories;

use App\Models\PurchaseHistOrders;
use Illuminate\Database\Eloquent\Model;
//use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

/**
 * Class PurchaseHistOrdersRepository
 * @package App\Repositories
 * @version April 14, 2021, 9:01 am -03
*/

class PurchaseHistOrdersRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'HRD_T011_Id',
        'HRD_T012_Id',
        'HRD_T012_D009_Id',
        'HRD_T011_C007_Id',
        'HRD_T011_C004_Id',
        'HRD_T012_Quantidade',
        'HRD_Quantidade_Pac',
        'HRD_Saldo',
        'HRD_T012_Valor_Custo_Unitario',
        'HRD_Status',
        'HRD_Data_Lancamento',
        'HRD_T012_Ajuste_Saldo',
        'HRD_C007_Ajuste_Saldo'
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
        return PurchaseHistOrders::class;
    }

    
     /**
     * Retorna faz a busca filtrandopor campos padrão caso houver
     *
     * @param int $HRD_T011_Id
     * @param int $HRD_T012_Id
     * @param int $HRD_T012_D009_Id
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|
     *  \Illuminate\Database\Eloquent\Collection|Model|null
     */
    public function findAll($HRD_T011_Id = null, $HRD_T012_Id = null, $HRD_T012_D009_Id = null)
    {
        return $this->model;
    }

}
