<?php
namespace CHMSTests\SponsorProvider\Models;

use CHMS\SponsorProvider\Models\Role as Model;
use CHMSTests\SponsorProvider\TestCase;

class RoleTest extends BaseModelTest
{
    static public function getModelClass()
    {
        return Model::class;
    }
}