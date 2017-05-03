<?php

namespace Tylercd100\Database\Eloquent;

use Illuminate\Database\Eloquent\Model as IlluminateModel;
use Tylercd100\Database\Eloquent\Traits\AutoCache;
use Tylercd100\Database\Eloquent\Traits\AutoValidate;

abstract class Model extends IlluminateModel
{
    use AutoCache {
        boot as bootAutoCache;
    }

    use AutoValidate {
        boot as bootAutoValidate;
    }

    /**
     * A method best used to register Eloquent events when the model boots up
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        self::bootAutoValidate();
        self::bootAutoCache();
    }
}
