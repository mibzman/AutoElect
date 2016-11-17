//this is the form that the newly invited admin uses to make their account
<?php
require "front_header.html";

$servername = getenv('IP');
$sqlusername = "autoelect";
$sqlpassword = "elengomat";
$database = "AUTOELECT";
$dbport = 3306;
$name;
$email = "";
$errorstring;

// Create connection

$db = new mysqli($servername, $sqlusername, $sqlpassword, $database, $dbport);

if (isset($_GET["id"])) {
    $token = $_GET["id"];
    $query = "SELECT * FROM TEMPUSERS WHERE ID = '" . $token . "'";
    $result = $db->query($query);
    if ($result != null) {
        while ($row = $result->fetch_assoc()) {
            $name = $row['NAME'];
            $email = $row['EMAIL'];
            $_POST['type'] = $row['TYPE'];
        }
    }
    else {
        session_start();
        header("Location: /404");
        exit();
    }
}
elseif (isset($_POST['username'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $type = $_POST['type'];
    if (check_for_user($username)) {
        session_start();
        header("Location: /userexists");
        exit();
    }

    $query = "INSERT INTO USERS (EMAIL, NAME, PERMISSION, USERNAME, HASH) VALUES 
        ('" . $email . "','" . $name . "','" . $type . "','" . $username . "','" . $hash . "')";
    $result = $db->query($query);
    if ($db->error) {
        $errorstring = $db->error;
    }
    else {
        session_start();
        header("Location: /dash?user=" . $username);
        exit();
    }
}
else {
    session_start();
    header("Location: /404");
    exit();
}

function check_for_user($username)
{
    $query = "SELECT * FROM USERS WHERE USERNAME = '" . $input . "'";
    $result = $db->query($query);
    if ($result != null) {

        // user already exists

        while ($row = $result->fetch_assoc()) {
            return true;
        }

        return false;
    }
}

?>


<div class="intro">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="intro-message" style="padding-top: 10%">
                        <form class="form-horizontal text-center" role="form" action="signup" method="POST">
                            <h1 style="padding-bottom: 5%">Create your account <?php echo $errorstring; ?> </h1>
                        
                        <div class="form-group">
                            <label for="email" class='col-sm-5 control-label'>Email Address:</label>
                            <div class='col-sm-1 text-center'>
                                <input type="text" name="email" value="<?php echo $email ?>"/>
                            </div>
                        </div>
                        
                        <div class='form-group'>
                            <label for="name" class='col-sm-5 control-label'>Name :</label>
                            <div class='col-sm-1 text-center'>
                                <input type="text" name="name" value="<?php echo $name ?>"/>
                            </div>
                        </div>
                        
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
                                <button name="signupSubmit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 


<?php require "front_footer.html"; ?>
