<?php
/**
 * Clock Hour Management System - Sponsor Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */
namespace CHMS\SponsorProvider\Models;

class Location extends BaseModel
{
    /**
     * @inheritdoc
     */
    protected $fillable = [
        'sponsor_id',
        'name',
        'address_1',
        'address_2',
        'city',
        'subnational_division',
        'postal_code',
        'country',
        'phone_number',
        'fax_number'
    ];
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'city', 'subnational_division'], ['required'], 'on' => 'create'],
            [['name', 'city', 'subnational_division'], ['filled']],
            [['address_1', 'address_2', 'name'], ['max:255']],
            [['city', 'country'], ['max:100']],
            [['address_1', 'address_2', 'subnational_division', 'name', 'city', 'country'], ['string']],
            [['phone_number'], ['max:40']],
            [['fax_number'], ['max:40']],
            [['name'], ['string', 'max:255']],
        ];
    }
}
