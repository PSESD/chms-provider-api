<?php
/**
 * Clock Hour Management System - Sponsor Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */
namespace CHMS\SponsorProvider;

use CHMS\Common\Application as BaseApplication;
use CHMS\SponsorProvider\Http\Request;

class Application extends BaseApplication
{
    /**
     * Get the version number of the application.
     *
     * @return string
     */
    public function applicationVersion()
    {
        return 'Clock Hour Management System - Sponsor Provider v1';
    }


}
