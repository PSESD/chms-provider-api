<?php
namespace CHMSTests\ProviderHub\Http\Input\Validators;

use CHMS\ProviderHub\Http\Input\Validators\EvaluationQuestion as Validator;

abstract class EvaluationQuestionTest extends ValidatorTest
{
    protected function getValidatorClass()
    {
        return Validator::class;
    }
}