<?php
namespace CHMSTests\ProviderHub\Http\Transformers;

use CHMS\ProviderHub\Http\Transformers\EvaluationQuestion as Transformer;
use CHMS\ProviderHub\Models\EvaluationQuestion as Model;

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