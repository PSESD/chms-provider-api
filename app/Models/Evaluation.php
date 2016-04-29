<?php
/**
 * Clock Hour Management System - Sponsor Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */
namespace CHMS\SponsorProvider\Models;

class Evaluation extends BaseModel
{
    /**
     * @inheritdoc
     */
    protected $fillable = [
        'sponsor_id',
        'name'
    ];

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], ['required']],
            [['name'], ['filled']],
            [['name'], ['string', 'max:255']]
        ];
    }
}
