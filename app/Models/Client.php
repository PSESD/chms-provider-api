<?php
/**
 * Clock Hour Management System - Provider Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */
namespace CHMS\ProviderHub\Models;

use CHMS\ProviderHub\Models\Concerns\EnsureTrait;
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
        'name',
        'type',
        'secret',
        'base_url'
    ];

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [];
    }
}
