<?php
/**
 * Clock Hour Management System - Provider Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */
namespace CHMS\ProviderHub\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * @inheritdoc
     */
    public function boot()
    {
        //
    }

    /**
     * @inheritdoc
     */
    public function register()
    {
        $localModels = AppServiceProvider::getObjectModelNames();
        foreach ($localModels as $model) {
            $modelClass = 'CHMS\ProviderHub\Models\\' . $model;
            $contractClass = 'CHMS\ProviderHub\Repositories\\' . $model . '\Contract';
            $repositoryClass = 'CHMS\ProviderHub\Repositories\\' . $model . '\Provider';
            $this->app->bind($contractClass, function($app) use ($modelClass, $repositoryClass) {
                return new $repositoryClass( new $modelClass );
            });
        }
    }
}
