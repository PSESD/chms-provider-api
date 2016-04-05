<?php
namespace CHMSTests\Provider;

use Cache;
use CHMS\Provider\Repositories\User\Contract as UserProvider;
use CHMS\Provider\Repositories\Client\Contract as ClientProvider;
use CHMS\Provider\Repositories\Role\Contract as RoleProvider;
use CHMS\Common\Contracts\Acl as AclContract;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Illuminate\Http\Request;

trait ApplicationTestTrait
{
    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__.'/../bootstrap/app.php';
    }

    protected function refresh()
    {
        $this->refreshApplication();
        Cache::flush();
    }

    protected function getUser()
    {
        return $this->getSuperAdmin();
    }

    protected function getSuperAdmin()
    {
        $this->setupUsers();
        $userProvider = app(UserProvider::class);
        return $userProvider->find(['email' => 'superadmin@example.com']);;
    }

    protected function getStudent()
    {
        $this->setupUsers();
        $userProvider = app(UserProvider::class);
        return $userProvider->find(['email' => 'student@example.com']);;
    }

    protected function getHubAdmin()
    {
        $this->setupUsers();
        $userProvider = app(UserProvider::class);
        return $userProvider->find(['email' => 'hubadmin@example.com']);;
    }

    protected function setupUsers()
    {
        $this->setupRoles();
        $userProvider = app(UserProvider::class);
        $roleProvider = app(RoleProvider::class);

        $admin = $userProvider->find(['email' => 'superadmin@example.com']);
        if (empty($admin)) {
            $admin = $userProvider->create([
            ]);
            $admin->roles()->save($roleProvider->getRoleBySystemId('super_administrator'));
        }

        $student = $userProvider->find(['email' => 'student@example.com']);
        if (empty($student)) {
            $student = $userProvider->create([
            ]);
            $student->roles()->save($roleProvider->getRoleBySystemId('student'));
        }


        $hubAdmin = $userProvider->find(['email' => 'hubadmin@example.com']);
        if (empty($hubAdmin)) {
            $hubAdmin = $userProvider->create([
            ]);
            $hubAdmin->roles()->save($roleProvider->getRoleBySystemId('hub_administrator'));
        }

    }

    public function call($method, $uri, $parameters = [], $cookies = [], $files = [], $server = [], $content = null)
    {
        $this->currentUri = $this->prepareUrlForRequest($uri);

        $request = Request::create(
            $this->currentUri, $method, $parameters,
            $cookies, $files, array_merge($server, $this->serverHeaders), $content
        );
        $request->setRouteResolver(function () {
            return app()->getCurrentRoute();
        });
        return $this->response = $this->app->prepareResponse(
            $this->app->handle($request)
        );
    }

    public function withoutMiddleware()
    {
        $this->app->instance('middleware.disable', true);
        return $this;
    }

    protected function setupRoles()
    {
        $this->refresh();
        $acl = app(AclContract::class);
        $acl->setupRoles();
    }
}