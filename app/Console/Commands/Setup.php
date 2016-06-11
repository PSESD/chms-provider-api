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
use CHMS\ProviderHub\Repositories\Role\Contract as RoleProvider;
use CHMS\ProviderHub\Repositories\Provider\Contract as ProviderProvider;
use CHMS\Common\Contracts\Acl as AclContract;
use CHMS\ProviderHub\Models\Client;

class Setup extends Command
{
    protected $signature = 'setup';
    protected $description = 'Set up the dev environment';
    public function handle(
        ProviderProvider $providerProvider,
        AclContract $acl
    ) {
        $selfClient = Client::where(['name' => 'Provider Hub'])->first();
        if (empty($selfClient)) {
            $selfClient = new Client;
            $selfClient->name = 'Provider Hub';
            $selfClient->secret = 'foobar';
            $selfClient->type = 'provider_hub';
            $selfClient->save();
        }
        \dump(['provider hub', 'client_id' => $selfClient->id, 'client_secret' => 'foobar']);


        \dump(['role setup', $acl->setupRoles()]);
        $provider = $providerProvider->find(['name' => 'Test Provider', 'slug' => 'test']);
        if (empty($provider)) {
        	$provider = $providerProvider->create([
                'name' => 'Test Provider',
                'slug' => 'test'
            ]);
        }
        \dump(['provider', 'id' => $provider->id, 'slug' => $provider->slug]);


    }
}
