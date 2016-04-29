<?php
namespace CHMSTests\SponsorProvider\Repositories\Evaluation;

use CHMSTests\SponsorProvider\Repositories\BaseRepositoryTest;
use CHMS\SponsorProvider\Repositories\Evaluation\Provider;
use CHMS\SponsorProvider\Repositories\Evaluation\Contract;

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