<?php
namespace CHMSTests\Provider\Http\Controllers\Organizations;
use CHMS\Provider\Repositories\Organization\Contract;
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
        return '/organizations';
    }
}