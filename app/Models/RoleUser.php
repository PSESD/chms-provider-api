<?php
/**
 * Clock Hour Management System - Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */
namespace CHMS\Provider\Models;

class RoleUser extends BaseSimpleModel
{
    public function rules()
    {
        return [
            [['user_id', 'role_id'], ['required'], 'on' => 'create'],
            [['user_id'], ['exists:users,id']],
            [['role_id'], ['exists:roles,id']],
            [['object_id'], ['exists:registry,id']]
        ];
    }
}
