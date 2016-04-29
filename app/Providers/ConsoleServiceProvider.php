<?php
/**
 * Clock Hour Management System - Sponsor Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */
namespace CHMS\SponsorProvider\Providers;

use Illuminate\Support\ServiceProvider;

class ConsoleServiceProvider extends ServiceProvider
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
     * Boot the console specific services
     *
     * @return void
     */
    public function boot()
    {
		$this->app->singleton(
		    \Illuminate\Contracts\Console\Kernel::class,
		    \CHMS\SponsorProvider\Console\Kernel::class
		);
        $this->app->register(\Appzcoder\LumenRoutesList\RoutesCommandServiceProvider::class);
    }
}
