<?php

namespace Tylercd100\Database\Eloquent\Relations;

use Illuminate\Database\Eloquent\Relations\Pivot as IlluminatePivot;
use Tylercd100\Database\Eloquent\Traits\AutoCache;
use Tylercd100\Database\Eloquent\Traits\AutoValidate;

abstract class Pivot extends IlluminatePivot
{
    use AutoCache {
        boot as bootAutoCache;
    }

    use AutoValidate {
        boot as bootAutoValidate;
    }

    /**
     * A method best used to register Eloquent events when the pivot model boots up
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        self::bootAutoCache();
        self::bootAutoValidate();
    }
}
