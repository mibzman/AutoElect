//leftover for testing the inserting new date elements

<!-- Special version of Bootstrap that only affects content wrapped in .bootstrap-iso -->
<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" /> 

<!--Font Awesome (added because you use icons in your prepend/append)-->
<link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />

<!-- Inline CSS based on choices in "Settings" tab -->
<style>.bootstrap-iso .formden_header h2, .bootstrap-iso .formden_header p, .bootstrap-iso form{font-family: Arial, Helvetica, sans-serif; color: black}.bootstrap-iso form button, .bootstrap-iso form button:hover{color: white !important;} .asteriskField{color: red;}</style>



<div class="bootstrap-iso">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="intro-message" style="padding-top: 10%">
                    <h1 style="padding-bottom: 5%">Set Important Dates</h1>
                    <div id="regFormContainer" class="bar-colors-borders">
                        <form class="form-horizontal text-center" action="console" method="post" >
                            <input class="form-control" id="date" name="date" placeholder="MM/DD/YYYY" type="text"/>
                            <input class="form-control" id="date2" name="date" placeholder="MM/DD/YYYY" type="text"/>
                            <input class="form-control" id="date3" name="date" placeholder="MM/DD/YYYY" type="text"/>
                            
                            <button name="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Extra JavaScript/CSS added manually in "Settings" tab -->
<!-- Include jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Include Date Range Picker -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

<script>
	$(document).ready(function(){
		var date_input=$('input[name="date"]'); //our date input has the name "date"
		var date_input2=$('input[name="date2"]'); //our date input has the name "date"
		var date_input3=$('input[name="date3"]'); //our date input has the name "date"
		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			format: 'mm/dd/yyyy',
			//container: container,
			todayHighlight: true,
			autoclose: true,
		})
		date_input2.datepicker({
			format: 'mm/dd/yyyy',
			//container: container,
			todayHighlight: true,
			autoclose: true,
		})
		date_input3.datepicker({
			format: 'mm/dd/yyyy',
			//container: container,
			todayHighlight: true,
			autoclose: true,
		})
	})
</script>