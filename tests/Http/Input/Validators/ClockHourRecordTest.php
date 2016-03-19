<?php
namespace CHMSTests\Provider\Http\Input\Validators;

use CHMS\Provider\Http\Input\Validators\ClockHourRecord as Validator;

abstract class ClockHourRecordTest extends ValidatorTest
{
    protected function getValidatorClass()
    {
        return Validator::class;
    }
}