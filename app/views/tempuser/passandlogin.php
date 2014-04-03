<!DOCTYPE HTML>
<html>
<head>

<link rel="stylesheet" href="/css/flick/jquery-ui-1.10.4.custom.min.css" type="text/css" />
<script src = "/js/jquery-2.1.0.min.js"> </script>
<script src = "/js/jquery-ui-1.10.4.custom.min.js"> </script>


</head>
<style>

input[type="submit"]{
margin-left:185px;
}
h2,h3{
text-align:center;

}
</style>
<body>
    <div class="jumbotron" id = "auth">
    <form name = "auth" method = "POST" id = "form" action = "<?php echo URL::to('tempuser').'/createnewuser' ?>">
	<?php
	if((isset($login)) AND (isset($email))){
	echo '<input type="hidden" value = '. $login .' name = "login">';
	echo '<input type="hidden" value = '. $email .' name = "email">';
	echo '<input type="hidden" value = '. $manager_id .' name = "manager_id">';
	
	} else {
	return Redirect::to('tempuser/onlylogin');
	}
	
	?>
<div class="form-group has-success">
  <label class="control-label" for="inputSuccess">Ваше   имя</label>
  <input type="text" class="form-control" id="inputSuccess" name = "firstname" placeholder = "Имя">
</div>
<div class="form-group has-success">
  <label class="control-label" for="inputSuccess">Ваша   фамилия</label>
  <input type="text" class="form-control" id="inputSuccess" name = "lastname" placeholder = "Фамилия">
</div>
	<div class="form-group has-success">
  <label class="control-label" for="inputSuccess">Введите пароль</label>
  <input type="password" class="form-control" id="inputSuccess" name = "password" placeholder = "password">
</div>
<div class="form-group has-success">
  <label class="control-label" for="inputSuccess">Введите пароль</label>
  <input type="password" class="form-control" id="inputSuccess" name = "repassword" placeholder = "password">
</div>
	<br>
	<button type="submit" class="btn btn-success"> Отправить </button>
    </form>
</body>
<script>
$( document ).ready(function() {
    $('#auth').dialog();
    $('#auth').dialog("option", "draggable", false );
	$('#auth').dialog("option", "width", 500	);

	//validation
	$( "#form" ).submit(function( event ) {
	val1 = $('[name="password"]').val();
	val2 = $('[name="repassword"]').val();
	if (val1 != val2) {
	alert ('Пароли не совпадают');
	event.preventDefault();
	}  else {
	
	}
	
	
});

	
	
	
	});

</script>



