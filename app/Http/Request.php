<?php
/**
 * Clock Hour Management System - Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */
namespace CHMS\Provider\Http;

use Illuminate\Http\Request as BaseRequest;

class Request extends BaseRequest
{
    protected $context = [];

    public function setContextItem($name, $value)
    {
        if ($value === null) {
            unset($this->context[$name]);
        } else {
            $this->context[$name] = $value;
        }
    }

    public function getContext()
    {
        return $this->context;
    }
}
