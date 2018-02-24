<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();

$app['debug'] = true;

$data = '24/02/2018';

$app->get('/hello', function() use($data)
{
	return 'Olá mundo! <br>Hoje é: ' . $data;
});

$app->run();