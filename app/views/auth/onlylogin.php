<!DOCTYPE HTML>
<html>
<head>
<link rel="stylesheet" href="/css/chosennew.css" type="text/css" />
<link rel="stylesheet" href="/css/flick/jquery-ui-1.10.4.custom.min.css" type="text/css" />
<script src = "/js/jquery-2.1.0.min.js"> </script>
<script src = "/js/jquery-ui-1.10.4.custom.min.js"> </script>

</head>
<body>
    
	
   
	<div id = "auth">
             <form name = "auth" method = "POST" action = "<?php echo URL::to('auth').'/onlylogin' ?>">
	  <p class="mainlogin">Input login</strong></p>
  	<input type="text" class="form-control" id="inputSuccess" placeholder = "Login" name = "username">
	</div>


	
    </form>
</body>    
<script>
$( document ).ready(function() {
    $('#auth').dialog();
    $('#auth').dialog("option", "draggable", false );
	$('#auth').dialog("option", "modal", true );
	$('#auth').dialog("option", "closeOnEscape", false );
	$('div[class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix"]').hide();

});
</script>
    
