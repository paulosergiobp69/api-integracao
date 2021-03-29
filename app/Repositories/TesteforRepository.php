<?php

namespace App\Repositories;

use App\Models\Testefor;
use App\Repositories\BaseRepository;

/**
 * Class TesteforRepository
 * @package App\Repositories
 * @version March 29, 2021, 1:17 pm -03
*/

class TesteforRepository extends BaseRepository
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
        return Testefor::class;
    }
}
