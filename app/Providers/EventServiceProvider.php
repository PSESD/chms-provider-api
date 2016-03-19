<?php
/**
 * Clock Hour Management System - Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */
namespace CHMS\Provider\Providers;

use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;
use CHMS\Provider\Http\Morphers\AddObjectMeta;
use Illuminate\Database\Eloquent\Model;
use CHMS\Provider\Models\Role as RoleModel;
use CHMS\Provider\Repositories\Role\Contract as RoleProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'CHMS\Provider\Events\SomeEvent' => [
            \CHMS\Provider\Listeners\EventListener::class,
        ]
    ];

    public function boot() {
        RoleModel::saving(function (Model $model) {
            app(RoleProvider::class)->clearRegistryCache();
        });
    }
}
