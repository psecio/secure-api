<?php
require_once 'vendor/autoload.php';

$app = new \Slim\App();

$container = $app->getContainer();

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

        // Use this for debugging purposes
        /*error_log($exception->getMessage().' in '.$exception->getFile().' - ('
            .$exception->getLine().', '.get_class($exception).')');*/

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

$app->get('/', function($request, $response) {
    return $response->withHeader('Content-Type', 'application/json')
        ->write(json_encode(['message' => 'It works!']));
});
$app->run();
