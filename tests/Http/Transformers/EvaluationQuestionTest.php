<?php
namespace CHMSTests\SponsorProvider\Http\Transformers;

use CHMS\SponsorProvider\Http\Transformers\EvaluationQuestion as Transformer;
use CHMS\SponsorProvider\Models\EvaluationQuestion as Model;

class EvaluationQuestionTest extends TransformerTest
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