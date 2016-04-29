<?php
namespace CHMSTests\SponsorProvider\Repositories\Sponsor;

use CHMSTests\SponsorProvider\Repositories\BaseRepositoryTest;
use CHMS\SponsorProvider\Repositories\Sponsor\Provider;
use CHMS\SponsorProvider\Repositories\Sponsor\Contract;

class ProviderTest extends BaseRepositoryTest
{
    protected function getContractClass()
    {
        return Contract::class;
    }

    protected function getProviderClass()
    {
        return Provider::class;
    }
}