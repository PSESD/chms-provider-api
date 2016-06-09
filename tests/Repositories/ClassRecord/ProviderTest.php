<?php
namespace CHMSTests\ProviderHub\Repositories\ClassRecord;

use CHMSTests\ProviderHub\Repositories\BaseRepositoryTest;
use CHMS\ProviderHub\Repositories\ClassRecord\Provider;
use CHMS\ProviderHub\Repositories\ClassRecord\Contract;

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