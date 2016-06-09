<?php
namespace CHMSTests\ProviderHub\Models;

use CHMS\ProviderHub\Models\EvaluationQuestionOption as Model;
use CHMSTests\ProviderHub\TestCase;

class EvaluationQuestionOptionTest extends BaseModelTest
{
    static public function getModelClass()
    {
        return Model::class;
    }
}