<?php
require "header.php";

$config = include('utils/config.php');

$servername = $config['server_name']; //hits localhost
$username =  $config['db_user'];
$password = $config['db_pass'];
//NOTE:  This will change once we implment multiple lodges, as each lodge will have its own db
$database =  $config['db_name']; //all database titles should be all caps
$dbport = $config['db_port'];

$db = new mysqli($servername, $username, $password, $database, $dbport);


if (isset($_POST['username'])) { //the second time is the actual login

    // echo "stuff is happening";

    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $type = 1;
    $query = "SELECT * FROM TEMPUSERS WHERE EMAIL = '" . $email . "'";
    $result = $db->query($query);
    if ($result != null) {
        while ($row = $result->fetch_assoc()) {
            $type = $row['TYPE'];
        }
    }
    else {
        session_start();
        header("Location: /404");
        exit();
    }

    $query = "INSERT INTO USERS (EMAIL, NAME, PERMISSION, USERNAME, HASH) VALUES
        ('" . $email . "','" . $name . "','" . $type . "','" . $username . "','" . $hash . "')";
    $result = $db->query($query);
    if ($db->error) {
        $errorstring = $db->error;
    }
    else {
        $delete = "DELETE FROM TEMPUSERS WHERE EMAIL='" . $email ."';";
        $result = $db->query($delete);
        if ($db->error) {
            $errorstring = $db->error;
        }
        else{
            session_start();
            header("Location: dash?user=" . $username);
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
                    <h1 style="padding-bottom: 5%">This page will have info about uptime, response rate, and election percentage</h1>
                    <form class="form-horizontal text-center" role="form" action="dash" method="POST">
                      
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php require "footer.html"; ?>
