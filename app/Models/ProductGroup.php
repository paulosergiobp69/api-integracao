<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="ProductGroup",
 *      required={"hrd_D015_Id", "product_utilization_id", "name", "active"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="hrd_D015_Id",
 *          description="D015_Id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="product_utilization_id",
 *          description="D015_C008_Id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="D015_Nome_Grupo",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="active",
 *          description="D015_Ativo",
 *          type="string"
 *      )
 * )
 */
class ProductGroup extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'product_group';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    protected $primaryKey = 'id';

    public $fillable = [
        'hrd_D015_Id',
        'product_utilization_id',
        'name',
        'active'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'hrd_D015_Id' => 'integer',
        'product_utilization_id' => 'integer',
        'name' => 'string',
        'active' => 'string',
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
        'hrd_D015_Id' => 'required|integer',
        'product_utilization_id' => 'required|integer',
        'name' => 'required|string|max:30',
        'active' => 'required|string|max:1',
        'created_by' => 'nullable|integer',
        'updated_by' => 'nullable|integer',
        'deleted_by' => 'nullable|integer'
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
