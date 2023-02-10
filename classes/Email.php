<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {
    public $email;
    public $nombre;
    public $token;
    public $mensaje;

    public function __construct($email, $nombre, $token, $mensaje)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token ?? '';
        $this->mensaje = $mensaje ?? '';
    }

    public function enviarConfirmacion() {
        // Crear un nuevo objeto
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port =$_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom('contacto@acsoftware.com');
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Confirma tu cuenta';

        // Set HTML
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $contenido =  '<html>';
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Has registrado correctamente tu cuenta en ACSoftware.com; pero es necesario confirmarla</p>";
        $contenido .= "<p>Presiona aquí: <a href='" . $_ENV['HOST'] . "/confirmar-cuenta?token=" . $this->token . "'>Confirmar Cuenta</a></p>";
        $contenido .= "<p>Si no creaste esta cuenta; puedes ignorar el mensaje</p>";
        $contenido .= '</html>';
        $mail->Body = $contenido;

        // Enviar el email
        $mail->send();
    }

    public function enviarInstrucciones() {
        // Crear un nuevo objeto
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];


        $mail->setFrom('cuentas@freelance.com');
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Reestablece tu password';

        // Set HTML
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= "<p><strong>Hola " . $this->nombre .  "</strong> Has solicitado reestablecer tu password, sigue el siguiente enlace para hacerlo.</p>";
        $contenido .= "<p>Presiona aquí: <a href='" . $_ENV['HOST'] . "/reestablecer?token=" . $this->token . "'>Reestablecer Password</a>";        
        $contenido .= "<p>Si tu no solicitaste este cambio, puedes ignorar el mensaje</p>";
        $contenido .= '</html>';
        $mail->Body = $contenido;

        //Enviar el mail
        $mail->send();
    }


    public function correoContacto() {
         // Configurar SMTP
         $mail = new PHPMailer();
         $mail->isSMTP();
         $mail->Host = $_ENV['EMAIL_HOST'];
         $mail->SMTPAuth = true;
         $mail->Port = $_ENV['EMAIL_PORT'];
         $mail->Username = $_ENV['EMAIL_USER'];
         $mail->Password = $_ENV['EMAIL_PASS']; 
         //$mail->SMTPSecure = 'tls';         

         // Configurar el contenido del Email
         $mail->setFrom('contacto@acsoftware.com');
         $mail->addAddress('contacto@acsoftware.com', 'ACSoftware');
         $mail->Subject = 'Tienes un nuevo mensaje en tu portafolio';

         // Habilitar HTML
         $mail->isHTML(true);
         $mail->CharSet = 'UTF-8';

         // Definir el contenido
         $contenido = '<html>';
         $contenido .= '<p>Hola Aarón:</p>';
         $contenido .= '<p>Tienes un nuevo mensaje de: </p>';
         $contenido .= '<p>Nombre: ' . $this->nombre . '</p>';
         $contenido .= '<p>Email: ' . $this->email . '</p>';
         $contenido .= '<p>Mensaje: ' . $this->mensaje . '</p>';
         $contenido .= '</html>';

         $mail->Body = $contenido;
         $mail->AltBody = 'Esto es texto alternativo sin HTML';

         // Enviar el Email
        // Enviar el Email
        if($mail->send()) {
             $alertas['exito'][] = "Mensaje Enviado correctamente";
         } else {
             $alertas['error'][] = "El mensaje no se pudo enviar";
         }    

         return $alertas;
    }
}