<?php
/**
 * Clock Hour Management System - Provider Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */
namespace CHMS\ProviderHub\Policies;

use CHMS\ProviderHub\Models\User as UserModel;
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
