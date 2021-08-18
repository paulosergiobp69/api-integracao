<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Product;

/**
 * @SWG\Definition(
 *      definition="ProductSuppliers",
 *      required={"hrd_D049_Id", "code_supplier", "product_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="hrd_D049_Id",
 *          description="D049_Id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="code_supplier",
 *          description="D049_Codigo_Produto_Fornecedor",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="code_supplier_formatted",
 *          description="D049_Codigo_Produto_Fornecedor_Formatado",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="product_id",
 *          description="D049_D001_Id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="technical_data",
 *          description="D049_Dados_Tecnicos",
 *          type="string"
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
class ProductSuppliers extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'product_suppliers';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    protected $primaryKey = 'id';

    public $fillable = [
        'hrd_D049_Id',
        'code_supplier',
        'code_supplier_formatted',
        'product_id',
        'technical_data'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'hrd_D049_Id' => 'integer',
        'code_supplier' => 'string',
        'code_supplier_formatted' => 'string',
        'product_id' => 'integer',
        'technical_data' => 'string',
        'created_by' => 'integer',
        'updated_by' => 'integer',
        'deleted_by' => 'integer'
    ];

    /* campos que eu nao quero que sejam exibidos */
    protected $hidden = [
        'created_by',
        'updated_by',
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
        'hrd_D049_Id' => 'integer',
        'code_supplier' => 'string',
        'code_supplier_formatted' => 'string',
        'product_id' => 'integer',
        'technical_data' => 'string',
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


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function Product()
    {
        return $this->belongsTo(Product::class,'product_id', 'id');
    }

    
}
