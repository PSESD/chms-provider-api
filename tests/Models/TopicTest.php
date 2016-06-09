<?php
namespace CHMSTests\ProviderHub\Models;

use CHMS\ProviderHub\Models\Topic as Model;
use CHMSTests\ProviderHub\TestCase;

class TopicTest extends BaseModelTest
{
    static public function getModelClass()
    {
        return Model::class;
    }
}