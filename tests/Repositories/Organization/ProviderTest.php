<?php
namespace CHMSTests\SponsorProvider\Repositories\Organization;

use CHMSTests\SponsorProvider\Repositories\BaseRepositoryTest;
use CHMS\SponsorProvider\Repositories\Organization\Provider;
use CHMS\SponsorProvider\Repositories\Organization\Contract;

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