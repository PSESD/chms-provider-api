<?php
namespace CHMSTests\ProviderHub\Models;

use CHMS\ProviderHub\Models\ClassRecord as Model;
use CHMSTests\ProviderHub\TestCase;

class ClassRecordTest extends BaseModelTest
{
    static public function getModelClass()
    {
        return Model::class;
    }
}