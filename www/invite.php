<!--this is used to invite a new admin -->
<?php

require "header.php";
$config = include('utils/config.php');
include 'utils/emailer.php';
include('utils/loginHandler.php');

$servername = $config['server_name']; //hits localhost
$username =  $config['db_user'];
$password = $config['db_pass'];
//NOTE:  This will change once we implment multiple lodges, as each lodge will have its own db
$database =  $config['db_name']; //all database titles should be all caps
$dbport = $config['db_port'];

$db = new mysqli($servername, $username, $password, $database, $dbport);

if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $type = $_POST['selector'];
    $token = sha1(uniqid($name));
    $query = "INSERT INTO TEMPUSERS (EMAIL, NAME, ID, TYPE) VALUES ('" . $email . "','" . $name . "','" . $token . "','" . $type . "')";
    $result = $db->query($query);
    if ($db->error){
        session_start();
        header("Location: /dbError");
        exit();

    }
    
    $body = $_POST['message'] . $config['url'] .'/signup?id=' . $token;
    if (email($name, $email, 'Welcome to AutoElect', $body)){
        echo "Email was sent Successfully"; 
    }else{
       
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
                                <select class="form-control" name="selector"l>
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
