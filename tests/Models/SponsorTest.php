<?php
namespace CHMSTests\SponsorProvider\Models;

use CHMS\SponsorProvider\Models\Sponsor as Model;
use CHMSTests\SponsorProvider\TestCase;

class SponsorTest extends BaseModelTest
{
    static public function getModelClass()
    {
        return Model::class;
    }
}