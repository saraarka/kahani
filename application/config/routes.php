<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'welcome';
$route['404_override'] = 'welcome/error';
//$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['english'] = 'welcome/english';
//$route['english/(:any)'] = 'welcome/english/$1';
$route['seriesall'] = 'welcome/seriesall';
$route['library'] = 'welcome/toberead';
$route['drafts'] = 'welcome/drafts';
$route['genre/(:any)'] = 'welcome/geners/$1';
$route['genre/(:any)/top'] = 'welcome/genertopstories/$1';
$route['genertopstories/(:any)'] = 'welcome/genertopstories/$1';
$route['notifications'] = 'welcome/notifications';
$route['viewallyournetwork'] = 'welcome/viewallyournetwork';
$route['series/latest'] = 'welcome/viewallhome/$1';
$route['stories/latest'] = 'welcome/viewallhome/$1';
$route['lifeevents/latest'] = 'welcome/viewallhome/$1';
$route['shortstories/nano'] = 'welcome/viewallhome/$1';
$route['editnano/(:num)'] = 'welcome/editnano/$1';
$route['shortstories'] = 'welcome/viewallhome/nano';
$route['viewallhome/(:any)'] = 'welcome/viewallhome/$1';
$route['viewallloadmore/(:any)'] = 'welcome/viewallloadmore/$1';
$route['series/top'] = 'welcome/topviewallhome/$1'; // for seriesa all page seriesall/top (or) seriesall/series
$route['stories/top'] = 'welcome/topviewallhome/$1';
$route['lifeevents/top'] = 'welcome/topviewallhome/$1';
//$route['shortstories'] = 'welcome/topviewallhome/nano'; // same as view allhome
$route['topviewallhome/(:any)'] = 'welcome/topviewallhome/$1';
$route['topviewallloadmore/(:any)'] = 'welcome/topviewallloadmore/$1';
$route['series/(:any)/(:any)'] = 'welcome/new_series/$1/$2'; //index.php/welcome/new_series?id=156&story_id=156
$route['admin-series/(:any)/(:any)'] = 'welcome/new_series_admin/$1/$2'; //index.php/welcome/new_series_admin?id=156&story_id=156
$route['episode/(:any)/(:any)'] = 'welcome/addnewepisode/$1/$2'; //index.php/welcome/new_series_admin?id=156&story_id=156
//$route['profile/(:any)'] = 'welcome/profile/$1'; //index.php/welcome/profile?id=8
$route['my_profile/(:any)'] = 'welcome/my_profile/$1'; // edit profile
$route['trans'] = 'welcome/trans'; // transactions
$route['profileviewall/(:any)-([series|story|nano|life]+)'] = 'welcome/profileviewall/$1';
$route['profilereadall/(:any)-([series|story|nano|life]+)'] = 'welcome/profilereadall/$1';
$route['story/(:any)'] = 'welcome/only_story_view/$1'; //index.php/welcome/only_story_view?id=246
$route['admin-story/(:any)'] = 'welcome/admin_story/$1'; //index.php/welcome/admin_story?id=232
$route['admin_story_view/(:any)'] = 'welcome/admin_story_view/$1'; 
$route['search'] = 'welcome/search';
$route['lifeeventtags'] = 'welcome/lifeeventtags';
$route['searchresult'] = 'welcome/searchresult';
$route['searchresultwriter'] = 'welcome/searchresultwriter';
$route['feed'] = 'welcome/feed';
$route['communities'] = 'welcome/communities';
$route['community/(:any)'] = 'welcome/co_view/$1'; //$route['co_view/(:any)'] = 'welcome/co_view/$1';
//$route['community-story/(:any)/(:any)'] = 'welcome/commstoryview/$1/$2';
$route['community-story/(:any)/(:num)'] = 'welcome/commstoryview/$1/$2';
$route['communities_joinform'] = 'welcome/communities_joinform';
//Write
$route['write-nanostory'] = 'welcome/nano_story'; // index.php/welcome/nano_story
$route['nano_insert'] = 'welcome/nano_insert'; // index.php/welcome/nano_insert
$route['nano/(:num)'] = 'welcome/nano_view/$1'; // index.php/welcome/nano_view
$route['write-series'] = 'welcome/series'; // index.php/welcome/series
$route['series_story_uplode'] = 'welcome/series_story_uplode'; // index.php/welcome/series_story_uplode // submit series
$route['series_priview/(:any)'] = 'welcome/series_priview/$1'; //index.php/welcome/series_priview/440
$route['addepisode/(:any)/(:any)'] = 'welcome/addepisode/$1/$2'; //index.php/welcome/addepisode
$route['series_edit/(:any)'] = 'welcome/series_edit/$1'; //index.php/welcome/series_edit/442
$route['story_info/(:any)'] = 'welcome/story_info/$1'; //index.php/welcome/story_info/442
$route['updateseries_info/(:any)'] = 'welcome/updateseries_info/$1';
$route['updatestory_info/(:any)'] = 'welcome/updatestory_info/$1';
$route['updatelife_info/(:any)'] = 'welcome/updatelife_info/$1';
$route['updatestory'] = 'welcome/updatestory'; //index.php/welcome/updatestory/442
$route['nano_update'] = 'welcome/updatenano';
$route['write-story'] = 'welcome/story'; // index.php/welcome/story
$route['story_story_uplode'] = 'welcome/story_story_uplode'; // index.php/welcome/story_story_uplode
$route['series_story/(:any)'] = 'welcome/series_story/$1'; // index.php/welcome/series_story/448 // stories sid
$route['series_series/(:any)'] = 'welcome/series_series/$1'; // index.php/welcome/series_series/449 // series sid
$route['addstory/(:any)'] = 'welcome/addstory/$1'; // index.php/welcome/addstory/448
$route['write-life'] = 'welcome/life'; // index.php/welcome/life
$route['lifetagssearch'] = 'welcome/lifetagssearch';
$route['life_story_uplode'] = 'welcome/life_story_uplode';
$route['writers'] = 'welcome/writers';
$route['lifeall'] = 'welcome/lifeall'; // index.php/Welcome/lifeall
$route['blog'] = 'welcome/blog';
$route['blogloadmore'] = 'welcome/blogloadmore';
$route['blogloadcomments'] = 'welcome/blogloadcomments';
$route['blog/(:any)'] = 'welcome/blogdetail/$1';
$route['forgotpassword'] = 'welcome/forgotpassword';
$route['forgotpwd/(:any)'] = 'welcome/forgotpwd/$1';
$route['newpassword'] = 'welcome/newpassword';
$route['about'] = 'welcome/about';
$route['faq'] = 'welcome/faq';
$route['privacy-policy'] = 'welcome/privacy_policy';
$route['terms-conditions'] = 'welcome/terms';
$route['contact'] = 'welcome/contact';
$route['logout'] = 'welcome/logout';
$route['removesavedimgs'] = 'welcome/removesavedimgs'; //remove story write images from its path for all langs
$route['emailunsubs/(:any)'] = 'welcome/emailunsubs/$1'; //stop notify emails receive all langs. 
$route['telugu'] = 'telugu';
$route['hindi'] = 'hindi';
$route['malayalam'] = 'malayalam';
$route['tamil'] = 'tamil';
$route['bengali'] = 'bengali';
$route['gujarati'] = 'gujarati';
$route['kannada'] = 'kannada';
$route['marathi'] = 'marathi';
$route['russian'] = 'russian';
$route['punjabi'] = 'punjabi';
$route['oriya'] = 'oriya';



