<?php
use Slim\Http\Request;
use Slim\Http\Response;
use app\Models\Produto;

/* Routas para produtos 
ORM -> Object Relational Mapper (Mapeador de Objeto Relacional)
ILLUMINATE -> É o motor da base de dados do Laravel mas pode ser usado sem o Laravel*/

$app->group('/api/v1', function(){
    //Listar produtos
    $this->get('/produtos/listar', function($request, $response){
        $produtos = Produto::get();
        return $response->withJson($produtos);
    });

    //Inserir produtos
    $this->post('/produtos/add', function($request, $response){
        $dados = $request->getParsedBody();
        $produto = Produto::create($dados);
        return $response->withJson($produto);
    });

    //Listar produto para um determinado id
    $this->get('/produtos/listar/{id}', function($request, $response, $args){
        $produto = Produto::findOrFail($args['id']);
        return $response->withJson($produto);
    });

    //Atualizar produto para um determinado id
    $this->put('/produtos/atualizar/{id}', function($request, $response, $args){
        $dados = $request->getParsedBody();
        $produto = Produto::findOrFail($args['id']);
        $produto->update($dados);
        return $response->withJson($produto);
    });

    //Remover produto para um determinado id
    $this->delete('/produtos/remover/{id}', function($request, $response, $args){
        $produto = Produto::findOrFail($args['id']);
        $produto->delete();
        return $response->withJson($produto);
    });
});


?>