<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';

$mail = new PHPMailer(true);

try {

    //Recipients - main edits
    $mail->setFrom('info@7 Rays Hotel.com', 'Message from 7 Rays Hotel');             // Email Address and Name FROM
    $mail->addAddress('info@7 Rays Hotel.com', 'Jhon Doe');                            // Email Address and Name TO - Name is optional
    $mail->addReplyTo('noreply@7 Rays Hotel.com', 'Message from 7 Rays Hotel');       // Email Address and Name NOREPLY
    $mail->isHTML(true);                                                       
    $mail->Subject = 'Message from 7 Rays Hotel';                                // Email Subject      

    // Email verification, do not edit
    function isEmail($email_contact ) {
        return(preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/",$email_contact ));
    }

   // Form fields
    $name_contact     = $_POST['name_contact'];
    $lastname_contact     = $_POST['lastname_contact'];
    $email_contact    = $_POST['email_contact'];
    $phone_contact    = $_POST['phone_contact'];
    $message_contact = $_POST['message_contact'];
    $verify_contact   = $_POST['verify_contact'];

    if(trim($name_contact) == '') {
    echo '<div class="error_message">You must enter your Name.</div>';
    exit();
    } else if(trim($lastname_contact) == '') {
        echo '<div class="error_message">Please enter your Last Name.</div>';
        exit();
    } else if(trim($email_contact) == '') {
        echo '<div class="error_message">Please enter a valid email address.</div>';
        exit();
    } else if(!isEmail($email_contact)) {
        echo '<div class="error_message">You have enter an invalid e-mail address.</div>';
        exit();
    } else if(trim($phone_contact) == '') {
    echo '<div class="error_message">Please enter a valid phone number.</div>';
    exit();
} else if(!is_numeric($phone_contact)) {
    echo '<div class="error_message">Phone number can only contain numbers.</div>';
    exit();
    } else if(trim($message_contact) == '') {
        echo '<div class="error_message">Please enter your message.</div>';
        exit();
    } else if(!isset($verify_contact) || trim($verify_contact) == '') {
        echo '<div class="error_message"> Please enter the verification number.</div>';
        exit();
    } else if(trim($verify_contact) != '4') {
        echo '<div class="error_message">The verification number you entered is incorrect.</div>';
        exit();
    }             

    // Setup html content
    $e_content = "You have been contacted by <strong>$name_contact $lastname_contact</strong> with the following message:<br><br>$message_contact<br><br>You can contact $name_contact via email at $email_contact or by phone at $phone_contact";
    
    $mail->Body = "" . $e_content . "";
    $mail->send();

    // Confirmation/autoreplay email send to who fill the form
    $mail->ClearAddresses();
    $mail->addAddress($_POST['email_contact']); // Email address entered on form
    $mail->isHTML(true);
    $mail->Subject    = 'Confirmation'; // Custom subject
    $mail->Body = "" . $e_content . "";

    $mail->Send();

    // Succes message
    echo '<div id="success_page">
            <div class="icon icon--order-success svg">
                 <svg xmlns="http://www.w3.org/2000/svg" width="72px" height="72px">
                  <g fill="none" stroke="#8EC343" stroke-width="2">
                     <circle cx="36" cy="36" r="35" style="stroke-dasharray:240px, 240px; stroke-dashoffset: 480px;"></circle>
                     <path d="M17.417,37.778l9.93,9.909l25.444-25.393" style="stroke-dasharray:50px, 50px; stroke-dashoffset: 0px;"></path>
                  </g>
                 </svg>
             </div>
            <h5>Thank you!<span>Request successfully sent!</span></h5>
        </div>';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }  
?> 
