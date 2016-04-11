<?php
/**
 * Clock Hour Management System - Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */
namespace CHMS\Provider\Models;

class Provider extends BaseModel
{
    /**
     * @inheritdoc
     */
    protected $fillable = [
        'name',
        'provider_secret'
    ];

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [];
    }
}
