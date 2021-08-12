<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="Product",
 *      required={"hrd_D001_Id", "product_description_id", "product_line_id", "product_group_id", "product_utilization_id", "code", "unit_weight_kg", "development_flag", "code_formatted"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="hrd_D001_Id",
 *          description="D001_Id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="product_description_id",
 *          description="D001_D002_Id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="product_line_id",
 *          description="D001_D003_Id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="product_group_id",
 *          description="D001_D015_Id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="product_utilization_id",
 *          description="D001_C008_Id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="code",
 *          description="D001_Codigo_Produto",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="reference",
 *          description="D001_Codigo_Referencia",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="technical_data",
 *          description="D001_Descricao_Produto",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="application",
 *          description="D001_Aplicacao",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="commercial_description",
 *          description="D001_Descricao_Comercial",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="unit_weight_kg",
 *          description="D001_Peso_Unitario_Kg",
 *          type="number",
 *          format="number"
 *      ),
 *      @SWG\Property(
 *          property="development_flag",
 *          description="D001_Flag_desenvolvimento",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="development_date",
 *          description="D001_Data_Desenvolvimento",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="code_formatted",
 *          description="D001_Codigo_Produto_Formatado",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="reference_formatted",
 *          description="D001_Codigo_Referencia_Formatado",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="code_redirect",
 *          description="D001_Codigo_Use",
 *          type="string"
 *      )
 * )
 */
class Product extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'product';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    protected $primaryKey = 'id';

    public $fillable = [
        'hrd_D001_Id',
        'product_description_id',
        'product_line_id',
        'product_group_id',
        'product_utilization_id',
        'code',
        'reference',
        'technical_data',
        'application',
        'commercial_description',
        'unit_weight_kg',
        'development_flag',
        'development_date',
        'code_formatted',
        'reference_formatted',
        'code_redirect'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'hrd_D001_Id' => 'integer',
        'product_description_id' => 'integer',
        'product_line_id' => 'integer',
        'product_group_id' => 'integer',
        'product_utilization_id' => 'integer',
        'code' => 'string',
        'reference' => 'string',
        'technical_data' => 'string',
        'application' => 'string',
        'commercial_description' => 'string',
        'unit_weight_kg' => 'decimal:3',
        'development_flag' => 'string',
        'development_date' => 'date',
        'code_formatted' => 'string',
        'reference_formatted' => 'string',
        'code_redirect' => 'string',
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
        'hrd_D001_Id' => 'integer',
        'product_description_id' => 'integer',
        'product_line_id' => 'integer',
        'product_group_id' => 'integer',
        'product_utilization_id' => 'integer',
        'code' => 'string',
        'reference' => 'string',
        'technical_data' => 'string',
        'application' => 'string',
        'commercial_description' => 'string',
        'unit_weight_kg' => 'decimal:3',
        'development_flag' => 'string',
        'development_date' => 'date',
        'code_formatted' => 'string',
        'reference_formatted' => 'string',
        'code_redirect' => 'string',
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

    
}
