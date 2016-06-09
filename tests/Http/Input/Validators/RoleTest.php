<?php
namespace CHMSTests\ProviderHub\Http\Input\Validators;

use CHMS\ProviderHub\Http\Input\Validators\Role as Validator;

abstract class RoleTest extends ValidatorTest
{
    protected function getValidatorClass()
    {
        return Validator::class;
    }
}