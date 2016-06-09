<?php
namespace CHMSTests\ProviderHub\Auth\Contexts;

use CHMS\ProviderHub\Auth\Contexts\User as Context;
use CHMSTests\ProviderHub\TestCase;

class UserTest extends BaseContextTest
{
    public function getContextClass()
    {
        return Context::class;
    }
}