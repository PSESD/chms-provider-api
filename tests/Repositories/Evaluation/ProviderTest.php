<?php
namespace CHMSTests\Provider\Repositories\Evaluation;

use CHMSTests\Provider\Repositories\BaseRepositoryTest;
use CHMS\Provider\Repositories\Evaluation\Provider;
use CHMS\Provider\Repositories\Evaluation\Contract;

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