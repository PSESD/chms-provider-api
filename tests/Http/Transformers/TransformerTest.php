<?php
namespace CHMSTests\ProviderHub\Http\Transformers;

use CHMSTests\ProviderHub\TestCase;
use Laravel\Lumen\Testing\DatabaseMigrations;
use CHMS\Common\Contracts\Acl as AclContract;

abstract class TransformerTest extends TestCase
{
    use DatabaseMigrations;
    public function testHubAdminTransform()
    {
        $model = $this->getModel();
        $acl = $this->app->make(AclContract::class);
        $acl->switchRoleContext(['hub_administrator']);
        $f = $this->getTransformer();
        $result = $f->transform($model);
        $this->assertArrayHasKey('id', $result);
        $this->assertArrayNotHasKey('deleted_by', $result);
    }

    public function getTransformer()
    {
        $transformerClass = $this->getTransformerClass();
        return new $transformerClass;
    }

    public function getModel()
    {
        return factory($this->getModelClass())->create();
    }
}