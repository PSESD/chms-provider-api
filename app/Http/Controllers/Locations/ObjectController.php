<?php
/**
 * Clock Hour Management System - Provider Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */
namespace CHMS\ProviderHub\Http\Controllers\Locations;

use CHMS\Common\Http\Controllers\Base\ObjectController as BaseController;
use Illuminate\Http\Request;

use CHMS\Common\Http\Controllers\Base\ObjectActions\GetObjectTrait;
use CHMS\Common\Http\Controllers\Base\ObjectActions\HeadObjectTrait;
use CHMS\Common\Http\Controllers\Base\ObjectActions\PatchObjectTrait;
use CHMS\Common\Http\Controllers\Base\ObjectActions\DeleteObjectTrait;

/**
 * Locations object controller
 */
class ObjectController extends BaseController
{
    use ObjectTrait;
    use GetObjectTrait;
    use HeadObjectTrait;
    use PatchObjectTrait;
    use DeleteObjectTrait;
}