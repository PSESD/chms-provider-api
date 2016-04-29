<?php
namespace CHMSTests\SponsorProvider\Repositories\Role;

use CHMSTests\SponsorProvider\Repositories\BaseRepositoryTest;
use CHMS\SponsorProvider\Repositories\Role\Provider;
use CHMS\SponsorProvider\Repositories\Role\Contract;

class ProviderTest extends BaseRepositoryTest
{
    protected function getContractClass()
    {
        return Contract::class;
    }

    protected function getProviderClass()
    {
        return Provider::class;
    }

    public function testGetRegistry()
    {
        $registry = $this->getProvider()->getRegistry();
        $this->assertEmpty($registry);
        $this->createModel();
        $registry = $this->getProvider()->getRegistry();
        $this->assertNotEmpty($registry);
    }

    public function testGetRegistryBySystemId()
    {
        $model = $this->createModel();
        $registry = $this->getProvider()->getRegistryBySystemId();
        $this->assertArrayHasKey($model->system_id, $registry);
        $this->assertEquals($model->id, $registry[$model->system_id]->id);
        $this->assertEquals($model->id, $this->getProvider()->getRoleBySystemId($model->system_id)->id);
        $this->assertNull($this->getProvider()->getRoleBySystemId($model->system_id .'bad'));
    }


    public function testGetRegistryByIdId()
    {
        $model = $this->createModel();
        $this->assertEquals($model->id, $this->getProvider()->getRoleById($model->id)->id);
        $this->assertNull($this->getProvider()->getRoleById($model->id .'bad'));
    }
}