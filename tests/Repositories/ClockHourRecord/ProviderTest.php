<?php
namespace CHMSTests\Provider\Repositories\ClockHourRecord;

use CHMSTests\Provider\Repositories\BaseRepositoryTest;
use CHMS\Provider\Repositories\ClockHourRecord\Provider;
use CHMS\Provider\Repositories\ClockHourRecord\Contract;

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