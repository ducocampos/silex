<?php

use \Symfony\Component\HttpFoundation\Response;

$posts = $app['controllers_factory'];

$posts->get("/", function() use($posts1) {

	foreach ($posts1 as $key => $value) {
		$teste .= "Post: " . "<a href='/posts/{$key}'>{$key}</a>" . "<br> " . "Conteúdo: " . $value . "<br><br>";
		}	

	return $teste;
});

return $posts;
