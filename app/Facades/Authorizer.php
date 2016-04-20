<?php
/**
 * Clock Hour Management System - Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */
namespace CHMS\Provider\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * This is the authorizer facade class.
 *
 * @author Luca Degasperi <packages@lucadegasperi.com>
 */
class Authorizer extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'authorizer';
    }
}
