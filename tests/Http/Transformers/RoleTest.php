<?php
namespace CHMSTests\Provider\Http\Transformers;

use CHMS\Provider\Http\Transformers\Role as Transformer;
use CHMS\Provider\Models\Role as Model;

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