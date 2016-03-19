<?php
namespace CHMSTests\Provider\Http\Controllers\Roles;
use CHMS\Provider\Repositories\Role\Contract;

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
        return '/roles';
    }
}