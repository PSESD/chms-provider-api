<?php
namespace CHMSTests\Provider\Http\Input\Validators;

use CHMS\Provider\Http\Input\Validators\ClassMeeting as Validator;

abstract class ClassMeetingTest extends ValidatorTest
{
    protected function getValidatorClass()
    {
        return Validator::class;
    }
}