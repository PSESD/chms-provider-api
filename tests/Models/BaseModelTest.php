<?php
namespace CHMSTests\ProviderHub\Models;

use CHMSTests\ProviderHub\TestCase;
use Laravel\Lumen\Testing\DatabaseMigrations;

abstract class BaseModelTest extends TestCase
{
    use DatabaseMigrations;

    public static function types()
    {
        return [null];
    }

    public static function generate($type = null, $number = 1)
    {
        return factory(static::getModelClass(), $type, $number)->create();
    }

    public static function make($type = null, $number = 1)
    {
        return factory(static::getModelClass(), $type, $number)->make();
    }
    

    public function testCreate()
    {
        $modelClass = static::getModelClass();
        foreach (static::types() as $type) {
            $model = static::generate($type);
            $this->assertTrue($model instanceof $modelClass, 'creating ' . $modelClass . ':'. $type);
        }
    }
}