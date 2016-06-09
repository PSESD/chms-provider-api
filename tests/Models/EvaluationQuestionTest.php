<?php
namespace CHMSTests\ProviderHub\Models;

use CHMS\ProviderHub\Models\EvaluationQuestion as Model;
use CHMSTests\ProviderHub\TestCase;

class EvaluationQuestionTest extends BaseModelTest
{
    static public function getModelClass()
    {
        return Model::class;
    }
}