<?php
namespace CHMSTests\ProviderHub\Http\Transformers;

use CHMS\ProviderHub\Http\Transformers\Location as Transformer;
use CHMS\ProviderHub\Models\Location as Model;

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