<?php
/**
 * Clock Hour Management System - Sponsor Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */
namespace CHMS\SponsorProvider\Models;

class Sponsor extends BaseModel
{
    /**
     * @inheritdoc
     */
    protected $fillable = [
        'name',
        'api_secret',
        'slug'
    ];

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [];
    }
}
