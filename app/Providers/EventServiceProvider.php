<?php
/**
 * Clock Hour Management System - Sponsor Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */
namespace CHMS\SponsorProvider\Providers;

use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;
use CHMS\SponsorProvider\Http\Morphers\AddObjectMeta;
use Illuminate\Database\Eloquent\Model;
use CHMS\SponsorProvider\Models\Role as RoleModel;
use CHMS\SponsorProvider\Repositories\Role\Contract as RoleProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'CHMS\SponsorProvider\Events\SomeEvent' => [
            \CHMS\SponsorProvider\Listeners\EventListener::class,
        ]
    ];

    public function boot() {
        RoleModel::saving(function (Model $model) {
            app(RoleProvider::class)->clearRegistryCache();
        });
    }
}
