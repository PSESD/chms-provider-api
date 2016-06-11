<?php
/**
 * Clock Hour Management System - Provider Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */
namespace CHMS\ProviderHub\Auth;


use CHMS\ProviderHub\Models\Role as RoleModel;
use CHMS\ProviderHub\Models\User as UserModel;
use CHMS\ProviderHub\Models\Client as ClientModel;
use Illuminate\Database\Eloquent\Model;
use CHMS\Common\Auth\Acl as BaseAcl;
use CHMS\Common\Auth\Contexts\Guest as GuestContext;
use CHMS\ProviderHub\Auth\Contexts\User as UserContext;
use CHMS\Common\Auth\Contexts\Client as ClientContext;

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
