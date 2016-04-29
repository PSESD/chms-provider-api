<?php
namespace CHMSTests\SponsorProvider\Http\Input\Filters;

use CHMS\SponsorProvider\Http\Input\Filters\ClassRecord as Filter;
use CHMS\SponsorProvider\Models\ClassRecord as Model;
use CHMS\Common\Exceptions\InvalidInputException;
use CHMSTests\Common\Stubs\GenericModel;

class ClassRecordTest extends FilterTest
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
        $base = factory(GenericModel::class, 'ClassRecord')->make()->toArray();
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