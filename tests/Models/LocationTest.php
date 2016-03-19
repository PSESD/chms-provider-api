<?php
namespace CHMSTests\Provider\Models;

use CHMS\Provider\Models\Location as Model;
use CHMSTests\Provider\TestCase;

class LocationTest extends BaseModelTest
{
    static public function getModelClass()
    {
        return Model::class;
    }
}