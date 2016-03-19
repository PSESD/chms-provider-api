<?php
namespace CHMSTests\Provider\Repositories\ClassRecord;

use CHMSTests\Provider\Repositories\BaseRepositoryTest;
use CHMS\Provider\Repositories\ClassRecord\Provider;
use CHMS\Provider\Repositories\ClassRecord\Contract;

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