<?php
namespace CHMSTests\ProviderHub\Http\Controllers\Classes;
use CHMS\ProviderHub\Repositories\ClassRecord\Contract;
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
        return $this->getProviderRoute('classes');
    }

    protected function notExpectedAttributes()
    {
        return ['expected_participants', 'has_college_credit', 'list_publicly', 'online_class', 'instructional_hours'];
    }
}