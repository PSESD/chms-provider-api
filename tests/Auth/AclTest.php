<?php
namespace CHMSTests\Provider\Auth;

use Auth;
use Laravel\Lumen\Testing\DatabaseTransactions;
use CHMSTests\Provider\TestCase;
use CHMS\Provider\Auth\Acl;
use Laravel\Lumen\Testing\DatabaseMigrations;
use CHMS\Common\Auth\RoleBucket;
use CHMS\Common\Auth\Contexts\Guest as GuestContext;
use CHMS\Common\Auth\Contexts\Client as ClientContext;
use CHMS\Provider\Auth\Contexts\User as UserContext;
use CHMS\Common\Auth\Contexts\RoleSet as RoleSetContext;
use CHMS\Provider\Repositories\Organization\Contract as OrganizationContract;

class AclTest extends TestCase
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

    public function testAuthUserContext()
    {
        $this->setupUsers();
        Auth::attempt(['email' => 'student@example.com', 'password' => 'foobar'], true);
        $acl = $this->getAcl();
        $context = $acl->getContext();
        $this->assertTrue($context instanceof UserContext);
        Auth::logout();
    }

    public function testFailedAuthUserContext()
    {
        $this->setupUsers();
        Auth::attempt(['email' => 'student@example.com', 'password' => 'foobar2'], true);
        $acl = $this->getAcl();
        $context = $acl->getContext();
        $this->assertTrue($context instanceof GuestContext);
        Auth::logout();
    }

    public function testSwitchObjectContext()
    {
        $this->setupUsers();
        Auth::attempt(['email' => 'student@example.com', 'password' => 'foobar'], true);
        $acl = $this->getAcl();
        $context = $acl->getContext();
        $orgProvider = app(OrganizationContract::class);
        $org = $orgProvider->create(['name' => 'Test Org']);
        $acl->switchObjectContext($org);
        $orgContext = $acl->switchObjectContext($org);
        $this->assertNotEquals($orgContext->getId(), $context->getId());
        Auth::logout();
    }
}
