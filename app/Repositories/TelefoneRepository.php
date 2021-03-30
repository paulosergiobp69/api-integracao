<?php

namespace App\Repositories;

use App\Models\Telefone;
use App\Repositories\BaseRepository;

/**
 * Class TelefoneRepository
 * @package App\Repositories
 * @version March 30, 2021, 11:14 am -03
*/

class TelefoneRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'cliente_id',
        'numero'
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
        return Telefone::class;
    }
}
