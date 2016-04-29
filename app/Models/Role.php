<?php
/**
 * Clock Hour Management System - Sponsor Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */
namespace CHMS\SponsorProvider\Models;

use CHMS\Common\Models\Role as BaseRoleModel;


class Role
    extends BaseRoleModel 
{
    /**
     * @inheritdoc
     */
    public function getUserClass()
    {
        return User::class;
    }
}
