<?php
namespace CHMSTests\Provider\Repositories\Provider;

use CHMSTests\Provider\Repositories\BaseRepositoryTest;
use CHMS\Provider\Repositories\Provider\Provider;
use CHMS\Provider\Repositories\Provider\Contract;

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