<?php
namespace CHMSTests\SponsorProvider\Models;

use CHMS\SponsorProvider\Models\Topic as Model;
use CHMSTests\SponsorProvider\TestCase;

class TopicTest extends BaseModelTest
{
    static public function getModelClass()
    {
        return Model::class;
    }
}