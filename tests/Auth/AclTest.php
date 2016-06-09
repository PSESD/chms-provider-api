<?php
namespace CHMSTests\ProviderHub\Auth;

use Auth;
use Laravel\Lumen\Testing\DatabaseTransactions;
use CHMSTests\ProviderHub\TestCase;
use CHMS\ProviderHub\Auth\Acl;
use Laravel\Lumen\Testing\DatabaseMigrations;
use CHMS\Common\Auth\RoleBucket;
use CHMS\Common\Auth\Contexts\Guest as GuestContext;
use CHMS\Common\Auth\Contexts\Client as ClientContext;
use CHMS\ProviderHub\Auth\Contexts\User as UserContext;
use CHMS\Common\Auth\Contexts\RoleSet as RoleSetContext;
use CHMS\ProviderHub\Repositories\Organization\Contract as OrganizationContract;

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
