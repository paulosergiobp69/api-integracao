<?php

namespace App\Repositories;

use App\Models\Arno;
use App\Repositories\BaseRepository;

/**
 * Class ArnoRepository
 * @package App\Repositories
 * @version March 26, 2021, 10:32 am -03
*/

class ArnoRepository extends BaseRepository
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
        return Arno::class;
    }
}
