<?php
/**
 * Clock Hour Management System - Sponsor Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */
namespace CHMS\SponsorProvider\Repositories;

use Illuminate\Database\Eloquent\Model;
use CHMS\SponsorProvider\Repositories\Criteria\BaseCriteria as Criteria;

abstract class BaseRepository
    extends \CHMS\Common\Repositories\BaseRepository
    implements BaseRepositoryContract
{
}
