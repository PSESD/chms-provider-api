<?php
namespace CHMSTests\Provider;

use Cache;
use CHMS\Provider\Repositories\User\Contract as UserProvider;
use CHMS\Provider\Repositories\Client\Contract as ClientProvider;
use CHMS\Provider\Repositories\Role\Contract as RoleProvider;
use CHMS\Provider\Repositories\Provider\Contract as ProviderProvider;
use CHMS\Common\Contracts\Acl as AclContract;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Illuminate\Http\Request;

trait ApplicationTestTrait
{
    static $providerAdminUser;
    static $studentUser;
    static $superAdminUser;

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
        return $userProvider->find(['id' => static::$superAdminUser]);
    }

    protected function getStudent()
    {
        $this->setupUsers();
        $userProvider = app(UserProvider::class);
        return $userProvider->find(['id' => static::$studentUser]);
    }

    protected function getProviderAdmin()
    {
        $this->setupUsers();
        $userProvider = app(UserProvider::class);
        return $userProvider->find(['id' => static::$providerAdminUser]);
    }

    protected function setupUsers()
    {
        $this->setupRoles();
        $providerProvider = app(ProviderProvider::class);
        $userProvider = app(UserProvider::class);
        $roleProvider = app(RoleProvider::class);

        $providerAttributes = ['name' => 'Main Provider', 'provider_secret' => 'foobar'];
        $mainProvider = $providerProvider->find($providerAttributes);
        if (empty($admin)) {
            $mainProvider = $providerProvider->create($providerAttributes);
        }

        $userRoleAttributes = ['provider_id' => $mainProvider->id];
        
        $admin = null;
        if (!empty(static::$superAdminUser)) {
            $admin = $userProvider->find(['id' => static::$superAdminUser]);
        }
        if (empty($admin)) {
            $admin = $userProvider->create([
            ]);
            // \dump($roleProvider->findAll());exit;
            // \dump($roleProvider->getRoleBySystemId('super_administrator'));exit;
            $admin->roles()->save($roleProvider->getRoleBySystemId('super_administrator'), $userRoleAttributes);
        }
        static::$superAdminUser = $admin->id;

        $student = null;
        if (!empty(static::$studentUser)) {
            $student = $userProvider->find(['id' => static::$studentUser]);
        }
        if (empty($student)) {
            $student = $userProvider->create([
            ]);
            $student->roles()->save($roleProvider->getRoleBySystemId('student'), $userRoleAttributes);
        }
        static::$studentUser = $student->id;

        $providerAdmin = null;
        if (!empty(static::$providerAdminUser)) {
            $providerAdmin = $userProvider->find(['id' => static::$providerAdminUser]);
        }
        if (empty($providerAdmin)) {
            $providerAdmin = $userProvider->create([
            ]);
            $providerAdmin->roles()->save($roleProvider->getRoleBySystemId('provider_administrator'), $userRoleAttributes);
        }
        static::$providerAdminUser = $providerAdmin->id;

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