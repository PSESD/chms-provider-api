<?php
/**
 * Clock Hour Management System - Sponsor Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */
namespace CHMS\SponsorProvider\Models;

class ClassTopic extends BaseModel
{
    /**
     * @inheritdoc
     */
    protected $fillable = [
        'class_record_id',
        'topic_id'
    ];

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['topic_id', 'class_record_id'], ['required'], 'on' => 'create'],
            [['topic_id'], ['exists:topics,id', 'filled']],
            [['class_record_id'], ['exists:class_records,id', 'filled']]
        ];
    }
}
