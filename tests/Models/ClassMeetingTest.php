<?php
namespace CHMSTests\SponsorProvider\Models;

use CHMS\SponsorProvider\Models\ClassMeeting as Model;
use CHMSTests\SponsorProvider\TestCase;

class ClassMeetingTest extends BaseModelTest
{
    static public function getModelClass()
    {
        return Model::class;
    }
}