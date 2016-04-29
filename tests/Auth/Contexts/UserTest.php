<?php
namespace CHMSTests\SponsorProvider\Auth\Contexts;

use CHMS\SponsorProvider\Auth\Contexts\User as Context;
use CHMSTests\SponsorProvider\TestCase;

class UserTest extends BaseContextTest
{
    public function getContextClass()
    {
        return Context::class;
    }
}