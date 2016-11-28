<!DOCTYPE html>
<html>

    <?php
//this is for signing up new elengomats/election team membersa

$config = include('utils/config.php');

$servername = $config['server_name']; //hits localhost
$username =  $config['db_user'];
$password = $config['db_pass'];
//NOTE:  This will change once we implment multiple lodges, as each lodge will have its own db
$database =  $config['db_name']; //all database titles should be all caps
$dbport = $config['db_port'];



$db = new mysqli($servername, $username, $password, $database, $dbport);




if (isset($_POST['submitForm'])) {
    if ($db->connect_error) {
        session_start();
        header("Location: /formError");
        exit();
    }

    $troopNumber = $_POST["TroopNumber"];
    $address = $_POST["PhysicalAddress"];
    $preferred = $_POST["ElectionDate"];
    $emailAddress = $_POST["EmailAddressForm"];
    $Name = $_POST["Name"];

    $query = "SELECT IFNULL((SELECT * FROM ELENGOMATS WHERE EMAIL = '" . $emailAddress . "'), 'not found')";
    $result = $db->query($query);
    
    if ($result != null) {
        print "found user";
        //$emailAddress = $_POST["EmailAddressForm"];
        $query = "UPDATE ELENGOMATS set TROOP_NUM = " . $troopNumber . ", ADDRESS = '" . $address . "', PREFERRED_DATE = '" . $preferred . "' where EMAIL = " .$emailAddress;
        $result = $db->query($query);
    }
    else {
        $query = "INSERT INTO elengomats (NAME, TROOP_NUM, ADDRESS, PREFERRED_DATE, EMAIL) VALUES 
        ('" . $Name . "', " . $troopNumber . ", '" . $address . "', '" . $preferred . "', '" . $emailAddress . "')";
        $result = $db->query($query);
    }
    if ($db->error) {
        $errorstring = $db->error;
    }
    else {
        
    }

    
}

if (isset($_POST['emailCheck'])) {
    $emailAddress = $_POST["EmailAddress"];
    $Name ="";
    $address = "";
    $preferred = "";
    $troopNumber = 0;

    if($db->connect_error) {
        session_start();
        header("Location: /formError");
        exit();
     }
    $query = "SELECT * FROM ELENGOMATS WHERE EMAIL = '" . $emailAddress . "'";
    $result = $db->query($query);
    $emailAddress = ""; //So the email shows up blank if nothing is found.

    if($result != null)
    {   
        while($row = $result->fetch_assoc()){
            $Name = $row['NAME'];
            $emailAddress = $row['EMAIL'];
            $address = $row['ADDRESS'];
            $preferred = $row['PREFERRED_DATE'];
            $troopNumber = $row['TROOP_NUM'];
        }
    }    
    
    
}

?>

<head>
    <!--  jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">

<!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->
<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />

<!-- Bootstrap Date-Picker Plugin -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
</head>




<body>
<div class="bootstrap-iso">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="text-center" >Elengomat Form</h1>
                
                   <div id="regFormContainer" class="bar-colors-borders">

                        <h5 class="text-center">If you have participated before enter your email to check for your info.</h5>
                        <form class="form-horizontal text-center" action="elengomats" method="post"  enctype="multipart/form-data" >
                            
                            <div class="form-group">    
                                <label class="col-sm-5 control-label" for="emailAddress">Email Address:</label>
                                <div class='col-sm-1 text-center'>
                                    <input id="emailAddress" name="EmailAddress" type="text"/>
                                </div>
                            </div>
                            <button name="emailCheck" class="btn btn-primary">Check</button>
                        </form>
                        <br></br>
                        <h5 class="text-center">Fill out this form to sigup.</h5>
                        <form class="form-horizontal text-center" action="elengomats" method="post"  enctype="multipart/form-data" >
                            
                            <div class="form-group">    
                                <label class="col-sm-5 control-label" for="address">Name:</label>
                                <div class='col-sm-1 text-center'>
                                    <input id="name" name="Name" value="<?php echo $Name ?>" type="text"/>
                                </div>
                            </div>

                            <div class="form-group">    
                                <label class="col-sm-5 control-label" for="address">Email Address:</label>
                                <div class='col-sm-1 text-center'>
                                    <input id="formEmailAddress" name="EmailAddressForm" value="<?php echo $emailAddress ?>"  type="text"/>
                                </div>
                            </div>

                            <div class="form-group">    
                                <label class="col-sm-5 control-label" for="address">Physical Address:</label>
                                <div class='col-sm-1 text-center'>
                                    <input id="address" name="PhysicalAddress" value="<?php echo $address ?>" type="text"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-5 control-label" for="troopNumber">Troop Number:</label>
                                <div class='col-sm-1 text-center'>
                                    <input id="troopNumber" name="TroopNumber" value="<?php echo $troopNumber ?>" type="number"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-5 control-label" for="daysUnavailable">Preferred Election Date:</label>
                                <div class='col-sm-1 text-center' style="padding-left: 1.9%;">
                                    <input  class="form-group" id="electionDate" name="ElectionDate" value="<?php echo $preferred ?>" placeholder="MM/DD/YYYY" type="text"/>
                                </div>
                            </div>


                                <button name="submitForm" class="btn btn-primary">Submit</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>





</body>
</html>