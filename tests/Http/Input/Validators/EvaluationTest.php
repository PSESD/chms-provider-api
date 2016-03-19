<?php
namespace CHMSTests\Provider\Http\Input\Validators;

use CHMS\Provider\Http\Input\Validators\Evaluation as Validator;

abstract class EvaluationTest extends ValidatorTest
{
    protected function getValidatorClass()
    {
        return Validator::class;
    }
}