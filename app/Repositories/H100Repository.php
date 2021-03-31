<?php

namespace App\Repositories;

use App\Models\H100;
use App\Repositories\BaseRepository;

/**
 * Class H100Repository
 * @package App\Repositories
 * @version March 30, 2021, 2:56 pm -03
*/

class H100Repository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'H100_D009_Id',
        'H100_T012_Id',
        'H100_C007_Id',
        'H100_Quantidade',
        'H100_Quantidade_Pac',
        'H100_Saldo',
        'H100_Valor_Unitario',
        'H100_Status',
        'H100_Data_Lancamento'
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
        return H100::class;
    }
}
