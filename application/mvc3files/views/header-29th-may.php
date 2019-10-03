<!DOCTYPE html>
<html lang="en">
<head> 
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<?php if(isset($ogtitle) && !empty($ogtitle)){ ?>
	<title><?php if(isset($ogsesslang)){ echo $ogsesslang; } ?> Stories - <?php echo $ogtitle;?></title>
    <meta name="title" content="<?php echo $ogtitle;?>">
    <?php }else{ ?>
    <title>Story Carry - Read & Write stories, life events in 12 languages</title>
    <meta name="title" content="StoryCarry - Write & Read stories, life events in 12 languages for free.">
    <?php } if(isset($ogdescription) && !empty($ogdescription)){ ?>
    <meta name="description" content="<?php echo substr($ogdescription, 0, 175);?>">
    <?php }else{ ?>
    <meta name="description" content="Read & Write stories, life events in the language you wish for free. Hindi, Telugu, Tamil, English, Bengali, Marathi, Gujarati, Malayalam, Kannada, Punjabi, Russian, & ItaliaR">
    <?php } if(isset($ogkeywords) && !empty($ogkeywords)){ ?>
    <meta name="keywords" content="<?php echo $ogkeywords;?> <?php if(isset($ogsesslang)){ echo $ogsesslang; } ?>, <?php if(isset($ogtitle)){ echo $ogtitle; } ?>, <?php if(isset($ogetitle)){ echo $ogetitle; } ?>, <?php if(isset($ogauthor)){ echo $ogauthor; } ?>, Story Carry">
    <?php }else { ?>
    <meta name="keywords" content="Story Carry">
    <?php } if(isset($ogauthor) && !empty($ogauthor)){ ?>
    <meta name="author" content="<?php echo $ogauthor;?>">
    <?php }else {?>
    <meta name="author" content="Story Carry">
    <?php } ?>
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/landing/images/fav.png" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <?php if(isset($ogtitle) && !empty($ogtitle)){ ?>
        <meta property="og:title" content="<?php echo $ogtitle;?>">
    <?php } else{ ?>
        <meta property="og:title" content="Story Carry - Read & Write stories, life events in 12 languages for free">
    <?php } if(isset($ogdescription) && !empty($ogdescription)){ ?>
        <meta property="og:description" content="<?php echo $ogdescription;?><?php if(isset($ognano, $ogauthor) && ($ognano == 'nano')){ echo '<p>Writen by '.$ogauthor.'</p>';} ?>">
    <?php } else{ ?>
        <meta property="og:description" content="Read & Write stories, life events in the language you wish for free. Hindi, Telugu, Tamil, English, Bengali, Marathi, Gujarati, Malayalam, Kannada, Punjabi, Russian, & ItaliaR">
    <?php } if(isset($ogurl) && !empty($ogurl)){ ?>
        <meta property="og:url" content="<?php echo $ogurl;?>">
    <?php } else{ ?>
        <meta property="og:url" content="<?php echo base_url();?>">
    <?php } if(isset($ogimage) && !empty($ogimage)){ ?>
        <meta property="og:image" content="<?php echo base_url().'assets/images/'.$ogimage;?>">
    <?php } else if(isset($ognano) && ($ognano == 'nano')) { ?>
        <meta property="og:image" content="nano">
    <?php } else { ?>
        <meta property="og:image" content="<?php echo base_url().'assets/images/series-stories.jpg'?>">
    <?php } ?>
        <meta property="og:type" content="website">
        <meta property="fb:app_id" content="434373993974186" />
    <!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/font-awesome/css/font-awesome.min.css">
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
	<script src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/header.css"> 
	
	<style>
	    .bg-google{
            padding:0px !important;
        }
        .abcRioButtonLightBlue {
            background-color: #ce0c0c !important;
            color: #fefefe !important;
            height: 40px !important;
        }
        .abcRioButton.abcRioButtonLightBlue{
            width: 100% !important;
            border-radius:8px !important;
        }
        svg.abcRioButtonSvg {
            visibility: hidden;
        }
        .abcRioButton{
            box-shadow: none !important;
        }
        .abcRioButtonIcon {
            visibility: hidden;
            padding: 0px !important;
        }
        .abcRioButtonContents span {
            display: none;
        }
        .abcRioButtonContents:after {
            content: 'Google';
            font-size:14px;
            font-weight:400;
            font-family: Arial, sans-serif;
        }
        .abcRioButtonContents {
            margin-right:22px !important;
            line-height: 40px !important;
        }
        .main-story{
            display:block;
        }
    </style>
	<link rel="manifest" href="/manifest.json" />
    <!--<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
    <script>
        var OneSignal = window.OneSignal || [];
        OneSignal.push(function() {
            OneSignal.init({
                appId: "70b78e87-8f8c-4e21-9d93-15b4a7414195",
            });
        });
    </script> -->
</head>

<body class="main-story">
    <?php $this->load->view('fbg_login.php'); ?>
<header class="navbar" id="navbar">
    <a href="javascript:void(0);" data-toggle="modal" data-target="#nvmenu" style="font-size:18.5px;"  class="icon5"><i class="fa fa-bars" aria-hidden="true"></i></a>
	<!-- Modal -->
    <div class="modal modalvjk left fade" id="nvmenu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialogv" role="document">
            <div class="modal-content" style="border-radius:0!important; border:0!important;">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:4px;"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">StoryCarry</h4>
				</div>
	            <div class="modal-body" style="width:200px;">
                    <ul class="sidebar-menu tree" data-widget="tree">
						<li class="avj3">
							<a href="<?php echo base_url('english');?>">
								<span class="btn btn-flat btn-success" style="background:#fbbc05; border-color:#fbbc05;"><i class="fa fa-home fa-2x"></i></span>
								<span class="sidea"> Home </span>
							</a>
						</li>
						<li class="avj1">
							<a href="<?php echo base_url('seriesall');?>">
								<span class="btn btn-flat btn-danger" style="background:#4285f4; border-color:#4285f4;"><i class="fa fa-indent fa-2x"></i></span>
								<span class="sidea"> Series </span>
							</a>
						</li>
						<?php if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])) { ?>
						<li class="avj2">
							<a href="<?php echo base_url('library');?>">
								<span class="btn btn-flat btn-info" style="background:#34a853; border-color:#34a853;"><i class="fa fa-book fa-2x"></i></span>
								<span class="sidea"> Library </span>
							</a>
						</li>
						<li class="avj5">
                            <a href="<?php echo base_url('drafts');?>">
                                <span class="btn btn-flat btn-primary" style="background:dimgrey; border-color:dimgrey;"><i class="fa fa-file fa-2x"></i></span>
        						<span class="sidea"> Drafts </span>
                            </a>
                        </li>
                        <?php } else{ ?>
                        <li class="avj2">
							<a href="javascript:void(0);" class="notloginmodal">
								<span class="btn btn-flat btn-info" style="background:#34a853; border-color:#34a853;"><i class="fa fa-book fa-2x"></i></span>
								<span class="sidea"> Library </span>
							</a>
						</li>
						<li class="avj5">
                            <a href="javascript:void(0);" class="notloginmodal">
                                <span class="btn btn-flat btn-primary" style="background:dimgrey; border-color:dimgrey;"><i class="fa fa-file fa-2x"></i></span>
        						<span class="sidea"> Drafts </span>
                            </a>
                        </li>
                        <?php } ?>
						<li class="treeview menu-open avj4">
							<a href="#">
								<span class="btn btn-flat btn-warning" style="background:orangered; border-color:orangered;"><i class="fa fa-folder fa-2x"></i></span>
								<span class="sidea"> Geners </span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu cardv" style="display:block;">
                                <?php if(isset($gener) && ($gener->num_rows() > 0)) { foreach($gener->result() as $key) { ?>
                                    <li><a href="<?php echo base_url('geners/'.preg_replace('/\s+/', '-',$key->gener)); ?>">
                                        <?php echo $key->gener;?> </a></li>
                                <?php } } ?>
                                <hr style="margin:5px 0px;">
                            </ul>
						</li>
                	</ul>
                </div>
            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div><!-- modal -->
    <!-- modal 
