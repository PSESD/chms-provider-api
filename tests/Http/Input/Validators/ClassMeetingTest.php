<?php
namespace CHMSTests\ProviderHub\Http\Input\Validators;

use CHMS\ProviderHub\Http\Input\Validators\ClassMeeting as Validator;

abstract class ClassMeetingTest extends ValidatorTest
{
    protected function getValidatorClass()
    {
        return Validator::class;
    }
}