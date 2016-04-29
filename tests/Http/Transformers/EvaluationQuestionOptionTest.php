<?php
namespace CHMSTests\SponsorProvider\Http\Transformers;

use CHMS\SponsorProvider\Http\Transformers\EvaluationQuestionOption as Transformer;
use CHMS\SponsorProvider\Models\EvaluationQuestionOption as Model;

class EvaluationQuestionOptionTest extends TransformerTest
{
    protected function getTransformerClass()
    {
        return Transformer::class;
    }

    protected function getModelClass()
    {
        return Model::class;
    }
}