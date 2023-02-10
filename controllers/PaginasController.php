<?php 

namespace Controllers;

use Classes\Email;
use Classes\Paginacion;
use Model\Configuraciones;
use Model\Proyecto;
use MVC\Router;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController {
    public static function index(Router $router) {

        $alertas = [];
        $array = ['estatus' => 1 ];

        // Obtenemos los titulos
        $configuracion = Configuraciones::all();

        // Obtenemos los proyectos
        $proyectos = Proyecto::whereOrderLimit($array,'id', 'DESC', '3');

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $mensaje = $_POST['mensaje'];

            $email = new Email($email, $nombre, '', $mensaje);            
            $alertas = $email->correoContacto(); 
        }

        $router->render('paginas/index', [
            'titulo' => 'Pagina de Inicio',
            'proyectos' => $proyectos,
            'alertas' => $alertas,
            'configuracion' => $configuracion
        ]);

        
    }

    public static function proyectos(Router $router) {
        
        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);
        $configuracion = Configuraciones::all();

        if(!$pagina_actual || $pagina_actual < 1) {
            header('Location: /proyectos?page=1');
        }

        $registros_por_pagina = 6;
        $total = Proyecto::total('estatus', '1');
        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total);

        // Obtenemos los proyectos
        $array = ['estatus' => 1 ];
        $proyectos = Proyecto::paginar($registros_por_pagina, $paginacion->offset(), $array);

        if($paginacion->total_paginas() < $pagina_actual) {
            header('Location: /proyectos?page=1');
        }

        $router->render('paginas/proyectos', [
            'titulo' => 'Todos los proyectos',
            'proyectos' => $proyectos,
            'paginacion' => $paginacion->paginacion(),
            'configuracion' => $configuracion
        ]);
    }


    public static function contacto(Router $router) {
        $alertas = [];
        $configuracion = Configuraciones::all();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $mensaje = $_POST['mensaje'];
            
            // Crear una instancia de PHPMailer
            $mail = new PHPMailer();

            // Configurar SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = '4e80fa1d917bf9';
            $mail->Password = '75a0afdfb981bc';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 2525;

            // Configurar el contenido del Email
            $mail->setFrom('contacto@freelance.com');
            $mail->addAddress('contacto@freelance.com', 'Freelancer');
            $mail->Subject = 'Tienes un nuevo mensaje en tu portafolio';

            // Habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            // Definir el contenido
            $contenido = '<html>';
            $contenido .= '<p>Hola Aarón:</p>';
            $contenido .= '<p>Tienes un nuevo mensaje de: </p>';
            $contenido .= '<p>Nombre: ' . $nombre . '</p>';
            $contenido .= '<p>Email: ' . $email . '</p>';
            $contenido .= '<p>Mensaje: ' . $mensaje . '</p>';
            $contenido .= '</html>';

            $mail->Body = $contenido;
            $mail->AltBody = 'Esto es texto alternativo sin HTML';

            // Enviar el Email
            if($mail->send()) {
                $alertas['exito'][] = "Mensaje Enviado correctamente";
            } else {
                $alertas['error'][] = "El mensaje no se pudo enviar";
            }
        }
    
        $router->render('paginas/contacto', [
            'titulo' => 'Contacto',
            'alertas' => $alertas,
            'configuracion' => $configuracion
        ]);
    }
}

