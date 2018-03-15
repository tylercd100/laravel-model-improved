<?php

namespace Tylercd100\Database\Eloquent\Tests;

use Tylercd100\Database\Eloquent\Tests\Fake\User;
use Tylercd100\Database\Eloquent\Tests\Fake\UserPivot;
use Tylercd100\Database\Eloquent\Tests\Fake\UserWithoutCache;
use Illuminate\Database\Eloquent\Builder as IlluminateBuilder;
use Tylercd100\Database\Eloquent\Builder as AutoCacheBuilder;

class ModelTest extends TestCase
{
    public function testCreatingModelInstance()
    {
        $obj = new User();
        $this->assertTrue(is_object($obj));
    }

    public function testAutoCacheEnabledReturnsCorrectBuilder()
    {
        $builder = with(new User())->newQueryWithoutScopes();
        $this->assertEquals(AutoCacheBuilder::class, get_class($builder));
    }

    public function testAutoCacheDisabledReturnsCorrectBuilder()
    {
        $builder = with(new UserWithoutCache())->newQueryWithoutScopes();
        $this->assertEquals(IlluminateBuilder::class, get_class($builder));
    }
}
