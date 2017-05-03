<?php

namespace Tylercd100\Database\Eloquent\Tests;

use Tylercd100\Database\Eloquent\Tests\Fake\User;
use Tylercd100\Database\Eloquent\Tests\Fake\UserPivot;

class ModelTest extends TestCase
{
    public function testCreatingModelInstance()
    {
        $obj = new User();
    }

    public function testCreatingPivotModelInstance()
    {
        $obj = new UserPivot();
    }
}
