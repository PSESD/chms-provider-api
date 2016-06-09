<?php
namespace CHMSTests\ProviderHub\Http\Transformers;

use CHMS\ProviderHub\Http\Transformers\ClassMeeting as Transformer;
use CHMS\ProviderHub\Models\ClassMeeting as Model;

class ClassMeetingTest extends TransformerTest
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