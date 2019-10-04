<!DOCTYPE html>
<html>
<head> 
	<meta charset="utf-8">
	<title>Story Carry - Read & Write stories, life events in 12 languages</title>
    <meta name="title" content="StoryCarry - Write & Read stories, life events in 12 languages for free.">
    <meta name="description" content="Read & Write stories, life events in the language you wish for free. Hindi, Telugu, Tamil, English, Bengali, Marathi, Gujarati, Malayalam, Kannada, Punjabi, Russian, & ItaliaR">
    <link rel="shortcut icon" href="logotop.png" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <?php if(isset($ogtitle) && !empty($ogtitle)){ ?>
        <meta property="og:title" content="<?php echo $ogtitle;?>">
    <?php } else{ ?>
        <meta property="og:title" content="Story Carry - Read & Write stories, life events in 12 languages for free">
    <?php } if(isset($ogdescription) && !empty($ogdescription)){ ?>
        <meta property="og:description" content="<?php echo substr($ogdescription,0,200);?>">
    <?php } else{ ?>
        <meta property="og:description" content="Read & Write stories, life events in the language you wish for free. Hindi, Telugu, Tamil, English, Bengali, Marathi, Gujarati, Malayalam, Kannada, Punjabi, Russian, & ItaliaR">
    <?php } if(isset($ogurl) && !empty($ogurl)){ ?>
        <meta property="og:url" content="<?php echo $ogurl;?>">
    <?php } else{ ?>
        <meta property="og:url" content="https://storycarry.com/">
    <?php } if(isset($ogimage) && !empty($ogimage)){ ?>
        <meta property="og:image" content="<?php echo base_url().'assets/images/'.$ogimage;?>">
    <?php } else { ?>
        <meta property="og:image" content="<?php echo base_url().'assets/images/1.jpg'?>">
    <?php } ?>
        <meta property="og:type" content="website">
        <meta property="fb:app_id" content="434373993974186" />
        
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/font-awesome/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/header.css">
	<style>
	    .bg-google{
            padding:0px !important;
        }
        .abcRioButtonLightBlue {
            background-color: #ce0c0c !important;
            color: #fefefe !important;
        }
        .abcRioButton.abcRioButtonLightBlue{
            width:163px !important;
            border-radius:8px !important;
        }
	</style>
</head>

<body>
    <?php $this->load->view('fbg_login.php'); ?>
<header class="navbar" id="navbar">
    <a href="javascript:void(0);" data-toggle="modal" data-target="#nvmenu" style="font-size:18.5px;"  class="icon5"><i class="fa fa-bars" aria-hidden="true"></i></a>
	<!-- Modal -->
    <div class="modal modalvjk left fade" id="nvmenu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><b>Short</b> Story</h4>
				</div>
	            <div class="modal-body" style="width:200px;">
                    <ul class="sidebar-menu tree" data-widget="tree" style="background:#f5f5f5;">
						<li class="avj3">
							<a href="<?php echo base_url('home');?>">
								<span class="btn btn-flat btn-success" style=""><i class="fa fa-home fa-2x"></i></span>
								<span> Home </span>
							</a>
						</li>
						<li class="avj1">
							<a href="<?php echo base_url('seriesall');?>">
								<span class="btn btn-flat btn-danger" style=""><i class="fa fa-indent fa-2x"></i></span>
								<span> Series </span>
							</a>
						</li>
						<li class="avj2">
							<a href="<?php echo base_url('toberead');?>">
								<span class="btn btn-flat btn-info" style=""><i class="fa fa-book fa-2x"></i></span>
								<span> Library </span>
							</a>
						</li>
						<li class="treeview menu-open avj4">
							<a href="#">
								<span class="btn btn-flat btn-warning" style=""><i class="fa fa-folder fa-2x"></i></span>
								<span> Geners </span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu cardv" style="display:block;">
                                <?php if(isset($gener) && ($gener->num_rows() > 0)) { foreach($gener->result() as $key) { ?>
                                    <li><a href="<?php echo base_url('geners?id='.$key->id); ?>">
                                        <?php echo $key->gener;?> </a></li>
                                <?php } } ?>
                                <hr style="margin:5px 0px;">
		                    	<!--<center><span class="cardvmore">
		                    	    <a href="#" style="color:#dd4b39;"> Show More </a></span>
		                        </center>-->
                            </ul>
						</li>
                	</ul>
                </div>
            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div><!-- modal -->
    <!-- modal -->	
			
