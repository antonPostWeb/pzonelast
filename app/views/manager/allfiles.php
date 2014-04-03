<?php
include 'header.php';
?>

<script type="text/javascript" src="http://scriptjava.net/source/scriptjava/scriptjava.js"></script>

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

<div id="wrap3" style="width:auto;margin:0% 25% 10% 25%;height:auto;">
    
    
<div id="wrap2">
   <div class="forstyle" style="width:100%;height:47px"></div>
    
    
<div id="wrap1"  class="vkmessage" style="height:auto;padding:15px 5% 15px;" id="fortable">
    <table id="maintable" >
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
$all_clients = ClientManager::where('manager_id','=',$manager_id)->get();
                            
                            foreach ($all_clients as $item){
                                
                                if(isset($item->client_id)){
                                    $client_id = $item->client_id;
                                }
                                
                                $cur_client = User::find($client_id);
                                $firstname = '';
                                $lastname = '';
                                
                                if (isset($cur_client->firstname)){
                                    
                                    $firstname = $cur_client->firstname;
                                    
                                }
                                
                                
                                if (isset($cur_client->lastname)){
                                    
                                    $lastname = $cur_client->lastname;
                                    
                                }
                                
                                $fio = $firstname . '  ' . $lastname;
                                
				$background = 'background:#f5fafc;';
                                $background = 'background:white;';
                                
                                
                                 
                                        
                                
                                
                               
                                        
                                echo '<tr superattr="chat"   id="' . $client_id  . '">';
                                    echo '<td class="firstTD">';
                                           echo '<div id="author"  >';
                                           
                                            echo '<div id="divforphoto" >';
                                            
                                                        echo '<div  class="photoImage" >';
                                                        echo '<img id="avatar" src="'.URL::to('../images/avatars/client.jpg').'" width=60 height=60 top:0px >';
                                                        echo '</div>';
                                           
                                           echo '</div>';
                                            echo '<div id="author_name" >';
                                                        echo '<h3 class = "fio" >' . $fio . '</h3>';
                                                       
                                                        
                                            echo '</div>';
                                         echo '</div>';
                                    echo '</td>';
                                    echo '<td class="secondTD" >';
                                        
                                        if(!empty($lastmessage->text)){
                                            $lastmessage = $lastmessage->text;
                                        } else {
                                            
                                            $lastmessage = 'Сообщений нет';
                                            
                                        }
						

                                            
                                             
						 echo '<a class="lastmessage" href = "' . Url::to('manager/files') . '/' . $client_id . '"> Файлы </a>';
                                            
                                     
                                    echo '</td>';
                                echo '</tr>';
                                
                            }
                        
                     


?>    
        </tbody>
        </table>
</div>

</div>
</div>

</body>
<script >
    

	
</script>
