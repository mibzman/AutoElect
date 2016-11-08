<?php
require "header.php";

include_once("phpmailer/class.phpmailer.php");
include_once("phpmailer/class.smtp.php");
$mail = new PHPMailer();
$mail->IsSMTP();
// enable SMTP authentication
$mail->SMTPAuth = true;
// sets the prefix to the server
$mail->SMTPSecure = "ssl";
// sets GMAIL as the SMTP server
$mail->Host = 'smtp.gmail.com';
// set the SMTP port
$mail->Port = '465';
// GMAIL username
$mail->Username = 'autoelect17@gmail.com';
// GMAIL password
$mail->Password = 'Elengomat';

$mail->From = 'autoelect17@gmail.com';
$mail->FromName = 'Admin';
$mail->AddReplyTo('autoelect17@gmail.com', 'Admin');
$mail->Subject = 'Welcome to AutoElect';

$servername = getenv('IP');
$username = getenv('C9_USER');
$password = "";
$database = "c9";
$dbport = 3306;
    
    $db = new mysqli($servername, $username, $password, $database, $dbport);
    
    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $type = $_POST['selector'];
        $token = sha1(uniqid($name));
        
        $query = "INSERT INTO TEMPUSERS (EMAIL, NAME, ID, TYPE) VALUES ('" . $email . "','". $name. "','" . $token . "','". $type . "')";
        
        $result = $db->query($query);
        
        echo $db->error;
        
        $mail->AddAddress($email , $name);
        $mail->Body = $_POST['message'] . 'https://autoelect.ddns.net/signup?id=' . $token;
        $mail->IsHTML(false);

        if(!$mail->Send()){
            //echo $mail->ErrorInfo;
        }else{ 
            $mail->ClearAddresses();
            $mail->ClearAttachments();
        }
    }


?>

<div class="intro">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="intro-message" style="padding-top: 10%">
                    <form class="form-horizontal text-center" role="form" action="invite" method="POST">
                        
                        <h1 style="padding-bottom: 5%">One Time Invite</h1>
                            
                        <div class="form-group">
                            <label for="email" class='col-sm-5 control-label'>Select Type:</label>
                            <div class='col-sm-2 text-center'>
                                <select class="form-control" name="selector">
                                    <option value="1">Admin</option>
                                    <option value="2">Scoutmaster</option>
                                    <option value="3">Elengomat</option>
                                    <option value="4">Youth Cannidate</option>
                                    <option value="5">Adult Cannidate</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="email" class='col-sm-5 control-label'>Email Address:</label>
                            <div class='col-sm-1 text-center'>
                                <input type="text" name="email"/>
                            </div>
                        </div>
                        
                        <div class='form-group'>
                            <label for="name" class='col-sm-5 control-label'>Name :</label>
                            <div class='col-sm-1 text-center'>
                                <input type="text" name="name"/>
                            </div>
                        </div>
                        <div class='form-group'>
                            <label for="message" class='col-sm-5 control-label'>Message :</label>
                            <div class='col-sm-1 text-center'>
                                <textarea name="message" class="form-group">  You have been invited to join AutoElect! Signup at this link: </textarea> 
                            </div>
                        </div>
                        <div class='form-group'>
                            <div class='col-sm-offset-5 col-sm-1 text-center'>
                                <button name="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php require "footer.html"; ?>
