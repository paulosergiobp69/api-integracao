<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="ProductLine",
 *      required={"hrd_D003_Id", "product_utilization_id", "name", "active"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="hrd_D003_Id",
 *          description="D003_Id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="product_utilization_id",
 *          description="D003_C008_Id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="D003_Nome_Linha",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="abbreviation",
 *          description="D003_Abreviatura",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="active",
 *          description="D003_Ativo",
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
class ProductLine extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'product_line';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    protected $primaryKey = 'id';

    public $fillable = [
        'hrd_D003_Id',
        'product_utilization_id',
        'name',
        'abbreviation',
        'active'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'hrd_D003_Id' => 'integer',
        'product_utilization_id' => 'integer',
        'name' => 'string',
        'abbreviation' => 'string',
        'active' => 'string',
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
        'hrd_D003_Id' => 'integer',
        'product_utilization_id' => 'integer',
        'name' => 'string',
        'abbreviation' => 'string',
        'active' => 'string',
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
