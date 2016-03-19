<?php
namespace CHMSTests\Provider\Models;

use CHMS\Provider\Models\EvaluationQuestion as Model;
use CHMSTests\Provider\TestCase;

class EvaluationQuestionTest extends BaseModelTest
{
    static public function getModelClass()
    {
        return Model::class;
    }
}