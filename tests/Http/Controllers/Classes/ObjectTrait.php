<?php
namespace CHMSTests\SponsorProvider\Http\Controllers\Classes;
use CHMS\SponsorProvider\Repositories\ClassRecord\Contract;
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
        return $this->getSponsorRoute('classes');
    }

    protected function notExpectedAttributes()
    {
        return ['expected_participants', 'has_college_credit', 'list_publicly', 'online_class', 'instructional_hours'];
    }
}