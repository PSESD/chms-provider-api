<?php
namespace CHMSTests\ProviderHub\Repositories\Evaluation;

use CHMSTests\ProviderHub\Repositories\BaseRepositoryTest;
use CHMS\ProviderHub\Repositories\Evaluation\Provider;
use CHMS\ProviderHub\Repositories\Evaluation\Contract;

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