<?php
/**
 * Clock Hour Management System - Provider Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */
namespace CHMS\ProviderHub\Models;

class EvaluationQuestion extends BaseModel
{

    protected $casts = [
        'multiple' => 'boolean',
    ];
    /**
     * @inheritdoc
     */
    protected $fillable = [
        'evaluation_id',
        'question',
        'type',
        'multiple',
        'order',
        'options'
    ];

    public function getVirtualFields()
    {
        return ['options'];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['question', 'type', 'order'], ['required'], 'on' => 'create'],
            [['question', 'type', 'order'], ['filled']],
            // [['evaluation_id'], ['exists:evaluations,id']],
            [['question'], ['string', 'max:255']],
            [['type'], ['string', 'max:15']],
            [['order'], ['numeric']],
            [['multiple'], ['boolean']]
        ];
    }

    public function setOptions($value)
    {
        return true;
    }

    public function getOptions()
    {
        return [];
    }
}
