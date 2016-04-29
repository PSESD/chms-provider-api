<?php
namespace CHMSTests\SponsorProvider\Http\Controllers\Roles;
use CHMS\SponsorProvider\Repositories\Role\Contract;
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
        return $this->getSponsorRoute('roles');
    }
}