<?php

use \Symfony\Component\HttpFoundation\Response;

$post1 = $app['controllers_factory'];

$post1->get('/',function(){

	return new Response('Acesso negado! Favor acessar o link: <a href="/">Página principal</a>');
	
});

$post1->get('/{id}', function() use($posts1) {

	var_dump($posts1); exit;
	
	if(!isset($posts1[$id]))
		return new Response('Post não encontrado. Favor verificar se o número do mesmo está correto. <br> <a href="/">Voltar</a>',404);
	
	return new Response('Post id: ' . $posts1[$id] . '<br>' . 
						'Conteúdo: ' . $posts1[$cont] . '<br>' . 
						'<a href="/">Voltar</a>', 200);

});

return $posts1;