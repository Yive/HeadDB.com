<?php

use \Phalcon\Mvc\Router;

$router = new Router();

$router->add('/view/:action', [
    'controller' => 'view',
    'action' => 1
]);

$router->add('/details/{uuid}', [
    'controller' => 'details',
    'action' => 'index'
]);
$router->add('/api', [
    'controller' => 'api',
    'action' => 'index'
]);

$router->add('/api/category/{category}', [
    'controller' => 'api',
    'action' => 'category'
]);

$router->add('/api/head/{uuid}', [
    'controller' => 'api',
    'action' => 'head'
]);

$router->setUriSource(Router::URI_SOURCE_SERVER_REQUEST_URI);
return $router;
