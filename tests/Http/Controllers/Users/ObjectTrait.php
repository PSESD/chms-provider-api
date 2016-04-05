<?php
namespace CHMSTests\Provider\Http\Controllers\Users;
use CHMS\Provider\Repositories\User\Contract;
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
        return '/users';
    }

    protected function notExpectedAttributes()
    {
        return ['password'];
    }
}