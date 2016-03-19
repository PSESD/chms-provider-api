<?php
namespace CHMSTests\Provider\Repositories\Organization;

use CHMSTests\Provider\Repositories\BaseRepositoryTest;
use CHMS\Provider\Repositories\Organization\Provider;
use CHMS\Provider\Repositories\Organization\Contract;

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