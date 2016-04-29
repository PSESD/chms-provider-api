<?php
namespace CHMSTests\SponsorProvider\Http\Controllers\Roles;

use CHMSTests\Common\Http\Controllers\Base\ObjectControllerTest as BaseObjectControllerTest;
use CHMSTests\Common\Http\Controllers\Base\ObjectActions\GetObjectTrait;
use CHMSTests\Common\Http\Controllers\Base\ObjectActions\HeadObjectTrait;

class ObjectControllerTest extends BaseObjectControllerTest
{
    use ObjectTrait;
    use GetObjectTrait;
    use HeadObjectTrait;
}