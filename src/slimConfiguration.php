<?php

namespace src;

// Add support to JSON or XML incoming data
$app->addBodyParsingMiddleware();

// Add Routing Middleware
$app->addRoutingMiddleware();
// Add Error Middleware
$errorMiddleware = $app->addErrorMiddleware(true, true, true);
$errorHandler = $errorMiddleware->getDefaultErrorHandler();
$errorHandler->forceContentType('application/json');