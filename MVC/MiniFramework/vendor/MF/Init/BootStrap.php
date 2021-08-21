<?php
namespace MF\Init;
abstract class BootStrap{
    private $routes;

    abstract protected function initRoutes();
    
    public function __construct(){
        $this->initRoutes();
        $this->run($this->getUrl());
    }
    public function setRoutes(array $routes){
        $this->routes = $routes;
    }
    public function getRoutes(){
        return $this->routes;
    }
    protected function run($url){
        foreach($this->getRoutes() as $key => $value){
            if($url == $value['route']){
                $class = "App\\Controllers\\".ucfirst($value['controller']);
                $controller = new $class;
                $action = $value['action'];
                $controller->$action();
            }//else{
            //     echo"<p style='color: orange;'>Página não encontrada</p>";
            // }
        }
    }

    protected function getUrl(){
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); //parse_url retorna um array() com os componentes de uma URL - PHP_URL_PATH faz com que o retorno seja apenas a string relacionada ao PATH.
    }
}
?>