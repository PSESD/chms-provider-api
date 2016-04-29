<?php
namespace CHMSTests\SponsorProvider\Repositories\EvaluationQuestion;

use CHMSTests\SponsorProvider\Repositories\BaseRepositoryTest;
use CHMS\SponsorProvider\Repositories\EvaluationQuestion\Provider;
use CHMS\SponsorProvider\Repositories\EvaluationQuestion\Contract;

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