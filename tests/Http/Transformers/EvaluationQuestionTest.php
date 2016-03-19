<?php
namespace CHMSTests\Provider\Http\Transformers;

use CHMS\Provider\Http\Transformers\EvaluationQuestion as Transformer;
use CHMS\Provider\Models\EvaluationQuestion as Model;

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