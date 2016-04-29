<?php
namespace CHMSTests\SponsorProvider\Auth;

use Auth;
use Laravel\Lumen\Testing\DatabaseTransactions;
use CHMSTests\SponsorProvider\TestCase;
use CHMS\SponsorProvider\Auth\Acl;
use Laravel\Lumen\Testing\DatabaseMigrations;
use CHMS\Common\Auth\RoleBucket;
use CHMS\Common\Auth\Contexts\Guest as GuestContext;
use CHMS\Common\Auth\Contexts\Client as ClientContext;
use CHMS\SponsorProvider\Auth\Contexts\User as UserContext;
use CHMS\Common\Auth\Contexts\RoleSet as RoleSetContext;
use CHMS\SponsorProvider\Repositories\Organization\Contract as OrganizationContract;

abstract class AclTest extends TestCase
{
    use DatabaseMigrations;

    protected function getAcl($config = null)
    {
        $this->app->configure('acl');
        if (!isset($config)) {
            $config = config('acl');
        }
        $acl = new Acl($this->app, $config);
        return $acl;
    }
}
