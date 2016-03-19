<?php
namespace CHMSTests\Provider\Models;

use CHMS\Provider\Models\EvaluationQuestionOption as Model;
use CHMSTests\Provider\TestCase;

class EvaluationQuestionOptionTest extends BaseModelTest
{
    static public function getModelClass()
    {
        return Model::class;
    }
}