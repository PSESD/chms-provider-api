<?php
/**
 * Clock Hour Management System - Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */
namespace CHMS\Provider\Auth;


use CHMS\Provider\Models\Role as RoleModel;
use CHMS\Provider\Models\User as UserModel;
use CHMS\Provider\Models\Client as ClientModel;
use Illuminate\Database\Eloquent\Model;
use CHMS\Common\Auth\Acl as BaseAcl;
use CHMS\Common\Auth\Contexts\Guest as GuestContext;
use CHMS\Provider\Auth\Contexts\User as UserContext;

class Acl extends BaseAcl
{

    protected function getRoleModel()
    {
        return RoleModel::class;
    }
    /**
     * @inheritdocs
     */
    protected function getContextFromAuth(Model $modelObject = null)
    {
        $authSubject = $this->getGuard()->user();
        if ($authSubject instanceof UserModel) {
            return new UserContext($authSubject, $modelObject);
        }
        if ($authSubject instanceof ClientModel) {
            return new ClientContext($authSubject, $modelObject);
        }
        return parent::getContextFromAuth($modelObject);
    }
}