// Other languages
//$route['(:any)/home/(:any)'] = '$1/home/$2';
$route['(:any)/storymonitizeradio'] = '$1/storymonitizeradio';
$route['(:any)/seriesall'] = '$1/seriesall';
$route['(:any)/library'] = '$1/toberead';
$route['(:any)/drafts'] = '$1/drafts';
$route['(:any)/genre/(:any)'] = '$1/geners/$2';
$route['(:any)/genre/(:any)/top'] = '$1/genertopstories/$2';
$route['(:any)/notifications'] = '$1/notifications';
$route['(:any)/communitynotis'] = '$1/communitynotis';
$route['(:any)/suggestnotis'] = '$1/suggestnotis';
$route['(:any)/viewallyournetwork'] = '$1/viewallyournetwork';
$route['(:any)/viewallloadyournetwork'] = '$1/viewallloadyournetwork';
$route['(:any)/series/latest'] = '$1/viewallhome/$2';
$route['(:any)/stories/latest'] = '$1/viewallhome/$2';
$route['(:any)/lifeevents/latest'] = '$1/viewallhome/$2';
$route['(:any)/viewallhome/(:any)'] = '$1/viewallhome/$2';
$route['(:any)/shortstories/nano'] = '$1/viewallhome/$2';
$route['(:any)/shortstories'] = '$1/viewallhome/nano';
$route['(:any)/topviewallhome/(:any)'] = '$1/topviewallhome/$2';
$route['(:any)/stories/top'] = '$1/topviewallhome/$2';
$route['(:any)/lifeevents/top'] = '$1/topviewallhome/$2';
$route['(:any)/series/top'] = '$1/topviewallhome/$2';
$route['(:any)/seriesall/(:any)'] = '$1/topviewallhome/$2';
$route['(:any)/topviewallloadmore/(:any)'] = '$1/topviewallloadmore/$2';
$route['(:any)/series/(:any)/(:any)'] = '$1/new_series/$2/$3'; 
$route['(:any)/admin-series/(:any)/(:any)'] = '$1/new_series_admin/$2/$3'; 
$route['(:any)/episode/(:any)/(:any)'] = '$1/addnewepisode/$2/$3'; 
$route['(:any)/my_profile/(:any)'] = '$1/my_profile/$2';
$route['(:any)/upload_profileimg'] = '$1/upload_profileimg';
$route['(:any)/image_crop'] = '$1/image_crop';
$route['(:any)/trans'] = '$1/trans';
$route['(:any)/profileviewall/(:any)-([series|story|nano|life]+)'] = '$1/profileviewall/$2';
$route['(:any)/story/(:any)'] = '$1/only_story_view/$2';
$route['(:any)/admin-story/(:any)'] = '$1/admin_story/$2';
$route['(:any)/admin_story_view/(:any)'] = '$1/admin_story_view/$2'; 
$route['(:any)/search'] = '$1/search';
$route['(:any)/searchresult'] = '$1/searchresult';
$route['(:any)/searchresultwriter'] = '$1/searchresultwriter';
$route['(:any)/searchwriterloadmore'] = '$1/searchwriterloadmore';
$route['(:any)/topwriterloading'] = '$1/topwriterloading';
$route['(:any)/feed'] = '$1/feed';
$route['(:any)/communities'] = '$1/communities';
$route['(:any)/community/(:any)'] = '$1/co_view/$2';
$route['(:any)/community-story/(:any)/(:any)'] = '$1/commstoryview/$2/$3';
$route['(:any)/communities_joinform'] = '$1/communities_joinform';
$route['(:any)/communitymembers/(:any)'] = '$1/communitymembers/$2';
$route['(:any)/memloadcommu/(:any)'] = '$1/memloadcommu/$2';
$route['(:any)/write-nanostory'] = '$1/nano_story';
$route['(:any)/nano_insert'] = '$1/nano_insert';
$route['(:any)/nano/(:num)'] = '$1/nano_view/$2';
$route['(:any)/write-series'] = '$1/series';
$route['(:any)/series_story_uplode'] = '$1/series_story_uplode';
$route['(:any)/series_priview/(:any)'] = '$1/series_priview/$2';
$route['(:any)/addepisode/(:any)/(:any)'] = '$1/addepisode/$2/$3';
$route['(:any)/series_edit/(:any)'] = '$1/series_edit/$2';
$route['(:any)/story_info/(:any)'] = '$1/story_info/$2';
$route['(:any)/updatestory'] = '$1/updatestory';
$route['(:any)/nano_update'] = '$1/updatenano';
$route['(:any)/write-story'] = '$1/story';
$route['(:any)/loadmoredimages'] = '$1/loadmoredimages';
$route['(:any)/searchimage'] = '$1/searchimage';
$route['(:any)/story_story_uplode'] = '$1/story_story_uplode';
$route['(:any)/series_story/(:any)'] = '$1/series_story/$2';
$route['(:any)/series_series/(:any)'] = '$1/series_series/$2';
$route['(:any)/addstory/(:any)'] = '$1/addstory/$2';
$route['(:any)/write-life'] = '$1/life';
$route['(:any)/lifetagssearch'] = '$1/lifetagssearch';
$route['(:any)/lifeeventtags'] = '$1/lifeeventtags';
$route['(:any)/lifeeventtagsloadmore'] = '$1/lifeeventtagsloadmore';
$route['(:any)/life_story_uplode'] = '$1/life_story_uplode';
$route['(:any)/writers'] = '$1/writers';
$route['(:any)/lifeall'] = '$1/lifeall';
$route['(:any)/blog'] = '$1/blog';
$route['(:any)/blogloadmore'] = '$1/blogloadmore';
$route['(:any)/blogsearch'] = '$1/blogsearch';
$route['(:any)/blog/(:any)'] = '$1/blogdetail/$2';
$route['(:any)/blogloadcomments'] = '$1/blogloadcomments/$2';
$route['(:any)/forgotpassword'] = '$1/forgotpassword';
$route['(:any)/forgotpwd/(:any)'] = '$1/forgotpwd/$2';
$route['(:any)/newpassword'] = '$1/newpassword';
$route['(:any)/about'] = '$1/about';
$route['(:any)/faq'] = '$1/faq';
$route['(:any)/privacy-policy'] = '$1/privacy_policy';
$route['(:any)/terms-conditions'] = '$1/terms';
$route['(:any)/contact'] = '$1/contact';
//$route['(:any)/profile/^([a-zA-Z0-9]+)$']  = '$1/profile/$2';



