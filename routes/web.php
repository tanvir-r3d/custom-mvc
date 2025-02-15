<?php

$router->get('/', [\App\Controllers\HomeController::class, 'index']);
$router->post('/store', [\App\Controllers\HomeController::class, 'store']);
$router->get('/list', [\App\Controllers\HomeController::class, 'list']);