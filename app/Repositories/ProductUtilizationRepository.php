<?php

namespace App\Repositories;

use App\Models\ProductUtilization;
use App\Repositories\BaseRepository;

/**
 * Class ProductUtilizationRepository
 * @package App\Repositories
 * @version August 5, 2021, 5:12 pm -03
*/

class ProductUtilizationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'hrd_C008_Id',
        'type',
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
        return ProductUtilization::class;
    }
}
