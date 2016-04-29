<?php
namespace CHMSTests\SponsorProvider\Http\Input\Validators;

use CHMS\SponsorProvider\Http\Input\Validators\Topic as Validator;

abstract class TopicTest extends ValidatorTest
{
    protected function getValidatorClass()
    {
        return Validator::class;
    }
}