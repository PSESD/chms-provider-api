<?php
namespace CHMSTests\ProviderHub\Http\Input\Validators;

use CHMS\ProviderHub\Http\Input\Validators\Location as Validator;

abstract class LocationTest extends ValidatorTest
{
    protected function getValidatorClass()
    {
        return Validator::class;
    }
}