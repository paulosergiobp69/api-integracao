<?php

namespace App\Repositories;

use App\Models\ProductReplacement;
use App\Repositories\BaseRepository;

/**
 * Class ProductReplacementRepository
 * @package App\Repositories
 * @version August 5, 2021, 5:12 pm -03
*/

class ProductReplacementRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'product_id',
        'product_utilization_id',
        'user_hrd_id',
        'code_new',
        'code_old',
        'date_include',
        'code_formatted_old',
        'hrd_D017_Id',
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
        return ProductReplacement::class;
    }
}
