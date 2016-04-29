<?php
namespace CHMSTests\SponsorProvider\Models;

use CHMS\SponsorProvider\Models\Location as Model;
use CHMSTests\SponsorProvider\TestCase;

class LocationTest extends BaseModelTest
{
    static public function getModelClass()
    {
        return Model::class;
    }
}