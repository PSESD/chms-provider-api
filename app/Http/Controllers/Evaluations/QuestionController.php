<?php
/**
 * Clock Hour Management System - Provider Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */
namespace CHMS\ProviderHub\Http\Controllers\Evaluations;

use CHMS\Common\Http\Controllers\Base\ObjectController as BaseController;
use Illuminate\Http\Request;
use CHMS\Common\Http\Controllers\Base\IndexActions\GetIndexTrait;
use CHMS\Common\Http\Controllers\Base\IndexActions\PostIndexTrait;


use CHMS\Common\Http\Controllers\Base\ObjectActions\GetObjectTrait;
use CHMS\Common\Http\Controllers\Base\ObjectActions\HeadObjectTrait;
use CHMS\Common\Http\Controllers\Base\ObjectActions\PatchObjectTrait;
use CHMS\Common\Http\Controllers\Base\ObjectActions\DeleteObjectTrait;

/**
 * Evaluations controller
 */
class QuestionController extends BaseController
{
    use QuestionObjectTrait;

    use GetIndexTrait,
        PostIndexTrait,
        GetObjectTrait,
        HeadObjectTrait,
        PatchObjectTrait,
        DeleteObjectTrait {
        GetIndexTrait::get insteadof GetObjectTrait;
        GetObjectTrait::get as getObject;
        HeadObjectTrait::head as headObject;
        PatchObjectTrait::patch as patchObject;
        DeleteObjectTrait::delete as deleteObject;
    }
}
