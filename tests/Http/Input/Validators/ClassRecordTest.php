<?php
namespace CHMSTests\Provider\Http\Input\Validators;

use CHMS\Provider\Http\Input\Validators\ClassRecord as Validator;

abstract class ClassRecordTest extends ValidatorTest
{
    protected function getValidatorClass()
    {
        return Validator::class;
    }
}