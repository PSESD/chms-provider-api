<?php
namespace CHMSTests\Provider\Http\Controllers\Records;

use CHMS\Provider\Http\Controllers\Records\ObjectTrait as BaseObjectTrait;
use CHMS\Provider\Repositories\Record\Contract;
use CHMSTests\Provider\ApplicationTestTrait;

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
        return '/records';
    }

    protected function notExpectedAttributes()
    {
        return ['hours_attended'];
    }
}