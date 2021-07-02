<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \App\Models\PurchaseHistIncomingInvoice;

/**
 * @SWG\Definition(
 *      definition="PurchaseHistOrders",
 *      required={"HRD_T011_Id", "HRD_T012_Id", "HRD_T012_D009_Id", "HRD_T011_C007_Id", "HRD_T011_C004_Id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="HRD_T011_Id",
 *          description="HRD_T011_Id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="HRD_T012_Id",
 *          description="HRD_T012_Id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="HRD_T012_D009_Id",
 *          description="HRD_T012_D009_Id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="HRD_T011_C007_Id",
 *          description="HRD_T011_C007_Id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="HRD_T011_C004_Id",
 *          description="HRD_T011_C004_Id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="HRD_T012_Quantidade",
 *          description="HRD_T012_Quantidade",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="HRD_Quantidade_Pac",
 *          description="HRD_Quantidade_Pac",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="HRD_Saldo",
 *          description="HRD_Saldo",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="HRD_T012_Valor_Custo_Unitario",
 *          description="HRD_T012_Valor_Custo_Unitario",
 *          type="number",
 *          format="number"
 *      ),
 *      @SWG\Property(
 *          property="HRD_Status",
 *          description="1 => CADASTRADO | 2 => ESTOQUE | 3 => VENDIDO | 4 => DEVOLVIDO | 5 => EXCLUIDO | 6 => TRANSFERIDO | 7 => PRÉ-VENDA",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="HRD_Data_Lancamento",
 *          description="Data de geracao da oredem",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="HRD_T012_Ajuste_Saldo",
 *          description="Ajuste de Quantidade de Item de Ordem de Compra",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="HRD_C007_Ajuste_Saldo",
 *          description="Usuario Responsavel Pelo Ajuste",
 *          type="integer",
 *          format="int32"
 *      ),
 * )
 */
class PurchaseHistOrders extends BaseModel
{
    use SoftDeletes;

    public $table = 'purchase_hist_orders';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id';

    /* campos que sera inseridos */
    public $fillable = [
        'HRD_T011_Id',
        'HRD_T012_Id',
        'HRD_T012_D009_Id',
        'HRD_T011_C007_Id',
        'HRD_T011_C004_Id',
        'HRD_T012_Quantidade',
        'HRD_Quantidade_Pac',
        'HRD_Saldo',
        'HRD_T012_Valor_Custo_Unitario',
        'HRD_Status',
        'HRD_Data_Lancamento',
        'HRD_T012_Ajuste_Saldo',
        'HRD_C007_Ajuste_Saldo',
        'HRD_T012_Data_Ajuste_Saldo'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'HRD_T011_Id' => 'integer',
        'HRD_T012_Id' => 'integer',
        'HRD_T012_D009_Id' => 'integer',
        'HRD_T011_C007_Id' => 'integer',
        'HRD_T011_C004_Id' => 'integer',
        'HRD_T012_Quantidade' => 'integer',
        'HRD_Quantidade_Pac' => 'integer',
        'HRD_Saldo' => 'integer',
        'HRD_T012_Valor_Custo_Unitario' => 'decimal:2',
        'HRD_Status' => 'string',
        'HRD_Data_Lancamento' => 'datetime',
        'HRD_T012_Ajuste_Saldo' => 'integer',
        'HRD_C007_Ajuste_Saldo' => 'integer',
        'HRD_T012_Data_Ajuste_Saldo' => 'datetime',
        'created_by' => 'integer',
        'updated_by' => 'integer',
        'deleted_by' => 'integer'
    ];

    /* campos que eu nao quero que sejam exibidos */
    protected $hidden = [
        'created_by',
        'updated_by',
//        'deleted_by',
//        'deleted_at',
        'created_at',
        'updated_at'
    ];


/**
     * The attributes that should be casted to native types for automated search.
     *
     * @var array
     */
    public static $searchCasts = [
        'id' => 'integer',
        'HRD_T011_Id' => 'integer',
        'HRD_T012_Id' => 'integer',
        'HRD_T012_D009_Id' => 'integer',
        'HRD_T011_C007_Id' => 'integer',
        'HRD_T011_C004_Id' => 'integer',
        'HRD_T012_Quantidade' => 'integer',
        'HRD_Quantidade_Pac' => 'integer',
        'HRD_Saldo' => 'integer',
        'HRD_T012_Valor_Custo_Unitario' => 'decimal:2',
        'HRD_Status' => 'string',
        'HRD_Data_Lancamento' => 'datetime',
        'HRD_T012_Ajuste_Saldo' => 'integer',
        'HRD_C007_Ajuste_Saldo' => 'integer',
        'HRD_T012_Data_Ajuste_Saldo' => 'datetime',
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


    public static function getFieldType($field)
    {
        return isset(static::$searchCasts[$field])? static::$searchCasts[$field] : false;
    }



    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function PurchaseHistIncomingInvoice()
    {
        return $this->hasMany(PurchaseHistIncomingInvoice::class,'PHO_Id','id');
    }
    

    public function getSaldoId($id, $Status)
    {
        $result = $this->model::where('id','=',$id)
                              ->where('HRD_Status','=',$Status)->get('HRD_Saldo');

        return response()->json($result, 201);                              
        //return response()->$result;

    }    
    
    public function setHRD_StatusAttribute($value)
    {
        $this->attributes['HRD_Status'] = mb_strtoupper($value);
    }    

}
