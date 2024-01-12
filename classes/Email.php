<?php

namespace Class;

use PHPMailer\PHPMailer\PHPMailer;

class Email {

    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion() {
        // Crear objeto email (instancia de PHPMailer)
        $mail = new PHPMailer();

        // Configuración del servidor de email
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appsalon.com', 'AppSalon.com');
        $mail->Subject = 'Confirma tu cuenta';

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';
        
        // Creamos el contenido del cuerpo del email
        $contenido = "<html>";
        $contenido .= "<p><strong> Hola " . $this->nombre . "!!! </strong> Has creado tu cuenta en AppSalon. Sólo debes confirmarla siguiendo el siguiente enlace: </p>";
        $contenido .= "<p> Presiona aquí -> <a href='" . $_ENV['APP_URL'] . "/confirmar-cuenta?token=" . $this->token . "'> Confirmar Cuenta </a> </p>";
        $contenido .= "<p> Si no solicitaste crear una cuenta, puedes desestimar el mensaje. </p>";
        $contenido .= "</html>";

        // Agregamos el contenido al cuerpo del email
        $mail->Body = $contenido;

        // Enviar el email
        $mail->send();
    }

    public function enviarInstrucciones() {
        // Crear objeto email (instancia de PHPMailer)
        $mail = new PHPMailer();

        // Configuración del servidor de email
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appsalon.com', 'AppSalon.com');
        $mail->Subject = 'Reestablece tu Password';

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';
        
        // Creamos el contenido del cuerpo del email
        $contenido = "<html>";
        $contenido .= "<p><strong> Hola " . $this->nombre . "!!! </strong> Has solicitado reestablecer tu Password. Entra al siguiente enlace para hacerlo: </p>";
        $contenido .= "<p> Presiona aquí -> <a href='" . $_ENV['APP_URL'] . "/recuperar?token=" . $this->token . "'> Reestablecer Password </a> </p>";
        $contenido .= "<p> Si no solicitaste crear una cuenta, puedes desestimar el mensaje. </p>";
        $contenido .= "</html>";

        // Agregamos el contenido al cuerpo del email
        $mail->Body = $contenido;

        // Enviar el email
        $mail->send();
    }
}