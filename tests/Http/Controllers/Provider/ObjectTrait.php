<?php
namespace CHMSTests\ProviderHub\Http\Controllers\Providers;
use CHMS\ProviderHub\Repositories\Provider\Contract;
use CHMSTests\ProviderHub\ApplicationTestTrait;

trait ObjectTrait
{
    use ApplicationTestTrait;
    /**
     * @inheritdoc
     */
    public function getRepository()
    {
        return app(Contract::class);
    }


    public function getRoute()
    {
        return '/providers';
    }

    protected function notExpectedAttributes()
    {
        return ['api_secret', 'api_url'];
    }
}