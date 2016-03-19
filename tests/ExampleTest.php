<?php
namespace CHMSTests\Provider;

use Laravel\Lumen\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->get('/version');

        $this->assertEquals(
            $this->response->getContent(), json_encode(['version' => $this->app->version()])
        );
    }
}
