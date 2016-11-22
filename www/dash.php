<?php
require "header.php";

$config = include('config.php');

$servername = $config['server_name']; //hits localhost
$username =  $config['db_user'];
$password = $config['db_pass'];
//NOTE:  This will change once we implment multiple lodges, as each lodge will have its own db
$database =  $config['db_name']; //all database titles should be all caps
$dbport = $config['db_port'];

$isDocUploaded = true; //initialise flag that says whether jpg was uploaded
$errorsOccurred = false;
$db = new mysqli($servername, $username, $password, $database, $dbport);

if (isset($_GET['user'])) {
    if ($db->connect_error) {
        session_start();
        header("Location: /login"); //TODO add login error message
        exit();
    }

    $query = "SELECT * FROM USERS WHERE USERNAME = '" . $_GET['user'] . "'";
    $result = $db->query($query);
    if ($result != null) {

        // do different stuff depending on permission

    }
}
else {

    // session_start();
    // exit();

}

?>


<div class="intro">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="intro-message" style="padding-top: 10%">
                    <h1 style="padding-bottom: 5%">This page will have info about uptime, response rate, and election percentage</h1>
                    <form class="form-horizontal text-center" role="form" action="dash" method="POST">
                      
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php require "footer.html"; ?>
