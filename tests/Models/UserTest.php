<?php
namespace CHMSTests\SponsorProvider\Models;

use CHMS\SponsorProvider\Models\User as Model;
use CHMSTests\SponsorProvider\TestCase;

class UserTest extends BaseModelTest
{
    static public function getModelClass()
    {
        return Model::class;
    }
}