<?php
namespace CHMSTests\Provider\Http\Transformers;

use CHMS\Provider\Http\Transformers\ClassRecord as Transformer;
use CHMS\Provider\Models\ClassRecord as Model;

class ClassRecordTest extends TransformerTest
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