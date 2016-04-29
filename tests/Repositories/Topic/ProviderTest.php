<?php
namespace CHMSTests\SponsorProvider\Repositories\Topic;

use CHMSTests\SponsorProvider\Repositories\BaseRepositoryTest;
use CHMS\SponsorProvider\Repositories\Topic\Provider;
use CHMS\SponsorProvider\Repositories\Topic\Contract;

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