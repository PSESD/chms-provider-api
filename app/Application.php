<?php
/**
 * Clock Hour Management System - Provider Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */
namespace CHMS\ProviderHub;

use CHMS\Common\Application as BaseApplication;
use CHMS\ProviderHub\Http\Request;

class Application extends BaseApplication
{
    /**
     * Get the version number of the application.
     *
     * @return string
     */
    public function applicationVersion()
    {
        return 'Clock Hour Management System - Provider Provider v1';
    }


}
