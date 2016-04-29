<?php
namespace CHMSTests\SponsorProvider;

use Cache;
use CHMS\SponsorProvider\Repositories\User\Contract as UserProvider;
use CHMS\SponsorProvider\Repositories\Client\Contract as ClientProvider;
use CHMS\SponsorProvider\Repositories\Role\Contract as RoleProvider;
use CHMS\SponsorProvider\Repositories\Sponsor\Contract as SponsorProvider;
use CHMS\Common\Contracts\Acl as AclContract;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Illuminate\Http\Request;

trait ApplicationTestTrait
{
    static $sponsorAdminUser;
    static $studentUser;
    static $superAdminUser;
    static $sponsor;

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
        static::$sponsor = null;
        static::$superAdminUser = null;
        static::$studentUser = null;
        static::$sponsorAdminUser = null;
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

    protected function getSponsorAdmin()
    {
        $this->setupUsers();
        $userProvider = app(UserProvider::class);
        return $userProvider->find(['id' => static::$sponsorAdminUser]);
    }

    protected function setupUsers()
    {
        $this->setupRoles();
        $sponsorProvider = app(SponsorProvider::class);
        $userProvider = app(UserProvider::class);
        $roleProvider = app(RoleProvider::class);

        $mainSponsor = $this->getSponsor();

        $userRoleAttributes = ['sponsor_id' => $mainSponsor->id];
        
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

        $sponsorAdmin = null;
        if (!empty(static::$sponsorAdminUser)) {
            $sponsorAdmin = $userProvider->find(['id' => static::$sponsorAdminUser]);
        }
        if (empty($sponsorAdmin)) {
            $sponsorAdmin = $userProvider->create([
            ]);
            $sponsorAdmin->roles()->save($roleProvider->getRoleBySystemId('sponsor_administrator'), $userRoleAttributes);
        }
        static::$sponsorAdminUser = $sponsorAdmin->id;

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
    protected function getSponsor()
    {
        if (!empty(static::$sponsor)) {
            return static::$sponsor;
        }
        $sponsorProvider = app(SponsorProvider::class);
        $sponsorAttributes = ['name' => 'Main Provider', 'api_secret' => 'foobar', 'slug' => 'foo'];
        $mainSponsor = $sponsorProvider->find($sponsorAttributes);
        if (empty($mainSponsor)) {
            $mainSponsor = $sponsorProvider->create($sponsorAttributes);
        }
        static::$sponsor = $mainSponsor;
        return $mainSponsor;
    }
    protected function getSponsorRoute($url = null)
    {
        $route = [];
        $route[] = 'sponsors';
        $route[] = $this->getSponsor()->slug;
        if (!is_null($url)) {
            $route[] = $url;
        }
        return '/' . implode('/', $route);
    }
}