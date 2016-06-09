<?php
namespace CHMSTests\ProviderHub\Repositories\Topic;

use CHMSTests\ProviderHub\Repositories\BaseRepositoryTest;
use CHMS\ProviderHub\Repositories\Topic\Provider;
use CHMS\ProviderHub\Repositories\Topic\Contract;

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