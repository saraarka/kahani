<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    if ( ! function_exists('get_comments')) {
        function get_comments($id){
        $ci =& get_instance();
        $comments = $ci->User_model->hcomments($id);
        return $comments;
        }
    }
  
    if ( ! function_exists('get_notifications')) {
        function get_notifications(){
            $ci = &get_instance();
            $notifications = $ci->User_model->notifications();
            return $notifications;
        }
    }
    
    if ( ! function_exists('get_writingsjoins')) {
        function get_writingsjoins($user_id){
            $ci = &get_instance();
            $writingsjoins = $ci->User_model->writingsjoins($user_id);
            return $writingsjoins;
        }
    }
    
    if ( ! function_exists('get_langunamebycode')) {
        function get_langunamebycode($code){
            $ci = &get_instance();
            $langunamebycode = $ci->User_model->langunamebycode($code);
            return $langunamebycode;
        }
    }
    
    if ( ! function_exists('get_storiesreadlater')) {
        function get_storiesreadlater($type){
            $ci = &get_instance();
            $storiesreadlater = $ci->User_model->hstoriesreadlater($type);
            return $storiesreadlater;
        }
    }
    
    if ( ! function_exists('get_favcount')) {
        function get_favcount($storyid){
            $ci = &get_instance();
            $favcount = $ci->User_model->hfavcount($storyid);
            return $favcount;
        }
    }
    
    if ( ! function_exists('get_proreplaycmtcount')) {
        function get_proreplaycmtcount($profileid, $commentid){
            $ci = &get_instance();
            $proreplaycmtcount = $ci->User_model->hproreplaycmtcount($profileid, $commentid);
            return $proreplaycmtcount;
        }
    }
    
    if ( ! function_exists('get_replaycomments')) {
        function get_replaycomments($storyid, $commentid, $fslimit=false){
            $ci = &get_instance();
            if(isset($fslimit) && !empty($fslimit)){
                $replaycomments = $ci->User_model->hreplaycomments($storyid, $commentid, $fslimit);
            }else{
                $replaycomments = $ci->User_model->hreplaycomments($storyid, $commentid);
            }
            return $replaycomments;
        }
    }
    
    if ( ! function_exists('get_episodecount')) {
        function get_episodecount($storyid){
            $ci = &get_instance();
            $episodecount = $ci->User_model->hepisodecount($storyid);
            return $episodecount;
        }
    }
    
    if ( ! function_exists('get_storysubscount')) {
        function get_storysubscount($storyid){
            $ci = &get_instance();
            $storysubscount = $ci->User_model->hstorysubscount($storyid);
            return $storysubscount;
        }
    }
    
    if ( ! function_exists('get_seriesongo_stop')) {
        function get_seriesongo_stop($seriesid){
            $ci = &get_instance();
            $seriesongo_stop = $ci->User_model->hseriesongo_stop($seriesid);
            return $seriesongo_stop;
        }
    }
    
    if ( ! function_exists('get_seriesname')) {
        function get_seriesname($sid){
            $ci = &get_instance();
            $seriesname = $ci->User_model->hseriesname($sid);
            return $seriesname;
        }
    }
    
    if ( ! function_exists('get_commname')) {
        function get_commname($sid){
            $ci = &get_instance();
            $commname = $ci->User_model->hcommname($sid);
            return $commname;
        }
    }
    
    if ( ! function_exists('get_wstoriesviews')) {
        function get_wstoriesviews($user_id){
            $ci = &get_instance();
            $wstoriesviews = $ci->User_model->wstoriesviews($user_id);
            return $wstoriesviews;
        }
    }
    
    if ( ! function_exists('get_subcomments')) {
        function get_subcomments($storyid, $commentid){
        $ci =& get_instance();
        $subcomments = $ci->User_model->hsubcomments($storyid, $commentid);
        return $subcomments;
        }
    }
    
    if ( ! function_exists('get_commlastcomment')) {
        function get_commlastcomment($storyid){
        $ci =& get_instance();
        $commlastcomment = $ci->User_model->commlastcomment($storyid);
        return $commlastcomment;
        }
    }
    
    if ( ! function_exists('get_commlastsubcomment')) {
        function get_commlastsubcomment($storyid, $commentid){
        $ci =& get_instance();
        $commlastsubcomment = $ci->User_model->commlastsubcomment($storyid, $commentid);
        return $commlastsubcomment;
        }
    }
    
    
    /* Feed Story comments */
    if ( ! function_exists('get_feedstorycomment')) {
        function get_feedstorycomment($sid){
            $ci = &get_instance();
            $feedstorycomment = $ci->User_model->comment_get($sid);
            return $feedstorycomment;
        }
    }
    if ( ! function_exists('get_fslastcomment')) {
        function get_fslastcomment($storyid){
        $ci =& get_instance();
        $fslastcomment = $ci->User_model->fslastcomment($storyid);
        return $fslastcomment;
        }
    }
    
    if ( ! function_exists('get_fslastsubcomment')) {
        function get_fslastsubcomment($storyid, $commentid){
        $ci =& get_instance();
        $fslastsubcomment = $ci->User_model->fslastsubcomment($storyid, $commentid);
        return $fslastsubcomment;
        }
    }
    
    if ( ! function_exists('get_ydhmdatetime')) {
        function get_ydhmdatetime($date){
        $ci =& get_instance();
        $ydhmdatetime = $ci->User_model->hydhmdatetime($date);
        return $ydhmdatetime;
        }
    }
    
    /* nano story group suggession get shared communities */
    if ( ! function_exists('get_nanosharecomm')) {
        function get_nanosharecomm($commstoryid){
        $ci =& get_instance();
        $nanosharecomm = $ci->User_model->hnanosharecomm($commstoryid);
        return $nanosharecomm;
        }
    }
    
    /* get communities sub comments count */
    if ( ! function_exists('get_subcmtcount')) {
        function get_subcmtcount($commentid){
            $ci =& get_instance();
            $subcmtcount = $ci->User_model->hsubcmtcount($commentid);
            return $subcmtcount;
        }
    }
    
    /* get communities sub comments count */
    if ( ! function_exists('get_storysubcmtcount')) {
        function get_storysubcmtcount($commentid , $story_id){
            $ci =& get_instance();
            $storysubcmtcount = $ci->User_model->hstorysubcmtcount($commentid, $story_id);
            return $storysubcmtcount;
        }
    }
    /* get communities story comments count */
    if ( ! function_exists('get_storycmtcount')) {
        function get_storycmtcount($story_id){
            $ci =& get_instance();
            $storycmtcount = $ci->User_model->comm_comment_count('', $story_id);
            return $storycmtcount;
        }
    }
    
    /* get language short name */
    if ( ! function_exists('get_langshortname')) {
        function get_langshortname($langname){
            $ci =& get_instance();
            $langshortname = $ci->User_model->langshortname($langname);
            return $langshortname;
        }
    }
    
    /* get language full name */
    if ( ! function_exists('get_langfullname')) {
        function get_langfullname($langcode){
            $ci =& get_instance();
            $langfullname = $ci->User_model->langfullname($langcode);
            return $langfullname;
        }
    }
    
    /* get profile_name name */
    if ( ! function_exists('get_profilename')) {
        function get_profilename($userid){
            $ci =& get_instance();
            $profilename = $ci->User_model->hprofilename($userid);
            return $profilename;
        }
    }
    
    /* Navigation other language data start here */
    if ( ! function_exists('get_headmenus')) {
        function get_headmenus(){
            $ci =& get_instance();
            $header = $ci->User_model->headmenus();
            return $header;
        }
    }
    if ( ! function_exists('get_leftmenus')) {
        function get_leftmenus(){
            $ci =& get_instance();
            $leftmenu = $ci->User_model->leftmenus();
            return $leftmenu;
        }
    }
    
    if ( ! function_exists('get_profilemenus')) {
        function get_profilemenus(){
            $ci =& get_instance();
            $profilemenu = $ci->User_model->profilemenus();
            return $profilemenu;
        }
    }
    /* Navigation other language data end here */
    
    
    
    
  