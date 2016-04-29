<?php
namespace CHMSTests\SponsorProvider\Models;

use CHMS\SponsorProvider\Models\RoleUser as Model;
use CHMSTests\SponsorProvider\TestCase;

class RoleUserTest extends BaseModelTest
{
    static public function getModelClass()
    {
        return Model::class;
    }
}