<?php
include 'header.php';
?>

<style>
table#table{
    margin-left:100px;
}



a.intable{
    margin-left:100px;
    
    
}
    
    
</style>

<div id="wrap3" style="width:50%;margin:0 auto;height:100%;">
    
    
<div id="wrap2">
   <div class="forstyle" style="width:100%;height:47px"></div>
    
    
<div id="wrap1"  class="vkmessage"  style="height:100%;">
<table id = "filetable">
<thead>
<tr>
<th style="width:30%">Дата</th>

<th style="width:70%" >Имя файла</th>
</tr>
</thead>
<tbody>
<?php
$cur_client_id = Auth::user()->id;
foreach(Request_attachment::where('client_id','=',$cur_client_id)->orderBy('created_at', 'desc')->get() as $item){
echo '<tr><td class="filefirstTD" ><h3 class = "date"> ' . date("j M Y", strtotime($item->created_at)) . '</h3></td>';
echo '<td class="filesecondTD"><a class="lastmessage"  href = "'. Url::to('client/show/'.$item->id) .'">' ;
 if(isset($item->filename)) echo  $item->filename ;
echo '</a></td>' ;
}


?>

</tbody>
</table>
</div>
</div>
    <div class="forstyle" style="width:100%;height:47px"></div>
</div>
<script >



$(document).ready(function() {
$('#filetable').dataTable({
     "iDisplayLength": 100;
    
});
} );
</script>
