<?php
namespace CHMSTests\SponsorProvider\Repositories\Location;

use CHMSTests\SponsorProvider\Repositories\BaseRepositoryTest;
use CHMS\SponsorProvider\Repositories\Location\Provider;
use CHMS\SponsorProvider\Repositories\Location\Contract;

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