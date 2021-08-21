<?php
use Slim\Http\Request;
use Slim\Http\Response;

$app->options('/{routes:.+}', function($request, $response, $args){
    return $response;
});

// Routes
require __DIR__ . '/routes/autenticacao.php';
require __DIR__ . '/routes/produtos.php';

$app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function($req, $res){
    $handler = $this->notFoundHandler;
    return $handler($req, $res);
});

// $app->get('/[{name}]', function ($request, $response, $args) {
//     // Sample log message
//     $this->logger->info("Slim-Skeleton '/' route");

//     // Render index view
//     return $this->renderer->render($response, 'index.phtml', $args);
// });
?>