<script>
    $("#nvmenu").on("show", function () {
  $("body").addClass("modal-dialogv");
}).on("hidden", function () {
  $("body").removeClass("modal-dialogv")
});
</script>-->				
<style>
    .modalvjk {
  padding-top: 0px!important; /* Location of the box */
  left: 0;
  top: 0;
  bottom: 0;
  width: 100%; /* Full width */
  height: -webkit-fill-available; /* Full height */
  overflow: auto; /* Enable scroll if needed */
}
body.modal-open {
    overflow: hidden;
}
.modal-open .modal {
    overflow-x: hidden;
    overflow-y: -webkit-paged-y;
    -webkit-mask-position-y: initial;
}
	@media(max-width:768px){
        .modal-backdrop {
            background-color: none!important;
            position: relative!important;
        }
         .modalvjk {
             height:100%;
         }
    }
    .modal-backdrop {
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 1001;
    background-color: #00000036;
}
    .modal.left .modal-dialogv,
	.modal.right .modal-dialogv {
		position: fixed;
		margin: auto;
		width: 200px;
		height: 100%;
		-webkit-transform: translate3d(0%, 0, 0);
		    -ms-transform: translate3d(0%, 0, 0);
		     -o-transform: translate3d(0%, 0, 0);
		        transform: translate3d(0%, 0, 0);
	}

	.modal.left .modal-content,
	.modal.right .modal-content {
		height: 100%;
		overflow-y: auto;
	}
	
	.modal.left .modal-body,
	.modal.right .modal-body {
		padding: 0px;
	}

/*Left*/
	.modal.left.fade .modal-dialogv{
		left: -320px;
		-webkit-transition: opacity 0.3s linear, left 0.3s ease-out;
		   -moz-transition: opacity 0.3s linear, left 0.3s ease-out;
		     -o-transition: opacity 0.3s linear, left 0.3s ease-out;
		        transition: opacity 0.3s linear, left 0.3s ease-out;
	}
	.modal.left.fade.in .modal-dialogv{
		left: 0;
	}
