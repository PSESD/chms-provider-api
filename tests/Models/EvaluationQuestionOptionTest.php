<?php
namespace CHMSTests\SponsorProvider\Models;

use CHMS\SponsorProvider\Models\EvaluationQuestionOption as Model;
use CHMSTests\SponsorProvider\TestCase;

class EvaluationQuestionOptionTest extends BaseModelTest
{
    static public function getModelClass()
    {
        return Model::class;
    }
}