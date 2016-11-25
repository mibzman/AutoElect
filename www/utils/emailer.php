<?php
include_once ("phpmailer/class.phpmailer.php");
include_once ("phpmailer/class.smtp.php");

function email($name, $email, $subject, $body, $sender = 'Admin', $senderEmail = 'autoelect17@gmail.com'){
    $mail = new PHPMailer();
    $mail->IsSMTP(); // enable SMTP authentication
    $mail->SMTPAuth = true; // sets the prefix to the server
    $mail->SMTPSecure = "ssl"; // sets GMAIL as the SMTP server
    $mail->Host = 'smtp.gmail.com'; // set the SMTP port
    $mail->Port = '465';

    $mail->Username = 'autoelect17@gmail.com'; // GMAIL username
    $mail->Password = 'Elengomat'; // GMAIL password
    $mail->From = 'autoelect17@gmail.com';
    $mail->FromName = $sender;
    $mail->AddReplyTo($senderEmail, $sender);

    $mail->AddAddress($email, $name);
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->IsHTML(false);
    if (!$mail->Send()) {
        $mail->ErrorInfo;
        return false;
    }
    else {
        $mail->ClearAddresses();
        $mail->ClearAttachments();
        return true;
    }

}

?>
