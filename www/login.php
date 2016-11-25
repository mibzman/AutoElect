<?php
require "front_header.html";

$config = include('utils/config.php');

$servername = $config['server_name']; //hits localhost
$username =  $config['db_user'];
$password = $config['db_pass'];
//NOTE:  This will change once we implment multiple lodges, as each lodge will have its own db
$database =  $config['db_name']; //all database titles should be all caps
$dbport = $config['db_port'];

// Create connection

$db = new mysqli($servername, $username, $password, $database, $dbport);

session_unset();     // unset $_SESSION variable for this page
session_destroy();

if ($input = $_POST['username']) {
    if ($db->connect_error) {
        session_start();
        header("Location: /login");
        exit();
    }
    else {
        $query = "SELECT * FROM USERS WHERE USERNAME = '" . $input . "'";
        $result = $db->query($query);
        if ($result != null) {
            while ($row = $result->fetch_assoc()) {

                // $hash = password_hash(, PASSWORD_DEFAULT);

                if (password_verify($_POST['password'], $row['HASH'])) {
                    
                    session_start();
                    $_SESSION['user'] = $input;

                    header("Location: /dash");
                    //exit();
                }
                else {
                    session_start();
                    header("Location: /login"); //TODO: add some sort of 'wrong password thing
                    exit();
                }
            }
        }
        else {
            session_start();
            header("Location: /login");
            exit();
        }
    }
}

?>

<div class="intro">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="intro-message" style="padding-top: 10%">
                    <h1 style="padding-bottom: 5%">Login</h1>
                    
                    <form class="form-horizontal text-center" role="form" action="login" method="POST">
                        <div class="form-group">
                            <label for="username" class='col-sm-5 control-label'>Username:</label>
                            <div class='col-sm-1 text-center'>
                                <input type="text" name="username"/>
                            </div>
                        </div>
                        
                        <div class='form-group'>
                            <label for="password" class='col-sm-5 control-label'>Password:</label>
                            <div class='col-sm-1 text-center'>
                                <input type="password" name="password"/>
                            </div>
                        </div>
                        <div class='form-group'>
                            <div class='col-sm-offset-5 col-sm-1 text-center'>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php require "front_footer.html"; ?>
