<?php
/**
 * Clock Hour Management System - Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */
namespace CHMS\Provider\Models;

class ClassRecord extends BaseModel
{
    /**
     * @inheritdoc
     */
    protected $fillable = [
        'evaluation_id',
        'title',
        'instructional_hours', 
        'expected_participants',
        'has_college_credit',
        'college_credit_sponsor',
        'list_publicly',
        'online_class',
        'online_start_date',
        'online_end_date',
        'registration_url',
        'objectives',
        'comments',
        'submitted_at',
        'verified_at',
        'committee_approved_at',
        'committee_emailed_at',
        'approved_at'
    ];

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['evaluation_id', 'title'], ['required'], 'on' => 'create'],
            [['evaluation_id', 'title'], ['filled']],
            [['evaluation_id'], ['exists:evaluations,id']],
            [['title'], ['string', 'max:255']],
            [['instructional_hours', 'expected_participants'], ['numeric']],
            [['has_college_credit', 'list_publicly', 'online_class'], ['boolean']],
            [['college_credit_sponsor'], ['string', 'max:255']],
            [['registration_url'], ['url', 'max:255']],
            [['online_start_date', 'online_end_date', 'submitted_at', 'verified_at', 'committee_emailed_at', 'committee_approved_at', 'approved_at'], ['date']]
        ];
    }
}
