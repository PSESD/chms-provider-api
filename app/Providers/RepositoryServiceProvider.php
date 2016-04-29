<?php
/**
 * Clock Hour Management System - Sponsor Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */
namespace CHMS\SponsorProvider\Providers;

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
            $modelClass = 'CHMS\SponsorProvider\Models\\' . $model;
            $contractClass = 'CHMS\SponsorProvider\Repositories\\' . $model . '\Contract';
            $repositoryClass = 'CHMS\SponsorProvider\Repositories\\' . $model . '\Provider';
            $this->app->bind($contractClass, function($app) use ($modelClass, $repositoryClass) {
                return new $repositoryClass( new $modelClass );
            });
        }
    }
}
