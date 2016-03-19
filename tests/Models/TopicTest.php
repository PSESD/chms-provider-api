<?php
namespace CHMSTests\Provider\Models;

use CHMS\Provider\Models\Topic as Model;
use CHMSTests\Provider\TestCase;

class TopicTest extends BaseModelTest
{
    static public function getModelClass()
    {
        return Model::class;
    }
}