</style>

    <a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>assets/landing/storylogoland.png" alt="StoryCarry" title="StoryCarry" class="logoimage1"></a>
    <a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>assets/dist/img/logoicon2.png" alt="StoryCarry" title="StoryCarry" class="logoimage2"></a>
	<?php if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])){ 
	    $profilename = get_profilename($this->session->userdata['logged_in']['user_id']); ?>
    <div class="login dropdown profile">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"> 
			<?php if(isset($this->session->userdata['logged_in']['profile_image']) && 
            	!empty($this->session->userdata['logged_in']['profile_image'])) { ?>
            	<img src="<?php echo base_url();?>assets/images/<?php echo $this->session->userdata['logged_in']['profile_image']; ?>" class="img-circlep" alt="User Image">
            <?php } else { ?>
            	<img src="<?php echo base_url();?>assets/images/2.png" class="img-circlep" >
            <?php } ?>
		</a>
		<ul class="dropdown-menu pull-right">
			<li style="border-bottom:1px solid #f4f4f4;"><a href="<?php echo base_url($profilename); ?>" class="dropk"><i class="fa fa-user pr-10"></i> MY PROFILE</a></li>
            <li style="border-bottom:1px solid #f4f4f4;"><a href="<?php echo base_url();?>my_profile/<?php echo $this->session->userdata['logged_in']['user_id'];?>" class="dropk"><i class="fa fa-sliders pr-10"></i> SETTINGS</a></li>
            <li style="border-bottom:1px solid #f4f4f4;"><a href="<?php echo base_url('trans');?>" class="dropk"><i class="fa fa-money pr-10"></i> TRANSACTIONS</a></li>
            <li style="border-bottom:1px solid #f4f4f4;"><a href="<?php echo base_url('drafts');?>" class="dropk"><i class="fa fa-file pr-10"></i> DRAFT</a></li>
            <li style="border-bottom:1px solid #f4f4f4;"><a href="<?php echo base_url('logout');?>" class="dropk" <?php if(isset($this->session->userdata['logged_in']['logintype']) && ($this->session->userdata['logged_in']['logintype'] == 'fb')){ ?> onclick="fbLogout()" id="fbLink" 
				    <?php }else if(isset($this->session->userdata['logged_in']['logintype']) && ($this->session->userdata['logged_in']['logintype'] == 'google')){ ?> onclick="signOut();" <?php } ?>
				    ><i class="fa fa-sign-out pr-10"></i> SIGN OUT</a></li>
		</ul>
	</div>
	<div class="login logini">
		<a href="<?php echo base_url();?>notifications" style="color:#fff"><i class="fa fa-bell-o" aria-hidden="true"></i> <sup>0</sup></a>
	</div>
	<?php } else { ?>
	<div class="login" style="">
		<a href="" style="color:#fff; font-size:26px;" data-toggle="modal" data-target="#loginmodal" id="notloginmodal"><i class="fa fa-user" aria-hidden="true"></i></a>
	</div>
	<?php } ?>
    
    <div class="nav-items">
		<div class="dropdown" style="border-left:none;">
		    <?php $selectedlang = get_langshortname($this->uri->segment(1));
		    if(isset($selectedlang) && ($selectedlang == 'en')){ ?>
		        <a href="javascript:void(0);" class="dropdown-toggle" title="WRITE" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"> 
    		        <i class="fa fa-language" aria-hidden="true"></i> <p>ENGLISH</p>
    		    </a>
		    <?php } else if(isset($languages) && ($languages->num_rows() > 0)){
		        foreach($languages->result() as $language ){ if($language->langname == $this->uri->segment(1)){ ?>
        			<a href="javascript:void(0);" class="dropdown-toggle" title="WRITE" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"> 
        		        <i class="fa fa-language" aria-hidden="true"></i> <p><?php echo $language->language;?></p>
        		    </a>
                <?php } } ?>
		    <?php } else { ?>
		        <a href="javascript:void(0);" class="dropdown-toggle" title="WRITE" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"> 
    		        <i class="fa fa-language" aria-hidden="true"></i> <p>ENGLISH</p>
    		    </a>
		    <?php } ?>
		   <?php if(isset($languages) && ($languages->num_rows() > 0)){ ?>
    			<ul class="dropdown-menu pull-left" style="right:0!important; left:auto;">
    			    <?php foreach($languages->result() as $language ){ ?>
        				<li style="border-bottom:1px solid #f4f4f4;">
        				    <a class="dropk" style="cursor: grab;padding:5px 10px; <?php if(isset($selectedlang) && ($selectedlang == $language->code)){ ?>color:red !important;<?php } ?>" href="<?php echo base_url();?><?php echo $language->langname;?>" title="<?php echo $language->language;?>"><?php echo $language->language;?></a>
        				</li>
                    <?php } ?>
                </ul>
            <?php } ?>
		</div>
		<div class="dropdown">
			<a href="#" class="dropdown-toggle" title="WRITE" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"> 
		        <i class="fa fa-pencil-square-o" aria-hidden="true"></i> <p>WRITE</p>
		    </a>
			<ul class="dropdown-menu pull-left" style="right:0!important; left:auto;">
				<?php if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])){ ?>
					<li style="border-bottom:1px solid #f4f4f4;"><a class="dropk" href="<?php echo base_url('write-series'); ?>" title="Series"><i class="fa fa-indent pr-10"></i> SERIES</a></li>
					<li style="border-bottom:1px solid #f4f4f4;"><a class="dropk" href="<?php echo base_url('write-story'); ?>" title="Story"><i class="fa fa-clipboard pr-10"></i> STORY</a></li>
					<li style="border-bottom:1px solid #f4f4f4;"><a class="dropk" href="<?php echo base_url('write-nanostory'); ?>" title="Nano Story"><i class="fa fa-pie-chart pr-10"></i> NANO STORY</a></li>
					<li style="border-bottom:1px solid #f4f4f4;"><a class="dropk" href="<?php echo base_url('write-life'); ?>" title="Life Events"><i class="fa fa-star pr-10"></i> LIFE EVENTS</a></li>
					<?php } else{ ?>
					<li style="border-bottom:1px solid #f4f4f4;"><a class="dropk notloginmodal" href="#" title="Series"><i class="fa fa-indent pr-10"></i> SERIES</a></li>
					<li style="border-bottom:1px solid #f4f4f4;"><a class="dropk notloginmodal" href="#" title="Story"><i class="fa fa-clipboard pr-10"></i> STORY</a></li>
					<li style="border-bottom:1px solid #f4f4f4;"><a class="dropk notloginmodal" href="#" title="Nano Story"><i class="fa fa-pie-chart pr-10"></i> NANO STORY</a></li>
					<li style="border-bottom:1px solid #f4f4f4;"><a class="dropk notloginmodal" href="#" title="Life Events"><i class="fa fa-star pr-10"></i> LIFE EVENTS</a></li>
               <?php } ?>
            </ul>
		</div>
		
		<div><a href="<?php echo base_url('communities');?>" title="COMMUNITIES" class="dropdown-toggle"><i class="fa fa-users" aria-hidden="true"></i><p>COMMUNITIES</p></a></div>
		<div>
			<?php if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])){ ?>
			<a href="<?php echo base_url('feed'); ?>" title="YOUR FEED">
			<i class="fa fa-rss-square" aria-hidden="true"></i><p>YOUR FEED</p></a>
			<?php } else{ ?>
            	<a href="#" class="dropdown-toggle notloginmodal" title="Your Feed">
            		<i class="fa fa-rss-square"></i><p>YOUR FEED</p>
            	</a>
            <?php } ?>
		</div>
		<div style="">
			<a href="<?php echo base_url('lifeall'); ?>" title="LIFE EVENTS"><i class="fa fa-heartbeat" aria-hidden="true"></i><p>LIFE EVENTS</p></a>
		</div>
		
		<?php if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])) { ?>
		<!-- NOTIFICATIONS start -->
		<div class="dropdown" style="padding-top:13px; padding-left:16px; width:65px; background:none;">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
				<i class="fa fa-bell-o" aria-hidden="true"></i>
				<!--<sup style="background:#fefefe; padding:2px 5px; color:red; border-radius:5px;">2</sup>-->
				<?php $notificationsclist = get_notifications(); ?>
				<sup style="background:#fefefe; padding:2px 5px; color:red; border-radius:5px;">
					<?php if(isset($notificationsclist['notseennotifys'])){ echo $notificationsclist['notseennotifys']->num_rows(); }else{ echo 0; } ?>
				</sup>
			</a>
			
			<ul class="dropdown-menu pull-right" style="width:350px">
				<li>
					<ul class="notifys" style="list-style: none;font-size:12px; color:#000!important; padding-left: 0px;">
						<?php $i = 0; $seenunseennotifycount = 0;
							if(isset($notificationsclist['notseennotifys']) && ($notificationsclist['notseennotifys']->num_rows() > 0)){
							    $seenunseennotifycount = $seenunseennotifycount+$notificationsclist['notseennotifys']->num_rows();
								foreach($notificationsclist['notseennotifys']->result() as $notseennotify){ 
									if(($i < 5) && ($notseennotify->type == 'writerfollow')) { ?>
									<li>
									    <a href="<?php echo base_url().$notseennotify->profile_name;?>" style="padding-top:0px;">
    										<div class="user-block user-blockv" style="border-left:none;">
    										    <?php if(!empty($notseennotify->profile_image)){ ?>
    												<img src="<?php echo base_url();?>assets/images/<?php echo $notseennotify->profile_image;?>" class="user-blockv-img"> 
    											<?php } else{ ?> 
    												<img src="<?php echo base_url();?>assets/images/2.png" class="user-blockv-img"> 
    											<?php } ?>
    											<b class="user-blockv-title"><?php echo $notseennotify->sname;?> </b>
    											<span style="color:#333;">started following you. </span>
    											<br>
    											<span class="user-blockv-span">
    											<?php echo date("F j, Y g:i A", strtotime($notseennotify->created_at));?></span>
    										</div>
										</a>
										<hr class="user-blockv-hr">
									</li>
									<?php $i++; }elseif(($i < 5) && ($notseennotify->type == 'comment')) { ?>
									<li>
										<a href="<?php echo base_url().$notseennotify->redirect_uri;?>" style="padding-top:0px;">
											<div class="user-block user-blockv" style="border-left:none;">
    										    <?php if(!empty($notseennotify->profile_image)){ ?>
    												<img src="<?php echo base_url();?>assets/images/<?php echo $notseennotify->profile_image;?>" class="user-blockv-img"> 
    											<?php } else{ ?> 
    												<img src="<?php echo base_url();?>assets/images/2.png" class="user-blockv-img"> 
    											<?php } ?>
    												<b class="user-blockv-title"><?php echo $notseennotify->sname;?> </b>
    											    <span style="color:#333;">commented on your story </span>
    												<b class="user-blockv-title"><?php echo $notseennotify->stitle;?></b><br>
    											<span class="user-blockv-span">
    											<?php echo date("F j, Y g:i A", strtotime($notseennotify->created_at));?></span>
    										</div>
										</a>
										<hr class="user-blockv-hr">
									</li>
									<?php $i++; }elseif(($i < 5) && ($notseennotify->type == 'replycomment')) { ?>
									<li>
										<a href="<?php echo base_url().$notseennotify->redirect_uri;?>" style="padding-top:0px;">
											<div class="user-block user-blockv" style="border-left:none;">
    										    <?php if(!empty($notseennotify->profile_image)){ ?>
    												<img src="<?php echo base_url();?>assets/images/<?php echo $notseennotify->profile_image;?>" class="user-blockv-img"> 
    											<?php } else{ ?> 
    												<img src="<?php echo base_url();?>assets/images/2.png" class="user-blockv-img"> 
    											<?php } ?>
    												<b class="user-blockv-title"><?php echo $notseennotify->sname;?> </b>
    											    <span style="color:#333;">replied to your comment in</span>
    												<b class="user-blockv-title"><?php echo $notseennotify->stitle;?></b><br>
    											<span class="user-blockv-span">
    											<?php echo date("F j, Y g:i A", strtotime($notseennotify->created_at));?></span>
    										</div>
										</a>
										<hr class="user-blockv-hr">
									</li>
									<?php $i++; }elseif(($i < 5) && ($notseennotify->type == 'rating')) { ?>
									<li>
										<a href="<?php echo base_url().$notseennotify->redirect_uri;?>" style="padding-top:0px;">
											<div class="user-block user-blockv" style="border-left:none;">
    										    <?php if(!empty($notseennotify->profile_image)){ ?>
    												<img src="<?php echo base_url();?>assets/images/<?php echo $notseennotify->profile_image;?>" class="user-blockv-img"> 
    											<?php } else{ ?> 
    												<img src="<?php echo base_url();?>assets/images/2.png" class="user-blockv-img"> 
    											<?php } ?>
    												<b class="user-blockv-title"><?php echo $notseennotify->sname;?> </b>
    											     <span style="color:#333;">rated your story </span>
    												<b class="user-blockv-title"><?php echo $notseennotify->stitle;?></b><br>
    											<span class="user-blockv-span">
    											<?php echo date("F j, Y g:i A", strtotime($notseennotify->created_at));?></span>
    										</div>
										</a>
										<hr class="user-blockv-hr">
									</li>
									<?php $i++; }elseif(($i < 5) && ($notseennotify->type == 'nanolike')) { ?>
									<li>
										<a href="<?php echo base_url().$notseennotify->profile_name;?>" style="padding-top:0px;">
											<div class="user-block user-blockv" style="border-left:none;">
    										    <?php if(!empty($notseennotify->profile_image)){ ?>
    												<img src="<?php echo base_url();?>assets/images/<?php echo $notseennotify->profile_image;?>" class="user-blockv-img"> 
    											<?php } else{ ?> 
    												<img src="<?php echo base_url();?>assets/images/2.png" class="user-blockv-img"> 
    											<?php } ?>
    												<b class="user-blockv-title"><?php echo $notseennotify->sname;?> </b>
    											 <span style="color:#333;">liked your nanostory</span><br>
    											 <span class="user-blockv-span">
    											<?php echo date("F j, Y g:i A", strtotime($notseennotify->created_at));?></span>
    										</div>
										</a>
										<hr class="user-blockv-hr">
									</li>
									<?php $i++; }elseif(($i < 5) && ($notseennotify->type == 'seriessubscribe')) { ?>
									<li>
										<a href="<?php echo base_url().$notseennotify->redirect_uri;?>" style="padding-top:0px;">
											<div class="user-block user-blockv" style="border-left:none;">
    										    <?php if(!empty($notseennotify->profile_image)){ ?>
    												<img src="<?php echo base_url();?>assets/images/<?php echo $notseennotify->profile_image;?>" class="user-blockv-img"> 
    											<?php } else{ ?> 
    												<img src="<?php echo base_url();?>assets/images/2.png" class="user-blockv-img"> 
    											<?php } ?>
    												<b class="user-blockv-title"><?php echo $notseennotify->sname;?> </b>
    											<span style="color:#333;">subscribed to your series</span><br> 
    												<b class="user-blockv-title"><?php echo $notseennotify->stitle;?></b>
    											<span class="user-blockv-span">
    											<?php echo date("F j, Y g:i A", strtotime($notseennotify->created_at));?></span>
    										</div>
										</a>
										<hr class="user-blockv-hr">
									</li>
									<?php $i++; }elseif(($i < 5) && ($notseennotify->type == 'seriesepisode')) { ?>
									<li>
										<a href="<?php echo base_url().$notseennotify->redirect_uri;?>" style="padding-top:0px;">
											<div class="user-block user-blockv" style="border-left:none;">
    										    <?php if(!empty($notseennotify->profile_image)){ ?>
    												<img src="<?php echo base_url();?>assets/images/<?php echo $notseennotify->profile_image;?>" class="user-blockv-img"> 
    											<?php } else{ ?> 
    												<img src="<?php echo base_url();?>assets/images/2.png" class="user-blockv-img"> 
    											<?php } ?>
    											<b style="padding-left: 5px;"></b><span style="color:#333;">New episode </span>
    												<b class="user-blockv-title"><?php echo $notseennotify->stitle;?> </b>
    											<span style="color:#333;">added to </span><?php $seriesuri = '#'; $seriestitle = '';
    												if(isset($notseennotify->title_id) && !empty($notseennotify->title_id)){ 
    													$seriesname = get_seriesname($notseennotify->title_id);
    													if(isset($seriesname[0]->title)){  $seriestitle = $seriesname[0]->title;  }
    													if(isset($seriesname[0]->sid) && !empty($seriesname[0]->sid)){
    													$seriesuri='series/'.preg_replace('/\s+/', '-', $seriesname[0]->title).'-'.$seriesname[0]->sid.'/'.preg_replace('/\s+/', '-', $seriesname[0]->title).'-'.$seriesname[0]->sid;
    													}
    												} ?>
    												<b class="user-blockv-title"><?php echo $seriestitle;?></b><br>
    											<span class="user-blockv-span">
    											<?php echo date("F j, Y g:i A", strtotime($notseennotify->created_at));?></span>
    										</div>
										</a>
										<hr class="user-blockv-hr">
									</li>
									<?php $i++; }elseif(($i < 5) && ($notseennotify->type == 'startseries')) { ?>
									<li>
										<a href="<?php echo base_url().$notseennotify->redirect_uri;?>" style="padding-top:0px;">
											<div class="user-block user-blockv" style="border-left:none;">
    										    <?php if(!empty($notseennotify->profile_image)){ ?>
    												<img src="<?php echo base_url();?>assets/images/<?php echo $notseennotify->profile_image;?>" class="user-blockv-img"> 
    											<?php } else{ ?> 
    												<img src="<?php echo base_url();?>assets/images/2.png" class="user-blockv-img"> 
    											<?php } ?>
    												<b class="user-blockv-title"><?php echo $notseennotify->sname;?> </b>
    											<span style="color:#333;">started a new series </span>
    												<b class="user-blockv-title"><?php echo $notseennotify->stitle;?></b><br>
    											<span class="user-blockv-span">
    											<?php echo date("F j, Y g:i A", strtotime($notseennotify->created_at));?></span>
    										</div>
										</a>
										<hr class="user-blockv-hr">
									</li>
									<?php $i++; }elseif(($i < 5) && ($notseennotify->type == 'newstory')) { ?>
									<li>
										<a href="<?php echo base_url().$notseennotify->redirect_uri;?>" style="padding-top:0px;">
											<div class="user-block user-blockv" style="border-left:none;">
    											<?php if(!empty($notseennotify->profile_image)){ ?>
    												<img src="<?php echo base_url();?>assets/images/<?php echo $notseennotify->profile_image;?>" class="user-blockv-img"> 
    											<?php } else{ ?> 
    												<img src="<?php echo base_url();?>assets/images/2.png" class="user-blockv-img"> 
    											<?php } ?>
    												<b class="user-blockv-title"><?php echo $notseennotify->sname;?> </b>
    											<span style="color:#333;">published a new story </span>
    												<b class="user-blockv-title"><?php echo $notseennotify->stitle;?></b><br>
    											<span class="user-blockv-span">
    											<?php echo date("F j, Y g:i A", strtotime($notseennotify->created_at));?></span>
    										</div>
										</a>
										<hr class="user-blockv-hr">
									</li>
									<?php $i++; }elseif(($i < 5) && ($notseennotify->type == 'newnano')) { ?>
									<li>
										<a href="<?php echo base_url().$notseennotify->profile_name;?>" style="padding-top:0px;">
											<div class="user-block user-blockv" style="border-left:none;">
    										    <?php if(!empty($notseennotify->profile_image)){ ?>
    												<img src="<?php echo base_url();?>assets/images/<?php echo $notseennotify->profile_image;?>" class="user-blockv-img"> 
    											<?php } else{ ?> 
    												<img src="<?php echo base_url();?>assets/images/2.png" class="user-blockv-img"> 
    											<?php } ?>
    												<b class="user-blockv-title"><?php echo $notseennotify->sname;?> </b>
    											<span style="color:#333;">published a new nanostory</span>
    												<b class="user-blockv-title"><?php echo $notseennotify->stitle;?></b><br>
    											<span class="user-blockv-span">
    											<?php echo date("F j, Y g:i A", strtotime($notseennotify->created_at));?></span>
    										</div>
										</a>
										<hr class="user-blockv-hr">
									</li>
									<?php $i++; }elseif(($i < 5) && ($notseennotify->type == 'favorite')) { ?>
									<li>
										<a href="<?php echo base_url().$notseennotify->redirect_uri;?>" style="padding-top:0px;">
											<div class="user-block user-blockv" style="border-left:none;">
    										    <?php if(!empty($notseennotify->profile_image)){ ?>
    												<img src="<?php echo base_url();?>assets/images/<?php echo $notseennotify->profile_image;?>" class="user-blockv-img"> 
    											<?php } else{ ?> 
    												<img src="<?php echo base_url();?>assets/images/2.png" class="user-blockv-img"> 
    											<?php } ?>
    												<b class="user-blockv-title"><?php echo $notseennotify->sname;?> </b>
    											<span style="color:#333;">favorited your story </span>
    												<b class="user-blockv-title"><?php echo $notseennotify->stitle;?></b><br>
    											<span class="user-blockv-span">
    											<?php echo date("F j, Y g:i A", strtotime($notseennotify->created_at));?></span>
    										</div>
										</a>
										<hr class="user-blockv-hr">
									</li>
									<?php $i++; }elseif(($i < 5) && ($notseennotify->type == 'procomment')) { ?>
									<li>
										<a href="<?php echo base_url().$notseennotify->profile_name;?>" style="padding-top:0px;">
											<div class="user-block user-blockv" style="border-left:none;">
    										    <?php if(!empty($notseennotify->profile_image)){ ?>
    												<img src="<?php echo base_url();?>assets/images/<?php echo $notseennotify->profile_image;?>" class="user-blockv-img"> 
    											<?php } else{ ?> 
    												<img src="<?php echo base_url();?>assets/images/2.png" class="user-blockv-img"> 
    											<?php } ?>
    												<b class="user-blockv-title"><?php echo $notseennotify->sname;?> </b>
    											<span style="color:#333;">commented on your profile </span><br>
    											<span class="user-blockv-span">
    											<?php echo date("F j, Y g:i A", strtotime($notseennotify->created_at));?></span>
    										</div>
										</a>
										<hr class="user-blockv-hr">
									</li>
									<?php $i++; }elseif(($i < 5) && ($notseennotify->type == 'proreplycomment')) { ?>
									<li>
										<a href="<?php echo base_url().$notseennotify->profile_name;?>" style="padding-top:0px;">
											<div class="user-block user-blockv" style="border-left:none;">
    										    <?php if(!empty($notseennotify->profile_image)){ ?>
    												<img src="<?php echo base_url();?>assets/images/<?php echo $notseennotify->profile_image;?>" class="user-blockv-img"> 
    											<?php } else{ ?> 
    												<img src="<?php echo base_url();?>assets/images/2.png" class="user-blockv-img"> 
    											<?php } ?>
    												<b class="user-blockv-title"><?php echo $notseennotify->sname;?> </b>
    											<span style="color:#333;">replied on your profile comment </span><br>
    											<span class="user-blockv-span">
    											<?php echo date("F j, Y g:i A", strtotime($notseennotify->created_at));?></span>
    										</div>
										</a>
										<hr class="user-blockv-hr">
									</li>
									<?php $i++; }elseif(($i < 5) && ($notseennotify->type == 'groupsuggestion')) { ?>
									<li>
										<a href="<?php echo base_url().$notseennotify->redirect_uri;?>" style="padding-top:0px;">
											<div class="user-block user-blockv" style="border-left:none;">
    										    <?php if(!empty($notseennotify->profile_image)){ ?>
    												<img src="<?php echo base_url();?>assets/images/<?php echo $notseennotify->profile_image;?>" class="user-blockv-img"> 
    											<?php } else{ ?> 
    												<img src="<?php echo base_url();?>assets/images/2.png" class="user-blockv-img"> 
    											<?php } ?>
    												<b class="user-blockv-title"><?php echo $notseennotify->sname;?> </b>
    											<span style="color:#333;">shared your story </span>
    												<b class="user-blockv-title"><?php echo $notseennotify->stitle;?></b>
    												<span style="color:#333;">to </span><?php $commuri = '#'; $commname = ''; $communityname = get_commname($notseennotify->title_id);
    												if(isset($communityname[0]->id) && !empty($communityname[0]->id)){
    													$commuri = 'co_view/'.$communityname[0]->id;  }
    												if(isset($communityname[0]->gener)){ $commname = $communityname[0]->gener; } ?>
    												<!--<a href="<?php echo base_url().$commuri;?>" style="display: contents;">-->
    													<b class="user-blockv-title"><?php echo $commname;?> </b><br>
    											<span class="user-blockv-span">
    											<?php echo date("F j, Y g:i A", strtotime($notseennotify->created_at));?></span>
    										</div>
										</a>
										<hr class="user-blockv-hr">
									</li>
									<?php $i++; }elseif(($i < 5) && ($notseennotify->type == 'suggestion')) { ?>
									<li>
										<a href="#" data-toggle="modal" data-target="#sugnotifymodal<?php echo $notseennotify->id;?>" style="padding-top:0px;">
											<div class="user-block user-blockv" style="border-left:none;">
    										    <?php if(!empty($notseennotify->profile_image)){ ?>
    												<img src="<?php echo base_url();?>assets/images/<?php echo $notseennotify->profile_image;?>" class="user-blockv-img"> 
    											<?php } else{ ?> 
    												<img src="<?php echo base_url();?>assets/images/2.png" class="user-blockv-img"> 
    											<?php } ?>
    												<b class="user-blockv-title"><?php echo $notseennotify->sname;?> </b>
    											<span style="color:#333;">suggested you a story </span><!--<a href="<?php echo base_url().$notseennotify->redirect_uri;?>" style="display: contents;">-->
    											   <b class="user-blockv-title"><?php echo $notseennotify->stitle;?> </b><br>
    											<span class="user-blockv-span">
    											<?php echo date("F j, Y g:i A", strtotime($notseennotify->created_at));?></span>
    										</div>
										</a>
										<hr class="user-blockv-hr">
									</li>
									<?php $i++; } ?>
									
						<?php } } ?>
							<?php if(isset($notificationsclist['seennotifys']) && ($notificationsclist['seennotifys']->num_rows() > 0)){ 
							    $seenunseennotifycount = $seenunseennotifycount+$notificationsclist['seennotifys']->num_rows();
								foreach($notificationsclist['seennotifys']->result() as $seennotify){ 
									if(($i < 5) && ($seennotify->type == 'writerfollow')) { ?>
									<li>
										<a href="<?php echo base_url().$seennotify->profile_name;?>" style="padding-top:0px;">
											<div class="user-block user-blockv" style="border-left:none;">
    										    <?php if(!empty($seennotify->profile_image)){ ?>
    												<img src="<?php echo base_url();?>assets/images/<?php echo $seennotify->profile_image;?>" class="user-blockv-img"> 
    											<?php } else{ ?> 
    												<img src="<?php echo base_url();?>assets/images/2.png" class="user-blockv-img"> 
    											<?php } ?>
    												<b class="user-blockv-title"><?php echo $seennotify->sname;?> </b>
    											<span style="color:#333;">started following you. </span><br>
    											<span class="user-blockv-span">
    											<?php echo date("F j, Y g:i A", strtotime($seennotify->created_at));?></span>
    										</div>
										</a>
										<hr class="user-blockv-hr">
									</li>
									<?php $i++; }elseif(($i < 5) && ($seennotify->type == 'comment')) { ?>
									<li>
										<a href="<?php echo base_url().$seennotify->redirect_uri;?>" style="padding-top:0px;">
											<div class="user-block user-blockv" style="border-left:none;">
    										    <?php if(!empty($seennotify->profile_image)){ ?>
    												<img src="<?php echo base_url();?>assets/images/<?php echo $seennotify->profile_image;?>" class="user-blockv-img"> 
    											<?php } else{ ?> 
    												<img src="<?php echo base_url();?>assets/images/2.png" class="user-blockv-img"> 
    											<?php } ?>
    												<b class="user-blockv-title"><?php echo $seennotify->sname;?> </b>
    											<span style="color:#333;">commented on your story </span>
    												<b class="user-blockv-title"><?php echo $seennotify->stitle;?></b><br>
    											<span class="user-blockv-span">
    											<?php echo date("F j, Y g:i A", strtotime($seennotify->created_at));?></span>
    										</div>
										</a>
										<hr class="user-blockv-hr">
									</li>
									<?php $i++; }elseif(($i < 5) && ($seennotify->type == 'replycomment')) { ?>
									<li>
										<a href="<?php echo base_url().$seennotify->redirect_uri;?>" style="padding-top:0px;">
											<div class="user-block user-blockv" style="border-left:none;">
    										    <?php if(!empty($seennotify->profile_image)){ ?>
    												<img src="<?php echo base_url();?>assets/images/<?php echo $seennotify->profile_image;?>" class="user-blockv-img"> 
    											<?php } else{ ?> 
    												<img src="<?php echo base_url();?>assets/images/2.png" class="user-blockv-img"> 
    											<?php } ?>
    												<b class="user-blockv-title"><?php echo $seennotify->sname;?> </b>
    											<span style="color:#333;">replied to your comment in</span>
    												<b class="user-blockv-title"><?php echo $seennotify->stitle;?></b><br>
    											<span class="user-blockv-span">
    											<?php echo date("F j, Y g:i A", strtotime($seennotify->created_at));?></span>
    										</div>
										</a>
										<hr class="user-blockv-hr">
									</li>
									<?php $i++; }elseif(($i < 5) && ($seennotify->type == 'rating')) { ?>
									<li>
										<a href="<?php echo base_url().$seennotify->redirect_uri;?>" style="padding-top:0px;">
											<div class="user-block user-blockv" style="border-left:none;">
    											<?php if(!empty($seennotify->profile_image)){ ?>
    												<img src="<?php echo base_url();?>assets/images/<?php echo $seennotify->profile_image;?>" class="user-blockv-img"> 
    											<?php } else{ ?> 
    												<img src="<?php echo base_url();?>assets/images/2.png" class="user-blockv-img"> 
    											<?php } ?>
    												<b class="user-blockv-title"><?php echo $seennotify->sname;?> </b>
    											<span style="color:#333;">rated your story</span>
    												<b class="user-blockv-title"><?php echo $seennotify->stitle;?></b><br>
    											<span class="user-blockv-span">
    											<?php echo date("F j, Y g:i A", strtotime($seennotify->created_at));?></span>
    										</div>
										</a>
										<hr class="user-blockv-hr">
									</li>
									<?php $i++; }elseif(($i < 5) && ($seennotify->type == 'nanolike')) { ?>
									<li>
										<a href="<?php echo base_url().$seennotify->profile_name;?>" style="padding-top:0px;">
											<div class="user-block user-blockv" style="border-left:none;">
    										    <?php if(!empty($seennotify->profile_image)){ ?>
    												<img src="<?php echo base_url();?>assets/images/<?php echo $seennotify->profile_image;?>" class="user-blockv-img"> 
    											<?php } else{ ?> 
    												<img src="<?php echo base_url();?>assets/images/2.png" class="user-blockv-img"> 
    											<?php } ?>
    												<b class="user-blockv-title"><?php echo $seennotify->sname;?> </b>
    											<span style="color:#333;">liked your nanostory</span><br><span class="user-blockv-span">
    											<?php echo date("F j, Y g:i A", strtotime($seennotify->created_at));?></span>
    										</div>
										</a>
										<hr class="user-blockv-hr">
									</li>
									<?php $i++; }elseif(($i < 5) && ($seennotify->type == 'seriessubscribe')) { ?>
									<li>
										<a href="<?php echo base_url().$seennotify->redirect_uri;?>" style="padding-top:0px;">
											<div class="user-block user-blockv" style="border-left:none;">
    										    <?php if(!empty($seennotify->profile_image)){ ?>
    												<img src="<?php echo base_url();?>assets/images/<?php echo $seennotify->profile_image;?>" class="user-blockv-img"> 
    											<?php } else{ ?> 
    												<img src="<?php echo base_url();?>assets/images/2.png" class="user-blockv-img" > 
    											<?php } ?>
    												<b class="user-blockv-title"><?php echo $seennotify->sname;?> </b>
    											<span style="color:#333;">subscribed to your series 
    												<b class="user-blockv-title"><?php echo $seennotify->stitle;?></b></span>
    											<span class="user-blockv-span">
    											<?php echo date("F j, Y g:i A", strtotime($seennotify->created_at));?></span>
    										</div>
										</a>
										<hr class="user-blockv-hr">
									</li>
									<?php $i++; }elseif(($i < 5) && ($seennotify->type == 'seriesepisode')) { ?>
									<li>
										<a href="<?php echo base_url().$seennotify->redirect_uri;?>" style="padding-top:0px;">
											<div class="user-block user-blockv" style="border-left:none;">
    										    <?php if(!empty($seennotify->profile_image)){ ?>
    												<img src="<?php echo base_url();?>assets/images/<?php echo $seennotify->profile_image;?>" class="user-blockv-img"> 
    											<?php } else{ ?> 
    												<img src="<?php echo base_url();?>assets/images/2.png" class="user-blockv-img"> 
    											<?php } ?>
    											<b style="padding-left: 5px;"></b><span style="color:#333;">New episode </span>
    												<b class="user-blockv-title"><?php echo $seennotify->stitle;?> </b>
    											<span style="color:#333;">added to </span><?php $seriesuri = '#'; $seriestitle = '';
    												if(isset($seennotify->title_id) && !empty($seennotify->title_id)){ 
    													$seriesname = get_seriesname($seennotify->title_id);
    													if(isset($seriesname[0]->title)){  $seriestitle = $seriesname[0]->title;  }
    													if(isset($seriesname[0]->sid) && !empty($seriesname[0]->sid)){
    													$seriesuri='series/'.preg_replace('/\s+/', '-', $seriesname[0]->title).'-'.$seriesname[0]->sid.'/'.preg_replace('/\s+/', '-', $seriesname[0]->title).'-'.$seriesname[0]->sid;
    													}
    												} ?>
    											<!--<a href="<?php echo base_url().$seriesuri;?>" style="display: contents;"> -->
    												<b class="user-blockv-title"><?php echo $seriestitle;?></b><br>
    											<span class="user-blockv-span">
    											<?php echo date("F j, Y g:i A", strtotime($seennotify->created_at));?></span>
    										</div>
										</a>
										<hr class="user-blockv-hr">
									</li>
									<?php $i++; }elseif(($i < 5) && ($seennotify->type == 'startseries')) { ?>
									<li>
										<a href="<?php echo base_url().$seennotify->redirect_uri;?>" style="padding-top:0px;">
											<div class="user-block user-blockv" style="border-left:none;">
    										    <?php if(!empty($seennotify->profile_image)){ ?>
    												<img src="<?php echo base_url();?>assets/images/<?php echo $seennotify->profile_image;?>" class="user-blockv-img"> 
    											<?php } else{ ?> 
    												<img src="<?php echo base_url();?>assets/images/2.png" class="user-blockv-img"> 
    											<?php } ?>
    												<b class="user-blockv-title"><?php echo $seennotify->sname;?> </b>
    											<span style="color:#333;">started a new series </span>
    												<b class="user-blockv-title"><?php echo $seennotify->stitle;?></b><br>
    											<span class="user-blockv-span">
    											<?php echo date("F j, Y g:i A", strtotime($seennotify->created_at));?></span>
    										</div>
										</a>
										<hr class="user-blockv-hr">
									</li>
									<?php $i++; }elseif(($i < 5) && ($seennotify->type == 'newstory')) { ?>
									<li>
										<a href="<?php echo base_url().$seennotify->redirect_uri;?>" style="padding-top:0px;">
											<div class="user-block user-blockv" style="border-left:none;">
    										    <?php if(!empty($seennotify->profile_image)){ ?>
    												<img src="<?php echo base_url();?>assets/images/<?php echo $seennotify->profile_image;?>" class="user-blockv-img"> 
    											<?php } else{ ?> 
    												<img src="<?php echo base_url();?>assets/images/2.png" class="user-blockv-img"> 
    											<?php } ?>
    												<b class="user-blockv-title"><?php echo $seennotify->sname;?> </b>
    											    <span style="color:#333;">published a new story </span>
    												<b class="user-blockv-title"><?php echo $seennotify->stitle;?></b><br>
    											<span class="user-blockv-span">
    											<?php echo date("F j, Y g:i A", strtotime($seennotify->created_at));?></span>
    										</div>
    									</a>
										<hr class="user-blockv-hr">
									</li>
									<?php $i++; }elseif(($i < 5) && ($seennotify->type == 'newnano')) { ?>
									<li>
										<a href="<?php echo base_url().$seennotify->redirect_uri;?>" style="padding-top:0px;">
											<div class="user-block user-blockv" style="border-left:none;">
    										    <?php if(!empty($seennotify->profile_image)){ ?>
    												<img src="<?php echo base_url();?>assets/images/<?php echo $seennotify->profile_image;?>" class="user-blockv-img"> 
    											<?php } else{ ?> 
    												<img src="<?php echo base_url();?>assets/images/2.png" class="user-blockv-img"> 
    											<?php } ?>
    												<b class="user-blockv-title"><?php echo $seennotify->sname;?> </b>
    											<span style="color:#333;">published a new nanostory </span>
    												<b class="user-blockv-title"><?php echo $seennotify->stitle;?></b><br>
    											<span class="user-blockv-span">
    											<?php echo date("F j, Y g:i A", strtotime($seennotify->created_at));?></span>
    										</div>
    									</a>
										<hr class="user-blockv-hr">
									</li>
									<?php $i++; }elseif(($i < 5) && ($seennotify->type == 'favorite')) { ?>
									<li>
										<a href="<?php echo base_url().$seennotify->redirect_uri;?>"  style="padding-top:0px;">
											<div class="user-block user-blockv" style="border-left:none;">
    										    <?php if(!empty($seennotify->profile_image)){ ?>
    												<img src="<?php echo base_url();?>assets/images/<?php echo $seennotify->profile_image;?>" class="user-blockv-img"> 
    											<?php } else{ ?> 
    												<img src="<?php echo base_url();?>assets/images/2.png" class="user-blockv-img"> 
    											<?php } ?>
    												<b class="user-blockv-title"><?php echo $seennotify->sname;?> </b>
    											<span style="color:#333;">favorited your story </span>
    												<b class="user-blockv-title"><?php echo $seennotify->stitle;?></b></a>br>
    											<span class="user-blockv-span">
    											<?php echo date("F j, Y g:i A", strtotime($seennotify->created_at));?></span>
    										</div>
    									</a>
										<hr class="user-blockv-hr">
									</li>
									<?php $i++; }elseif(($i < 5) && ($seennotify->type == 'procomment')) { ?>
									<li>
										<a href="<?php echo base_url().$seennotify->profile_name;?>"  style="padding-top:0px;">
											<div class="user-block user-blockv" style="border-left:none;">
    											<?php if(!empty($seennotify->profile_image)){ ?>
    												<img src="<?php echo base_url();?>assets/images/<?php echo $seennotify->profile_image;?>" class="user-blockv-img"> 
    											<?php } else{ ?> 
    												<img src="<?php echo base_url();?>assets/images/2.png" class="user-blockv-img"> 
    											<?php } ?>
    												<b class="user-blockv-title"><?php echo $seennotify->sname;?> </b>
    											<span style="color:#333;">commented on your profile</span> <br>
    											<span class="user-blockv-span">
    											<?php echo date("F j, Y g:i A", strtotime($seennotify->created_at));?></span>
    										</div>
    									</a>
										<hr class="user-blockv-hr">
									</li>
									<?php $i++; }elseif(($i < 5) && ($seennotify->type == 'proreplycomment')) { ?>
									<li>
										<a href="<?php echo base_url().$seennotify->profile_name;?>"  style="padding-top:0px;">
											<div class="user-block user-blockv" style="border-left:none;">
    										    <?php if(!empty($seennotify->profile_image)){ ?>
    												<img src="<?php echo base_url();?>assets/images/<?php echo $seennotify->profile_image;?>" class="user-blockv-img"> 
    											<?php } else{ ?> 
    												<img src="<?php echo base_url();?>assets/images/2.png" class="user-blockv-img"> 
    											<?php } ?>
    												<b class="user-blockv-title"><?php echo $seennotify->sname;?> </b>
    											<span style="color:#333;">replied on your profile comment </span><br>
    											<span class="user-blockv-span">
    											<?php echo date("F j, Y g:i A", strtotime($seennotify->created_at));?></span>
    										</div>
    									</a>
										<hr class="user-blockv-hr">
									</li>
									<?php $i++; }elseif(($i < 5) && ($seennotify->type == 'groupsuggestion')) { ?>
									<li>
										<a href="<?php echo base_url().$seennotify->redirect_uri;?>"   style="padding-top:0px;">
											<div class="user-block user-blockv" style="border-left:none;">
    										    <?php if(!empty($seennotify->profile_image)){ ?>
    												<img src="<?php echo base_url();?>assets/images/<?php echo $seennotify->profile_image;?>" class="user-blockv-img"> 
    											<?php } else{ ?> 
    												<img src="<?php echo base_url();?>assets/images/2.png" class="user-blockv-img"> 
    											<?php } ?>
    												<b class="user-blockv-title"><?php echo $seennotify->sname;?> </b>
    											<span style="color:#333;">shared your story </span>
    												<b class="user-blockv-title"><?php echo $seennotify->stitle;?></b>
    												<span style="color:#333;"> to </span> 
    												<?php $commuri = '#'; $commname = ''; $communityname = get_commname($seennotify->title_id);
    												if(isset($communityname[0]->id) && !empty($communityname[0]->id)){
    													$commuri = 'co_view/'.$communityname[0]->id;  }
    												if(isset($communityname[0]->gener)){ $commname = $communityname[0]->gener; } ?>
    													<b class="user-blockv-title"><?php echo $commname;?> </b><br>
    											<span class="user-blockv-span">
    											<?php echo date("F j, Y g:i A", strtotime($seennotify->created_at));?></span>
    										</div>
    									</a>
										<hr class="user-blockv-hr">
									</li>
									<?php $i++; }elseif(($i < 5) && ($seennotify->type == 'suggestion')) { ?>
									<li>
										<a href="#" data-toggle="modal" data-target="#sugnotifymodal<?php echo $seennotify->id;?>" style="padding-top:0px;">
											<div class="user-block user-blockv" style="border-left:none;">
    										    <?php if(!empty($seennotify->profile_image)){ ?>
    												<img src="<?php echo base_url();?>assets/images/<?php echo $seennotify->profile_image;?>" class="user-blockv-img"> 
    											<?php } else{ ?> 
    												<img src="<?php echo base_url();?>assets/images/2.png" class="user-blockv-img"> 
    											<?php } ?>
    												<b class="user-blockv-title"><?php echo $seennotify->sname;?> </b>
    											<span style="color:#333;">suggested you a story</span>
    											<!--<a href="<?php echo base_url().$seennotify->redirect_uri;?>" style="display: contents;"> -->
    											    <b class="user-blockv-title"><?php echo $seennotify->stitle;?> </b><br>
    											<span class="user-blockv-span">
    											<?php echo date("F j, Y g:i A", strtotime($seennotify->created_at));?></span>
    										</div>
    									</a>
										<hr class="user-blockv-hr">
									</li>
									<?php $i++; } ?>
								
								<?php } } ?>
					</ul>
				</li>
				<li>
				    <?php if($seenunseennotifycount > 0){ ?>
					    <a href="<?php echo base_url();?>notifications" class="dropk" style="text-align:center;">SHOW MORE</a>
					<?php }else{ ?>
					    <a class="dropk" style="text-align:center;">No notifications yet.</a>
					<?php } ?>
				</li>
			</ul>
		</div>
		<!-- NOTIFICATIONS end -->
		
		<div class="dropdown" style="border-left:none; width:50px; padding-top:6.5px; background:none;">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true" style="width: 45px; height:45px; vertical-align: middle; padding-top:0px;"> 
				
				<?php if(isset($this->session->userdata['logged_in']['profile_image']) && 
					!empty($this->session->userdata['logged_in']['profile_image'])) { ?>
					<img src="<?php echo base_url();?>assets/images/<?php echo $this->session->userdata['logged_in']['profile_image']; ?>" style="width:100%; height:100%;" class="img-circle" alt="User Image">
				<?php } else { ?>
					<img src="<?php echo base_url();?>assets/images/2.png" style="width:100%; height:100%;" class="img-circle" >
				<?php } ?>
			</a>
			<ul class="dropdown-menu pull-right" style="padding-bottom:0px;right: 5px; border:none;">
				<li style="border-bottom:1px solid #f4f4f4;border-left:none;"><a href="<?php echo base_url($profilename); ?>" class="dropk"><i class="fa fa-user pr-10"></i> MY PROFILE</a></li>
				<li style="border-bottom:1px solid #f4f4f4;border-left:none;"><a href="<?php echo base_url();?>my_profile/<?php echo $this->session->userdata['logged_in']['user_id'];?>" class="dropk"><i class="fa fa-sliders pr-10"></i> SETTINGS</a></li>
				<li style="border-bottom:1px solid #f4f4f4;border-left:none;"><a href="<?php echo base_url('trans');?>" class="dropk"><i class="fa fa-money pr-10"></i> TRANSACTIONS</a></li>
				<li style="border-bottom:1px solid #f4f4f4;border-left:none;"><a href="<?php echo base_url('drafts');?>" class="dropk"><i class="fa fa-file pr-10"></i> DRAFT</a></li>
				<li style="border-bottom:1px solid #f4f4f4;border-left:none;"><a href="<?php echo base_url('logout');?>" class="dropk" 
				    <?php if(isset($this->session->userdata['logged_in']['logintype']) && ($this->session->userdata['logged_in']['logintype'] == 'fb')){ ?> onclick="fbLogout()" id="fbLink" 
				    <?php }else if(isset($this->session->userdata['logged_in']['logintype']) && ($this->session->userdata['logged_in']['logintype'] == 'google')){ ?> onclick="signOut();" <?php } ?>
				    ><i class="fa fa-sign-out pr-10"></i> SIGN OUT</a></li>
				<div class="vjd" style="border-left:none;">
				    <a href="<?php echo base_url();?>about" class="adiv">About</a>
				    <a href="" class="adiv">I</a>
				    <a href="<?php echo base_url();?>blog" class="adiv">Blog</a>
				    <a href="" class="adiv">I</a>
				    <a href="<?php echo base_url();?>faq" class="adiv">Faq</a>
				</div>
			</ul>
			<style>
			    .nav-items div.vjd{
			        border-bottom:none; background:#efefef;width:100%;padding:5px;
			        text-align:left;border-radius: 0px 0px 5px 5px;
			    }
			    .nav-items div.vjd a.adiv{
			        color:#929090;display:inline-block; font-size:13px;padding-right: 4px; padding-top:0;
			    }
			    .nav-items div.vjd a.adiv:hover{
			        color:#929090;
			    }
			</style>
		</div>
		<?php } else { ?>
		<div style="border-right:1px solid rgba(0,0,0,0.1);"><a href="#" data-toggle="modal" data-target="#loginmodal" id="notloginmodal"><i class="fa fa-user" aria-hidden="true"></i><p>LOGIN</p></a></div>
		<?php } ?>
    </div>
	
    <div class="lang hidden-lan">
        <div class="dropdown">
            <a href="<?php echo base_url();?>search" class="dropdown-toggle" title="language" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true" style="color:#fff;"> 
                <i class="fa fa-language" aria-hidden="true"></i>
            </a>
            <?php $sesslang = get_langshortname($this->uri->segment(1)); if(isset($languages) && ($languages->num_rows() > 0)){ ?>
            <ul class="dropdown-menu pull-left" style="right:0!important; left:auto;">
                <?php foreach($languages->result() as $language ){ ?>
				    <li style="border-bottom:1px solid #f4f4f4;">
				    <a class="dropk" style="cursor: grab; padding:5px 10px; <?php if(isset($sesslang) && ($sesslang == $language->code)){ ?>color:red !important;<?php } ?>" href="<?php echo base_url();?>english/<?php echo $language->code;?>" title="<?php echo $language->language;?>"><?php echo $language->language;?></a></li>
				<?php } ?>
            </ul>
            <?php } ?>
        </div>
    </div>
    <div class="search-div2"><a href="<?php echo base_url();?>search" style="color:#fff;"><i class="fa fa-search" aria-hidden="true"></i></a></div>
    <div class="search-div">
        <form class="form-inline my-2 my-lg-0" method="GET" id="searchpost" action="<?php echo base_url();?>search">
            <input type="text" class="search-box" name="searchtext" value="<?php if(isset($searchtext)){echo $searchtext;} ?>" placeholder="Search for writers, stories, Series and more..." required>
            <button class="search-button" type="submit"><i class="fa fa-search" aria-hidden="true" style="font-size:18px;"></i></button>
        </form>
    </div>
