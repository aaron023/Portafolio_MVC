<?php 

namespace Controllers;

use Model\Configuraciones;
use MVC\Router;

class ConfiguracionController {

    public static function index(Router $router) {

        if(!is_admin()) {
            header('Location: /login');
        }

        $configuracion = Configuraciones::all();

        $router->render('admin/configuracion/index', [
            'titulo' => 'Configuraciones',
            'configuracion' => $configuracion
        ]);

    }

    public static function editar(Router $router) {
        if(!is_admin()) {
            header('Location: /login');
        }
        
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if(!$id) {
            header('Location: /admin/configuracion');
        }

        $alertas = [];

        $configuracion = Configuraciones::find($id);
        if(!$configuracion) {
            header('Location /admin/configuracion');
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $configuracion->sincronizar($_POST);

            // Validar
            $alertas = $configuracion->validar();

            if(empty($alertas)) {
                $resultado = $configuracion->guardar();

                if($resultado) {
                    header('Location: /admin/configuracion');
                }
            }            
        }

        $router->render('admin/configuracion/editar', [
            'titulo' => 'Editar',
            'alertas' => $alertas,
            'configuracion' => $configuracion
        ]);

    }

}