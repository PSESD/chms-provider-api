<?php
namespace CHMSTests\ProviderHub\Http\Transformers;

use CHMS\ProviderHub\Http\Transformers\Role as Transformer;
use CHMS\ProviderHub\Models\Role as Model;

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