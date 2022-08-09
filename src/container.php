<?php

namespace src;

use Slim\Factory\AppFactory;
use Psr\Container\ContainerInterface;
use Slim\Views\PhpRenderer;

return [
    App::class => function (ContainerInterface $container) {
        AppFactory::setContainer($container);

        return AppFactory::create();
    },

    PhpRenderer::class => function (ContainerInterface $container) {
        return new PhpRenderer(__DIR__ . '/../templates');
    },
];