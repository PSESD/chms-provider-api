<?php
/**
 * Clock Hour Management System - Provider Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */
namespace CHMS\ProviderHub\Providers;

use Illuminate\Support\ServiceProvider;
use CHMS\ProviderHub\Http\Request;
use CHMS\Common\Http\Middleware\AuthRoute;
use CHMS\ProviderHub\Http\Middleware\Authenticate;
use CHMS\ProviderHub\Http\Middleware\PrepareContext;
use CHMS\Common\Providers\FractalServiceProvider;
use Illuminate\Redis\RedisServiceProvider;

class AppServiceProvider extends ServiceProvider
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
		$this->app->configure('services');
		$this->app->withFacades();
		$this->app->withEloquent();

        // \DB::listen(function($query) {
        //     // \dump($query->sql);
        //     // $query->bindings
        //     // $query->time
        // });

        if (!class_exists('Authorizer')) {
            class_alias('CHMS\ProviderHub\Facades\Authorizer', 'Authorizer');
        }

        if (!class_exists('Hash')) {
            class_alias('Illuminate\Support\Facades\Hash', 'Hash');
        }
        if (!class_exists('Request')) {
            class_alias('Illuminate\Support\Facades\Request', 'Request');
        }

		// Register bindings
		$this->app->singleton(
		    \Illuminate\Contracts\Debug\ExceptionHandler::class,
		    \CHMS\ProviderHub\Exceptions\Handler::class
		);

		// Register Middleware
		$this->app->middleware([
            // \LucaDegasperi\OAuth2Server\Middleware\OAuthExceptionHandlerMiddleware::class,
		]);

		$this->app->routeMiddleware([
            'auth' => Authenticate::class,
            'auth-route' => AuthRoute::class,
            'prepare-context' => PrepareContext::class,
            'check-authorization-params' => \LucaDegasperi\OAuth2Server\Middleware\CheckAuthCodeRequestMiddleware::class,
		]);
        $this->app->register(PolicyProvider::class);
		$this->app->register(AuthServiceProvider::class);
        $this->app->register(FractalServiceProvider::class);
		$this->app->register(RepositoryServiceProvider::class);
        $this->app->register(RedisServiceProvider::class);
		$this->app->register(EventServiceProvider::class);

		//$this->app->register(\Canis\Laravel\Db\Providers\ValidationProvider::class);

		// Load Routes
		$app = $this->app;
		require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Http' . DIRECTORY_SEPARATOR . 'routes.php';
    }

    public static function getObjectModelNames()
    {
        return ['Organization', 'ClassRecord', 'ClockHourRecord', 'Provider', 'Role', 'User', 'Evaluation', 'EvaluationQuestion', 'Location', 'Topic'];
    }
}
