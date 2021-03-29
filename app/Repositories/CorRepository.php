<?php

namespace App\Repositories;

use App\Models\Cor;
use App\Repositories\BaseRepository;

/**
 * Class CorRepository
 * @package App\Repositories
 * @version March 26, 2021, 1:25 pm -03
*/

class CorRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nome'
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
        return Cor::class;
    }
}
