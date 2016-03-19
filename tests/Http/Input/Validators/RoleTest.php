<?php
namespace CHMSTests\Provider\Http\Input\Validators;

use CHMS\Provider\Http\Input\Validators\Role as Validator;

abstract class RoleTest extends ValidatorTest
{
    protected function getValidatorClass()
    {
        return Validator::class;
    }
}