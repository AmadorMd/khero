<?php 
    require('../vendor/autoload.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    $body = "Un nuevo héroe ha hecho contacto <br>";
    $body .= "<strong>Nombre:</strong> ".$_POST['nombre']."<br>";
    $body .= "<strong>Correo:</strong> ".$_POST['email']."<br>";
    $body .= "<strong>Nombre empresa:</strong> ".$_POST['nombre_empresa']."<br>";
    $body .= "<strong>Número de empleados:</strong> ".$_POST['numero_empleados']."<br>";
    $body .= "<strong>Mensaje:</strong> ".$_POST['mensaje']."<br>";

    sendMail('amador@glucosacomunicacion.com','Nuevo heroe ha hecho contacto',$body);

    function sendMail($email,$subject,$body){

        $mail = new PHPMailer;
    
        $mail->IsSMTP();  // telling the class to use SMTP
        $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth   = true; // SMTP authentication
        $mail->CharSet = 'UTF-8';
        $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for GMail
        $mail->Host       = "smtp.gmail.com"; // SMTP server
        $mail->Port       = 587; // SMTP Port
        $mail->Username   = "guillermo.tena.plaza@gmail.com"; // SMTP account username
        $mail->Password   = "pltn8405";  // SMTP account password                                  // TCP port to connect to
    
        $mail->From = 'no-reply@khero.mx';
        $mail->FromName = 'KHero website';
    
    
        $mail->addAddress($email);     // Add a recipient
    
        $mail->isHTML(true);   // Set email format to HTML
    
        $mail->Subject = $subject;    
        $mail->Body=$body;
    
        
        $mail_status = $mail->send(); 
        $mail_status = true; 

        
    
        if(!$mail_status) {
            return  $mail->ErrorInfo;
        } else {
            echo 1;
        }
    }