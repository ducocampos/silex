<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Response;

$app = new Silex\Application();

$app['debug'] = true;

$posts = array(
	1 => 'Esse é o post número 1.', 
	2 => 'Esse é o post número 2.', 
	3 => 'Esse é o post número 3.', 
	4 => 'Esse é o post número 4.', 
	5 => 'Esse é o post número 5.',
	6 => 'Esse é o post número 6.',
	7 => 'Esse é o post número 7.',
	8 => 'Esse é o post número 8.',
	9 => 'Esse é o post número 9.',
	10 => 'Esse é o post número 10.',
);

$app->get('/posts/{id}', function($id) use($posts) {
	
	if(!isset($posts[$id]))
		return new Response('Post não encontrado. Favor verificar se o número do mesmo está correto.',404);
	
	return new Response('Post id: ' . $id . '<br>' . 'Conteúdo: ' . $posts[$id], 200);

});

$app->run();