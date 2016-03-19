<?php
/**
 * Clock Hour Management System - Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */
namespace CHMS\Provider\Auth\Contexts;

use DB;
use Illuminate\Database\Query\Builder;
use CHMS\Common\Auth\RoleBucket;
use CHMS\Common\Auth\Contexts\BaseAuthSubject;
use CHMS\Provider\Models\RoleUser as RoleUserModel;
use CHMS\Provider\Models\Role as RoleModel;
use CHMS\Provider\Repositories\Role\Contract as RoleProvider;

class User extends BaseAuthSubject
{
    /**
    * @var RoleBucket
    */
    private $roles;

    /**
     * @inheritdoc
     */
    public function getRoles()
    {
        if (!isset($this->roles)) {
            $this->roles = parent::getRoles();
            $roles = $this->getRoleQuery()->pluck('role_id');
            foreach ($roles as $role) {
                if (($role = app(RoleProvider::class)->getRoleById($role))) {
                    $this->roles->add($role['system_id']);
                }
            }
        }
        return clone $this->roles;
    }

    /**
     * Get user's role query
     * @return Builder
     */
    private function getRoleQuery()
    {
        $query = DB::table('role_users')->select('role_id')->where('user_id', $this->subjectObject->id);
        if (isset($this->modelObject)) {
            $query->andWhere(function ($query) {
                $query->whereNull('object_id')
                      ->orWhere('object_id', $this->modelObject->id);
            });
        }
        $query->groupBy('role_id');
        return $query;
    }
}
