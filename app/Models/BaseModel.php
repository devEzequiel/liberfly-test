<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
    public static bool $withoutAppends = false;

    public function scopeWithoutAppends($query)
    {
        self::$withoutAppends = true;
        return $query;
    }
    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (in_array('created_by_user_id', $model->getFillable())) {
                $model->created_by_user_id = auth()->id() ?: $model->created_by_user_id;
            }
        });
        static::updating(function ($model) {
            if (in_array('updated_by_user_id', $model->getFillable())) {
                $model->updated_by_user_id = auth()->id() ?: $model->updated_by_user_id;
            }
        });
    }

    protected function getArrayableAppends(): array
    {
        if (self::$withoutAppends) {
            return [];
        }
        return parent::getArrayableAppends();
    }
}
