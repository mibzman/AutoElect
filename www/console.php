
<?php
require "header.php";
    //THIS IS THE CONSOLE THAT IS PRESENTED AT THE BEGENING OF THE YEAR
    
    $servername = getenv('IP'); //hits localhost
    $username = "autoelect";
    $password = "elengomat";
    $database = "AUTOELECT"; //all database titles should be all caps
    $dbport = 3306;
    $isDocUploaded = true; //initialise flag that says whether jpg was uploaded
    $errorsOccurred = false;
    
    $db = new mysqli($servername, $username, $password, $database, $dbport);
    
    if(isset($_GET['user'])){
        if ($db->connect_error) {
            session_start();
            header("Location: /login");
            exit();
        }
        $query = "SELECT * FROM USERS WHERE USERNAME = '" . $_GET['user'] . "'";
            $result = $db->query($query);
            if($result != null){
                //do different stuff depending on permission
            }
    } elseif(is_array($_FILES['txtUploadFile']['error'])){
         
        foreach($_FILES['txtUploadFile']['error'] as $key => $value) {
            if($_FILES['txtUploadFile']['name'][$key] != '') {
                echo '<p><hr />Uploading File: '.$_FILES['txtUploadFile']['name'][$key].'</p>';
                if($value > 0) {
                    $isDocUploaded = false; //attachment was not submitted or an upload error occurred
                    $errorsOccurred = true;
                    switch($value) {    //check which error code was returned
                        case 1:
                            echo '<p style="color: rgb(178,34,34)">** Error: Attachment file is larger than allowed by the server.</p>';
                            break;
                        case 2:
                            echo '<p style="color: rgb(178,34,34)">** Error: Attachment file is larger than the maximum allowed - 100kb.</p>';
                            break;
                        case 3:
                            echo '<p style="color: rgb(178,34,34)">** Error: Attachment file was only partially uploaded.</p>';
                            break;
                        //case 4: echo 'No attachment file was uploaded. '; break;
                    }
                }
         
                //if an attachment document was uploaded, move the file to desired folder
                if($isDocUploaded && $_FILES['txtUploadFile']['name'][$key] != '') {
                
                    $uploadedFile = 'files/troops.csv'; //$_FILES['txtUploadFile']['name'][$key];
                    if(@is_uploaded_file($_FILES['txtUploadFile']['tmp_name'][$key])) //initial temp location of uploaded file
                    {
                        if(@!move_uploaded_file($_FILES['txtUploadFile']['tmp_name'][$key], $uploadedFile)) { //move the file to images folder
                            echo '<p style="color: rgb(178,34,34)"><br />**Error**: could not move '. $_FILES['txtUploadFile']['tmp_name'][$key]. 'to' . $uploadedFile . '<br /></p>';
                            $errorsOccurred = true;
                        } else {    //file was uploaded successfully
                            echo '<p style="color: rgb(0,128,0)"> File: '.$_FILES['txtUploadFile']['name'][$key].' was uploaded successfully</p>';
                        }
                    } else {
                        echo '<p style="color: rgb(178,34,34)">Error: '.$_FILES['txtUploadFile']['name'][$key].' was not uploaded correctly to temp area.</p>';
                        $errorsOccurred = true;
                    }
                }
                $isDocUploaded = true;  //reset to true for the next document
            }
        }   //end of Main foreach
     
        $message = "\r\nMVC Uploader - New files were uploaded - with UNKNOWN errors";
        if($errorsOccurred) {
            echo '<p><input type="button" value="Go back" onclick="window.history.back();" />'.
                '<a href="displayImages.php">Display Uploaded Files</a></p>';
            $message = "\r\nMVC Uploader - New files were uploaded - with errors";
        } else {    //at this point, the file was uploaded successfully
            //echo '<script type="text/javascript">window.location.href="displayImages.php"</script>';
        }
         
        echo '</div>';
        
        $query = "LOAD DATA LOCAL INFILE '/var/www/$uploadedFile' INTO TABLE TROOPS FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"' LINES TERMINATED BY '\r\n' IGNORE 1 LINES (NUMBER,ADDRESS,COMMENT,SCOUTMASTER_NAME,SCOUTMASTER_EMAIL,COMMITTEE_NAME,COMMITTEE_EMAIL,DISTRICT) "; 
	//This 'not allowed' error is probably caused by an issue with the default 'load data local' command being denied.  
	//maybe use mysqli::real_connect
        $result = $db->query($query);
            if($result == null){
                $testString = mysqli_error($db);
                //session_start();
                //header("Location: https://autoelect-mibzman.c9users.io/fail");
                //exit();
                //echo $testString . "\n";
            }
        $query = "SHOW ERRORS";
        $result = $db->query($query);
        $row = $result->fetch_row();
        echo $row[0] . $row[1] . $row[2];
	//echo $uploadedFile;
	
        
        
        //get all ordeal stuff
        $myInputs = $_POST["myInputs"];
        foreach ($myInputs as $eachInput) {
             echo $eachInput . "<br>";
        }
        
     }
    
    else{
        session_start();
            header("Location: /login");
            exit();
    } 
   
