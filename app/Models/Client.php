<?php
/**
 * Clock Hour Management System - Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */
namespace CHMS\Provider\Models;

use CHMS\Provider\Models\Concerns\EnsureTrait;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Client extends BaseModel implements
    AuthenticatableContract
{
    use EnsureTrait;
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
}
