<?php
use Slim\Http\Request;
use Slim\Http\Response;
use app\Models\Produto;
use app\Models\Usuario;
use \Firebase\JWT\JWT;
    
//Rotas para gerar Token
$app->post('/api/token', function($request, $response){
    $dados = $request->getParsedBody();
    $email = $dados['email'] ?? null;
    $senha = $dados['senha'] ?? null;
    $usuario = Usuario::where('email', $email)->first();
    if(!is_null($usuario) && (md5($senha) === $usuario->senha)){
        $secretKey = $this->get('settings')['secretKey'];
        $chaveDeAcesso = JWT::encode($usuario, $secretKey);
        return $response->withJson([
            'chave' => $chaveDeAcesso
        ]);
    }
    return $response->withJson([
        'status' => 'erro'
    ]);
    
});

?>