<style>

.noselect{  
	-webkit-touch-callout: none; /* iOS Safari */
	-webkit-user-select: none; /* Safari */
	-khtml-user-select: none; /* Konqueror HTML */
	-moz-user-select: none; /* Firefox */
	-ms-user-select: none; /* Internet Explorer/Edge */
	user-select: none; /* Non-prefixed version, currently supported by Chrome and Opera */
}
.content {
  padding: 16px;
}

/* 2nd nav bar  dropdown */
/*Nav bar profile dropdown */
.navbar-custom-menu>.navbar-nav>li>.dropdown-menu {
    position: absolute;
    right: 0;
    left: auto;
}
/*end Nav bar profile dropdown */

.hide {
  display: none;
}
.rating {
    unicode-bidi: bidi-override;
    direction: rtl;
    text-align: center;
    position: relative;
}
.rating > label {
    display: inline;
    padding: 0;
    margin: 0;
    position: relative;
    width: 1.em;
    cursor: pointer;
    color: #000;
}
.rating > label:hover,
.rating > label:hover ~ label,
.rating > input.radio-btn:checked ~ label {
    color: transparent;
}
.rating > label:hover:before,
.rating > label:hover ~ label:before,
.rating > input.radio-btn:checked ~ label:before,
.rating > input.radio-btn:checked ~ label:before {
    content: "\2605";
    position: absolute;
    left: 0;
    color: #ffdf00;
}
.text-right {
    text-align: center;
    font-size: 16px;
}
.scrollable-menu {
    overflow-x: hidden;
    width:200px;
    max-height:300px;
}
.resizable{
    font-size:15px;
}
.control-sidebar-menu>li>a {
    display: block;
    padding: 10px 15px;
}
.media {
    border: none;
}

.favbtn {
    font-size: 1.5em;
}
.navbar-static-top{
    top:60px;
    z-index:1;
}
.sticky {
  position: fixed;
  top:60px;
  width: 100%;
  transition: top 0.3s;
}
		.sticky1 {
  position: fixed;
  top:0px;
  width: 100%;
  transition: top 0.3s;
}

.sticky + .content {
  padding-top: 60px;
}
.imgs{
    width:320px;
    height:280px;
}
@media screen and (max-width:1050px){
    .navbar-static-top{
        top:-42px!important;
        z-index:0;
    }
    .pd-10-0{
        padding-left:0;
        padding-right:0;
    }
    .imgs{
        width:100%!important;
        height:280px;
    }
    .nav>li>a {
        position: relative;
        display: block;
        padding: 0px 8px!important;
    }
    .pt-5{
        padding-top:5px!important;
    }
    body {
        background-color: #ecf0f5;
        margin: 0;
        padding: 0px 10px;
    }
}
</style>
<div class="navbar navbar-inverse navbar-static-top" role="navigation" id="navbarv" style="  background-color:#23678e;">	
	<div class="navbar-collapse" style="padding-top:5px;">
		<ul class="nav navbar-nav" style="display: inline-flex;">
			<li class="dropdown se-vj">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="background-color:#23678e;">
                    <i class="fa fa-bars" aria-hidden="true"></i>
    			    <span class="hidden-xs">
						<?php $seriesftitles = ''; if(isset($seriesftitle) && ($seriesftitle->num_rows() == 1)){ 
    			        foreach($seriesftitle->result() as $seriesftitl){ echo $seriesftitles = $seriesftitl->title;} }else{ echo 'EPISODES';} ?>
					</span>
                </a>
                <ul class="dropdown-menu pull-left scrollable-menu control-sidebar-menu" id="action" style="margin-left:15px; width:280px;height:285px;">
                    <h5 style="margin-top: 15px;margin-left: 30px;">
                        <a href="<?php echo base_url();?>index.php/welcome/new_series?id=<?php echo $_GET['story_id'];?>&story_id=<?php echo $_GET['story_id'];?>">
                            <?php echo $seriesftitles; ?>
                        </a>
                    </h5>
                    <hr style="margin-top: 5px;margin-bottom: 5px; border-style: inset; border-width: 1px;">
    			    <?php $i=1; $j=0; foreach($new_episode as $row) { if($j==0) { $rowin='active'; }
    			        if(isset($row->sid) && ($row->sid != $row->story_id) && ($row->type == "series") && ($row->draft != 'draft')){ ?>
        				<li data-target="#myCarousel" data-slide-to="<?php echo $j; ?>" class="li-color">
        					<a href="<?php echo base_url('index.php/welcome/new_series?id='.$row->sid.'&story_id='.$row->story_id);?>">
        					    <span class="menu-icon bg-light-blue" style="border-radius: 50px; background-color: #000; padding-left: 0px;">
        					       <?php echo $i; ?> </span>
        					    <div class="menu-info">
        					        <h4 class="control-sidebar-subheading" style="overflow: hidden;white-space:pre;text-overflow: ellipsis;-webkit-appearance: none;"><?php echo ucfirst($row->title); ?></h4>
        					    </div>
    					        <small style="font-size:10px;"> &nbsp; &nbsp; <?php echo date("M j, Y", strtotime($row->date));?></small>
        					</a>
        				</li>
        				<hr style="border-style: inset; border-width: 1px; margin:0px;">
    			    <?php $i++; } } ?>
                </ul>
            </li>
            
            <li class="mg-14" style="background: #23678e; border: none;">
                <?php if(isset($subscriptions) && in_array($_GET['story_id'], $subscriptions)) { ?>
    			    <a style="background:none; border:none;color: #FFF; cursor:pointer" class="subscribe" onclick="unsubscribe(<?php echo $_GET['story_id'];?>)"> SUBSCRIBED </a>
    		    <?php } else { ?>
    		        <a style="background:none; border:none;color: #FFF; cursor:pointer" class="subscribe" onclick="subscribe(<?php echo $_GET['story_id'];?>)"> SUBSCRIBE </a>
    		    <?php } ?>
            </li>
		</ul>
		<ul class="nav navbar-nav pull-right fv pt-5" style="display:flex;">
			<li class="">
    			<?php $readlatersids = get_storiesreadlater('readlater'); ?>
                <?php if(isset($readlatersids) && (sizeof($readlatersids)>0) && in_array($_GET['id'], $readlatersids)) { ?>
					<a class="btn btn-primary readlaterbtn<?php echo $_GET['id'];?>" style="background: #23678e; border: none;">
					    <button style="background:none; border:none;" onclick="unreadlater(<?php echo $_GET['id'];?>)" class="notloginmodal readlaterbtnatr<?php echo $_GET['id'];?>">
			            <i class="fa fa-check faicon<?php echo $_GET['id'];?>"></i> READ LATER </button>
			        </a>
        	    <?php } else { ?>
                    <a class="btn btn-success readlaterbtn<?php echo $_GET['id'];?>" style="background: #23678e; border: none;">
    			        <button style="background:none; border:none;" onclick="readlater(<?php echo $_GET['id'];?>)" class="notloginmodal readlaterbtnatr<?php echo $_GET['id'];?>">
    	                <i class="fa fa-bookmark faicon<?php echo $_GET['id'];?>"></i> READ LATER </button>
	                </a>
                <?php } ?>
            </li>
			<li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="background-color:#23678e;"><i class="fa fa-share-alt"></i></a>
                <ul class="dropdown-menu pull-right">
                    <li onclick="groupsuggest(<?php echo $_GET['id'];?>);">
						<a data-toggle="modal" data-target="#groupsuggest" title="COMMUNITY"><i class="fa fa-users pr-10"></i>COMMUNITY</a>
					</li>
					<li onclick="friend(<?php echo $_GET['id'];?>);">
						<a data-toggle="modal" data-target="#friendsuggest" title="SUGGEST"><i class="fa fa-user pr-10"></i>SUGGEST</a>
					</li>
					<li>
						<a data-toggle="modal" data-target="#soc" href="" title="SOCIAL MEDIA">
							<i class="fa fa-share-alt pr-10"></i>SOCIAL
						</a>
					</li>
                </ul>
            </li>
			<li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="background-color:#23678e;"><i class="fa fa-ellipsis-v"></i></a>
                <ul class="dropdown-menu pull-right">
                    <li>
						<a data-toggle="modal" data-target="#reportspam"><i class="fa fa-exclamation pr-10"></i> Report</a>
					</li>
				</ul>
            </li>
		</ul>
	</div>
