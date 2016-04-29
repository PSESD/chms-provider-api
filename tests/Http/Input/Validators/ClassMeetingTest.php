<?php
namespace CHMSTests\SponsorProvider\Http\Input\Validators;

use CHMS\SponsorProvider\Http\Input\Validators\ClassMeeting as Validator;

abstract class ClassMeetingTest extends ValidatorTest
{
    protected function getValidatorClass()
    {
        return Validator::class;
    }
}