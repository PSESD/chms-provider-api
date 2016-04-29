<?php
/**
 * Clock Hour Management System - Sponsor Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */
namespace CHMS\SponsorProvider\Providers;

use Auth;
use Illuminate\Support\Str;
use CHMS\SponsorProvider\Auth\Context;
use CHMS\SponsorProvider\Models\User;
use CHMS\SponsorProvider\Auth\ClientUserProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use CHMS\SponsorProvider\Repositories\User\Contract as UserProvider;
use CHMS\SponsorProvider\Auth\Acl;
use CHMS\SponsorProvider\Auth\ProxyAuthorizer;
use CHMS\Common\Auth\OAuthGuard;
use CHMS\Common\Contracts\Acl as AclContract;
use CHMS\Common\Contracts\InputGate as InputGateContract;
use CHMS\Common\Http\Input\InputGate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        $app = $this->app;
        Auth::extend('oauth', function($app, $name, array $config) {
            $guard = new OAuthGuard($name, Auth::createUserProvider($config['provider']), $app['request'], $config);
            $app->refresh('request', $guard, 'setRequest');
            return $guard;
        });

        Auth::provider('hubAuthProvider', function($app, array $config) {
            return new ClientUserProvider($app['hash'], $config['model']);
        });


        $this->app->singleton('authorizer', function ($app) {
            $app->configure('authorizer');
            $authorizer = new ProxyAuthorizer($app, config('authorizer'));
            return $authorizer;
        });

        $this->app->singleton(AclContract::class, function ($app) {
            $app->configure('acl');
            $acl = new Acl($app, config('acl'));
            return $acl;
        });

        $this->app->singleton('context', function ($app) {
            return new Context();
        });

        $this->app->singleton(InputGateContract::class, function ($app) {
            $gate = new InputGate($app);

            foreach (AppServiceProvider::getObjectModelNames() as $model) {
                $modelClass = 'CHMS\SponsorProvider\Models\\' . $model;
                $filterClass = 'CHMS\SponsorProvider\Http\Input\Filters\\' . $model;
                $gate->filter($modelClass, $filterClass);
            }

            foreach (AppServiceProvider::getObjectModelNames() as $model) {
                $modelClass = 'CHMS\SponsorProvider\Models\\' . $model;
                $validatorClass = 'CHMS\SponsorProvider\Http\Input\Validators\\' . $model;
                $gate->validator($modelClass, $validatorClass);
            }

            return $gate;
        });
    }
}
