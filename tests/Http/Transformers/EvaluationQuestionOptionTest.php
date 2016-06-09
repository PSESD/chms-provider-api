<?php
namespace CHMSTests\ProviderHub\Http\Transformers;

use CHMS\ProviderHub\Http\Transformers\EvaluationQuestionOption as Transformer;
use CHMS\ProviderHub\Models\EvaluationQuestionOption as Model;

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