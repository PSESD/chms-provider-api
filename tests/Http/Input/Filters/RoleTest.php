<?php
namespace CHMSTests\ProviderHub\Http\Input\Filters;

use CHMS\ProviderHub\Http\Input\Filters\Role as Filter;
use CHMS\ProviderHub\Models\Role as Model;
use CHMS\Common\Exceptions\InvalidInputException;
use CHMSTests\Common\Stubs\GenericModel;

class RoleTest extends FilterTest
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
        $base = factory(GenericModel::class, 'Role')->make()->toArray();
        $tests = [];
        // $tests[] = [
        //     'roles' => ['provider_administrator'],
        //     'input' => array_merge($base, []),
        //     'scenario' => 'create', 
        //     'expectException' => false
        // ];
        return $tests;
    }
}