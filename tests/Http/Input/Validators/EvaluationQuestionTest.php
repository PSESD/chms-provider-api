<?php
namespace CHMSTests\SponsorProvider\Http\Input\Validators;

use CHMS\SponsorProvider\Http\Input\Validators\EvaluationQuestion as Validator;

abstract class EvaluationQuestionTest extends ValidatorTest
{
    protected function getValidatorClass()
    {
        return Validator::class;
    }
}