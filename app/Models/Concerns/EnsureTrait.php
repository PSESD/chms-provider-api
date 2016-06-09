<?php
/**
 * Clock Hour Management System - Provider Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */
namespace CHMS\ProviderHub\Models\Concerns;
use CHMS\ProviderHub\Repositories\Role\Contract as RoleContract;
use CHMS\ProviderHub\Models\RoleUser;

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
            $where[] = ['provider_id', $providerId];
        }
        $roleUser = RoleUser::where($where)->first();
        if (empty($roleUser)) {
            $roleUser = new RoleUser;
            $roleUser->user_id = $userId;
            $roleUser->role_id = $role->id;
            $roleUser->provider_id = $providerId;
            return $roleUser->save();
        }
        return true;
    }
}
