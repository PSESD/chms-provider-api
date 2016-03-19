<?php
/**
 * Clock Hour Management System - Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */
namespace CHMS\Provider\Models;

class Evaluation extends BaseModel
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
            [['name'], ['required']],
            [['name'], ['filled']],
            [['name'], ['string', 'max:255']]
        ];
    }
}
