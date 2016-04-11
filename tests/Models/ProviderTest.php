<?php
namespace CHMSTests\Provider\Models;

use CHMS\Provider\Models\Provider as Model;
use CHMSTests\Provider\TestCase;

class ProviderTest extends BaseModelTest
{
    static public function getModelClass()
    {
        return Model::class;
    }
}