<style>
    .modalvjk {
  padding-top: 0px!important; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
}
	@media(max-width:768px){
        .modal-backdrop {
            background-color: none!important;
            position: relative!important;
        }
    }
    .modal-backdrop {
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 1040;
    background-color: #00000036;
}
    .modal.left .modal-dialog,
	.modal.right .modal-dialog {
		position: fixed;
		margin: auto;
		width: 220px;
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
	.modal.left.fade .modal-dialog{
		left: -320px;
		-webkit-transition: opacity 0.3s linear, left 0.3s ease-out;
		   -moz-transition: opacity 0.3s linear, left 0.3s ease-out;
		     -o-transition: opacity 0.3s linear, left 0.3s ease-out;
		        transition: opacity 0.3s linear, left 0.3s ease-out;
	}
	
	.modal.left.fade.in .modal-dialog{
		left: 0;
	}
        
</style>
		
    <a href="<?php echo base_url('');?>"><img src="<?php echo base_url();?>assets/dist/img/storylogo.jpg" alt="StoryCarry" title="StoryCarry" class="logoimage1"></a>
    <a href="<?php echo base_url('');?>"><img src="<?php echo base_url();?>assets/dist/img/logoicon2.png" alt="StoryCarry" title="StoryCarry" class="logoimage2"></a>
	<?php if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])){ ?>
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
			<li style="border-bottom:1px solid #f4f4f4;"><a href="<?php echo base_url('profile?id='.$this->session->userdata['logged_in']['user_id']); ?>" class="dropk"><i class="fa fa-user pr-10"></i> MY PROFILE</a></li>
            <li style="border-bottom:1px solid #f4f4f4;"><a href="<?php echo base_url();?>my_profile/<?php echo $this->session->userdata['logged_in']['user_id'];?>" class="dropk"><i class="fa fa-sliders pr-10"></i> SETTINGS</a></li>
            <li style="border-bottom:1px solid #f4f4f4;"><a href="<?php echo base_url('trans');?>" class="dropk"><i class="fa fa-money pr-10"></i> TRANSACTIONS</a></li>
            <li style="border-bottom:1px solid #f4f4f4;"><a href="<?php echo base_url('drafts');?>" class="dropk"><i class="fa fa-file pr-10"></i> DRAFT</a></li>
            <li style="border-bottom:1px solid #f4f4f4;"><a href="<?php echo base_url('index.php/welcome/logout');?>" class="dropk" <?php if(isset($this->session->userdata['logged_in']['logintype']) && ($this->session->userdata['logged_in']['logintype'] == 'fb')){ ?> onclick="fbLogout()" id="fbLink" 
				    <?php }else if(isset($this->session->userdata['logged_in']['logintype']) && ($this->session->userdata['logged_in']['logintype'] == 'google')){ ?> onclick="signOut();" <?php } ?>
				    ><i class="fa fa-sign-out pr-10"></i> SIGN OUT</a></li>
		</ul>
	</div>
	<div class="login logini">
		<a href="" style="color:#fff"><i class="fa fa-bell-o" aria-hidden="true"></i> <sup>0</sup></a>
	</div>
	<?php } else { ?>
	<div class="login" style="">
		<a href="" style="color:#fff; font-size:26px;" data-toggle="modal" data-target="#loginmodal" id="notloginmodal"><i class="fa fa-user" aria-hidden="true"></i></a>
	</div>
	<?php } ?>
    
    <div class="nav-items">
		<div class="dropdown" style="border-left:none;">
			<a href="#" class="dropdown-toggle" title="WRITE" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"> 
		        <i class="fa fa-language" aria-hidden="true"></i> <p>ENGLISH</p>
		    </a>
			<ul class="dropdown-menu pull-left" style="right:0!important; left:auto;">
				<li style="border-bottom:1px solid #f4f4f4;"><a class="dropk notloginmodal" style="padding:5px 10px;" href="#" title="Series">ENGLISH</a></li>
				<li style="border-bottom:1px solid #f4f4f4;"><a class="dropk notloginmodal" style="padding:5px 10px;" href="#" title="Story">TELUGU</a></li>
				<li style="border-bottom:1px solid #f4f4f4;"><a class="dropk notloginmodal" style="padding:5px 10px;" href="#" title="Nano Story">MALAYALAM</a></li>
				<li style="border-bottom:1px solid #f4f4f4;"><a class="dropk notloginmodal" style="padding:5px 10px;" href="#" title="Life Events">KANNADA</a></li>
            </ul>
		</div>
		<div class="dropdown">
			<a href="#" class="dropdown-toggle" title="WRITE" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"> 
		        <i class="fa fa-pencil-square-o" aria-hidden="true"></i> <p>WRITE</p>
		    </a>
			<ul class="dropdown-menu pull-left" style="right:0!important; left:auto;">
				<?php if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])){ ?>
					<li style="border-bottom:1px solid #f4f4f4;"><a class="dropk" href="<?php echo base_url('series'); ?>" title="Series"><i class="fa fa-indent pr-10"></i> SERIES</a></li>
					<li style="border-bottom:1px solid #f4f4f4;"><a class="dropk" href="<?php echo base_url('story'); ?>" title="Story"><i class="fa fa-clipboard pr-10"></i> STORY</a></li>
					<li style="border-bottom:1px solid #f4f4f4;"><a class="dropk" href="<?php echo base_url('nano_story'); ?>" title="Nano Story"><i class="fa fa-pie-chart pr-10"></i> NANO STORY</a></li>
					<li style="border-bottom:1px solid #f4f4f4;"><a class="dropk" href="<?php echo base_url('life'); ?>" title="Life Events"><i class="fa fa-star pr-10"></i> LIFE EVENTS</a></li>
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
						<?php $i = 0;
							if(isset($notificationsclist['notseennotifys']) && ($notificationsclist['notseennotifys']->num_rows() > 0)){
								foreach($notificationsclist['notseennotifys']->result() as $notseennotify){ 
									if(($i < 5) && ($notseennotify->type == 'writerfollow')) { ?>
									<li>
										<div class="user-block user-blockv">
											<?php if(!empty($notseennotify->profile_image)){ ?>
												<img src="<?php echo base_url();?>assets/images/<?php echo $notseennotify->profile_image;?>" class="user-blockv-img"> 
											<?php } else{ ?> 
												<img src="<?php echo base_url();?>assets/images/2.png" class="user-blockv-img"> 
											<?php } ?>
											<a href="<?php echo base_url();?>profile?id=<?php echo $notseennotify->suserid;?>" style="display: contents;">
											<b class="user-blockv-title"><?php echo $notseennotify->sname;?> </b></a>
											started following you. <br>
											<span class="user-blockv-span">
											<?php echo date("F j, Y g:i A", strtotime($notseennotify->created_at));?></span>
										</div>
										<hr class="user-blockv-hr">
									</li>
									<?php $i++; }elseif(($i < 5) && ($notseennotify->type == 'comment')) { ?>
									<li>
										<div class="user-block user-blockv">
											<?php if(!empty($notseennotify->profile_image)){ ?>
												<img src="<?php echo base_url();?>assets/images/<?php echo $notseennotify->profile_image;?>" class="user-blockv-img"> 
											<?php } else{ ?> 
												<img src="<?php echo base_url();?>assets/images/2.png" class="user-blockv-img"> 
											<?php } ?>
											<a href="<?php echo base_url();?>profile?id=<?php echo $notseennotify->suserid;?>" style="display: contents;">
												<b class="user-blockv-title"><?php echo $notseennotify->sname;?> </b></a>
											commented on your story 
											<a href="<?php echo base_url().$notseennotify->redirect_uri;?>" style="display: contents;">
												<b class="user-blockv-title"><?php echo $notseennotify->stitle;?></b></a><br>
											<span class="user-blockv-span">
											<?php echo date("F j, Y g:i A", strtotime($notseennotify->created_at));?></span>
										</div>
										<hr class="user-blockv-hr">
									</li>
									<?php $i++; }elseif(($i < 5) && ($notseennotify->type == 'replycomment')) { ?>
									<li>
										<div class="user-block user-blockv">
											<?php if(!empty($notseennotify->profile_image)){ ?>
												<img src="<?php echo base_url();?>assets/images/<?php echo $notseennotify->profile_image;?>" class="user-blockv-img"> 
											<?php } else{ ?> 
												<img src="<?php echo base_url();?>assets/images/2.png" class="user-blockv-img"> 
											<?php } ?>
											<a href="<?php echo base_url();?>profile?id=<?php echo $notseennotify->suserid;?>" style="display: contents;">
												<b class="user-blockv-title"><?php echo $notseennotify->sname;?> </b></a>
											replied to your comment in
											<a href="<?php echo base_url().$notseennotify->redirect_uri;?>" style="display: contents;">
												<b class="user-blockv-title"><?php echo $notseennotify->stitle;?></b></a><br>
											<span class="user-blockv-span">
											<?php echo date("F j, Y g:i A", strtotime($notseennotify->created_at));?></span>
										</div>
										<hr class="user-blockv-hr">
									</li>
									<?php $i++; }elseif(($i < 5) && ($notseennotify->type == 'rating')) { ?>
									<li>
										<div class="user-block user-blockv">
											<?php if(!empty($notseennotify->profile_image)){ ?>
												<img src="<?php echo base_url();?>assets/images/<?php echo $notseennotify->profile_image;?>" class="user-blockv-img"> 
											<?php } else{ ?> 
												<img src="<?php echo base_url();?>assets/images/2.png" class="user-blockv-img"> 
											<?php } ?>
											<a href="<?php echo base_url();?>profile?id=<?php echo $notseennotify->suserid;?>" style="display: contents;">
												<b class="user-blockv-title"><?php echo $notseennotify->sname;?> </b></a>
											rated your story
											<a href="<?php echo base_url().$notseennotify->redirect_uri;?>" style="display: contents;">
												<b class="user-blockv-title"><?php echo $notseennotify->stitle;?></b></a><br>
											<span class="user-blockv-span">
											<?php echo date("F j, Y g:i A", strtotime($notseennotify->created_at));?></span>
										</div>
										<hr class="user-blockv-hr">
									</li>
									<?php $i++; }elseif(($i < 5) && ($notseennotify->type == 'nanolike')) { ?>
									<li>
										<div class="user-block user-blockv">
											<?php if(!empty($notseennotify->profile_image)){ ?>
												<img src="<?php echo base_url();?>assets/images/<?php echo $notseennotify->profile_image;?>" class="user-blockv-img"> 
											<?php } else{ ?> 
												<img src="<?php echo base_url();?>assets/images/2.png" class="user-blockv-img"> 
											<?php } ?>
											<a href="<?php echo base_url();?>profile?id=<?php echo $notseennotify->suserid;?>" style="display: contents;">
												<b class="user-blockv-title"><?php echo $notseennotify->sname;?> </b></a>
											liked your nanostory<br><span class="user-blockv-span">
											<?php echo date("F j, Y g:i A", strtotime($notseennotify->created_at));?></span>
										</div>
										<hr class="user-blockv-hr">
									</li>
									<?php $i++; }elseif(($i < 5) && ($notseennotify->type == 'seriessubscribe')) { ?>
									<li>
										<div class="user-block user-blockv">
											<?php if(!empty($notseennotify->profile_image)){ ?>
												<img src="<?php echo base_url();?>assets/images/<?php echo $notseennotify->profile_image;?>" class="user-blockv-img"> 
											<?php } else{ ?> 
												<img src="<?php echo base_url();?>assets/images/2.png" class="user-blockv-img"> 
											<?php } ?>
											<a href="<?php echo base_url();?>profile?id=<?php echo $notseennotify->suserid;?>" style="display: contents;">
												<b class="user-blockv-title"><?php echo $notseennotify->sname;?> </b></a>
											subscribed to your series <a href="<?php echo base_url().$notseennotify->redirect_uri;?>" style="padding-top:0px;">
												<b class="user-blockv-title"><?php echo $notseennotify->stitle;?></b></a>
											<span class="user-blockv-span">
											<?php echo date("F j, Y g:i A", strtotime($notseennotify->created_at));?></span>
										</div>
										<hr class="user-blockv-hr">
									</li>
									<?php $i++; }elseif(($i < 5) && ($notseennotify->type == 'seriesepisode')) { ?>
									<li>
										<div class="user-block user-blockv">
											<?php if(!empty($notseennotify->profile_image)){ ?>
												<img src="<?php echo base_url();?>assets/images/<?php echo $notseennotify->profile_image;?>" class="user-blockv-img"> 
											<?php } else{ ?> 
												<img src="<?php echo base_url();?>assets/images/2.png" class="user-blockv-img"> 
											<?php } ?>
											<b style="padding-left: 5px;"></b>New episode 
											<a href="<?php echo base_url().$notseennotify->redirect_uri;?>" style="display: contents;">
												<b class="user-blockv-title"><?php echo $notseennotify->stitle;?> </b></a>
											added to <?php $seriesuri = '#'; $seriestitle = '';
												if(isset($notseennotify->title_id) && !empty($notseennotify->title_id)){ 
													$seriesname = get_seriesname($notseennotify->title_id);
													if(isset($seriesname[0]->title)){  $seriestitle = $seriesname[0]->title;  }
													if(isset($seriesname[0]->sid) && !empty($seriesname[0]->sid)){
													$seriesuri='new_series?id='.$seriesname[0]->sid.'&story_id='.$seriesname[0]->sid;
													}
												} ?>
											<a href="<?php echo base_url().$seriesuri;?>" style="display: contents;">
												<b class="user-blockv-title"><?php echo $seriestitle;?></b></a><br>
											<span class="user-blockv-span">
											<?php echo date("F j, Y g:i A", strtotime($notseennotify->created_at));?></span>
										</div>
										<hr class="user-blockv-hr">
									</li>
									<?php $i++; }elseif(($i < 5) && ($notseennotify->type == 'startseries')) { ?>
									<li>
										<div class="user-block user-blockv">
											<?php if(!empty($notseennotify->profile_image)){ ?>
												<img src="<?php echo base_url();?>assets/images/<?php echo $notseennotify->profile_image;?>" class="user-blockv-img"> 
											<?php } else{ ?> 
												<img src="<?php echo base_url();?>assets/images/2.png" class="user-blockv-img"> 
											<?php } ?>
											<a href="<?php echo base_url();?>profile?id=<?php echo $notseennotify->suserid;?>" style="display: contents;">
												<b class="user-blockv-title"><?php echo $notseennotify->sname;?> </b></a>
											started a new series <a href="<?php echo base_url().$notseennotify->redirect_uri;?>" style="display: contents;">
												<b class="user-blockv-title"><?php echo $notseennotify->stitle;?></b></a><br>
											<span class="user-blockv-span">
											<?php echo date("F j, Y g:i A", strtotime($notseennotify->created_at));?></span>
										</div>
										<hr class="user-blockv-hr">
									</li>
									<?php $i++; }elseif(($i < 5) && ($notseennotify->type == 'newstory')) { ?>
									<li>
										<div class="user-block user-blockv">
											<?php if(!empty($notseennotify->profile_image)){ ?>
												<img src="<?php echo base_url();?>assets/images/<?php echo $notseennotify->profile_image;?>" class="user-blockv-img"> 
											<?php } else{ ?> 
												<img src="<?php echo base_url();?>assets/images/2.png" class="user-blockv-img"> 
											<?php } ?>
											<a href="<?php echo base_url();?>profile?id=<?php echo $notseennotify->suserid;?>" style="display: contents;">
												<b class="user-blockv-title"><?php echo $notseennotify->sname;?> </b></a>
											published a new story <a href="<?php echo base_url().$notseennotify->redirect_uri;?>" style="display: contents;">
												<b class="user-blockv-title"><?php echo $notseennotify->stitle;?></b></a><br>
											<span class="user-blockv-span">
											<?php echo date("F j, Y g:i A", strtotime($notseennotify->created_at));?></span>
										</div>
										<hr class="user-blockv-hr">
									</li>
									<?php $i++; }elseif(($i < 5) && ($notseennotify->type == 'newnano')) { ?>
									<li>
										<div class="user-block user-blockv">
											<?php if(!empty($notseennotify->profile_image)){ ?>
												<img src="<?php echo base_url();?>assets/images/<?php echo $notseennotify->profile_image;?>" class="user-blockv-img"> 
											<?php } else{ ?> 
												<img src="<?php echo base_url();?>assets/images/2.png" class="user-blockv-img"> 
											<?php } ?>
											<a href="<?php echo base_url();?>profile?id=<?php echo $notseennotify->suserid;?>" style="display: contents;">
												<b class="user-blockv-title"><?php echo $notseennotify->sname;?> </b></a>
											published a new nanostory <a href="<?php echo base_url().$notseennotify->redirect_uri;?>" style="display: contents;">
												<b class="user-blockv-title"><?php echo $notseennotify->stitle;?></b></a><br>
											<span class="user-blockv-span">
											<?php echo date("F j, Y g:i A", strtotime($notseennotify->created_at));?></span>
										</div>
										<hr class="user-blockv-hr">
									</li>
									<?php $i++; }elseif(($i < 5) && ($notseennotify->type == 'favorite')) { ?>
									<li>
										<div class="user-block user-blockv">
											<?php if(!empty($notseennotify->profile_image)){ ?>
												<img src="<?php echo base_url();?>assets/images/<?php echo $notseennotify->profile_image;?>" class="user-blockv-img"> 
											<?php } else{ ?> 
												<img src="<?php echo base_url();?>assets/images/2.png" class="user-blockv-img"> 
											<?php } ?>
											<a href="<?php echo base_url();?>profile?id=<?php echo $notseennotify->suserid;?>" style="display: contents;">
												<b class="user-blockv-title"><?php echo $notseennotify->sname;?> </b></a>
											favorited your story <a href="<?php echo base_url().$notseennotify->redirect_uri;?>" style="display: contents;">
												<b class="user-blockv-title"><?php echo $notseennotify->stitle;?></b></a><br>
											<span class="user-blockv-span">
											<?php echo date("F j, Y g:i A", strtotime($notseennotify->created_at));?></span>
										</div>
										<hr class="user-blockv-hr">
									</li>
									<?php $i++; }elseif(($i < 5) && ($notseennotify->type == 'procomment')) { ?>
									<li>
										<div class="user-block user-blockv">
											<?php if(!empty($notseennotify->profile_image)){ ?>
												<img src="<?php echo base_url();?>assets/images/<?php echo $notseennotify->profile_image;?>" class="user-blockv-img"> 
											<?php } else{ ?> 
												<img src="<?php echo base_url();?>assets/images/2.png" class="user-blockv-img"> 
											<?php } ?>
											<a href="<?php echo base_url();?>profile?id=<?php echo $notseennotify->suserid;?>" style="display: contents;">
												<b class="user-blockv-title"><?php echo $notseennotify->sname;?> </b></a>
											commented on your profile <br>
											<span class="user-blockv-span">
											<?php echo date("F j, Y g:i A", strtotime($notseennotify->created_at));?></span>
										</div>
										<hr class="user-blockv-hr">
									</li>
									<?php $i++; }elseif(($i < 5) && ($notseennotify->type == 'proreplycomment')) { ?>
									<li>
										<div class="user-block user-blockv">
											<?php if(!empty($notseennotify->profile_image)){ ?>
												<img src="<?php echo base_url();?>assets/images/<?php echo $notseennotify->profile_image;?>" class="user-blockv-img"> 
											<?php } else{ ?> 
												<img src="<?php echo base_url();?>assets/images/2.png" class="user-blockv-img"> 
											<?php } ?>
											<a href="<?php echo base_url();?>profile?id=<?php echo $notseennotify->suserid;?>" style="display: contents;">
												<b class="user-blockv-title"><?php echo $notseennotify->sname;?> </b></a>
											replied on your profile comment <br>
											<span class="user-blockv-span">
											<?php echo date("F j, Y g:i A", strtotime($notseennotify->created_at));?></span>
										</div>
										<hr class="user-blockv-hr">
									</li>
									<?php $i++; }elseif(($i < 5) && ($notseennotify->type == 'groupsuggestion')) { ?>
									<li>
										<div class="user-block user-blockv">
											<?php if(!empty($notseennotify->profile_image)){ ?>
												<img src="<?php echo base_url();?>assets/images/<?php echo $notseennotify->profile_image;?>" class="user-blockv-img"> 
											<?php } else{ ?> 
												<img src="<?php echo base_url();?>assets/images/2.png" class="user-blockv-img"> 
											<?php } ?>
											<a href="<?php echo base_url();?>profile?id=<?php echo $notseennotify->suserid;?>" style="display: contents;">
												<b class="user-blockv-title"><?php echo $notseennotify->sname;?> </b></a>
											shared your story <a href="<?php echo base_url().$notseennotify->redirect_uri;?>">
												<b class="user-blockv-title"><?php echo $notseennotify->stitle;?></b></a>
												to <?php $commuri = '#'; $commname = ''; $communityname = get_commname($notseennotify->title_id);
												if(isset($communityname[0]->id) && !empty($communityname[0]->id)){
													$commuri = 'co_view/'.$communityname[0]->id;  }
												if(isset($communityname[0]->gener)){ $commname = $communityname[0]->gener; } ?>
												<a href="<?php echo base_url().$commuri;?>" style="display: contents;">
													<b class="user-blockv-title"><?php echo $commname;?> </b></a><br>
											<span class="user-blockv-span">
											<?php echo date("F j, Y g:i A", strtotime($notseennotify->created_at));?></span>
										</div>
										<hr class="user-blockv-hr">
									</li>
									<?php $i++; }elseif(($i < 5) && ($notseennotify->type == 'suggestion')) { ?>
									<li>
										<div class="user-block user-blockv">
											<?php if(!empty($notseennotify->profile_image)){ ?>
												<img src="<?php echo base_url();?>assets/images/<?php echo $notseennotify->profile_image;?>" class="user-blockv-img"> 
											<?php } else{ ?> 
												<img src="<?php echo base_url();?>assets/images/2.png" class="user-blockv-img"> 
											<?php } ?>
											<a href="<?php echo base_url();?>profile?id=<?php echo $notseennotify->suserid;?>" style="display: contents;">
												<b class="user-blockv-title"><?php echo $notseennotify->sname;?> </b></a>
											suggested you a story <!--<a href="<?php echo base_url().$notseennotify->redirect_uri;?>" style="display: contents;">-->
											    <a href="#" data-toggle="modal" data-target="#sugnotifymodal<?php echo $notseennotify->id;?>" style="display: contents;">
												<b class="user-blockv-title"><?php echo $notseennotify->stitle;?> </b></a><br>
											<span class="user-blockv-span">
											<?php echo date("F j, Y g:i A", strtotime($notseennotify->created_at));?></span>
										</div>
										<hr class="user-blockv-hr">
									</li>
									<?php $i++; } ?>
									
						<?php } } ?>
							<?php if(isset($notificationsclist['seennotifys']) && ($notificationsclist['seennotifys']->num_rows() > 0)){ 
								foreach($notificationsclist['seennotifys']->result() as $seennotify){ 
									if(($i < 5) && ($seennotify->type == 'writerfollow')) { ?>
									<li>
										<div class="user-block user-blockv">
											<?php if(!empty($seennotify->profile_image)){ ?>
												<img src="<?php echo base_url();?>assets/images/<?php echo $seennotify->profile_image;?>" class="user-blockv-img"> 
											<?php } else{ ?> 
												<img src="<?php echo base_url();?>assets/images/2.png" class="user-blockv-img"> 
											<?php } ?>
											<a href="<?php echo base_url();?>profile?id=<?php echo $seennotify->suserid;?>" style="display: contents;">
												<b class="user-blockv-title"><?php echo $seennotify->sname;?> </b></a>
											started following you. <br>
											<span class="user-blockv-span">
											<?php echo date("F j, Y g:i A", strtotime($seennotify->created_at));?></span>
										</div>
										<hr class="user-blockv-hr">
									</li>
									<?php $i++; }elseif(($i < 5) && ($seennotify->type == 'comment')) { ?>
									<li>
										<div class="user-block user-blockv">
											<?php if(!empty($seennotify->profile_image)){ ?>
												<img src="<?php echo base_url();?>assets/images/<?php echo $seennotify->profile_image;?>" class="user-blockv-img"> 
											<?php } else{ ?> 
												<img src="<?php echo base_url();?>assets/images/2.png" class="user-blockv-img"> 
											<?php } ?>
											<a href="<?php echo base_url();?>profile?id=<?php echo $seennotify->suserid;?>" style="display: contents;">
												<b class="user-blockv-title"><?php echo $seennotify->sname;?> </b></a>
											commented on your story 
											<a href="<?php echo base_url().$seennotify->redirect_uri;?>" style="display: contents;">
												<b class="user-blockv-title"><?php echo $seennotify->stitle;?></b></a><br>
											<span class="user-blockv-span">
											<?php echo date("F j, Y g:i A", strtotime($seennotify->created_at));?></span>
										</div>
										<hr class="user-blockv-hr">
									</li>
									<?php $i++; }elseif(($i < 5) && ($seennotify->type == 'replycomment')) { ?>
									<li>
										<div class="user-block user-blockv">
											<?php if(!empty($seennotify->profile_image)){ ?>
												<img src="<?php echo base_url();?>assets/images/<?php echo $seennotify->profile_image;?>" class="user-blockv-img"> 
											<?php } else{ ?> 
												<img src="<?php echo base_url();?>assets/images/2.png" class="user-blockv-img"> 
											<?php } ?>
											<a href="<?php echo base_url();?>profile?id=<?php echo $seennotify->suserid;?>" style="display: contents;">
												<b class="user-blockv-title"><?php echo $seennotify->sname;?> </b></a>
											replied to your comment in
											<a href="<?php echo base_url().$seennotify->redirect_uri;?>" style="display: contents;">
												<b class="user-blockv-title"><?php echo $seennotify->stitle;?></b></a><br>
											<span class="user-blockv-span">
											<?php echo date("F j, Y g:i A", strtotime($seennotify->created_at));?></span>
										</div>
										<hr class="user-blockv-hr">
									</li>
									<?php $i++; }elseif(($i < 5) && ($seennotify->type == 'rating')) { ?>
									<li>
										<div class="user-block user-blockv">
											<?php if(!empty($seennotify->profile_image)){ ?>
												<img src="<?php echo base_url();?>assets/images/<?php echo $seennotify->profile_image;?>" class="user-blockv-img"> 
											<?php } else{ ?> 
												<img src="<?php echo base_url();?>assets/images/2.png" class="user-blockv-img"> 
											<?php } ?>
											<a href="<?php echo base_url();?>profile?id=<?php echo $seennotify->suserid;?>" style="display: contents;">
												<b class="user-blockv-title"><?php echo $seennotify->sname;?> </b></a>
											rated your story
											<a href="<?php echo base_url().$seennotify->redirect_uri;?>" style="display: contents;">
												<b class="user-blockv-title"><?php echo $seennotify->stitle;?></b></a><br>
											<span class="user-blockv-span">
											<?php echo date("F j, Y g:i A", strtotime($seennotify->created_at));?></span>
										</div>
										<hr class="user-blockv-hr">
									</li>
									<?php $i++; }elseif(($i < 5) && ($seennotify->type == 'nanolike')) { ?>
									<li>
										<div class="user-block user-blockv">
											<?php if(!empty($seennotify->profile_image)){ ?>
												<img src="<?php echo base_url();?>assets/images/<?php echo $seennotify->profile_image;?>" class="user-blockv-img"> 
											<?php } else{ ?> 
												<img src="<?php echo base_url();?>assets/images/2.png" class="user-blockv-img"> 
											<?php } ?>
											<a href="<?php echo base_url();?>profile?id=<?php echo $seennotify->suserid;?>" style="display: contents;">
												<b class="user-blockv-title"><?php echo $seennotify->sname;?> </b></a>
											liked your nanostory<br><span class="user-blockv-span">
											<?php echo date("F j, Y g:i A", strtotime($seennotify->created_at));?></span>
										</div>
										<hr class="user-blockv-hr">
									</li>
									<?php $i++; }elseif(($i < 5) && ($seennotify->type == 'seriessubscribe')) { ?>
									<li>
										<div class="user-block user-blockv">
											<?php if(!empty($seennotify->profile_image)){ ?>
												<img src="<?php echo base_url();?>assets/images/<?php echo $seennotify->profile_image;?>" class="user-blockv-img"> 
											<?php } else{ ?> 
												<img src="<?php echo base_url();?>assets/images/2.png" class="user-blockv-img" style="display: contents;"> 
											<?php } ?>
											<a href="<?php echo base_url();?>profile?id=<?php echo $seennotify->suserid;?>" style="display: contents;">
												<b class="user-blockv-title"><?php echo $seennotify->sname;?> </b>
											</a>
											subscribed to your series <a href="<?php echo base_url().$seennotify->redirect_uri;?>" style="padding-top:0px;">
												<b class="user-blockv-title"><?php echo $seennotify->stitle;?></b></a>
											<span class="user-blockv-span">
											<?php echo date("F j, Y g:i A", strtotime($seennotify->created_at));?></span>
										</div>
										<hr class="user-blockv-hr">
									</li>
									<?php $i++; }elseif(($i < 5) && ($seennotify->type == 'seriesepisode')) { ?>
									<li>
										<div class="user-block user-blockv">
											<?php if(!empty($seennotify->profile_image)){ ?>
												<img src="<?php echo base_url();?>assets/images/<?php echo $seennotify->profile_image;?>" class="user-blockv-img"> 
											<?php } else{ ?> 
												<img src="<?php echo base_url();?>assets/images/2.png" class="user-blockv-img"> 
											<?php } ?>
											<b style="padding-left: 5px;"></b>New episode 
											<a href="<?php echo base_url().$seennotify->redirect_uri;?>" style="display: contents;">
												<b class="user-blockv-title"><?php echo $seennotify->stitle;?> </b></a>
											added to <?php $seriesuri = '#'; $seriestitle = '';
												if(isset($seennotify->title_id) && !empty($seennotify->title_id)){ 
													$seriesname = get_seriesname($seennotify->title_id);
													if(isset($seriesname[0]->title)){  $seriestitle = $seriesname[0]->title;  }
													if(isset($seriesname[0]->sid) && !empty($seriesname[0]->sid)){
													$seriesuri='new_series?id='.$seriesname[0]->sid.'&story_id='.$seriesname[0]->sid;
													}
												} ?>
											<a href="<?php echo base_url().$seriesuri;?>" style="display: contents;">
												<b class="user-blockv-title"><?php echo $seriestitle;?></b></a><br>
											<span class="user-blockv-span">
											<?php echo date("F j, Y g:i A", strtotime($seennotify->created_at));?></span>
										</div>
										<hr class="user-blockv-hr">
									</li>
									<?php $i++; }elseif(($i < 5) && ($seennotify->type == 'startseries')) { ?>
									<li>
										<div class="user-block user-blockv">
											<?php if(!empty($seennotify->profile_image)){ ?>
												<img src="<?php echo base_url();?>assets/images/<?php echo $seennotify->profile_image;?>" class="user-blockv-img"> 
											<?php } else{ ?> 
												<img src="<?php echo base_url();?>assets/images/2.png" class="user-blockv-img"> 
											<?php } ?>
											<a href="<?php echo base_url();?>profile?id=<?php echo $seennotify->suserid;?>" style="display: contents;">
												<b class="user-blockv-title"><?php echo $seennotify->sname;?> </b></a>
											started a new series <a href="<?php echo base_url().$seennotify->redirect_uri;?>" style="display: contents;">
												<b class="user-blockv-title"><?php echo $seennotify->stitle;?></b></a><br>
											<span class="user-blockv-span">
											<?php echo date("F j, Y g:i A", strtotime($seennotify->created_at));?></span>
										</div>
										<hr class="user-blockv-hr">
									</li>
									<?php $i++; }elseif(($i < 5) && ($seennotify->type == 'newstory')) { ?>
									<li>
										<div class="user-block user-blockv">
											<?php if(!empty($seennotify->profile_image)){ ?>
												<img src="<?php echo base_url();?>assets/images/<?php echo $seennotify->profile_image;?>" class="user-blockv-img"> 
											<?php } else{ ?> 
												<img src="<?php echo base_url();?>assets/images/2.png" class="user-blockv-img"> 
											<?php } ?>
											<a href="<?php echo base_url();?>profile?id=<?php echo $seennotify->suserid;?>" style="display: contents;">
												<b class="user-blockv-title"><?php echo $seennotify->sname;?> </b></a>
											published a new story <a href="<?php echo base_url().$seennotify->redirect_uri;?>" style="display: contents;">
												<b class="user-blockv-title"><?php echo $seennotify->stitle;?></b></a><br>
											<span class="user-blockv-span">
											<?php echo date("F j, Y g:i A", strtotime($seennotify->created_at));?></span>
										</div>
										<hr class="user-blockv-hr">
									</li>
									<?php $i++; }elseif(($i < 5) && ($seennotify->type == 'newnano')) { ?>
									<li>
										<div class="user-block user-blockv">
											<?php if(!empty($seennotify->profile_image)){ ?>
												<img src="<?php echo base_url();?>assets/images/<?php echo $seennotify->profile_image;?>" class="user-blockv-img"> 
											<?php } else{ ?> 
												<img src="<?php echo base_url();?>assets/images/2.png" class="user-blockv-img"> 
											<?php } ?>
											<a href="<?php echo base_url();?>profile?id=<?php echo $seennotify->suserid;?>" style="display: contents;">
												<b class="user-blockv-title"><?php echo $seennotify->sname;?> </b>
											</a>
											published a new nanostory <a href="<?php echo base_url().$seennotify->redirect_uri;?>" style="display: contents;">
												<b class="user-blockv-title"><?php echo $seennotify->stitle;?></b></a><br>
											<span class="user-blockv-span">
											<?php echo date("F j, Y g:i A", strtotime($seennotify->created_at));?></span>
										</div>
										<hr class="user-blockv-hr">
									</li>
									<?php $i++; }elseif(($i < 5) && ($seennotify->type == 'favorite')) { ?>
									<li>
										<div class="user-block user-blockv">
											<?php if(!empty($seennotify->profile_image)){ ?>
												<img src="<?php echo base_url();?>assets/images/<?php echo $seennotify->profile_image;?>" class="user-blockv-img"> 
											<?php } else{ ?> 
												<img src="<?php echo base_url();?>assets/images/2.png" class="user-blockv-img"> 
											<?php } ?>
											<a href="<?php echo base_url();?>profile?id=<?php echo $seennotify->suserid;?>" style="display: contents;">
												<b class="user-blockv-title"><?php echo $seennotify->sname;?> </b></a>
											favorited your story <a href="<?php echo base_url().$seennotify->redirect_uri;?>" style="display: contents;">
												<b class="user-blockv-title"><?php echo $seennotify->stitle;?></b></a><br>
											<span class="user-blockv-span">
											<?php echo date("F j, Y g:i A", strtotime($seennotify->created_at));?></span>
										</div>
										<hr class="user-blockv-hr">
									</li>
									<?php $i++; }elseif(($i < 5) && ($seennotify->type == 'procomment')) { ?>
									<li>
										<div class="user-block user-blockv">
											<?php if(!empty($seennotify->profile_image)){ ?>
												<img src="<?php echo base_url();?>assets/images/<?php echo $seennotify->profile_image;?>" class="user-blockv-img"> 
											<?php } else{ ?> 
												<img src="<?php echo base_url();?>assets/images/2.png" class="user-blockv-img"> 
											<?php } ?>
											<a href="<?php echo base_url();?>profile?id=<?php echo $seennotify->suserid;?>" style="display: contents;">
												<b class="user-blockv-title"><?php echo $seennotify->sname;?> </b></a>
											commented on your profile <br>
											<span class="user-blockv-span">
											<?php echo date("F j, Y g:i A", strtotime($seennotify->created_at));?></span>
										</div>
										<hr class="user-blockv-hr">
									</li>
									<?php $i++; }elseif(($i < 5) && ($seennotify->type == 'proreplycomment')) { ?>
									<li>
										<div class="user-block user-blockv">
											<?php if(!empty($seennotify->profile_image)){ ?>
												<img src="<?php echo base_url();?>assets/images/<?php echo $seennotify->profile_image;?>" class="user-blockv-img"> 
											<?php } else{ ?> 
												<img src="<?php echo base_url();?>assets/images/2.png" class="user-blockv-img"> 
											<?php } ?>
											<a href="<?php echo base_url();?>profile?id=<?php echo $seennotify->suserid;?>" style="display: contents;">
												<b class="user-blockv-title"><?php echo $seennotify->sname;?> </b></a>
											replied on your profile comment <br>
											<span class="user-blockv-span">
											<?php echo date("F j, Y g:i A", strtotime($seennotify->created_at));?></span>
										</div>
										<hr class="user-blockv-hr">
									</li>
									<?php $i++; }elseif(($i < 5) && ($seennotify->type == 'groupsuggestion')) { ?>
									<li>
										<div class="user-block user-blockv">
											<?php if(!empty($seennotify->profile_image)){ ?>
												<img src="<?php echo base_url();?>assets/images/<?php echo $seennotify->profile_image;?>" class="user-blockv-img"> 
											<?php } else{ ?> 
												<img src="<?php echo base_url();?>assets/images/2.png" class="user-blockv-img"> 
											<?php } ?>
											<a href="<?php echo base_url();?>profile?id=<?php echo $seennotify->suserid;?>" style="display: contents;">
												<b class="user-blockv-title"><?php echo $seennotify->sname;?> </b></a>
											shared your story <a href="<?php echo base_url().$seennotify->redirect_uri;?>"  style="display: contents;">
												<b class="user-blockv-title"><?php echo $seennotify->stitle;?></b></a>
												to <?php $commuri = '#'; $commname = ''; $communityname = get_commname($seennotify->title_id);
												if(isset($communityname[0]->id) && !empty($communityname[0]->id)){
													$commuri = 'co_view/'.$communityname[0]->id;  }
												if(isset($communityname[0]->gener)){ $commname = $communityname[0]->gener; } ?>
												<a href="<?php echo base_url().$commuri;?>" style="display: contents;" style="display: contents;">
													<b class="user-blockv-title"><?php echo $commname;?> </b></a><br>
											<span class="user-blockv-span">
											<?php echo date("F j, Y g:i A", strtotime($seennotify->created_at));?></span>
										</div>
										<hr class="user-blockv-hr">
									</li>
									<?php $i++; }elseif(($i < 5) && ($seennotify->type == 'suggestion')) { ?>
									<li>
										<div class="user-block user-blockv">
											<?php if(!empty($seennotify->profile_image)){ ?>
												<img src="<?php echo base_url();?>assets/images/<?php echo $seennotify->profile_image;?>" class="user-blockv-img"> 
											<?php } else{ ?> 
												<img src="<?php echo base_url();?>assets/images/2.png" class="user-blockv-img"> 
											<?php } ?>
											<a href="<?php echo base_url();?>profile?id=<?php echo $seennotify->suserid;?>" style="display: contents;">
												<b class="user-blockv-title"><?php echo $seennotify->sname;?> </b></a>
											suggested you a story <!--<a href="<?php echo base_url().$seennotify->redirect_uri;?>" style="display: contents;"> -->
											    <a href="#" data-toggle="modal" data-target="#sugnotifymodal<?php echo $seennotify->id;?>" style="display: contents;">
												<b class="user-blockv-title"><?php echo $seennotify->stitle;?> </b></a><br>
											<span class="user-blockv-span">
											<?php echo date("F j, Y g:i A", strtotime($seennotify->created_at));?></span>
										</div>
										<hr class="user-blockv-hr">
									</li>
									<?php $i++; } ?>
								
								<?php } } ?>
					</ul>
				</li>
				<li>
					<a href="<?php echo base_url();?>notifications" class="dropk" style="text-align:center;">SHOW MORE</a>
				</li>
			</ul>
		</div>
		<!-- NOTIFICATIONS end -->
		
		
		<div class="dropdown" style="border-left:none; width:50px; padding-top:1px; background:none;">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"> 
				
				<?php if(isset($this->session->userdata['logged_in']['profile_image']) && 
					!empty($this->session->userdata['logged_in']['profile_image'])) { ?>
					<img src="<?php echo base_url();?>assets/images/<?php echo $this->session->userdata['logged_in']['profile_image']; ?>" style="width: 46px; height:44px;" class="img-circle" alt="User Image">
				<?php } else { ?>
					<img src="<?php echo base_url();?>assets/images/2.png" style="width: 46px; height:44px;" class="img-circle" >
				<?php } ?>
			</a>
			<ul class="dropdown-menu pull-right">
				<li style="border-bottom:1px solid #f4f4f4;"><a href="<?php echo base_url('profile?id='.$this->session->userdata['logged_in']['user_id']); ?>" class="dropk"><i class="fa fa-user pr-10"></i> MY PROFILE</a></li>
				<li style="border-bottom:1px solid #f4f4f4;"><a href="<?php echo base_url();?>my_profile/<?php echo $this->session->userdata['logged_in']['user_id'];?>" class="dropk"><i class="fa fa-sliders pr-10"></i> SETTINGS</a></li>
				<li style="border-bottom:1px solid #f4f4f4;"><a href="<?php echo base_url('trans');?>" class="dropk"><i class="fa fa-money pr-10"></i> TRANSACTIONS</a></li>
				<li style="border-bottom:1px solid #f4f4f4;"><a href="<?php echo base_url('drafts');?>" class="dropk"><i class="fa fa-file pr-10"></i> DRAFT</a></li>
				<li style="border-bottom:1px solid #f4f4f4;"><a href="<?php echo base_url('index.php/welcome/logout');?>" class="dropk" 
				    <?php if(isset($this->session->userdata['logged_in']['logintype']) && ($this->session->userdata['logged_in']['logintype'] == 'fb')){ ?> onclick="fbLogout()" id="fbLink" 
				    <?php }else if(isset($this->session->userdata['logged_in']['logintype']) && ($this->session->userdata['logged_in']['logintype'] == 'google')){ ?> onclick="signOut();" <?php } ?>
				    ><i class="fa fa-sign-out pr-10"></i> SIGN OUT</a></li>
			</ul>
		</div>
		<?php } else { ?>
		<div style="border-right:1px solid rgba(0,0,0,0.1);"><a href="#" data-toggle="modal" data-target="#loginmodal" id="notloginmodal"><i class="fa fa-user" aria-hidden="true"></i><p>LOGIN</p></a></div>
		<?php } ?>
    </div>
	
    <div class="lang hidden-md hidden-lg hidden-sm">
        <div class="dropdown">
            <a href="#" class="dropdown-toggle" title="WRITE" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true" style="color:#fff;"> 
                <i class="fa fa-language" aria-hidden="true"></i>
            </a>
            <ul class="dropdown-menu pull-left" style="right:0!important; left:auto;">
				<li style="border-bottom:1px solid #f4f4f4;"><a class="dropk notloginmodal" style="padding:5px 10px;" href="#" title="Series">ENGLISH</a></li>
				<li style="border-bottom:1px solid #f4f4f4;"><a class="dropk notloginmodal" style="padding:5px 10px;" href="#" title="Story">TELUGU</a></li>
				<li style="border-bottom:1px solid #f4f4f4;"><a class="dropk notloginmodal" style="padding:5px 10px; color:red!important;" href="#" title="Nano Story">MALAYALAM</a></li>
				<li style="border-bottom:1px solid #f4f4f4;"><a class="dropk notloginmodal" style="padding:5px 10px;" href="#" title="Life Events">KANNADA</a></li>
				<li style="border-bottom:1px solid #f4f4f4;"><a class="dropk notloginmodal" style="padding:5px 10px;" href="#" title="Series">ENGLISH</a></li>
				<li style="border-bottom:1px solid #f4f4f4;"><a class="dropk notloginmodal" style="padding:5px 10px;" href="#" title="Story">TELUGU</a></li>
				<li style="border-bottom:1px solid #f4f4f4;"><a class="dropk notloginmodal" style="padding:5px 10px;" href="#" title="Nano Story">MALAYALAM</a></li>
				<li style="border-bottom:1px solid #f4f4f4;"><a class="dropk notloginmodal" style="padding:5px 10px;" href="#" title="Life Events">KANNADA</a></li>
				<li style="border-bottom:1px solid #f4f4f4;"><a class="dropk notloginmodal" style="padding:5px 10px;" href="#" title="Series">ENGLISH</a></li>
				<li style="border-bottom:1px solid #f4f4f4;"><a class="dropk notloginmodal" style="padding:5px 10px;" href="#" title="Story">TELUGU</a></li>
				<li style="border-bottom:1px solid #f4f4f4;"><a class="dropk notloginmodal" style="padding:5px 10px;" href="#" title="Nano Story">MALAYALAM</a></li>
				<li style="border-bottom:1px solid #f4f4f4;"><a class="dropk notloginmodal" style="padding:5px 10px;" href="#" title="Life Events">KANNADA</a></li>
            </ul>
        </div>
    </div>
    <div class="search-div2"><a href="<?php echo base_url();?>index.php/welcome/search?searchtext=a" style="color:#fff;"><i class="fa fa-search" aria-hidden="true"></i></a></div>
    <div class="search-div">
        <form class="form-inline my-2 my-lg-0" method="GET" id="searchpost" action="<?php echo base_url();?>index.php/welcome/search">
            <input type="text" class="search-box" name="searchtext" value="<?php if(isset($searchtext)){echo $searchtext;} ?>" placeholder="Search for writers, stories, Series and more...">
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
                        <a href="<?php echo base_url();?>index.php/welcome/profile?id=<?php echo $notseennotify->suserid;?>">
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
                        <a href="<?php echo base_url();?>index.php/welcome/profile?id=<?php echo $seennotify->suserid;?>">
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


<script>
var didScroll;
var lastScrollTop = 0;
var delta = 5;
var navbarHeight = $('header').outerHeight();

$(window).scroll(function(event){
    didScroll = true;
});

setInterval(function() {
    if (didScroll) {
        hasScrolled();
        didScroll = false;
    }
}, 350);

function hasScrolled() {
    var st = $(this).scrollTop();
    
    // Make sure they scroll more than delta
    if(Math.abs(lastScrollTop - st) <= delta)
        return;
    
    // If they scrolled down and are past the navbar, add class .nav-up.
    // This is necessary so you never see what is "behind" the navbar.
    if (st > lastScrollTop && st > navbarHeight){
        // Scroll Down
        $('header').removeClass('header').addClass('nav-up');
    } else {
        // Scroll Up
        if(st + $(window).height() < $(document).height()) {
            $('header').removeClass('nav-up').addClass('header');
        }
    }
    
    lastScrollTop = st;
}
</script>
