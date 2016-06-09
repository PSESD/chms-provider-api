<?php
namespace CHMSTests\ProviderHub\Http\Transformers;

use CHMS\ProviderHub\Http\Transformers\ClockHourRecord as Transformer;
use CHMS\ProviderHub\Models\ClockHourRecord as Model;

class ClockHourRecordTest extends TransformerTest
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