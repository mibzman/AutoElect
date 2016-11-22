//this does nothing right now.  can be used for dev stuff and whatever

<?php

require "header.php";
include 'emailer.php';
$config = include('config.php');

$servername = $config['server_name']; //hits localhost
$username =  $config['db_user'];
$password = $config['db_pass'];
//NOTE:  This will change once we implment multiple lodges, as each lodge will have its own db
$database =  $config['db_name']; //all database titles should be all caps
$dbport = $config['db_port'];
    
$db = new mysqli($servername, $username, $password, $database, $dbport);
    
   
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
