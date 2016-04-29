<?php
namespace CHMSTests\SponsorProvider\Models;

use CHMS\SponsorProvider\Models\ClassRecord as Model;
use CHMSTests\SponsorProvider\TestCase;

class ClassRecordTest extends BaseModelTest
{
    static public function getModelClass()
    {
        return Model::class;
    }
}