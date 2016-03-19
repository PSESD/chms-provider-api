<?php
namespace CHMSTests\Provider\Models;

use CHMS\Provider\Models\RoleUser as Model;
use CHMSTests\Provider\TestCase;

class RoleUserTest extends BaseModelTest
{
    static public function getModelClass()
    {
        return Model::class;
    }
}