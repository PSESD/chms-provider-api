<?php
namespace CHMSTests\SponsorProvider\Http\Input\Validators;

use CHMS\SponsorProvider\Http\Input\Validators\ClassRecord as Validator;

abstract class ClassRecordTest extends ValidatorTest
{
    protected function getValidatorClass()
    {
        return Validator::class;
    }
}