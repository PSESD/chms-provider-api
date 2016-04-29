<?php
namespace CHMSTests\SponsorProvider\Http\Controllers\Records;

use CHMS\SponsorProvider\Http\Controllers\ClockHourRecord\ObjectTrait as BaseObjectTrait;
use CHMS\SponsorProvider\Repositories\ClockHourRecord\Contract;
use CHMSTests\SponsorProvider\ApplicationTestTrait;

trait ObjectTrait
{
    use ApplicationTestTrait;
    /**
     * @inheritdoc
     */
    public function getRepository()
    {
        return app(Contract::class);
    }


    public function getRoute()
    {
        return $this->getSponsorRoute('records');
    }

    protected function notExpectedAttributes()
    {
        return ['hours_attended'];
    }
}