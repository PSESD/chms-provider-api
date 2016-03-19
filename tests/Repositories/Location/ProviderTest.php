<?php
namespace CHMSTests\Provider\Repositories\Location;

use CHMSTests\Provider\Repositories\BaseRepositoryTest;
use CHMS\Provider\Repositories\Location\Provider;
use CHMS\Provider\Repositories\Location\Contract;

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