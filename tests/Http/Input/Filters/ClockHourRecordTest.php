<?php
namespace CHMSTests\SponsorProvider\Http\Input\Filters;

use CHMS\SponsorProvider\Http\Input\Filters\ClockHourRecord as Filter;
use CHMS\SponsorProvider\Models\ClockHourRecord as Model;
use CHMS\Common\Exceptions\InvalidInputException;
use CHMSTests\Common\Stubs\GenericModel;

class ClockHourRecordTest extends FilterTest
{
    protected function getFilterClass()
    {
        return Filter::class;
    }

    protected function getModelClass()
    {
        return Model::class;
    }

    protected function filters()
    {
        $faker = \Faker\Factory::create();
        $base = factory(GenericModel::class, 'ClockHourRecord')->make()->toArray();
        $tests = [];
        // $tests[] = [
        //     'roles' => ['sponsor_administrator'],
        //     'input' => array_merge($base, []),
        //     'scenario' => 'create', 
        //     'expectException' => false
        // ];
        return $tests;
    }
}