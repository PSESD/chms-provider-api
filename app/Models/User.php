<?php
/**
 * Clock Hour Management System - Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */
namespace CHMS\Provider\Models;

use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends BaseModel implements
    AuthenticatableContract
{
    use Authorizable;
    use Authenticatable;

    /**
     * @inheritdoc
     */
    protected $fillable = [
    ];

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [];
    }


    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_users');
    }
}
