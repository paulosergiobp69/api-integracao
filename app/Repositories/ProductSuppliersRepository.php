<?php

namespace App\Repositories;

use App\Models\ProductSuppliers;
use App\Repositories\BaseRepository;

/**
 * Class ProductSuppliersRepository
 * @package App\Repositories
 * @version August 17, 2021, 4:24 pm -03
*/

class ProductSuppliersRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'hrd_D049_Id',
        'code_supplier',
        'code_supplier_formatted',
        'product_id',
        'technical_data',
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
        return ProductSuppliers::class;
    }
}
