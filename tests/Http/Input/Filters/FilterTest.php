<?php
namespace CHMSTests\Provider\Http\Input\Filters;

use CHMSTests\Provider\TestCase;
use Laravel\Lumen\Testing\DatabaseMigrations;
use CHMS\Common\Contracts\Acl as AclContract;
use CHMSTests\Provider\Stubs\GenericModel;

abstract class FilterTest extends TestCase
{
    use DatabaseMigrations;

    protected function filters()
    {
        return [];
    }

    public function testFilters()
    {
        $filterClass = $this->getFilterClass();
        $modelClass = $this->getModelClass();
        $filter = new $filterClass;
        $model = new $modelClass;
        $acl = $this->app->make(AclContract::class);
        foreach ($this->filters() as $index => $p) {
            $acl->switchRoleContext($p['roles']);
            $exceptionThrown = false;
            try {
                $filter->filter($model, $p['input'], $p['scenario'], true);
            } catch (\Exception $e) {
                if (get_class($e) === 'ErrorException') {
                    throw $e;
                }
                $exceptionThrown = $e;
            }
            if ($p['expectException'] === false) {
                $this->assertTrue($exceptionThrown === false, $exceptionThrown . '; Test Index: ' . $index);
            } else {
                $expectClass = $p['expectException'];
                $this->assertTrue($exceptionThrown instanceof $expectClass, $exceptionThrown . '; Test Index: ' . $index);
            }
        }
    }
}