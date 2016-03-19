<?php
namespace CHMSTests\Provider\Models;

use CHMS\Provider\Models\Organization as Model;
use CHMSTests\Provider\TestCase;

class OrganizationTest extends BaseModelTest
{
    static public function getModelClass()
    {
        return Model::class;
    }
}