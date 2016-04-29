<?php
namespace CHMSTests\SponsorProvider\Repositories\ClassRecord;

use CHMSTests\SponsorProvider\Repositories\BaseRepositoryTest;
use CHMS\SponsorProvider\Repositories\ClassRecord\Provider;
use CHMS\SponsorProvider\Repositories\ClassRecord\Contract;

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