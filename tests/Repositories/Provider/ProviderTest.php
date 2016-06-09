<?php
namespace CHMSTests\ProviderHub\Repositories\Provider;

use CHMSTests\ProviderHub\Repositories\BaseRepositoryTest;
use CHMS\ProviderHub\Repositories\Provider\Provider;
use CHMS\ProviderHub\Repositories\Provider\Contract;

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