<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_model extends CI_model {
    /*header Menu Language change Start*/
	public function addheadmenu($inputdata){
	    $data = $inputdata;
	    unset($data["menu_name"]);
	    $query = $this->db->from('headermenu')->where($data)->get();
	    if($query->num_rows() > 0){
	        return false;
	    }else{
	        return $this->db->insert('headermenu',$inputdata);
	    }
	}
	public function headmenulist($language){
	    return $this->db->from('headermenu')->where('language', $language)->get();
	}
	
	public function editheadmenu($language,$id){
	    return $this->db->from('headermenu')->where('language', $language)->where('id',$id)->limit(1)->get();
	}
	public function updateheadmenu($inputdata, $id){
	    $data = $inputdata;
	    unset($data["menu_name"]);
	    $query = $this->db->from('headermenu')->where($data)->where('id !=',$id)->get();
	    if($query->num_rows() > 0){
	        return false;
	    }else{
	        return $this->db->where('id',$id)->update('headermenu',$inputdata);
	    }
	}
	public function deleteheadmenu($language, $id){
	    return $this->db->from('headermenu')->where('id',$id)->where('language',$language)->delete();
	}
	/*header Menu Language change end */
	
	/*Left Menu Language change Start */
	public function addleftmenu($inputdata){
	    $data = $inputdata;
	    unset($data["menu_name"]);
	    $query = $this->db->from('leftmenu')->where($data)->get();
	    if($query->num_rows() > 0){
	        return false;
	    }else{
	        return $this->db->insert('leftmenu',$inputdata);
	    }
	}
	public function leftmenulist($language){
	    return $this->db->from('leftmenu')->where('language', $language)->get();
	}
	public function editleftmenu($language,$id){
	    return $this->db->from('leftmenu')->where('language', $language)->where('id',$id)->limit(1)->get();
	}
	public function updateleftmenu($inputdata, $id){
	    $data = $inputdata;
	    unset($data["menu_name"]);
	    $query = $this->db->from('leftmenu')->where($data)->where('id !=',$id)->get();
	    if($query->num_rows() > 0){
	        return false;
	    }else{
	        return $this->db->where('id',$id)->update('leftmenu',$inputdata);
	    }
	}
	public function deleteleftmenu($language, $id){
	    return $this->db->from('leftmenu')->where('id',$id)->where('language',$language)->delete();
	}
	
	public function generslist(){ // For Geners dynamic names
	    return $this->db->from('gener')->get();
	}
	/*Left Menu Language change end */
	
	/*Profile Menu Language change Start */
	public function addprofilemenu($inputdata){
	    $data = $inputdata;
	    unset($data["menu_name"]);
	    $query = $this->db->from('profilemenu')->where($data)->get();
	    if($query->num_rows() > 0){
	        return false;
	    }else{
	        return $this->db->insert('profilemenu',$inputdata);
	    }
	}
	public function profilemenulist($language){
	    return $this->db->from('profilemenu')->where('language', $language)->get();
	}
	public function editprofilemenu($language,$id){
	    return $this->db->from('profilemenu')->where('language', $language)->where('id',$id)->limit(1)->get();
	}
	public function updateprofilemenu($inputdata, $id){
	    $data = $inputdata;
	    unset($data["menu_name"]);
	    $query = $this->db->from('profilemenu')->where($data)->where('id !=',$id)->get();
	    if($query->num_rows() > 0){
	        return false;
	    }else{
	        return $this->db->where('id',$id)->update('profilemenu',$inputdata);
	    }
	}
	public function deleteprofilemenu($language, $id){
	    return $this->db->from('profilemenu')->where('id',$id)->where('language',$language)->delete();
	}
	/*Profile Menu Language change end */
	
	/* home page slide show images & links start */
	public function homeslides($language){
	    return $this->db->from('banner')->where('language',$language)->where('type','banner')->get();
	}
	public function addhomeslide($inputdata){
	    return $this->db->insert('banner',$inputdata);
	}
	public function edithomeslide($language,$id){
	    return $this->db->from('banner')->where('language',$language)->where('id',$id)->where('type','banner')->limit(1)->get();
	}
	public function updatehomeslide($inputdata, $id){
	    return $this->db->where('id',$id)->where('type','banner')->update('banner', $inputdata);
	}
	public function deletehomeslide($id){
	    $queryrow = $this->db->from('banner')->where('id',$id)->where('type','banner')->get()->result();
	        if(isset($queryrow[0]->slideimage) && !empty($queryrow[0]->slideimage)){
    	        unlink('assets/images/'.$queryrow[0]->slideimage);
    	    }
    	    if(isset($queryrow[0]->image) && !empty($queryrow[0]->image)){
    	        unlink('assets/images/'.$queryrow[0]->image);
    	    }
	    return $this->db->from('banner')->where('id',$id)->where('type','banner')->delete();
	}
	/* home page slide show images & links end */
	
	/*Users List Start */
	public function userslist($language){
        $query = "SELECT signup.*, stories.sid FROM signup LEFT JOIN stories ON signup.user_id = stories.user_id 
            WHERE signup.user_id = stories.user_id AND stories.language = '$language' 
            GROUP BY signup.user_id ORDER BY signup.user_id DESC";
        return $this->db->query($query);
	}
	public function profilestories($language,$userid){
	    return $this->db->select('stories.*, gener.gener, signup.*, COUNT(story_views.id) as uniqueviews')->from('stories')
	        ->join('story_views', 'stories.sid = story_views.story_id', 'left')
            ->join('gener','gener.id = stories.genre','left')->join('signup','signup.user_id = stories.user_id','left')
            ->where('stories.user_id',$userid)->where('stories.language',$language)
            ->group_by('stories.sid')->order_by('stories.sid','DESC')->get();
	}
	public function blockprofile($userid){
	    return $this->db->where('user_id',$userid)->update('signup', array('admin_status' => 'block'));
	}
	public function unblockprofile($userid){
	    return $this->db->where('user_id',$userid)->update('signup', array('admin_status' => 'unblock'));
	}
	public function verifyprofile($userid){
	    return $this->db->where('user_id',$userid)->update('signup', array('admin_verify' => 'verified'));
	}
	public function notverifyprofile($userid){
	    return $this->db->where('user_id',$userid)->update('signup', array('admin_verify' => 'not_verified'));
	}
	public function deleteprofile($userid){
	    $userquery = $this->db->from('signup')->where('user_id',$userid)->get()->result();
	        if(isset($userquery[0]->banner_image) && !empty($userquery[0]->banner_image)){
    	        unlink('assets/images/'.$userquery[0]->banner_image);
    	    }
    	    if(isset($userquery[0]->pbanner_image) && !empty($userquery[0]->pbanner_image)){
    	        unlink('assets/images/'.$userquery[0]->pbanner_image);
    	    }
    	    if(isset($userquery[0]->profile_image) && !empty($userquery[0]->profile_image)){
    	        unlink('assets/images/'.$userquery[0]->profile_image);
    	    }
	    $query = $this->db->where('user_id',$userid)->from('signup')->delete();
	    //delete all stories of the user
	    $storiesquery = $this->db->from('stories')->where('user_id',$userid)->get();
	    if($storiesquery->num_rows() > 0){ foreach($storiesquery->result() as $storyqueryrow){   
	        if(isset($storyqueryrow->cover_image) && !empty($storyqueryrow->cover_image)){
    	        unlink('assets/images/'.$storyqueryrow->cover_image);
    	    }
    	    if(isset($storyqueryrow->image) && !empty($storyqueryrow->image)){
    	        unlink('assets/images/'.$storyqueryrow->image);
    	    }
	    }   }
	    $deletestories = $this->db->where('user_id',$userid)->from('stories')->delete();
	    return $query;
	}
	public function languages(){ // For userslist Sorting
	    return $this->db->from('language')->get();
	}
	public function usersearch($language, $data){ // search of users list
	    $query = "SELECT signup.*, stories.sid FROM signup LEFT JOIN stories ON signup.user_id = stories.user_id 
            WHERE signup.user_id = stories.user_id AND stories.language = '$language' ";
            if(isset($data['search']) && !empty($data['search'])){
                $query.=" AND signup.name LIKE '%".$data['search']."%' ";
            }if(isset($data['language']) && !empty($data['language'])){
                $query.=" AND signup.writer_language ='".$data['language']."' ";
            }if(isset($data['emailverify']) && !empty($data['emailverify'])){
                $query.=" AND signup.user_activation =".$data['emailverify'];
            }if(isset($data['monetisation']) && !empty($data['monetisation'])){
                $query.=" AND signup.monetisation ='".$data['monetisation']."' ";
            }
            $query.=" GROUP BY signup.user_id ORDER BY signup.user_id DESC";
        return $this->db->query($query);
        
	    /*
	    // search and sort of users list
	    $query = "SELECT signup.*, stories.sid FROM signup LEFT JOIN stories ON signup.user_id = stories.user_id 
            WHERE signup.user_id = stories.user_id AND stories.language = '$language' ";
        if(isset($data['search']) && !empty($data['search'])){
            $query.=" AND signup.name LIKE '%".$data['search']."%' ";
        }
        $query.=" GROUP BY signup.user_id ";
        if(isset($data['language']) && !empty($data['language']) && isset($data['emailverify']) && !empty($data['emailverify'])){
            $query.=" ORDER BY ( CASE WHEN signup.writer_language='".$data['language']."' THEN 0 ELSE 1 END ),signup.writer_language DESC, ";
            $query.=" ( CASE WHEN signup.user_activation=".$data['emailverify']." THEN 2 ELSE 3 END ),signup.user_activation DESC";
        }else if(isset($data['language']) && !empty($data['language']) && (!isset($data['emailverify']) || empty($data['emailverify']))){
            $query.=" ORDER BY ( CASE WHEN signup.writer_language='".$data['language']."' THEN 0 ELSE 1 END ),signup.writer_language DESC, ";
        }elseif((!isset($data['language']) || empty($data['language'])) && isset($data['emailverify']) && !empty($data['emailverify'])){
            $query.=" ORDER BY ( CASE WHEN signup.user_activation=".$data['emailverify']." THEN 2 ELSE 3 END ),signup.user_activation DESC";
        }else{
            $query.=" ORDER BY signup.user_id DESC";
        }
        return $this->db->query($query); */
	}
	public function pstoriessearch($language, $userid, $type = false){
	    $this->db->select('stories.*, gener.gener, signup.*, COUNT(story_views.id) as uniqueviews')->from('stories')
	        ->join('story_views', 'stories.sid = story_views.story_id', 'left')
            ->join('gener','gener.id = stories.genre','left')->join('signup','signup.user_id = stories.user_id','left')
            ->where('stories.user_id',$userid)->where('stories.language',$language);
        if(isset($type) && !empty($type)){
            $this->db->where('stories.type',$type);
        }
        return $this->db->group_by('stories.sid')->order_by('stories.sid','DESC')->get();
	}
	public function addearningcount($language, $userid, $earnings){
	    $query = $this->db->select('total_earnings')->from('signup')->where('user_id',$userid)->limit(1)->get()->result();
	    if(isset($query[0]->total_earnings)){
	        $total = $query[0]->total_earnings+$earnings;
	        return $this->db->where('user_id',$userid)->update('signup', array('total_earnings'=>$total));
	    }else{
	        return false;
	    }
	}
	/*Users List End*/
	
	/*Stories List Start*/
	public function storieslist($language){
	    $query = "SELECT stories.*, COUNT(story_views.id) as uniqueviews, gener.gener, signup.name, signup.lastname, 
	        signup.profile_name FROM stories LEFT JOIN story_views ON stories.sid = story_views.story_id
    	     LEFT JOIN gener ON stories.genre = gener.id LEFT JOIN signup ON signup.user_id = stories.user_id 
    	     WHERE stories.language='$language' GROUP BY stories.sid ORDER BY stories.sid DESC";
	     return $this->db->query($query);
	}
	public function storyreports($sid){
	    return $this->db->select('reports.report_msg, reports.created_at, signup.name, signup.lastname, signup.profile_name')
	        ->from('reports')->join('signup','reports.reported_by = signup.user_id', 'left')
	        ->where('reports.story_id',$sid)->get();
	}
	public function deletestory($sid){
	    $storyqueryrow = $this->db->from('stories')->where('sid',$sid)->get()->result();
	    $query = $this->db->where('sid',$sid)->from('stories')->delete();  
        if(isset($storyqueryrow[0]->cover_image) && !empty($storyqueryrow[0]->cover_image)){
	        unlink('assets/images/'.$storyqueryrow[0]->cover_image);
	    }
	    if(isset($storyqueryrow[0]->image) && !empty($storyqueryrow[0]->image)){
	        unlink('assets/images/'.$storyqueryrow[0]->image);
	    }
	    $this->db->from('rating')->where('story_id',$sid)->delete();
	    $this->db->from('readlater')->where('story_id',$sid)->delete();
	    $this->db->from('reports')->where('story_id',$sid)
	        ->where('(type = "story" OR type = "series" OR type = "nano" OR type = "life")')->delete(); 
	    $this->db->from('story_views')->where('story_id',$sid)->delete();
	    return $query;
	}
	public function deleteseries($sid){
	    $storyqueryrow = $this->db->from('stories')->where('story_id',$sid)->where('type','series')->get();
	    if($storiesquery->num_rows() > 0){ foreach($storiesquery->result() as $storyqueryrow){
	        if(isset($storyqueryrow->cover_image) && !empty($storyqueryrow->cover_image)){
    	        unlink('assets/images/'.$storyqueryrow->cover_image);
    	    }
    	    if(isset($storyqueryrow->image) && !empty($storyqueryrow->image)){
    	        unlink('assets/images/'.$storyqueryrow->image);
    	    }
	    }   }
	    $query = $this->db->where('story_id',$sid)->where('type','series')->from('stories')->delete();
	    $this->db->from('rating')->where('story_id',$sid)->delete();
	    $this->db->from('readlater')->where('story_id',$sid)->delete();
	    $this->db->from('reports')->where('story_id',$sid)->where('type','series')->delete();
	    $this->db->from('story_views')->where('story_id',$sid)->delete();
	    return $query;
	}
	public function adminchoice($sid){
	    return $this->db->where('sid',$sid)->where('type','story')->update('stories', array('admin_choice' => 2));
	}
	public function storiessearch($language, $data){
	    $query = "SELECT stories.*, COUNT(story_views.id) as uniqueviews, gener.gener, signup.name, signup.lastname, 
	        signup.profile_name FROM stories LEFT JOIN story_views ON stories.sid = story_views.story_id
    	     LEFT JOIN gener ON stories.genre = gener.id LEFT JOIN signup ON signup.user_id = stories.user_id 
    	     WHERE stories.language='$language' ";
        if(isset($data['type']) && !empty($data['type'])){
            $type = $data['type'];
            $query.=" AND stories.type ='".$type."' ";
        }if(isset($data['geners']) && !empty($data['geners'])){
            $geners = $data['geners'];
            $query.=" AND stories.genre ='".$geners."' ";
        }if(isset($data['publishedstatus']) && !empty($data['publishedstatus'])){
            $publishedstatus = $data['publishedstatus'];
            if($data['publishedstatus'] == 'draft'){
                $query.=" AND stories.draft ='".$publishedstatus."' ";
            }elseif($data['publishedstatus'] == 'not_draft'){
                $query.=" AND stories.draft != 'draft' ";
            }
        }if(isset($data['monetisation']) && !empty($data['monetisation'])){
            $monetisation = $data['monetisation'];
            $query.=" AND stories.pay_story ='".$monetisation."' ";
        }
        $query.=" GROUP BY stories.sid ORDER BY stories.sid DESC";
	    return $this->db->query($query);
	}
	/*Stories List End*/
	
	/*Blogs List start*/
	public function blogs($language){
	    return $this->db->from('banner')->where('language',$language)->where('type','blog')->get();
	}
	public function addblog($inputdata){
	    return $this->db->insert('banner', $inputdata);
	}
	public function editblog($language,$id){
	    return $this->db->from('banner')->where('language',$language)->where('id',$id)->where('type','blog')->limit(1)->get();
	}
	public function updateblog($inputdata, $id){
	    return $this->db->where('id',$id)->where('type','blog')->update('banner', $inputdata);
	}
	public function deleteblog($id){
	    $query = $this->db->from('banner')->where('id',$id)->where('type','blog')->get()->result();
	        if(isset($query[0]->slideimage) && !empty($query[0]->slideimage)){
    	        unlink('assets/images/'.$query[0]->slideimage);
    	    }
    	    if(isset($query[0]->image) && !empty($query[0]->image)){
    	        unlink('assets/images/'.$query[0]->image);
    	    }
	    return $this->db->from('banner')->where('id',$id)->where('type','blog')->delete();
	}
	/*Blogs List End*/
	
	/* Reports Start */
	public function reports(){
	    return $this->db->select('reports.*, signup.name as postedtoname, signup.lastname as postedtolastname, stories.title')
    	    ->from('reports')->join('stories','reports.story_id = stories.sid', 'left')
    	    ->join('signup','reports.posted_byid = signup.user_id','left')->get();
	}
	public function reportblockstory($sid){
	    $this->db->where('story_id',$sid)->where('type','story')->update('reports', array('status' => 'block'));
	    return $this->db->where('sid',$sid)->where('type','story')->update('stories', array('status' => 'block'));
	}
	public function reportblockseries($sid){
	    $this->db->where('story_id',$sid)->where('type','series')->update('reports', array('status' => 'block'));
	    return $this->db->where('story_id',$sid)->where('type','series')->update('stories', array('status' => 'block'));
	}
	public function reportdeletestory($sid){
	    $this->db->from('reports')->where('story_id',$sid)->where('type','story')->delete();
	    $storyqueryrow = $this->db->from('stories')->where('sid',$sid)->where('type','story')->get()->result();
    	    if(isset($storyqueryrow[0]->cover_image) && !empty($storyqueryrow[0]->cover_image)){
    	        unlink('assets/images/'.$storyqueryrow[0]->cover_image);
    	    }
    	    if(isset($storyqueryrow[0]->image) && !empty($storyqueryrow[0]->image)){
    	        unlink('assets/images/'.$storyqueryrow[0]->image);
    	    }
	    return $this->db->from('stories')->where('sid',$sid)->where('type','story')->delete();
	}
	public function reportdeleteseries($sid){
	    $this->db->from('reports')->where('story_id',$sid)->where('type','series')->delete();
	    $storyquery = $this->db->from('stories')->where('story_id',$sid)->where('type','series')->get();
	    if($storyquery->num_rows() > 0){ foreach($storyquery->result() as $storyqueryrow){
	        if(isset($storyqueryrow->cover_image) && !empty($storyqueryrow->cover_image)){
    	        unlink('assets/images/'.$storyqueryrow->cover_image);
    	    }
    	    if(isset($storyqueryrow->image) && !empty($storyqueryrow->image)){
    	        unlink('assets/images/'.$storyqueryrow->image);
    	    }
	    }   }
	    return $this->db->from('stories')->where('story_id',$sid)->where('type','series')->delete();
	}
	public function reportstypesearch($language, $type){
	    if($type == 'story'){
	        return $this->db->select('reports.*, signup.name as postedtoname, signup.lastname as postedtolastname, stories.title')
        	    ->from('reports')->join('stories','reports.story_id = stories.sid', 'left')->where('stories.language',$language)
        	    ->join('signup','reports.posted_byid = signup.user_id','left')->where('reports.type','story')->get();
	    }elseif($type == 'series'){
	        return $this->db->select('reports.*, signup.name as postedtoname, signup.lastname as postedtolastname, stories.title')
        	    ->from('reports')->join('stories','reports.story_id = stories.sid', 'left')->where('stories.language',$language)
        	    ->join('signup','reports.posted_byid = signup.user_id','left')->where('reports.type','series')->get();
	    }elseif($type == 'life'){
	        return $this->db->select('reports.*, signup.name as postedtoname, signup.lastname as postedtolastname, stories.title')
        	    ->from('reports')->join('stories','reports.story_id = stories.sid', 'left')->where('stories.language',$language)
        	    ->join('signup','reports.posted_byid = signup.user_id','left')->where('reports.type','life')->get();
	    }elseif($type == 'nano'){
	        return $this->db->select('reports.*, signup.name as postedtoname, signup.lastname as postedtolastname, stories.title')
        	    ->from('reports')->join('stories','reports.story_id = stories.sid', 'left')->where('stories.language',$language)
        	    ->join('signup','reports.posted_byid = signup.user_id','left')->where('reports.type','nano')->get();
	    }
	}
	/* Reports end */
	/* Stories Reports start */
	public function storiesreports($language){
	    return $this->db->select('reports.*, signup.name as postedtoname, signup.lastname as postedtolastname, stories.title, 
	        stories.status as storystatus')
    	    ->from('reports')->join('stories','reports.story_id = stories.sid', 'left')
    	    ->join('signup','reports.posted_byid = signup.user_id','left')->where('stories.language',$language)
    	    ->where('(reports.type="story" OR reports.type="series" OR reports.type="life" OR reports.type="nano")')->get();
	}
	public function blockstory($language, $storyid){
	    return $this->db->where('sid',$storyid)->where('language',$language)->update('stories', array('status' => 'block'));
	}
	public function blockseries($language, $seriesid){
	    return $this->db->where('story_id',$seriesid)->where('language',$language)->where('type','series')->update('stories', array('status' => 'block'));
	}
	public function unblockstory($language, $storyid){
	    return $this->db->where('sid',$storyid)->where('language',$language)->update('stories', array('status' => 'active'));
	}
	public function unblockseries($language, $seriesid){
	    return $this->db->where('story_id',$seriesid)->where('language',$language)->where('type','series')->update('stories', array('status' => 'active'));
	}
	/* Stories Reports end */
	
	/* Stories comments Reports start */
	public function storiescmtreports($language){
	    return $this->db->select('reports.*, stories.title, stories.type as storytype, signup.name as postedtoname, 
	        signup.lastname as postedtolastname')->from('reports')
	        ->join('signup','reports.posted_byid = signup.user_id','left')
	        ->join('stories','reports.story_id = stories.sid','left')
	        ->where('(reports.type = "story_comment" OR reports.type = "series_comment" OR reports.type = "nano_comment" OR reports.type = "life_comment")')
	        ->get();
	}
	/* Stories comments Reports end */
	
	/* communities Reports start */
	public function communitiesreports($language){
	    return $this->db->select('reports.*, signup.name as postedtoname, signup.lastname as postedtolastname, 
	        communities_story.story, communities_story.title, communities_story.typeoftype, 
	        communities_story.status as commstorystatus, communities.gener')->from('reports')
    	    ->join('signup','reports.posted_byid = signup.user_id','left')
    	    ->join('communities_story','reports.comm_story_id = communities_story.id','left')
    	    ->join('communities','communities_story.comm_id = communities.id', 'left')
    	    ->where('reports.type','commpost_report')->where('communities.joincomm_lang',$language)->get();
	}
	public function blockcommreportstory($language, $comm_story_id){
	    return $this->db->where('id',$comm_story_id)->update('communities_story', array('status' => 'block'));
	}
	public function unblockcommreportstory($language, $comm_story_id){
	    return $this->db->where('id',$comm_story_id)->update('communities_story', array('status' => 'active'));
	}
	public function deletecommreportstory($language, $comm_story_id){
	    $query = $this->db->where('id',$comm_story_id)->from('communities_story')->delete();
	    $this->db->where('comm_story_id',$comm_story_id)->where('type','commpost_report')->from('reports')->delete();
	    $this->db->where('story_id',$comm_story_id)->from('comm_comments')->delete();
	    return $query;
	}
	/* communities Reports end */
	
	/* communities Comments Reports start */
	public function communitiescmtreports($language){
	    return $this->db->select('reports.*, signup.name as postedtoname, signup.lastname as postedtolastname, 
	        comm_comments.comment, comm_comments.status as cmtstatus')->from('reports')
	        ->join('signup','reports.posted_byid = signup.user_id','left')
	        ->join('comm_comments','reports.comment_id = comm_comments.id', 'left')
	        ->where('reports.type','comm_comment')->get();
	}
	public function unblockcommcmtreport($language, $comm_commentid){
	    return $this->db->where('comm_comments.id',$comm_commentid)->update('comm_comments', array('status' => 'active'));
	}
	public function blockcommcmtreport($language, $comm_commentid){
	    return $this->db->where('comm_comments.id',$comm_commentid)->update('comm_comments', array('status' => 'block'));
	}
	public function deletecommcmtreport($language, $comm_commentid){
	    $this->db->from('reports')->where('reports.comment_id',$comm_commentid)->delete();
	    return $this->db->from('comm_comments')->where('comm_comments.id',$comm_commentid)->delete();
	}
	/* communities Comments Reports end */
	
	/* communities start */
	public function communities($language){
	    return $this->db->from('communities')->where('joincomm_lang',$language)->get();
	}
	public function addcommunity($data){
	    $query = $this->db->from('gener')->where('id',$data['gener'])->limit(1)->get()->result();
	    if(isset($query[0]->gener) && !empty($query[0]->gener)){
	        $checkexists = $this->db->from('communities')->where('gener',$query[0]->gener)->where('joincomm_lang',$data['joincomm_lang'])->limit(1)->get();
	        if($checkexists->num_rows() > 0){
	            $this->session->set_flashdata('msg','<div class="alert alert-danger">Community already existed.</div>');
                redirect(base_url().'index.php/telugu_admin/communities');
	        }else{
	            $data['gener'] = $query[0]->gener;
	            return $this->db->insert('communities',$data);
	        }
	    }else{
            $this->session->set_flashdata('msg','<div class="alert alert-danger">Gener not found for the Community to add.</div>');
            redirect(base_url().'index.php/telugu_admin/communities');
	    }
	}
	public function editcommunity($language, $id){
	    return $this->db->from('communities')->where('joincomm_lang',$language)->where('id',$id)->limit(1)->get();
	}
	public function updatecommunity($data, $id){
	    $query = $this->db->from('gener')->where('id',$data['gener'])->limit(1)->get()->result();
	    if(isset($query[0]->gener) && !empty($query[0]->gener)){
	        $checkexists = $this->db->from('communities')->where('id !=',$id)->where('gener',$query[0]->gener)
	            ->where('joincomm_lang',$data['joincomm_lang'])->limit(1)->get();
	        if($checkexists->num_rows() > 0){
	            $this->session->set_flashdata('msg','<div class="alert alert-danger">Community already existed.</div>');
                redirect(base_url().'index.php/telugu_admin/communities');
	        }else{
	            $data['gener'] = $query[0]->gener;
	            return $this->db->where('id',$id)->update('communities',$data);
	        }
	    }else{
            $this->session->set_flashdata('msg','<div class="alert alert-danger">Gener not found for the Community to add.</div>');
            redirect(base_url().'index.php/telugu_admin/communities');
	    }
	}
	public function deletecommunity($id){
	    $query = $this->db->where('id',$id)->from('communities')->get()->result();
	    if(isset($query[0]->comm_image) && !empty($query[0]->comm_image)){
	        unlink('assets/images/'.$query[0]->comm_image);
	    }
	    return $this->db->where('id',$id)->from('communities')->delete();
	}
	/* communities end */
	/* Geners Start */
	// geners get from generlist
	public function editgener($id){
	    return $this->db->from('gener')->where('id', $id)->get();
	}
	public function updategener($id, $gener){
	    return $this->db->where('id', $id)->update('gener', array('gener' => $gener));
	}
	public function addgener($gener){
	    $query = $this->db->from('gener')->where('gener', $gener)->get();
	    if($query->num_rows() > 0){
	        return false;
	    }else{
	        return $this->db->insert('gener', array('gener' => $gener));
	    }
	}
	public function deletegener($id){
	    return $this->db->from('gener')->where('id', $id)->delete();
	}
	/* Geners end */
	
	/* profile monetisation start */
	public function profilemonetize(){
	    return $this->db->from('signup')->where('admin_status','unblock')->where('mstatus !=','not_requested')->get();
	    //->where('monetisation','no')
	}
	public function monitizeuser($userid){
	    $query = $this->db->from('signup')->where('user_id',$userid)->where('mstatus','monitize')->where('monetisation','no')->get();
	    if($query->num_rows() == 1){
	        return $this->db->where('user_id',$userid)->where('mstatus','monitize')->where('monetisation','no')->update('signup',array('monetisation'=>'yes'));
	    }else{
	        return false;
	    }
	}
	public function unmonitizeuser($userid){
	    $query = $this->db->from('signup')->where('user_id',$userid)->where('mstatus','unmonitize')->where('monetisation','yes')->get();
	    if($query->num_rows() == 1){
	        return $this->db->where('user_id',$userid)->where('mstatus','unmonitize')->where('monetisation','yes')
	            ->update('signup',array('monetisation'=>'no', 'mstatus'=>'not_requested'));
	    }else{
	        return false;
	    }
	}
	/* profile monetisation end */
	
	/* stories monetisation end */
	public function storiesmonetize($language){
	    return $this->db->select('stories.*, stories.date, signup.name, signup.lastname, signup.profile_name, 
            (SELECT COUNT(story_views.story_id) FROM story_views WHERE story_views.story_id=stories.sid) as uvcount')
            ->from('stories')->join('signup','stories.user_id = signup.user_id','left')
            ->where('(stories.type = "story" OR stories.type = "life" OR (stories.type = "series" AND stories.sid = stories.story_id))')
            ->where('stories.draft !=','draft')->where('stories.status', 'active')
            ->where('((stories.pay_story = "N" AND stories.smonetisation = "yes") OR 
            (stories.pay_story = "Y" AND stories.smonetisation = "yes") OR (stories.pay_story = "Y" AND stories.smonetisation = "no"))')
            //->where('stories.language',$language)
            ->get();
	}
	public function enablesmonetize($language, $storyid){
	    $query = $this->db->select('sadd1,sadd2,sadd3,sadd4')->where('stories.sid',$storyid)->from('stories')->get()->result();
	    if(isset($query[0]->sadd1) && (!empty($query[0]->sadd1) || !empty($query[0]->sadd2) || !empty($query[0]->sadd3) || !empty($query[0]->sadd4))){
	        return $this->db->where('stories.sid',$storyid)//->where('stories.language',$language)
	            ->update('stories', array('smonetisation'=>'yes'));
	    }else{
	        return false;
	    }
	}
	public function adsstory($language, $data){
	    $query = $this->db->select('sadd1,sadd2,sadd3,sadd4')->where('stories.sid',$data['storyid'])->from('stories')->get()->result();
	    if(isset($query[0]->sadd1) && empty($query[0]->sadd1)){
	        return $this->db->where('stories.sid',$data['storyid'])->update('stories', array('sadd1'=>$data['adscript']));
	    }else if(isset($query[0]->sadd2) && empty($query[0]->sadd2)){
	        return $this->db->where('stories.sid',$data['storyid'])->update('stories', array('sadd2'=>$data['adscript']));
	    }else if(isset($query[0]->sadd2) && empty($query[0]->sadd3)){
	        return $this->db->where('stories.sid',$data['storyid'])->update('stories', array('sadd3'=>$data['adscript']));
	    }else{
	        return $this->db->where('stories.sid',$data['storyid'])->update('stories', array('sadd4'=>$data['adscript']));
	    }
	}
	public function disablesmonetize($language, $storyid){
	    $query = $this->db->select('sadd1,sadd2,sadd3,sadd4')->where('stories.sid',$storyid)->from('stories')->get()->result();
	    if(isset($query[0]->sadd1) && empty($query[0]->sadd1) && empty($query[0]->sadd2) && empty($query[0]->sadd3) && empty($query[0]->sadd4)){
	        return $this->db->where('stories.sid',$storyid)//->where('stories.language',$language)
	            ->update('stories', array('smonetisation'=>'no'));
	    }else{
	        return false;
	    }
	}
	public function removead($language, $data){
	    return $this->db->where('stories.sid',$data['storyid'])->update('stories',array($data['ads'] => ''));
	}
	
	/* stories monetisation end */
	
	/* transactions requests monetisation start */
	public function transreqs($language){
	    return $this->db->from('payments')->join('signup','payments.user_id = signup.user_id','left')
	        ->where('payments.status','requested')->where('signup.admin_status','unblock')
	        ->where('signup.monetisation','yes')->get();
	}
	public function payment($language, $id){
	    $signupupdate = 'UPDATE signup LEFT JOIN payments ON signup.user_id=payments.user_id SET 
	        signup.paid_amount = signup.paid_amount+signup.tobe_payamount, signup.tobe_payamount = 0 WHERE payments.id = '.$id;
	    $this->db->query($signupupdate);
	    return $this->db->where('payments.id',$id)->update('payments', array('status' => 'paid'));
	}
	/* transactions requests monetisation end */
	
	/* Landing page text start */
	public function landingpage($language){
	    return $this->db->from('banner')->where('type','landingpage')->get(); //->where('language',$language)
	}
	public function addlandingpage($data){
	    return $this->db->insert('banner', $data);
	}
	public function editlandingpage($language,$id){
	    return $this->db->from('banner')->where('id',$id)->where('type','landingpage')->limit(1)->get();//->where('language',$language)
	}
	public function updatelandingpage($inputdata, $id){
	    return $this->db->where('id',$id)->where('type','landingpage')->update('banner', $inputdata);
	}
	public function deletelandingpage($id){
	    $query = $this->db->from('banner')->where('id',$id)->where('type','landingpage')->get()->result();
	        if(isset($query[0]->slideimage) && !empty($query[0]->slideimage)){
    	        unlink('assets/images/'.$query[0]->slideimage);
    	    }
    	    if(isset($query[0]->image) && !empty($query[0]->image)){
    	        unlink('assets/images/'.$query[0]->image);
    	    }
	    return $this->db->from('banner')->where('id',$id)->where('type','landingpage')->delete();
	}
	/* Landing page text end */
	
	
	/*  Type write for landing page start */
	public function typewrites($language){
        return $this->db->from('banner')->where('type','typewrite')->get();
	}
	public function addtypewrite($inputdata){
        return $this->db->insert('banner', $inputdata);
	}
	public function edittypewrite($id){
	    return $this->db->from('banner')->where('id',$id)->where('type','typewrite')->limit(1)->get();
	}
	public function updatetypewrite($inputdata, $id){
	    return $this->db->where('id',$id)->where('type','typewrite')->update('banner', $inputdata);
	}
	public function deletetypewrite($id){
	    return $this->db->where('id',$id)->where('type','typewrite')->from('banner')->delete();
	}
	/*  Type write for landing page end*/
	
	
	/*  static pages text start */
	public function staticpages($language){
	    return $this->db->from('staticpages')->where('language',$language)->where('type','staticpage')->get();
	}
	public function addstaticpage($data){
	    return $this->db->insert('staticpages', $data);
	}
	public function editstaticpage($language,$id){
	    return $this->db->from('staticpages')->where('language',$language)->where('type','staticpage')->where('id',$id)->limit(1)->get();
	}
	public function updatestaticpage($data, $id){
	    return $this->db->where('id',$id)->where('type','staticpage')->update('staticpages', $data);
	}
	public function deletestaticpage($language, $id){
	    return $this->db->where('id',$id)->where('language',$language)->from('staticpages')->delete();
	}
	/* static pages text end */
}