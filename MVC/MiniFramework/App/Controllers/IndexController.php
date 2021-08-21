<?php
namespace App\Controllers;

//Recursos do MiniFrameWork
use MF\Controller\Action;
use MF\Model\Container;

//Os models
// use App\Connection; // O Container faz a conexão com o DB agora.
use App\Models\Produtos;
use App\Models\Info;

class IndexController extends Action{
    public function index(){
        // $this->view->dados = ['barba', 'cabelo', 'bigode'];

        //instância de conexão
        // $conn = Connection::getDB();

        // // instanciar modelo
        // $produto = new Produtos($conn); // agora o container faz a conexão com o DB e instancia a classe.
        $produto = Container::getModel('Produtos');
        $produtos = $produto->getProdutos();
        $this->view->dados = $produtos;

        //Chamando o método render
        $this->render('index', 'layout1');
    }
    public function sobreNos(){
        
        // //instância de conexão
        // $conn = Connection::getDB();

        // // instanciar modelo
        // $info = new Info($conn);  // agora o container faz a conexão com o DB e instancia a classe.
        $info = Container::getModel('Info');
        $this->view->dados = $info->getInfo();

        //Chamando o método render
        $this->render('sobreNos', 'layout1');
    }
}
?>