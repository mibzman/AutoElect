<?php
require "header.php";
    var_dump( $_POST );
    $servername = getenv('IP');
    $username = "autoelect";
    $password = "elengomat";
    $database = "AUTOELECT";
    $dbport = 3306;
    
    $db = new mysqli($servername, $username, $password, $database, $dbport);
    
    if (isset($_POST['username'])) { //the second time is the actual login
	//echo "stuff is happening";
        $name = $_POST['name'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
	$type = 1;
         $query = "SELECT * FROM TEMPUSERS WHERE EMAIL = '" . $email . "'";
        $result = $db->query($query);
        if($result != null){
            while($row = $result->fetch_assoc()){
                 $type  = $row['TYPE'];
            }
        }else{
           session_start();
            header("Location: /404");
            exit();
        }


       $query = "INSERT INTO USERS (EMAIL, NAME, PERMISSION, USERNAME, HASH) VALUES
        ('" . $email . "','". $name. "','". $type . "','". $username . "','". $hash . "')";
        $result = $db->query($query);
        if($db->error){
	$errorstring = $db->error;
        }else{
            session_start();
            header("Location: dash?user=" . $username);
            exit();
        }
	
    }
    else {
	echo "Stuff is not happening";
       /* session_start();
        header("Location: 404");
        exit();*/
    }
   
   
?>

<div class="intro">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="intro-message" style="padding-top: 10%">
                    <h1 style="padding-bottom: 5%">Welcome new user!</h1>
                    <form class="form-horizontal text-center" role="form" action="dash" method="POST">
                      
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php require "footer.html"; ?>
