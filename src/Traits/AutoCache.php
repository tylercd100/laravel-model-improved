<?php

namespace Tylercd100\Database\Eloquent\Traits;

use Illuminate\Database\Eloquent\Builder as IlluminateBuilder;
use Tylercd100\Database\Eloquent\Builder as AutoCacheBuilder;
use Illuminate\Support\Facades\Cache;

trait AutoCache
{
    /**
     * Set the cache expiry time.
     *
     * @var int
     */
    public $cacheExpiry = 1440;

    /**
     * Create a new Eloquent query builder for the model.
     */
    public function newEloquentBuilder($query)
    {
        if (static::AUTO_CACHE_ENABLED) {
            return new AutoCacheBuilder($query);
        }
        return new IlluminateBuilder($query);
    }

    /**
     * Refresh the current models cache.
     *
     * @return $this
     */
    public function refresh()
    {
        Cache::tags($this->getTable())->forget($this->{$this->getKeyName()});

        return $this;
    }
}
