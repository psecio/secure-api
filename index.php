<?php
require_once 'vendor/autoload.php';

$app = new \Slim\App();
$app->get('/', function() {
    echo 'It works!';
});
$app->run();
