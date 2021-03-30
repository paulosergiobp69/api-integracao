<?php

namespace App\Repositories;

use App\Models\H101;
use App\Repositories\BaseRepository;

/**
 * Class H101Repository
 * @package App\Repositories
 * @version March 30, 2021, 9:29 am -03
*/

class H101Repository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'H101_H100_Id',
        'H101_T014_Id',
        'H101_Quantidade',
        'H101_Flag_Cancelado',
        'H101_Valor_Unitario',
        'H101_Data_Lancamento'
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
        return H101::class;
    }
}
