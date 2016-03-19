<?php
/**
 * Clock Hour Management System - Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */
namespace CHMS\Provider;

use CHMS\Common\Application as BaseApplication;

class Application extends BaseApplication
{
    /**
     * Get the version number of the application.
     *
     * @return string
     */
    public function applicationVersion()
    {
        return 'Clock Hour Management System - Provider v1';
    }
}
