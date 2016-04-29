<?php
namespace CHMSTests\SponsorProvider\Http\Controllers\Sponsors;
use CHMS\SponsorProvider\Repositories\Sponsor\Contract;
use CHMSTests\SponsorProvider\ApplicationTestTrait;

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
        return '/sponsors';
    }

    protected function notExpectedAttributes()
    {
        return ['api_secret', 'api_url'];
    }
}