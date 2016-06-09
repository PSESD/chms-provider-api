<?php
/**
 * Clock Hour Management System - Provider Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */
namespace CHMS\ProviderHub\Providers;

use Auth;
use Illuminate\Support\Str;
use CHMS\ProviderHub\Auth\Context;
use CHMS\ProviderHub\Models\User;
use CHMS\ProviderHub\Auth\ClientUserProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use CHMS\ProviderHub\Repositories\User\Contract as UserProvider;
use CHMS\ProviderHub\Auth\Acl;
use CHMS\ProviderHub\Auth\ProxyAuthorizer;
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
                $modelClass = 'CHMS\ProviderHub\Models\\' . $model;
                $filterClass = 'CHMS\ProviderHub\Http\Input\Filters\\' . $model;
                $gate->filter($modelClass, $filterClass);
            }

            foreach (AppServiceProvider::getObjectModelNames() as $model) {
                $modelClass = 'CHMS\ProviderHub\Models\\' . $model;
                $validatorClass = 'CHMS\ProviderHub\Http\Input\Validators\\' . $model;
                $gate->validator($modelClass, $validatorClass);
            }

            return $gate;
        });
    }
}
