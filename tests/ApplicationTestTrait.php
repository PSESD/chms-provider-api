<?php
namespace CHMSTests\ProviderHub;

use Cache;
use CHMS\ProviderHub\Repositories\User\Contract as UserProvider;
use CHMS\ProviderHub\Repositories\Client\Contract as ClientProvider;
use CHMS\ProviderHub\Repositories\Role\Contract as RoleProvider;
use CHMS\ProviderHub\Repositories\Provider\Contract as ProviderProvider;
use CHMS\Common\Contracts\Acl as AclContract;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Illuminate\Http\Request;

trait ApplicationTestTrait
{
    static $providerAdminUser;
    static $studentUser;
    static $superAdminUser;
    static $provider;

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
        static::$provider = null;
        static::$superAdminUser = null;
        static::$studentUser = null;
        static::$providerAdminUser = null;
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

        $mainProvider = $this->getProvider();

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
    protected function getProvider()
    {
        if (!empty(static::$provider)) {
            return static::$provider;
        }
        $providerProvider = app(ProviderProvider::class);
        $providerAttributes = ['name' => 'Main Provider', 'api_secret' => 'foobar', 'slug' => 'foo'];
        $mainProvider = $providerProvider->find($providerAttributes);
        if (empty($mainProvider)) {
            $mainProvider = $providerProvider->create($providerAttributes);
        }
        static::$provider = $mainProvider;
        return $mainProvider;
    }
    protected function getProviderRoute($url = null)
    {
        $route = [];
        $route[] = 'providers';
        $route[] = $this->getProvider()->slug;
        if (!is_null($url)) {
            $route[] = $url;
        }
        return '/' . implode('/', $route);
    }
}