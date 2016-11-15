
<?php
    //THE FORM THAT GETS SENT TO SCOUTMASTERS
    
    //require "header2.php";
    $servername = getenv('IP');
    $username = "autoelect";
    $password = "elengomat";
    $database = "AUTOELECT";
    $dbport = 3306;
    $isDocUploaded = true; //initialise flag that says whether jpg was uploaded
    $errorsOccurred = false;
    
    $db = new mysqli($servername, $username, $password, $database, $dbport);
    
    if(isset($_GET['troop'])){
        if ($db->connect_error) {
            session_start();
            header("Location: /formError");
            exit();
        }
        $query = "SELECT * FROM USERS WHERE USERNAME = '" . $_GET['user'] . "'";
            $result = $db->query($query);
            if($result != null){
                //do different stuff depending on permission
            }
    }else{
        session_start();
            header("Location: /formError");
            exit();
    } 
    
?>

<!DOCTYPE html>
<html>
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


<script>
    $(document).ready(function(){
		var date_input=$('input[name="date"]'); //our date input has the name "date"
		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			format: 'mm/dd/yyyy',
			//container: container,
			todayHighlight: true,
			autoclose: true,
		})
	})
	
	var counter = 2;
    var limit = 100;
    function addScout(divName){
         if (counter == limit)  {
              alert("You have reached the limit of adding " + counter + " inputs");
         }
         else {
              var newdiv = document.createElement('div');
              newdiv.style = "padding-top:' 1%";
              newdiv.className = "form-group"
              newdiv.innerHTML = "<label class='col-sm-5 control-label' for='myInputs[]'>Scout #"+ counter +":</label><div class='col-sm-1 text-center' id='dynamicInput'><input type='text' placeholder='Scout&quot;s Name' name='names[]'><input type='text' placeholder='Scout&quot;s Email' name='scoutEmails[]'><input type='text' placeholder='Parent&quot;s Email' name='parentEmails[]'></div>";
              document.getElementById(divName).appendChild(newdiv);
              var divLength =  document.getElementById('scoutInput').clientHeight;
              counter++;
              window.scrollBy(0, divLength + (divLength/5));
         }
    }
    
    function addAdult(divName){
         if (counter == limit)  {
              alert("You have reached the limit of adding " + counter + " inputs");
         }
         else {
              var newdiv = document.createElement('div');
              newdiv.style = "padding-top:' 1%";
              newdiv.className = "form-group"
              newdiv.innerHTML = "<label class='col-sm-5 control-label' for='myInputs[]'>Adult #"+ counter +":</label><div class='col-sm-1 text-center' id='dynamicInput'><input type='text' placeholder='Cannidate&quot;s Name' name='names[]'><input type='text' placeholder='Cannidate&quot;s Email' name='adultEmails[]'></div></div>";
              document.getElementById(divName).appendChild(newdiv);
              var divLength =  document.getElementById('adultInput').clientHeight;
              counter++;
              window.scrollBy(0, divLength + (divLength/3));
         }
    }
</script>

<body>
<div class="bootstrap-iso">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="intro-message" style="padding-top: 10%">
                    
                    <h1 class="text-center" >Welcome to AutoElect!</h1>
                    <h3 class="text-center" style="padding-bottom: 5%">TODO: generate schedule files for chron</h3>
                    <div id="regFormContainer" class="bar-colors-borders">
                        <form class="form-horizontal text-center" action="console" method="post" onsubmit="return validateUploadFile();" enctype="multipart/form-data" >
                                <div class="form-group">
                                    <label class="col-sm-5 control-label" for="troop">Date to hold your election:</label>
                                    <div class='col-sm-1 text-center'>
                                        <input id="date" name="date" placeholder="MM/DD/YYY" type="text"/>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    
                                    <label class="col-sm-5 control-label" for="end">Meeting Address:</label>
                                    <div class='col-sm-1 text-center'>
                                        <input id="end" name="address" type="text"/>
                                    </div>
                                </div>
                                
                                
                                <div class="form-group">
                                    <label class="col-sm-5 control-label" for="troop2">Number of active scouts:</label>
                                    <div class='col-sm-1 text-center'>
                                        <input name="troop2" type="number"/>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-5 control-label" for="troop3">Number of scouts that normially attend meetings:</label>
                                    <div class='col-sm-1 text-center'>
                                        <input name="troop3" type="number"/>
                                    </div>
                                </div>
                                
                                <div id = ScoutDiv>
                                    <div class="form-group">
                                        <label class='col-sm-5 control-label' for='myInputs[]'>Elegiable Scouts:</label>
                                        <div class='col-sm-1 text-center' id='scoutInput'>
                                              <input type='text' placeholder='Scout&quot;s Name' name='names[]'>
                                              <input type='text' placeholder='Scout&quot;s Email' name='scoutEmails[]'>
                                              <input type='text' placeholder='Parent&quot;s Email' name='parentEmails[]'>
                                         </div>
                                         
                                    </div>
                                    
                                </div>
                                
                                <div class= "form-group text-center">
                                    <input type="button" class="btn " value="Add a new scout" onClick="addScout('ScoutDiv');">
                                </div>
                                
                                <div id = AdultDiv>
                                    <div class="form-group">
                                        <label class='col-sm-5 control-label' for='myInputs[]'>Selected Adults:</label>
                                        <div class='col-sm-1 text-center' id='adultInput'>
                                              <input type='text' placeholder='Cannidate&quot;s Name' name='names[]'>
                                              <input type='text' placeholder='Cannidate&quot;s Email' name='adultEmails[]'>
                                         </div>
                                    </div>
                                    
                                </div>
                                
                                <div class= "form-group text-center">
                                    <input type="button" class="btn " value="Add a new Adult Cannidate" onClick="addAdult('AdultDiv');">
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
