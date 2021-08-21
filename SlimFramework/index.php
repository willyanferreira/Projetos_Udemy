<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Illuminate\Database\Capsule\Manager as Capsule;
// use Slim\Factory\AppFactory;

require 'vendor/autoload.php';
// require __DIR__ . '/../vendor/autoload.php';

// $app = AppFactory::create();
$app = new \Slim\App;

// $app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
//     $name = $args['name'];
//     return $response;
// });
// $app->get('/postagens', function () {
//     echo "<div style='width: 400px; height: 400px;background-color: powderblue;'></div>";
// });
// $app->get('/usuarios[/{id}]', function ($request, $response) { //colocar [] indica q o parâmetro não é obrigátorio
//     if($request->getAttribute('id') == 1){
//         echo "Usuário localizado";
//     }else{
//         echo "Usuário não localizado";
//     }
// });
// $app->get('/lista/{itens:.*}', function ($request, $response) { // :.* indica q aceita qualquer dado como valor ex: int string etc.
//     $item = $request->getAttribute('itens');
//     // echo $item;
//     echo '<pre>';
//     var_dump(explode('/', $item));
//     echo '</pre>';
// });
// /*Nomeando rotas e usando em uma outra rota */
// $app->get('/blog/postagens/{id}', function ($request, $response) {
//     echo 'Listando postagem para o ID: '. $request->getAttribute('id');
// })->setName('blog');
// $app->get('/site', function ($request, $response) {
//     $retorno = $this->get('router')->pathFor('blog', ['id' => 10]);
//     echo $retorno;
// });
// /*Agrupar rotas*/
// $app->group('/versao1', function () { // ->group  indica q várias rotas pertecem à uma mesma rota
//     // echo "Versão um da API";
//     $this->get('/verde', function () {
//         echo "<div style='width: 100px; height: 100px;background-color: green;'></div>";
//     });
//     $this->get('/vermelho', function () {
//         echo "<div style='width: 200px; height: 200px;background-color: red;'></div>";
//     });
// });
/*Tipos de requisiçõs(o mesmo que -> Verbos HTTP)
GET -> Recupera recursos/dados do servidor (SELECT)
POST -> Insere(cria) dados no servidor (INSERT)
PUT -> Atualiza dados no servidor (UPDATE)
DELETE -> Deleta dados do servidor(DELETE)*/
//padrão PSR7 define a melhor maneira de configurar um retorno para o usuáio

// $app->get('/postagens', function (Request $request, Response $response) {
//     $response->getBody()->write('Listagem de postagens 1.5');
//     return $response;
// });
// $app->post('/usuarios/adiciona', function (Request $request, Response $response) {
//     $postagem = $request->getParsedBody();
//     echo '<pre>';
//     print_r($postagem);
//     echo '</pre>';
//     echo "\nMeu nome é: " .$postagem['nome']. " tenho " .$postagem['idade']. " anos e atualmente sou " .$postagem['profi'];
// });
// $app->put('/usuarios/atualiza', function (Request $request, Response $response) {
//     $poha = $request->getParsedBody();
//     return $response->getBody()->write("Sucesso ao atualizar os dados para o usuário: ".$poha['nome']);
//     var_dump($poha);
// });
// $app->delete('/usuarios/remove/{id}', function (Request $request, Response $response) {
//     $id = $request->getAttribute('id');
//     return $response->getBody()->write("Sucesso ao deletar usuário de id: ".$id);
// });

/*Serviços e Dependências*/
// class Servico{
//     public $name;
//     public $idade;
//     public $profi;
//     public function saudacao($name){
//         // $this->name = $name;
//         echo 'Deixa de besteira ' . $name. '!';
//     }
// }
// /*Container Pimple*/
// $container = $app->getContainer();
// $container['umservico'] = function(){
//     return new Servico;
// };
// $app->get('/servicos/{nome}', function (Request $request, Response $response) {
//     $firstServico = $this->get('umservico');
//     // $nome = $request->getAttribute('nome');
//     // $this->name = $nome;
//     echo '<pre>';
//     var_dump($firstServico);
//     echo '</pre>';
//     echo $firstServico->saudacao($request->getAttribute('nome'));
// });

