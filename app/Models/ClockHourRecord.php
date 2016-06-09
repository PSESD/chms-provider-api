<?php
/**
 * Clock Hour Management System - Provider Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */
namespace CHMS\ProviderHub\Models;

class ClockHourRecord extends BaseModel
{
    /**
     * @inheritdoc
     */
    protected $fillable = [
        'user_id',
        'class_record_id',
        'hours_attended',
        'evaluation_sent_at',
        'hub_recorded_at'
    ];

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'class_record_id'], ['required'], 'on' => 'create'],
            [['class_record_id'], ['exists:class_records,id', 'filled']],
            [['user_id'], ['exists:users,id', 'filled']],
            [['hours_attended'], ['numeric']],
            [['evaluation_sent_at', 'hub_recorded_at'], ['date']]
        ];
    }
}
