<?php

class ClientController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public $restful = true;
	
	public function get_index()
	{
	            $cur_client_id = Auth::user()->id;
	
	            Foreach(Message::where('client_id','=',$cur_client_id)->get() as $item){
	                $item->client_read = 1;
	                $item->save();
	                
	                
	            }
	
                $cur_client_id = Auth::user()->id;
                $user = User::find($cur_client_id);
                $user->last_activity2 = time();
                $user->save();
                
	
		
		
		return View::make('client/messages');
		
            
	
				
	}

        
        public function get_note()
	{
	
	
	    $cur_client_id = Auth::user()->id;
        $user = User::find($cur_client_id);
        $user->last_activity2 = time();
        $user->save();
        
        return View::make('client/note');
				
	}
        
        
        public function get_files()
	{
	
	    $cur_client_id = Auth::user()->id;
        $user = User::find($cur_client_id);
        $user->last_activity2 = time();
        $user->save();        
	
		return View::make('client/files');
				
	}
        
        
        
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	 
	
	 
	
	 
	 
	 
	
	 
	 public function post_newmessage()
	{
	    
	    $cur_client_id = Auth::user()->id;
        $user = User::find($cur_client_id);
        $user->last_activity2 = time();
        $user->save();
        
        
	    $req_id=Input::get('requests');
	    
	    return View::make('client/messages')
		      ->with('req_id',$req_id);
	} 
        
         public function post_newnote()
	{
	    
        
	    $cur_user_id = Auth::user()->id;
	    $user = User::find($cur_user_id);
        $user->last_activity2 = time();
        $user->save();
        
        $newnote = new Note;
        $newnote->user_id = $cur_user_id;
        $newnote->text = Input::get('newnote');
        $newnote->save();
        return Redirect::to('client/note');
	} 
        
        
        public function post_createmessage()
	{
	
	    $cur_client_id = Auth::user()->id;
        $user = User::find($cur_client_id);
        $user->last_activity2 = time();
        $user->save();
        
	    $manager_id = Input::get('manager_id');
        $client_id = Input::get('client_id');
        $cur_client = User::find($client_id);
        $role_id = $cur_client->role_id;

	    $message = new Message;
	    $message->text = Input::get('sms');
	    $message->req_id = 0;
	    $message->role_id = $role_id;
        $message->user_id = $client_id;
	    $message->client_id = $client_id;
	    $message->manager_id = $manager_id;
	    $message->save();
	
	    $role_id = User::find($client_id)->role_id;
	
	
		if (Input::hasFile('file'))
			{
                    $i=0;
                    foreach(Input::file('file') as $file){
			$path = app('path');
			$token = Input::get('token');	
			$path = $path. '/uploads/';
			if (!file_exists($path = $path . $token . '/')){
			mkdir($path);
			}
			$filename = $name = $file->getClientOriginalName();
			$uploadfile = $path . $filename;
			$all_filename = explode('.', $filename, 10000);
			$extension = end($all_filename);
			$curfilename = rand() . rand();
			$user_id = Auth::user()->id;
                        
			$pass = User::find($user_id)->password;
			Crypter::encryptFile($_FILES['file']['tmp_name'][$i], $uploadfile,$pass);
			rename($path . $filename, $path . $curfilename);
			echo $token;
			$message_id = DB::table('messages')->max('id');
                        
                        $manager = ClientManager::where('client_id','=',$user_id)->first();
                        $manager_id = $manager->id;
                        
                        
                        $req_attach = new Request_attachment;
			$req_attach->req_id = 0;	
			$req_attach->upload_token = $token;	
			$req_attach->filename = $name;
			$req_attach->curfilename = $curfilename;
			$req_attach->extension = $extension;
			$req_attach->role_id = $role_id;
			$req_attach->message_id = $message_id;
                        $req_attach->user_id = $user_id;
                        $req_attach->client_id = $user_id; //user_id - это client_id, потому что это контроллер клиента
                        $req_attach->manager_id = $manager_id;
			$req_attach->save();
                        $i++;
                    }
	}
	//return Redirect::to('client/tempfunction/'.$req_id);
		      
	} 
	
	

        
          public function get_deletenote($note_id)
                    
        {
	        
	        $cur_client_id = Auth::user()->id;
            $user = User::find($cur_client_id);
            $user->last_activity2 = time();
            $user->save();
            
            $curnote = Note::find($note_id);
            $curnote->delete();
            
		    return Redirect::to('client/note');
				
	}
        
        

		public function post_ajaxsms()
	{
	    
	    
	    $cur_client_id = Auth::user()->id;
        $user = User::find($cur_client_id);
        $user->last_activity2 = time();
        $user->save();
	    
	    
	
	    $manager_id = Input::get('manager_id');
	    $max_id = Input::get('max_id');
	    $client_id = Input::get('client_id');
        
        
        
        $item = Message::where('manager_id','=',$manager_id)->where('client_id','=',$client_id)->where('id','>',$max_id)->first();
        
        if(isset($item->user_id)){
                                    $user_id = $item->user_id;
                                    
                                    
                                    
                                    
                                    
                               
                               $text = '';
                               
                                $cur_user = User::find($user_id);
                                if(isset($cur_user->role_id)){
                                    
                                    $role_id = $cur_user->role_id; 
                                    
                                    
                                }
                                
                                
                                $firstname = '';
                                $lastname = '';
                                
                                  $online = "offline";
                                if(isset($cur_user->last_activity2)){
                                    
                                    $last_activity = $cur_user->last_activity2;
                                    
                                    $now = time();
                                    
                                    $rezult = $now - $last_activity;
                                    
                                            if($rezult < 900){
                                                
                                                $online = "Online";
                                                
                                            }
                                    
                                    
                                    
                                    
                                }
                                
                                
                                
                                if (isset($cur_user->firstname)){
                                    
                                    $firstname = $cur_user->firstname;
                                    
                                }
                                
                                
                                if (isset($cur_user->lastname)){
                                    
                                    $lastname = $cur_user->lastname;
                                    
                                }
                                
                                $fio = $firstname . '  ' . $lastname;
                                
				$background = 'background:#f5fafc;';
                                $background = 'background:white;';
                                
                                
                                 
                                        
                                
                                
                               
                                        
                                $text = $text . '<tr superattr="chat"   id = "'.$item->id.'">';
                                   $text = $text . '<td class="firstTD" >';
                                         $text = $text . '<div id="author"  >';
                                           
                                          $text = $text . '<div id="divforphoto"  >';
                                           $text = $text . '<div  class="photoImage"  >';
                                                         if($role_id == 4){
                                                             
                                                        $text = $text . '<img  src="'.URL::to('../images/avatars/client.jpg').'" width=60 height=60 top:0px >';
                                                        
                                                        } else {
                                                            
                                                            $text = $text . '<img  src="'.URL::to('../images/avatars/manager.jpg').'" width=60 height=60 top:0px >';
                                                        }
                                                        
                                                        $text = $text . '</div>';
                                                        $text = $text . '</div>';
                                           
                                           
                                            $text = $text . '<div id="author_name" style="margin-left:60px;width:150px;" >';
                                                        $text = $text . '<h3 class = "fio" >' . $fio . '</h3>';
                                                        $text = $text . '<h3 class = "date" >' . $online . '</h3>';
                                                       $text = $text . '<h3 class = "date">';
                                                            if(isset($item->created_at)){
                                                                
                                                              $text = $text . date("j M H:i:s ", strtotime($item->created_at));
                                                                
                                                            }
                                                        
                                                        
                                                       $text = $text . '</h3>';
                                                        
                                            $text = $text . '</div>';
                                         $text = $text . '</div>';
                                 
                                    $text = $text . '<td class="secondTD" >';
                                    
                                        if(isset($item->text)){
                                            $cur_message_text = $item->text;
                                        } 
						

                                            
                                             
						 $text = $text .'<p class="message"  >' . $cur_message_text . '</p>';
                                                 
                                                 $maybe_we_have_file = Request_attachment::where('message_id','=',$item->id)->get();
                                                            if(isset($maybe_we_have_file)){
                                                                    foreach($maybe_we_have_file as $file){
                                                                     $text = $text . '<br><a class="file" href = "'. Url::to('manager/show/'.
                                                                    $file->id) .'"><strong>File:</strong>' . 
                                                                    $file->filename . '</a>';	
                                                                    }    
                                                            }
                                                 
                                                 
                                            
                                         
                                     $text = $text . '</td>';
                                 $text = $text . '</tr>';
                                
           
            
            
    
  
		
       
        }
	$messages_array['text'] = $text;
        $messages_array['lastID'] = $item->id;
        
	return json_encode($messages_array);
	}
	
	
	 
	 
	 
	

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function get_show($id)
	{
	    $cur_client_id = Auth::user()->id;
        $user = User::find($cur_client_id);
        $date = date('Y-m-d H:i:s');
        $user->last_activity2 = time();
        $user->save();
        
		$cur_file = Request_attachment::find($id);
		$curfilename = $cur_file->curfilename;
		$filename = $cur_file->filename;
		$token = $cur_file->upload_token;
		$path = app('path');
		$path = $path. '/uploads/';
		$path = $path . $token . '/' ;
		rename($path . $curfilename, $path . $filename);
		
		$req_id = $cur_file->req_id;
		
		
		$cur_req = Req::find($req_id);
		
		$user_id = $cur_file->user_id;
	
		
	
		$pass = User::find($user_id)->password;
		
		
		
		Crypter::decryptFileAndReturn($path . $filename,$filename,$pass); 
		
		rename($path . $filename, $path . $curfilename);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
