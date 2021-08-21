<?php
if (PHP_SAPI != 'cli') {
    exit('Rodar via CLI');
}

require __DIR__ . '/vendor/autoload.php';


// Instantiate the app
$settings = require __DIR__ . '/src/settings.php';
$app = new \Slim\App($settings);

// Set up dependencies
require __DIR__ . '/src/dependencies.php';

$db = $container->get('db');
$schema = $db->schema();
$tabela = 'produtos';

$schema->dropIfExists($tabela);
//Criar tabela produtos
$schema->Create($tabela, function($table){
    $table->increments('id');
    $table->string('titulo', 100);
    $table->text('descricao');
    $table->decimal('preco', 11, 2);
    $table->string('fabricante', 60);
    $table->timestamps();
});

//Criar tabela usuarios
$schema2 = $db->schema();
$tabela2 = 'usuarios';
$db->schema()->dropIfExists('usuarios');
$db->schema()->create('usuarios', function($table2){
    $table2->increments('id');
    $table2->string('nome', 100);
    $table2->string('email', 100);
    $table2->string('senha', 32);
    $table2->timestamps();
});

//Inserindo dados na tabela
$db->table($tabela)->insert([
    'titulo'     => 'Smartphone Motorola Moto G6 32GB Dual Chip',
    'descricao'  => 'Android Oreo - 8.0 Tela 5.7" Octa-Core 1.8 GHz 4G Câmera 12 + 5MP (Dual Traseira) - Índigo',
    'preco'      => 899.00,
    'fabricante' => 'Lenovo',
    'created_at' => '2019-10-22',
    'updated_at' => '2019-10-22'
]);
$db->table($tabela)->insert([
    'titulo'     => 'iPhone X Cinza Espacial 64GB',
    'descricao'  => 'Tela 5.8" IOS 12 4G Wi-Fi Câmera 12MP',
    'preco'      => 4999.00,
    'fabricante' => 'Apple',
    'created_at' => '2020-01-10',
    'updated_at' => '2020-01-10'
]);

?>