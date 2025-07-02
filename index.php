<?php
use PHPMailer\PHPMailer\PHPMailer;

require 'vendor/autoload.php';

$mail = new PHPMailer();
$mail->setFrom('admin@example.com', 'Admin');
$mail->addAddress('user@example.com', 'User');
$mail->Subject = 'Correo de prueba';
$mail->Body    = 'Este es un mensaje de prueba.';

if(!$mail->send()) {
    echo 'El mensaje no pudo enviarse.';
    echo 'Error: ' . $mail->ErrorInfo;
} else {
    echo 'Mensaje enviado correctamente.';
}
