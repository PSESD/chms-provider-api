<?php
namespace CHMSTests\Provider\Http\Transformers;

use CHMS\Provider\Http\Transformers\ClassMeeting as Transformer;
use CHMS\Provider\Models\ClassMeeting as Model;

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