<?php

namespace Tylercd100\Database\Eloquent;

use Illuminate\Database\Eloquent\Model as IlluminateModel;
use Tylercd100\Database\Eloquent\Traits\AutoCache;
use Tylercd100\Database\Eloquent\Traits\AutoValidate;

abstract class Model extends IlluminateModel
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
