<?php
namespace CHMSTests\Provider\Models;

use CHMS\Provider\Models\User as Model;
use CHMSTests\Provider\TestCase;

class UserTest extends BaseModelTest
{
    static public function getModelClass()
    {
        return Model::class;
    }
}