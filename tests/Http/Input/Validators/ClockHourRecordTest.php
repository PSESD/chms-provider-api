<?php
namespace CHMSTests\SponsorProvider\Http\Input\Validators;

use CHMS\SponsorProvider\Http\Input\Validators\ClockHourRecord as Validator;

abstract class ClockHourRecordTest extends ValidatorTest
{
    protected function getValidatorClass()
    {
        return Validator::class;
    }
}