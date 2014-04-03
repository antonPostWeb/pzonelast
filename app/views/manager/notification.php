<?php
include 'header.php';
?>
<link rel="stylesheet" href="/css/chosen111.css" type="text/css" />
<link rel="stylesheet" href="/css/jquery.dataTables.css" type="text/css" />

<script src = "/js/jquery.dataTables.min.js"> </script>
<script src = "/js/bootstrap.min.js"> </script>
<script src = "/js/chosen.jquery.min.js"> </script>
<style>
    p.note{
        
        color:#51749c;
        font-size:13px;
        margin-bottom:10px;
        
    }
    
</style>
<div id="wrap3" style="width:50%;margin:0 auto;height:600px;">
    <div id="wrap2">
        
            <div id="wrap1"  class="vkmessage"  style="height:600px;">
                <?php
                    $cur_user = Auth::user()->id;
                    foreach(Notification::where('user_id','=',$cur_user)->get() as $item){
                        echo '<div class = "note" >';
                        
                        echo 'Для пользователей:';
                        foreach(Notificationuser::where('notification_id','=',$item->id)->get() as $client){
                            
                            
                            
                            $client_id = $client->client_id;
                            
                            $cur_client = User::find($client_id);
                            
                            $firstname = '';
                            $lastname = '';
                            
                            if(isset($cur_client->firstname)){
                                
                                $firstname = $cur_client->firstname;
                                
                            }
                            
                            if(isset($cur_client->lastname)){
                                
                                $lastname = $cur_client->lastname;
                                
                            }
                            
                            $fio = $firstname . '   ' . $lastname;
                            
                            echo $fio . '</br>';
                        }
                            if(isset($item->text)){
                                echo '<p class="note" >' . $item->text . '</p>';
                            }
                            
                            echo '<div class="deletenote">';
                                echo '<a class="deletenote" href = "'  .Url::to('manager/delnotification') . '/' . $item->id . '" > Удалить заметку </a>';
                            
                            echo '</div>';
                        echo '</div>';
                    }
                ?>
            </div>
        
    <div class="forstyle" style="position:relative;width:100%;height:auto;">
        <div  class="form-group" style = "margin-left:15%;" name = "newmessage">
            <form id="notes_form" method="POST" action = "<?php echo  Url::to('manager/notification') ?>" >
            <div>
			<div style="display:block;width: 100%;position: relative;">
            <select data-placeholder="Choose a Country..." class="chosen-select" multiple style="width:84%;" name="tagsSelect[]"  tabindex="4">
            <option value=""></option> 
            <?php
            foreach (User::where('role_id','=',4)->get() as $item) {
              echo '<option value="'.$item->id.'" selected><p class="mainlogin">' . $item->firstname . $item->lastname . '</p></option>';
            }
            ?>
            </select> 
			</div>
		</div>
                <textarea name = "text" placeholder = "Insert note" style="width:83.5%;" rows="3" > </textarea>
                <br>
               
                    <button type="submit" >  Сохранить обьявление </button>
               
            </form>
        </div>
    </div>
   </div>
</div>
<script>
     $(window).load(function(){
            $(".vkmessage").mCustomScrollbar();
			$(".vkmessage").mCustomScrollbar("scrollTo","last");
        });
        
        
  $(function(){ 

    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }});
</script>
</script>


