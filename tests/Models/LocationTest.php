<?php
namespace CHMSTests\ProviderHub\Models;

use CHMS\ProviderHub\Models\Location as Model;
use CHMSTests\ProviderHub\TestCase;

class LocationTest extends BaseModelTest
{
    static public function getModelClass()
    {
        return Model::class;
    }
}