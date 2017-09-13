<?php

namespace Tylercd100\Database\Eloquent\Relations;

use Illuminate\Database\Eloquent\Relations\Pivot as IlluminatePivot;
use Tylercd100\Database\Eloquent\Traits\AutoCache;
use Tylercd100\Database\Eloquent\Traits\AutoValidate;

abstract class Pivot extends IlluminatePivot
{
    use AutoCache, AutoValidate;
    
    /**
     * A method best used to register Eloquent events when the model boots up
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        // Auto Validate
        self::saving(function ($model) {
            if (!$model->validate()) {
                return false;
            }
        });

        // Auto Cache
        static::saved(function ($model) {
            $model->refresh();
        }, -1);

        static::deleted(function ($model) {
            $model->refresh();
        }, -1);
    }
}
