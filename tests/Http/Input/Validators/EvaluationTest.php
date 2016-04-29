<?php
namespace CHMSTests\SponsorProvider\Http\Input\Validators;

use CHMS\SponsorProvider\Http\Input\Validators\Evaluation as Validator;

abstract class EvaluationTest extends ValidatorTest
{
    protected function getValidatorClass()
    {
        return Validator::class;
    }
}