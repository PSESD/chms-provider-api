<?php
namespace CHMSTests\ProviderHub\Http\Input\Validators;

use CHMS\ProviderHub\Http\Input\Validators\Evaluation as Validator;

abstract class EvaluationTest extends ValidatorTest
{
    protected function getValidatorClass()
    {
        return Validator::class;
    }
}