?>

<!DOCTYPE html>
<html>
<head>
    <!--  jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->
<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />

<!-- Bootstrap Date-Picker Plugin -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
</head>

<script>
    $(document).ready(function(){
		var date_input=$('input[name="troop1"]'); //our date input has the name "date"
		var date_input2=$('input[name="end"]'); //our date input has the name "date"
		var date_input3=$('input[name="myInputs[]"]');
		date_input.datepicker({
			format: 'mm/dd/yyyy',
			todayHighlight: true,
			autoclose: true,
		})
		date_input2.datepicker({
			format: 'mm/dd/yyyy',
			todayHighlight: true,
			autoclose: true,
		})
		date_input3.datepicker({
			format: 'mm/dd/yyyy',
			todayHighlight: true,
			autoclose: true,
		})
	})
	
	var counter = 1;
    var limit = 10;
    function addInput(divName){
         if (counter == limit)  {
              alert("You have reached the limit of adding " + counter + " inputs");
         }
         else {
              var newdiv = document.createElement('div');
              newdiv.innerHTML = "<input type='text' placeholder='MM/DD/YYY' name='myInputs[]'>";
              document.getElementById(divName).appendChild(newdiv);
              counter++;
         }
         var date_input=$('input[name="myInputs[]"]'); //our date input has the name "date"
		date_input.datepicker({
			format: 'mm/dd/yyyy',
			todayHighlight: true,
			autoclose: true,
		})
    }
</script>

<body>
<div class="bootstrap-iso">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="intro-message" style="padding-top: 10%">
                    <div id="regFormContainer" class="bar-colors-borders">
                        <h1 class="text-center" style="padding-bottom: 5%">Set Important Dates  TODO: generate schedule files for chron</h1>
                        <form class="form-horizontal text-center" action="console" method="post" onsubmit="return validateUploadFile();" enctype="multipart/form-data" >
                            <div class="form-group">
                                <label for="txtUploadFile[]" class='col-sm-5 control-label'>Troop File:</label>
                                <div class='col-sm-1 text-center'>
                                    <input type="file" name="txtUploadFile[]"/>
                                </div>
                            </div>
                            
                            
                            <div class="form-group">
                                <label class="col-sm-5 control-label" for="troop">Send Email to Scoutmasters:</label>
                                <div class='col-sm-1 text-center'>
                                    <input id="troop1" name="troop1" placeholder="MM/DD/YYY" type="text"/>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-5 control-label" for="troop2">Days until first reminder:</label>
                                <div class='col-sm-1 text-center'>
                                    <input name="troop2" type="number" value= "14"/>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-5 control-label" for="troop3">Days until second reminder:</label>
                                <div class='col-sm-1 text-center'>
                                    <input name="troop3" type="number" value= "2"/>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class='col-sm-5 control-label' for='troop'>Ordeal Date:</label>
                                <div class='col-sm-1 text-center' id="dynamicInput">
                                      <input type="text" placeholder='MM/DD/YYY' name="myInputs[]">
                                 </div>
                                 <input type="button" class="btn" value="Add a new ordeal" onClick="addInput('dynamicInput');">
                            </div>
                            <div class="form-group">
                                <label class="col-sm-5 control-label" for="ordeal1">Final Day of Election Cycle:</label>
                                <div class='col-sm-1 text-center'>
                                    <input id="troop1" name="end" placeholder="MM/DD/YYY" type="text"/>
                                </div>
                            </div>
                            
                            <button name="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
