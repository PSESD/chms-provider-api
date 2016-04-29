<?php
namespace CHMSTests\SponsorProvider\Models;

use CHMS\SponsorProvider\Models\Organization as Model;
use CHMSTests\SponsorProvider\TestCase;

class OrganizationTest extends BaseModelTest
{
    static public function getModelClass()
    {
        return Model::class;
    }
}