<?php
namespace CHMSTests\Provider\Models;

use CHMS\Provider\Models\ClassTopic as Model;
use CHMSTests\Provider\TestCase;

class ClassTopicTest extends BaseModelTest
{
    static public function getModelClass()
    {
        return Model::class;
    }
}