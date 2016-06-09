<?php
namespace CHMSTests\ProviderHub\Models;

use CHMS\ProviderHub\Models\ClassMeeting as Model;
use CHMSTests\ProviderHub\TestCase;

class ClassMeetingTest extends BaseModelTest
{
    static public function getModelClass()
    {
        return Model::class;
    }
}