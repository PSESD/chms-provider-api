<?php
namespace CHMSTests\SponsorProvider\Repositories\ClockHourRecord;

use CHMSTests\SponsorProvider\Repositories\BaseRepositoryTest;
use CHMS\SponsorProvider\Repositories\ClockHourRecord\Provider;
use CHMS\SponsorProvider\Repositories\ClockHourRecord\Contract;

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