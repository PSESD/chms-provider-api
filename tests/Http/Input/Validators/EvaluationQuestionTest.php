<?php
namespace CHMSTests\Provider\Http\Input\Validators;

use CHMS\Provider\Http\Input\Validators\EvaluationQuestion as Validator;

abstract class EvaluationQuestionTest extends ValidatorTest
{
    protected function getValidatorClass()
    {
        return Validator::class;
    }
}