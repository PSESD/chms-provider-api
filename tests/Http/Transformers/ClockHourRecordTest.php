<?php
namespace CHMSTests\SponsorProvider\Http\Transformers;

use CHMS\SponsorProvider\Http\Transformers\ClockHourRecord as Transformer;
use CHMS\SponsorProvider\Models\ClockHourRecord as Model;

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