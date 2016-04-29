<?php
namespace CHMSTests\SponsorProvider\Http\Input\Filters;

use CHMS\SponsorProvider\Http\Input\Filters\Location as Filter;
use CHMS\SponsorProvider\Models\Location as Model;
use CHMS\Common\Exceptions\InvalidInputException;
use CHMSTests\Common\Stubs\GenericModel;

class LocationTest extends FilterTest
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
        $base = factory(GenericModel::class, 'Location')->make()->toArray();
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