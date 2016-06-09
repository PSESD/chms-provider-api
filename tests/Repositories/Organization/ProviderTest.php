<?php
namespace CHMSTests\ProviderHub\Repositories\Organization;

use CHMSTests\ProviderHub\Repositories\BaseRepositoryTest;
use CHMS\ProviderHub\Repositories\Organization\Provider;
use CHMS\ProviderHub\Repositories\Organization\Contract;

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