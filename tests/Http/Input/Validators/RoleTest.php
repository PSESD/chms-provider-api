<?php
namespace CHMSTests\SponsorProvider\Http\Input\Validators;

use CHMS\SponsorProvider\Http\Input\Validators\Role as Validator;

abstract class RoleTest extends ValidatorTest
{
    protected function getValidatorClass()
    {
        return Validator::class;
    }
}