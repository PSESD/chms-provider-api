<?php
namespace CHMSTests\Provider\Http\Input\Filters;

use CHMSTests\Provider\TestCase;
use Laravel\Lumen\Testing\DatabaseMigrations;
use CHMS\Common\Contracts\Acl as AclContract;
use CHMS\Provider\Models\User as UserModel;
use CHMSTests\Provider\Stubs\GenericModel;

class BaseFilterTest extends TestCase
{
    use DatabaseMigrations;

    public function testSimpleFilter()
    {
        $acl = $this->app->make(AclContract::class);
        $acl->switchRoleContext(['hub_administrator']);
        $model = new UserModel();
        $faker = \Faker\Factory::create();

        $input = factory(GenericModel::class, 'User')->make()->toArray();
        $f = $this->getFilterMock();
        $filterResult = $f->filter($model, $input, 'create');
        $this->assertTrue(is_array($filterResult));
        $this->assertArrayHasKey('first_name', $filterResult);
    }

    public function testSimpleFilterFail()
    {
        $acl = $this->app->make(AclContract::class);
        $acl->switchRoleContext(['hub_administrator']);
        $model = new UserModel();
        $faker = \Faker\Factory::create();
        $input = [
            'first_name' => $faker->firstName,
            'last_name' => $faker->lastName,
            'email' => $faker->email,
            'password' => $faker->password,
            'deleted_at' => time()
        ];
        $f = $this->getFilterMock();
        $this->assertArrayNotHasKey('deleted_at', $f->filter($model, $input, 'create', false));
    }

    /**
     * @expectedException CHMS\Common\Exceptions\InvalidInputException
     */
    public function testSimpleFilterFailException()
    {
        $acl = $this->app->make(AclContract::class);
        $acl->switchRoleContext(['hub_administrator']);
        $model = new UserModel();
        $faker = \Faker\Factory::create();
        $input = [
            'first_name' => $faker->firstName,
            'last_name' => $faker->lastName,
            'email' => $faker->email,
            'password' => $faker->password,
            'deleted_at' => time()
        ];
        $f = $this->getFilterMock();
        $this->assertFalse($f->filter($model, $input, 'create'));
    }

    public function getFilterMock()
    {
        $f = new \CHMS\Provider\Http\Input\Filters\User;
        return $f;
    }
}