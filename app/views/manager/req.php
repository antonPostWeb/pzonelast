<!DOCTYPE HTML>
<html>
<head>
<link rel="stylesheet" href="/css/bootstrap.css" type="text/css" />
<link rel="stylesheet" href="/css/jquery.dataTables.css" type="text/css" />
<script src = "/js/jquery-2.1.0.min.js"> </script>
<script src = "/js/jquery.dataTables.min.js"> </script>
<style>
select[name="table_length"]{
display: none; 
}
div#fortable {
width:70%;
margin-left:15%;
margin-top:5%;
}
</style>

</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top">
<div class="navbar-inner">
<div class="container">
<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</a>
<a class="navbar-brand" href="<?php echo URL::to('manager')?>">Главная</a>

<ul  class="nav navbar-nav">
<li ><a href="<?php echo URL::to('manager').'/messages' ?>">Обратная связь</a></li>
<li><a href="<?php echo URL::to('auth').'/logout' ?>">Выход</a></li>

</ul>
</li>
</ul>

</div> 
</div>
</div>
</div>
<div id = "fortable">
<table id = "table">
<thead>
<tr>
<th style="width:20%">Дата</th>
<th>Заявка</th>
<th>Имя файла</th>
</tr>
</thead>
<tbody>
<?php
foreach(Request_attachment::orderBy('created_at', 'desc')->where('req_id','=',$req_id)->get() as $item){
echo '<tr><td>' . date("j M Y", strtotime($item->created_at)) . '</td>';
$name = Req::find($req_id)->name;
echo '<td>' . $name . '</td>';
echo '<td><a href = "'. Url::to('manager/show/'.$item->id) .'">' . $item->filename . '</td>' ;
}


?>

</tbody>
</table>
</div>
<script >

$(document).ready(function() {
$('#table').dataTable();
} );
</script>
