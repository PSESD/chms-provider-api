<?php
/**
 * Clock Hour Management System - Provider Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */
namespace CHMS\ProviderHub\Repositories;

use Illuminate\Database\Eloquent\Model;
use CHMS\ProviderHub\Repositories\Criteria\BaseCriteria as Criteria;

abstract class BaseRepository
    extends \CHMS\Common\Repositories\BaseRepository
    implements BaseRepositoryContract
{
}
