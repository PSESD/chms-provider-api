<?php
namespace CHMSTests\SponsorProvider\Http\Transformers;

use CHMS\SponsorProvider\Http\Transformers\Role as Transformer;
use CHMS\SponsorProvider\Models\Role as Model;

class RoleTest extends TransformerTest
{
    protected function getTransformerClass()
    {
        return Transformer::class;
    }

    protected function getModelClass()
    {
        return Model::class;
    }
}