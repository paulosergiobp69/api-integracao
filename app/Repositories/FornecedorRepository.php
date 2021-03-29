<?php

namespace App\Repositories;

use App\Models\Fornecedor;
use App\Repositories\BaseRepository;

/**
 * Class FornecedorRepository
 * @package App\Repositories
 * @version March 29, 2021, 1:39 pm -03
*/

class FornecedorRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nome',
        'image',
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
        return Fornecedor::class;
    }
}
