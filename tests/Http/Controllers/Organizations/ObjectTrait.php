<?php
namespace CHMSTests\Provider\Http\Controllers\Organizations;
use CHMS\Provider\Repositories\Organization\Contract;

trait ObjectTrait
{
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