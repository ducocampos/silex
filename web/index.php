<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app = new Silex\Application();
$app['debug'] = true;

require_once __DIR__ . '/../configs/providers.php';
require_once __DIR__ . '/../configs/doctrine.php';

//Rota principal. Redireciona para a rota /posts.
$app->get('/', function () use ($app) {
    return $app->redirect('/posts');
});

//Rota de listagem de posts.
$app->get('/posts/', function() use($app, $em) {
	
	$posts = $em->getRepository('Acme\Curso\Entidades\Post')->findAll();

		foreach ($posts as $value) {

			$posts1[$value->getId()] = array(
				'titulo'=>$value->getTitulo(),
			);

		}
		
	return $app['twig']->render('posts.twig', array('posts'=>$posts1));
})
	->bind('index');

//Rota de consulta de um determinado post.
$app->get('/post/consultar/{id}', function($id) use($app, $em) {

	$posts = $em->getRepository('Acme\Curso\Entidades\Post')->find($id);

	$posts1[$posts->getId()] = array(
		'titulo'=>$posts->getTitulo(), 
		'conteudo'=>$posts->getConteudo(),
	);
	
	return $app['twig']->render('posts1.twig', array('posts1'=>$posts1));
})
	->bind('links');

//Rota para a página de cadastro de um novo post.
$app->get('/post/novo', function() use($app, $em) {
	
	return $app['twig']->render('cadastrar_post.twig');
})
	->bind('cadastrar');

//Rota que persiste os dados do formulário no banco de dados.
$app->post('/post/new', function(Silex\Application $app, Request $request) use($em) {
	$dados = $request->request->all();

	$post = new Acme\Curso\Entidades\Post;
	$post->setTitulo($dados['titulo']);
	$post->setConteudo($dados['conteudo']);

	$em->persist($post);
	$em->flush();

	if($post->getId()) {
		return $app['twig']->render('retorno.twig', array('retorno'=> array('sucess' => 'O post foi inserido com sucesso.', )));
	} else {
		return $app['twig']->render('retorno.twig', array('retorno'=> array('danger' => 'ERRO. O post não foi inserido.', )));
	}

})
	->bind('cadastra_post');

$app->get('/post/editar/{id}', function($id, Silex\Application $app) use($em) {

	$posts = $em->getRepository('Acme\Curso\Entidades\Post')->find($id);

	$posts1[$posts->getId()] = array(
		'titulo'=>$posts->getTitulo(), 
		'conteudo'=>$posts->getConteudo(),
	);
	
	return $app['twig']->render('editar_post.twig', array('posts1'=>$posts1));
})
	->bind('editar');

$app->post('/post/update/{id}', function($id, Silex\Application $app, Request $request) use($em) {
	$dados = $request->request->all();

	$post = new Acme\Curso\Entidades\Post;
	$post->setId($id);
	$post->setTitulo($dados['titulo']);
	$post->setConteudo($dados['conteudo']);

	$em->merge($post);
	$em->flush();

	if($post->getId()) {
		return $app['twig']->render('retorno.twig', array('retorno'=> array('sucess' => 'Registro atualizado com sucesso!', )));
	} else {
		return $app['twig']->render('retorno.twig', array('retorno'=> array('danger' => 'ERRO. Registro não atualizado.', )));
	}
})
	->bind('edita_post');

$app->get('/post/excluir/{id}', function($id, Silex\Application $app) use($em) {

	$post = $em->getRepository('Acme\Curso\Entidades\Post')->find($id);

	$em->remove($post);
	$em->flush();

	$post = $em->getRepository('Acme\Curso\Entidades\Post')->find($id);

	if(!$post) {
		return $app['twig']->render('retorno.twig', array('retorno'=> array('sucess' => 'Post excluído com sucesso.', )));
	} else {
		return $app['twig']->render('retorno.twig', array('retorno'=> array('danger' => 'ERRO. Post não excluído.', )));
	}
	
	
})
	->bind('excluir');

$app->get('/post/retorno', function($id, Silex\Application $app) {

	
})
	->bind('retorno');

$app->run();