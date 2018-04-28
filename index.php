<?php

use Symfony\Component\HttpFoundation\Request;

require __DIR__.'/vendor/autoload.php';
require __DIR__.'/app/MicroKernel.php';

$kernel = new MicroKernel('dev', true);

$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();

$kernel->terminate($request, $response);