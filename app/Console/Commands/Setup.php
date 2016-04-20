<?php
/**
 * Clock Hour Management System - Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */
namespace CHMS\Provider\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use CHMS\Provider\Models;
use CHMS\Provider\Repositories\User\Contract as UserProvider;
use CHMS\Provider\Repositories\Client\Contract as ClientProvider;
use CHMS\Provider\Repositories\Role\Contract as RoleProvider;
use CHMS\Provider\Repositories\Provider\Contract as ProviderProvider;
use CHMS\Common\Contracts\Acl as AclContract;

class Setup extends Command
{
    protected $signature = 'setup';
    protected $description = 'Set up the dev environment';
    public function handle(
        ProviderProvider $providerProvider,
        AclContract $acl
    ) {

        $provider = $providerProvider->find(['name' => 'Test Provider', 'slug' => 'test']);
        if (empty($provider)) {
        	$provider = $providerProvider->create([
                'name' => 'Test Client',
                'slug' => 'test'
            ]);
        }
        \dump(['provider', $provider->slug]);

    }
}
