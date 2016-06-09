<?php
namespace CHMSTests\ProviderHub\Http\Controllers\Records;

use CHMS\ProviderHub\Http\Controllers\ClockHourRecord\ObjectTrait as BaseObjectTrait;
use CHMS\ProviderHub\Repositories\ClockHourRecord\Contract;
use CHMSTests\ProviderHub\ApplicationTestTrait;

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
        return $this->getProviderRoute('records');
    }

    protected function notExpectedAttributes()
    {
        return ['hours_attended'];
    }
}