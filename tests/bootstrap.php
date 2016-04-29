<?php
error_reporting(-1);
require_once __DIR__.'/../vendor/autoload.php';
putenv('APP_ENV=testing');
if (getenv('TEST_MYSQL') === 'true') {
    putenv('DB_CONNECTION=mysql');
    putenv('DB_DATABASE=chmsSponsorTest');
    $connection = new PDO('mysql:host=' . env('DB_HOST'), env('DB_USERNAME'), env('DB_PASSWORD'));
    $connection->query("DROP DATABASE IF EXISTS ".env('DB_DATABASE'));
    $connection->query("CREATE DATABASE IF NOT EXISTS ". env('DB_DATABASE'));
    unset($connection);
} else {
    putenv('DB_CONNECTION=testing');
    $path = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'database'. DIRECTORY_SEPARATOR . 'testing.sqlite';

    if (is_dir(dirname($path))) {
        if (file_exists($path)) {
            unlink($path);
        }
        touch($path);
    }
}