// /* Controllers como serviço */
// // $container = $app->getContainer();
// // $container['View'] = function(){
// //     return new MyApp\View;
// // };
// // $app->get('/usuario', '\MyApp\controllers\Home:index');
// /* outra forma de fazer o código a cima  */
// $container = $app->getContainer();
// $container['Home'] = function(){
//     return new MyApp\controllers\Home(new MyApp\View);
// };
// $app->get('/usuario', 'Home:index');

//Middleware, respostas e database
/* Tipos de respostas 
cabeçalho, texo, Json, XML */

// $app->get('/header', function(Request $request, Response $response){
//     $response->write('Esse é um retorno  HEADER');
//     return $response->withHeader('allow', 'PUT')->withAddedHeader('Content-Length', 10)->withAddedHeader('Date', Date('d/m/Y'));
// });
// $app->get('/json', function(Request $request, Response $response){
//     return $response->withJson([
//         "Nome" => "Willyan Carlos",
//         "Idade" => 32,
//         "Profissao" => "Estagiario"
//     ]);
// });
// $app->get('/xml', function(Request $request, Response $response){
//     $xml = file_get_contents('arquivo');
//     $response->write($xml);
//     return $response->withHeader('Content-Type', 'application/xml');
// });

// /* Middleware */
// $app->add(function ($request, $response, $next){
//     $response->write('Inicio camada 1 + ');
//     // return $next($request, $response);
//     $next($request, $response);
//     return $response->write(' + fim da camada 1');
// });
// // $app->add(function ($request, $response, $next){
// //     $response->write('Inicio camada 2 +');
// //     return $next($request, $response);
// // });
// $app->get('/middlewareUsuarios', function(Request $request, Response $response){
//     $response->write('Acão principal usuários');
// });
// $app->get('/middlewarePostagens', function(Request $request, Response $response){
//     $response->write('Acão principal postagens');
// });

/* Database */
$container = $app->getContainer();
$container['db'] = function(){
    $capsule = new Capsule;
    $capsule->addConnection([
        'driver'    => 'mysql',
        'host'      => 'localhost',
        'database'  => 'slim',
        'username'  => 'root',
        'password'  => '',
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'    => '',

    ]);
    $capsule->setAsGlobal();
    $capsule->bootEloquent();
    return $capsule;
};
$app->get('/usuarios', function(Request $request, Response $response){
    $db = $this->get('db');
    // $db->schema()->dropIfExists('usuarios');
    // $db->schema()->create('usuarios', function($table){
    //     $table->increments('id');
    //     $table->string('nome');
    //     $table->string('email');
    //     $table->timestamps();
    // });

    /* Inserir */
    // try{
    //     $db->table('usuarios')->insert([
    //         'nome' => 'Jorge Sant Anna',
    //         'email' => 'jorge@slim.com.br'
    //     ]);
    // }catch(Exception $e){
    //     echo 'Erro ao tentar inserir dados '. $e->getMessage() .'<br>';
    // }

    /* Atualizar */
    // try{
    //     $db->table('usuarios')->where('id', 1)->update([
    //         'nome' => 'Willyan Ferreira',
    //     ]);
    // }catch(Exception $e){
    //     echo 'Erro ao tentar inserir dados '. $e->getMessage() .'<br>';
    // }

    /* Deletar */
    // try{
    //     $db->table('usuarios')->where('id', 3)->delete();
    // }catch(Exception $e){
    //     echo 'Erro ao tentar inserir dados '. $e->getMessage() .'<br>';
    // }

    /* Listar */
        $usuarios = $db->table('usuarios')->get();
        foreach ($usuarios as $usuario) {
        echo $usuario->nome.'<br>';
        }
});

$app->run();
?>