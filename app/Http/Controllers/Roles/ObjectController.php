<?php
/**
 * Clock Hour Management System - Sponsor Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */
namespace CHMS\SponsorProvider\Http\Controllers\Roles;

use CHMS\Common\Http\Controllers\Base\ObjectController as BaseController;
use Illuminate\Http\Request;
use CHMS\Common\Http\Controllers\Base\ObjectActions\GetObjectTrait;
use CHMS\Common\Http\Controllers\Base\ObjectActions\HeadObjectTrait;
use CHMS\Common\Http\Controllers\Base\ObjectActions\PatchObjectTrait;
use CHMS\Common\Http\Controllers\Base\ObjectActions\DeleteObjectTrait;

/**
 * Roles object controller
 */
class ObjectController extends BaseController
{
    use ObjectTrait;
    use GetObjectTrait;
    use HeadObjectTrait;
}
