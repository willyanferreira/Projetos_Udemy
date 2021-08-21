<?php
namespace App;
use MF\Init\BootStrap;

class Route extends BootStrap{
    protected function initRoutes(){
        $routes['home'] = array(
            'route' => '/',
            'controller' => 'IndexController',
            'action' => 'index'
        );
        $routes['sobre_nos'] = array(
            'route' => '/sobre_nos',
            'controller' => 'IndexController',
            'action' => 'sobreNos'    
        );

        $this->setRoutes($routes);
    }
}
?>