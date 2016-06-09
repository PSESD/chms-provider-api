<?php
namespace CHMSTests\ProviderHub\Http\Input\Validators;

use CHMS\ProviderHub\Http\Input\Validators\Topic as Validator;

abstract class TopicTest extends ValidatorTest
{
    protected function getValidatorClass()
    {
        return Validator::class;
    }
}