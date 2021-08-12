<?php

namespace App\Repositories;

use App\Models\Product;
//use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;


/**
 * Class ProductRepository
 * @package App\Repositories
 * @version August 5, 2021, 9:31 am -03
*/

class ProductRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'hrd_D001_Id',
        'product_description_id',
        'product_line_id',
        'product_group_id',
        'product_utilization_id',
        'code',
        'reference',
        'technical_data',
        'application',
        'commercial_description',
        'unit_weight_kg',
        'development_flag',
        'development_date',
        'code_formatted',
        'reference_formatted',
        'code_redirect'
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
        return Product::class;
    }

}
