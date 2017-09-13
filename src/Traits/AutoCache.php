<?php

namespace Tylercd100\Database\Eloquent\Traits;

use Tylercd100\Database\Eloquent\Builder;
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
     *
     * @param  \Illuminate\Database\Query\Builder $query
     * @return \PulkitJalan\Cacheable\Eloquent\Builder|static
     */
    public function newEloquentBuilder($query)
    {
        return new Builder($query);
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
