<?php
namespace CHMSTests\ProviderHub\Http\Input\Validators;

use CHMS\ProviderHub\Http\Input\Validators\ClockHourRecord as Validator;

abstract class ClockHourRecordTest extends ValidatorTest
{
    protected function getValidatorClass()
    {
        return Validator::class;
    }
}