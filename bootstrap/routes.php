<?php

$app->get('/', '\App\Controller\IndexController:index');

$app->group('/user', function() use ($app) {
    $app->post('/login', '\App\Controller\UserController:login');
});

$app->post('/test', '\App\Controller\IndexController:test')
    ->add(new \App\Middleware\SessionValidate());
