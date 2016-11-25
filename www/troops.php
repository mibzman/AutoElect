<?php
require "front_header.html";
    $config = include('utils/config.php');
    include('utils/loginHandler.php');

    $servername = $config['server_name']; //hits localhost
    $username =  $config['db_user'];
    $password = $config['db_pass'];
    //NOTE:  This will change once we implment multiple lodges, as each lodge will have its own db
    $database =  $config['db_name']; //all database titles should be all caps
    $dbport = $config['db_port'];    

    $name;
    $email = "";
    
    $errorstring;

    // Create connection
    $db = new mysqli($servername, $sqlusername, $sqlpassword, $database, $dbport);

?>

<div class="intro">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="intro-message" style="padding-top: 10%">
                        <form class="form-horizontal text-center" role="form" action="troops" method="POST">
                            <h1 style="padding-bottom: 5%">Create your account </h1>
                        
                        <div class="form-group">
                            <label for="email" class='col-sm-5 control-label'>Email Address:</label>
                            <div class='col-sm-1 text-center'>
                                <input type="text" name="email" value="<?php echo $email ?>"/>
                            </div>
                            
                            <label for="email" class='col-sm-5 control-label'>waa:</label>
                            <div class='col-sm-1 text-center'>
                                <input type="text" name="email2" value="<?php echo $email ?>"/>
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
