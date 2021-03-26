<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Arno
 * @package App\Models
 * @version March 26, 2021, 10:32 am -03
 *
 * @property string $nome
 */
class Arno extends Model
{
    use SoftDeletes;

    public $table = 'arno';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'nome'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nome' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nome' => 'required|string|max:150',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
