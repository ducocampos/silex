<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Response;

$app = new Silex\Application();

$app['debug'] = true;


$app->mount("/", include 'posts.php');
$app->mount("/posts", include 'posts1.php');

$app->run();