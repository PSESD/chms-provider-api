<?php
namespace CHMSTests\Provider\Repositories\EvaluationQuestion;

use CHMSTests\Provider\Repositories\BaseRepositoryTest;
use CHMS\Provider\Repositories\EvaluationQuestion\Provider;
use CHMS\Provider\Repositories\EvaluationQuestion\Contract;

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