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
use CHMS\Provider\Repositories\Provider\Contract as ProviderProvider;
use CHMS\Provider\Repositories\Client\Contract as ClientProvider;
use CHMS\Common\Contracts\Acl as AclContract;

class SeedProviders extends Command
{
    protected $signature = 'seed:providers';
    protected $description = 'Seed the providers';
    public function handle(
        ProviderProvider $userProvider,
        ClientProvider $clientProvider
    ) {
        factory(Models\Client::class, 25)->create();
    }
}
