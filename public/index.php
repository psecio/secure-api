<?php
define('BASE_PATH', __DIR__.'/..');
define('APP_PATH', BASE_PATH.'/App');

require_once BASE_PATH.'/vendor/autoload.php';

// Autorequire everything in BASE_PATH/bootstrap, loading app first - most important
require_once BASE_PATH.'/bootstrap/app.php';
foreach (new DirectoryIterator(BASE_PATH.'/bootstrap') as $fileInfo) {
    if($fileInfo->isDot()) continue;
    require_once $fileInfo->getPathname();
}

$app->run();
