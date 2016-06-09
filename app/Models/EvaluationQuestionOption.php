<?php
/**
 * Clock Hour Management System - Provider Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */
namespace CHMS\ProviderHub\Models;

class EvaluationQuestionOption extends BaseModel
{
    /**
     * @inheritdoc
     */
    protected $fillable = [
        'evaluation_question_id',
        'option_value',
        'order'
    ];

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['evaluation_question_id', 'option_value', 'order'], ['required'], 'on' => 'create'],
            [['evaluation_question_id', 'option_value', 'order'], ['filled']],
            [['evaluation_question_id'], ['exists:evaluation_questions,id']],
            [['option_value'], ['string', 'max:255']],
            [['order'], ['numeric']]
        ];
    }
}
