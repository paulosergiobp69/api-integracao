<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \App\Models\H100;

/**
 * @SWG\Definition(
 *      definition="H101",
 *      required={"H101_H100_Id", "H101_T014_Id"},
 *      @SWG\Property(
 *          property="H101_Id",
 *          description="H101_Id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="H101_H100_Id",
 *          description="H101_H100_Id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="H101_T014_Id",
 *          description="H101_T014_Id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="H101_Quantidade",
 *          description="H101_Quantidade",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="H101_Flag_Cancelado",
 *          description="H101_Flag_Cancelado",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="H101_Valor_Unitario",
 *          description="H101_Valor_Unitario",
 *          type="number",
 *          format="number"
 *      ),
 *      @SWG\Property(
 *          property="H101_Data_Lancamento",
 *          description="H101_Data_Lancamento",
 *          type="string",
 *          format="date-time"
 *      ),
 * )
 */
class H101 extends Model
{
    use SoftDeletes;

    public $table = 'H101';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    protected $primaryKey = 'H101_Id';

    public $fillable = [
        'H101_H100_Id',
        'H101_T014_Id',
        'H101_Quantidade',
        'H101_Flag_Cancelado',
        'H101_Valor_Unitario',
        'H101_Data_Lancamento'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'H101_Id' => 'integer',
        'H101_H100_Id' => 'integer',
        'H101_T014_Id' => 'integer',
        'H101_Quantidade' => 'integer',
        'H101_Flag_Cancelado' => 'string',
        'H101_Valor_Unitario' => 'decimal:2',
        'H101_Data_Lancamento' => 'datetime',
        'created_by' => 'integer',
        'updated_by' => 'integer',
        'deleted_by' => 'integer'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'created_by' => 'integer',
        'updated_by' => 'integer',
        'deleted_by' => 'integer'
    ];


    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
    ];

    /**  cliente
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function H100()
    {
        return $this->belongsTo(H100::class, 'H101_H100_Id','H100_Id');
    }
}
