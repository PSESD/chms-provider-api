<?php
namespace CHMSTests\ProviderHub\Http\Input\Validators;

use CHMS\ProviderHub\Http\Input\Validators\ClassRecord as Validator;

abstract class ClassRecordTest extends ValidatorTest
{
    protected function getValidatorClass()
    {
        return Validator::class;
    }
}