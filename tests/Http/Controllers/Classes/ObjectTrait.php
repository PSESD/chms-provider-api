<?php
namespace CHMSTests\Provider\Http\Controllers\Classes;
use CHMS\Provider\Repositories\ClassReference\Contract;

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
        return '/classes';
    }
}