<?php
/**
 * Clock Hour Management System - Sponsor Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */
namespace CHMS\SponsorProvider\Models;

class EvaluationQuestion extends BaseModel
{
    /**
     * @inheritdoc
     */
    protected $fillable = [
        'evaluation_id',
        'question',
        'type',
        'order'
    ];

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['evaluation_id', 'question', 'type', 'order'], ['required'], 'on' => 'create'],
            [['evaluation_id', 'question', 'type', 'order'], ['filled']],
            [['evaluation_id'], ['exists:evaluations,id']],
            [['question'], ['string', 'max:255']],
            [['type'], ['string', 'max:15']],
            [['order'], ['numeric']]
        ];
    }
}
