<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="ProductReplacement",
 *      required={"product_id", "product_utilization_id", "user_hrd_id", "hrd_D017_Id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="product_id",
 *          description="D017_D001_Id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="product_utilization_id",
 *          description="D017_C008_Id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="user_hrd_id",
 *          description="D017_C007_Id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="code_new",
 *          description="D017_Codigo_Novo",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="code_old",
 *          description="D017_Codigo_Antigo",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="date_include",
 *          description="D017_Data_Inclusao",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="code_formatted_old",
 *          description="D017_Codigo_Antigo_Formatado",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="hrd_D017_Id",
 *          description="D017_Id",
 *          type="integer",
 *          format="int32"
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
class ProductReplacement extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'product_replacement';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    protected $primaryKey = 'id';

    public $fillable = [
        'product_id',
        'product_utilization_id',
        'user_hrd_id',
        'code_new',
        'code_old',
        'date_include',
        'code_formatted_old',
        'hrd_D017_Id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'product_id' => 'integer',
        'product_utilization_id' => 'integer',
        'user_hrd_id' => 'integer',
        'code_new' => 'string',
        'code_old' => 'string',
        'date_include' => 'date',
        'code_formatted_old' => 'string',
        'hrd_D017_Id' => 'integer',
        'created_by' => 'integer',
        'updated_by' => 'integer',
        'deleted_by' => 'integer'
    ];


    /* campos que eu nao quero que sejam exibidos */
    protected $hidden = [
        'created_by',
        'updated_by',
      //'deleted_by',
      //'deleted_at',
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
        'product_id' => 'integer',
        'product_utilization_id' => 'integer',
        'user_hrd_id' => 'integer',
        'code_new' => 'string',
        'code_old' => 'string',
        'date_include' => 'date',
        'code_formatted_old' => 'string',
        'hrd_D017_Id' => 'integer',
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

    
}
