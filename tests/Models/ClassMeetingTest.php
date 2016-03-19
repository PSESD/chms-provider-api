<?php
namespace CHMSTests\Provider\Models;

use CHMS\Provider\Models\ClassMeeting as Model;
use CHMSTests\Provider\TestCase;

class ClassMeetingTest extends BaseModelTest
{
    static public function getModelClass()
    {
        return Model::class;
    }
}