<?php
namespace CHMSTests\ProviderHub\Http\Controllers\Roles;
use CHMS\ProviderHub\Repositories\Role\Contract;
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
        return $this->getProviderRoute('roles');
    }
}