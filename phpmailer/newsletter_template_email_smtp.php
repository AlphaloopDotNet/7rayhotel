<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

$mail = new PHPMailer(true);

try {

    //Server settings
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtpserver';                           // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'username';                             // SMTP username
    $mail->Password   = 'password';                             // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients - main edits
    $mail->setFrom('info@7 Rays Hotel.com', 'Message from 7 Rays Hotel');             // Email Address and Name FROM
    $mail->addAddress('info@7 Rays Hotel.com', 'Jhon Doe');                            // Email Address and Name TO - Name is optional
    $mail->addReplyTo('noreply@7 Rays Hotel.com', 'Message from 7 Rays Hotel');       // Email Address and Name NOREPLY
    $mail->isHTML(true);                                                       
    $mail->Subject = 'Message from 7 Rays Hotel';                                // Email Subject   

     // Email verification, do not edit
    function isEmail($email_newsletter ) {
        return(preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/",$email_newsletter ));
    }

    // Form fields
    $email_newsletter    = $_POST['email_newsletter'];

    if(trim($email_newsletter) == '') {
        echo '<div class="error_message">Please enter a valid email address.</div>';
        exit();
    }                               
            
    // Get the email's html content
    $email_html = file_get_contents('template-email.html');

   // Setup html content
    $e_content = "$email_newsletter would like to subscribe to the newsletter.";
    $body = str_replace(array('message'),array($e_content),$email_html);
    $mail->MsgHTML($body);

    $mail->send();

    // Confirmation/autoreplay email send to who fill the form
    $mail->ClearAddresses();
    $mail->isSMTP();
    $mail->addAddress($_POST['email_newsletter']); // Email address entered on form
    $mail->isHTML(true);
    $mail->Subject    = 'Thank you for join to 7 Rays Hotel Newsletter'; // Custom subject
    
    // Get the email's html content
    $email_html_confirm = file_get_contents('confirmation.html');

    // Setup html content, do not edit
    $body = str_replace(array('message'),array($e_content),$email_html_confirm);
    $mail->MsgHTML($body);

    $mail->Send();

    // Succes message
    echo '<div>
           Thank you, your subscription is submitted!!
        </div>';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
?> 