<?php
/**
 * Clock Hour Management System - Sponsor Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */
namespace CHMS\SponsorProvider\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use CHMS\SponsorProvider\Models;
use CHMS\SponsorProvider\Repositories\Provider\Contract as ProviderProvider;
use CHMS\SponsorProvider\Repositories\Client\Contract as ClientProvider;
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
