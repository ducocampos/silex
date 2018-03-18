<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Response;

$app = new Silex\Application();
$app['debug'] = true;

require_once __DIR__ . '/../configs/providers.php';
require_once __DIR__ . '/../configs/doctrine.php';

// $app['posts'] = array(
// 	1 => 'Esse é o post número 1.', 
// 	2 => 'Esse é o post número 2.', 
// 	3 => 'Esse é o post número 3.', 
// 	4 => 'Esse é o post número 4.', 
// 	5 => 'Esse é o post número 5.',
// 	6 => 'Esse é o post número 6.',
// 	7 => 'Esse é o post número 7.',
// 	8 => 'Esse é o post número 8.',
// 	9 => 'Esse é o post número 9.',
// 	10 => 'Esse é o post número 10.',
// );

// $posts1 = $app['posts'];



$app->get('/', function() use($app, $em) {
	
	$posts = $em->getRepository('Acme\Curso\Entidades\Post')->findAll();

		foreach ($posts as $value) {

			$posts1[$value->getId()] = $value->getConteudo();

		}
		
	return $app['twig']->render('posts.twig', array('posts'=>$posts1));
})
	->bind('index');

$app->get('/posts/{id}', function($id) use($app, $em) {

	$posts = $em->getRepository('Acme\Curso\Entidades\Post')->find($id);

	$posts1[$posts->getId()] = $posts->getConteudo();
	
	return $app['twig']->render('posts1.twig', array('posts1'=>$posts1));
})
	->bind('links');

$app->run();