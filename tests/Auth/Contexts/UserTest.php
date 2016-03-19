<?php
namespace CHMSTests\Provider\Auth\Contexts;

use CHMS\Provider\Auth\Contexts\User as Context;
use CHMSTests\Provider\TestCase;

class UserTest extends BaseContextTest
{
    public function getContextClass()
    {
        return Context::class;
    }
}