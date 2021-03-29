<?php

namespace App\Repositories;

use App\Models\Cliente;
use App\Repositories\BaseRepository;

/**
 * Class ClienteRepository
 * @package App\Repositories
 * @version March 29, 2021, 10:11 am -03
*/

class ClienteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nome',
        'image'
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
        return Cliente::class;
    }
}
