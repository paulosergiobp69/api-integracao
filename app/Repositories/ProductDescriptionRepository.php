<?php

namespace App\Repositories;

use App\Models\ProductDescription;
use App\Repositories\BaseRepository;

/**
 * Class ProductDescriptionRepository
 * @package App\Repositories
 * @version August 5, 2021, 5:11 pm -03
*/

class ProductDescriptionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'hrd_D002_id',
        'product_utilization_id',
        'description',
        'description_detail',
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
        return ProductDescription::class;
    }
}
