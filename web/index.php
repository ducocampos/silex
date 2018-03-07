<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Response;

$app = new Silex\Application();

$app['debug'] = true;

$app['posts'] = array(
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

$posts1 = $app['posts'];

$app->register(new Silex\Provider\TwigServiceProvider(), array(
	'twig.path' => __DIR__ . '/../views',
));

$app->get('/', function() use($app, $posts1) {
	return $app['twig']->render('posts.twig', array('posts'=>$posts1));
})
	->bind('index');

$app->get('/posts/{id}', function($id) use($app, $posts1) {
	return $app['twig']->render('posts1.twig', array('posts'=>array($id=>$posts1[$id])));
})
	->bind('links');

$app->run();