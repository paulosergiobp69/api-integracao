<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
    
    protected static function boot()
    {
        static::saving(function ($model)
        {
            if ($model->exists) {
                $model->updated_by = auth('api')->user()->getAuthIdentifier();
            } else {
                $model->created_by = auth('api')->user()->getAuthIdentifier();
            }
            parent::saveLog($model, 'saving');
        });
        parent::boot();
    }
    
    public function saveLog($model, $event)
    {
        $log = '';
        if ($event == 'saving' && $model->exists) {
            $log = array_diff_assoc($model->getAttributes(), $model->getOriginal());
        } elseif ($event == 'deleting' && !$model->exists) {
            $log = $model->getAttributes();
        } else {
            $log = $model->getAttributes();
        }
        $log;
    }
}
