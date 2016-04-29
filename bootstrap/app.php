<?php
require_once __DIR__.'/../vendor/autoload.php';

if (env('APP_ENV') === 'development') {
    $whoops = new \Whoops\Run;
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $whoops->register();
}

try {
    (new Dotenv\Dotenv(__DIR__.'/../'))->load();
} catch (Dotenv\Exception\InvalidPathException $e) {
    //
}

// Create the application
$app = new CHMS\SponsorProvider\Application(
    realpath(__DIR__.'/../')
);
//
// \Rollbar::init($app['config']['services']['rollbar']);
// $app->configureMonologUsing(function($monolog) {
//     $monolog->pushHandler(new \Monolog\Handler\RollbarHandler(\Rollbar::$instance));
//     return $monolog;
// });


$app->register(CHMS\SponsorProvider\Providers\AppServiceProvider::class);
if (PHP_SAPI === 'cli') {
    $app->register(CHMS\SponsorProvider\Providers\ConsoleServiceProvider::class);
}
return $app;
