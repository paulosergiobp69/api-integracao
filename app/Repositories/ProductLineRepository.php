<?php

namespace App\Repositories;

use App\Models\ProductLine;
use App\Repositories\BaseRepository;

/**
 * Class ProductLineRepository
 * @package App\Repositories
 * @version August 5, 2021, 5:11 pm -03
*/

class ProductLineRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'hrd_D003_Id',
        'product_utilization_id',
        'name',
        'abbreviation',
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
        return ProductLine::class;
    }
}
