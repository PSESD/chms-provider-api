<?php
namespace CHMSTests\ProviderHub\Repositories\User;

use CHMSTests\ProviderHub\Repositories\BaseRepositoryTest;
use CHMS\ProviderHub\Repositories\User\Provider;
use CHMS\ProviderHub\Repositories\User\Contract;
use Illuminate\Contracts\Pagination\Paginator as PaginatorContract;

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

    

    /**
     * Test BaseRepository
     */
    public function testFindById()
    {
        $modelClass = $this->getProviderModelClass();
        $existingModel = $this->createModel();
        $model = $this->getProvider()->findById($existingModel->id);
        $this->assertEquals($model->id, $existingModel->id);

        $badModel = $this->getProvider()->findById($existingModel->id . 'bad');
        $this->assertNull($badModel);
    }


    public function testQuery()
    {
        $modelClass = $this->getProviderModelClass();
        $existingModel = $this->createModel();
        $models = $this->getProvider()->query([['id', '=', $existingModel->id]])->get();
        $this->assertEquals(count($models), 1);
        $this->assertEquals($models[0]->id, $existingModel->id);
    }

    public function testFind()
    {
        $modelClass = $this->getProviderModelClass();
        $existingModel = $this->createModel();
        $model = $this->getProvider()->find([['id', '=', $existingModel->id]]);
        $this->assertEquals($model->id, $existingModel->id);
        
        $badModel = $this->getProvider()->findById($existingModel->id . 'bad');
        $this->assertNull($badModel);
    }

    public function testFindAll()
    {
        $modelClass = $this->getProviderModelClass();
        $existingModel = $this->createModel();
        $models = $this->getProvider()->findAll([['id', '=', $existingModel->id]]);
        $this->assertEquals(count($models), 1);
        $this->assertEquals($models[0]->id, $existingModel->id);
    }

    public function testPaginate()
    {
        $modelClass = $this->getProviderModelClass();
        $existingModel = $this->createModel();
        $pagination = $this->getProvider()->paginate([['id', '=', $existingModel->id]]);
        $this->assertTrue($pagination instanceof PaginatorContract);
        $this->assertEquals($pagination->items()[0]->id, $existingModel->id);
        $this->assertEquals($pagination->total(), 1);
    }

}