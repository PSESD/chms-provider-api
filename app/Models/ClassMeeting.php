<?php
/**
 * Clock Hour Management System - Sponsor Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */
namespace CHMS\SponsorProvider\Models;

class ClassMeeting extends BaseModel
{
    /**
     * @inheritdoc
     */
    protected $fillable = [
        'class_record_id',
        'location_id',
        'meeting_date',
        'start_time',
        'end_time'
    ];

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['class_record_id', 'meeting_date', 'start_time', 'end_time'], ['required'], 'on' => 'create'],
            [['class_record_id', 'meeting_date', 'start_time', 'end_time'], ['filled']],
            [['meeting_date'], ['date']],
            [['start_time', 'end_time'], ['time']],
            [['class_record_id'], ['exists:class_records,id']],

        ];
    }
}
