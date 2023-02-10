<?php 

namespace Controllers;

use MVC\Router;

class LoginController {
    public static function login(Router $router) {
        $router->render('paginas/index', [
            'titulo' => 'Pagina de Inicio'
        ]);
    }
}