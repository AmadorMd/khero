<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// // Load Composer's autoloader
require '../vendor/autoload.php';

// // Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

$nombre = $_POST['nombre'];
$email = $_POST['email'];
$nombre_empresa = $_POST['nombre_empresa'];
$numero_empleados = $_POST['numero_empleados'];
$mensaje = $_POST['mensaje'];


try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
    // Enable verbose debug output
    $mail->isSMTP(); // Send using SMTP
    $mail->Host       = 'secure203.servconfig.com';// Set the SMTP server to send through
    $mail->SMTPAuth = true;// Enable SMTP authentication
    $mail->Username = 'smtp@glucosacomunicacion.com';// SMTP username
    $mail->Password = 'Tcg14eKV-?xI';// SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;// Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port = 587;
    $mail->CharSet ='UTF-8';// TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    $mail->setLanguage('es', '../vendoer/phpmailer/phpmailer/language/phpmailer.lang-es.php');
    //Recipients
    $mail->setFrom('no-reply@khero.mx', 'Khero México');
    $mail->addAddress('guillermo.tena.plaza@gmail.com');     // Add a recipient
    $mail->addBCC('monitoreo@glucosacomunicacion.com');     // Add a recipient
    //$mail->addReplyTo('info@example.com', 'Information');
    $body = "Un nuevo héroe ha hecho contacto <br>";
    $body .= "<strong>Nombre:</strong> ".$nombre."<br>";
    $body .= "<strong>Correo:</strong> ".$email."<br>";
    $body .= "<strong>Nombre empresa:</strong> ".$nombre_empresa."<br>";
    $body .= "<strong>Número de empleados:</strong> ".$numero_empleados."<br>";
    $body .= "<strong>Mensaje:</strong> ".$mensaje."<br>";
    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Nuevo heroe ha hecho contacto: '.$nombre;
    $mail->Body    = $body;
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    

    $response = $mail->send();
    header('Content-type: application/json');
    return $response;
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    $response = json_encode($mail->ErrorInfo); 
    return $response;
}
