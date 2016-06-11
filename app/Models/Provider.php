<?php
/**
 * Clock Hour Management System - Provider Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */
namespace CHMS\ProviderHub\Models;

class Provider extends BaseModel
{
    /**
     * @inheritdoc
     */
    protected $fillable = [
        'name',
        'api_secret',
        'slug',
        'class_number_prefix'
    ];

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [];
    }
}
