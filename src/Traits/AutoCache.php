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
     * Toggle the auto cache feature.
     *
     * @var int
     */
    protected $autoCacheEnabled = true;

    /**
     * Create a new Eloquent query builder for the model.
     */
    public function newEloquentBuilder($query)
    {
        if ($this->autoCacheEnabled) {
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
