<?php

use \Symfony\Component\HttpFoundation\Response;

$post1 = $app['controllers_factory'];

$post1->get('/{id}', function($id) use($posts1) {
	
	if(!isset($posts1[$id]))
		return new Response('Post não encontrado. Favor verificar se o número do mesmo está correto. <br> <a href="/">Voltar</a>',404);
	
	return new Response('Post id: ' . $id . '<br>' . 
						'Conteúdo: ' . $posts1[$id] . '<br>' . 
						'<a href="/">Voltar</a>', 200);

});

return $post1;