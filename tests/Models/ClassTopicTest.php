<?php
namespace CHMSTests\ProviderHub\Models;

use CHMS\ProviderHub\Models\ClassTopic as Model;
use CHMSTests\ProviderHub\TestCase;

class ClassTopicTest extends BaseModelTest
{
    static public function getModelClass()
    {
        return Model::class;
    }
}