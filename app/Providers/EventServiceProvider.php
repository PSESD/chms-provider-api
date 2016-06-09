<?php
/**
 * Clock Hour Management System - Provider Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */
namespace CHMS\ProviderHub\Providers;

use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;
use CHMS\ProviderHub\Http\Morphers\AddObjectMeta;
use Illuminate\Database\Eloquent\Model;
use CHMS\ProviderHub\Models\Role as RoleModel;
use CHMS\ProviderHub\Repositories\Role\Contract as RoleProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'CHMS\ProviderHub\Events\SomeEvent' => [
            \CHMS\ProviderHub\Listeners\EventListener::class,
        ]
    ];

    public function boot() {
        RoleModel::saving(function (Model $model) {
            app(RoleProvider::class)->clearRegistryCache();
        });
    }
}
