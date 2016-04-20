<?php
/**
 * Clock Hour Management System - Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */
namespace CHMS\Provider;

use CHMS\Common\Application as BaseApplication;
use CHMS\Provider\Http\Request;

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

    /**
     * Register container bindings for the application.
     *
     * @return void
     */
    protected function registerRequestBindings()
    {
        $this->singleton(Request::class, function () {
            return $this->prepareRequest(Request::capture());
        });
    }

    protected function registerContainerAliases()
    {
        parent::registerContainerAliases();
        $this->aliases['request'] = Request::class;
        $this->availableBindings[Request::class] = 'registerRequestBindings';
    }

}
