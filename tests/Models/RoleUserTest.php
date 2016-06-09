<?php
namespace CHMSTests\ProviderHub\Models;

use CHMS\ProviderHub\Models\RoleUser as Model;
use CHMSTests\ProviderHub\TestCase;

class RoleUserTest extends BaseModelTest
{
    static public function getModelClass()
    {
        return Model::class;
    }
}