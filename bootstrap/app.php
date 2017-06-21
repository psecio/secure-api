<?php
session_start();
require_once '../vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(BASE_PATH);
$dotenv->load();

$config = [
    'settings' => ['displayErrorDetails' => true]
];
$app = new \Slim\App($config);

$container = $app->getContainer();

// Make the custom App autoloader
spl_autoload_register(function($class) {
    $classFile = APP_PATH.'/../'.str_replace('\\', '/', $class).'.php';
    if (!is_file($classFile)) {
        throw new \Exception('Cannot load class: '.$class);
    }
    require_once $classFile;
});

// Autoload in our controllers into the container
foreach (new DirectoryIterator(APP_PATH.'/Controller') as $fileInfo) {
    if($fileInfo->isDot()) continue;
    $class = 'App\\Controller\\'.str_replace('.php', '', $fileInfo->getFilename());
    $container[$class] = function($c) use ($class){
        return new $class();
    };
}

$container['notFoundHandler'] = function($container) {
    return function ($request, $response) use ($container) {
        return $container['response']
            ->withStatus(404)
            ->withHeader('Content-Type', 'application/json')
            ->write(json_encode(['error' => 'Resource not valid']));
    };
};

$container['errorHandler'] = function($container) {
    return function ($request, $response, $exception = null) use ($container) {
        $code = 500;
        $message = 'There was an error';

        if ($exception !== null) {
            $code = $exception->getCode();
            $message = $exception->getMessage();
        }

        // If it's not a valid HTTP status code, replace it with a 500
        if (!is_integer($code) || $code < 100 || $code > 599) {
            $code = 500;
        }

        // Use this for debugging purposes
        error_log($exception->getCode().' ==> '.$exception->getMessage().' in '.$exception->getFile().' - ('
            .$exception->getLine().', '.get_class($exception).')');

        return $container['response']
            ->withStatus($code)
            ->withHeader('Content-Type', 'application/json')
            ->write(json_encode([
                'success' => false,
                'error' => $message
            ]));
    };
};

$container['notAllowedHandler'] = function($container) {
    return function ($request, $response) use ($container) {
        return $container['response']
            ->withStatus(401)
            ->withHeader('Content-Type', 'application/json')
            ->write(json_encode(['error' => 'Method not allowed']));
    };
};
