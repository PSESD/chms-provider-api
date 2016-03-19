<?php
namespace CHMSTests\Provider\Http\Transformers;

use CHMS\Provider\Http\Transformers\EvaluationQuestionOption as Transformer;
use CHMS\Provider\Models\EvaluationQuestionOption as Model;

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