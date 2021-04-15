<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="PurchaseHistIncomingInvoice",
 *      required={"PHO_Id", "HRD_T014_Id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="PHO_Id",
 *          description="PHO_Id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="HRD_T014_Id",
 *          description="HRD_T014_Id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="HRD_Quantidade",
 *          description="HRD_Quantidade",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="HRD_Valor_Custo_Unitario",
 *          description="HRD_Valor_Custo_Unitario",
 *          type="number",
 *          format="number"
 *      ),
 *      @SWG\Property(
 *          property="HRD_Flag_Cancelado",
 *          description="S => SIM CANCELADA | N => NAO CANCELADA",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="HRD_Data_Lancamento",
 *          description="Data de entrada nf compra",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="created_by",
 *          description="created_by",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="updated_by",
 *          description="updated_by",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="deleted_by",
 *          description="deleted_by",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="deleted_at",
 *          description="deleted_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class PurchaseHistIncomingInvoice extends Model
{
    use SoftDeletes;

    public $table = 'purchase_hist_incoming_invoices';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    protected $primaryKey = 'id';

    public $fillable = [
        'PHO_Id',
        'HRD_T014_Id',
        'HRD_Quantidade',
        'HRD_Valor_Custo_Unitario',
        'HRD_Flag_Cancelado',
        'HRD_Data_Lancamento'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'PHO_Id' => 'integer',
        'HRD_T014_Id' => 'integer',
        'HRD_Quantidade' => 'integer',
        'HRD_Valor_Custo_Unitario' => 'decimal:5',
        'HRD_Flag_Cancelado' => 'string',
        'HRD_Data_Lancamento' => 'datetime',
        'created_by' => 'integer',
        'updated_by' => 'integer',
        'deleted_by' => 'integer'
    ];



    /* campos que eu nao quero que sejam exibidos */
    protected $hidden = [
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function pho()
    {
        return $this->belongsTo(\App\Models\PurchaseHistOrder::class, 'PHO_Id');
    }
}
