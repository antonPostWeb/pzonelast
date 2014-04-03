<?php
include 'header.php';
?>

<style>
    p.note{
        
        color:#51749c;
        font-size:13px;
        margin-bottom:10px;
        
    }
    
</style>
<div id="wrap3" style="width:50%;margin:0 auto;height:600px;">
    <div id="wrap2">
        
            <div id="wrap1"  class="vkmessage"  style="height:500px;">
                <?php
                    $cur_user = Auth::user()->id;
                    foreach(Note::where('user_id','=',$cur_user)->get() as $item){
                        echo '<div style = "margin-top:5%;background:#F7F7F7;margin-top:20px;min-height:70px;" class = "note" >';
                            if(isset($item->text)){
                                echo '<p class="note" >' . $item->text . '</p>';
                            }
                             echo '<div class="deletenote">';
                                echo '<a class="deletenote" href = "'  .Url::to('client/deletenote') . '/' . $item->id . '" > Удалить заметку </a>';
                            
                            echo '</div>';
                        echo '</div>';
                    }
                ?>
            </div>
        
    <div class="forstyle" style="width:600px;height:94px;">
        <div  class="form-group" style = "margin-left:15%;" name = "newmessage">
            <form id="notes_form" method="POST" action = "<?php echo  Url::to('client/newnote') ?>" >
                <textarea name = "newnote" placeholder = "Insert note" style="width:83.5%;" rows="3" > </textarea>
                <br>
                <div class="button_blue button_wide button_big" id="quick_auth_button" style="width:150px;top:0px;float:left;">
                    <button class="btn btn-primary btn-xs" type="submit" > Отправить </button>
                </div>    
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
</script>


