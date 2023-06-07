<?php

// Créer une conexion
$pdo = new PDO('mysql:host=localhost;dbname=onlineschool', 'root', 'root');
$pdo->exec("SET  NAMES UTF8");

        $query = "SELECT * from activation INNER JOIN users ON activation.user_id = users.id WHERE activation.code = :activation";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['activation' => $_GET["activation"]]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $email = $data["email"];


// Import PHPMailer classes into the global namespace 
use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\SMTP; 
use PHPMailer\PHPMailer\Exception; 
 
// Include library files 
require 'PHPMailer/Exception.php'; 
require 'PHPMailer/PHPMailer.php'; 
require 'PHPMailer/SMTP.php'; 
 
// Create an instance; Pass `true` to enable exceptions 
$mail = new PHPMailer; 

// Server settings 
//$mail->SMTPDebug = SMTP::DEBUG_SERVER;    //Enable verbose debug output 
$mail->isSMTP();                            // Set mailer to use SMTP 
$mail->Host = 'sebastienmerv.be';           // Specify main and backup SMTP servers 
$mail->SMTPAuth = true;                     // Enable SMTP authentication 
$mail->Username = 'noreply@sebastienmerv.be';       // SMTP username 
$mail->Password = '@1704fleche';         // SMTP password 
$mail->SMTPSecure = 'ssl';                  // Enable TLS encryption, `ssl` also accepted 
$mail->Port = 465;                          // TCP port to connect to 
 
// Sender info 
$mail->setFrom('noreply@sebastienmerv.be', 'OnlineSchool'); 
// $mail->addReplyTo('reply@example.com', 'SenderName'); 
$mail->CharSet = "UTF-8";
// Add a recipient 
$mail->addAddress($email); 
 
//$mail->addCC('cc@example.com'); 
//$mail->addBCC('bcc@example.com'); 
 
// Set email format to HTML 
$mail->isHTML(true); 
 
// Mail subject 
$mail->Subject = 'OnlineSchool'; 
 
// Mail body content 
$bodyContent = '<h1>'.$data["surname"].', voici un lien pour activer ton compte sur OnlineSchool</h1>'; 
$bodyContent .= '<p>Une personne de la plateforme vous a invité à la rejoindre   : <a href="http://localhost/onlineschool/setprofil.php?account='.$_GET["activation"].'">Récupérer</a></b></p>'; 
$mail->Body    = $bodyContent; 
 
// Send email 
if(!$mail->send()) { 
    echo 'Une erreur est arrivé: '.$mail->ErrorInfo.'  Merci de contacter un administrateur avec ce rapport.'; 
} else { 
    header('Location: dashboard/index.php'); 
}