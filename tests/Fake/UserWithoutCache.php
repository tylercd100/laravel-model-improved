<?php

namespace Tylercd100\Database\Eloquent\Tests\Fake;

use Tylercd100\Database\Eloquent\Model;

class UserWithoutCache extends Model
{
    // I am a fake user model

    /**
     * Toggle the auto cache feature.
     *
     * @var int
     */
    const AUTO_CACHE_ENABLED = false;
}
