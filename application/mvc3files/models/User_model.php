<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User_model extends CI_model {
	public function language() {
		return $this->db->from('language')->get();
	}
	public function langunamebycode($code) {
		$query = $this->db->from('language')->where('code', $code)->get()->result();
		if(isset($query[0]->language)){
		    return $query[0]->language;
		}
	}
	public function gener() {
		return $this->db->select('gener.*, COUNT(stories.genre) as gstorycount')->from('gener')
		    ->join('stories','gener.id = stories.genre','left')->group_by('gener.id')->order_by('gstorycount','DESC')->get();
	}
	public function genername($genername) {
	    $gener_name = preg_replace('/-/', ' ', $genername);
		$query =  $this->db->select('id')->from('gener')->where('gener.gener',$gener_name)->limit(1)->get()->result();
		if(isset($query[0]->id) && !empty($query[0]->id)) {
		    return $query[0]->id;
		}
	}
	public function communityname($communame) {
	    $language = $this->langshortname($this->uri->segment(1));
	    $community_name = preg_replace('/-/', ' ', $communame);
		$query =  $this->db->select('id')->from('communities')->where('gener',$community_name)->where('joincomm_lang',$language)->limit(1)->get()->result();
		if(isset($query[0]->id) && !empty($query[0]->id)) {
		    return $query[0]->id;
		}
	}
	public function langfullname($code){
	    $query = $this->db->select('langname')->from('language')->where('code', $code)->get()->result();
		if(isset($query[0]->langname) && !empty($query[0]->langname) && ($query[0]->langname != 'english')){
		    return $query[0]->langname;
		}
	}
	public function langshortname($langname) {
	    if(isset($langname) && !empty($langname)){
    	    $query = $this->db->select('code')->from('language')->where('langname', $langname)->get()->result();
    		if(isset($query[0]->code) && !empty($query[0]->code) && ($query[0]->code != 'en')){
    		    return $query[0]->code;
    		}else{
    		    return 'en';
    		}
	    }else{
	        return 'en';
	    }
	}
	public function userid($profilename){
        $query = $this->db->select('user_id')->from('signup')->where('profile_name', $profilename)->limit(1)->get()->result();
		if(isset($query[0]->user_id) && !empty($query[0]->user_id)){
		    return $query[0]->user_id;
		}
	}
	/*public function langchange($lang){
	    $query = $this->db->select('code')->from('language')->where('langname', $langname)->get()->result();
    		if(isset($query[0]->code) && !empty($query[0]->code) && ($query[0]->code != 'en')){
    		    return $query[0]->code;
    		}else{
    		    return 'en';
    		}
	}*/
	public function hprofilename($userid){
        $query = $this->db->select('profile_name')->from('signup')->where('user_id', $userid)->limit(1)->get()->result();
		if(isset($query[0]->profile_name) && !empty($query[0]->profile_name)){
		    return $query[0]->profile_name;
		}
	}
	public function banner(){
	    $language = $this->langshortname($this->uri->segment(1));
		$this->db->from('banner')->where('type', 'banner');
        if(isset($language) && !empty($language)){
            $this->db->where('language', $language);
        }
	    return $this->db->get();
	}
	public function typewrites(){
	    $data = array();
	    $query = $this->db->from('banner')->where('type','typewrite')->where('status','active')->get();
	    if($query->num_rows() > 0){ foreach($query->result() as $row){
	        array_push($data, '"'.$row->caption.'"');
	    }   }
	    return $data;
	}
    public function landiggrids(){
	    return $this->db->from('banner')->where('type','landingpage')->where('status','active')->get();
	}
	public function landinglogos(){
	    return $this->db->from('banner')->where('( type="landinglogo" OR type="landingmlogo" )')->where('status','active')->get();
	}

	public function usercommunities_gener(){
	    $user_id = $this->session->userdata['logged_in']['user_id'];
	    $language = $this->langshortname($this->uri->segment(1));
	    return $this->db->select('communities.*')->from('communities')
	        ->join('communities_join','communities.id = communities_join.comm_id')
	        ->where('communities_join.user_id', $user_id)->where('communities.joincomm_lang', $language)->get();
	}
    public function get_story_data($data){
        return $this->db->select('stories.*, signup.name, signup.profile_name, 
         (SELECT COUNT(readlater.id) FROM readlater WHERE readlater.type="nanolike" AND readlater.story_id = stories.sid) as nanolikecount')
            ->from('stories')->join('signup','signup.user_id = stories.user_id','left')
            ->where('stories.sid',$data)->where('stories.status','active')->limit(1)->get();
            //echo $this->db->last_query();
    }
	public function allusers($search = false){
		$this->db->from('signup')->where('admin_status','unblock');
		if(isset($search) && !empty($search)){
		    $user_id = $this->session->userdata['logged_in']['user_id'];
		    $this->db->where('user_id !=',$user_id)->like('name',$search, 'both')->limit(10);
		}
		return $this->db->get();
	}

	public function defaultimages(){
		//return $this->db->from('defaultimages')->limit(6)->get();
	}
	public function searchdimages($keyword){
		return $this->db->from('defaultimages')
			->like('search_keywords',$keyword, 'both')->get();
	}
	public function loadmoredimages($start=false, $limit=false){
		return $this->db->from('defaultimages')->limit($limit, $start)->get();
	}
	public function series_story_uplode($data) {
		$this->db->insert('stories',$data);
		$insert_id = $this->db->insert_id();
		$language = $this->langshortname($this->uri->segment(1));
		if(isset($data['type'], $insert_id) && ($data['type'] == "life")) {
		    $keywords = explode(',', $data['keywords']); foreach($keywords as $keyword){
		        $this->db->insert('story_keywords', array('sid'=>$insert_id, 'storytag'=>trim($keyword), 'tag_lang' => $language));
		    }
		}
		if(isset($data['writing_style']) && ($data['writing_style'] == 'anonymous')){
		}else if(isset($data['type']) && !empty($data['type'])) {
	    $follow = $this->db->from('follow')->where('writer_id',$data['user_id'])->get();
		if($follow->num_rows() > 0) {
		    $langsegurl = ''; $language = $this->langshortname($this->uri->segment(1));
		    if(isset($language) && !empty($language) && ($language != 'en')){
		        $langsegurl = $this->uri->segment(1)."/";
		    }
		    foreach($follow->result() as $follow) { if($follow->user_id != $data['user_id']){
		        if($data['type'] == 'series'){
            			$notification = array(
            				'type' => 'startseries',
            				'from_name' => $this->session->userdata['logged_in']['name'],
            				'from_id' => $data['user_id'],
            				'to_name' => $follow->name,
            				'to_id' => $follow->user_id,
            				'title' => $data['title'],
            				'title_id' => $insert_id,
            				'created_at' => Date('Y-m-d H:i:s'),
            			);
            			$notification['redirect_uri'] = 'series/'.preg_replace('/\s+/', '-', $data['title'])."-".$insert_id.'/'.preg_replace('/\s+/', '-', $data['title'])."-".$insert_id;
            			$this->db->insert('notifications',$notification);
    		        }
    		        
    		        $feedsdata = array(
        			    'writer_id' => $data['user_id'],
        			    'writer_name' => $this->session->userdata['logged_in']['name'],
        			    'user_id' => $follow->user_id,
        			    'user_name' => $follow->name,
        			    'story_id' => $insert_id,
        			    'story_title' => $data['title'],
        			    'type' => $data['type'],
        			);
        			$this->db->insert('feeds_story',$feedsdata);
        			
    		    }   }
    		}
		}
		return $insert_id;
	}
	public function insertUser($data) {
		$this->db->insert('signup', $data);
		$insertid = $this->db->insert_id();
		$pname = preg_replace("/[^a-zA-Z0-9]+/", "", $data['name']);
		$checkuniqueuname = $this->db->from('signup')->where('profile_name', $pname)->get();
		if($checkuniqueuname->num_rows() > 0){
		    $profile_name = $pname.$insertid;
		    $query = $this->db->where('user_id',$insertid)->update('signup',array('profile_name' => $profile_name));
		}else{
		    $query = $this->db->where('user_id',$insertid)->update('signup',array('profile_name' => $pname));
		}
		return $insertid;
	}
	public function registerlogin($userid){
	    return $this->db->from('signup')->where('user_id',$userid)->limit(1)->get();
	}
	public function sendnotifymail($to_email,$subject,$message){
	    /*$headers = 'From: info@arkainfoteck.xyz' . "\r\n" .
	        'Reply-To: info@arkainfoteck.xyz' . "\r\n" .
	        'Content-type: text/html'."\r\n".
	        'X-Mailer: PHP/' . phpversion();
        $status = mail($to_email,$subject,$message,$headers);*/
        /*if(is_array($to_email)){  $status = '';
            foreach($to_email as $toemail){
                $this->email->from(ADMIN_EMAIL, ADMIN_NAME);
        		$this->email->to($toemail);     
        		$this->email->subject($subject);
        		$this->email->message($message);
        		$this->email->set_mailtype('html');
        		$status = $this->email->send();
        		if($status) {
                    $status = $status;
                }
            }
            return $status;
        }else{
            $this->email->from(ADMIN_EMAIL, ADMIN_NAME);
    		$this->email->to($to_email);     
    		$this->email->subject($subject);
    		$this->email->message($message);
    		$this->email->set_mailtype('html');
    		$status = $this->email->send();
    		if($status) { 
                return $status;
            } else { 
                return false;
            }
        }*/
	}
	public function getuseremail($userid){
	    $query = $this->db->select('email')->from('signup')->where('user_id',$userid)->limit(1)->get()->result();
	    if(isset($query[0]->email) && !empty($query[0]->email)){
	        return $query[0]->email;
	    }else{
	        return false;
	    }
	}
	public function sent_mailstatus($to_email) {
	    $checkmailsent = $this->db->select('sent_mailstatus')->from('signup')->where('email', $to_email)->limit(1)->get()->result();
	    if(isset($checkmailsent[0]->sent_mailstatus) && ($checkmailsent[0]->sent_mailstatus == 2)){
	        $this->sendEmail($to_email);
	        return $this->db->where('email', $to_email)->update('signup',array('sent_mailstatus' => 1));
	    }
	}
	public function sendEmail($to_email) {
	    /*$this->email->from(ADMIN_EMAIL, ADMIN_NAME);
		$this->email->to($to_email);     
		$this->email->subject('Activate Story Carry User Registration');
		$message = 'Dear User,<br /><br />Please click on the below activation link to verify your email address.<br /><br /> '.base_url().'index.php/welcome/verify/' . md5($to_email) . '<br /><br /><br />Thanks<br />Story Carry';
		$this->email->message($message);
		$this->email->set_mailtype('html');
		$status = $this->email->send();
		if($status) { 
		   return $status;
		} else { 
			return false;
		}*/

        set_include_path("." . PATH_SEPARATOR . ($UserDir = dirname($_SERVER['DOCUMENT_ROOT'])) . "/pear/php" . PATH_SEPARATOR . get_include_path());
        require_once "Mail.php";
        $host = "ssl://smtp.gmail.com";
        $username = AEMAIL_SIGNUP;
        $password = AEMAIL_PASSWORD;
        $port = "465";
        $email_from = ADMIN_EMAIL;
        $content = "text/html; charset=utf-8";
        $email_subject = 'Activate Story Carry User Registration';
        $email_body = 'Dear User,<br /><br />Please click on the below activation link to verify your email address.<br /><br /> <a href="'.base_url().'welcome/verify/'.md5($to_email).'"> Click Here </a> (or)<br />Copy the link below<br />'.base_url().'welcome/verify/'.md5($to_email).'<br /><br />Thanks<br />Story Carry';
        $email_address = AEMAIL_SIGNUP;
        $headers = array ('From' => $email_from, 'To' => $to_email, 'Subject' => $email_subject, 'Reply-To' => $email_address, 'Content-type' => $content);
        $smtp = Mail::factory('smtp', array ('host' => $host, 'port' => $port, 'auth' => true, 'username' => $username, 'password' => $password));
        $mail = $smtp->send($to_email, $headers, $email_body);
        if (PEAR::isError($mail)) {
            return false;
        } else {
            return true;
        }
	}
	public function verifyEmailID($key)
	{
		$this->db->where('md5(email)', $key);
		return $this->db->update('signup', array('user_activation' => 1));
	}
	public function updateprofileimg($userid , $imagename){
	    return $this->db->where('user_id',$userid)->update('signup', array('profile_image' => $imagename));
	}
	public function dbemail($email = false){
	    $userid = $this->session->userdata['logged_in']['user_id'];
        if(isset($email) && !empty($email)){
            return $this->db->select('email')->from('signup')->where('user_id !=',$userid)->where('email',$email)->get();
        }else{
            $query = $this->db->select('email')->from('signup')->where('user_id',$userid)->get()->result();
            if(isset($query[0]->email)){
                return $query[0]->email;
            }
        }
	}
	public function signin($data) {	
	    return $this->db->from('signup')->where("(email = '".$data['email']."' OR profile_name = '".$data['email']."')")->where('password',$data['password'])->limit(1)->get();
	}
	public function edit_story($lid) {	
		$userid = $this->session->userdata['logged_in']['user_id'];
		return $this->db->from('stories')->where('sid',$lid)->where('user_id',$userid)->where('stories.status','active')->get();
	}
	public function addstory($data, $id, $predraftseriespub = false){
		$query = $this->db->select('cover_image, image')->from('stories')->where('sid',$id)->get()->row_array();
		if(isset($data['cover_image'], $query['cover_image']) && !empty($data['cover_image']) && !empty($query['cover_image'])){
			unlink('assets/images/'.$query['cover_image']);
		}
		if(isset($data['image'], $query['image']) && !empty($data['image']) && !empty($query['image'])){
		    unlink('assets/images/'.$query['image']);
		}
		$update = $this->db->where('sid',$id)->update('stories',$data);
		$stitle = $this->db->select('title')->where('sid',$id)->limit(1)->get('stories')->result();
		$type = ''; $title = $stitle[0]->title;
		if(isset($predraftseriespub) && ($predraftseriespub == 'predraftseriespub')){
		    $series_storyid = $this->db->select('title, story_id, type')->from('stories')->where('sid',$id)->limit(1)->get()->result();
		    if(isset($series_storyid[0]->story_id) && !empty($series_storyid[0]->story_id)){
		         $type = $series_storyid[0]->type; $title = $series_storyid[0]->title;
		        $this->db->where('story_id',$series_storyid[0]->story_id)->where('type','series')->where('sid <',$id)
		            ->where('draft','draft')->update('stories',array('draft'=>''));
		    }
		}
		$userid = $this->session->userdata['logged_in']['user_id'];
		$follow = $this->db->from('follow')->where('writer_id',$userid)->get();
		if($follow->num_rows() > 0) {  $to_emails = array();
		    $langsegurl = ''; $language = $this->langshortname($this->uri->segment(1));
		    if(isset($language) && !empty($language) && ($language != 'en')){
		        $langsegurl = $this->uri->segment(1)."/";
		    }
		    foreach($follow->result() as $follow) { if(($follow->user_id != $userid) && (!isset($data['writing_style']) || ($data['writing_style'] != 'anonymous'))){
    			$notification = array(
    				'type' => 'newstory',
    				'from_name' => $this->session->userdata['logged_in']['name'],
    				'from_id' => $userid,
    				'to_name' => $follow->name,
    				'to_id' => $follow->user_id,
    				'title' => $title,
    				'title_id' => $id,
    				'redirect_uri' => 'story/'.preg_replace("~[^\p{M}\w]+~u",'-', $title)."-".$id,
    				'created_at' => Date('Y-m-d H:i:s'),
    			);
    			$this->db->insert('notifications',$notification);
    			$to_email = $this->getuseremail($follow->user_id);
    			if(isset($to_email) && !empty($to_email)){
    			    array_push($to_emails,$to_email);
    			}
    			if((!isset($predraftseriespub) || empty($predraftseriespub)) && !empty($type)) {
        			$feedsdata = array(
        			    'writer_id' => $userid,
        			    'writer_name' => $this->session->userdata['logged_in']['name'],
        			    'user_id' => $follow->user_id,
        			    'user_name' => $follow->name,
        			    'story_id' => $id,
        			    'story_title' => $title,
        			    'type' => $type,
        			);
        			$this->db->insert('feeds_story',$feedsdata);
    			}
            }   }
            $subject = $this->session->userdata['logged_in']['name'].' published a new story';
			$message = 'Story Carry user '.$this->session->userdata['logged_in']['name'].' published a new story ';
			if(isset($to_emails) && count($to_emails) > 0){
			    $this->sendnotifymail($to_emails,$subject,$message);
			}
		}
		return $update;
	}
	public function seriesaddstory($data, $id, $storysids = false){
	    $update = $this->db->where('sid',$id)->update('stories',$data);
	    /*if(isset($storysids) && !empty($storysids)){
	        $story_sids = explode(',', $storysids);
	        foreach($story_sids as $story_sid){ if(!empty($story_sid)){
	            $this->db->where('sid',$story_sid)->where('type','series')->update('stories',array('draft'=>''));
	        }   }
	    }*/
	    $series_storyid = $this->db->select('title, story_id, type')->from('stories')->where('sid',$id)->limit(1)->get()->result();
	    if(isset($series_storyid[0]->story_id) && !empty($series_storyid[0]->story_id)){
	        $this->db->where('story_id',$series_storyid[0]->story_id)->where('type','series')->where('sid <',$id)
                ->where('draft','draft')->update('stories',array('draft'=>''));
	        $type = $series_storyid[0]->type;
	        $title = $series_storyid[0]->title;
	        $userid = $this->session->userdata['logged_in']['user_id'];
	        $follow = $this->db->from('follow')->where('writer_id',$userid)->get();
	        if($follow->num_rows() > 0) {  $to_emails = array();
                $langsegurl = ''; $language = $this->langshortname($this->uri->segment(1));
    		    if(isset($language) && !empty($language) && ($language != 'en')){
    		        $langsegurl = $this->uri->segment(1)."/";
    		    }
    		    foreach($follow->result() as $follow) { if($follow->user_id != $userid){
        			$notification = array(
        				'type' => 'newstory',
        				'from_name' => $this->session->userdata['logged_in']['name'],
        				'from_id' => $userid,
        				'to_name' => $follow->name,
        				'to_id' => $follow->user_id,
        				'title' => '',
        				'title_id' => $id,
        				'redirect_uri' => 'story/'.preg_replace('/\s+/', '-', $title)."-".$id,
        				'created_at' => Date('Y-m-d H:i:s'),
        			);
        			$this->db->insert('notifications',$notification);
        			$to_email = $this->getuseremail($follow->user_id);
        			if(isset($to_email) && !empty($to_email)){
        			    array_push($to_emails,$to_email);
        			}
        			if((!isset($predraftseriespub) || empty($predraftseriespub)) && !empty($type)) {
            			$feedsdata = array(
            			    'writer_id' => $userid,
            			    'writer_name' => $this->session->userdata['logged_in']['name'],
            			    'user_id' => $follow->user_id,
            			    'user_name' => $follow->name,
            			    'story_id' => $id,
            			    'story_title' => $title,
            			    'type' => $type,
            			);
            			$this->db->insert('feeds_story',$feedsdata);
        			}
                }   }
                $subject = $this->session->userdata['logged_in']['name'].' published a new story';
    			$message = 'Story Carry user '.$this->session->userdata['logged_in']['name'].' published a new story ';
    			if(isset($to_emails) && count($to_emails) > 0){
    			    $this->sendnotifymail($to_emails,$subject,$message);
    			}
		    }
	    }
	    return $update;
	}
	public function uploaddraftimage($story_id, $data){
		$query = $this->db->select('cover_image, image')->from('stories')->where('sid',$story_id)->get()->row_array();
		if(isset($data['cover_image'], $query['cover_image']) && !empty($data['cover_image']) && !empty($query['cover_image'])){
			unlink('assets/images/'.$query['cover_image']);
		}
		if(isset($data['image'], $query['image']) && !empty($query['image']) && !empty($data['image'])){
		    unlink('assets/images/'.$query['image']);
		}
		return $this->db->where('sid',$story_id)->update('stories',$data);
	}
	public function notifications() {
	   if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])){
    		$user_id = $this->session->userdata['logged_in']['user_id'];
    		$notseennotifys = $this->db->select('notifications.*, signup.name as sname, signup.profile_image, signup.profile_name, 
    		 signup.user_id as suserid, stories.title as stitle, stories.language as storylang')->from('notifications')
    	        ->join('signup','signup.user_id = notifications.from_id','left outer')
    	        ->join('stories','stories.sid = notifications.title_id','left outer')
                ->where('(notifications.type = "writerfollow" OR notifications.type = "comment" 
                    OR notifications.type = "replycomment" OR notifications.type= "rating" OR notifications.type = "nanolike" 
                    OR notifications.type = "seriessubscribe" OR notifications.type = "seriesepisode" 
                    OR notifications.type = "startseries" OR notifications.type = "newstory" OR notifications.type = "newnano" 
                    OR notifications.type = "favorite" OR notifications.type = "procomment" OR notifications.type = "proreplycomment" 
                    OR notifications.type = "groupsuggestion" OR notifications.type = "suggestion")')
                ->where('notifications.to_id', $user_id)->where('notifications.status !=' , 'viewed')
                ->where('notifications.from_id !=', $user_id)->order_by('notifications.id', 'DESC')->get();//->where('stories.status','active')
            if($notseennotifys->num_rows() >= 5){
                return array('notseennotifys' => $notseennotifys);
            }else{
                $limit =  5 - $notseennotifys->num_rows();
                $seennotifys = $this->db->select('notifications.*, signup.name as sname, signup.profile_image, signup.user_id as suserid,
    	        signup.profile_name, stories.title as stitle, stories.language as storylang')->from('notifications')
    	        ->join('signup','signup.user_id = notifications.from_id','left outer')
    	        ->join('stories','stories.sid = notifications.title_id','left outer')
                ->where('(notifications.type = "writerfollow" OR notifications.type = "comment" 
                    OR notifications.type = "replycomment" OR notifications.type= "rating" OR notifications.type = "nanolike" 
                    OR notifications.type = "seriessubscribe" OR notifications.type = "seriesepisode" 
                    OR notifications.type = "startseries" OR notifications.type = "newstory" OR notifications.type = "newnano" 
                    OR notifications.type = "favorite" OR notifications.type = "procomment" OR notifications.type = "proreplycomment" 
                    OR notifications.type = "groupsuggestion" OR notifications.type = "suggestion")')
                ->where('notifications.to_id', $user_id)->where('notifications.status','viewed')//->where('stories.status','active')
                ->where('notifications.from_id !=', $user_id)->limit($limit)->order_by('notifications.id', 'DESC')->get();
                return array('notseennotifys' => $notseennotifys, 'seennotifys' => $seennotifys);
            }
	    }
	}	
	public function notificationslist($start, $limit){
	    $user_id = $this->session->userdata['logged_in']['user_id'];
	    $this->db->where('to_id',$user_id)->update('notifications', array('status' => 'viewed'));
	    $generalnotifys = $this->db->select('notifications.*, signup.name as sname, signup.profile_image, signup.user_id as suserid,
	        signup.profile_name, stories.title as stitle, stories.language as storylang')->from('notifications')
	        ->join('signup','signup.user_id = notifications.from_id','left outer')
	        ->join('stories','stories.sid = notifications.title_id','left outer')
            ->where('(notifications.type = "writerfollow" OR notifications.type = "comment" 
                OR notifications.type = "replycomment" OR notifications.type= "rating" OR notifications.type = "nanolike" 
                OR notifications.type = "seriessubscribe" OR notifications.type = "seriesepisode" 
                OR notifications.type = "startseries" OR notifications.type = "newstory" 
                OR notifications.type = "newnano" OR notifications.type = "favorite" OR notifications.type = "procomment" 
                OR notifications.type = "proreplycomment" OR notifications.type = "groupsuggestion")')
            ->where('notifications.to_id', $user_id)->where('notifications.from_id !=', $user_id)//->where('stories.status','active')
            ->order_by('notifications.id', 'DESC')->limit($limit, $start)->get();
            
        /*$communitynotifys = $this->db->select('notifications.*, signup.profile_image, signup.profile_name')->from('notifications')
		    ->join('signup','notifications.from_id = signup.user_id','left')->where('notifications.to_id', $user_id)
	        ->where('(notifications.type = "communitystory" OR notifications.type = "communitycomment" OR notifications.type = "commustorylike")')
	        ->where('notifications.from_id !=', $user_id)//->group_by('notifications.title_id')
	        ->order_by('notifications.id', 'DESC')->limit($limit, $start)->get();
            
        $suggnotifys = $this->db->select('notifications.*, signup.name as sname, signup.user_id as suserid, signup.profile_name, 
            signup.profile_image, stories.title as stitle')
	        ->from('notifications')
	        ->join('signup','signup.user_id = notifications.from_id','left')
	        ->join('stories','stories.sid = notifications.title_id','left')
            ->where('(notifications.type = "suggestion")') //OR notifications.type = "groupsuggestion"
            ->where('notifications.to_id', $user_id)->where('stories.status','active')
            ->where('notifications.from_id !=', $user_id)->order_by('notifications.id', 'DESC')->limit($limit, $start)->get();
        return array('communitynotifys' => $communitynotifys, 'storynotifys' => $generalnotifys, 'suggestions' => $suggnotifys);*/
        return array('storynotifys' => $generalnotifys);
	}
	public function communitynotis($start, $limit){
	    $user_id = $this->session->userdata['logged_in']['user_id'];
	    $communitynotifys = $this->db->select('notifications.*, signup.name as sname, signup.profile_image, signup.profile_name')->from('notifications')
		    ->join('signup','notifications.from_id = signup.user_id','left')->where('notifications.to_id', $user_id)
	        ->where('(notifications.type = "communitystory" OR notifications.type = "communitycomment" OR notifications.type = "commustorylike")')
	        ->where('notifications.from_id !=', $user_id)//->group_by('notifications.title_id')
	        ->order_by('notifications.id', 'DESC')->limit($limit, $start)->get();
	    return array('communitynotifys' => $communitynotifys);
	}
	public function suggestnotis($start, $limit){
	    $user_id = $this->session->userdata['logged_in']['user_id'];
	    $suggnotifys = $this->db->select('notifications.*, signup.name as sname, signup.user_id as suserid, signup.profile_name, 
            signup.profile_image, stories.title as stitle')
	        ->from('notifications')
	        ->join('signup','signup.user_id = notifications.from_id','left')
	        ->join('stories','stories.sid = notifications.title_id','left')
            ->where('(notifications.type = "suggestion")') //OR notifications.type = "groupsuggestion"
            ->where('notifications.to_id', $user_id)->where('stories.status','active')
            ->where('notifications.from_id !=', $user_id)->order_by('notifications.id', 'DESC')->limit($limit, $start)->get();
        return array('suggestions' => $suggnotifys);
	}
	public function hseriesname($sid){
	    $query = $this->db->select('story_id')->from('stories')->where('stories.sid',$sid)
	        ->where('stories.status','active')->limit(1)->get()->result();
	    if(isset($query['0']->story_id) && !empty($query['0']->story_id)){
	        return $this->db->select('story_id, sid, title, language')->from('stories')->where('stories.sid', $query['0']->story_id)
	        ->where('stories.sid = stories.story_id')->where('stories.status','active')->limit(1)->get()->result();
	    }
	}
	public function hcommname($sid){
	    return $this->db->select('gener.id, gener.gener')->from('stories')
	        ->join('gener','stories.genre = gener.id', 'left')
	        ->where('stories.sid',$sid)->where('stories.status','active')->limit(1)->get()->result();
	}
	public function get_story($lid) {	
		$id=$this->session->userdata['logged_in']['user_id'];
	    return $this->db->query("select * from stories where sid='$lid' and user_id='$id' AND stories.draft!='draft' AND stories.status='active')");
	}
	public function hseriesongo_stop($sid){
	    $query = $this->db->select('sid')->from('stories')->where('story_id',$sid)->where('type','series')
	        ->where('stories.status','active')->get();
	    if($query->num_rows() > 0){
	        $query1 = $this->db->select('sid')->from('stories')->where('story_id',$sid)->where('type','series')
	            ->where('last_episode','yes')->where('stories.status','active')->get();
	        if($query1->num_rows() > 0){
	            return 'Completed';
	        }else{
	            return 'On Going';
	        }
	    }else{
	        return false;
	    }
	}
	public function ongoingcomplet($sid){
	    $query = $this->db->select('sid')->from('stories')->where('story_id',$sid)->where('type','series')
	        ->order_by('stories.sid','DESC')->limit(1)->get()->result();
	    if(isset($query[0]->sid) && !empty($query[0]->sid)){
	        return $this->db->where('story_id',$sid)->where('sid',$query[0]->sid)
	            ->update('stories', array('last_episode' => 'yes'));
	    }
	}
    public function get_writer($searchdata = false) {
    	$this->db->select('signup.*, stories.user_id, stories.sid, count(stories.user_id) as count, SUM(stories.views) as totel')
    		->from('signup')->join('stories','signup.user_id = stories.user_id','left')->where('stories.draft !=','draft')
    		->where('signup.user_id = stories.user_id')->where('stories.status','active')->where('stories.type !=','')
    		->group_by('stories.user_id')->order_by('totel','DESC');
		if(isset($searchdata) && !empty($searchdata)){
		    $this->db->like('signup.name',$searchdata, 'both');
		}else{
    	    $this->db->limit(4);
		}
    	return $this->db->get();
    }
    public function get_top_writer($searchdata = false, $start = false, $limit = false) {
        $language = $this->langshortname($this->uri->segment(1));
        if(isset($language) && !empty($language)){
            $query = "SELECT (SUM(stories.views)/100 + (SELECT COUNT(follow.id) from follow where signup.user_id = follow.writer_id)) as writerpoints, 
                signup.*, stories.sid, count(stories.user_id) as count, SUM(stories.views) as totel 
                FROM signup LEFT JOIN stories ON signup.user_id = stories.user_id 
                WHERE (stories.draft != 'draft' AND signup.user_id = stories.user_id) AND stories.status='active' AND 
                stories.type != '' AND stories.language = '$language' ";
                if(isset($searchdata) && !empty($searchdata)){
                    $query.=" AND signup.name LIKE '%$searchdata%' ";
                }
                $query.=" GROUP BY signup.user_id ORDER BY writerpoints DESC, totel DESC, signup.user_id DESC ";
                if(isset($limit, $start) && !empty($limit)){
                    $query.=" LIMIT ".$start.", ".$limit;
                }
            return $this->db->query($query);
            /*$query = "SELECT (SUM(stories.views)/100 + (SELECT COUNT(follow.id) from follow where signup.user_id = 
                follow.writer_id)) as writerpoints, 
                signup.*, stories.sid, (SELECT COUNT(sid) FROM stories where stories.status='active' AND 
                stories.language = '$language' AND stories.draft != 'draft' AND (stories.type='nano' OR stories.type='story' 
                OR stories.type='life' OR (stories.type='series' AND stories.sid !=stories.story_id))) as count, 
                SUM(stories.views) as totel FROM signup LEFT JOIN stories ON signup.user_id = stories.user_id 
                WHERE (stories.draft != 'draft' AND signup.user_id = stories.user_id) AND stories.status='active' AND 
                stories.language = '$language' ";
                if(isset($searchdata) && !empty($searchdata)){
                    $query.=" AND signup.name LIKE '%$searchdata%' ";
                }
                $query.=" GROUP BY signup.user_id ORDER BY writerpoints DESC, totel DESC, signup.user_id DESC";
            return $this->db->query($query);*/
        }
    }
    
    public function profileviewall($userid, $type, $start, $limit){
	    $language = $this->langshortname($this->uri->segment(1));
	    if($type == 'nano'){
	        return $this->db->select('stories.*, gener.gener, signup.*, 
	            (SELECT COUNT(readlater.id) FROM readlater WHERE readlater.type="nanolike" AND readlater.story_id = stories.sid) as nanolikecount')
                ->from('stories')
                ->join('gener','gener.id = stories.genre','left')->join('signup','signup.user_id = stories.user_id','left')
                ->where('stories.type', $type)->where('stories.user_id',$userid)->where('stories.draft !=','draft')//->where('stories.language',$language)
                ->where('stories.status','active')
                ->order_by('stories.sid','DESC')->limit($limit, $start)->get();
	    }else{
    	    $this->db->select('stories.*, gener.*, signup.*')->from('stories')
    	        ->join('gener','gener.id = stories.genre','left')->join('signup','signup.user_id = stories.user_id','left')
    			->where('stories.type', $type)->where('stories.user_id',$userid)->where('stories.draft !=','draft')//->where('stories.language',$language)
    			->where('stories.status','active');
        		if($type == 'series'){
    			    $this->db->where('stories.sid = stories.story_id');//->group_by('stories.story_id');
    			}if(($type == 'series') || ($type == 'story') || ($type == 'life')){
    			    $this->db->where('stories.title !=','');
    			}
    		$this->db->order_by('stories.sid','DESC')->limit($limit, $start);
    		$query = $this->db->get();
    		return $query;
	    }
    }
    public function viewallhome($type, $start, $limit, $generid = false){
        $language = $this->langshortname($this->uri->segment(1));
        if($type == 'nano'){
            $this->db->select('stories.*, gener.*, signup.*, 
                (SELECT COUNT(readlater.id) FROM readlater WHERE readlater.type="nanolike" AND readlater.story_id = stories.sid) as nanolikecount')
                ->from('stories')
    	        ->join('gener','stories.genre = gener.id','left')->join('signup','stories.user_id = signup.user_id','left')
    			->where('stories.type', $type)->where('stories.draft !=','draft')->where('stories.status','active');
    			if(isset($language) && !empty($language)){
    			    $this->db->where('stories.language',$language);
    			}
    			if(isset($generid) && !empty($generid)){
    			    $this->db->where('stories.genre', $generid);
    			}
        		if($type == 'series'){
    			    $this->db->where('stories.sid = stories.story_id')->group_by('stories.sid');
    			}
    		$this->db->order_by('stories.sid','DESC');
    		$this->db->limit($limit, $start); // CI LIMIT is reverse
    		$query = $this->db->get();
    		return $query;
        }else{
            $this->db->select('stories.*, gener.*, signup.*')->from('stories')
    	        ->join('gener','stories.genre = gener.id','left')->join('signup','stories.user_id = signup.user_id','left')
    			->where('stories.draft !=','draft')->where('stories.status','active');
    			if(isset($language) && !empty($language)){
    			    $this->db->where('stories.language',$language);
    			}
    			if(isset($generid) && !empty($generid)){
    			    $this->db->where('stories.genre', $generid);
    			}
    			if($type == 'life'){
    			    $this->db->where('stories.type', $type)->group_by('stories.sid');
        		}else if($type == 'series'){
    			    $this->db->where('stories.sid = stories.story_id')->where('stories.type', $type)->group_by('stories.sid');
    			}else if($type == 'story'){
    			    $this->db->where('(stories.type = "story" OR (stories.type = "series" AND stories.sid != stories.story_id))')->group_by('stories.sid');
    			}else{
    			    $this->db->where('stories.type', $type);
    			}
    		$this->db->order_by('stories.sid','DESC');
    		$this->db->limit($limit, $start); // CI LIMIT is reverse
    		$query = $this->db->get();
    		return $query;
        }
    }
    
	public function topviewallhome($type, $start, $limit){
	    $language = $this->langshortname($this->uri->segment(1));
	    if($type == 'series'){
    	    $query = "SELECT stories.*, gener.gener, signup.*, (COUNT(story_views.id)/30 + (SELECT COUNT(readlater.id) from 
    	    readlater where (stories.sid = readlater.story_id AND readlater.type='seriessubscribe')) ) as uniview_subs FROM 
    	    stories LEFT JOIN story_views ON stories.sid = story_views.story_id LEFT JOIN signup on 
    	    stories.user_id = signup.user_id LEFT JOIN gener on stories.genre = gener.id WHERE stories.draft !='draft'
    	    AND stories.type='series' AND stories.sid = stories.story_id AND stories.language='$language' 
    	    AND stories.status='active' GROUP BY stories.story_id ORDER BY uniview_subs DESC ";
    	    if(isset($start) && isset($limit)){
               $query.=" LIMIT ".$start.",". $limit;
    		}else{
    		    $query.=" LIMIT  0, 8";
    		}
    		return $this->db->query($query);
	    }else if($type == 'story'){
	        /*$query = "SELECT stories.*, gener.gener, signup.*, (COUNT(story_views.id)/30) as uniview_subs FROM stories 
	        LEFT JOIN story_views ON stories.sid = story_views.story_id LEFT JOIN signup on stories.user_id = signup.user_id 
	        LEFT JOIN gener on stories.genre = gener.id WHERE (stories.type='story' OR (stories.type='series' AND 
	         stories.sid != stories.story_id)) AND stories.draft !='draft' AND stories.language='$language' 
	         AND stories.status = 'active' GROUP BY story_views.story_id ORDER BY uniview_subs DESC ";*/
	        $query = "SELECT stories.*, gener.gener, signup.*, 
	        (SELECT COUNT(story_views.id)/30 FROM story_views WHERE stories.sid = story_views.story_id) as uniview_subs FROM stories 
	        LEFT JOIN signup on stories.user_id = signup.user_id 
	        LEFT JOIN gener on stories.genre = gener.id WHERE (stories.type='story' OR (stories.type='series' AND 
	         stories.sid != stories.story_id)) AND stories.draft !='draft' AND stories.language='$language' 
	         AND stories.status = 'active' GROUP BY stories.sid ORDER BY uniview_subs DESC ";
	        if(isset($start) && isset($limit)){
               $query.=" LIMIT ".$start.",". $limit;
    		}else{
    		    $query.=" LIMIT  0, 8";
    		}
	        return $this->db->query($query);
	    }else if($type == 'life'){
            /*$query = "SELECT stories.*, gener.gener, signup.*, (COUNT(story_views.id)/30) as uniview_subs FROM stories 
            LEFT JOIN story_views ON stories.sid = story_views.story_id LEFT JOIN signup on stories.user_id = signup.user_id 
            LEFT JOIN gener on stories.genre = gener.id WHERE stories.type='life' AND stories.draft !='draft' 
            AND stories.language='$language' GROUP BY story_views.story_id ORDER BY uniview_subs DESC ";*/
            $query = "SELECT stories.*, gener.gener, signup.*, 
            (SELECT COUNT(story_views.id)/30 FROM story_views WHERE stories.sid = story_views.story_id) as uniview_subs FROM stories 
            LEFT JOIN signup on stories.user_id = signup.user_id 
            LEFT JOIN gener on stories.genre = gener.id WHERE stories.type='life' AND stories.draft !='draft' 
            AND stories.language='$language' AND stories.status='active' GROUP BY stories.sid ORDER BY uniview_subs DESC ";
	        if(isset($start) && isset($limit)){
               $query.=" LIMIT ".$start.",". $limit;
    		}else{
    		    $query.=" LIMIT  0, 8";
    		}
    		return $this->db->query($query);
	    }
	}
	
    public function writer_profile($userid) {
    	$language = $this->langshortname($this->uri->segment(1));
        /*return  $this->db->select('signup.*, stories.user_id, stories.sid, count(stories.user_id) as count, 
            SUM(stories.views) as storiesviewcount')
    		->from('signup')->join('stories','signup.user_id=stories.user_id','left')->where('stories.draft !=','draft')
    		->where('signup.user_id',$userid)->where('stories.status','active')->where('stories.type !=','')
    		->where('signup.user_id=stories.user_id')->where('stories.language',$language)->group_by('stories.user_id')->get();*/
    	return  $this->db->select('signup.*, stories.user_id, stories.sid, count(stories.user_id) as count, 
            SUM(stories.views) as storiesviewcount')
    		->from('signup')->join('stories','signup.user_id=stories.user_id','left outer')->where('stories.draft !=','draft')
    		->where('signup.user_id',$userid)->where('stories.status','active')->where('stories.type !=','')
    		->where('signup.user_id=stories.user_id')->where('stories.language',$language)->get();
    }
    public function writerseries($userid){
        $language = $this->langshortname($this->uri->segment(1));
        return $this->db->select('stories.*, gener.gener, signup.*')->from('stories')
            ->join('gener','gener.id = stories.genre','left')->join('signup','signup.user_id = stories.user_id','left')
			->where('stories.type','series')->where('stories.draft !=','draft')->where('stories.story_id !=',0)
			->where('stories.sid = stories.story_id')->where('stories.user_id',$userid)//->where('stories.language',$language)
			->where('stories.status','active')->group_by('stories.story_id')->order_by('stories.sid','DESC')->limit(7)->get();
    }
    public function writerstories($userid){
        $language = $this->langshortname($this->uri->segment(1));
        return $this->db->select('stories.*, gener.gener, signup.*')->from('stories')
            ->join('gener','gener.id = stories.genre','left')->join('signup','signup.user_id = stories.user_id','left')
            ->where('stories.type','story')->where('stories.draft !=','draft')->where('stories.user_id',$userid)//->where('stories.language',$language)
            ->where('stories.status','active')->order_by('stories.sid','DESC')->limit(7)->get();
    }
    public function writernanos($userid){
        $language = $this->langshortname($this->uri->segment(1));
        return $this->db->select('stories.*, gener.gener, signup.*, (SELECT COUNT(readlater.id) FROM readlater WHERE readlater.type="nanolike" AND readlater.story_id = stories.sid) as nanolikecount')
            ->from('stories')
            ->join('gener','gener.id = stories.genre','left')->join('signup','signup.user_id = stories.user_id','left')
            ->where('stories.type','nano')->where('stories.draft !=','draft')->where('stories.user_id',$userid)
            ->where('stories.status','active')//->where('stories.language',$language)
            ->order_by('stories.sid','DESC')->limit(7)->get();
    }
    public function writerlifes($userid){
        $language = $this->langshortname($this->uri->segment(1));
        $this->db->select('stories.*, gener.gener, signup.*')->from('stories')
            ->join('gener','gener.id = stories.genre','left')->join('signup','signup.user_id = stories.user_id','left')
            ->where('stories.type','life')->where('stories.draft !=','draft')->where('stories.user_id',$userid)
            ->where('stories.status','active');//->where('stories.language',$language);
        if(isset($this->session->userdata['logged_in']['user_id']) && ($this->session->userdata['logged_in']['user_id'] != $userid)){
            $this->db->where('(stories.writing_style != "anonymous")');
        }      
        return $this->db->order_by('stories.sid','DESC')->limit(7)->get();
    }

	/*public function client_profile($userid){
		$language = $this->langshortname($this->uri->segment(1));
        $query = $this->db->select('signup.*, stories.user_id, stories.sid, count(stories.user_id) as count, 
            SUM(stories.views) as storiesviewcount')
    		->from('signup')->join('stories','signup.user_id = stories.user_id','left')->where('stories.draft !=','draft')
    		->where('stories.status','active')->where('stories.language',$language)->where('signup.user_id', $userid)
    		->where('stories.type !=','')->group_by('stories.user_id')->get();
		return $query;
    } */
    public function client_profile($userid){ // profile user don't have stories
        return  $this->db->from('signup')->where('signup.user_id', $userid)->group_by('signup.user_id')->limit(1)->get();
    }
    public function myalllists($type){
        if(isset($this->session->userdata['logged_in'])){
			$userid = $this->session->userdata['logged_in']['user_id'];
		    $this->db->select('stories.*, gener.*, signup.*')
    			->from('stories')
    			->join('gener','gener.id = stories.genre','left')->join('signup','stories.user_id = signup.user_id','left')
    			->where('stories.type',$type)->where('stories.user_id',$userid)->where('stories.status','active');
    			if($type == 'series'){
    			    $this->db->group_by('stories.story_id');
    			}
    			$this->db->order_by('stories.sid','Desc');
		    return $this->db->get();
        }
    }
    /*public function client_nano_books()  
    {  
        if(isset($this->session->userdata['logged_in'])){
			$id = $this->session->userdata['logged_in']['user_id'];
            $query=$this->db->select('stories.*, signup.*')
			->from('stories')
			->join('signup','signup.user_id=stories.user_id','left')
			->where('stories.type','nano')->where('stories.user_id',$id)->where('stories.status','active')
			->get();
			//print_r($query);exit();
          return $query;
		}
		else{
			redirect(base_url().'my_profile.php');
		}            
    }*/
    
    
    public function editprofile($id) {
		return $this->db->from('signup')->where('user_id',$id)->get();
	}
	 public function updateprofile($data,$id){
		return $this->db->where('user_id',$id)->update('signup',$data);
	}
	public function rating($rating, $sid) {
	    if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])){
    		$userid = $this->session->userdata['logged_in']['user_id'];
    		$query = $this->db->from('rating')->where('user_id',$userid)->where('story_id',$sid)->get();
    		$storydata = $this->db->select('title, user_id, type')->from('stories')->where('sid',$sid)->limit(1)->get()->result();
    		if($query->num_rows() >0){
                return $this->db->where('user_id',$userid)->where('story_id', $sid)->update('rating', array('rating' => $rating));
    		}else{
    			$insert = $this->db->insert('rating', array('user_id' => $userid, 'story_id' => $sid, 'rating' => $rating));
    			if(isset($storydata[0]->title) && isset($storydata[0]->user_id) && isset($storydata[0]->type)){
    			    $langsegurl = ''; $language = $this->langshortname($this->uri->segment(1));
        		    if(isset($language) && !empty($language) && ($language != 'en')){
        		        $langsegurl = $this->uri->segment(1)."/";
        		    }
    			    $notification['redirect_uri'] = '#';
        			if($storydata[0]->type == 'series') {
        				$notification['redirect_uri'] = 'series/'.preg_replace('/\s+/', '-', $storydata[0]->title)."-".$sid.'/'.preg_replace('/\s+/', '-', $storydata[0]->title)."-".$sid;
        			}elseif($storydata[0]->type == 'story') {
        				$notification['redirect_uri'] = 'story/'.preg_replace('/\s+/', '-', $storydata[0]->title)."-".$sid;
        			}elseif($storydata[0]->type == 'nano'){
        				$notification['redirect_uri'] = '#';
        			}elseif($storydata[0]->type == 'life') {
        				$notification['redirect_uri'] = 'story/'.preg_replace('/\s+/', '-', $storydata[0]->title)."-".$sid;
        			}
        			$notification = array(
        				'type' => 'rating',
        				'from_name' => $this->session->userdata['logged_in']['name'],
        				'from_id' => $this->session->userdata['logged_in']['user_id'],
        				'to_name' => '',
        				'to_id' => $storydata[0]->user_id,
        				'title' => $storydata[0]->title,
        				'title_id' => $sid,
        				'redirect_uri' => $notification['redirect_uri'],
        				'created_at' => Date('Y-m-d H:i:s'),
        			);
        			$this->db->insert('notifications', $notification);
    			}
    			return $insert;
    		}
	    }else{
	        
	    }
	}
    public function seriesftitle($storyid) {
        $query = $this->db->select('stories.*, signup.profile_name')->from('stories')->join('gener','stories.genre = gener.id','left')
            ->join('signup','stories.user_id = signup.user_id','left')->where('stories.type','series')
            ->where('stories.status','active')->where('stories.sid', $storyid)->limit(1)->get()->result();
        if(isset($query[0]->story_id) && !empty($query[0]->story_id)){
            return $this->db->select('stories.*, signup.profile_name')->from('stories')->join('gener','stories.genre = gener.id','left')
                ->join('signup','stories.user_id = signup.user_id','left')->where('stories.type','series')
                ->where('stories.status','active')->where('stories.sid', $query[0]->story_id)->where('stories.story_id', $query[0]->story_id)->limit(1)->get();
        }
    }
    public function admin_story_view($storyid){
        $query = $this->db->query("select s.*, u.profile_name, u.profile_image, u.name from stories s left join gener g on g.id=s.genre left join signup u on 
        u.user_id=s.user_id  where s.status='active' AND s.sid=?",$storyid);
        return $query;
	}
	public function comment_like($id) {
		$comment = $this->db->select("count('story_id') as commentcount")->from('comments')->where('story_id',$id)->where('comment_id',0)->get()->result();
		$like = $this->db->select("count('story_id') as likecount")->from('likes')->where('sid',$id)->get()->result();
		return array('commentcount'=>$comment[0]->commentcount, 'likecount'=>$like[0]->likecount);
	}
	public function editstory($id)
	{
		if(isset($this->session->userdata['logged_in']['user_id'], $id) && !empty($this->session->userdata['logged_in']['user_id']) && !empty($id)){
			$userid = $this->session->userdata['logged_in']['user_id'];
			return $this->db->from('stories')->where('sid',$id)->where('user_id',$userid)->limit(1)->get();
		}
	}
	/* public function editepisode($sid)
	{
		return $this->db->from('stories')->where('sid',$sid)->get();
	}*/
	public function updatestory($data,$id){
		$query = $this->db->select('cover_image, image')->from('stories')->where('sid',$id)->get()->row_array();
		if(isset($data['cover_image'], $query['cover_image']) && !empty($data['cover_image']) && !empty($query['cover_image'])){
			unlink('assets/images/'.$query['cover_image']);
		}
		if(isset($data['image'], $query['image']) && !empty($data['image']) && !empty($query['image'])){
		    unlink('assets/images/'.$query['image']);
		}
        return $this->db->where('sid',$id)->update('stories',$data);
	}
	
	public function addtodrafts($data, $sid){
	    return $this->db->where('sid',$sid)->update('stories',$data);
	}
	public function drafts($start = false, $limit = false){
	    if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])){
    	    $userid = $this->session->userdata['logged_in']['user_id'];
    	    /*return $this->db->from('stories')->where('draft','draft')->where('user_id',$userid)//->where('title !=','')
    	        //->where('( (type="series" AND sid=story_id) OR type = "story" OR type="life" OR type="nano")')
    	        ->order_by('sid','DESC')->get();*/
    	   $this->db->from('stories')->where('draft','draft')->where('user_id',$userid)->order_by('sid','DESC');
    	   if(isset($limit) && !empty($limit)) {
    	       $this->db->limit($limit, $start);
    	   }
    	   return $this->db->get();
	    }
	}
	
	public function lifetagssearch($searchtag = false){
	    $language = $this->langshortname($this->uri->segment(1));
        /*return $this->db->select('tags.*,(SELECT COUNT(stories.sid) FROM stories WHERE stories.keywords LIKE CONCAT("%", tags.tagname, "%")) as tagcount')
            ->from('tags')->where('tags.status','active')->where('tags.type','life')->where('tags.language',$language)
            ->like('tags.tagname',$searchtag, 'both')->order_by('tagcount','DESC')->get();*/
        return $this->db->select('tags.*, COUNT(story_keywords.id) as tagcount')->from('tags')
            ->join('story_keywords','story_keywords.storytag = tags.tagname','left')
            ->where('tags.status','active')->where('tags.type','life')->where('tags.language',$language)->where('story_keywords.tag_lang',$language)
            ->like('tags.tagname',$searchtag)->order_by('tagcount','DESC')->group_by('tags.tagname')->get();
	}
	public function deletedraft($sid, $draft) {
	    $query = $this->db->select('cover_image, image')->from('stories')->where('sid',$sid)->where('draft',$draft)->get()->result();
	    if(isset($query[0]->cover_image) && !empty($query[0]->cover_image)){
	        unlink('assets/images/'.$query[0]->cover_image);
	    }
	    if(isset($query[0]->image) && !empty($query[0]->image)){
	        unlink('assets/images/'.$query[0]->image);
	    }
	    return $this->db->where('sid',$sid)->where('draft',$draft)->delete('stories');
	}
	public function get_series($searchdata = false){
		$language = $this->langshortname($this->uri->segment(1));
		$this->db->select('stories.*, gener.*, signup.*')->from('stories')
		    ->join('gener','gener.id = stories.genre','left')->join('signup','signup.user_id = stories.user_id','left')
			->where('stories.type','series')->where('stories.sid = stories.story_id')->where('stories.draft !=','draft')
			->where('stories.status','active');
			if(isset($language) && !empty($language)){
			    $this->db->where('stories.language',$language);
			}
		$this->db->where('stories.story_id !=',0)->group_by('stories.story_id')->order_by('stories.sid','DESC');
		/*if(isset($searchdata) && !empty($searchdata)){
		    $searchcon = "(stories.title LIKE '%$searchdata%' OR stories.etitle LIKE '%$searchdata%' OR signup.name LIKE '%$searchdata%' OR stories.keywords LIKE '%$searchdata%')";
		    $this->db->where($searchcon);
		}*/
    	$this->db->limit(7);
		return $this->db->get();
	}
	public function get_storys($searchdata = false){
		$language = $this->langshortname($this->uri->segment(1));
	    $this->db->select('stories.*, gener.*, signup.*')->from('stories')
	        ->join('gener','stories.genre = gener.id', 'left')
	        ->join('signup','stories.user_id = signup.user_id','left')->where('stories.draft !=','draft')
	        ->where('((stories.type ="story") OR (stories.type ="series" AND stories.sid != stories.story_id))')
	        ->where('stories.status','active');
	        if(isset($language) && !empty($language)){
			    $this->db->where('stories.language',$language);
			}
	    $this->db->order_by('stories.sid','DESC');
        /*if(isset($searchdata) && !empty($searchdata)){
		    $searchcon = "(stories.title LIKE '%$searchdata%' OR stories.etitle LIKE '%$searchdata%' OR signup.name LIKE '%$searchdata%' OR stories.keywords LIKE '%$searchdata%')";
		    $this->db->where($searchcon);
		}*/
    	$this->db->limit(7);
        return $this->db->get();
	}
	
	public function recentseriesgener($sid, $language, $generid = false) {
	    if(isset($sid, $language, $generid) && !empty($generid)){
    	    $generquery = $this->db->select('stories.*, gener.*, signup.*')->from('stories')
    		    ->join('gener','stories.genre = gener.id','left')->join('signup', 'stories.user_id = signup.user_id','left')
    		    ->where('stories.type','series')->where('stories.genre', $generid)
    		    ->where('stories.status','active')->where('stories.language', $language)->where('stories.sid !=',$sid)
    		    ->where('stories.sid = stories.story_id')->group_by('stories.story_id')->order_by('RAND()')->limit(4)->get();
    		if($generquery->num_rows() >= 4){
    		    return $generquery;
    		}else{
    		    return $this->db->select('stories.*, gener.*, signup.*')->from('stories')
        		    ->join('gener','stories.genre = gener.id','left')->join('signup', 'stories.user_id = signup.user_id','left')
        		    ->where('stories.type','series')->where('stories.status','active')->where('stories.language', $language)
        		    ->where('stories.sid = stories.story_id')->group_by('stories.story_id')->order_by('RAND()')->limit(4)->get();
    		}
	    }else{
	        return $this->db->select('stories.*, gener.*, signup.*')->from('stories')->join('gener','stories.genre = gener.id','left')
    		    ->join('signup', 'stories.user_id = signup.user_id','left')->where('stories.type','series')->where('stories.status','active')
    		    ->where('stories.language', $language)->group_by('stories.story_id')->order_by('RAND()')->limit(4)->get();
	    }
	}
	public function recentseries($sid,$s_storyid) {
		$language = $this->langshortname($this->uri->segment(1));
		$generidtags = $this->db->select('keywords, genre')->from('stories')->where('sid',$s_storyid)->get()->result();
		if(isset($generidtags[0]->keywords) && !empty($generidtags[0]->keywords)){
		    $tags = explode(',',$generidtags[0]->keywords); $tagscondition = array();
		    foreach($tags as $tag){ array_push($tagscondition, "stories.keywords LIKE '%$tag%'"); }
		    $tagscond = implode(' OR ',$tagscondition);
		    $tagsquery = $this->db->select('stories.*, gener.*, signup.*')->from('stories')
        	    ->join('gener','stories.genre = gener.id','left')->join('signup', 'stories.user_id = signup.user_id','left')
        	    ->where('('.$tagscond.')')->where('stories.type','series')->where('stories.status','active')
        	    ->where('stories.language', $language)->where('stories.sid !=',$sid)->where('stories.sid = stories.story_id')
        	    ->group_by('stories.story_id')->order_by('RAND()')->limit(4)->get();
            if($tagsquery->num_rows() >= 4){
                return $tagsquery;
            }else{
                return $this->recentseriesgener($sid, $language, $generidtags[0]->genre);
            }
        }else if(isset($generidtags[0]->genre) && !empty($generidtags[0]->genre)){
            return $this->recentseriesgener($sid, $language, $generidtags[0]->genre);
        } else{
            return $this->db->select('stories.*, gener.*, signup.*')->from('stories')->join('gener','stories.genre = gener.id','left')
                ->join('signup', 'stories.user_id = signup.user_id','left')->where('stories.type','series')->where('stories.status','active')
                ->where('stories.language', $language)->group_by('stories.story_id')->order_by('RAND()')->limit(4)->get();
        }
    }
    
    public function recentstoriesgenre($sid, $language, $generid = false){
        if(isset($sid, $generid, $language) && !empty($generid)){
            $generquery = $this->db->select('stories.*, gener.*, signup.*')->from('stories')
    		    ->join('gener','stories.genre = gener.id','left')->join('signup', 'stories.user_id = signup.user_id','left')
    		    ->where('stories.type','story')->where('stories.genre', $generid)
    		    ->where('stories.status','active')->where('stories.language',$language)
    		    ->where('stories.sid !=',$sid)->order_by('RAND()')->limit(4)->get();
		    if($generquery->num_rows() >= 4){
		        return $generquery;
		    }else{
		        $query = $this->db->select('stories.*, gener.*, signup.*')->from('stories')
        		    ->join('gener','stories.genre = gener.id','left')->join('signup', 'stories.user_id = signup.user_id','left')
        		    ->where('stories.type','story')->where('stories.language', $language)->where('stories.status','active')
        		    ->where('stories.sid !=',$sid)->order_by('RAND()')->limit(4)->get();
        		if($query->num_rows() >= 4){
        		    return $query;
        		}else{
        		    return $this->db->select('stories.*, gener.*, signup.*')->from('stories')
            		    ->join('gener','stories.genre = gener.id','left')->join('signup', 'stories.user_id = signup.user_id','left')
            		    ->where('stories.type','story')->where('stories.status','active')->order_by('RAND()')->limit(4)->get();
        		}
		    }
        }else{
            $query = $this->db->select('stories.*, gener.*, signup.*')->from('stories')
    		    ->join('gener','stories.genre = gener.id','left')->join('signup', 'stories.user_id = signup.user_id','left')
    		    ->where('stories.type','story')->where('stories.language', $language)->where('stories.status','active')
    		    ->where('stories.sid !=',$sid)->order_by('RAND()')->limit(4)->get();
    		if($query->num_rows() >= 4){
    		    return $query;
    		}else{
    		    return $this->db->select('stories.*, gener.*, signup.*')->from('stories')
        		    ->join('gener','stories.genre = gener.id','left')->join('signup', 'stories.user_id = signup.user_id','left')
        		    ->where('stories.type','story')->where('stories.status','active')->order_by('RAND()')->limit(4)->get();
    		}
        }
    }
    public function recentstories($sid){
      	$language = $this->langshortname($this->uri->segment(1));
		$generidtags = $this->db->select('keywords, genre')->from('stories')->where('sid',$sid)->get()->result();
    	if(isset($generidtags[0]->keywords) && !empty($generidtags[0]->keywords)){
		    $tags = explode(',',$generidtags[0]->keywords); $tagscondition = array();
		    foreach($tags as $tag){ array_push($tagscondition, 'stories.keywords LIKE "%'.$tag.'%"'); }
		    $tagscond = implode(' OR ',$tagscondition);
		    $tagsquery = $this->db->select('stories.*, gener.*, signup.*')->from('stories')
    		    ->join('gener','stories.genre = gener.id','left')->join('signup', 'stories.user_id = signup.user_id','left')
    		    ->where('stories.type','story')->where('('.$tagscond.')')->where('stories.status','active')
    		    ->where('stories.language',$language)->where('stories.sid !=',$sid)->order_by('RAND()')->limit(4)->get();
		    if($tagsquery->num_rows() >= 4){
		        return $tagsquery;
		    }else if(isset($generidtags[0]->genre) && !empty($generidtags[0]->genre)){
		        return $this->recentstoriesgenre($sid, $language, $generidtags[0]->genre);
		    }
	    }else if(isset($generidtags[0]->genre) && !empty($generidtags[0]->genre)){
	        return $this->recentstoriesgenre($sid, $language, $generidtags[0]->genre);
	    }else{
	        return $this->db->select('stories.*, gener.*, signup.*')->from('stories')
    		    ->join('gener','stories.genre = gener.id','left')->join('signup', 'stories.user_id = signup.user_id','left')
    		    ->where('stories.type','story')->where('stories.status','active')->order_by('RAND()')->limit(4)->get();
	    }
    }
    public function recentlife($sid) {
	    $language = $this->langshortname($this->uri->segment(1));
		$generidtags = $this->db->select('keywords')->from('stories')->where('sid',$sid)->get()->result();
    	if(isset($generidtags[0]->keywords) && !empty($generidtags[0]->keywords)){
		    $tags = explode(',',$generidtags[0]->keywords); $tagscondition = array();
		    foreach($tags as $tag){ array_push($tagscondition, 'stories.keywords LIKE "%'.$tag.'%"'); }
		    $tagscond = implode(' OR ',$tagscondition);
		    
		    $tagsquery = $this->db->select('stories.*, signup.*')->from('stories')->join('signup', 'stories.user_id = signup.user_id','left')
    		    ->where('stories.type','life')->where('stories.status','active')->where('('.$tagscond.')')->where('stories.language',$language)
    		    ->where('stories.sid !=',$sid)->order_by('RAND()')->limit(3)->get();
    	    if($tagsquery->num_rows() >= 3){
                return $tagsquery;
            }else{
                $langquery = $this->db->select('stories.*, signup.*')->from('stories')->join('signup', 'stories.user_id = signup.user_id','left')
        		    ->where('stories.type','life')->where('stories.status','active')->where('stories.language',$language)
        		    ->where('stories.sid !=',$sid)->order_by('RAND()')->limit(3)->get();
    		    if($langquery->num_rows() >= 3){
    		        return $langquery;
    		    }else{
    		        return $this->db->select('stories.*, signup.*')->from('stories') ->join('signup', 'stories.user_id = signup.user_id','left')
    		            ->where('stories.type','life')->where('stories.status','active')->order_by('RAND()')->limit(3)->get();
    		    }
            }
		}else{
		    $langquery = $this->db->select('stories.*, signup.*')->from('stories')->join('signup', 'stories.user_id = signup.user_id','left')
    		    ->where('stories.type','life')->where('stories.status','active')->where('stories.language',$language)
    		    ->where('stories.sid !=',$sid)->order_by('RAND()')->limit(3)->get();
		    if($langquery->num_rows() >= 3){
		        return $langquery;
		    }else{
		        return $this->db->select('stories.*, signup.*')->from('stories') ->join('signup', 'stories.user_id = signup.user_id','left')
		            ->where('stories.type','life')->where('stories.status','active')->order_by('RAND()')->limit(3)->get();
		    }
		}
    }
	public function comment($data,$id) {
    	//$res=$this->db->from('comments')->where('story_id',$id)->get()->result();
		$this->db->insert('comments',$data);
		$insertid = $this->db->insert_id();
		$res = $this->db->select('comments.*, signup.user_id, signup.profile_image, signup.profile_name')
		    ->from('comments')->join('signup','comments.user_id = signup.user_id','left')->where('comments.cid',$insertid)->get();
		 //$res = $this->db->from('comments')->where('story_id',$id)->get()->result();
		 //print_r($res);exit();

			$storytitle = $this->db->select('title,user_id,type')->from('stories')->where('sid',$data['story_id'])->limit(1)->get()->result();
			if(isset($storytitle[0]->title) && ($storytitle[0]->user_id != $data['user_id'])) {
			    $langsegurl = ''; $language = $this->langshortname($this->uri->segment(1));
    		    if(isset($language) && !empty($language) && ($language != 'en')){
    		        $langsegurl = $this->uri->segment(1)."/";
    		    }
				$notification = array(
					'type' => 'comment',
					'from_name' => $this->session->userdata['logged_in']['name'],
					'from_id' => $data['user_id'],
					'to_name' => '',
					'to_id' => $storytitle[0]->user_id,
					'title' => $data['comment'],
					'title_id' => $data['story_id'],
					'created_at' => Date('Y-m-d H:i:s'),
				);
				if($storytitle[0]->type == 'series') {
					$notification['redirect_uri'] = 'series/'.preg_replace('/\s+/', '-', $storytitle[0]->title)."-".$data['story_id'].'/'.preg_replace('/\s+/', '-', $storytitle[0]->title)."-".$data['story_id'];
				}elseif($storytitle[0]->type == 'story') {
					$notification['redirect_uri'] = 'story/'.preg_replace('/\s+/', '-', $storytitle[0]->title)."-".$id;
				}elseif($storytitle[0]->type == 'nano'){
					$notification['redirect_uri'] = '#';
				}elseif($storytitle[0]->type == 'life') {
					$notification['redirect_uri'] = 'story/'.preg_replace('/\s+/', '-', $storytitle[0]->title)."-".$id;
				}else{
					$notification['redirect_uri'] = '#';
				}
				$this->db->insert('notifications',$notification);
			}
		return $res;
	}
	/*public function preview($story_id) {
		return $this->db->from('stories')->where('sid',$story_id)->limit(1)->get();
	}
    public function test($sid){
		return $this->db->from('stories')->where('sid',$sid)->get();
	}*/
    public function comment_get($storyid = false, $start=false, $limit=false){
        /*if(isset($_GET['id']) && !empty($_GET['id'])){  $sid = $_GET['id'];
        	$this->db->select('comments.*, signup.profile_image')->from('comments')
        	    ->join('signup','comments.user_id = signup.user_id','left')->where('comments.story_id',$sid)
        	    ->where('comments.comment_id',0)->order_by('cid','desc');
        	if(isset($limit, $start) && !empty($limit)){
        	    $this->db->limit($limit, $start);
        	}else{
        	    $this->db->limit(2);
        	}
    	    $query = $this->db->get();
        	return $query;
        } else*/
        if(isset($storyid) && !empty($storyid)){
            $this->db->select('comments.*, signup.profile_image, signup.profile_name')->from('comments')
        	    ->join('signup','comments.user_id = signup.user_id','left')->where('comments.story_id',$storyid)
        	    ->where('comments.comment_id',0)->order_by('cid','desc');
        	if(isset($limit, $start) && !empty($limit)){
        	    $this->db->limit($limit, $start);
        	}else{
        	    $this->db->limit(2);
        	}
    	    $query = $this->db->get();
    	    return $query;
        }
    }
    public function addepisode($data, $sid = false){
        if(isset($data['last_episode']) && ($data['last_episode'] == 'yes')){
            $this->db->where('story_id', $data['story_id'])->update('stories',array('draft' => ''));
        }
        $this->db->where('story_id', $data['story_id'])->update('stories',array('draft' => ''));
        $subsmembers = $this->db->from('readlater')->where('story_id',$data['story_id'])->where('type','seriessubscribe')->get();
        if(isset($sid) && !empty($sid)){
            $seriesepiupdate =  $this->db->where('sid', $sid)->update('stories',$data);
            if($subsmembers->num_rows() > 0){
                $langsegurl = ''; $language = $this->langshortname($this->uri->segment(1));
    		    if(isset($language) && !empty($language) && ($language != 'en')){
    		        $langsegurl = $this->uri->segment(1)."/";
    		    }
                foreach($subsmembers->result() as $subsmember){
    	        $notification = array(
    				'type' => 'seriesepisode',
    				'from_name' => $this->session->userdata['logged_in']['name'],
    				'from_id' => $data['user_id'],
    				'to_name' => '',
    				'to_id' => $subsmember->user_id,
    				'title' => $data['title'],
    				'title_id' => $sid,
    				'redirect_uri' => 'series/'.preg_replace('/\s+/', '-', $data['title'])."-".$sid.'/'.preg_replace('/\s+/', '-', $data['title'])."-".$data['story_id'],
    				'created_at' => Date('Y-m-d H:i:s'),
    			);
    			$this->db->insert('notifications',$notification);
    	    }   }
            return $seriesepiupdate;
        }else{
    	    $insert = $this->db->insert('stories',$data);
    	    $insertid = $this->db->insert_id();
    	    if($subsmembers->num_rows() > 0){
    	        $langsegurl = ''; $language = $this->langshortname($this->uri->segment(1));
    		    if(isset($language) && !empty($language) && ($language != 'en')){
    		        $langsegurl = $this->uri->segment(1)."/";
    		    }
    	        foreach($subsmembers->result() as $subsmember){
    	        $notification = array(
    				'type' => 'seriesepisode',
    				'from_name' => $this->session->userdata['logged_in']['name'],
    				'from_id' => $data['user_id'],
    				'to_name' => '',
    				'to_id' => $subsmember->user_id,
    				'title' => $data['title'],
    				'title_id' => $insertid,
    				'redirect_uri' => 'series/'.preg_replace('/\s+/', '-', $data['title'])."-".$insertid.'/'.preg_replace('/\s+/', '-', $data['title'])."-".$data['story_id'],
    				'created_at' => Date('Y-m-d H:i:s'),
    			);
    			$this->db->insert('notifications',$notification);
    	    }   }
			return $insert;
        }
    }
    public function addseriesepisode($data){
        $this->db->insert('stories',$data);
        return $this->db->insert_id();
    }
    public function seriesaddtodrafts($data, $sid){
        if(isset($sid) && !empty($sid)){
            $this->db->where('sid', $sid)->update('stories',$data);
            return $sid;
        }else{
            $this->db->insert('stories',$data);
            return $this->db->insert_id();
        }
    }
    public function prefacetitle($sid){
    	$query = $this->db->select('title')->from('stories')->where('sid', $sid)->where('story_id', $sid)->get()->row_array();
    	if(isset($query['title']) && !empty($query['title'])){
    		return $query['title'];
    	}
    }
    public function prefaceautosave($data, $sid){
        return $this->db->where('sid', $sid)->update('stories',$data);
    }
    public function get_episode($id = false){
    	if(isset($_GET['id']) && !empty($_GET['id'])) {
	    	$id = $_GET['id'];
	    	$query = $this->db->query("select * from stories s left join gener g on g.id=s.genre left join signup u on 
	    	    u.user_id=s.user_id  where s.status='active' AND s.story_id=?",$id);
	    	return $query;
	    }elseif (isset($id) && !empty($id)) {
	    	$query = $this->db->query("select * from stories s left join gener g on g.id=s.genre left join signup u on 
    	    	u.user_id=s.user_id  where s.status='active' AND s.story_id=?",$id);
	    	return $query;
	    }
    }
    public function nano_insert($data){
    	$insert = $this->db->insert('stories',$data);
    	$insert_id =  $this->db->insert_id();
    	$follow = $this->db->from('follow')->where('writer_id',$data['user_id'])->get();
		if($follow->num_rows() > 0) { 
		    foreach($follow->result() as $follow) { if($follow->user_id != $data['user_id']){
    			$notification = array(
    				'type' => 'newnano',
    				'from_name' => $this->session->userdata['logged_in']['name'],
    				'from_id' => $data['user_id'],
    				'to_name' => $follow->name,
    				'to_id' => $follow->user_id,
    				'title' => '',
    				'title_id' => $insert_id,
    				'redirect_uri' => '#',
    				'created_at' => Date('Y-m-d H:i:s'),
    			);
    			$this->db->insert('notifications',$notification);
    		}   }
		}
		return $insert;
    }
    public function get_nano(){
    	$language = $this->langshortname($this->uri->segment(1));
    	$this->db->select('stories.*, signup.*, 
    	    (SELECT COUNT(readlater.id) FROM readlater WHERE readlater.type="nanolike" AND readlater.story_id = stories.sid) as nanolikecount')
    	    ->from('stories')->join('signup','signup.user_id=stories.user_id','left')
			->where('stories.status','active')->where('stories.draft !=','draft')->where('stories.type','nano');
			if(isset($language) && !empty($language)){
			    $this->db->where('stories.language',$language);
			}
			$this->db->order_by('stories.sid','Desc')->limit(7);
		$query = $this->db->get();
        return $query;
    }
    public function get_life($searchdata = false, $limit = false){
    	$language = $this->langshortname($this->uri->segment(1));
	    $this->db->select('stories.*, gener.*, signup.*')->from('stories')
	        ->join('gener','stories.genre = gener.id', 'left')->join('signup','stories.user_id = signup.user_id','left')
	        ->where('stories.status','active')->where('stories.type','life')->where('stories.draft !=','draft');
	        if(isset($language) && !empty($language)){
	            $this->db->where('stories.language',$language);
	        }
	        $this->db->order_by('stories.sid','DESC');
        /*if(isset($searchdata) && !empty($searchdata)){
		    $searchcon = "(stories.title LIKE '%$searchdata%' OR stories.etitle LIKE '%$searchdata%' OR signup.name LIKE '%$searchdata%' OR stories.keywords LIKE '%$searchdata%')";
		    $this->db->where($searchcon)->where('stories.writing_style !=','anonymous');
		}*/
		if(isset($limit) && ($limit == 'all')){
		}else{
    	    $this->db->limit(7);
		}
		return $this->db->get();
	}
	public function count(){
	    $query =  $this->db->query("SELECT user_id, COUNT(*) FROM stories GROUP BY user_id");
		return $query;
	}
	public function likes($data,$sid) {
		$res=$this->db->select('likes')->from('stories')->where('sid',$sid)->get()->result();
		$query = $this->db->from('likes')->where('user_id',$data['user_id'])->where('sid',$data['sid'])->get();
		if($query->num_rows() > 0) {
			return $res;
		}else {
			$insert = $this->db->insert('likes',$data);
			$update =$this->db->where('sid',$sid)->set('likes','likes + 1',FALSE)->update('stories');
			$res=$this->db->select('likes')->from('stories')->where('sid',$sid)->get()->result();
			$likestory = $this->db->select('user_id, title')->from('stories')->where('sid',$data['sid'])->limit(1)->get()->result();
			if(isset($likestory[0]->user_id) && ($likestory[0]->user_id != $data['user_id'])) {
			    $langsegurl = ''; $language = $this->langshortname($this->uri->segment(1));
    		    if(isset($language) && !empty($language) && ($language != 'en')){
    		        $langsegurl = $this->uri->segment(1)."/";
    		    }
				$notification = array(
					'type' => 'storylike',
					'from_name' => $this->session->userdata['logged_in']['name'],
					'from_id' => $data['user_id'],
					'to_name' => '',
					'to_id' => $likestory[0]->user_id,
					'title' => '',
					'title_id' => $data['sid'],
					'redirect_uri' => 'series/'.preg_replace('/\s+/', '-', $likestory[0]->title)."-".$data['sid'].'/'.preg_replace('/\s+/', '-', $likestory[0]->title)."-".$data['sid'],
					'created_at' => Date('Y-m-d H:i:s'),
				);
				$this->db->insert('notifications',$notification);
			}
			return $res;
		}
	}
	public function admin_story_view1($storyid) {
    	$query = $this->db->select('stories.*, gener.*, signup.*')->from('stories')
        	->join('gener','gener.id = stories.genre','left')->join('signup','signup.user_id = stories.user_id','left')
        	->where('stories.status','active')->where('stories.sid',$storyid)->limit(1)->get();
        return $query;
	}
    
	public function userrating($storyid){
	    if(isset($storyid) && isset($this->session->userdata['logged_in']['user_id'])){
    	    $userid = $this->session->userdata['logged_in']['user_id'];
		    $query = $this->db->select('rating')->from('rating')->where('story_id',$storyid)->where('user_id', $userid)->get()->result();
		    if(isset($query[0]->rating)){
		        return $query[0]->rating;
		    }
	    }else{
	        return 0;
	    }
	}
	public function project($data) {
		$query = $this->db->from('project')->where('story_id',$data['story_id'])->where('user_id',$data['user_id'])->get();
		if($query->num_rows() > 0){
		}else{
			return $this->db->insert('project',$data);
		}
	}
	public function notification() {
		$id = $this->session->userdata['logged_in']['user_id'];         
		$comments = $this->db->select('comments.name as cname, comments.*, stories.*')->from('comments')
			->join('stories','comments.story_id = stories.sid','left')->where('stories.user_id',$id)
			->where('stories.status','active')->order_by('cid','desc')->get()->result();  
        $likes = $this->db->select('likes.*')->from('likes')
			->join('stories','likes.sid = stories.sid','left')->where('stories.user_id',$id)->where('stories.status','active')
			->order_by('id','desc')->get()->result();
        return array('comments' => $comments,'likes' => $likes);
	}
	public function readlater($data) {
		$query = $this->db->from('readlater')->where($data)->get();
		if($query->num_rows() > 0) {
		    if($data['type'] == 'seriessubscribe'){
			    $this->db->from('notifications')->where('type', 'seriessubscribe')->where('from_id', $data['user_id'])->where('title_id', $data['story_id'])->delete();
		    }elseif($data['type'] == 'favorite'){
		        $this->db->from('notifications')->where('type', 'favorite')->where('from_id', $data['user_id'])->where('title_id', $data['story_id'])->delete();
		    }
			$unread = $this->db->from('readlater')->where($data)->delete();
			//print_r($unread);exit();
			if($unread){ return 2; } else{ return 1; }
		}else{
			$insert = $this->db->insert('readlater',$data);
			if(isset($data['type']) && ($data['type'] == 'seriessubscribe')){
			    $storytitle = $this->db->select('user_id, title')->from('stories')->where('sid',$data['story_id'])->where('type','series')->limit(1)->get()->result();
    			if(isset($storytitle[0]->user_id) && isset($storytitle[0]->title)){
    			    $langsegurl = ''; $language = $this->langshortname($this->uri->segment(1));
        		    if(isset($language) && !empty($language) && ($language != 'en')){
        		        $langsegurl = $this->uri->segment(1)."/";
        		    }
        			$notify = array(
                    	'type' => 'seriessubscribe',
                    	'from_name' => $this->session->userdata['logged_in']['name'],
                    	'from_id' => $data['user_id'],
                    	'to_name' => '',
                    	'to_id' => $storytitle[0]->user_id,
                    	'title' => $storytitle[0]->title,
                    	'title_id' => $data['story_id'],
                    	'redirect_uri' => 'series/'.preg_replace('/\s+/', '-', $storytitle[0]->title)."-".$data['story_id'].'/'.preg_replace('/\s+/', '-', $storytitle[0]->title)."-".$data['story_id'],
                    	'created_at' => Date('Y-m-d H:i:s'),
        			);
        			$this->db->insert('notifications', $notify);
        			
        			$to_email = $this->getuseremail($storytitle[0]->user_id);
        			$subject = $this->session->userdata['logged_in']['name'].' subscribed your series';
        			$message = 'Story Carry user '.$this->session->userdata['logged_in']['name'].' subscribed your series '.$storytitle[0]->title;
        			if(isset($to_email) && !empty($to_email)){
        			    $this->sendnotifymail($to_email,$subject,$message);
        			}
        			
    			}
			}elseif(isset($data['type']) && ($data['type'] == 'favorite')){
			    $favstorytitle = $this->db->select('user_id, title')->from('stories')->where('sid',$data['story_id'])->limit(1)->get()->result();
    			if(isset($favstorytitle[0]->user_id) && isset($favstorytitle[0]->title)){
    			    $langsegurl = ''; $language = $this->langshortname($this->uri->segment(1));
        		    if(isset($language) && !empty($language) && ($language != 'en')){
        		        $langsegurl = $this->uri->segment(1)."/";
        		    }
        			$favnotify = array(
                    	'type' => 'favorite',
                    	'from_name' => $this->session->userdata['logged_in']['name'],
                    	'from_id' => $data['user_id'],
                    	'to_name' => '',
                    	'to_id' => $favstorytitle[0]->user_id,
                    	'title' => $favstorytitle[0]->title,
                    	'title_id' => $data['story_id'],
                    	'redirect_uri' => 'story/'.preg_replace('/\s+/', '-', $favstorytitle[0]->title)."-".$data['story_id'],
                    	'created_at' => Date('Y-m-d H:i:s'),
        			);
        			$this->db->insert('notifications', $favnotify);
        			$to_email = $this->getuseremail($favstorytitle[0]->user_id);
        			$subject = $this->session->userdata['logged_in']['name'].' favorited your story';
        			$message = 'Story Carry user '.$this->session->userdata['logged_in']['name'].' favorited your story '.$favstorytitle[0]->title;
        			if(isset($to_email) && !empty($to_email)){
        			    $this->sendnotifymail($to_email,$subject,$message);
        			}
    			}
			}
			if($insert) { return 1;	}else {	return 0; }
		}
	}
	public function nanolike($data){
	    $query = $this->db->from('readlater')->where($data)->get();
		if($query->num_rows() > 0) {
            if($data['type'] == 'nanolike'){
			    $this->db->from('notifications')->where('type', 'nanolike')->where('from_id', $data['user_id'])->where('title_id', $data['story_id'])->delete();
		    }
		    $unread = $this->db->from('readlater')->where($data)->delete();
			if($unread){ return 2; } else{ return 1; }
		}else{
    	    $storytitle = $this->db->select('user_id')->from('stories')->where('sid',$data['story_id'])->limit(1)->get()->result();
        	if(isset($storytitle[0]->user_id) && !empty($storytitle[0]->user_id) && ($storytitle[0]->user_id != $data['user_id'])){
        	    $insert = $this->db->insert('readlater',$data);
            	$notification = array(
        			'type' => 'nanolike',
        			'from_name' => $this->session->userdata['logged_in']['name'],
        			'from_id' => $data['user_id'],
        			'to_name' => '',
        			'to_id' => $storytitle[0]->user_id,
        			'title' => '',
        			'title_id' => $data['story_id'],
        			'redirect_uri' => '#',
        			'created_at' => Date('Y-m-d H:i:s'),
        		);
        		$this->db->insert('notifications',$notification);
        		$to_email = $this->getuseremail($storytitle[0]->user_id);
    			$subject = $this->session->userdata['logged_in']['name'].' liked your nano story';
    			$message = 'Story Carry user '.$this->session->userdata['logged_in']['name'].' liked your nano story.';
    			if(isset($to_email) && !empty($to_email)){
    			    $this->sendnotifymail($to_email,$subject,$message);
    			}
        		return $insert;
        	}else{
        	    return 0;
        	}
		}
	}
	public function libraryseries($userid, $type, $start = false, $limit = false){
	    $language = $this->langshortname($this->uri->segment(1));
        $this->db->select('stories.*, gener.id, gener.gener, signup.*') //, readlater.user_id, readlater.story_id
            ->from('readlater')->join('stories','readlater.story_id = stories.sid', 'left')
            ->join('gener','stories.genre = gener.id ','left')->join('signup','stories.user_id = signup.user_id','left');
			if(isset($type) && !empty($type)){
			    $this->db->where('readlater.type',$type);
			}
		$this->db->where('readlater.user_id',$userid)->where('stories.type','series')->where('stories.status','active')
		    ->where('stories.sid = stories.story_id')->where('stories.draft !=','draft')//->where('stories.language',$language)
		    ->group_by('stories.story_id')->order_by('readlater.id','desc');
		    if(isset($limit, $start) && !empty($limit)){
		        $this->db->limit($limit,$start);
		    }
		$query = $this->db->get();
        return $query;
    }
    public function librarystories($userid, $type){
        $language = $this->langshortname($this->uri->segment(1));
        $this->db->select('stories.*, gener.id, gener.gener, signup.*') //, readlater.user_id, readlater.story_id
            ->from('readlater')->join('stories','readlater.story_id = stories.sid', 'left')
            ->join('gener','stories.genre = gener.id ','left')->join('signup','stories.user_id = signup.user_id','left');
			if(isset($type) && !empty($type)){
			    $this->db->where('readlater.type',$type);
			}
		$query = $this->db->where('readlater.user_id',$userid)->where('stories.draft !=','draft')
		    ->where(' ( (stories.type="story") OR (stories.type="series" AND stories.sid != stories.story_id) ) ')
		    ->where('stories.status','active')//->where('stories.language',$language)
		    ->order_by('readlater.id','desc')->get();
        return $query;
    }
    public function librarylife($userid, $type){
        $language = $this->langshortname($this->uri->segment(1));
        $this->db->select('stories.*, gener.id, gener.gener, signup.*') //, readlater.user_id, readlater.story_id
            ->from('readlater')->join('stories','readlater.story_id = stories.sid', 'left')
            ->join('gener','stories.genre = gener.id ','left')->join('signup','stories.user_id = signup.user_id','left');
			if(isset($type) && !empty($type)){
			    $this->db->where('readlater.type',$type);
			}
		$query = $this->db->where('readlater.user_id',$userid)->where('stories.type','life')->where('stories.draft !=','draft')
		    ->where('stories.status','active')->order_by('readlater.id','desc')->get();//->where('stories.language',$language)
        return $query;
    }
    
    public function genertopstories($generid ,$start=false, $limit=false){
        $language = $this->langshortname($this->uri->segment(1));
        /*$query = "SELECT stories.*, gener.gener, signup.*, (COUNT(story_views.id)/30) as uniview_subs FROM stories 
        LEFT JOIN story_views ON stories.sid = story_views.story_id LEFT JOIN signup on stories.user_id = signup.user_id 
        LEFT JOIN gener on stories.genre = gener.id WHERE (stories.type='story' OR (stories.type='series' AND 
         stories.sid != stories.story_id)) AND stories.draft !='draft' AND stories.genre = ".$generid." 
         AND stories.language ='$language' AND stories.status='active' GROUP BY story_views.story_id 
         ORDER BY uniview_subs DESC LIMIT 7";
        return $this->db->query($query);*/
        
        $query = "SELECT stories.*, gener.gener, signup.*, 
         (SELECT COUNT(story_views.id)/30 FROM story_views WHERE stories.sid = story_views.story_id) as uniview_subs 
         FROM stories LEFT JOIN signup on stories.user_id = signup.user_id 
         LEFT JOIN gener on stories.genre = gener.id WHERE (stories.type ='story' OR (stories.type = 'series' AND 
         stories.sid != stories.story_id)) AND stories.draft !='draft' AND stories.genre = ".$generid." 
         AND stories.language ='$language' AND stories.status='active' ORDER BY uniview_subs DESC , stories.views DESC";
         if(isset($start, $limit) && !empty($limit)){
             $query = $query.' LIMIT '.$start.' , '.$limit;
         }
        return $this->db->query($query);
        
    }
    public function generstories($generid, $start, $limit){
        $language = $this->langshortname($this->uri->segment(1));
        $this->db->select('stories.*, gener.gener, signup.*')->from('stories')
            ->join('gener','stories.genre = gener.id ','left')->join('signup','stories.user_id = signup.user_id','left')
            ->where('(stories.type="story" OR (stories.type="series" AND stories.sid != stories.story_id))')
            ->where('stories.draft !=','draft')->where('gener.id',$generid)->where('stories.language',$language)
            ->where('stories.status','active');
        return $this->db->order_by('stories.sid','DESC')->limit($limit, $start)->get();
    }
    public function readlatermylists($type = false){
        $language = $this->langshortname($this->uri->segment(1));
        $id = $this->session->userdata['logged_in']['user_id'];
        $this->db->select('stories.*, gener.id, gener.gener, signup.*, readlater.story_id')->from('stories')
			->join('gener','gener.id=stories.genre','left')->join('signup','signup.user_id=stories.user_id','left')
			->join('readlater','readlater.story_id=stories.sid','left')->where('readlater.user_id',$id)
			->where('readlater.type','readlater')->where('stories.language',$language)->where('stories.status','active');
		if(isset($type) && !empty($type)){
		    $this->db->where('stories.type',$type);
		}
		$this->db->where('stories.type !=','nano');   
		$query = $this->db->group_by('readlater.story_id')->order_by('readlater.id','desc')->get();
        return $query;
    }
    public function get_communities($start=false,$limit=false){
        $language = $this->langshortname($this->uri->segment(1));
        if(isset($start) && ($start == 'all')){
            return $this->db->from('communities')->where('communities.joincomm_lang', $language)->order_by('id','desc')->get();
        }else if(isset($start) && ($start != 'all') && !empty($start)){
            return $this->db->from('communities')->where('communities.joincomm_lang', $language)
                ->order_by('id','desc')->limit($start)->get();
        }else{
            return $this->db->from('communities')->where('communities.joincomm_lang', $language)->order_by('id','desc')->get();
        }
    }
    public function loadcommunities($start=false, $limit=false){
        $language = $this->langshortname($this->uri->segment(1));
        return $this->db->from('communities')->where('communities.joincomm_lang', $language)
            ->order_by('id','desc')->limit($limit, $start)->get();
    }
    public function joinedcommunities($start=false, $limit=false){
        $language = $this->langshortname($this->uri->segment(1));
        if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])){
            $userid = $this->session->userdata['logged_in']['user_id'];
            return $this->db->select('communities.*')->from('communities_join')
            ->join('communities','communities_join.comm_id = communities.id','left')->where('communities_join.user_id',$userid)
            ->where('communities.joincomm_lang', $language)->order_by('communities.id','desc')->limit($limit, $start)->get();
        }
    }
    public function unjoinedcommunities($joinedcomm_ids,$start=false, $limit=false){
        $language = $this->langshortname($this->uri->segment(1));
        if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])){
            $userid = $this->session->userdata['logged_in']['user_id'];
            if(sizeof($joinedcomm_ids) > 0){
                return $this->db->from('communities')->where_not_in('id',$joinedcomm_ids)
                ->where('communities.joincomm_lang', $language)->order_by('id','desc')->limit($limit, $start)->get();
            }else{
                return $this->db->from('communities')->where('communities.joincomm_lang', $language)
                    ->order_by('id','desc')->limit($limit, $start)->get();
            }
        }
    }
    public function join_communities(){
        if(isset($this->session->userdata['logged_in']['user_id'])){
            $id = $this->session->userdata['logged_in']['user_id'];
            $joined = $this->db->from('communities_join')->where('user_id',$id)->get()->result();
            $joinedcommu = array();
            foreach ($joined as $joinedcom) {
                array_push($joinedcommu, $joinedcom->comm_id);
            }
            return $joinedcommu;
        } else {
            return $this->db->from('communities_join')->get()->result();
        }
    }
    public function changepassword($password)
	{
        if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])) {
            $id = $this->session->userdata['logged_in']['user_id'];
            //$email = $this->session->userdata['logged_in']['email'];
            return $this->db->select('password')->get_where('signup',array('user_id'=> $id,'password' => $password));
        }
   	}
    public function forgot_pass($email) {
		$query = $this->db->select('user_id')->get_where('signup',array('email'=> $email));
		if($query->num_rows() > 0) {
			$user = $query->result();
			
    		$this->email->from(ADMIN_EMAIL, ADMIN_NAME);
    		$this->email->to($email);     
    		$this->email->subject(ADMIN_NAME. ' Forgot Password Request');
    		$message = 'Dear User,<br /><br />Please click on the below link for new password.<br /><br /> '.base_url().'forgotpwd/' . md5($user[0]->user_id) . '<br /><br /><br />Thanks<br />Story Carry';
    		$this->email->message($message);
    		$this->email->set_mailtype('html');
    		$this->email->send();
			
			return $user[0]->user_id;
		}
	}
    public function resetpassword($new, $id) {
		$this->db->where('user_id', $id);
		return $this->db->update('signup', array('password'=> $new));
    }
    public function resetfpassword($new, $id) {
        $query = $this->db->where('md5(user_id)', $id)->update('signup', array('password'=> $new));
        if($query){
            return true;
        }
    }
	public function search($data) {
		//print_r($data);exit();
		if(isset($data) && !empty($data)) {
		$query = $this->db->select('stories.*,gener.*, signup.*')
			->from('stories')->join('gener','gener.id=stories.genre','left')
			->join('signup','signup.user_id=stories.user_id','left')
			->where('stories.genre',$data)
			
			->group_by('stories.story_id')->get();
          //$this->db->where($query);
			 return $query;  
        } 
       //print_r($query);exit();
    }
	public function home_filters($data) { 
		if(!empty($data)){
			$this->db->from('stories');
			if(isset($data['genre']) && !empty($data['genre'])) {
				$this->db->where('genre',$data['genre']);
			}
			return $this->db->where('stories.status','active')->get();    
		}else{
			return false;
		}
	}
	public function viewsupdate($sid = false){
		if(isset($sid) && !empty($sid)){
			$datetime = Date('Y-m-d H:i:s');
			$this->db->where('sid',$sid)->set('week_views','week_views + 1',FALSE)->set('updated_at', $datetime)->update('stories');
			$this->db->where('sid',$sid)->set('month_views','month_views + 1',FALSE)->set('updated_at', $datetime)->update('stories');
			$this->db->where('sid',$sid)->set('year_views','year_views + 1',FALSE)->set('updated_at', $datetime)->update('stories');
		    return $this->db->where('sid',$sid)->set('views','views + 1',FALSE)->update('stories');
		}
   	}
   	public function communities_join($data){
   		$query = $this->db->from('communities_join')->where('user_id',$data['user_id'])->where('comm_id',$data['comm_id'])->get();
		if($query->num_rows() > 0) {
			$unjoin = $this->db->where('user_id',$data['user_id'])->where('comm_id',$data['comm_id'])->delete('communities_join');
			if($unjoin){ return 2; }else{ return '';}
		}else{
			$insertjoin = $this->db->insert('communities_join',$data);
			if($insertjoin) { return 1; }else { return ''; }
		}
    }
    public function communities_story($data) {
		$this->db->insert('communities_story',$data);
		$insert_id =  $this->db->insert_id();  //print_r($data);exit();

		$commu = $this->db->from('communities_join')->where('comm_id',$data['comm_id'])->get();
		if($commu->num_rows() > 0) {
		    $langsegurl = ''; $language = $this->langshortname($this->uri->segment(1));
		    if(isset($language) && !empty($language) && ($language != 'en')){
		        $langsegurl = $this->uri->segment(1)."/";
		    }
		    foreach($commu->result() as $commu) { if($data['user_id'] != $commu->user_id){
			$notification = array(
				'type' => 'communitystory',
				'from_name' => $this->session->userdata['logged_in']['name'],
				'from_id' => $data['user_id'],
				'to_name' => $commu->username,
				'to_id' => $commu->user_id,
				'title' => $commu->gener,
				'title_id' => $data['comm_id'],
				//'redirect_uri' => 'co_view/'.$data['comm_id'],
				'redirect_uri' => 'community-story/'.preg_replace('/\s+/', '-', $commu->gener).'/'.$insert_id,
				'created_at' => Date('Y-m-d H:i:s'),
			);
			$this->db->insert('notifications',$notification);
		}	}   }
		//return $this->db->from('communities_story')->where('id',$insert_id)->get();
		return $this->db->select('communities_story.*, signup.user_id, signup.profile_image, signup.profile_name')->from('communities_story')
    	->join('signup','communities_story.user_id = signup.user_id','left')->where('communities_story.id',$insert_id)->limit(1)->get();
	}
	public function updatecomm_post($data, $comm_storyid) {
	    return $this->db->where('id',$comm_storyid)->update('communities_story', $data);
	}
    public function communities_story_get($commuid,$start=false, $limit=false){
    	$language = $this->langshortname($this->uri->segment(1));
    	$this->db->select('communities_story.*, signup.user_id, signup.profile_image, signup.profile_name')
    	    ->from('communities_story')->join('signup','communities_story.user_id = signup.user_id','left');
	    /*if(isset($language) && !empty($language)){
	        $this->db->where('communities_story.comm_language',$language);
	    }*/
    	return $this->db->where('communities_story.comm_id',$commuid)->order_by('communities_story.id','DESC')
    	    ->limit($limit, $start)->get();
    }
    public function commstoryview($commid, $comm_storyid){
    	return $this->db->select('communities_story.*, signup.user_id, signup.profile_image, signup.profile_name')
    	    ->from('communities_story')->join('signup','communities_story.user_id = signup.user_id','left')
    	    //->where('communities_story.comm_id',$commid) // single post story to display in other languages also
    	    ->where('communities_story.id',$comm_storyid)->limit(1)->get();
    }
    public function communities_get_topstory($commuid){
    	$query1 = $this->db->select('communities_story.*, signup.user_id, signup.profile_image, signup.profile_name')
    	    ->from('communities_story')->join('signup','communities_story.user_id = signup.user_id','left')
        	->where('communities_story.comm_id',$commuid)->where('communities_story.likes >',0)
        	->where('communities_story.date BETWEEN (NOW() - INTERVAL 7 DAY) AND NOW()')
        	->order_by('communities_story.likes','DESC')->order_by('communities_story.date','DESC')->get()->result();
        
        $query2 = $this->db->select('communities_story.*, signup.user_id, signup.profile_image, signup.profile_name')
    	    ->from('communities_story')->join('signup','communities_story.user_id = signup.user_id','left')
        	->where('communities_story.comm_id',$commuid)->where('communities_story.likes >',0)
        	->where('communities_story.date <= (NOW() - INTERVAL 7 DAY)')
        	->order_by('communities_story.likes','DESC')->order_by('communities_story.date','DESC')->get()->result();
        
        $query3 = $this->db->select('communities_story.*, signup.user_id, signup.profile_image, signup.profile_name')
            ->from('communities_story')->join('signup','communities_story.user_id = signup.user_id','left')
            ->where('communities_story.comm_id',$commuid)->where('communities_story.likes',0)
            ->order_by('communities_story.date','DESC')->get()->result();
        $query = array_merge($query1, $query2, $query3);
        return $query;
	}
    /*public function communities_get_topstory($commuid,$start=false, $limit=false){
    	$this->db->select('communities_story.*, signup.user_id, signup.profile_image, signup.profile_name')
    	    ->from('communities_story')->join('signup','communities_story.user_id = signup.user_id','left')
        	->where('communities_story.comm_id',$commuid)->where('communities_story.likes >',0)
        	->where('communities_story.date BETWEEN (NOW() - INTERVAL 7 DAY) AND NOW()');
        return $this->db->order_by('communities_story.likes','DESC')->order_by('communities_story.date','DESC')->limit($limit, $start)->get();
	}
	public function communities_story_weekback($commuid,$start=false, $limit=false){
    	$this->db->select('communities_story.*, signup.user_id, signup.profile_image, signup.profile_name')
    	    ->from('communities_story')->join('signup','communities_story.user_id = signup.user_id','left')
        	->where('communities_story.comm_id',$commuid)->where('communities_story.likes >',0)
        	->where('communities_story.date <= (NOW() - INTERVAL 7 DAY)');
        return $this->db->order_by('communities_story.likes','DESC')->order_by('communities_story.date','DESC')->limit($limit, $start)->get();
	}
	public function communities_story_zerolikes($commuid ,$start=false, $limit=false){
	    return $this->db->select('communities_story.*, signup.user_id, signup.profile_image, signup.profile_name')
            ->from('communities_story')->join('signup','communities_story.user_id = signup.user_id','left')
            ->where('communities_story.comm_id',$commuid)->where('communities_story.likes',0)
            ->order_by('communities_story.date','DESC')->limit($limit, $start)->get();
	}*/
    public function communities_comments($data){
		$this->db->insert('comm_comments',$data);
		$insert_id =  $this->db->insert_id();
		$commu = $this->db->from('communities_join')->where('comm_id',$data['comm_id'])->get();
		if($commu->num_rows() > 0) {
		    $langsegurl = ''; $language = $this->langshortname($this->uri->segment(1));
		    if(isset($language) && !empty($language) && ($language != 'en')){
		        $langsegurl = $this->uri->segment(1)."/";
		    }
		    foreach($commu->result() as $commu) { if($data['user_id'] != $commu->user_id){
			$notification = array(
				'type' => 'communitycomment',
				'from_name' => $this->session->userdata['logged_in']['name'],
				'from_id' => $data['user_id'],
				'to_name' => $commu->username,
				'to_id' => $commu->user_id,
				'title' => $data['comment'],
				'title_id' => $data['comm_id'],
				//'redirect_uri' => 'index.php/welcome/co_view/'.$data['comm_id'],
				'redirect_uri' => 'community-story/'.preg_replace('/\s+/', '-', $commu->gener).'/'.$data['story_id'],
				'created_at' => Date('Y-m-d H:i:s'),
			);
			$this->db->insert('notifications',$notification);
		}   }   }
		return $insert_id;
	}
    public function communities_comments_get(){
    	$query = $this->db->select('comm_comments.*, communities_story.id, signup.user_id, signup.profile_image, signup.profile_name')
    	->from('comm_comments')
    	->join('signup','comm_comments.user_id= signup.user_id','left')
    	->join('communities_story','comm_comments.story_id= communities_story.id','left')
    	->order_by('comm_comments.id','DESC')
    	->get();
    	return $query;
    }
	public function comm_likes($data,$story_id) {
		$query = $this->db->from('comm_likes')->where('user_id',$data['user_id'])->where('story_id',$data['story_id'])->get();
		if($query->num_rows() > 0) {
			$remove = $this->db->where('user_id',$data['user_id'])->where('story_id',$data['story_id'])->delete('comm_likes');
			$update = $this->db->where('id',$story_id)->set('likes','likes - 1',FALSE)->update('communities_story');
			if($remove){   return 2;    } else{ return ''; }
		}else{
			$insert = $this->db->insert('comm_likes',$data);
            $update = $this->db->where('id',$story_id)->set('likes','likes + 1',FALSE)->update('communities_story');
			$comlikestory = $this->db->select('user_id, comm_id')->from('communities_story')->where('id',$data['story_id'])->limit(1)->get()->result();
			if(isset($comlikestory[0]->user_id) && ($data['user_id'] != $comlikestory[0]->user_id)) {
			    $langsegurl = ''; $language = $this->langshortname($this->uri->segment(1));
    		    if(isset($language) && !empty($language) && ($language != 'en')){
    		        $langsegurl = $this->uri->segment(1)."/";
    		    }
    		    $commugener = $this->db->select('gener')->from('communities')->where('id',$comlikestory[0]->comm_id)->limit(1)->get()->result();
				$notification = array(
					'type' => 'commustorylike',
					'from_name' => $this->session->userdata['logged_in']['name'],
					'from_id' => $data['user_id'],
					'to_name' => '',
					'to_id' => $comlikestory[0]->user_id,
					'title' => '',
					'title_id' => $data['story_id'],
					//'redirect_uri' => 'index.php/Welcome/co_view/'.$comlikestory[0]->comm_id,
					'redirect_uri' => 'community-story/'.preg_replace('/\s+/', '-', $commugener[0]->gener).'/'.$data['story_id'],
					'created_at' => Date('Y-m-d H:i:s'),
				);
				$this->db->insert('notifications',$notification);
			}
			if($insert) { return 1; }else {	return ''; }
		}
	}
    
    public function feed($start=false, $limit=false){
        if(isset($this->session->userdata['logged_in'])){
            $commids = array();
        	$user_id = $this->session->userdata['logged_in']['user_id'];
            $query = $this->db->select('comm_id')->from('communities_join')->where('user_id',$user_id)->get();
            if($query->num_rows() > 0){ foreach($query->result() as $row){ 
                array_push($commids, $row->comm_id);
            }   }
            $writerids = array();
            $writeridsfromfollow = $this->db->select('writer_id')->from('follow')->where('user_id',$user_id)->get();
            if($writeridsfromfollow->num_rows() > 0){ foreach($writeridsfromfollow->result() as $writerid){
                array_push($writerids,$writerid->writer_id);
            }   }
            if(count($writerids) > 0){
                $followcommunityids = $this->db->select('comm_id')->where_in('user_id',$writerids)->from('communities_join')->group_by('comm_id')->get();
                if($followcommunityids->num_rows() > 0){ foreach($followcommunityids->result() as $followcommids){
                    array_push($commids, $followcommids->comm_id);
                }   }
            }
            if(count($commids) > 0){
                $commids = array_unique($commids);
                return $this->db->select('communities_story.*, signup.user_id, signup.profile_image, signup.profile_name, signup.name,
                    communities.id as co_id, communities.gener')->from('communities_story')
                    ->join('signup','communities_story.user_id= signup.user_id','left')
    	            ->join('communities','communities_story.comm_id= communities.id','left')
                    ->where_in('communities_story.comm_id',$commids)->where('communities_story.user_id !=',$user_id)
                    ->order_by('communities_story.id','DESC')->limit($limit, $start)->get();
            }
        }
    }
    public function yourfeeds($start=false, $limit=false){
        if(isset($this->session->userdata['logged_in'])){
        	$user_id = $this->session->userdata['logged_in']['user_id'];
        	return $this->db->select('communities_story.*, signup.name, signup.user_id, signup.profile_image, signup.profile_name, 
        	    communities.id as co_id, communities.gener')->from('communities_story')
                ->join('signup','communities_story.user_id= signup.user_id','left')
	            ->join('communities','communities_story.comm_id= communities.id','left')
                ->where('communities_story.user_id',$user_id)->order_by('communities_story.id','DESC')
                ->limit($limit, $start)->get();
        }
    }
    public function storiesfeed($start=false, $limit=false){
        if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])){
        	$user_id = $this->session->userdata['logged_in']['user_id'];
        	return $this->db->select('feeds_story.created_at, signup.name, signup.profile_image, signup.profile_name, stories.*, gener.gener')
        	    ->from('feeds_story')->join('signup','feeds_story.writer_id = signup.user_id','left')
	            ->join('stories','feeds_story.story_id = stories.sid','left')->join('gener','stories.genre = gener.id','left')
                ->where('feeds_story.user_id',$user_id)->where('stories.status','active')
                ->group_by('feeds_story.story_id')->order_by('feeds_story.id','DESC')->limit($limit, $start)->get();
        }
    }
    public function feed_comments(){
    	$query = $this->db->select('comm_comments.*, communities_story.id, signup.user_id, signup.profile_image, signup.profile_name')
        	->from('comm_comments')
        	->join('signup','comm_comments.user_id= signup.user_id','left')
        	->join('communities_story','comm_comments.story_id= communities_story.id','left')
        	->get();
        	return $query;
    }
    public function follow($data){
     	$query = $this->db->from('follow')->where('user_id',$data['user_id'])->where('writer_id',$data['writer_id'])->get();
		if($query->num_rows() > 0) {
			$remove = $this->db->where('user_id',$data['user_id'])->where('writer_id',$data['writer_id'])->delete('follow');
			$this->db->where('from_id',$data['user_id'])->where('to_id',$data['writer_id'])->where('type','writerfollow')->delete('notifications');
			if($remove){   return 2;    } else{ return ''; }
		}else{
			$insert = $this->db->insert('follow',$data);
			$notify = array(
            	'type' => 'writerfollow',
            	'from_name' => $data['name'],
            	'from_id' => $data['user_id'],
            	'to_name' => $data['writer_name'],
            	'to_id' => $data['writer_id'],
            	'created_at' => Date('Y-m-d H:i:s'),
            	/*'title' => '',
            	'title_id' => '',
            	'redirect_uri' => '',
            	'status' => '',
            	'created_at' => '',
            	'description' => '',*/
			);
			$this->db->insert('notifications', $notify);
			if($insert) {	return 1;	}else { return '';  }
		}
    }
    public function following() {
        if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])){
    	  	$id = $this->session->userdata['logged_in']['user_id'];
    	  	$follow = $this->db->from('follow')->where('user_id',$id)->get()->result();
    	  	$flowing = array();
    	  	foreach ($follow as $flow) {
    	  		array_push($flowing, $flow->writer_id);
    	  	}
    	  	return $flowing;
        }
	}
	public function reviews($id = false) {
	    /*if(isset($_GET['id']) && !empty($_GET['id'])){
            $id = $_GET['id'];
    		return $this->db->select('AVG(rating) rating')->from('rating')->where('story_id',$id)->get()->result();
	    }else*/
	    if(isset($id) && !empty($id)){
	        $query = $this->db->select('AVG(rating) rating')->from('rating')->where('story_id',$id)->get()->result();
	        if(isset($query[0]->rating) && !empty($query[0]->rating)){
	            return $query[0]->rating;
	        }
	    }
	}
	public function reviews_series($sid) {
        $seriesstoryids = array();
        $query =  $this->db->select('sid')->from('stories')->where('story_id',$sid)->where('stories.status','active')->get();
        if($query->num_rows() > 0){ foreach($query->result() as $row){
            array_push($seriesstoryids, $row->sid);
        }   }
        if(count($seriesstoryids) > 0){
		    $query1 = $this->db->select('AVG(rating) rating')->from('rating')->where_in('story_id',$seriesstoryids)->get()->result();
		    if(isset($query1[0]->rating) && !empty($query1[0]->rating)){
	            return $query1[0]->rating;
	        }
        }
	}
	public function reviews2() {
   	    $query = $this->db->select('AVG(rating.rating) as rating, rating.story_id, stories.sid')
   	        ->from('stories')->join('rating','stories.sid = rating.story_id','left')
   	        ->where('stories.status','active')->group_by('rating.story_id')->get();
	    return $query;
	}
	public function follow_count(){
		$query = $this->db->select('count(follow.writer_id) as follo, signup.user_id, signup.profile_name, follow.writer_id, follow.user_id')
    		->from('signup')->join('follow','signup.user_id=follow.writer_id','left')
    		->group_by('follow.writer_id')
    		->get();
		return $query;
	}  
	public function comm_comment_count($commid = false, $commstory_id = false)
    {
        if(isset($commstory_id) && !empty($commstory_id)){
            $comments = $this->db->select('count(id) as commentcount')->from('comm_comments')->where('story_id',$commstory_id)->where('comment_id',0)->get()->result();
            if(isset($comments[0]->commentcount)){
                return $comments[0]->commentcount;
            }
        }else if(isset($commid) && !empty($commid)){
       	    $comments = $this->db->select('comm_comments.*, communities_story.id, count(comm_comments.story_id) as commentcount')
            	->from('comm_comments')->join('communities_story','comm_comments.story_id = communities_story.id','left')
            	->where('comm_comments.comm_id',$commid)->where('comm_comments.comment_id',0)->group_by('comm_comments.story_id')->get();
        	return $comments;
        }
    }
    public function comm_like_count() {
        $likes = $this->db->select('comm_likes.*,communities_story.id,count(comm_likes.story_id) as likescount')->from('comm_likes')
        	->join('communities_story','comm_likes.story_id = communities_story.id','left')->group_by('comm_likes.story_id')->get();
    	return $likes;	
	}
	public function usercommstory_likes(){
	    if(isset($this->session->userdata['logged_in']['user_id'])){
	        $commstory_likes = array();
    		$user_id = $this->session->userdata['logged_in']['user_id'];
    		$usercommstory_likes = $this->db->select('story_id')->from('comm_likes')->where('user_id', $user_id)->get();
    		if($usercommstory_likes->num_rows() > 0){ foreach($usercommstory_likes->result() as $usercommstory_like){
    		    array_push($commstory_likes, $usercommstory_like->story_id);
    		}   }
    		return $commstory_likes;
	    }
	}
	/*public function funding() {
		if(isset($_GET['id']) && !empty($_GET['id'])) {
			$id = $_GET['id'];
			return $this->db->from('project')->where('story_id',$id)->where('activetion','active')->limit(1)->get();
		}
	}
	public function colfund() {
		if(isset($_GET['id']) && !empty($_GET['id'])) {
			$id = $_GET['id'];
			return $this->db->select('SUM(amount) as colfund')->from('funding')->where('story_id', $id)->limit(1)->get();
		}
	}
	public function searchh($item) {
		$search_explode = explode(" ",$item);
		$language = $this->langshortname($this->uri->segment(1));
		$condition_arr = array();
		$condition = "WHERE t.title LIKE '%".$item."%' OR t.sub_title LIKE '%".$item."%' OR t.keywords LIKE '%".$item."%'";
		$query1 = 'SELECT t.* from ( SELECT distinct type from stories ) as td left join stories as t on t.type = td.type and t.sid >= coalesce( ( SELECT ti.sid from stories as ti where ti.type = td.type order by ti.sid desc limit 1 offset 1 ), -9223372036854775808 ) '.$condition;
		$query = $this->db->query($query1);
		foreach($query->result() as $row) {
			//$response[] = array("label"=>$row->title,"id"=>$row->title);
			$response[$row->type][] = array("value"=>$row->title, "label"=>$row->sub_title, "url"=>base_url().'new_series?id='.$row->sid.'&story_id='.$row->sid, "image"=>base_url().'assets/images/'.$row->cover_image, "type" => $row->type);
		}
		if((isset($response) && (sizeof($response) > 0))){
    		echo json_encode($response);
    	}else{
    		echo json_encode(array("value"=>'No Data'));
    	}    	
	}
	public function fund_pay($data) {
		$this->db->insert('funding',$data);
		return $this->db->insert_id();
	}
	public function confirmfund($fundid) {
		return $this->db->from('funding')->where('id',$fundid)->limit(1)->get();
	}
	public function paymentsuccess($data) {
		return $this->db->where('id',$data['funding_id'])->where('story_id',$data['story_id'])->update('funding',array('razorid'=>$data['razor_id']));
	}
 	public function searchtext($item) {
		$search_explode = explode(" ",$item);
		$language = $this->langshortname($this->uri->segment(1));
		$condition_arr = array();
		foreach($search_explode as $value){
			$condition_arr[] = " t.title LIKE '%".$value."%' OR t.sub_title LIKE '%".$value."%' OR t.keywords LIKE '%".$value."%' OR t.story LIKE '%".$value."%'";
		}
		$query2 = '';
		if(!empty($language)) {
			$query2 = ' t.language="'.$language.'" AND ';
		}
		$condition = " ";
		if(count($condition_arr) > 0){
			$condition = "WHERE ".$query2."( ".implode(" or ",$condition_arr).")";
		}
		$query1 = 'SELECT t.* from ( SELECT distinct type from stories ) as td left join stories as t on t.type = td.type and t.sid >= coalesce( ( SELECT ti.sid from stories as ti where ti.type = td.type order by ti.sid desc limit 1 offset 1 ), -9223372036854775808 ) '.$condition;
		$query = $this->db->query($query1);
		foreach($query->result() as $row) {
			$response[] = array("label"=>$row->title,"id"=>$row->title);
		}
		if((isset($response) && (sizeof($response) > 0))){
    		echo json_encode($response);
    	}else{
    		echo json_encode(array("label"=>'No Data'));
    	}
    	
	}*/
	

    public function hcomments($id) {
        return $this->db->select('comm_comments.*, signup.profile_image, signup.profile_name, signup.name')->from('comm_comments')
            ->join('signup','comm_comments.user_id = signup.user_id','left')
            ->where('comm_comments.story_id',$id)->where('comm_comments.comment_id',0)->order_by('comm_comments.id','DESC')
            ->limit(2)->get();
    }
    public function hsubcmtcount($id) {
        $query = $this->db->select('COUNT(comm_comments.id) as subcmtcount')->from('comm_comments')
            ->where('comm_comments.comment_id',$id)->get()->result();
        if(isset($query[0]->subcmtcount)){
            return $query[0]->subcmtcount;
        }else{
            return 0;
        }
    }
    public function hsubcomments($storyid, $commentid){
        if(isset($commentid) && !empty($commentid)){
            return $this->db->select('comm_comments.*, signup.profile_image, signup.profile_name')->from('comm_comments')
                ->join('signup','comm_comments.user_id = signup.user_id','left')
                ->where('comm_comments.story_id',$storyid)->where('comm_comments.comment_id !=',0)
                ->where('comm_comments.comment_id',$commentid)->order_by('comm_comments.id','DESC')->limit(2)->get();
        }
    }
    
    public function hstorysubcmtcount($commentid, $storyid){
        $query = $this->db->select('COUNT(comments.cid) as storysubcmtcount')->from('comments')
            ->where('comments.comment_id',$commentid)->where('comments.story_id',$storyid)->get()->result();
        if(isset($query[0]->storysubcmtcount)){
            return $query[0]->storysubcmtcount;
        }else{
            return 0;
        }
    }
	/*public function get_funding_project(){
		$query = $this->db->select('stories.*, gener.id, gener.gener, signup.*, project.story_id')->from('stories')
			->join('gener','gener.id=stories.genre','left')
			->join('signup','signup.user_id=stories.user_id','left')
			->join('project','project.story_id=stories.sid','left')->where('stories.status','active')
			->where('project.activetion','active')->group_by('stories.story_id')->order_by('project.id','desc')->get();
        return $query;
    }

    public function filter() {
		$id = $_GET['id'];
		$language = $this->langshortname($this->uri->segment(1));
		$query = $this->db->select('stories.*,gener.*, signup.*')
		->from('stories')->join('gener','gener.id=stories.genre','left')
		->join('signup','signup.user_id=stories.user_id','left')->where('stories.language',$language)
		->where('stories.genre',$id)->where('stories.status','active')
		->group_by('stories.story_id')->get();
		return $query;  	
	}*/
	public function get_allstorys($type, $lastid = false, $returntype = false){
		$language = $this->langshortname($this->uri->segment(1));
		$this->db->select('stories.*, gener.*, signup.*')
			->from('stories')->join('gener','gener.id=stories.genre','left')
			->join('signup','signup.user_id=stories.user_id','left')->where('stories.language',$language)
			->where('stories.draft !=','draft')->where('stories.status','active');
		$this->db->where('stories.type',$type);
		if(isset($lastid) && !empty($lastid)){
		    $this->db->where('stories.sid <',$lastid);
		}
		$this->db->order_by('stories.sid','DESC');
		if($type == 'series'){
		    $this->db->group_by('stories.story_id');
		}
		$this->db->limit(8);
		if(isset($returntype) && !empty($returntype)){
		    $query = $this->db->get();
		}else{
		    $query = $this->db->get();
		}
		return $query;
	}
		
	public function get_allnano(){
    	$language = $this->langshortname($this->uri->segment(1));
    	$query=$this->db->select('stories.*, signup.*')->from('stories')
    		->join('signup','signup.user_id = stories.user_id','left')
    		->where('stories.type','nano')->where('stories.language',$language)->where('stories.status','active')->get();
        return $query;
	}
	public function nano_like_count() {
        $likes = $this->db->select('likes.*,stories.*,count(likes.sid) as likescount')->from('likes')
        	->join('stories','likes.sid = stories.sid','left')->where('stories.status','active')->group_by('likes.sid')->get();
    	return $likes;
    }
    public function pro_comment($userid){
    	$query = $this->db->select('comments.*,signup.user_id, signup.profile_image, signup.profile_name')->from('comments')
    	    ->join('signup','comments.user_id=signup.user_id','left')->where('comments.user_id',$userid)
    	    ->order_by('cid','desc')->get();
    	return $query;
    }
    /*public function pro_comment1(){
    	$id=$this->session->userdata['logged_in']['user_id'];
    	$query = $this->db->select('comments.*,signup.user_id')->from('comments')->join('signup','comments.user_id=signup.user_id','left')->where('comments.user_id',$id)->order_by('cid','desc')->get();
    	//print_r($query->result());exit();
    	return $query;
    }*/
    public function profilecomments($profileid, $limitstart = false){
        $this->db->select('comments.*, signup.user_id, signup.profile_image, signup.profile_name')->from('comments')
            ->join('signup','comments.user_id = signup.user_id','left')->where('comments.story_id',0)
            ->where('comments.profile_id',$profileid)->where('comments.profile_id !=',0)->where('comments.comment_id =',0)
            ->order_by('comments.cid','desc');
        if(isset($limitstart) && !empty($limitstart)){
                $this->db->limit(3, $limitstart);
            }else{
                $this->db->limit(3, 0);
            }
       return $this->db->get();
    }
    public function profilereplycomments($profileid, $cid, $limitstart = false) {
        $this->db->select('comments.*, signup.user_id, signup.profile_image, signup.profile_name')->from('comments')
            ->join('signup','comments.user_id = signup.user_id','left')->where('comments.story_id',0)
            ->where('comments.profile_id',$profileid)->where('comments.profile_id !=',0);
        if(isset($cid) && !empty($cid)){
            $this->db->where('comments.comment_id',$cid);
        }
        $this->db->order_by('comments.cid','desc');
        if(isset($limitstart) && !empty($limitstart)){
            $this->db->limit(2, $limitstart);
        }else{
            $this->db->limit(2, 0);
        }
       return $this->db->get();
       //echo $this->db->last_query();
    }
    public function hproreplaycmtcount($profileid, $cid) {
        $query =  $this->db->select('count(cid) as replycommentcount')->from('comments')->where('profile_id',$profileid)
            ->where('comment_id',$cid)->where('story_id',0)->where('profile_id !=',0)->get()->result();
        if(isset($query[0]->replycommentcount)){
            return $query[0]->replycommentcount;
        }else{
            return 0;
        }
    }
    public function hreplaycomments($storyid, $commentid, $fslimit = false){
        $this->db->select('comments.*, signup.profile_image, signup.profile_name')->from('comments')->join('signup','comments.user_id = signup.user_id','left')
            ->where('comments.story_id', $storyid)->where('comments.comment_id',$commentid)->where('comments.profile_id',0)
            ->order_by('comments.cid','DESC');
            if(isset($fslimit) && !empty($fslimit)){
                $this->db->limit($fslimit);
            }
            return $this->db->get();
    }
    public function editpro_comment($commentid){
        return $this->db->from('comments')->where('cid',$commentid)->limit(1)->get();
    }
    public function updateprocomment($data, $cid){
        return $this->db->where('cid',$cid)->update('comments', $data);
    }
    public function deletepro_comment($commentid){
        //return $this->db->where('cid',$commentid)->from('comments')->delete();
        $delcmtcount = 0; $delsubcmtcount = 0; $story_id = 0; $comment_id = 0;
        $query = $this->db->select('story_id, comment_id')->from('comments')->where('cid', $commentid)->limit(1)->get()->result();
        $this->db->from('comments')->where('comment_id', $commentid)->delete(); // delete sub comments of the comment
        $this->db->from('comments')->where('cid', $commentid)->delete();
        if(isset($query[0]->story_id) && !empty($query[0]->story_id)){
            $story_id = $query[0]->story_id;
            $delcmtquery = $this->db->select('COUNT(cid) as delcmtcount')->from('comments')->where('story_id', $query[0]->story_id)->get()->result();
            if(isset($delcmtquery[0]->delcmtcount)){
                $delcmtcount = $delcmtquery[0]->delcmtcount;
            }
        }
        if(isset($query[0]->comment_id) && !empty($query[0]->comment_id) && isset($query[0]->story_id) && !empty($query[0]->story_id)){
            $comment_id = $query[0]->comment_id;
            $delsubcmtquery = $this->db->select('COUNT(cid) as delsubcmtcount')->from('comments')
                ->where('story_id', $query[0]->story_id)->where('comment_id', $query[0]->comment_id)->get()->result();
            if(isset($delsubcmtquery[0]->delsubcmtcount)){
                $delsubcmtcount = $delsubcmtquery[0]->delsubcmtcount;
            }
        }
        return array('delcmtcount' => $delcmtcount, 'delsubcmtcount' => $delsubcmtcount, 'story_id' => $story_id, 'comment_id' => $comment_id);
    }
    public function deleteprocmtcount($cid){
        $query = $this->db->select('comment_id')->from('comments')->where('cid',$cid)->limit(1)->get()->result();
        if(isset($query[0]->comment_id) && !empty($query[0]->comment_id)){
            return $query[0]->comment_id;
        }
    }
    public function followers_names($userid, $start = false, $limit = false){
		$this->db->select('signup.user_id, signup.name, signup.profile_image, signup.profile_name')
		    ->from('follow')->join('signup','follow.user_id = signup.user_id','left')
		    ->where('follow.writer_id',$userid);
	    if(isset($start) && isset($limit) && !empty($limit)){
	         $this->db->limit($limit, $start);
	    }
        return $this->db->get();
    }  
    public function following_names($userid, $start = false, $limit = false){
		$this->db->select('signup.user_id, signup.name, signup.profile_image, signup.profile_name')
		    ->from('follow')->join('signup','follow.writer_id = signup.user_id','left')
		    ->where('follow.user_id',$userid);
	    if(isset($start) && isset($limit) && !empty($limit)){
            $this->db->limit($limit, $start);
	    }
        return $this->db->get();
    }
    public function pro_comment_1($data){
        $res = $this->db->insert('comments', $data);
        $langsegurl = ''; $language = $this->langshortname($this->uri->segment(1));
	    if(isset($language) && !empty($language) && ($language != 'en')){
	        $langsegurl = $this->uri->segment(1)."/";
	    }
        if(isset($data['profile_id']) && !empty($data['profile_id']) && ($data['profile_id'] != $data['user_id'])){
            $type = 'procomment'; if(isset($data['comment_id']) && !empty($data['comment_id'])){$type = 'proreplycomment';}
            $notification = array(
				'type' => $type,
				'from_name' => $data['name'],
				'from_id' => $data['user_id'],
				'to_name' => '',
				'to_id' => $data['profile_id'],
				'title' => $data['pro_comment'],
				'title_id' => '',
				'created_at' => Date('Y-m-d H:i:s'),
			);
			if($type == 'procomment'){
    			$this->db->insert('notifications', $notification);
    			$to_email = $this->getuseremail($data['profile_id']);
    			$subject = $data['name'].' Commented on your profile';
    			$message = 'Story Carry user '.$data['name'].' Commented on your Profile '.$data['pro_comment'];
    			if(isset($to_email) && !empty($to_email)){
    			    $this->sendnotifymail($to_email,$subject,$message);
    			}
			}elseif($type == 'proreplycomment'){
			    $this->db->insert('notifications', $notification);
    			$to_email = $this->getuseremail($data['profile_id']);
    			$subject = $data['name'].' replied to your profile comment';
    			$message = 'Story Carry user '.$data['name'].' replied to your profile comment '.$data['pro_comment'];
    			if(isset($to_email) && !empty($to_email)){
    			    $this->sendnotifymail($to_email,$subject,$message);
    			}
			}
        }elseif(isset($data['story_id']) && !empty($data['story_id'])){
            $commentuserid = $this->db->select('user_id')->from('comments')->where('cid',$data['comment_id'])->limit(1)->get()->result();
            $storytitle = $this->db->select('title, user_id, type')->from('stories')
                ->where('stories.status','active')->where('sid',$data['story_id'])->limit(1)->get()->result();
            if(isset($storytitle[0]->title) && ($storytitle[0]->user_id != $data['user_id'])) {
                $storytype = 'comment'; if(isset($data['comment_id']) && !empty($data['comment_id'])){
                    $storytype = 'replycomment';
                }
                
    			$storynotification = array(
    				'type' => $storytype,
    				'from_name' => $data['name'],
    				'from_id' => $data['user_id'],
    				'to_name' => '',
    				'to_id' => $storytitle[0]->user_id,
    				'title' => $data['comment'],
    				'title_id' => $data['story_id'],
    				'created_at' => Date('Y-m-d H:i:s'),
    			);
    			if($storytitle[0]->type == 'series') {
    				$storynotification['redirect_uri'] = 'series/'.preg_replace('/\s+/', '-', $storytitle[0]->title)."-".$data['story_id'].'/'.preg_replace('/\s+/', '-', $storytitle[0]->title)."-".$data['story_id'];
    			}elseif($storytitle[0]->type == 'story') {
    				$storynotification['redirect_uri'] = 'story/'.preg_replace('/\s+/', '-', $storytitle[0]->title)."-".$data['story_id'];
    			}elseif($storytitle[0]->type == 'nano'){
    				$storynotification['redirect_uri'] = '#';
    			}else{
    				$storynotification['redirect_uri'] = '#';
    			}
    			$this->db->insert('notifications',$storynotification);
    			
    			$to_email = $this->getuseremail($storytitle[0]->user_id);
    			if($storytype == 'comment'){
        			$subject = $data['name'].' Commented on your Story';
        			$message = 'Story Carry user '.$data['name'].' Commented on your Story '.$data['comment'];
        			if(isset($to_email) && !empty($to_email)){
        			    $this->sendnotifymail($to_email,$subject,$message);
        			}
    			}elseif($storytype == 'replycomment'){
        			$subject = $data['name'].' replied to your story Comment.';
        			$message = 'Story Carry user '.$data['name'].' replied to your story Comment '.$data['comment'];
        			if(isset($to_email) && !empty($to_email)){
        			    $this->sendnotifymail($to_email,$subject,$message);
        			}
    			}
    			
    		}
    		if(isset($storytitle[0]->title) && isset($commentuserid[0]->user_id) && ($commentuserid[0]->user_id != $storytitle[0]->user_id)){
                $storytype = 'comment'; if(isset($data['comment_id']) && !empty($data['comment_id'])){
                    $storytype = 'replycomment';
                }
                $notificationreply = array(
    				'type' => $storytype,
    				'from_name' => $this->session->userdata['logged_in']['name'],
    				'from_id' => $data['user_id'],
    				'to_name' => '',
    				'to_id' => $commentuserid[0]->user_id,
    				'title' => $data['comment'],
    				'title_id' => $data['story_id'],
    				'created_at' => Date('Y-m-d H:i:s'),
    			);
    			if($storytitle[0]->type == 'series') {
    				$notificationreply['redirect_uri'] = 'series/'.preg_replace('/\s+/', '-', $storytitle[0]->title)."-".$data['story_id'].'/'.preg_replace('/\s+/', '-', $storytitle[0]->title)."-".$data['story_id'];
    			}elseif($storytitle[0]->type == 'story') {
    				$notificationreply['redirect_uri'] = 'story/'.preg_replace('/\s+/', '-', $storytitle[0]->title)."-".$data['story_id'];
    			}elseif($storytitle[0]->type == 'nano'){
    				$notificationreply['redirect_uri'] = '#';
    			}else{
    				$notificationreply['redirect_uri'] = '#';
    			}
    			$this->db->insert('notifications', $notificationreply);
    			
    			$to_email = $this->getuseremail($commentuserid[0]->user_id);
    			if($storytype == 'comment'){
        			$subject = $this->session->userdata['logged_in']['name'].' Commented on your Story';
        			$message = 'Story Carry user '.$this->session->userdata['logged_in']['name'].' Commented on your Story '.$data['comment'];
        			if(isset($to_email) && !empty($to_email)){
        			    $this->sendnotifymail($to_email,$subject,$message);
        			}
    			}elseif($storytype == 'replycomment'){
        			$subject = $this->session->userdata['logged_in']['name'].' replied to your story Comment.';
        			$message = 'Story Carry user '.$this->session->userdata['logged_in']['name'].' replied to your story Comment '.$data['comment'];
        			if(isset($to_email) && !empty($to_email)){
        			    $this->sendnotifymail($to_email,$subject,$message);
        			}
    			}
    			
    		}
        }
        return $res;
    }
    public function pro_commentpost(){
    	return $this->db->select('comments.*, signup.profile_image, signup.profile_name')->from('comments')
    	    ->join('signup','comments.user_id = signup.user_id','left')->order_by('comments.cid','DESC')->limit(1)->get();
    }
    public function get_communities_adout($commid) {
	  	return $this->db->from('communities')->where('id',$commid)->limit(1)->get();
	}
	public function get_communities_all()
	{
		return $this->db->from('communities')->order_by('id','desc')->get();
	}
	public function series_count(){
    	return $this->db->select('series_follow.*,count(series_follow.series_id) as scount')
    	    ->from('series_follow')->group_by('series_id')->get();
	}
	public function hstorysubscount($story_id) {
	    $query = $this->db->select('COUNT(id) as storysubscount')->from('readlater')
	        ->where('story_id', $story_id)->where('type','seriessubscribe')->get()->result();
        if(isset($query[0]->storysubscount)){
            return $query[0]->storysubscount;
        }
	}
	public function admin_story_view12()
    {
        $query=$this->db->query("select * from stories s left join gener g on g.id=s.genre left join signup u on u.user_id=s.user_id");
        return $query;
	}
	public function project_details(){
    	$id = $_GET['id'];
    	return $this->db->from('project')->where('story_id',$id)->get();
    }
     public function comment_replay($data) {
		$this->db->insert('comment_replay',$data);
		$storytitle = $this->db->select('title,user_id,type')->from('stories')->where('sid',$data['story_id'])
		    ->where('stories.status','active')->limit(1)->get()->result();
		if(isset($storytitle[0]->title) && ($data['user_id'] != $storytitle[0]->user_id)) {
		    $langsegurl = ''; $language = $this->langshortname($this->uri->segment(1));
    	    if(isset($language) && !empty($language) && ($language != 'en')){
    	        $langsegurl = $this->uri->segment(1)."/";
    	    }
			$notification = array(
				'type' => 'comment',
				'from_name' => $this->session->userdata['logged_in']['name'],
				'from_id' => $data['user_id'],
				'to_name' => '',
				'to_id' => $storytitle[0]->user_id,
				'title' => $data['comment'],
				'title_id' => $data['story_id'],
				'created_at' => Date('Y-m-d H:i:s'),
			);	
			if($storytitle[0]->type == 'series') {
				$notification['redirect_uri'] = 'series/'.preg_replace('/\s+/', '-', $storytitle[0]->title)."-".$insert_id.'/'.preg_replace('/\s+/', '-', $storytitle[0]->title)."-".$insert_id;
			}elseif($storytitle[0]->type == 'story') {
				$notification['redirect_uri'] = 'story/'.preg_replace('/\s+/', '-', $storytitle[0]->title)."-".$insert_id;
			}elseif($storytitle[0]->type == 'nano'){
				$notification['redirect_uri'] = '#';
			}elseif($storytitle[0]->type == 'life') {
				$notification['redirect_uri'] = 'story/'.preg_replace('/\s+/', '-', $storytitle[0]->title)."-".$insert_id;
			}else{
				$notification['redirect_uri'] = '#';
			}
			$this->db->insert('notifications',$notification);
		}
		return true;
	}
	public function comment_replay_get(){
    	$query = $this->db->select('comments.cid,comment_replay.*')->from('comment_replay')->join('comments','comments.cid=comment_replay.comment_id','left')->get();
    	//print_r($query->result());exit();
    	return $query;
    }
    public function share_feed_communities($data, $comm_ids, $storyid, $author){
        $insert_id = 0;
		if(is_array($comm_ids)){ foreach($comm_ids as $comm_id){
		    $data['comm_id'] = $comm_id;
		    if(isset($author['storywid'], $author['storywname']) && !empty($author['storywid']) && !empty($author['storywname'])){ // sharing nano story
		        $data['story'] = '<p style="border:3px #eee solid;padding: 10px;font-size: 1.2em; line-height: 1.85em;">'.$data['story'].'</p><em> Written by <a href="'.base_url().$author['storywid'].'">'.$author['storywname'].'</a></em>';
		    }
		    $this->db->insert('communities_story',$data);
		    $insert_id = $this->db->insert_id();
		    $userscomm = $this->db->select('signup.user_id, signup.name, signup.profile_name, communities_join.gener')->from('communities_join')
		        ->join('signup', 'communities_join.user_id = signup.user_id', 'left')
		        ->where('communities_join.comm_id', $comm_id)->get();
		    if($userscomm->num_rows() > 0){ 
		        $langsegurl = ''; $language = $this->langshortname($this->uri->segment(1));
        	    if(isset($language) && !empty($language) && ($language != 'en')){
        	        $langsegurl = $this->uri->segment(1)."/";
        	    }
		        foreach($userscomm->result() as $usercomm){
		        $notifydata = array(
		            'type' => 'communitystory',
		            'from_name' => $this->session->userdata['logged_in']['name'],
		            'from_id' => $this->session->userdata['logged_in']['user_id'],
		            'to_name' => $usercomm->name,
		            'to_id' => $usercomm->user_id,
		            'title' => $data['title'],
		            'title_id' => $comm_id,
		            'redirect_uri' => 'community-story/'.preg_replace('/\s+/', '-', $usercomm->gener).'/'.$insert_id,
		            'description' => $data['urldescription'],
		            'created_at' => Date('Y-m-d H:i:s'),
		        );
		        $query = $this->db->from('notifications')->where('type',$notifydata['type'])->where('from_id', $notifydata['from_id'])
        	        ->where('to_id', $notifydata['to_id'])->where('title_id',$notifydata['title_id'])->get();
        	    if($query->num_rows() > 0){ }else{ $this->db->insert('notifications',$notifydata); }
		    }    }
    	    
	    }   }else if(isset($comm_ids) && !empty($comm_ids)){
	        $data['comm_id'] = $comm_ids;
	        if(isset($author['storywid'], $author['storywname']) && !empty($author['storywid']) && !empty($author['storywname'])){ // sharing nano story
		        $data['story'] = '<p style="border:3px #eee solid;padding: 10px;font-size: 1.2em;line-height: 1.85em;">'.$data['story'].'</p><em> Written by <a href="'.base_url().$author['storywid'].'">'.$author['storywname'].'</a></em>';
		    }
	        $this->db->insert('communities_story',$data);
	        $insert_id = $this->db->insert_id();
	        $userscomm = $this->db->select('signup.user_id, signup.name, signup.profile_name, communities_join.gener')->from('communities_join')
		        ->join('signup', 'communities_join.user_id = signup.user_id', 'left')
		        ->where('communities_join.comm_id', $comm_ids)->where('signup.name !=','')->where('signup.user_id !=','')->get();
		    if($userscomm->num_rows() > 0){
		        $langsegurl = ''; $language = $this->langshortname($this->uri->segment(1));
        	    if(isset($language) && !empty($language) && ($language != 'en')){
        	        $langsegurl = $this->uri->segment(1)."/";
        	    }
		        foreach($userscomm->result() as $usercomm){
		        $notifydata = array(
		            'type' => 'communitystory',
		            'from_name' => $this->session->userdata['logged_in']['name'],
		            'from_id' => $this->session->userdata['logged_in']['user_id'],
		            'to_name' => $usercomm->name,
		            'to_id' => $usercomm->user_id,
		            'title' => $data['title'],
		            'title_id' => $comm_ids,
		            'redirect_uri' => 'community-story/'.preg_replace('/\s+/', '-', $usercomm->gener).'/'.$insert_id,
		            'description' => $data['urldescription'],
		            'created_at' => Date('Y-m-d H:i:s'),
		        );
		        $query = $this->db->from('notifications')->where('type',$notifydata['type'])->where('from_id', $notifydata['from_id'])
        	        ->where('to_id', $notifydata['to_id'])->where('title_id',$notifydata['title_id'])->get();
        	    if($query->num_rows() > 0){ }else{ $this->db->insert('notifications',$notifydata); }
		    }    }
	    }
	    if(isset($storyid) && !empty($storyid)){
	        $storytitle = $this->db->select('title, user_id, type')->from('stories')->where('sid',$storyid)->limit(1)->get()->result();
			if(isset($storytitle[0]->title) && isset($storytitle[0]->user_id) && isset($storytitle[0]->type) && 
			    ($storytitle[0]->user_id != $this->session->userdata['logged_in']['user_id'])) {
		        $langsegurl = ''; $language = $this->langshortname($this->uri->segment(1));
        	    if(isset($language) && !empty($language) && ($language != 'en')){
        	        $langsegurl = $this->uri->segment(1)."/";
        	    }
				$notification = array(
					'type' => 'groupsuggestion',
					'from_name' => $this->session->userdata['logged_in']['name'],
					'from_id' => $this->session->userdata['logged_in']['user_id'],
					'to_name' => '',
					'to_id' => $storytitle[0]->user_id,
					'title' => $storytitle[0]->title,
					'title_id' => $storyid,
					'created_at' => Date('Y-m-d H:i:s'),
				);
				if($storytitle[0]->type == 'series') {
					$notification['redirect_uri'] = 'series/'.preg_replace('/\s+/', '-', $storytitle[0]->title)."-".$storyid.'/'.preg_replace('/\s+/', '-', $storytitle[0]->title)."-".$storyid;
				}elseif($storytitle[0]->type == 'story') {
					$notification['redirect_uri'] = 'story/'.preg_replace('/\s+/', '-', $storytitle[0]->title)."-".$storyid;
				}elseif($storytitle[0]->type == 'nano'){
					$notification['redirect_uri'] = '#'.$insert_id;
				}elseif($storytitle[0]->type == 'life') {
					$notification['redirect_uri'] = 'story/'.preg_replace('/\s+/', '-', $storytitle[0]->title)."-".$storyid;
				}else{
					$notification['redirect_uri'] = '#'; 
				} 
				$this->db->insert('notifications',$notification); 
			}
	    }
	    return true; 
	}
	public function hnanosharecomm($commstoryid) {
	    $query = $this->db->select('')->where()->get();
	}
	public function communities_gener() {
	  	return $this->db->from('communities')->get();
	}
    public function comment_like_series() {
		return $this->db->select("comments.*,count('comments.story_id') as commentcount,stories.sid")->from('comments')
		->join('stories','comments.story_id=stories.sid','left')->group_by('comments.story_id')->get()->result();
	}
    public function comment_like_series1() {
		return $this->db->select("likes.*,count('likes.sid') as likecount,stories.sid")
		->from('likes')
		->join('stories','likes.sid=stories.sid','left')->group_by('likes.sid')
		->get()->result();
	}
	public function story_info($sid){
		/*$query = $this->db->select('stories.*, gener.*')->from('stories')->join('gener','stories.genre = gener.id','left')
		    ->where('sid',$sid)->get();
		if($query->num_rows() >0){
		    return $query->row();
		}else{
		    return false;
		}*/
		if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])){
		    $user_id = $this->session->userdata['logged_in']['user_id'];
		    return $this->db->select('stories.sid, stories.title, stories.etitle, stories.genre, stories.copyrights, stories.keywords, 
		        stories.story_id, stories.type, stories.writing_style, stories.cover_image, stories.pay_story, stories.language')
		        ->from('stories')->where('stories.sid',$sid)->where('stories.user_id', $user_id)->limit(1)->get();
		}
    }
    public function update_info($sid,$updatedata){
    	$query = $this->db->select('cover_image, image')->from('stories')->where('sid',$sid)->get()->row_array();
		if(isset($updatedata['cover_image'], $query['cover_image']) && !empty($updatedata['cover_image']) && !empty($query['cover_image'])){
			unlink('assets/images/'.$query['cover_image']);
		}
		if(isset($updatedata['image'], $query['image']) && !empty($updatedata['image']) && !empty($query['image'])){
		    unlink('assets/images/'.$query['image']);
		}
        return $this->db->where('sid',$sid)->update('stories', $updatedata);
    }
    public function updatelife_info($sid,$updatedata, $keywords){
        if(isset($keywords) && count($keywords) > 0){
            $this->db->where('sid',$sid)->delete('story_keywords');
            $language = $this->langshortname($this->uri->segment(1));
            foreach($keywords as $lifetag){
                $query = $this->db->from('tags')->where('tagname', $lifetag)->get();
                if($query->num_rows() > 0){ } else{
                    $this->db->insert('tags', array('tagname' => trim($lifetag), 'type' => 'life'));
                }
                $this->db->insert('story_keywords', array('sid' => $sid, 'storytag' => trim($lifetag), 'tag_lang' => $language));
            }   
            $updatedata['keywords'] = implode(',',$keywords);    
        }
        $queryimg = $this->db->select('cover_image, image')->from('stories')->where('sid',$sid)->get()->row_array();
		if(isset($updatedata['cover_image'], $queryimg['cover_image']) && !empty($updatedata['cover_image']) && !empty($queryimg['cover_image'])){
			unlink('assets/images/'.$queryimg['cover_image']);
		}
		if(isset($updatedata['image'], $queryimg['image']) && !empty($updatedata['image']) && !empty($queryimg['image'])){
		    unlink('assets/images/'.$queryimg['image']);
		}
        return $this->db->where('sid',$sid)->update('stories', $updatedata);
    }
    public function story_info_uplode($sid,$data){
        if(isset($data['keywords']) && count($data['keywords']) > 0){
            foreach($data['keywords'] as $lifetag){
                $query = $this->db->from('tags')->where('tagname', $lifetag)->get();
                if($query->num_rows() > 0){ } else{
                    $this->db->insert('tags', array('tagname' => trim($lifetag), 'type' => 'life'));
                }
            }   
            $data['keywords'] = implode(',',$data['keywords']);    
        }
        return $this->db->where('sid',$sid)->update('stories', $data);
    }
   	public function new_series($id,$story_id){
   	    $id = (int)$id;
   	    $story_id = (int)$story_id;
    	$query = $this->db->select('stories.*, signup.*, (SELECT SUM(stories.views) FROM stories WHERE 
    	    stories.story_id = '.$story_id.') as seriesviews')->from("stories") 
    	    ->join('signup','stories.user_id = signup.user_id','left')->where('stories.status','active')
       	    ->where('stories.sid', $id)->where('stories.story_id', $story_id)->where('stories.type','series')->limit(1)->get();
       	return $query;
    }  
	/*public function alltest_series($id)
	{
		$query =  $this->db->from('stories')->where('sid',$id)->where('stories.status','active')->get();
		return $query;
	}*/
	public function new_episode($story_id = false){
		//if(isset($story_id) && !empty($story_id)){
			$query = $this->db->from("stories")->where('story_id',$story_id)->where('stories.status','active')->get();
		/*}else{
			$story_id = $_GET['story_id'];
			$query = $this->db->from("stories")->where('story_id',$story_id)->where('stories.status','active')->get();
		}*/
		return $query->result();
	}
	public function new_episode_show($story_id){
		$query = $this->db->select('story_id')->from("stories")->where('sid',$story_id)->where('stories.status','active')->get()->result();
		if(isset($query[0]->story_id) && !empty($query[0]->story_id)){
		    return  $this->db->from("stories")->where('story_id',$query[0]->story_id)->where('stories.status','active')->get()->result();
		}
	}
	public function series_edit($sid){
	    if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])){
		    $user_id = $this->session->userdata['logged_in']['user_id'];
    		$query = $this->db->select('stories.*, gener.*')->from('stories')->join('gener','stories.genre = gener.id','left')
    		    ->where('sid',$sid)->where('user_id',$user_id)->where('stories.type','series')->limit(1)->get();
        		//->where('stories.status','active')
    		return $query;
	    }
	} 
	public function likes_get() {
	  	return $this->db->from('stories')->order_by('sid','desc')->get();
	}
	public function top_get_series(){
		$language = $this->langshortname($this->uri->segment(1));
	    $query = "SELECT stories.*, gener.gener, signup.*, (COUNT(story_views.id)/30 + (SELECT COUNT(readlater.id) from 
	        readlater where (stories.sid = readlater.story_id AND readlater.type='seriessubscribe')) ) as uniview_subs FROM 
	        stories LEFT JOIN story_views ON stories.sid = story_views.story_id LEFT JOIN signup on 
	        stories.user_id = signup.user_id LEFT JOIN gener on stories.genre = gener.id WHERE stories.type='series' 
	        AND stories.language='$language' AND stories.draft !='draft' AND stories.sid=stories.story_id  
	        AND stories.status='active' GROUP BY stories.story_id ORDER BY uniview_subs DESC LIMIT 7";
	    return $this->db->query($query);
	}
	public function top_get_storys(){
		$language = $this->langshortname($this->uri->segment(1));
	    $query = "SELECT stories.*, gener.gener, signup.*, (COUNT(story_views.id)/30) as uniview_subs FROM stories 
	    LEFT JOIN story_views ON stories.sid = story_views.story_id LEFT JOIN signup on stories.user_id = signup.user_id 
	    LEFT JOIN gener on stories.genre = gener.id WHERE (stories.type='story' OR (stories.type='series' AND 
	    stories.sid != stories.story_id)) AND stories.language='$language' AND stories.draft !='draft' 
	    AND stories.status='active' GROUP BY story_views.story_id ORDER BY uniview_subs DESC LIMIT 7";
	    return $this->db->query($query);
	}
	public function top_get_life(){
    	$language = $this->langshortname($this->uri->segment(1));
	    $query = "SELECT stories.*, gener.gener, signup.*, (COUNT(story_views.id)/30) as uniview_subs FROM stories 
	    LEFT JOIN story_views ON stories.sid = story_views.story_id LEFT JOIN signup on stories.user_id = signup.user_id 
	    LEFT JOIN gener on stories.genre = gener.id WHERE stories.type='life' AND stories.language='$language' 
	    AND stories.draft !='draft' AND stories.status='active' GROUP BY story_views.story_id ORDER BY uniview_subs DESC LIMIT 7";
	    return $this->db->query($query);
	}
	public function yournetworks($user_id, $start = false, $limit = false){
	    $language = $this->langshortname($this->uri->segment(1));
	    $this->db->select('stories.*, gener.*, signup.*')->from('stories')
	        ->join('follow','stories.user_id = follow.writer_id','left')->join('gener','stories.genre = gener.id', 'left')
	        ->join('signup','stories.user_id = signup.user_id','left')->where('stories.draft !=','draft')
	        ->where('((stories.type ="story") OR (stories.type ="series" AND stories.sid != stories.story_id))')
	        ->where('follow.user_id', $user_id)->where('stories.status','active');
	        /*if(isset($language) && !empty($language)){
			    $this->db->where('stories.language',$language);
			}*/
			
	    $this->db->order_by('stories.sid','DESC');
	    if(isset($start) && isset($limit) && !empty($limit)){
	        $this->db->limit($limit, $start);
	    }else{
    	    $this->db->limit(7);
	    }
		return $this->db->get();
	}
	public function top_get_life_all(){
    	$language = $this->langshortname($this->uri->segment(1));
	    /*$query = "SELECT stories.*, gener.gener, signup.*, (COUNT(story_views.id)/30) as uniview_subs FROM stories LEFT JOIN story_views ON stories.sid = story_views.story_id LEFT JOIN signup on stories.user_id = signup.user_id LEFT JOIN gener on stories.story_id = gener.gener WHERE stories.type='life' AND stories.language='$language' AND stories.draft !='draft' GROUP BY stories.story_id ORDER BY uniview_subs DESC ,stories.sid DESC LIMIT 7";*/
	    $query = "SELECT stories.*, gener.gener, signup.*, (COUNT(story_views.id)/30) as uniview_subs FROM stories 
	    LEFT JOIN story_views ON stories.sid = story_views.story_id LEFT JOIN signup on stories.user_id = signup.user_id 
	    LEFT JOIN gener on stories.genre = gener.id WHERE stories.type='life' AND stories.draft !='draft' 
	    AND stories.status='active' GROUP BY story_views.story_id ORDER BY uniview_subs DESC LIMIT 3";
	    return $this->db->query($query);
	}
	
	public function letest_storys_get() {
		$language = $this->langshortname($this->uri->segment(1));
		$query=$this->db->select('stories.*, gener.gener, signup.*')
			->from('stories')->join('gener','gener.id = stories.genre','left')
			->join('signup','signup.user_id = stories.user_id','left')
			->where('stories.draft !=','draft')->where('stories.language',$language)->where('stories.status','active')
			->group_by('stories.story_id')->order_by('stories.sid','Desc')->get();
	    return $query;
	}
	
	public function filter12() {
		$id = $_GET['id'];
		$language = $this->langshortname($this->uri->segment(1));
		$query = $this->db->select('stories.*, gener.gener, signup.*')
			->from('stories')->join('gener','gener.id = stories.genre','left')
			->join('signup','signup.user_id = stories.user_id','left')->where('stories.status','active')
			->where('stories.language',$language) ->where('stories.genre',$id) ->group_by('stories.story_id')
			->order_by('views','DESC')->get();
		return $query;  
	}
    /*public function communities_story_get_likes(){
    	$id= $this->uri->segment(2);
    	$this->db->select('communities_story.*, signup.user_id, signup.profile_image')
    	    ->from('communities_story')->join('signup','communities_story.user_id = signup.user_id','left')
        	->where('communities_story.comm_id',$id);
    	///if(isset($this->session->userdata['language']) && !empty($this->session->userdata['language'])){
    	  //$this->db->where('communities_story.comm_language',$this->session->userdata['language']);
    	//}
        return $this->db->order_by('communities_story.likes','DESC')->get();
	}*/
	public function admin_choice(){
		$language = $this->langshortname($this->uri->segment(1));
		$query = $this->db->select('stories.*, gener.gener, signup.*')->from('stories')
			->join('gener','gener.id = stories.genre','left')->join('signup','signup.user_id = stories.user_id','left')
			->where('stories.draft !=','draft')->where('stories.status','active')
			->where('stories.admin_choice','2')->where('stories.language',$language)->limit('4')->get();
        return $query;
	}
	public function popupview($data,$id){
		$datetime = Date('Y-m-d H:i:s');
		$this->db->where('sid',$sid)->set('week_views','week_views + 1',FALSE)->set('updated_at', $datetime)->update('stories');
		$this->db->where('sid',$sid)->set('month_views','month_views + 1',FALSE)->set('updated_at', $datetime)->update('stories');
		$this->db->where('sid',$sid)->set('year_views','year_views + 1',FALSE)->set('updated_at', $datetime)->update('stories');
	  	$this->db->where('sid',$id)->set('views','views + 1',FALSE)->update('stories');
	}
	public function nextepisode($id,$story_id) {
		$query = $this->db->select('sid, title, story_id')->from('stories')->where('story_id=',$story_id)
		    ->where('stories.status','active')->where('stories.type','series')->where('sid >',$id)
		    ->where('draft !=','draft')->order_by('sid','ASC')->limit(1)->get();
		if($query->num_rows() == 1) {
			return $query->result();
		} else {
			return $query->result();
		}
	}
	public function get_seriesall() {
        $id = $_GET['type'];
        $language = $this->langshortname($this->uri->segment(1));
        $query = $this->db->select('stories.*,gener.*, signup.*')
            ->from('stories')->join('gener','gener.id=stories.genre','left')
            ->join('signup','signup.user_id=stories.user_id','left')
            ->where('stories.type',$id)->where('stories.language',$language)->where('stories.status','active')
            ->group_by('stories.story_id')
            ->order_by('views','DESC')->get();
        return $query; 
        
    }
    public function seriesallloadmore($type, $start, $limit){
        $language = $this->langshortname($this->uri->segment(1));
        $this->db->select('stories.*, gener.*, signup.*')->from('stories')
	        ->join('gener','stories.genre = gener.id','left')->join('signup','stories.user_id = signup.user_id','left')
			->where('stories.type', $type)->where('stories.draft !=','draft')->where('stories.status','active');
			if(isset($language) && !empty($language)){
			    $this->db->where('stories.language', $language);
			}
    		if($type == 'series'){
			    $this->db->where('stories.sid = stories.story_id')->group_by('stories.sid');
			}
		$this->db->order_by('stories.sid','DESC');
		$this->db->limit($limit, $start);
		$query = $this->db->get();
		return $query;
    }
	public function frindnote($data, $to_ids){
	    if(is_array($to_ids)){ foreach($to_ids as $to_id){
    	    $query = $this->db->from('notifications')->where('type',$data['type'])->where('from_id', $data['from_id'])->where('to_id', $to_id)->where('title_id',$data['title_id'])->get();
    	    if($query->num_rows() > 0){
    	    }else{
    	        $data['to_id'] = $to_id;
    	        $this->db->insert('notifications',$data);
    	    }
	    }   }else if(isset($to_ids) && !empty($to_ids)){
	        $query = $this->db->from('notifications')->where('type',$data['type'])->where('from_id', $data['from_id'])->where('to_id', $to_ids)->where('title_id',$data['title_id'])->get();
    	    if($query->num_rows() > 0){ }else{
    	        $data['to_id'] = $to_ids;
    	        $this->db->insert('notifications',$data);
    	    }
	    }
	    return true;
	}
	public function userstorys(){
    	$query = $this->db->select('stories.*,signup.*,count(stories.user_id) as totalstorys1')->from("stories")
    	->join('signup','stories.user_id=signup.user_id','left')->where('stories.status','active')->group_by('stories.user_id')
   		->get();
   		return $query->result();
	}
	public function applyads($data){
		$query=$this->db->from('ads_apply')->where('user_id',$data['user_id'])->where('story_id',$data['story_id'])->get();
		if($query->num_rows()>0){
			return 0;
		}else{
			$this->db->insert('ads_apply',$data);
			return 1;
		} 
	}
    public function comment_get12($storyid){
    	return $this->db->select('comments.*, signup.profile_image, signup.profile_name')->from('comments')
    	    ->join('signup','comments.user_id = signup.user_id','left')
    	    ->where('comments.story_id',$storyid)->order_by('comments.cid','desc')->get();
    }		  


    public function deletecomm_post($comm_story_id){
		return $this->db->where('id', $comm_story_id)->delete('communities_story');
	}
	public function editcomm_post($comm_story_id){
		return $this->db->where('id', $comm_story_id)->from('communities_story')->get();
	}
	public function reportcomm_post($inputdata){
	    $query = $this->db->from('reports')->where($inputdata)->get();
	    if($query->num_rows() >0){
	        return 0;
	    }else{
	        return $this->db->insert('reports', $inputdata);
	    }
	}
	public function comm_joines($comm_id, $start = false, $limit = false){
	    $language = $this->langshortname($this->uri->segment(1));
        $this->db->select('communities_join.*, signup.profile_image, signup.profile_name, signup.banner_image, signup.name')
            ->from('communities_join')->join('communities','communities_join.comm_id = communities.id','left')
            ->join('signup','communities_join.user_id = signup.user_id', 'left')->where('communities_join.user_id=signup.user_id')
            ->where('communities_join.comm_id', $comm_id)->where('communities.joincomm_lang', $language);
        if(isset($limit) && !empty($limit)){
            $this->db->limit($limit, $start);
        }
        return $this->db->get();
	}
	public function favoritreadlater($type, $storyid){
	    if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])){
    		$user_id = $this->session->userdata['logged_in']['user_id'];
    		$this->db->from('readlater')->where('user_id', $user_id);
    		//if(isset($type) && !empty($type)){
    		    $this->db->where('type', $type)->where('story_id', $storyid);
    		//}
    		/*if(($type == 'seriessubscribe') && isset($_GET['story_id']) && !empty($_GET['story_id'])){
    		    $this->db->where('story_id', $_GET['story_id']);
    		}elseif(isset($_GET['id']) && !empty($_GET['id'])){
    		    $this->db->where('story_id', $_GET['id']);
    		}*/
    		$query = $this->db->get();
    		$favoritstory_ids = array();
    		if($query->num_rows() > 0){ foreach($query->result() as $row){
    		    array_push($favoritstory_ids, $row->story_id);
    		}   }
    		return array_unique($favoritstory_ids);
	    }
	}
	public function seriesreadlater($type, $storyid){
	    if(isset($storyid) && !empty($storyid)){
	        $subsmembers_ids = array();
		    $subsmembers = $this->db->from('readlater')->where('type', $type)->where('story_id', $storyid)->get();
		    if($subsmembers->num_rows() > 0){ foreach($subsmembers->result() as $row){
    		    array_push($subsmembers_ids, $row->story_id);
    		}   }
    		return $subsmembers_ids;
		}
	}
	public function deletelibrary($story_id, $type){
	    if(isset($this->session->userdata['logged_in']['user_id'])){
    		$user_id = $this->session->userdata['logged_in']['user_id'];
    		if($type == 'seriessubscribe'){
			    $this->db->from('notifications')->where('type', 'seriessubscribe')->where('from_id', $user_id)->where('title_id', $story_id)->delete();
		    }elseif($type == 'favorite'){
		        $this->db->from('notifications')->where('type', 'favorite')->where('from_id', $user_id)->where('title_id', $story_id)->delete();
		    }
    		return $this->db->where('user_id', $user_id)->where('story_id', $story_id)->where('type',$type)->delete('readlater');
	    }
	}
	public function favorites($type = false){
	    $language = $this->langshortname($this->uri->segment(1));
	    $id = $this->session->userdata['logged_in']['user_id'];
        $this->db->select('stories.*, gener.id, gener.gener, signup.*, readlater.user_id, readlater.story_id')
            ->from('stories')->join('gener','gener.id=stories.genre','left')
			->join('signup','signup.user_id=stories.user_id','left')->join('readlater','readlater.story_id=stories.sid','left')
			->where('readlater.user_id',$id)->where('readlater.type','favorite')->where('stories.language',$language)
			->where('stories.status','active');
			if(isset($type) && !empty($type)){
			    $this->db->where('stories.type',$type);
			}
			return $this->db->group_by('stories.story_id')->order_by('readlater.id','desc')->get();
	}
	public function subscribes(){
	    $language = $this->langshortname($this->uri->segment(1));
	    $id = $this->session->userdata['logged_in']['user_id'];
		return $this->db->select('stories.*, gener.id, gener.gener, signup.*, readlater.story_id as series_id')
		    ->from('stories')->join('gener','gener.id=stories.genre','left')
			->join('signup','signup.user_id = stories.user_id','left')
			->join('readlater','readlater.story_id = stories.sid','left')
			->where('readlater.user_id',$id)->where('readlater.type','seriessubscribe')->where('stories.language',$language)
			->where('stories.status','active')->group_by('stories.story_id')->order_by('readlater.id','desc')->get();
	}
	public function checkforlastepisode($series_id){
	    return $this->db->from('stories')->where('last_episode','yes')->where('story_id', $series_id)->get();
	}
	public function allfavorites($id){
	    return $this->db->select('stories.*, gener.id, gener.gener, signup.*, readlater.user_id, readlater.story_id,
            count(stories.story_id) as count')->from('stories')->join('gener','gener.id=stories.genre','left')
			->join('signup','signup.user_id=stories.user_id','left')->join('readlater','readlater.story_id=stories.sid','left')
			->where('readlater.user_id',$id)->where('readlater.type','favorite')->where('stories.status','active')
			->group_by('stories.story_id')->order_by('readlater.id','desc')->get();
	}
	/*public function writerreadlater($type = false){
        if(isset($_GET['id']) && !empty($_GET['id'])){
            $id = $_GET['id'];
            $this->db->select('stories.*, gener.id, gener.gener, signup.*, readlater.story_id')->from('stories')
    			->join('gener','gener.id=stories.genre','left')->join('signup','signup.user_id=stories.user_id','left')
    			->join('readlater','readlater.story_id=stories.sid','left')->where('readlater.user_id',$id)
    			->where('stories.status','active')->where('readlater.type = "favorite" OR readlater.type = "seriessubscribe"');
    		if(isset($type) && !empty($type)){
    		    $this->db->where('stories.type',$type);
    		}
    		$this->db->where('stories.type !=','nano');   
    		$query = $this->db->group_by('readlater.story_id')->order_by('readlater.id','desc')->get();
            return $query;
        }
    }*/
	public function writingsjoins($user_id){
	    $language = $this->langshortname($this->uri->segment(1));
	    $usergcount = $this->db->select('COUNT(id) as usergcount')->from('communities_join')->where('user_id', $user_id)->get()->result();
	    $userwcount = $this->db->select('COUNT(sid) as userwcount')->from('stories')->where('user_id', $user_id)
	        ->where('draft !=','draft')->where('stories.status','active')//->where('stories.language',$language)
	        ->where('(stories.type = "series" OR stories.type = "story" OR stories.type = "life" OR stories.type = "nano")')
	        ->get()->result();
	    return array('usergcount' => $usergcount[0]->usergcount, 'userwcount' => $userwcount['0']->userwcount);
	}
	
	public function hstoriesreadlater($type){
	    if(isset($this->session->userdata['logged_in']['user_id'])){
    	    $userid = $this->session->userdata['logged_in']['user_id'];
    	    $readlatersids = array();
    	    $query = $this->db->select('story_id')->from('readlater')->where('user_id', $userid)->where('type',$type)->get();
    	    if($query->num_rows() > 0){ foreach($query->result() as $row){
    	        array_push($readlatersids, $row->story_id);
    	    }   }
    	    return $readlatersids;
	    }
	}
	
	public function hfavcount($storyid){
        $query = $this->db->select('COUNT(id) as favcount')->from('readlater')->where('story_id', $storyid)->where('type','favorite')->get()->result();
        if(isset($query[0]->favcount)){
            return $query[0]->favcount;
        }else{
            return 0;
        }
    }
    public function uniqueviews($sid){
        $data = array(
            'story_id' => $sid,
            'ipaddress' => $_SERVER['REMOTE_ADDR'],
        );
        if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])){
            $data['user_id'] = $this->session->userdata['logged_in']['user_id'];
        }
        $query = $this->db->from('story_views')->where($data)->get();
        if($query->num_rows() > 0){
            return 0;
        }else{
            return $this->db->insert('story_views',$data);
        }
    }
    public function hepisodecount($storyid){
        //$language = $this->langshortname($this->uri->segment(1));
        $query = $this->db->select('COUNT(sid) as episodecount')->from('stories')->where('story_id',$storyid)
            ->where('story_id != sid')->where('draft !=','draft')->where('stories.status','active')
            ->where('stories.type','series')->get()->result();
        if(isset($query[0]->episodecount)){
            return $query[0]->episodecount;
        }
    }
    public function langupdate($language, $userid = false){
        if(isset($userid) && !empty($userid)){
            return $this->db->where('user_id', $userid)->update('signup', array('writer_language' => $language));
        }else if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])){
            $userid = $this->session->userdata['logged_in']['user_id'];
            return $this->db->where('user_id', $userid)->update('signup', array('writer_language' => $language));
        }
    }
    public function choosecommu($data, $userid = false, $cslang = false){
        foreach($data as $row){
            $query = $this->db->select('communities.id, gener.gener')->from('gener')
                ->join('communities','gener.gener = communities.gener')
                ->where('gener.id',$row)->where('joincomm_lang', $cslang)->get()->result();
            if(isset($query[0]->id) && !empty($query[0]->id)){
                if(isset($userid) && !empty($userid)){  }else{ $userid = $this->session->userdata['logged_in']['user_id']; }
                $username = '';
                if(isset($this->session->userdata['logged_in']['name'])){
                    $username = $this->session->userdata['logged_in']['name'];
                }
                $check = $this->db->from('communities_join')->where('user_id', $userid)->where('comm_id', $query[0]->id)->get();
                if($check->num_rows() > 0){
                    //return 0;
                }else{
                    $this->db->insert('communities_join', array('user_id' => $userid, 'comm_id' =>$query[0]->id,'gener'=>$query[0]->gener,'username'=>$username, 'status'=>'joined'));
                }
            }
        }
        return true;
    }
    public function unchoosedcommu($data, $genre = false, $language = false){
        $userid = $this->session->userdata['logged_in']['user_id'];
        if(!empty($userid) && !empty($genre) && !empty($language)){
            $query = $this->db->select('id')->from('communities')->where('communities.gener', $genre)
                ->where('communities.joincomm_lang', $language)->limit(1)->get()->result();
            if(isset($query[0]->id) && !empty($query[0]->id)){
                return $this->db->from('communities_join')->where('communities_join.comm_id', $query[0]->id)
                    ->where('communities_join.user_id', $userid)->where('communities_join.gener', $genre)->delete();
            }
        }else{
            foreach($data as $row){
                $this->db->from('communities_join')->where('user_id', $userid)->where('comm_id', $row)->delete();
            }
            return true;
        }
    }
    public function username($username){
        $userid = $this->session->userdata['logged_in']['user_id'];
        return $this->db->select('user_id')->from('signup')->where('profile_name',$username)->where('user_id!=',$userid)->get();
    }
    public function updateusername($username){
        $userid = $this->session->userdata['logged_in']['user_id'];
        return $this->db->where('user_id',$userid)->update('signup', array('profile_name'=>$username, 'pfnamestatus' => 'updated'));
    }
    public function searchresult($type, $searchdata, $start, $limit){
        $language = $this->langshortname($this->uri->segment(1));
		$this->db->select('stories.*, gener.*, signup.*')->from('stories')
	        ->join('gener','gener.id = stories.genre','left')->join('signup','signup.user_id = stories.user_id','left')
			->where('stories.draft !=','draft')->where('stories.language',$language);
		if($type == 'series'){
	        $this->db->where('stories.sid = stories.story_id')->where('stories.type','series')->group_by('stories.sid');
		}else if($type == 'story'){
	        $this->db->where('((stories.type ="story") OR (stories.type ="series" AND stories.sid != stories.story_id))');
		}else if($type == 'life'){
		    $this->db->where('stories.type','life')->group_by('stories.sid');
		}
		if(isset($searchdata) && !empty($searchdata)){
		    $searchcon = "(stories.title LIKE '%$searchdata%' OR stories.etitle LIKE '%$searchdata%' OR signup.name LIKE '%$searchdata%' OR stories.keywords LIKE '%$searchdata%')";
		    $this->db->where($searchcon);
		}
		$this->db->order_by('stories.sid','DESC');
		$this->db->limit($limit, $start);
		$query = $this->db->get();
		return $query;
	}
    /*public function searchresult($type, $searchdata, $lastid = false, $returntype = false){
		$this->db->select('stories.*, gener.*, signup.*')->from('stories')
	        ->join('gener','gener.id = stories.genre','left')->join('signup','signup.user_id = stories.user_id','left')
			->where('stories.draft !=','draft')->where('stories.status','active');
		if($type == 'series'){
	        $this->db->where('stories.sid = stories.story_id')->where('stories.type','series')->group_by('stories.sid');
		}else if($type == 'story'){
	        $this->db->where('((stories.type ="story") OR (stories.type ="series" AND stories.sid != stories.story_id))');
		}else if($type == 'life'){
		    $this->db->where('stories.type','life')->group_by('stories.sid');
		}
		if(isset($searchdata) && !empty($searchdata)){
		    $searchcon = "(stories.title LIKE '%$searchdata%' OR stories.etitle LIKE '%$searchdata%' OR signup.name LIKE '%$searchdata%' OR stories.keywords LIKE '%$searchdata%')";
		    $this->db->where($searchcon);
		}
		if(isset($lastid) && !empty($lastid)){
		    $this->db->where('stories.sid <',$lastid);
		}
		$this->db->order_by('stories.sid','DESC');
		if(($type == 'life') || ($type == 'nano')){
		    $this->db->limit(8);
		}else{
		    $this->db->limit(8);
		}
	    if(isset($returntype) && !empty($returntype)){
		    $query = $this->db->get();
		}else{
		    $query = $this->db->get();
		}
		return $query;
	}*/
	
	
    /*public function searchresultwriter($lastid = false, $returntype = false){
        if(isset($_GET['searchtext']) && !empty($_GET['searchtext'])){
    		$query = $_GET['searchtext'];
    		$language = $this->langshortname($this->uri->segment(1));
    		$this->db->select('signup.*, stories.sid, count(stories.user_id) as count, SUM(stories.views) as totel')
        		->from('signup')->join('stories','signup.user_id = stories.user_id','left')->where('stories.draft !=','draft')
        		->where('stories.status','active')->where('stories.type !=','')
        		->group_by('signup.user_id')->order_by('totel','DESC');
    		if(isset($query) && !empty($query)){
    		    $this->db->like('signup.name',$query, 'both');
    		}
    		if(isset($lastid) && !empty($lastid) && ($lastid != 'people')){
    		    $this->db->where('signup.user_id <',$lastid);
    		}
    		$this->db->order_by('signup.user_id','DESC')->limit(6);//->group_by('stories.story_id')
    		if(isset($returntype) && !empty($returntype)){
    		    $result = $this->db->get();
    		}else{
    		    $result = $this->db->get();
    		}
    		return $result;
		}
	}*/
	public function searchresultwriter($type, $searchdata, $start, $limit){
		$language = $this->langshortname($this->uri->segment(1));
        
        /*$query = "SELECT (SUM(stories.views)/100 + (SELECT COUNT(follow.id) from follow where signup.user_id = follow.writer_id)) as writerpoints, 
            signup.*, stories.sid, count(stories.user_id) as count, SUM(stories.views) as totel 
            FROM signup LEFT JOIN stories ON signup.user_id = stories.user_id 
            WHERE (stories.draft != 'draft' AND signup.user_id = stories.user_id) AND stories.status='active' AND 
            stories.type != '' AND stories.language = '$language' ";
            if(isset($searchdata) && !empty($searchdata)){
                $query.=" AND signup.name LIKE '%$searchdata%' ";
            }
            $query.=" GROUP BY signup.user_id ORDER BY writerpoints DESC, totel DESC, signup.user_id DESC LIMIT ".$start.",".$limit;
        return $this->db->query($query);*/
        
        $query = "SELECT signup.*, (SELECT COUNT(follow.id) from follow where signup.user_id = follow.writer_id) as writerpoints FROM signup ";
            if(isset($searchdata) && !empty($searchdata)){
                $query.=" WHERE signup.name LIKE '%$searchdata%' ";
            }
            $query.=" GROUP BY signup.user_id ORDER BY writerpoints DESC, signup.user_id DESC LIMIT ".$start.",".$limit;
        return $this->db->query($query);
	}
	public function editnano($nanosid){
	    return $this->db->select('sid, story, language as nanolang')->from('stories')->where('type','nano')->where('sid',$nanosid)->get();
	}
	public function updatenano($story, $nanosid){
	    return $this->db->where('sid',$nanosid)->where('type','nano')->update('stories', array('story' => $story));
	}
	public function deletenano($nanosid){
	    return $this->db->from('stories')->where('sid',$nanosid)->where('type','nano')->delete();
	}
	
	public function communities_commentslast(){
    	return $this->db->select('comm_comments.*, signup.profile_image, signup.profile_name')->from('comm_comments')
    	    ->join('signup','comm_comments.user_id = signup.user_id','left')->order_by('comm_comments.id','DESC')->limit(1)->get();
    }
    public function generfilter($type, $generid) {
		$language = $this->langshortname($this->uri->segment(1));
		return $this->db->select('stories.*, gener.*, signup.*')->from('stories')
		    ->join('gener','gener.id = stories.genre','left')
			->join('signup','signup.user_id = stories.user_id','left')->where('stories.type',$type)
			->where('stories.genre',$generid)->where('stories.language',$language)->where('stories.status','active')
		    ->order_by('stories.sid','DESC')->group_by('stories.story_id')
		    ->get();
    }
    public function commloadcomments($story_id, $commentid){
        return $this->db->select('comm_comments.*, signup.profile_image, signup.profile_name')->from('comm_comments')
            ->join('signup','comm_comments.user_id = signup.user_id','left')
            ->where('comm_comments.story_id',$story_id)->where('comm_comments.id <',$commentid)
            ->where('comm_comments.comment_id',0)->order_by('comm_comments.id','DESC')->limit(2)->get();
    }
    public function commlastcomment($story_id){
        $lastcmtid = $this->db->select('id')->from('comm_comments')->where('story_id',$story_id)->where('comment_id',0)
            ->order_by('id','ASC')->limit(1)->get()->result();
        if(isset($lastcmtid[0]->id) && !empty($lastcmtid[0]->id)){
            return $lastcmtid[0]->id;
        }
    }
    public function commloadsubcomments($story_id, $comment_id, $subcommentid){
        return $this->db->select('comm_comments.*, signup.profile_image, signup.profile_name')->from('comm_comments')
            ->join('signup','comm_comments.user_id = signup.user_id','left')
            ->where('comm_comments.story_id',$story_id)->where('comm_comments.id <',$subcommentid)
            ->where('comm_comments.comment_id !=',0)->where('comm_comments.comment_id',$comment_id)
            ->order_by('comm_comments.id','DESC')->limit(2)->get();
    }
    public function commlastsubcomment($story_id, $comment_id){
        $lastcmtid = $this->db->select('id')->from('comm_comments')->where('story_id',$story_id)->where('comment_id !=',0)
            ->where('comment_id',$comment_id)->order_by('id','ASC')->limit(1)->get()->result();
        if(isset($lastcmtid[0]->id) && !empty($lastcmtid[0]->id)){
            return $lastcmtid[0]->id;
        }
    }
    public function deletecommcomment($commentid){
        $delcmtcount = 0; $delsubcmtcount = 0; $story_id = 0; $comment_id = 0;
        $query = $this->db->select('story_id, comment_id')->from('comm_comments')->where('id', $commentid)->limit(1)->get()->result();
        $this->db->from('comm_comments')->where('comment_id', $commentid)->delete(); // delete sub comments of the comment
        $this->db->from('comm_comments')->where('id', $commentid)->delete();
        if(isset($query[0]->story_id) && !empty($query[0]->story_id)){
            $story_id = $query[0]->story_id;
            $delcmtquery = $this->db->select('COUNT(id) as delcmtcount')->from('comm_comments')->where('story_id', $query[0]->story_id)->get()->result();
            if(isset($delcmtquery[0]->delcmtcount)){
                $delcmtcount = $delcmtquery[0]->delcmtcount;
            }
        }
        if(isset($query[0]->comment_id) && !empty($query[0]->comment_id) && isset($query[0]->story_id) && !empty($query[0]->story_id)){
            $comment_id = $query[0]->comment_id;
            $delsubcmtquery = $this->db->select('COUNT(id) as delsubcmtcount')->from('comm_comments')
                ->where('story_id', $query[0]->story_id)->where('comment_id', $query[0]->comment_id)->get()->result();
            if(isset($delsubcmtquery[0]->delsubcmtcount)){
                $delsubcmtcount = $delsubcmtquery[0]->delsubcmtcount;
            }
        }
        return array('delcmtcount' => $delcmtcount, 'delsubcmtcount' => $delsubcmtcount, 'story_id' => $story_id, 'comment_id' => $comment_id);
    }

    public function editcommcomment($commentid){
        return $this->db->from('comm_comments')->where('id', $commentid)->limit(1)->get();
    }
    public function updatecommcomment($id, $comment){
        return $this->db->where('id', $id)->update('comm_comments', array('comment' => $comment));
    }
    public function transactions($user_id){
        return $this->db->from('signup')->where('user_id',$user_id)->limit(1)->get();
    }
    public function transstories($user_id){
        $language = $this->langshortname($this->uri->segment(1));
        return $this->db->select('stories.sid, stories.title, stories.type, stories.pay_story, stories.smonetisation,
            (SELECT COUNT(story_views.story_id) FROM story_views WHERE story_views.story_id=stories.sid) as uvcount')
            ->from('stories')->join('signup','stories.user_id = signup.user_id AND signup.user_id='.$user_id,'left')
            ->where('(stories.type = "story" OR stories.type = "life" OR (stories.type = "series" AND stories.sid = stories.story_id))')
            ->where('stories.user_id', $user_id)->where('stories.draft !=','draft')
            ->where('stories.status', 'active')//->where('stories.language',$language)
            ->where('stories.title !=', '')->get();
    }
    /* monitize request start */
    //public function followwritecount($language, $userid){ // monitize follow >= 50 and stories >= 3
    public function followwritecount($userid){ // monitize follow >= 50 and stories >= 3
        return $this->db->select("COUNT(stories.sid) as storycount, 
            (SELECT COUNT(follow.id) from follow where follow.writer_id = $userid ) as followcount")
            ->from('stories')->where('stories.user_id',$userid)//->where('stories.language',$language)
            ->where('stories.type !=','nano')->where('stories.draft !=','draft')->where('stories.type !=','nano')
            ->where('stories.status','active')->having('storycount >=',3,false)->having('followcount >=',50,false)->get();
    }
    public function monitizeonreq($userid){
        $query = $this->db->from('signup')->where('signup.user_id', $userid)->where('signup.monetisation','no')
            ->where('signup.mstatus','not_requested')->get();
        if($query->num_rows() > 0){
            return $this->db->where('signup.user_id', $userid)->where('signup.monetisation', 'no')
                ->update('signup', array('mstatus' => 'monitize'));
        }else{
            return false;
        }
    }
    public function monitizeoffreq($userid){
        $query = $this->db->from('signup')->where('signup.user_id', $userid)->where('signup.monetisation','yes')
            ->where('signup.mstatus','monitize')->get();
        if($query->num_rows() > 0){
            return $this->db->where('signup.user_id', $userid)->where('signup.monetisation', 'yes')
                ->update('signup', array('mstatus' => 'unmonitize'));
        }else{
            return false;
        }
    }
    /* monitize request end */
    /* story monitize request start */
	public function storymonitizeonreq($userid, $sid){
	    $query = $this->db->from('stories')->join('signup','stories.user_id = signup.user_id','left')
	        ->where('stories.sid', $sid)->where('signup.monetisation','yes')->limit(1)->get();
        if($query->num_rows() > 0){
            return $this->db->where('stories.sid', $sid)->where('stories.user_id',$userid)
                ->update('stories', array('pay_story' => 'Y'));
        }else{  // check user moitized or not(followers + write stories)
    	    $language = $this->langshortname($this->uri->segment(1));
    	    $checkfollowwrite = $this->followwritecount($userid, $language);
    	    if($checkfollowwrite->num_rows() > 0){
    	        $usermonitizereq = $this->monitizeonreq($userid);
    	        return $this->db->where('stories.sid', $sid)->where('stories.user_id',$userid)
    	            ->update('stories', array('pay_story' => 'Y'));
    	    }
        }
	}
	public function storymonitizeoffreq($userid, $sid){
	    return $this->db->where('stories.sid', $sid)->where('stories.user_id',$userid)
	        ->update('stories', array('pay_story' => 'N'));
	}
	public function paymenttype($userid){
	    return $this->db->select('paymenttype1, paytmphone, paymenttype2, accountno, ifsccode, bankname, accounteename, branchname, 
	        paymenttype3, googlepayphone')->from('signup')->where('user_id',$userid)->limit(1)->get();
	}
	public function paymentdetails($userid, $data){
	    $query = $this->db->select('paymenttype1, paymenttype2, paymenttype3')->from('signup')->where('user_id',$userid)->get()->result();
	    if(isset($data['paymenttype1']) && ($data['paymenttype1'] == 'paytm')){
	        if(isset($query[0]->paymenttype1) && !empty($query[0]->paymenttype1)){
    	        return false;
    	    }else{
    	        return $this->db->where('user_id',$userid)->update('signup', $data);
    	    }
	    }else if(isset($data['paymenttype2']) && ($data['paymenttype2'] == 'bankaccount')){
	        if(isset($query[0]->paymenttype2) && !empty($query[0]->paymenttype2)){
	            return false;
	        }else{
	            return $this->db->where('user_id',$userid)->update('signup', $data);
	        }
	    }else if(isset($data['paymenttype3']) && ($data['paymenttype3'] == 'googlepay')){
	        if(isset($query[0]->paymenttype3) && !empty($query[0]->paymenttype3)){
	            return false;
	        }else{
	            return $this->db->where('user_id',$userid)->update('signup', $data);
	        }
	    }else{
	        return false;
	    }
	}
	public function requestformoney($userid, $paymenttype){
	    //$reqamount = $this->db->select('tobe_payamount')->from('signup')->where('user_id',$userid)->get()->result();
	    $reqamount = $this->db->select('signup.tobe_payamount')->from('signup')
	        ->join('payments','signup.user_id = payments.user_id','left')
	        ->where('signup.admin_status','unblock')->where('signup.monetisation','yes')->where('signup.user_id', $userid)
	        ->where('signup.tobe_payamount >=','payments.amount')->get()->result();
        $reqcheck = $this->db->from('payments')->where('user_id',$userid)->where('status','requested')->get();
        if(isset($reqamount[0]->tobe_payamount) && ($reqamount[0]->tobe_payamount >= 100) && ($reqcheck->num_rows() < 1)){
            return $this->db->insert('payments', array('user_id'=>$userid, 'paymenttype'=>$paymenttype, 'status'=>'requested', 
            'amount'=> $reqamount[0]->tobe_payamount, 'requested_date'=>Date('Y-m-d H:i:s')));
        }else{
            return false;
        }
	}
	public function translist($userid){
	    return $this->db->from('payments')->where('user_id',$userid)->get();
	}
	/* story monitize request end */
    
    public function wstoriesviews($user_id){
	    $language = $this->langshortname($this->uri->segment(1));
	    $wstoriesviews = $this->db->select('SUM(views) as wstoriesviews')->from('stories')->where('user_id', $user_id)
	        ->where('draft !=','draft')->where('stories.language',$language)->where('stories.status','active')->get()->result();
	    return array('wstoriesviews' => $wstoriesviews[0]->wstoriesviews);
	}
    public function lifetagslist($limit = false, $start = false){
        $language = $this->langshortname($this->uri->segment(1));
       /* $this->db->select('tags.*,(SELECT COUNT(stories.sid) FROM stories WHERE stories.keywords LIKE CONCAT("%", tags.tagname, "%")) as tagcount')
            ->from('tags')->where('tags.status','active')->where('tags.type','life')->where('tags.language',$language)
            ->order_by('tagcount','DESC');*/
        $this->db->select('tags.*, COUNT(story_keywords.id) as tagcount')->from('tags')
            ->join('story_keywords','story_keywords.storytag = tags.tagname AND story_keywords.tag_lang=tags.language','left')
            ->where('tags.status','active')->where('tags.type','life')->where('tags.language',$language)
            ->where('story_keywords.tag_lang',$language)->order_by('tagcount','DESC')->group_by('tags.tagname');
        if(isset($limit, $start) && !empty($limit) && !empty($start)){
            $this->db->limit($start, $limit);
        }else if(isset($limit) && !empty($limit)){
            $this->db->limit($limit);
        }
        return $this->db->get();
    }
    
	/* Feed Story Comments load more lastcommentid */
	public function fslastcomment($story_id){
        $lastcmtid = $this->db->select('cid')->from('comments')->where('story_id',$story_id)->where('comment_id',0)
            ->order_by('cid','ASC')->limit(1)->get()->result();
        if(isset($lastcmtid[0]->cid) && !empty($lastcmtid[0]->cid)){
            return $lastcmtid[0]->cid;
        }
    }
    public function fsloadcomments($storyid, $commentid){
        return $this->db->select('comments.*, signup.profile_image, signup.profile_name, signup.name')->from('comments')
    	    ->join('signup','comments.user_id = signup.user_id','left')->where('comments.story_id',$storyid)
    	    ->where('comments.comment_id',0)->where('comments.cid <',$commentid)->order_by('cid','desc')->limit(5)->get();
    }
    public function fslastsubcomment($story_id, $comment_id){
        $lastcmtid = $this->db->select('cid')->from('comments')->where('story_id',$story_id)->where('comment_id',$comment_id)
        ->where('comment_id !=',0)->order_by('cid','ASC')->limit(1)->get()->result();
        if(isset($lastcmtid[0]->cid) && !empty($lastcmtid[0]->cid)){
            return $lastcmtid[0]->cid;
        }
    }
    public function fsloadsubcomments($storyid, $comment_id, $subcommentid){
        return $this->db->select('comments.*, signup.profile_image, signup.profile_name, signup.name')->from('comments')
            ->join('signup','comments.user_id = signup.user_id','left')
            ->where('comments.story_id',$storyid)->where('comments.cid <',$subcommentid)
            ->where('comments.comment_id !=',0)->where('comments.comment_id',$comment_id)
            ->order_by('comments.cid','DESC')->limit(5)->get();
    }
    public function lifetags($data = false, $language){
        if(isset($data) && count($data) > 0){
            foreach($data as $lifetag){
                $query = $this->db->from('tags')->where('tagname', $lifetag)->where('language', $language)->get();
                if($query->num_rows() > 0){ } else{
                    $this->db->insert('tags', array('tagname' => trim($lifetag), 'type' => 'life', 'language' => $language));
                }
            }
        }
        return true;
    }
	public function hydhmdatetime($date){
	    //$date2 = date('Y-m-d H:i:s');
	    $currentdate = $this->db->select('cid, NOW() as date2')->from('comments')->limit(1)->get()->result();
        $date2 = $currentdate[0]->date2;
	    $diff = abs(strtotime($date2) - strtotime($date));
        // To get the year divide the resultant date into // total seconds in a year (365*60*60*24) 
        $years = floor($diff / (365*60*60*24));
        // To get the month, subtract it with years and // divide the resultant date into // total seconds in a month (30*60*60*24) 
        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
        // To get the day, subtract it with years and  // months and divide the resultant date into // total seconds in a days (60*60*24) 
        $days = floor(($diff - $years * 365*60*60*24 -  $months*30*60*60*24)/ (60*60*24)); 
        // To get the hour, subtract it with years,  // months & seconds and divide the resultant // date into total seconds in a hours (60*60) 
        $hours = floor(($diff - $years * 365*60*60*24  - $months*30*60*60*24 - $days*60*60*24) / (60*60));
        // To get the minutes, subtract it with years, // months, seconds and hours and divide the  // resultant date into total seconds i.e. 60 
        $minutes = floor(($diff - $years * 365*60*60*24  - $months*30*60*60*24 - $days*60*60*24  - $hours*60*60)/ 60);
        // To get the minutes, subtract it with years, // months, seconds, hours and minutes  
        $seconds = floor(($diff - $years * 365*60*60*24  - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minutes*60));
        // Print the result 
       // print_r("%d years, %d months, %d days, %d hours, ". "%d minutes, %d seconds", $years, $months, $days, $hours, $minutes, $seconds);  
        if(isset($years) && ($years > 0)){
            return $years.' years ago';
        }else if(isset($months) && ($months > 0)){
            return $months.' months ago';
        }else if(isset($days) && ($days > 0)){ 
            return $days.' days ago';
        }else if(isset($hours) && ($hours > 0)){
            return $hours.' hours ago';
        }else if(isset($minutes) && ($minutes > 1)){
            return $minutes.' minutes ago';
        }else{
            return '1 minute ago';
        }
	}
	public function readingliststatus($status, $userid){
	    if($status == 'public'){
	        return $this->db->where('user_id',$userid)->where('admin_status','unblock')
	            ->update('signup',array('readinglist' => 'private'));
	    }else{
	        return $this->db->where('user_id',$userid)->where('admin_status','unblock')
	            ->update('signup',array('readinglist' => 'public'));
	    }
	}
	
	public function blogsearch($item) {
	    $language = $this->langshortname($this->uri->segment(1));
		$search_explode = explode(" ", $item);
		$query1 = $this->db->from('banner')
			->like('banner.caption',$item,'both')->where('type','blog')->where('banner.status','active')->get();
		foreach($query1->result() as $row) {
		    if($language != 'en'){
			    $response[] = array( "label" => $row->caption, "id" => $row->caption, "link" => base_url().$this->uri->segment(1)."/blog/".preg_replace("/\s+/", "-", $row->caption)."-".$row->id);
		    } else { 
			    $response[] = array( "label" => $row->caption, "id" => $row->caption, "link" => base_url()."blog/".preg_replace("/\s+/", "-", $row->caption)."-".$row->id);
		    }
		}
		if((isset($response) && (sizeof($response) > 0))){
    		echo json_encode($response);
    	}else{
    		echo json_encode(array("label"=>'No results found'));
    	}
	}
	
	public function blogdetailsearch($searchdata = false) {
		$this->db->from('banner')->where('type','blog')->where('banner.status','active');
        $this->db->order_by('banner.id','DESC');
        if(isset($searchdata) && !empty($searchdata)){
		    $searchcon = "(banner.caption LIKE '%$searchdata%')";
		    $this->db->where($searchcon);
		}
		return $this->db->get();
	}
	
	public function blogdetail($blogid = false, $start = false, $limit = false){
        $this->db->from('banner')->where('banner.type','blog')->where('banner.status','active');
        if(isset($blogid) && ($blogid)) {
            $this->db->where('banner.id',$blogid);
        }
        if(isset($limit, $start) && !empty($limit)) {
            $this->db->limit($limit, $start);
        }
        return $this->db->get();
    }

    public function blog_comments($data){
        $this->db->insert('blog_comments',$data);
        return $this->db->insert_id();
    }
    public function blogcommentlists($blogid, $start = false, $limit = false){
        $this->db->from('blog_comments')->where('status','active')->where('blog_id',$blogid);
        if(isset($limit, $start) && !empty($limit)) {
            $this->db->limit($limit, $start);
        }
        return $this->db->order_by('id','DESC')->get();
    }
    
    
    public function facebooklogin($data, $socialid){
        $query = $this->db->select('user_id')->from('signup')->where('fbg_id',$socialid)->where('logintype','fb')->limit(1)->get()->result();
        if(isset($query[0]->user_id) && !empty($query[0]->user_id)){
            return $query[0]->user_id;
        }
    }
    public function checkfacebooklogin($data, $langnotempty = false, $updatefbdata = false){
        $this->db->select('signup.writer_language, signup.user_id')->from('signup')->where($data);
        if(isset($langnotempty) && ($langnotempty == 1)){
            $this->db->where('writer_language !=', '');
        }
        $query = $this->db->limit(1)->get()->result();
        if(isset($query[0]->user_id) && !empty($query[0]->user_id)){
            if(isset($data['email']) && !empty($data['email']) && isset($updatefbdata) && !empty($updatefbdata)){
                $this->db->where('user_id', $query[0]->user_id)->update('signup', $updatefbdata);
            }
            return $query[0]->user_id;
        }
    }
    public function checkfbgusercomm($userid){
        return $this->db->select('communities_join.id')->from('communities_join')
            ->join('signup','communities_join.user_id = signup.user_id','left')->where('signup.user_id',$userid)->get();
    }
    public function socialfbg($inputdata){
        $query = $this->db->select('user_id')->from('signup')->where('email',$inputdata['email'])
            ->or_where('fbg_id',$inputdata['fbg_id'])->limit(1)->get()->result();
        if(isset($query[0]->user_id) && !empty($query[0]->user_id)){
            return $query[0]->user_id;
        }else{
            $this->db->insert('signup',$inputdata);
            $insertid = $this->db->insert_id();
            $profile_name = preg_replace('/\s+/', '', $inputdata['name']).$insertid;
            $this->db->where('user_id',$insertid)->update('signup',array('profile_name' => $profile_name));
    		return $insertid;
        }
    }
    public function checkgooglelogin($data, $langnotempty = false, $updategoodata = false){
        $this->db->select('signup.writer_language, signup.user_id')->from('signup')->where($data);
        if(isset($langnotempty) && ($langnotempty == 1)){
            $this->db->where('writer_language !=', '');
        }
        $query = $this->db->limit(1)->get()->result();
        if(isset($query[0]->user_id) && !empty($query[0]->user_id)){
            if(isset($data['email']) && !empty($data['email']) && isset($updategoodata) && !empty($updategoodata)){
                $this->db->where('user_id', $query[0]->user_id)->update('signup', $updategoodata);
            }
            return $query[0]->user_id;
        }
    }
    public function googlelogin($data, $socialid){
        $query = $this->db->select('user_id')->from('signup')->where('fbg_id',$socialid)->where('logintype','google')->limit(1)->get()->result();
        if(isset($query[0]->user_id) && !empty($query[0]->user_id)){
            return $query[0]->user_id;
        }
    }
    
   
    public function search_series($searchdata = false, $start = false, $limit = false){
		$language = $this->langshortname($this->uri->segment(1));
		if(isset($searchdata) && !empty($searchdata) && isset($language) && !empty($language)){
		    $searchcon = "stories.title LIKE '%$searchdata%' OR stories.etitle LIKE '%$searchdata%' OR ";
		    $searchwords = explode(' ', $searchdata);
		    foreach($searchwords as $searchword){
	        $searchcon.= "stories.title LIKE '%$searchword%' OR stories.etitle LIKE '%$searchword%' OR gener.gener LIKE '%$searchword%' OR ";
		    }
		    $findlastorposition = strrpos($searchcon, 'OR ');
            $removelastorword = substr($searchcon, 0, $findlastorposition);
            $searchconfinal = "(".$removelastorword.")";
    		$query = $this->db->select('stories.*, gener.*, signup.*')->from('stories')
    		    ->join('gener','gener.id = stories.genre','left')->join('signup','signup.user_id = stories.user_id','left')
    			->where('stories.type','series')->where('stories.sid = stories.story_id')->where('stories.draft !=','draft')
    			->where('stories.status','active')->where('stories.language',$language)->where('stories.story_id !=',0)
    			->where($searchconfinal)->group_by('stories.story_id')->order_by('stories.sid','DESC')->limit($limit, $start)->get();
    		if($query->num_rows() > 0){
    		    return $query;
    		}else{
    		    $query1 = $this->db->select('stories.*, gener.*, signup.*')->from('stories')
        		    ->join('gener','gener.id = stories.genre','left')->join('signup','signup.user_id = stories.user_id','left')
        			->where('stories.type','series')->where('stories.sid = stories.story_id')->where('stories.draft !=','draft')
        			->where('stories.status','active')->where('stories.language',$language)->where('stories.story_id !=',0)
        			->like('stories.keywords',$searchdata, 'both')->group_by('stories.story_id')
        			->order_by('stories.sid','DESC')->limit($limit, $start)->get();
        		if($query1->num_rows() > 0){
        		    return $query1;
        		}else{
        		    $query2 = $this->db->select('stories.*, gener.*, signup.*')->from('stories')
            		    ->join('gener','gener.id = stories.genre','left')->join('signup','signup.user_id = stories.user_id','left')
            			->where('stories.type','series')->where('stories.sid = stories.story_id')->where('stories.draft !=','draft')
            			->where('stories.status','active')->where('stories.language',$language)->where('stories.story_id !=',0)
            			->like('signup.name',$searchdata, 'both')->group_by('stories.story_id')
            			->order_by('stories.sid','DESC')->limit($limit, $start)->get();
            		if($query2->num_rows() > 0){
            		    return $query2;
            		}else{
            		    $query3 = $this->db->select('stories.*, gener.*, signup.*')->from('stories')
                		    ->join('gener','gener.id = stories.genre','left')->join('signup','signup.user_id = stories.user_id','left')
                			->where('stories.type','series')->where('stories.sid = stories.story_id')->where('stories.draft !=','draft')
                			->where('stories.status','active')->where('stories.language',$language)->where('stories.story_id !=',0)
                			->like('gener.gener',$searchdata, 'both')->group_by('stories.story_id')
                			->order_by('stories.sid','DESC')->limit($limit, $start)->get();
                		if($query3->num_rows() > 0){
                		    return $query3;
                		}
            		}
        		}
    		}
		}
	}
	public function search_storys($searchdata = false,$start = false, $limit = false){
		$language = $this->langshortname($this->uri->segment(1));
		if(isset($searchdata) && !empty($searchdata) && isset($language) && !empty($language)){
		    $searchcon = "stories.title LIKE '%$searchdata%' OR stories.etitle LIKE '%$searchdata%' OR ";
		    $searchwords = explode(' ', $searchdata);
		    foreach($searchwords as $searchword){
	        $searchcon.= "stories.title LIKE '%$searchword%' OR stories.etitle LIKE '%$searchword%' OR gener.gener LIKE '%$searchword%' OR ";
		    }
		    $findlastorposition = strrpos($searchcon, 'OR ');
            $removelastorword = substr($searchcon, 0, $findlastorposition);
            $searchconfinal = "(".$removelastorword.")";
    	    $query = $this->db->select('stories.*, gener.*, signup.*')->from('stories')
    	        ->join('gener','stories.genre = gener.id', 'left')
    	        ->join('signup','stories.user_id = signup.user_id','left')->where('stories.draft !=','draft')
    	        ->where('((stories.type ="story") OR (stories.type ="series" AND stories.sid != stories.story_id))')
    	        ->where('stories.status','active')->where('stories.language',$language)->where($searchconfinal)
    	        ->order_by('stories.sid','DESC')->limit($limit, $start)->get();
            if($query->num_rows() > 0){
                return $query;
            }else{
                $query1 = $this->db->select('stories.*, gener.*, signup.*')->from('stories')
        	        ->join('gener','stories.genre = gener.id', 'left')
        	        ->join('signup','stories.user_id = signup.user_id','left')->where('stories.draft !=','draft')
        	        ->where('((stories.type ="story") OR (stories.type ="series" AND stories.sid != stories.story_id))')
        	        ->where('stories.status','active')->where('stories.language',$language)->like('stories.keywords',$searchdata,'both')
        	        ->order_by('stories.sid','DESC')->limit($limit, $start)->get();
                if($query1->num_rows() > 0){
                    return $query1;
                }else{
                    $query2 = $this->db->select('stories.*, gener.*, signup.*')->from('stories')
            	        ->join('gener','stories.genre = gener.id', 'left')
            	        ->join('signup','stories.user_id = signup.user_id','left')->where('stories.draft !=','draft')
            	        ->where('((stories.type ="story") OR (stories.type ="series" AND stories.sid != stories.story_id))')
            	        ->where('stories.status','active')->where('stories.language',$language)->like('signup.name',$searchdata,'both')
            	        ->order_by('stories.sid','DESC')->limit($limit, $start)->get();
                    if($query2->num_rows() > 0){
                        return $query2;
                    }else{
                        $query3 = $this->db->select('stories.*, gener.*, signup.*')->from('stories')
                	        ->join('gener','stories.genre = gener.id', 'left')
                	        ->join('signup','stories.user_id = signup.user_id','left')->where('stories.draft !=','draft')
                	        ->where('((stories.type ="story") OR (stories.type ="series" AND stories.sid != stories.story_id))')
                	        ->where('stories.status','active')->where('stories.language',$language)->like('gener.gener',$searchdata,'both')
                	        ->order_by('stories.sid','DESC')->limit($limit, $start)->get();
                        if($query3->num_rows() > 0){
                            return $query3;
                        }
                    } // nodata with writer name and search with gener name
                } // nodata with keywords and search with writer name
    		} // nodata with title search and data with keywords
    	} //searchtext, language if
	}
	public function search_life($searchdata = false, $start = false, $limit = false){
    	$language = $this->langshortname($this->uri->segment(1));
    	if(isset($searchdata) && !empty($searchdata) && isset($language) && !empty($language)){
    	    $searchcon = "stories.title LIKE '%$searchdata%' OR stories.etitle LIKE '%$searchdata%' OR ";
    	    $searchwords = explode(' ', $searchdata);
		    foreach($searchwords as $searchword){
	            $searchcon.= "stories.title LIKE '%$searchword%' OR stories.etitle LIKE '%$searchword%' OR ";
		    }
		    $findlastorposition = strrpos($searchcon, 'OR ');
            $removelastorword = substr($searchcon, 0, $findlastorposition);
            $searchconfinal = "(".$removelastorword.")";
            
            $this->db->select('stories.*, gener.*, signup.*')->from('stories')
                ->join('gener','stories.genre = gener.id', 'left')->join('signup','stories.user_id = signup.user_id','left')
                ->where('stories.status','active')->where('stories.type','life')->where('stories.draft !=','draft')
                ->where('stories.language',$language)->where($searchconfinal)->get();
            $query = $this->db->last_query();
            
            $this->db->select('stories.*, gener.*, signup.*')->from('stories')
                ->join('gener','stories.genre = gener.id', 'left')->join('signup','stories.user_id = signup.user_id','left')
                ->where('stories.status','active')->where('stories.type','life')->where('stories.draft !=','draft')
                ->where('stories.language',$language)->like('stories.keywords',$searchdata,'both')->get();
            $query1 = $this->db->last_query();
            
            $this->db->select('stories.*, gener.*, signup.*')->from('stories')
                ->join('gener','stories.genre = gener.id', 'left')->join('signup','stories.user_id = signup.user_id','left')
                ->where('stories.status','active')->where('stories.type','life')->where('stories.draft !=','draft')
                ->where('stories.language',$language)->like('signup.name',$searchdata,'both')
                ->where('stories.writing_style !=','anonymous')->get();
            $query2 = $this->db->last_query();
            if(isset($limit) && ($limit == 'all')){
                return $this->db->query($query." UNION ".$query1." UNION ".$query2." GROUP BY stories.sid ");
    		}else{
        	    return $this->db->query($query." UNION ".$query1." UNION ".$query2." GROUP BY stories.sid LIMIT ".$start.", ".$limit);
    		}
            
    	} //searchtext, language if
    	/*if(isset($searchdata) && !empty($searchdata) && isset($language) && !empty($language)){
    	    $searchcon = "stories.title LIKE '%$searchdata%' OR stories.etitle LIKE '%$searchdata%' OR ";
    	    $searchwords = explode(' ', $searchdata);
		    foreach($searchwords as $searchword){
	        $searchcon.= "stories.title LIKE '%$searchword%' OR stories.etitle LIKE '%$searchword%' OR ";
		    }
		    $findlastorposition = strrpos($searchcon, 'OR ');
            $removelastorword = substr($searchcon, 0, $findlastorposition);
            $searchconfinal = "(".$removelastorword.")";
    	    $this->db->select('stories.*, gener.*, signup.*')->from('stories')
    	        ->join('gener','stories.genre = gener.id', 'left')->join('signup','stories.user_id = signup.user_id','left')
    	        ->where('stories.status','active')->where('stories.type','life')->where('stories.draft !=','draft')
    	        ->where('stories.language',$language)->where($searchconfinal);
    	        //->where('stories.writing_style !=','anonymous');
    		if(isset($limit) && ($limit == 'all')){
    		}else{
        	    $this->db->limit($limit, $start);
    		}
		    $query = $this->db->order_by('stories.sid','DESC')->get();
		    if($query->num_rows() > 0){
    		    return $query;
    		}else{
                $this->db->select('stories.*, gener.*, signup.*')->from('stories')
                    ->join('gener','stories.genre = gener.id', 'left')->join('signup','stories.user_id = signup.user_id','left')
                    ->where('stories.status','active')->where('stories.type','life')->where('stories.draft !=','draft')
                    ->where('stories.language',$language)->like('stories.keywords',$searchdata,'both');
                    //->where('stories.writing_style !=','anonymous');
            	if(isset($limit) && ($limit == 'all')){
            	}else{
            	    $this->db->limit($limit, $start);
            	}
                $query1 = $this->db->order_by('stories.sid','DESC')->get();
                if($query1->num_rows() > 0){
        		    return $query1;
        		}else {
        		    $searchcon = "(stories.title LIKE '%$searchdata%' OR stories.etitle LIKE '%$searchdata%')";
            	    $this->db->select('stories.*, gener.*, signup.*')->from('stories')
            	        ->join('gener','stories.genre = gener.id', 'left')->join('signup','stories.user_id = signup.user_id','left')
            	        ->where('stories.status','active')->where('stories.type','life')->where('stories.draft !=','draft')
            	        ->where('stories.language',$language)->like('signup.name',$searchdata,'both')
            	        ->where('stories.writing_style !=','anonymous');
            		if(isset($limit) && ($limit == 'all')){
            		}else{
                	    $this->db->limit($limit, $start);
            		}
        		    $query2 = $this->db->order_by('stories.sid','DESC')->get();
        		    if($query2->num_rows() > 0){
            		    return $query2;
            		}
        		} // nodata with keywords and search with writer name
    		} // nodata with title search and data with keywords
    	} //searchtext, language if*/
	}
	public function contact($data){
	    $message = '';
	    $message.= 'Dear Admin, '.$data['name'].' Contacted You, <br> <u><b>Details</b></u><br>'; 
	    $message.=  'Request : '. $data['request_for'].'<br>';
		$message.=  'Name: '. $data['name'].'<br>';
        $message.=  'Email: '. $data['email'].'<br>';
		$message.=  'Link: '. $data['link'].'<br>';
		$message.=  'Description: '. $data['descr'].'<br>';
	    $this->email->from(ADMIN_EMAIL, ADMIN_NAME);
		$this->email->to('CONTACT_EMAIL', 'CONTACT_NAME');
		$this->email->subject('Enquiry Request in StoryCarry');
		$this->email->message($message);
		$this->email->attach(base_url().'assets/images/'.$data['file']);
		$this->email->set_mailtype('html');
		$status = $this->email->send();
	    return $this->db->insert('contact', $data);
	}
    
    /* admin_story load more 
    public function adminstorylist($storyid = false, $start=false, $limit=false){
        if(isset($_GET['id']) && !empty($_GET['id'])){  $sid = $_GET['id'];
        	$query = $this->db->select('comments.*, signup.profile_image')->from('comments')
        	    ->join('signup','comments.user_id = signup.user_id','left')->where('comments.story_id',$sid)
        	    ->where('comments.comment_id',0)->order_by('cid','desc')->limit($limit, $start)->get();
        	return $query;
        } else if(isset($storyid) && !empty($storyid)){
            //$sid = $storyid;
            return $this->db->select('comments.*, signup.profile_image')->from('comments')
        	    ->join('signup','comments.user_id = signup.user_id','left')->where('comments.story_id',$storyid)
        	    ->where('comments.comment_id',0)->order_by('cid','desc')->limit($limit, $start)->get();
        }
    }*/
    
    /* Navigation other language data start here */
    public function headmenus(){
        $language = $this->langshortname($this->uri->segment(1));
        $data = array();
        $query = $this->db->from('headermenu')->where('navbartype','header')->where('(menu_type = "mainmenu" OR menu_type = "submenu")')
            ->where('language',$language)->get();
        if($query->num_rows() > 0){ foreach($query->result() as $row){
            $data[$row->for_menu] = $row->menu_name;
        }   }
        return $data;
    }
    public function leftmenus(){
        $language = $this->langshortname($this->uri->segment(1));
        $data = array();
        $query = $this->db->from('leftmenu')->where('navbartype','leftside')->where('(menu_type = "mainmenu" OR menu_type = "submenu")')
            ->where('language',$language)->get();
        if($query->num_rows() > 0){ foreach($query->result() as $row){
            $data[$row->for_menu] = $row->menu_name;
        }   }
        return $data;
    }
    public function profilemenus(){
        $language = $this->langshortname($this->uri->segment(1));
        $data = array();
        $query = $this->db->from('profilemenu')->where('navbartype','profile')->where('(menu_type = "mainmenu" OR menu_type = "submenu")')
            ->where('language',$language)->get();
        if($query->num_rows() > 0){ foreach($query->result() as $row){
            $data[$row->for_menu] = $row->menu_name;
        }   }
        return $data;
    }
    /* Navigation other language data end here */
    
    /* Admin Login start */
    public function adminlogin($data){
    	return $this->db->from('admin')->where($data)->limit(1)->get();
    }
    /* Admin Login end */
}	