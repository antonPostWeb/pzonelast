<!DOCTYPE HTML>
<html>
<head>
<link rel="stylesheet" href="/css/chosennew.css" type="text/css" />
<link rel="stylesheet" href="/css/flick/jquery-ui-1.10.4.custom.min.css" type="text/css" />
<script src = "/js/jquery-2.1.0.min.js"> </script>
<script src = "/js/jquery-ui-1.10.4.custom.min.js"> </script>


</head>
<body>
    <div  id = "auth">
    <form name = "auth" method = "POST" action = "<?php echo URL::to('auth').'/passandlogin' ?>">

     <p class = "mainlogin">Input password</strong></p>
    <input class="form-control" id="inputSuccess" type="password" name = "password" placeholder = "password" />
    <?php
	if (isset($username))
	{
		echo '<input type="hidden" name = "username" value = '. $username .' />';
		
		
		
	} else {
	echo 'Hello World'; // Ошибку 404 пропишем
	
	}
    ?>
	</div>
    </form>
</body>
<script>
$( document ).ready(function() {
    $('#auth').dialog();
    $('#auth').dialog("option", "draggable", false );
	$('div[class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix"]').hide();
});

</script>



