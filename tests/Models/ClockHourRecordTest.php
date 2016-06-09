<?php
namespace CHMSTests\ProviderHub\Models;

use CHMS\ProviderHub\Models\ClockHourRecord as Model;
use CHMSTests\ProviderHub\TestCase;

class ClockHourRecordTest extends BaseModelTest
{
    static public function getModelClass()
    {
        return Model::class;
    }
}