<?php

namespace App\Repositories;

use App\Models\PurchaseHistOrders;
use App\Repositories\BaseRepository;

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
        'HRD_Data_Lancamento'
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
     * Add a basic where clause to the query.
     *
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|Model
     */
    public function advancedSearch($request)
    {
        $input = $request->get('search');
        $baseModel = $this->model->newQuery();
//        if ($request->exists('fields')) {
//            $baseModel->select($this->mountFieldsToSelect($request));
//        }
        foreach ($this->fieldSearchable as $colum) {
            $type = $this->model()::getFieldType($colum);
       //     if ($type && $type == 'string') {
       //         $baseModel->orWhere($colum, 'ilike', '%' . $input . '%');
       //     }
        }

        return $baseModel;
    }


}
