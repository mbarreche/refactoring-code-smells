<?php
// Front controller

require __DIR__ . '/../vendor/autoload.php';

use CodelyTv\Debug;
use CodelyTv\Flags;
use CodelyTv\SubscribeController;
use Symfony\Component\HttpFoundation\Request;

$debug = new Debug(true);

$request = Request::createFromGlobals();
$request->headers->set('X-FLAG', Flags::NEW_SUBSCRIPTION_PAGE_TOKEN);
$request->request->set('email', 'email@example.com');
$request->request->set('name', 'Codely');

$controller = new SubscribeController($debug);
$controller->__invoke($request);
