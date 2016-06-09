<?php
namespace CHMSTests\ProviderHub\Models;

use CHMS\ProviderHub\Models\User as Model;
use CHMSTests\ProviderHub\TestCase;

class UserTest extends BaseModelTest
{
    static public function getModelClass()
    {
        return Model::class;
    }
}