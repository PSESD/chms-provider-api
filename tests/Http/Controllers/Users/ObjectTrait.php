<?php
namespace CHMSTests\Provider\Http\Controllers\Users;
use CHMS\Provider\Repositories\User\Contract;

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
        return '/users';
    }

    protected function notExpectedAttributes()
    {
        return ['password'];
    }
}