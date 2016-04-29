<?php
namespace CHMSTests\SponsorProvider\Models;

use CHMS\SponsorProvider\Models\ClassTopic as Model;
use CHMSTests\SponsorProvider\TestCase;

class ClassTopicTest extends BaseModelTest
{
    static public function getModelClass()
    {
        return Model::class;
    }
}