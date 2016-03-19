<?php
/**
 * Clock Hour Management System - Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */
namespace CHMS\Provider\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use CHMS\Common\Policies\Request as RequestPolicy;
use Gate;

class PolicyProvider extends ServiceProvider
{
    public function boot()
    {
        Gate::policy(Request::class, RequestPolicy::class);
        foreach (AppServiceProvider::getObjectModelNames() as $model) {
            $modelClass = 'CHMS\Provider\Models\\' . $model;
            $policyClass = 'CHMS\Provider\Policies\\' . $model;
            Gate::policy($modelClass, $policyClass);
        }
    }

    public function register()
    {
        //
    }
}
