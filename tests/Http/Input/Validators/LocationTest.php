<?php
namespace CHMSTests\Provider\Http\Input\Validators;

use CHMS\Provider\Http\Input\Validators\Location as Validator;

abstract class LocationTest extends ValidatorTest
{
    protected function getValidatorClass()
    {
        return Validator::class;
    }
}