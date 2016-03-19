<?php
namespace CHMSTests\Provider\Http\Input\Validators;

use CHMS\Provider\Http\Input\Validators\Topic as Validator;

abstract class TopicTest extends ValidatorTest
{
    protected function getValidatorClass()
    {
        return Validator::class;
    }
}