<?php

namespace Tylercd100\Database\Eloquent\Traits;

use Illuminate\Database\Query\Builder as IlluminateBuilder;
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
     * Toggle the auto cache feature.
     *
     * @var int
     */
    protected $autoCacheEnabled = true;

    /**
     * Create a new Eloquent query builder for the model.
     *
     * @param  \Illuminate\Database\Query\Builder $query
     * @return \PulkitJalan\Cacheable\Eloquent\Builder|static
     */
    public function newEloquentBuilder($query)
    {
        return $this->autoCacheEnabled ? (new Builder($query)) : (new IlluminateBuilder($query));
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
