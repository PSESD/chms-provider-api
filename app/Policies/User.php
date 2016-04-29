<?php
/**
 * Clock Hour Management System - Sponsor Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */
namespace CHMS\SponsorProvider\Policies;

use CHMS\SponsorProvider\Models\User as UserModel;
use CHMS\Common\Policies\BaseObject;

class User extends BaseObject
{
    public function read(UserModel $authSubject, UserModel $user)
    {
        if (!parent::read($authSubject, $user)) {
            return false;
        }
        return true;
    }
}
