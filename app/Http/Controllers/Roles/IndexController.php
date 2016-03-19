<?php
/**
 * Clock Hour Management System - Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */
namespace CHMS\Provider\Http\Controllers\Roles;

use CHMS\Common\Http\Controllers\Base\IndexController as BaseController;
use Illuminate\Http\Request;

use CHMS\Common\Http\Controllers\Base\IndexActions\GetIndexTrait;

/**
 * Roles controller
 */
class IndexController extends BaseController
{
    use ObjectTrait;
    use GetIndexTrait;
}
