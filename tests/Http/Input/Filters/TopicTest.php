<?php
namespace CHMSTests\ProviderHub\Http\Input\Filters;

use CHMS\ProviderHub\Http\Input\Filters\Topic as Filter;
use CHMS\ProviderHub\Models\Topic as Model;
use CHMS\Common\Exceptions\InvalidInputException;
use CHMSTests\Common\Stubs\GenericModel;

class TopicTest extends FilterTest
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
        $base = factory(GenericModel::class, 'Topic')->make()->toArray();
        $tests[] = [
            'roles' => ['provider_administrator'],
            'input' => array_merge($base, []),
            'scenario' => 'create', 
            'expectException' => false
        ];
        return $tests;
    }
}