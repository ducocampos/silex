<?php

use \Symfony\Component\HttpFoundation\Response;

$posts = $app['controllers_factory'];

$posts1 = array(
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

$posts->get("/", function() use($posts1) {

	foreach ($posts1 as $key => $value) {
		$teste .= "Post: " . "<a href='/posts/{$key}'>{$key}</a>" . "<br> " . "Conteúdo: " . $value . "<br><br>";
		}	

	return new Response($teste, 200);
});

return $posts;
