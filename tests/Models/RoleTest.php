<?php
namespace CHMSTests\Provider\Models;

use CHMS\Provider\Models\Role as Model;
use CHMSTests\Provider\TestCase;

class RoleTest extends BaseModelTest
{
    static public function getModelClass()
    {
        return Model::class;
    }
}