<?php
namespace CHMSTests\Provider\Http\Controllers\Classes;
use CHMS\Provider\Repositories\ClassRecord\Contract;
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
        return '/classes';
    }
}