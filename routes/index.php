<?php

use App\Controller\HomeController;

$app->get('/', HomeController::class);
$app->post('/', HomeController::class . ':add');

$app->run();

