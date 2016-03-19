<?php
namespace CHMSTests\Provider\Http\Transformers;

use CHMS\Provider\Http\Transformers\Location as Transformer;
use CHMS\Provider\Models\Location as Model;

class LocationTest extends TransformerTest
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