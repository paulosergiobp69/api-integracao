<?php

namespace App\Repositories;

use App\Models\Filme;
use App\Repositories\BaseRepository;

/**
 * Class FilmeRepository
 * @package App\Repositories
 * @version March 26, 2021, 10:28 am -03
*/

class FilmeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'titulo',
        'capa'
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
        return Filme::class;
    }
}
