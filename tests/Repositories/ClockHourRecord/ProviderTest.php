<?php
namespace CHMSTests\ProviderHub\Repositories\ClockHourRecord;

use CHMSTests\ProviderHub\Repositories\BaseRepositoryTest;
use CHMS\ProviderHub\Repositories\ClockHourRecord\Provider;
use CHMS\ProviderHub\Repositories\ClockHourRecord\Contract;

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