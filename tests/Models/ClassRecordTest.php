<?php
namespace CHMSTests\Provider\Models;

use CHMS\Provider\Models\ClassRecord as Model;
use CHMSTests\Provider\TestCase;

class ClassRecordTest extends BaseModelTest
{
    static public function getModelClass()
    {
        return Model::class;
    }
}