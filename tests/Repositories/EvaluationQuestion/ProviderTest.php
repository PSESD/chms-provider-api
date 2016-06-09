<?php
namespace CHMSTests\ProviderHub\Repositories\EvaluationQuestion;

use CHMSTests\ProviderHub\Repositories\BaseRepositoryTest;
use CHMS\ProviderHub\Repositories\EvaluationQuestion\Provider;
use CHMS\ProviderHub\Repositories\EvaluationQuestion\Contract;

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