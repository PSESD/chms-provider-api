<?php
namespace CHMSTests\ProviderHub\Models;

use CHMS\ProviderHub\Models\Provider as Model;
use CHMSTests\ProviderHub\TestCase;

class ProviderTest extends BaseModelTest
{
    static public function getModelClass()
    {
        return Model::class;
    }
}