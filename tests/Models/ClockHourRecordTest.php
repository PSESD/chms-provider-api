<?php
namespace CHMSTests\SponsorProvider\Models;

use CHMS\SponsorProvider\Models\ClockHourRecord as Model;
use CHMSTests\SponsorProvider\TestCase;

class ClockHourRecordTest extends BaseModelTest
{
    static public function getModelClass()
    {
        return Model::class;
    }
}