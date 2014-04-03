<?php
include 'header.php';
?>
    <style>
    #table {
        border-collapse: collapse;
        !important;
        
        
    }
 #wrap1 #table tr[superattr="chat"] {
margin-left:10%;
border: 1px solid #d0dae1;
margin-top:10%;
!important;

}

 h4 {

border-color: white;
!important;
}

div#author{
    
    border-color:white;
    
}    
</style>
<script type="text/javascript" src="http://scriptjava.net/source/scriptjava/scriptjava.js"></script>
<div id="wrap3" style="position:relative;width:50%;margin:0 auto;height:600px;">
    
    
<div id="wrap2">
   <div class="forstyle" style="width:auto;height:47px"></div>
    
    
<div id="wrap1"  class="vkmessage" style="position:relative;height:600px;margin:0 auto;">
     <table id="table" style="width:100%">
        <thead>
            <tr style="width:100%">
                <th>
                    
                </th>
                <th>
                    
                </th>
            </tr>
        </thead>
        <tbody>

    
    
<?php


$manager_id = Auth::user()->id;
$all_messages = Message::where('manager_id','=',$manager_id)->where('client_id','=',$client_id)->orderBy('created_at','ASC')->get();
                            
                            foreach ($all_messages as $item){
                                
                                
                                if(isset($item->user_id)){
                                    $user_id = $item->user_id;
                                }
                                
                                $cur_user = User::find($user_id);
                                $firstname = '';
                                $lastname = '';
                                
                                if (isset($cur_user->firstname)){
                                    
                                    $firstname = $cur_user->firstname;
                                    
                                }
                                
                                $online = "offline";
                                
                                if (isset($cur_user->online)){
                                    
                                    $on = $cur_user->online;
                                    
                                    if($on == 1){
                                    
                                    $online = "online";
                                    
                                    } else {
                                        
                                        $online = "offline";
                                        
                                    }
                                    
                                }
                                
                                if (isset($cur_user->lastname)){
                                    
                                    $lastname = $cur_user->lastname;
                                    
                                }
                                
                                $fio = $firstname . '  ' . $lastname;
                                
				$background = 'background:#f5fafc;';
                                $background = 'background:white;';
                                
                                  $role_id = $cur_user->role_id;
                                 
                                        
                                
                                
                               
                                        
                                echo '<tr superattr="chat"   id = "'.$item->id.'">';
                                    echo '<td class="firstTD" >';
                                     echo '<div id="author"  >';
                                           echo '<div id="divforphoto"  >';
                                           
                                            
                                                        echo '<div class="photoImage" >';
                                                       if($role_id == 4){
                                                        echo '<img  src="'.URL::to('../images/avatars/client.jpg').'" width=60 height=60 top:0px >';
                                                        } else {
                                                            
                                                            echo '<img  src="'.URL::to('../images/avatars/manager.jpg').'" width=60 height=60 top:0px >';
                                                        }
                                             echo '</div>';
                                             echo '</div>';
                                           
                                           
                                            echo '<div id="author_name" style="width:150px;" >';
                                                        echo '<h3 class = "fio" >' . $fio . '</h3>';
                                                        echo '<h3 class = "date" >' . $online . '</h3>';
                                                        echo '<h3 class = "date" >';
                                                            if(isset($item->created_at)){
                                                                
                                                                echo date("j M H:i:s ", strtotime($item->created_at));
                                                                
                                                            }
                                                        
                                                        
                                                        echo '</h3>';
                                                        
                                            echo '</div>';
                                         echo '</div>';
                                    echo '</td>';
                                    echo '<td class="secondTD">';
                                        
                                        if(isset($item->text)){
                                            $text = $item->text;
                                        } 
						

                                            
                                             
						 echo '<p class="message"  >' . $text . '</p>';
                                                 
                                                 $maybe_we_have_file = Request_attachment::where('message_id','=',$item->id)->get();
                                                            if(isset($maybe_we_have_file)){
                                                                    foreach($maybe_we_have_file as $file){
                                                                    echo '<br><a class="file" href = "'. Url::to('manager/show/'.
                                                                    $file->id) .'"><strong>File:</strong>' . 
                                                                    $file->filename . '</a>';	
                                                                    }    
                                                            }
                                                 
                                                 
                                      
                                    echo '</td>';
                                echo '</tr>';
                                
                            }
                        
      

?>    

                     </tbody>
        </table>

</div>
   <div class="forstyle" style="width:auto;height:94px;">
       <div  class="form-group" style = "margin-left:15%;" name = "newmessage">
           
<form method = "POST" action = "<?php echo Url::to('manager/createmessage')?>" name = "sms" id="newmessage" enctype="multipart/form-data" >
<textarea rows="3" placeholer= "Сообщение" id="newsms" class="form-control input-sm" style="width:83.5%;"  id="inputSmall" name = "sms" > </textarea>
<input type = "hidden" name = "client_id" value = "<?php echo $client_id ;?>" />
 <div class="button_blue button_wide button_big" id="quick_auth_button" style="width:150px;top:0px;float:left;">
<button type = "submit" class="btn btn-primary btn-xs" onClick="SendForm();" > Отправить </button>
<input type="hidden" value = "<?php echo md5(uniqid(mt_rand(), true)) ?>" name = "token">
</div>
<div class="label" style="position:relative;margin-top:0px;right:0px;margin-left:100px;">
    <a  href="javascript:void(0);" id="foruploadfiles" > Прикрепить </a>
    <input type="file" name="file[]" style="display:none;" size="60" id="forfile"  multiple="multiple" />
    
</div>
</form>
</div>
       </div>
</div>
</div>

</body>
<script >
    $(document).ready(function() {
   
            $(".vkmessage").mCustomScrollbar();
            var max_id = $('tr[superattr="chat"]').last().attr('id');
            
	$(".vkmessage").mCustomScrollbar("scrollTo","#"+max_id);
        $(".vkmessage").mCustomScrollbar("scrollTo","#"+max_id);
       
    });
    
        function SendForm() {
                //отправка формы на сервер
                $$f({
                        formid:'newmessage',//id формы
                        url:"<?php echo Url::to('manager/createmessage')?>"//адрес на серверный скрипт, такой же как и в форме
                });
                 $('#newsms').val('');
		$('input[name="file"]').val('');
                
        }
    




	$('a#foruploadfiles').click(function () {
            
            $('input#forfile').click();
            
        })



	 
 var timer = setInterval(function() { 
	 var manager_id = <?php echo $manager_id ?>;
       	var client_id = "<?php echo $client_id?>";
	 var max_id = $('tr[superattr="chat"]').last().attr('id');
       // alert(max_id);

		$.ajax({
		type: "POST",
		url: "<?php echo Url::to('manager/ajaxsms')?>",
		data:{
		"max_id":max_id,
		"manager_id":manager_id,
		"client_id":client_id
		},
		success: function(data){
             if(data.length != 0){
                
            		var obj = JSON.parse(data);
                	var text = obj.text;
                        var lastID = obj.lastID;
                     
                        $('table#table').append(text);
                        
                        $(".vkmessage").mCustomScrollbar("update");
                        
                        
                        $(".vkmessage").mCustomScrollbar("scrollTo","#"+lastID);
                    }
                
  		},
		});
	
	 }, 1000);
 
$('[name = "newmessage"]').submit(function(e) {
	 e.preventDefault();
});	
	






</script>



