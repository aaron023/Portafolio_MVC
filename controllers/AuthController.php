<?php 

namespace Controllers;

use Classes\Email;
use Model\Configuraciones;
use Model\Usuario;
use MVC\Router;

class AuthController {
    public static function login(Router $router) {
        $alertas = [];
        // Obtenemos los titulos
        $configuracion = Configuraciones::all();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {            
            $usuario = new Usuario($_POST);
            $alertas = $usuario->validarEmail();

            if(empty($alertas)) {
                // Verficar que el usuario exitas
                $usuario = Usuario::where('email', $usuario->email);
                
                if(!$usuario || !$usuario->confirmado) {
                    Usuario::setAlerta('error', 'El usuario no existe o no está confirmado');
                } else {
                    if(password_verify($_POST['password'], $usuario->password)) {

                        // Iniciar la sesión
                        session_start();
                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre;
                        $_SESSION['apellido'] = $usuario->apellido;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['admin'] = $usuario->admin ?? null;

                        // Redireccionar
                        if($usuario->admin) {
                            header('Location: /admin/dashboard');
                        } 
                        else {
                            header('Location: /login');
                        }
                    } else {
                        Usuario::setAlerta('error', 'Password incorrecto');
                    }                    
                }
            }        
        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/login', [
            'titulo' => 'Iniciar Sesión',
            'alertas' => $alertas,
            'configuracion' => $configuracion
        ]);
    }

    public static function logout() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();
            $_SESSION = [];
            header('Location: /');
        }
    }    


    public static function registro(Router $router) {
        $alertas = [];
        $usuario = new Usuario();
        $configuracion = Configuraciones::all();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);

            $alertas = $usuario->validar_cuenta();
            
            if(empty($alertas)) {
                $existeUsuario = Usuario::where('email', $usuario->email);

                if($existeUsuario) {
                    Usuario::setAlerta('error', 'El Usuario ya está registrado');
                    $alertas = Usuario::getAlertas();
                } else {
                    // Hashear el passowrd
                    $usuario->hashPassword();
                    
                    // Eliminar el pasword2
                    unset($usuario->password2);

                    // Generar el token
                    $usuario->crearToken();

                    // Crear un nuevo usuario
                    $resultado = $usuario->guardar();

                    // Enviar el email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token, '');
                    $email->enviarConfirmacion();

                    if($resultado) {
                        header('Location: /mensaje');
                    }
                }
            }
        }

        $router->render('auth/registro', [
            'titulo' => 'Registrarse al Portafolio',
            'alertas' => $alertas,
            'configuracion' => $configuracion
        ]);
    }

    public static function olvide(Router $router) {
        $alertas = [];
        $configuracion = Configuraciones::all();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = new Usuario($_POST);
            $alertas = $usuario->validarEmail();

            if(empty($alertas)) {
                // Buscar al usuario
                $usuario = $usuario->where('email', $usuario->email);
                
                if($usuario && $usuario->confirmado) {
                    // Generar un nuevo token
                    $usuario->crearToken();
                    unset($usuario->password2);

                    // Actualizar el usuario
                    $usuario->guardar();

                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token, '');
                    $email->enviarInstrucciones();

                    $alertas['exito'][] = 'Hemos enviado las instrucciones a tu email';                    
                } else {
                    $alertas['error'][] = 'El usuario no existe o no está confirmado';
                }
            }
        }

        $router->render('auth/olvide', [
            'titulo' => 'Olvidé mi Passord',
            'alertas' => $alertas,
            'configuracion' => $configuracion
        ]);
    }

    public static function reestablecer(Router $router) {
        $token = s($_GET['token']);
        $token_valido = true;
        $configuracion = Configuraciones::all();

        if(!$token) header('Location: /');

        // Identificar al usario con ese token
        $usuario = Usuario::where('token', $token);

        if(empty($usuario)) {
            Usuario::setAlerta('error', 'Token no válido, intenta de nuevo');
            $token_valido = false;
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            // Añadir el nuevo password
            $usuario->sincronizar($_POST);

            // Validar el password
            $alertas = $usuario->validarPassword();

            if(empty($alertas)) {
                // Hashear el nuevo password
                $usuario->hashPassword();

                // Eliminar el token
                $usuario->token = null;

                // Guardar el usuario en la base de datos
                $resultado = $usuario->guardar();

                // Redireccionar
                if($resultado) {
                    header('Location: /login');
                }
            }
        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/reestablecer', [
            'titulo' => 'Reestablecer Password',
            'alertas' => $alertas,
            'token_valido' => $token_valido,
            'configuracion' => $configuracion
        ]);
    }

    public static function mensaje(Router $router) {
        $configuracion = Configuraciones::all();

        $router->render('auth/mensaje', [
            'titulo' => 'Cuenta Creada Exitosamente',
            'configuracion' => $configuracion
        ]);
    }

    public static function confirmar(Router $router) {

        $token = s($_GET['token']);
        $configuracion = Configuraciones::all();

        if(!$token) header('Location: /');

        // Encontrar al usuario por el token
        $usuario = Usuario::where('token', $token);

        if(empty($usuario)) {
            Usuario::setAlerta('error', 'Token no válido, la cuenta no se confirmó');
        } else {
            // Confirmar la cuenta
            $usuario->confirmado = 1;
            $usuario->token = '';
            unset($usuario->password2);

            // Guardar en la base de datos 
            $usuario->guardar();
            Usuario::setAlerta('exito', 'Cuenta Comprobada Exitosamente');
        }


        $router->render('auth/confirmar', [
            'titulo' => 'Confirma tu cuenta en Freelancer',
            'alertas' => Usuario::getAlertas(),
            'configuracion' => $configuracion
        ]);
    }
}