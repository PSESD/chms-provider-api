<?php
namespace CHMSTests\Provider\Models;

use CHMS\Provider\Models\ClockHourRecord as Model;
use CHMSTests\Provider\TestCase;

class ClockHourRecordTest extends BaseModelTest
{
    static public function getModelClass()
    {
        return Model::class;
    }
}