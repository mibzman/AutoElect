//this does nothing right now.  can be used for dev stuff and whatever

<?php
require "header.php";

include_once("phpmailer/class.phpmailer.php");
include_once("phpmailer/class.smtp.php");
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = "ssl";
$mail->Host = 'smtp.gmail.com';
$mail->Port = '465';
$mail->Username = 'autoelect17@gmail.com';
$mail->Password = 'Elengomat';

$mail->From = 'autoelect17@gmail.com';
$mail->FromName = 'Admin';
$mail->AddReplyTo('autoelect17@gmail.com', 'Admin');
$mail->Subject = 'Welcome to AutoElect';

$config = include('config.php');

$servername = $config['server_name']; //hits localhost
$username =  $config['db_user'];
$password = $config['db_pass'];
//NOTE:  This will change once we implment multiple lodges, as each lodge will have its own db
$database =  $config['db_name']; //all database titles should be all caps
$dbport = $config['db_port'];
    
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
        $mail->Body = $_POST['message'] . 'https://autoelect-mibzman.c9users.io/signup?id=' . $token;
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
                        <form class="form-horizontal text-center" role="form" action="manual" method="POST">
                            <h1 >MANUAL CONSOLE</h1>
                            <h1 >FOR DEV USE ONLY.</h1>
                            <h1 >DO. NOT. USE. IN. PRODUCTION.</h1>
                         
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
