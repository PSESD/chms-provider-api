<?php
/**
 * Clock Hour Management System - Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */
namespace CHMS\Provider\Models;

class Topic extends BaseModel
{
    /**
     * @inheritdoc
     */
    protected $fillable = [
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