</header>
<div class="nav-items2" id="navbar2">
    <div>
		<a href="<?php echo base_url('lifeall'); ?>" title="LIFE EVENTS"><i class="fa fa-heartbeat" aria-hidden="true"></i><p>LIFE EVENTS</p></a>
	</div>
	<div>
		<a href="<?php echo base_url('communities');?>" title="COMMUNITIES" class="dropdown-toggle"><i class="fa fa-users" aria-hidden="true"></i><p>COMMUNITIES</p></a>
	</div>
	<div>
		<?php if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])){ ?>
		<a href="<?php echo base_url('feed'); ?>" title="YOUR FEED">
		<i class="fa fa-rss-square" aria-hidden="true"></i><p>YOUR FEED</p></a>
		<?php } else{ ?>
        	<a href="#" class="dropdown-toggle notloginmodal" title="Your Feed">
        		<i class="fa fa-rss-square"></i><p>YOUR FEED</p>
        	</a>
        <?php } ?>
	</div>
	<div><a href="" data-toggle="modal" data-target="#writeapp" id="notloginmodal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i><p>WRITE STORY</p></a></div>	
</div>

<?php if(isset($notificationsclist['notseennotifys']) && ($notificationsclist['notseennotifys']->num_rows() > 0)){
    foreach($notificationsclist['notseennotifys']->result() as $notseennotify){ if($notseennotify->type == 'suggestion'){ ?>
    <div id="sugnotifymodal<?php echo $notseennotify->id;?>" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">
                        <a href="<?php echo base_url().$notseennotify->profile_name;?>">
                        <b><?php echo $notseennotify->sname;?> </b></a>suggested you a story 
                        <b><?php echo $notseennotify->stitle;?> </b>
                </div>
                <div class="modal-body">
                    <p><h5> Read the following Story, it consists of some eye opening facts. </h5></p><br>
                    <p><?php echo $notseennotify->description;?></p>
                    <center><a class="btn btn-primary" href="<?php echo base_url().$notseennotify->redirect_uri;?>">Open Link</a></center>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php } } } ?>
<?php if(isset($notificationsclist['seennotifys']) && ($notificationsclist['seennotifys']->num_rows() > 0)){ 
    foreach($notificationsclist['seennotifys']->result() as $seennotify){ if($seennotify->type == 'suggestion'){ ?>
    <div id="sugnotifymodal<?php echo $seennotify->id;?>" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">
                        <a href="<?php echo base_url().$seennotify->profile_name;?>">
                        <b><?php echo $seennotify->sname;?> </b></a>suggested you a story 
                        <b><?php echo $seennotify->stitle;?> </b>
                </div>
                <div class="modal-body">
                    <p><h5> Read the following Story, it consists of some eye opening facts. </h5></p><br>
                    <p><?php echo $seennotify->description;?></p>
                    <center><a class="btn btn-primary" href="<?php echo base_url().$seennotify->redirect_uri;?>">Open Link</a></center>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php } } } ?>

<script src="<?php echo base_url();?>assets/js/header.js"></script>

