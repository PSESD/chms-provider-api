<?php
/**
 * Clock Hour Management System - Provider Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */
namespace CHMS\ProviderHub\Http\Controllers\Evaluations;

use CHMS\ProviderHub\Repositories\EvaluationQuestion\Contract;
use CHMS\ProviderHub\Http\Transformers\EvaluationQuestion as Transformer;
use Illuminate\Http\Request;

trait QuestionObjectTrait
{
    /**
     * @var Contract
     */
    private $repository;

    /**
     * Constructor
     * @param Contract $repository
     */
    public function __construct(Contract $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }

    /**
     * @inheritdoc
     */
    public function getRepository()
    {
        return $this->repository;
    }

    /**
     * @inheritdoc
     */
    public function getTransformer()
    {
        return new Transformer();
    }

    /**
     * @inheritdoc
     */
    public function getResourceKey()
    {
        return 'evaluation_questions';
    }

    protected function prepareContext(Request $request)
    {
        $route = $request->route();
        $context = app('context');

        if (isset($route[2]['evaluationId'])) {
            $context->setObjectField('evaluation_id', $route[2]['evaluationId']);
        }
        return true;
    }

    /**
     * @inheritdoc
     */
    protected function getObjectIdParameter()
    {
        return 'questionId';
    }
}
