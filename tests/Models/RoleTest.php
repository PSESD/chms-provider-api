<?php
namespace CHMSTests\ProviderHub\Models;

use CHMS\ProviderHub\Models\Role as Model;
use CHMSTests\ProviderHub\TestCase;

class RoleTest extends BaseModelTest
{
    static public function getModelClass()
    {
        return Model::class;
    }
}