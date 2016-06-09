<?php
namespace CHMSTests\ProviderHub\Repositories;

use CHMSTests\ProviderHub\TestCase;
use Laravel\Lumen\Testing\DatabaseMigrations;

abstract class BaseRepositoryTest extends TestCase
{
    use DatabaseMigrations;

    abstract protected function getContractClass();

    abstract protected function getProviderClass();

    public function testCreate()
    {
        $modelClass = $this->getProviderModelClass();
        $attributes = $this->generateAttributes();
        $model = $this->getProvider()->create($attributes);
        $this->assertTrue($model instanceof $modelClass);
    }

    public function testContractNegotiation()
    {
        $this->assertEquals(get_class($this->getProvider()), $this->getProviderClass());
    }


    protected function generateAttributes()
    {
        return $this->getFactory()->make()->getAttributes();
    }

    protected function createModel($type = null)
    {
        return $this->getFactory($type)->create();
    }

    protected function getFactory($type = null)
    {
        return factory($this->getProviderModelClass(), $type);
    }

    protected function getProviderModelClass()
    {
        static $cache = [];
        if (!isset($cache[get_called_class()])) {
            $cache[get_called_class()] = get_class($this->getProvider()->model());
        }
        return $cache[get_called_class()];
    }

    protected function getProvider()
    {
        return app($this->getContractClass());
    }
}