<?php
namespace CHMSTests\ProviderHub\Config;

use Laravel\Lumen\Testing\DatabaseTransactions;
use CHMSTests\ProviderHub\TestCase;

class AclConfigTest extends TestCase
{

    public function testAllRoutesHaveRules()
    {
        $this->app->configure('acl');
        $aclConfig = config('acl');
        $unruledRoutes = [];
        $ruledRoutes = [];
        $routes = $this->app->getRoutes();
        $this->assertTrue(!empty($aclConfig['routeRules']));
        $routeRules = $aclConfig['routeRules'];
        foreach ($routes as $route ){
            if (empty($route['action']['as'])) {
                continue;
            }
            $routeName = $route['action']['as'];
            if (!isset($routeRules[$routeName])) {
                $unruledRoutes[] = $routeName;
                continue;
            }
            $ruledRoutes[] = $routeName;
        }
        $this->assertTrue(count($unruledRoutes) === 0, 'No unruled routes ('.print_r($unruledRoutes, true).')');
        $this->assertTrue(count($ruledRoutes) > 0, 'Multiple ruled routes');
    }

    public function testAllRouteRulesValid()
    {
        $this->app->configure('acl');
        $aclConfig = config('acl');
        $this->assertTrue(!empty($aclConfig['routeRules']));
        $routeRules = $aclConfig['routeRules'];
        $ruleSets = $aclConfig['ruleSets'];
        $invalidRef = [];
        foreach ($routeRules as $route => $routeRuleSets) {
            foreach ($routeRuleSets as $ruleSet) {
                if (!isset($ruleSets[$ruleSet])) {
                    $invalidRef[] = $route .':'. $ruleSet;
                }
            }
        }
        $this->assertEmpty($invalidRef, 'Invalid route rule set references');
    }
}
