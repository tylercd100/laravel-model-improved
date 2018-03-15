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
    }

    public function testCreatingPivotModelInstance()
    {
        $obj = new UserPivot(new User(), [], "fake_table");
    }

    public function testAutoCacheEnabledReturnsCorrectBuilder()
    {
        $builder = with(new User())->newQueryWithoutScopes();
        $this->assertInstanceof(IlluminateBuilder::class, $builder);
    }

    public function testAutoCacheDisabledReturnsCorrectBuilder()
    {
        $builder = with(new UserWithoutCache())->newQueryWithoutScopes();
        $this->assertInstanceof(AutoCacheBuilder::class, $builder);
    }
}
