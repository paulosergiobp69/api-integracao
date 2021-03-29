<?php

namespace App\Repositories;

use App\Models\Testedopaulo;
use App\Repositories\BaseRepository;

/**
 * Class TestedopauloRepository
 * @package App\Repositories
 * @version March 29, 2021, 1:29 pm -03
*/

class TestedopauloRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nome',
        'image',
        'old_id',
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
        return Testedopaulo::class;
    }
}
