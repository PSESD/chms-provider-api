<?php
namespace CHMSTests\SponsorProvider\Http\Input\Validators;

use CHMS\SponsorProvider\Http\Input\Validators\Location as Validator;

abstract class LocationTest extends ValidatorTest
{
    protected function getValidatorClass()
    {
        return Validator::class;
    }
}