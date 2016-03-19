<?php
namespace CHMSTests\Provider\Http\Controllers\Providers;
use CHMS\Provider\Repositories\Provider\Contract;

trait ObjectTrait
{
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
        return ['provider_api_secret', 'provider_api_url'];
    }
}