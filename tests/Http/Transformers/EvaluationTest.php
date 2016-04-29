<?php
namespace CHMSTests\SponsorProvider\Http\Transformers;

use CHMS\SponsorProvider\Http\Transformers\Evaluation as Transformer;
use CHMS\SponsorProvider\Models\Evaluation as Model;

class EvaluationTest extends TransformerTest
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