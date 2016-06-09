<?php
namespace CHMSTests\ProviderHub\Models;

use CHMS\ProviderHub\Models\Organization as Model;
use CHMSTests\ProviderHub\TestCase;

class OrganizationTest extends BaseModelTest
{
    static public function getModelClass()
    {
        return Model::class;
    }
}