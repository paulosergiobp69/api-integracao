<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\H101;

/**
 * @SWG\Definition(
 *      definition="H100",
 *      required={"H100_T012_Id", "H100_C007_Id"},
 *      @SWG\Property(
 *          property="H100_Id",
 *          description="H100_Id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="H100_T012_Id",
 *          description="H100_T012_Id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="H100_C007_Id",
 *          description="H100_C007_Id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="H100_Quantidade",
 *          description="H100_Quantidade",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="H100_Quantidade_Pac",
 *          description="H100_Quantidade_Pac",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="H100_Saldo",
 *          description="H100_Saldo",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="H100_Valor_Unitario",
 *          description="H100_Valor_Unitario",
 *          type="number",
 *          format="number"
 *      ),
 *      @SWG\Property(
 *          property="H100_Status",
 *          description="H100_Status",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="H100_Data_Lancamento",
 *          description="H100_Data_Lancamento",
 *          type="string",
 *          format="date-time"
 *      ),
 * )
 */
class H100 extends Model
{
    use SoftDeletes;

    public $table = 'H100';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    protected $primaryKey = 'H100_Id';

    public $fillable = [
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
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'H100_Id' => 'integer',
        'H100_T012_Id' => 'integer',
        'H100_C007_Id' => 'integer',
        'H100_Quantidade' => 'integer',
        'H100_Quantidade_Pac' => 'integer',
        'H100_Saldo' => 'integer',
        'H100_Valor_Unitario' => 'decimal:2',
        'H100_Status' => 'string',
        'H100_Data_Lancamento' => 'datetime'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
    ];

    public function H101(){
        return $this->hasMany(H101::class, 'H101_H100_Id','H100_Id');
    }

    
}
