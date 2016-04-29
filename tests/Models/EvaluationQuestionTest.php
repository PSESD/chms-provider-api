<?php
namespace CHMSTests\SponsorProvider\Models;

use CHMS\SponsorProvider\Models\EvaluationQuestion as Model;
use CHMSTests\SponsorProvider\TestCase;

class EvaluationQuestionTest extends BaseModelTest
{
    static public function getModelClass()
    {
        return Model::class;
    }
}