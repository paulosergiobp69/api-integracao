<?php

namespace App\Repositories;

use App\Models\ProductGroup;
use App\Repositories\BaseRepository;

/**
 * Class ProductGroupRepository
 * @package App\Repositories
 * @version August 5, 2021, 5:11 pm -03
*/

class ProductGroupRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'hrd_D015_Id',
        'product_utilization_id',
        'name',
        'active',
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
        return ProductGroup::class;
    }
}
