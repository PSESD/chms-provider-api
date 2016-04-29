<?php
namespace CHMSTests\SponsorProvider\Http\Controllers\Classes;

use CHMSTests\Common\Http\Controllers\Base\IndexControllerTest as BaseIndexControllerTest;
use CHMSTests\Common\Http\Controllers\Base\IndexActions\GetIndexTrait;
use CHMSTests\Common\Http\Controllers\Base\IndexActions\PostIndexTrait;

class IndexControllerTest extends BaseIndexControllerTest
{
    use ObjectTrait;
    use GetIndexTrait;
    use PostIndexTrait;
}