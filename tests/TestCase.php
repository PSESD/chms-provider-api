<?php
namespace CHMSTests\SponsorProvider;

class TestCase extends \Laravel\Lumen\Testing\TestCase
{
    use ApplicationTestTrait;
    //use DatabaseTransactions;

    protected $serverHeaders = [];
    protected $testClient;
    
    // private $s;
    // public function setUp()
    // {
    //     $s = microtime(true);
    //     parent::setUp();
    //     echo round(microtime(true) - $s, 2) .'s set up' . PHP_EOL;
    //     $this->s = microtime(true);
    // }

    // public function tearDown()
    // {
    //     echo round(microtime(true) - $this->s, 2) .'s run' . PHP_EOL;
    //     $s = microtime(true);
    //     parent::tearDown();
    //     echo round(microtime(true) - $s, 2) .'s tear down' . PHP_EOL;
    // }

    
}
