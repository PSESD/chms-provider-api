<?php
/**
 * Clock Hour Management System - Provider Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */
namespace CHMS\ProviderHub\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use CHMS\ProviderHub\Models;
use CHMS\ProviderHub\Repositories\User\Contract as UserProvider;
use CHMS\ProviderHub\Repositories\Client\Contract as ClientProvider;
use CHMS\ProviderHub\Repositories\Role\Contract as RoleProvider;
use CHMS\ProviderHub\Repositories\Provider\Contract as ProviderProvider;
use CHMS\Common\Contracts\Acl as AclContract;

class Setup extends Command
{
    protected $signature = 'setup';
    protected $description = 'Set up the dev environment';
    public function handle(
        ProviderProvider $providerProvider,
        AclContract $acl
    ) {
        \dump(['role setup', $acl->setupRoles()]);
        $provider = $providerProvider->find(['name' => 'Test Provider', 'slug' => 'test']);
        if (empty($provider)) {
        	$provider = $providerProvider->create([
                'name' => 'Test Provider',
                'slug' => 'test'
            ]);
        }
        \dump(['provider', $provider->slug]);


    }
}