// otherlaguage scripts urls start
$route['(:any)/geners'] = '$1/geners';
$route['(:any)/genre'] = '$1/geners';
$route['(:any)/signin'] = '$1/signin';
$route['(:any)/signup'] = '$1/signup';
$route['(:any)/chooselanguage'] = '$1/chooselanguage';
$route['(:any)/readlater'] = '$1/readlater';
$route['(:any)/get_story_groupdata'] = '$1/get_story_groupdata';
$route['(:any)/share_feed_communities'] = '$1/share_feed_communities';
$route['(:any)/get_story_data'] = '$1/get_story_data';
$route['(:any)/allusers'] = '$1/allusers';
$route['(:any)/friendnote'] = '$1/friendnote';
$route['(:any)/follow'] = '$1/follow';
$route['(:any)/storyloadcomments'] = '$1/storyloadcomments';
$route['(:any)/comment'] = '$1/comment';
$route['(:any)/reportstories'] = '$1/reportstories';
$route['(:any)/rating'] = '$1/rating';
$route['(:any)/editpro_comment/(:any)'] = '$1/editpro_comment/$2';
$route['(:any)/updatecomment'] = '$1/updatecomment';
$route['(:any)/addstoryreplycomment'] = '$1/addstoryreplycomment';
$route['(:any)/pro_commentpost'] = '$1/pro_commentpost';
$route['(:any)/deletepro_comment/(:any)'] = '$1/deletepro_comment/$2';
$route['(:any)/deletelibrary'] = '$1/deletelibrary';
$route['(:any)/seriessubscribe'] = '$1/seriessubscribe';
$route['(:any)/storiesfavorite'] = '$1/storiesfavorite';
$route['(:any)/prefaceautosave'] = '$1/prefaceautosave';
$route['(:any)/addseriesepisode/(:any)'] = '$1/addseriesepisode/$2';
$route['(:any)/seriesaddtodrafts'] = '$1/seriesaddtodrafts';
$route['(:any)/addtodrafts'] = '$1/addtodrafts';
$route['(:any)/deletedraft'] = '$1/deletedraft';
$route['(:any)/ongoingcomplet'] = '$1/ongoingcomplet';
$route['(:any)/saveaddtodrafts/(:any)'] = '$1/saveaddtodrafts/$2';
$route['(:any)/communities_story'] = '$1/communities_story';
$route['(:any)/loadcommunities'] = '$1/loadcommunities';
$route['(:any)/floadcommunities'] = '$1/floadcommunities';
$route['(:any)/jloadcommunities'] = '$1/jloadcommunities';
$route['(:any)/loadcommustories/(:any)'] = '$1/loadcommustories/$2';
$route['(:any)/toploadcommustories/(:any)'] = '$1/toploadcommustories/$2';
$route['(:any)/communities_join'] = '$1/communities_join';
$route['(:any)/communities_comments'] = '$1/communities_comments';
$route['(:any)/communities_commentslast'] = '$1/communities_commentslast';
$route['(:any)/editcomm_post'] = '$1/editcomm_post';
$route['(:any)/updatecomm_post'] = '$1/updatecomm_post';
$route['(:any)/deletecomm_post'] = '$1/deletecomm_post';
$route['(:any)/editcommcomment'] = '$1/editcommcomment';
$route['(:any)/updatecommcomment'] = '$1/updatecommcomment';
$route['(:any)/deletecommcomment'] = '$1/deletecommcomment';
$route['(:any)/commloadsubcomments'] = '$1/commloadsubcomments';
$route['(:any)/testing'] = '$1/testing';
$route['(:any)/reportcomm_post'] = '$1/reportcomm_post';
$route['(:any)/comm_likes'] = '$1/comm_likes';
$route['(:any)/viewallloadmore/(:any)'] = '$1/viewallloadmore/$2';
$route['(:any)/tab2loadnotifications'] = '$1/tab2loadnotifications';
$route['(:any)/tab3loadnotifications'] = '$1/tab3loadnotifications';
$route['(:any)/fersloadmore'] = '$1/fersloadmore';
$route['(:any)/fingloadmore'] = '$1/fingloadmore';
$route['(:any)/profilereading'] = '$1/profilereading';
$route['(:any)/pro_comment'] = '$1/pro_comment';
$route['(:any)/updateprocomment'] = '$1/updateprocomment';
$route['(:any)/deleteprocmtcount'] = '$1/deleteprocmtcount';
$route['(:any)/readingliststatus/(:any)'] = '$1/readingliststatus/$2';
$route['(:any)/unchoosecommu'] = '$1/unchoosecommu';
$route['(:any)/choosecommu'] = '$1/choosecommu';
$route['(:any)/loadmorefeed'] = '$1/loadmorefeed';
$route['(:any)/loadmoreyourfeed'] = '$1/loadmoreyourfeed';
$route['(:any)/loadmorestoryfeed'] = '$1/loadmorestoryfeed';
$route['(:any)/commloadcomments'] = '$1/commloadcomments';
$route['(:any)/profilealloadmore'] = '$1/profilealloadmore';
$route['(:any)/fsloadcomments'] = '$1/fsloadcomments';
$route['(:any)/fsloadsubcomment'] = '$1/fsloadsubcomment';
$route['(:any)/loadnotifications'] = '$1/loadnotifications';
$route['(:any)/searchresultloadmore'] = '$1/searchresultloadmore';
$route['(:any)/unchoosecommu/(:any)'] = '$1/unchoosecommu/$2';
$route['(:any)/community_tpost'] = '$1/community_tpost';
$route['(:any)/community_about'] = '$1/community_about';
$route['(:any)/tab_yourfeed'] = '$1/tab_yourfeed';
$route['(:any)/tab_stories'] = '$1/tab_stories';
$route['(:any)/profilefollowing'] = '$1/profilefollowing';
// otherlaguage scripts urls end

$route['telugu/(:any)'] = 'telugu/profile/$1';
$route['hindi/(:any)'] = 'hindi/profile/$1';
$route['malayalam/(:any)'] = 'malayalam/profile/$1';
$route['tamil/(:any)'] = 'tamil/profile/$1';
$route['bengali/(:any)'] = 'bengali/profile/$1';
$route['gujarati/(:any)'] = 'gujarati/profile/$1';
$route['kannada/(:any)'] = 'kannada/profile/$1';
$route['marathi/(:any)'] = 'marathi/profile/$1';
$route['russian/(:any)'] = 'russian/profile/$1';
$route['punjabi/(:any)'] = 'punjabi/profile/$1';
$route['oriya/(:any)'] = 'oriya/profile/$1';

$route['^([a-zA-Z0-9]+)$']  = 'welcome/profile/$1';

