<?php
/**
 * Clock Hour Management System - Sponsor Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */
namespace CHMS\SponsorProvider\Models;

class Topic extends BaseModel
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
            [['name'], ['required'], 'on' => 'create'],
            [['name'], ['filled', 'string', 'max:255']]
        ];
    }
}
