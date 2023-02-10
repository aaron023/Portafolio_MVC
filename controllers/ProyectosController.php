<?php 

namespace Controllers;

use Classes\Paginacion;
use MVC\Router;
use Model\Proyecto;
use Intervention\Image\ImageManagerStatic as Image;
use Model\Configuraciones;

class ProyectosController {

    public static function index(Router $router) {

        if(!is_admin()) {
            header('Location: /login');
        }

        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        if(!$pagina_actual || $pagina_actual < 1) {
            header('Location: /admin/proyectos?page=1');
        }

        $registros_por_pagina = 3;
        $total = Proyecto::total();
        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total);

        $proyectos = Proyecto::paginar($registros_por_pagina, $paginacion->offset());

        if($paginacion->total_paginas() < $pagina_actual) {
            header('Location: /admin/proyectos?page=1');
        }

        $router->render('admin/proyectos/index', [
            'titulo' => 'Proyectos',
            'proyectos' => $proyectos,
            'paginacion' => $paginacion->paginacion()
        ]);
    }

    public static function crear(Router $router) {
        if(!is_admin()) {
            header('Location: /login');
        }

        $alertas = [];
        $proyecto = new Proyecto();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Leer la imagen
            if(!empty($_FILES['imagen']['tmp_name'])) {
                $carpeta_imagenes = '../public/img/proyectos';

                // Crear la carpeta si no existe
                if(!is_dir($carpeta_imagenes)) {
                    mkdir($carpeta_imagenes, 0755, true);
                }

                $imagen_png = Image::make($_FILES['imagen']['tmp_name'])->fit(1000,600)->encode('png', 80);
                $imagen_webp = Image::make($_FILES['imagen']['tmp_name'])->fit(1000,600)->encode('webp', 80);
                $imagen_avif = Image::make($_FILES['imagen']['tmp_name'])->fit(1000,600)->encode('avif', 80);

                $nombre_imagen = md5(uniqid(rand(), true));

                $_POST['imagen'] = $nombre_imagen;        
            }

            $proyecto->sincronizar($_POST);

            // Validar
            $alertas = $proyecto->validar();

            if(empty($alertas)) {
                $imagen_png->save($carpeta_imagenes . '/' . $nombre_imagen . '.png' );
                $imagen_webp->save($carpeta_imagenes . '/' . $nombre_imagen . '.webp' );
                $imagen_avif->save($carpeta_imagenes . '/' . $nombre_imagen . '.avif' );

                // Guardar en la base de datos
                $resultado = $proyecto->guardar();

                if($resultado) {
                    header('Location: /admin/proyectos');
                }
            }
        }

        $router->render('admin/proyectos/crear', [
            'titulo' => 'Registrar Proyecto',
            'alertas' => $alertas,
            'proyecto' => $proyecto
        ]);
    }

    public static function editar(Router $router) {
        if(!is_admin()) {
            header('Location: /login');
        }

        $alertas = [];
        $nombre_imagen_anterior = '';

        // Obtenemos el Id
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if(!$id) {
            header('Location: /admin/proyectos');
        }

        // Obtener el proyecto a editar
        $proyecto = Proyecto::find($id);

        if(!$proyecto) {
            header('Location /admin/proyetos');
        }

        $proyecto->imagen_actual = $proyecto->imagen;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Revisar si hay una imagen nueva
            if(!empty($_FILES['imagen']['tmp_name'])) {
                $carpeta_imagenes = '../public/img/proyectos';

                // Crear la carpeta si no exise 
                if(!is_dir($carpeta_imagenes)) {
                    mkdir($carpeta_imagenes, 0755, true);
                }

                $imagen_png = Image::make($_FILES['imagen']['tmp_name'])->fit(1000,600)->encode('png', 80);
                $imagen_webp = Image::make($_FILES['imagen']['tmp_name'])->fit(1000,600)->encode('webp', 80);
                $imagen_avif = Image::make($_FILES['imagen']['tmp_name'])->fit(1000,600)->encode('avif', 80);

                $nombre_imagen = md5(uniqid(rand(), true));
                $nombre_imagen_anterior = $proyecto->imagen;

                $_POST['imagen'] = $nombre_imagen;
            } else {
                $_POST['imagen'] = $proyecto->imagen;
            }

            $proyecto->sincronizar($_POST);

            $alertas = $proyecto->validar();

            if(empty($alertas)) {
                if(isset($nombre_imagen)) {
                    // Guardar las imagenes
                    $imagen_png->save($carpeta_imagenes . '/' . $nombre_imagen . '.png');
                    $imagen_webp->save($carpeta_imagenes . '/' . $nombre_imagen . '.webp');
                    $imagen_avif->save($carpeta_imagenes . '/' . $nombre_imagen . '.avif');

                    // Eliminar la imagen anterior
                    if($nombre_imagen_anterior !== '') {

                        if(file_exists($carpeta_imagenes . '/' . $nombre_imagen_anterior . '.png')){
                            unlink($carpeta_imagenes . '/' . $nombre_imagen_anterior . '.png');
                        }
                        if(file_exists($carpeta_imagenes . '/' . $nombre_imagen_anterior . '.webp')){
                            unlink($carpeta_imagenes . '/' . $nombre_imagen_anterior . '.webp');
                        }
                        if(file_exists($carpeta_imagenes . '/' . $nombre_imagen_anterior . '.avif')){
                            unlink($carpeta_imagenes . '/' . $nombre_imagen_anterior . '.avif');
                        }
                    }                    
                }

                $resultado = $proyecto->guardar();

                if($resultado) {
                    header('Location: /admin/proyectos');
                }
            }
        }

        $router->render('admin/proyectos/editar', [
            'titulo' => 'Actualizar proyecto',
            'alertas' => $alertas,
            'proyecto' => $proyecto
        ]);
    }

    public static function estatus($id) {
        if(!is_admin()) {
            header('Location: /login');
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];

            $proyecto = Proyecto::find($id);
            $proyecto->estatus = ($proyecto->estatus) == 1 ? 0 : 1;
            $resultado = $proyecto->guardar();

            if($resultado) {
                header('Location: /admin/proyectos');
            }
        }
    } 
}
