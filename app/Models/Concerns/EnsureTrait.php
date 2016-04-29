<?php
/**
 * Clock Hour Management System - Sponsor Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */
namespace CHMS\SponsorProvider\Models\Concerns;
use CHMS\SponsorProvider\Repositories\Role\Contract as RoleContract;
use CHMS\SponsorProvider\Models\RoleUser;

trait EnsureTrait
{
    public static function ensure($id)
    {
        $check = (int)static::where(['id' => $id])->count();
        if ($check === 0) {
            $newObject = new static;
            $newObject->id = $id;
            return $newObject->save();
        }
        return true;
    }

    public static function ensureRole($userId, $roleSystemId, $providerId = null)
    {
        $roleProvider = app(RoleContract::class);
        $role = $roleProvider->find([['system_id',  $roleSystemId]]);
        if (!$role) { return false; }
        $where = [];
        $where[] = ['user_id', $userId];
        $where[] = ['role_id', $role->id];
        if (!is_null($providerId)) {
            $where[] = ['sponsor_id', $providerId];
        }
        $roleUser = RoleUser::where($where)->first();
        if (empty($roleUser)) {
            $roleUser = new RoleUser;
            $roleUser->user_id = $userId;
            $roleUser->role_id = $role->id;
            $roleUser->sponsor_id = $providerId;
            return $roleUser->save();
        }
        return true;
    }
}
