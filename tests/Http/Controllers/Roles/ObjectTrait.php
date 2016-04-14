<?php
namespace CHMSTests\Provider\Http\Controllers\Roles;
use CHMS\Provider\Repositories\Role\Contract;
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
        return $this->getProviderRoute('roles');
    }
}