</div>
<div class="">
	<section class="ptv">
		<div class="container">
			<div class="row">
				<?php if(isset($new_series) && ($new_series->num_rows() > 0)){ foreach($new_series->result() as $row){ 
					if(isset($this->session->userdata['logged_in']['user_id']) && ($row->user_id == $this->session->userdata['logged_in']['user_id'])){
						header('Location: '.base_url().'index.php/welcome/new_series_admin?id='.$row->sid.'&story_id='.$row->story_id);
					} ?>
					<div class="col-md-3" style="margin-bottom:20px;">
						<div class="row">
							<div class="box box-widget widget-user vjbs">
								<?php if(isset($row->cover_image) && ($row->cover_image)) { ?>
									<img src="<?php echo base_url();?>assets/images/<?php echo $row->cover_image; ?>" alt="" class="img-responsive vjsvi1 img-bv imgs">
								<?php } else { ?>
									<img src="<?php echo base_url();?>assets/images/1.jpg" alt="" class="img-responsive vjsvi1 img-bv imgs">
								<?php } ?>
							</div>
						</div><br>
						<div class="row">
							<div class="box box-widget widget-user boxshv boxshv1">
								<center>
									<?php if(isset($row->profile_image) && ($row->profile_image)) { ?>
									<div class="widget-user-header" style="padding:0px !important; height:auto;"> 
										<img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $row->profile_image; ?>" alt="User Avatar" class="img-responsive vjsvi" style="width: 190px;">
									</div>
									<?php } else { ?>
									<div class="widget-user-header" style="padding:0px !important; height:auto;"> 
										<img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="User Avatar" class="img-responsive vjsvi" style="width: 190px;">
									</div>
									<?php } ?>
								</center>
								<div class="box-footer" style="padding-top:0">
									<div class="row">
										<div class="col-sm-12">
											<center><a href="#" style="color:#000"><h4 style="margin-top:10px"><b><?php echo $row->name; ?></b></h4></a></center>
										</div>
										<div class="col-sm-12">
											<?php if(isset($following) && in_array($row->user_id, $following)) { ?>
												<button class="btn btn-primary btn-block unfollow<?php echo $row->user_id;?>" onclick="writerunfollow(<?php echo $row->user_id;?>,'<?php echo $row->name;?>')"> Following </button>
											<?php } else { ?>
												<button class="btn btn-success btn-block follow<?php echo $row->user_id;?>" onclick="writerfollow(<?php echo $row->user_id;?>,'<?php echo $row->name;?>')"> Follow </button>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>
						</div><br>
						<div class="row">
							<div class="box box-widget widget-user boxshv boxshv1">
								<div class="box-footer">
									<div class="row">
										<div class="col-sm-12" style="padding-top: 10px;">
											<p>Subscribe to this story for free.</p>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6" style="float:left;margin-top:10px;">
											<p style="color:#9e9e9e;" class="subscribers"><?php if(isset($countsubs)){echo count($countsubs);}else{ echo 0; }?> Subscribers</p>
										</div>
										<div class="col-sm-6" style="float:right;margin-top:4px;">
											<?php if(isset($subscriptions) && in_array($_GET['story_id'], $subscriptions)){ ?>
												<button class="btn btn-primary btn-block subscribe" onclick="unsubscribe(<?php echo $_GET['story_id'];?>)"> SUBSCRIBED </button>
											<?php } else{ ?>
												<button class="btn btn-success btn-block subscribe" onclick="subscribe(<?php echo $_GET['story_id'];?>)"> SUBSCRIBE </button>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					 <?php $parablock1 = ''; $parablock2 = ''; $parablock3 = ''; $parablock1count = 0; $parablock2count = 0; ?>
					<div class="col-md-8 pd-10-0">
						<div class="box box-widget widget-user boxshv boxshv1"><br>
							<center><h3><b><?php echo $row->title; ?></b></h3></center>
							<div style="padding:20px 20px 0 20px;">
							<span class="text-right">
								<span class="font-size-label" style="display: inline-block; padding-right:15px;">Font Size</span>
								<a id="up" class="plus">+</a>
								<span id="font-size" style="margin: 0 5px;width: 30px;height: 30px;"></span>
								<a id="down"  class="plus">-</a>
							</span>
							    <?php if(($row->type == 'series') && ($row->sid == $row->story_id)){ 
									$seriesongo_stop = get_seriesongo_stop($row->story_id); if(isset($seriesongo_stop) && !empty($seriesongo_stop)) { ?>
									<span style="float:right"><i class="fa fa-clock-o"></i> <span><?php echo $seriesongo_stop;?></span></span>
								<?php } }else{ ?>
							        <span style="float:right"><i class="fa fa-clock-o"></i> <span id="time123"></span> నిమిషాల కథ</span>
								<?php } ?>
							</div>
							<ul class="list-inline" style="padding:20px 20px 0 20px; margin-bottom:2px Solid #999;">
								<li><i class="fa fa-eye"></i> <?php echo $row->views;?></li>
								<li>
									<?php if(isset($reviews) && !empty($reviews)) {
										$starNumber = explode('.',$reviews[0]->rating);
										for($x=1;$x<=$starNumber[0];$x++) { ?>
											<span class="fa fa-star checked" style="color:#FFDF00;" title="<?php echo $x; ?>"></span>
										<?php } if(isset($starNumber[1]) && !empty($starNumber[1])) { if ($starNumber[1] != 0) { ?>
											<span class="fa fa-star-half-full checked" style="color:#FFDF00;" title="<?php echo $reviews[0]->rating; ?>"></span>
										<?php $x++;} } 
										$abcd = ''; if($starNumber[0] <= 0){ $abcd = 'style="color:#FFDF00;"';} 
										while ($x<=5) { echo '<span class="fa fa-star checked" '.$abcd.'></span>';$x++;}
									} ?>
								</li>
								<li class="pull-right">
									<i class="fa fa-heart" style="color: #337ab7;"></i>
									<span class="favcount"> <?php $favcount = 0; if(isset($_GET['id']) && !empty($_GET['id'])){
										$favocount = get_favcount($_GET['id']); if($favocount){ $favcount = $favocount;}
										}   echo $favcount;?>
									</span>
								</li>
								<li class="pull-right">
									<a href="#commentv">
										<i class="fa fa-comment"></i>
										<?php if(isset($comment_like['commentcount'])){ echo $comment_like['commentcount']; } ?>
									</a>
								</li>
								<!--<?php if(($row->type == 'series') && ($row->sid == $row->story_id)){ 
									$seriesongo_stop = get_seriesongo_stop($row->story_id); if(isset($seriesongo_stop) && !empty($seriesongo_stop)) { ?>
									<li class="pull-right"><i class="fa fa-clock-o"></i> <span><?php echo $seriesongo_stop;?></span></li>
								<?php } }else{ ?>
								<li class="pull-right"><i class="fa fa-clock-o"></i> <span id="time123"></span> నిమిషాల కథ</li>
								<?php } ?>-->
							</ul><hr>
							
								<?php $paragraphs = explode(PHP_EOL, $row->story); 
									if(isset($paragraphs) && (count($paragraphs) > 0)){ foreach($paragraphs as $paragraph){
										$paracount = count(explode(' ',$paragraph));
										if( ($parablock1count >= 0) && ($parablock1count <= 500)) {
											$parablock1count = $parablock1count+$paracount;
											$parablock1 = $parablock1.'<p>'.$paragraph.'</p>';
										}elseif(($parablock1count > 500) && (($parablock2count >= 0) && ($parablock2count <= 500))){
											$parablock2count = $parablock2count+$paracount;
											$parablock2 = $parablock2.'<p>'.$paragraph.'</p>';
											//echo $parablock2;
										}elseif(($parablock1count > 500) && ($parablock2count > 500)){
											$parablock3 = $parablock3.'<p>'.$paragraph.'</p>';
										}
									}   } ?>
									
								<div style="text-align: justify;word-wrap: break-word;padding: 20px;" id="readTime" class="resizable noselect">
									<!-- <?php echo $row->story; ?><br> -->
									<?php if(isset($parablock1) && !empty($parablock1)){ echo $parablock1; } ?>
								</div>
							</div>
							
							<?php if(isset($parablock2) && !empty($parablock2)){ ?>
							<br><div class="box box-widget widget-user boxshv">
									<div style="padding:20px;text-align: justify;word-wrap: break-word;" id="readTime" class="resizable noselect">
									  <?php echo $parablock2; ?>
									</div>
								</div>
							<?php } if(isset($parablock3) && !empty($parablock3)){ ?>
							<br><div class="box box-widget widget-user boxshv">
									<div style="padding:20px;text-align: justify;word-wrap: break-word;" id="readTime" class="resizable noselect">
									  <?php echo $parablock3; ?>
									</div>
								</div>
							<?php } ?>
							
							<div class="box-footer" style="padding-top:10px;border: 1px solid #d1d1d1;">
								<div class="row">
									<div class="col-md-4 col-xs-4">
										<?php if(isset($favorites) && in_array($_GET['id'], $favorites)){ ?>
											<span style="cursor:pointer" onclick="unfavorite(<?php echo $_GET['id'];?>)" class="favbtn<?php echo $_GET['id'];?>" title="Favorite">
												Favorite <i class="fa fa-heart favbtn fa-2x" style="color:#ff0000;"></i> </span>
										<?php } else{ ?>
											<span style="cursor:pointer" onclick="favorite(<?php echo $_GET['id'];?>)" class="favbtn<?php echo $_GET['id'];?>" title="Favorite">
												Favorite <i class="fa fa-heart-o favbtn fa-2x" style="color:#333;"></i> </span>
										<?php } ?>
									</div>
									<div class="col-md-4 hidden-xs"></div>
									<div class="col-md-4 text-right col-xs-8"> Rating :
										<span class="rating" style="text-align:left;">
											 <?php if(isset($userrating) && ($userrating >= 1)){ ?>
												<input id="star5" name="star" value="5" class="radio-btn hide" <?php if($userrating == 5){?>checked="checked" type="radio"<?php } ?>/>
												<label for="star5" style="font-size:20px;">☆</label>
												<input id="star4" name="star" value="4" class="radio-btn hide" <?php if($userrating == 4){?>checked="checked" type="radio"<?php } ?>/>
												<label for="star4" style="font-size:20px;">☆</label>
												<input id="star3" name="star" value="3" class="radio-btn hide" <?php if($userrating == 3){?>checked="checked" type="radio"<?php } ?>/>
												<label for="star3" style="font-size:20px;">☆</label>
												<input id="star2" name="star" value="2" class="radio-btn hide" <?php if($userrating == 2){?>checked="checked" type="radio"<?php } ?>/>
												<label for="star2" style="font-size:20px;">☆</label>
												<input id="star1" name="star" value="1" class="radio-btn hide" <?php if($userrating == 1){?>checked="checked" type="radio"<?php } ?>/>
												<label for="star1" style="font-size:20px;">☆</label>
											<?php }else{ ?>
												<input id="star5" name="star" type="radio" value="5" class="radio-btn hide" />
												<label for="star5" style="font-size:20px;">☆</label>
												<input id="star4" name="star" type="radio" value="4" class="radio-btn hide" />
												<label for="star4" style="font-size:20px;">☆</label>
												<input id="star3" name="star" type="radio" value="3" class="radio-btn hide" />
												<label for="star3" style="font-size:20px;">☆</label>
												<input id="star2" name="star" type="radio" value="2" class="radio-btn hide" />
												<label for="star2" style="font-size:20px;">☆</label>
												<input id="star1" name="star" type="radio" value="1" class="radio-btn hide" />
												<label for="star1" style="font-size:20px;">☆</label>
											<?php } ?>
										</span>
									</div>
									<div class="col-md-8 favoritemsg text-danger"></div><div class="col-md-4"></div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3 col-xs-6" style="margin-top:8px;">
									<button class="btn btn-success" id="opens">SEE ALL EPISODES</button>
								</div>
								<div class="col-md-6 hidden-xs"></div>
								<div class="col-md-3 pull-right col-xs-6" style="margin-top:8px;">
									<center>
        				        		<?php if(isset($nextepisode)){ foreach($nextepisode as $row) { if($_GET['id'] === $_GET['story_id']){ ?>
        				        		    <a href="<?php echo base_url('index.php/Welcome/new_series?id='.$row->sid.'&story_id='.$_GET['story_id']);?>" class="pull-right">
        				        			<button class="btn btn-success"> Start Reading >></button></a>
        				        		<?php } else { ?>
        				        			<a href="<?php echo base_url('index.php/Welcome/new_series?id='.$row->sid.'&story_id='.$_GET['story_id']);?>" class="pull-right">
        				        			<button class="btn btn-success"> Next Episode >></button></a>
        				        	    <?php } } } ?>
    				        	    </center>
								</div>
							</div>
							<div class="clearfix"></div><br>
							<br>
						<div class="">
							<?php if(isset($recentseries) && ($recentseries->num_rows() > 0)){ ?>
								<div class="row pt-0">
									<div class="col-md-6 col-xs-8 pull-left pd-0">
		    	                    	<div class="titlei">Related SERIES</div>
		    	                    </div>
		    	                    <div class="col-md-6 col-xs-4 pd-0">
		    	                    	<div class="view pull-right">
		    	                    	   <a href="">View More</a> 
		    	                    	</div>
		    	                    </div>
								</div>
								<hr>
								<div id="StoryCont" class="StoryCont" style="text-align:left;">
				                    <div id="story-slider" class="story-slider series">
							        <?php foreach ($recentseries->result() as $recentstory) { ?>
							            <div class="card">
					                    	<div class="book-type" style="z-index:0"><?php echo $recentstory->gener;?></div>
					                    		<?php if(isset($recentstory->cover_image) && !empty($recentstory->cover_image)) { ?>
					                    		<img src="<?php echo base_url();?>assets/images/<?php echo $recentstory->cover_image; ?>" alt="Avatar" class="imageme">
					                    		<?php }else{ ?>
					                    			<img src="<?php echo base_url();?>assets/dist/img/photo1.png" alt="Avatar" class="imageme">
					                    		<?php } ?>
					                    	<div>
					                    		<font class="max-lines">
					                    			<a href="<?php echo base_url('index.php/welcome/new_series?id='.$recentstory->sid.'&story_id='.$recentstory->story_id);?>">
					                    				<?php echo ($recentstory->title);?>
					                    			</a>
					                    		</font> 
					                    	</div>
					                    	<div class="flextest">
					                    		<font class="byname">By<font class="namehere"><a href="<?php echo base_url('index.php/welcome/profile?id='.$recentstory->user_id);?>" style="color:#000"><?php echo $recentstory->name;?>
					                    		    </a>
					                    		</font>
					                    		</font><br>
					                    	</div>
					                    	<div class="flextest" style="padding-top:4px;">
					                    		<font class="episodes">
					                    			<?php $keycount = get_episodecount($recentstory->sid); 
					                    			if(isset($keycount)){ echo $keycount; }else{ echo 0; }?> EPISODES | <?php $subsmemcount = get_storysubscount($recentstory->sid); 
					                    			if(isset($subsmemcount)){echo $subsmemcount; }else{echo 0; } ?> MEMBERS
					                    		</font><br>
					                    	</div>
					                    	<div class="flextest" style="padding-top:6px">
					                    		<?php if(isset($this->session->userdata['logged_in']['user_id']) && ($recentstory->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
					                    			
					                    				<button class="read" onclick="yoursreadlater();"><i class="fa fa-bookmark"></i> Read later </button>
					                    			
					                    		<?php }else{ ?>
					                    			<?php if(isset($readlatersids) && (sizeof($readlatersids)>0) && in_array($recentstory->sid, $readlatersids)) { ?>
					                    				<button onclick="unreadlater(<?php echo $recentstory->sid;?>)" class="readdone notloginmodal readlaterbtnatr<?php echo $recentstory->sid;?>">
					                    				<i class="fa fa-check faicon<?php echo $recentstory->sid;?>"></i> Read later </button>
					                    			<?php }else { ?>
					                    				<button onclick="readlater(<?php echo $recentstory->sid;?>)" class="read notloginmodal readlaterbtnatr<?php echo $recentstory->sid;?>">
					                    				<i class="fa fa-bookmark faicon<?php echo $recentstory->sid;?>"></i> Read later </button>
					                    			<?php } ?>
					                    		<?php } ?>
					                    		
					                    		<button type="button" class="btn read dropdown-toggle pull-right" data-toggle="dropdown">
					                    			<span class=""><i class="fa fa-plus"></i></span>
					                    		</button>
					                    		<ul class="dropdown-menu list-inline" style="margin-top:-90px; float:right; position:relative">
					                    			<li onclick="groupsuggest(<?php echo $recentstory->sid; ?>);">
					                    				<a data-toggle="modal" data-target="#groupsuggest"><i class="fa fa-users"></i></a>
					                    			</li>
					                    			<li onclick="friend(<?php echo $recentstory->sid;?>);">
					                    				<a data-toggle="modal" data-target="#friendsuggest"><i class="fa fa-user"></i></a>
					                    			</li>
					                    			<li>
					                    				<a data-toggle="modal" data-target="#soc" href="">
					                    					<i class="fa fa-share-alt"></i>
					                    				</a>
					                    			</li>
					                    		</ul>
					                    	</div>
					                    
					                    </div>
							        <?php } } ?>
							    </div>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				<?php } } ?>
			</div><br><br>
			<input type="hidden" id="languageto" value="<?php if(isset($this->session->userdata['language']) && !empty($this->session->userdata['language'])){ echo $this->session->userdata['language'];}else{ echo 'en';} ?>">
			<script type="text/javascript" src="https://www.google.com/jsapi"></script>
			<script type="text/javascript">
				// Load the Google Transliterate API
				google.load("elements", "1", {
					packages: "transliteration"
				});
				  var langugeto = document.getElementById('languageto').value;
				  var transliterationControl;
				  function onLoad() {
					var options = {
						sourceLanguage: 'en',
						destinationLanguage: [langugeto],
						transliterationEnabled: true,
					};
					// Create an instance on TransliterationControl with the required
					// options.
					transliterationControl =
					  new google.elements.transliteration.TransliterationControl(options);
			
					// Enable transliteration in the textfields with the given ids.jk
					var ids = [ "comment" ];
					transliterationControl.makeTransliteratable(ids);
			
					// Add the STATE_CHANGED event handler to correcly maintain the state
					// of the checkbox.
					transliterationControl.addEventListener(
						google.elements.transliteration.TransliterationControl.EventType.STATE_CHANGED,
						transliterateStateChangeHandler);
			
					// Add the SERVER_UNREACHABLE event handler to display an error message
					// if unable to reach the server.
					transliterationControl.addEventListener(
						google.elements.transliteration.TransliterationControl.EventType.SERVER_UNREACHABLE,
						serverUnreachableHandler);
			
					// Add the SERVER_REACHABLE event handler to remove the error message
					// once the server becomes reachable.
					transliterationControl.addEventListener(
						google.elements.transliteration.TransliterationControl.EventType.SERVER_REACHABLE,
						serverReachableHandler);
			
					// Set the checkbox to the correct state.
					document.getElementById('checkboxId').checked =
					  transliterationControl.isTransliterationEnabled();
			
					// Populate the language dropdown
			
				  }
			
				  // Handler for STATE_CHANGED event which makes sure checkbox status
				  // reflects the transliteration enabled or disabled status.
				  function transliterateStateChangeHandler(e) {
					document.getElementById('checkboxId').checked = e.transliterationEnabled;
				  }
			
				  // Handler for dropdown option change event.  Calls setLanguagePair to
				  // set the new language.
				  function languageChangeHandler() {
					transliterationControl.toggleTransliteration();
					var dropdown = document.getElementById('languageDropDown');
					transliterationControl.setLanguagePair(
						google.elements.transliteration.LanguageCode.ENGLISH,
						dropdown.options[dropdown.selectedIndex].value);
				  }
			
				  // SERVER_UNREACHABLE event handler which displays the error message.
				  function serverUnreachableHandler(e) {
					document.getElementById("errorDiv").innerHTML =
						"Transliteration Server unreachable";
				  }
			
				  // SERVER_UNREACHABLE event handler which clears the error message.
				  function serverReachableHandler(e) {
					document.getElementById("errorDiv").innerHTML = "";
				  }
			  google.setOnLoadCallback(onLoad);
			</script>
			
			<div class="row pt-0">
				<div class="col-md-3"></div>
				<div class="col-md-8 pd-0">
					<div class="vjbs" id="commentv" style="padding:10px;background: #fff;">
						<span><h4><b>Comments Here</b></h4></span>
						<div class="box-footer box-comments">
							<div class="box-comment">
								<form id="commentsend" method="POST">      
									<div class="input-group">
										<input type="text" id="comment" name="comment" placeholder="Press enter to post comment ..." class="form-control required">
										<input type="text" id="comments" name="comment" placeholder="Press enter to post comment ..." class="form-control required" style="display:none;">
										<span class="p_usernamev text-danger"></span>
										<input type="hidden" id="storyid" name="id" value="<?php  echo $_GET['id']; ?>">
										<span class="input-group-btn">
											<!--<button type="submit" onclick="commentsend()" class="btn btn-success btn-flat">POST</button>-->
											<input type="submit" class="btn btn-success btn-flat" value="POST">
										</span>
									</div>
								</form><br>
								<div class="input-group">
									Switch to English: &nbsp; <label class="switch">  
										<input type="checkbox" onclick="langchang(this.value)" value="off" id="langchang"> <span class="slider"> </span> 
									</label> &nbsp; <span class="langchang"> Off </span>
								</div><br>	
							</div>
							<!-- /.box-comment -->
							<div id="test_comment">
								<ul style="list-style: none; padding:0px;">
									<li id="postcmt"> </li>
								<?php if(isset($comment_get) && ($comment_get->num_rows() >0)){ 
									foreach($comment_get->result() as $comment){ ?>
									<li style="margin-bottom:15px;" class="commentdelete<?php echo $comment->cid;?>">
										<div class="media">
											<div class="media-left">
												<?php if(!empty($comment->profile_image)){ ?>
													<img src="<?php echo base_url();?>assets/images/<?php echo $comment->profile_image;?>" style="border-radius: 50%;width:50px;height:50px;">
												<?php } else{ ?>
													<img src="<?php echo base_url();?>assets/images/2.png" style="border-radius: 50%;width:50px;height:50px;">
												<?php } ?>
											</div>
											<div class="media-body">
												<b><?php echo ucfirst($comment->name); ?></b> &nbsp; &nbsp; <small> <?php echo date("M j, Y g:i A", strtotime($comment->date));?></small>
												<?php if(isset($this->session->userdata['logged_in']['user_id']) && ($this->session->userdata['logged_in']['user_id'] == $comment->user_id)){ ?>
												<span class="pull-right" onClick="editcomment(<?php echo $comment->cid;?>);"><i class="fa fa-pencil"></i> Edit</span>
												<span class="pull-right" onClick="deletecomment(<?php echo $comment->cid;?>);"><i class="fa fa-trash"></i> Delete</span>
												<?php }else{ ?>
												<span class="pull-right" onClick="reportcomment(<?php echo $comment->cid;?>, <?php echo $comment->user_id;?>, <?php echo $comment->story_id;?>);"><i class="fa fa-exclamation-triangle"></i> Report Spam</span>
												<?php } ?>
												<p class="pcomment<?php echo $comment->cid;?>"><?php echo $comment->comment; ?></p>
												<a href="javascript:void(0)" onClick="postReplycomment(<?php echo $comment->cid;?>, <?php echo $comment->story_id;?>)" style="color:#de1800;"> REPLY </a>
												<div class="input-group postreplycomment<?php echo $comment->cid;?>"></div>
												<?php $replaycomments = get_replaycomments($comment->story_id, $comment->cid); ?>
												<?php if(isset($replaycomments) && ($replaycomments->num_rows() > 0 )){ ?>
													<ul style="list-style: none; padding:0px; margin-top:15px;">
														<li class="postreplycmt<?php echo $comment->cid;?>"></li>
													<?php foreach($replaycomments->result() as $replaycomment){ ?>
														<li style="margin-bottom:15px;" class="commentdelete<?php echo $replaycomment->cid;?>">
															<div class="media">
																<div class="media-left">
																	<?php if(!empty($replaycomment->profile_image)){ ?>
																		<img src="<?php echo base_url();?>assets/images/<?php echo $replaycomment->profile_image;?>" style="border-radius: 50%;width:40px;height:40px;">
																	<?php } else{ ?>
																		<img src="<?php echo base_url();?>assets/images/2.png" style="border-radius: 50%;width:40px;height:40px;">
																	<?php } ?>
																</div>
																<div class="media-body" style="background-color:#ddd; border-radius:5px; padding: 0px 10px;">
																	<b><?php echo ucfirst($replaycomment->name); ?></b> &nbsp; &nbsp; <small> <?php echo date("M j, Y g:i A", strtotime($replaycomment->date));?></small>
																	<?php if(isset($this->session->userdata['logged_in']['user_id']) && ($this->session->userdata['logged_in']['user_id'] == $replaycomment->user_id)){ ?>
																	<span class="pull-right" onClick="editcomment(<?php echo $replaycomment->cid;?>);"><i class="fa fa-pencil"></i> Edit</span>
																	<span class="pull-right" onClick="deletecomment(<?php echo $replaycomment->cid;?>);"><i class="fa fa-trash"></i> Delete</span>
																	<?php }else{ ?>
																	<span class="pull-right" onClick="reportcomment(<?php echo $replaycomment->cid;?>, <?php echo $replaycomment->user_id;?>, <?php echo $replaycomment->story_id;?>);"><i class="fa fa-exclamation-triangle"></i> Report Spam</span>
																	<?php } ?>
																	<p class="pcomment<?php echo $replaycomment->cid;?>"><?php echo $replaycomment->comment; ?></p>
																</div>
															</div>
														</li>
													<?php } ?>
												</ul>
												<?php } else{ ?>
													<ul style="list-style: none; padding:0px; margin-top:15px;">
														<li class="postreplycmt<?php echo $comment->cid;?>"></li>
													</ul>
												<?php } ?>
											</div>
										</div>
									</li> 
								<?php } } ?>
								</ul>		
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
</div>

<!-- Social Popup ---- -->
<div class="modal fade" id="soc">
	<div class="modal-dialog">
		<div class="modal-content socv">
			<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Social Media Share</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<a class="btn btn-primary btn-social-icon btn-facebook" style="border-radius: 50%;"><i class="fa fa-facebook"></i></a> Faceebok<br><br>
						</div>
						<div class="col-md-12">
							<a class="btn btn-success btn-social-icon btn-google-plus" style="border-radius: 50%;"><i class="fa fa-whatsapp"></i></a> Whatsapp<br><br>
						</div>
						<div class="col-md-12">
							<a class="btn btn-info btn-social-icon btn-twitter" style="border-radius: 50%;"><i class="fa fa-twitter"></i></a> Twitter<br><br>
						</div>
						<div class="col-md-12">
							<a class="btn btn-success btn-social-icon btn-twitter" style="border-radius: 50%;"><i class="fa fa-link"></i></a> Copy Link<br><br>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- Social popup ---- -->
<!-- group suggest popup code ---- -->
<div class="modal" id="groupsuggest" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
		    <div class="storysuggesttogroup"></div>
		</div>
	</div>
</div>
<!-- group suggest popup code ----------- -->
<!-- frind popup code ------>
<div class="modal" id="friendsuggest" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
		    <div class="storysuggesttofriend"></div>
		</div>
	</div>
</div>
<!--frind popup end ------------->
<div class="modal fade" id="report_comment" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><b>Report Your Comments</b></h4>
			</div>
			<div class="modal-body">
				<form id="reportcomment">
					<textarea class="form-control input-sm" name="reportcmt" id="reportcmt" placeholder="Enter Repost message"></textarea>
					<span class="text-danger reportcmt"></span>
					<input type="hidden" name="reportcommentid" value="" id="reportcommentid">
					<input type="hidden" name="report_userid" value="" id="report_userid">
					<input type="hidden" name="report_storyid" value="" id="report_storyid">
					<br>
					<center>
					    <button class="btn btn-primary" type="submit"> Update </button>
					</center>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="edit_comment" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><b>Update your Comments</b></h4>
			</div>
			<div class="modal-body">
				<form id="editcomment" >
					<textarea class="form-control input-sm" name="comment" id="editcmt" placeholder="Enter comment"></textarea>
					<span class="text-danger comment"></span>
					<input type="hidden" id="commentid" name="commentid">
					<br>
					<center>
					    <button class="btn btn-primary" type="submit"> Update </button>
					</center>
				</form>
			</div>
		</div>
	</div>
</div>

<script src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<script>//dropdown opens on all episodes
$('document').ready(function() {
    $("#opens").on("click", function() {
        $("#action").toggle();
    });
})
</script>
<script type="text/javascript">
	$( "form#commentsend" ).submit(function( event ) {
		event.preventDefault();
		$('#comment').empty();
		$('#comments').empty();
	    var comment = $('#comment').val();
	    if((comment == '') || (comment == 'undefined')){
	        comment = $('#comments').val();
	    }
	    var storyid = $('#storyid').val();
		$.post("<?php echo base_url(); ?>index.php/welcome/comment",{'comment':comment,'storyid':storyid},function(output,status){
			$("li#postcmt").prepend(output);
			$("#comment").val('');
			$("#comments").val('');
		});
	});
</script>
<script type="text/javascript">
	function likes(id){
		$.ajax({
			type:"post",
			url:'<?php echo base_url('index.php/welcome/likes'); ?>',
			data:{'sid':id},
			dataType:"json",
			success: function(data){
				console.log('Liked success');
			}
		});
	}
</script>	
<script type="text/javascript">
   var totalWords = document.getElementById("readTime").innerHTML;
   var words= totalWords.split(/\s/g).length;
   var timeToRead = words / 70;
   //alert(words);
   var timeInt = Math.round(timeToRead);
   document.getElementById("time123").innerHTML = timeInt;
</script>


<script>
    function langchang(abcdlang) {
        $('#comment').val('');
		$('#comments').val('');
        if(abcdlang == 'off'){
            $('#comment').css('display','none');
            $('#comments').css('display','block');
            $('#langchang').val('on');
            $('span.langchang').text('On');
        }else{
            $('#comment').css('display','block');
            $('#comments').css('display','none');
            $('#langchang').val('off');
            $('span.langchang').text('Off');
        }
    }
</script>
<script>
$(document).ready(function(){
    var resize = new Array('p','.resizable');
    resize = resize.join(',');
    //resets the font size when "reset" is clicked
    var resetFont = $(resize).css('font-size');
    $(".reset").click(function(){
        $(resize).css('font-size', resetFont);
    });
    //increases font size when "+" is clicked
    $(".increase").click(function(){
        var originalFontSize = $(resize).css('font-size');
        var originalFontNumber = parseFloat(originalFontSize, 10);
        var newFontSize = originalFontNumber*1.2;
        $(resize).css('font-size', newFontSize);
        return false;
    });
    //decrease font size when "-" is clicked
    $(".decrease").click(function(){
        var originalFontSize = $(resize).css('font-size');
        var originalFontNumber = parseFloat(originalFontSize, 10);
        var newFontSize = originalFontNumber*0.8;
        $(resize).css('font-size', newFontSize);
        return false;
    });
});
</script>
<script>
function getSize() {
    size = $(".resizable").css("font-size");
    size = parseInt(size, 10);
    $( "#font-size" ).text(  size  );
}
//get inital font size
getSize();
$( "#up" ).on( "click", function() {
  // parse font size, if less than 50 increase font size
    if ((size + 2) <= 50) {
        $( ".resizable" ).css( "font-size", "+=2" );
        $( "#font-size" ).text(  size += 2 );
    }
});
$( "#down" ).on( "click", function() {
    if ((size - 2) >= 12) {
        $( ".resizable" ).css( "font-size", "-=2" );
        $( "#font-size" ).text(  size -= 2  );
    }
});
</script>
<style>
    .switch {
      position: relative;
      display: inline-block;
      width: 45px;
      height: 20px;
    }
    .switch input { 
      opacity: 0;
      width: 0;
      height: 0;
    }
    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      border-radius: 34px;
      background-color: #ccc;
      -webkit-transition: .4s;
      transition: .4s;
    }
    .slider:before {
      position: absolute;
      content: "";
      height: 20px;
      width: 20px;
      left: 0px;
      bottom: 0px;
      background-color: white;
      border-radius: 50%;
      -webkit-transition: .4s;
      transition: .4s;
    }
    input:checked + .slider {
      background-color: #2196F3;
    }
    input:focus + .slider {
      box-shadow: 0 0 1px #2196F3;
    }
    input:checked + .slider:before {
      -webkit-transform: translateX(26px);
      -ms-transform: translateX(26px);
      transform: translateX(26px);
    }
</style>
<script> // comments
    function deletecomment(commentid){
	    $.ajax({
    		url:'<?php echo base_url();?>index.php/welcome/deletepro_comment/'+commentid,
    		method: 'POST',
    		dataType: "json",
    		success:function(data){
    		    if(data == 1) {
                    $('li.commentdelete'+commentid).css('display','none');
                }
            } 
        });
	}
    function reportcomment(commentid, user_id, story_id){
	    $('#report_comment').modal('show');
	    $('#reportcommentid').val(commentid);
	    $('#report_storyid').val(story_id);
	    $('#report_userid').val(user_id);
	}
	$("form#reportcomment").submit(function( event ) {
		event.preventDefault();
		$.post("<?php echo base_url();?>index.php/welcome/reportcomment",$("form#reportcomment").serialize(),function(resultdata){
			if(resultdata == 2){
				$('span.reportcmt').text('Please Enter your Report Message');
			}else if(resultdata == 1){
			    console.log('success');
			    $('#report_comment').modal('hide');
			}else{
			    console.log('fail');
			}
		});
	});
	
    function editcomment(commentid){
        $('#edit_comment').modal('show');
        $.ajax({
    		url:'<?php echo base_url();?>index.php/welcome/editpro_comment/'+commentid,
    		method: 'POST',
    		dataType: "json",
    		success:function(data){
    			if(data.response[0].comment) {
    			    $('textarea#editcmt').val(data.response[0].comment);
    			    $('#commentid').val(commentid);
               }else{
                   $('#edit_comment').modal('hide');
               }
            } 
        });
    }
    
    $( "form#editcomment" ).submit(function( event ) {
		event.preventDefault();
		var comments = $('textarea#editcmt').val();
		var cid = $('#commentid').val();
		$.post("<?php echo base_url();?>index.php/welcome/updatecomment",{'comment':comments,'cid':cid},function(resultdata){
			if(resultdata == 2){
				$('span.comment').text('Please Enter Comment');
			}else if(resultdata == 1){
			    console.log('success');
			    $('p.pcomment'+cid).html(comments);
			    $('#edit_comment').modal('hide');
			}else{
			    console.log('fail');
			}
		});
	});
	
	function postReplycomment(commentid, storyid){
	    $('div.postreplycomment'+commentid).html('<input type="text" id="replycmts'+commentid+'" value="" class="form-control" placeholder="Replay Comment..." required>'+
	    '<span class="text-danger addreplaycmt'+commentid+'"></span><input type="hidden" name="storyid" value="'+storyid+'">'+
	    '<span class="input-group-btn"><button type="submit" class="btn btn-success btn-flat" onclick="addreplycomment('+commentid+','+storyid+')">POST</button></span>');
	}
	function addreplycomment(commentid, storyid){
	    var comments = $('#replycmts'+commentid).val();
	    if(comments){
	        $.ajax({
        		url:'<?php echo base_url();?>index.php/welcome/addstoryreplycomment',
        		method: 'POST',
        		data: {'comment_id': commentid, 'comment':comments, 'story_id': storyid},
        		dataType: "json",
        		success:function(data){
        		    if(data == 2){
                        $('.addreplaycmt'+commentid).text('Enter your Comments.');
                    }else if(data == 1){
                        $.ajax({
                            url: "<?php echo base_url('index.php/welcome/pro_commentpost'); ?>",
                            type: 'POST',
                            dataType: 'json',
                            success: function(result) {
                                if(result.response){
                                var htmlcomment = '<li style="margin-bottom:10px;" class="commentdelete'+result.response[0].cid+'">'+
                                    '<div class="media"><div class="media-left"><img src="<?php echo base_url();?>assets/images/2.png" style="border-radius: 50%;width:40px;height: 40px;">'+
                                    '</div> <div class="media-body" style="background-color:#ddd; border-radius:5px; padding: 0px 10px;">'+
                                    '<b>'+result.response[0].name+'</b>'+
                                    '<span class="pull-right" onClick="editcomment('+result.response[0].cid+');"><i class="fa fa-pencil"></i> Edit</span>'+
                                    '<span class="pull-right" onClick="deletecomment('+result.response[0].cid+');"><i class="fa fa-trash"></i> Delete</span>'+
                                    '<p class="pcomment'+result.response[0].cid+'">'+result.response[0].comment+'</p></div></div></li>';
                                    $('li.postreplycmt'+result.response[0].comment_id).prepend(htmlcomment);
                                }else{
                                    
                                }
                            }
                        })
                    }else{
                        $('.addreplaycmt'+commentid).text('Failed to Post your Comments.');
                    }
                }
            });
	    }else{
	        $('.addreplaycmt'+commentid).text('Enter your Comments.');
	    }
	}
</script>.

<script>
var didScrolls;
var lastScrollTops = 0;
var deltas = 2;
var sidebarHeight = $('header').outerHeight();

$(window).scroll(function(event){
    didScrolls = true;
});

setInterval(function() {
    if (didScrolls) {
        hasScrolleds();
        didScrolls = false;
    }
}, 250);

function hasScrolleds() {
    var st = $(this).scrollTop();
    
    // Make sure they scroll more than delta
    if(Math.abs(lastScrollTops - st) <= deltas)
        return;
    
    // If they scrolled down and are past the navbar, add class .nav-up.
    // This is necessary so you never see what is "behind" the navbar.
    if (st > lastScrollTops && st > sidebarHeight){
        // Scroll Down
        $('#navbarv').removeClass('sticky').addClass('sticky1');
    } else {
        // Scroll Up
        if(st + $(window).height() < $(document).height()) {
            $('#navbarv').removeClass('sticky1').addClass('sticky');
        }
    }
    
    lastScrollTops = st;
}
</script>
<script>
    var rightButton = $("#right-btn");
    var leftButton = $("#left-btn");
    var container = $("#StoryCont");
    var slideCont = $("#story-slider");
    if($("#story-slider > div").length<5){
      $('#right-btn').hide();
      $('#left-btn').hide();
    }
    var maxcount=$("#story-slider > div").length;
    var marLeft = 0, maxX = maxcount*210, diff = 0 ;
    
    function slide() {
    marLeft-=218;
    if( marLeft < -maxX ){ 
      marLeft = -maxX+183 ;
    }
      slideCont.animate({"margin-left" : marLeft + "px"}, 500);
    }
    
    function slideBack() {
      marLeft +=218;
      if ( marLeft > 0 ) { marLeft = 0 ;}
      slideCont.animate({"margin-left" : marLeft + "px"}, 500);
    }
    rightButton.click(slide);
    leftButton.click(slideBack);
    
    /*touch code from here*/
    
    $(container).on("mousedown touchstart", function(e) {
      
      var startX = e.pageX || e.originalEvent.touches[0].pageX;
      diff = 0;
    
      $(container).on("mousemove touchmove", function(e) {
        
          var xt = e.pageX || e.originalEvent.touches[0].pageX;
          diff = (xt - startX) * 100 / window.innerWidth;
        if( marLeft == 0 && diff > 10 ) { 
          event.preventDefault() ;
        } else if (  marLeft == -maxX && diff < -10 ) {
           event.preventDefault();   
        }
      });
    });
    
    $(container).on("mouseup touchend", function(e) {
      $(container).off("mousemove touchmove");
      if(  marLeft == 0 && diff > 4 ) { 
          sliderCont.animate({"margin-left" :  0 + "px"},100);
       } else if (  marLeft == -maxX  && diff < 4 ){
           sliderCont.animate({"margin-left" : -maxX  + "px"},100);  
       } else {
          if (diff < -10) {
            slide();
          } else if (diff > 10) {
            slideBack();
          } 
      }
    });

</script>