<link rel="stylesheet" href="<?php echo base_url();?>assets/css/new_series.css">
<style>
    span.fa.fa-star-o.checked {
    padding-right: 5px;
}
</style>

<div class="navbar navbar-inverse navbar-static-top" id="navbarv" style="background-color:#23678e;">	
	<div class="navbar-collapse pd-4" style="border:none;">
		<ul class="nav navbar-nav" style="display: -webkit-inline-box;">
			<li class="dropdown se-vj">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="background-color:#23678e;max-width: 300px;text-overflow: ellipsis;overflow: hidden;white-space: nowrap;">
                    <i class="fa fa-bars" aria-hidden="true"></i>
    			    <span class="hidden-xs hidden-sm">
						<?php $seriesftitles = ''; if(isset($seriesftitle) && ($seriesftitle->num_rows() == 1)){ 
    			        foreach($seriesftitle->result() as $seriesftitl){ echo $seriesftitles = $seriesftitl->title;} }else{ echo 'EPISODES';} ?>
					</span>
                </a>
                <ul class="dropdown-menu pull-left scrollable-menu control-sidebar-menu" id="action" style="margin-left:15px; width:280px;height:285px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.1);border-radius: 10px!important;">
                    <h5 style="margin-top: 15px;margin-left: 15px; margin-right: 15px;">
                        <a href="<?php echo base_url();?>new_series?id=<?php echo $_GET['story_id'];?>&story_id=<?php echo $_GET['story_id'];?>" style="color:#3c8dbc;line-height: 1.4em;">
                            <?php echo $seriesftitles; ?>
                        </a>
                    </h5>
                    <hr style="margin:0px; border-color: #f4f4f4; border-width: 1px;">
    			    <?php $i=1; $j=0; foreach($new_episode as $row) { if($j==0) { $rowin='active'; }
    			        if(isset($row->sid) && ($row->sid != $row->story_id) && ($row->type == "series") && ($row->draft != 'draft')){ ?>
        				<li data-target="#myCarousel" data-slide-to="<?php echo $j; ?>" class="li-color">
        					<a href="<?php echo base_url('new_series?id='.$row->sid.'&story_id='.$row->story_id);?>">
        					    <span class="menu-icon bg-light-blue" style="border-radius: 50px; background-color: #000; padding-left: 0px;">
        					       <?php echo $i; ?> </span>
        					    <div class="menu-info">
        					        <h4 class="control-sidebar-subheading" style="overflow: hidden;white-space:pre;text-overflow: ellipsis;-webkit-appearance: none;"><?php echo ucfirst($row->title); ?></h4>
        					    </div>
    					        <small style="font-size:10px;"> &nbsp; &nbsp; <?php echo date("M j, Y", strtotime($row->date));?></small>
        					</a>
        				</li>
        				<hr style="border-color: #edebeb; border-width: 1px; margin: 0px;">
    			    <?php $i++; } } ?>
                </ul>
            </li>
            
            <li class="mg-14" style="background: #23678e; border: none;">
                <?php if(!isset($this->session->userdata['logged_in']['user_id']) || empty($this->session->userdata['logged_in']['user_id'])) { ?>
                    <a style="background:none; border:none;color: #FFF; cursor:pointer" class="subscribe" data-toggle="modal" data-target="#loginmodal" id="notloginmodal"> SUBSCRIBE </a>
                <?php }else{ ?>
                    <?php if(isset($subscriptions) && in_array($_GET['story_id'], $subscriptions)) { ?>
        			    <a style="background:none; border:none;color: #FFF; cursor:pointer" class="subscribe" onclick="unsubscribe(<?php echo $_GET['story_id'];?>)"> SUBSCRIBED </a>
        		    <?php } else { ?>
        		        <a style="background:none; border:none;color: #FFF; cursor:pointer" class="subscribe" onclick="subscribe(<?php echo $_GET['story_id'];?>)"> SUBSCRIBE </a>
        		    <?php } ?>
                <?php } ?>
            </li>
		</ul>
		<ul class="nav navbar-nav pull-right" style="display: inline-flex;">
			<li class="">
			    <?php if(!isset($this->session->userdata['logged_in']['user_id']) || empty($this->session->userdata['logged_in']['user_id'])) { ?>
			        <a class=""  style="background: #23678e; border: none;">
					    <button style="background:none;  border:none;" class="notloginmodal">
			            <i class="fa fa-bookmark"></i> READ LATER </button>
			        </a>
    			<?php }else{ $readlatersids = get_storiesreadlater('readlater');
                    if(isset($readlatersids) && (sizeof($readlatersids)>0) && in_array($_GET['id'], $readlatersids)) { ?>
					<a class="readlaterbtn<?php echo $_GET['id'];?>" style="background: #23678e; border: none;">
					    <button style="background:none; border:none;  height:-webkit-fill-available;color:#fff;" onclick="unreadlater(<?php echo $_GET['id'];?>)" class="notloginmodal readlaterbtnatr<?php echo $_GET['id'];?>">
			            <i class="fa fa-check faicon<?php echo $_GET['id'];?>"></i> READ LATER </button>
			        </a>
        	    <?php } else { ?>
                    <a class="btn btn-success readlaterbtn<?php echo $_GET['id'];?>" style="background: #23678e; border: none;">
    			        <button style="background:none; border:none;  height:-webkit-fill-available;color:#fff;" onclick="readlater(<?php echo $_GET['id'];?>)" class="notloginmodal readlaterbtnatr<?php echo $_GET['id'];?>">
    	                <i class="fa fa-bookmark faicon<?php echo $_GET['id'];?>"></i> READ LATER </button>
	                </a>
                <?php } } ?>
            </li>
			<li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="background-color:#23678e;"><i class="fa fa-share-alt"></i></a>
                <ul class="dropdown-menu pull-right">
                    <li onclick="groupsuggest(<?php echo $_GET['id'];?>);">
						<a data-toggle="modal" href="javascript:void(0);" data-target="#groupsuggest" title="COMMUNITY"><i class="fa fa-users pr-10"></i>COMMUNITY</a>
					</li>
					<li onclick="friend(<?php echo $_GET['id'];?>);">
						<a data-toggle="modal" href="javascript:void(0);" data-target="#friendsuggest" title="SUGGEST"><i class="fa fa-user pr-10"></i>SUGGEST</a>
					</li>
					<li>
						<a data-toggle="modal" data-target="#soc" href="javascript:void(0);" title="SOCIAL MEDIA">
							<i class="fa fa-share-alt pr-10"></i>SOCIAL
						</a>
					</li>
                </ul>
            </li>
			<li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="background-color:#23678e;"><i class="fa fa-ellipsis-v"></i></a>
                <ul class="dropdown-menu pull-right">
                    <li>
                    <?php if(!isset($this->session->userdata['logged_in']['user_id']) || empty($this->session->userdata['logged_in']['user_id'])) { ?>
			            <a href="javascript:void(0);" class="notloginmodal fb-share-button"><i class="fa fa-exclamation pr-10"></i> Report</a>
			        <?php }else if(isset($new_series) && ($new_series->num_rows() > 0)){ foreach($new_series->result() as $row){ ?>
						<a href="javascript:void(0);" class="fb-share-button" onclick="reportseries(<?php echo $row->user_id;?>,<?php echo $row->sid;?>)"> 
    			             <i class="fa fa-exclamation pr-10"></i> Report
    			        </a>
			        <?php } } ?>
					</li>
				</ul>
            </li>
		</ul>
	</div>
</div>

<div class="tops" style="justify-content:center;">
    <div  style="margin:0 auto;">
	    <div class="main-container">
			<div class="" style="display:flex; flex-wrap:wrap;">
				<?php if(isset($new_series) && ($new_series->num_rows() > 0)){ foreach($new_series->result() as $row){ 
					if(isset($this->session->userdata['logged_in']['user_id']) && ($row->user_id == $this->session->userdata['logged_in']['user_id'])){
						header('Location: '.base_url().'new_series_admin?id='.$row->sid.'&story_id='.$row->story_id);
					} ?>
					<div class="sidebox-i-c" style="margin-bottom:20px;">
						<div class="row pt-0">
						    <?php $image='reading.jpg'; if(isset($row->image) && !empty($row->image)) { $image=$row->image;} ?>
							<div class="vjbs"style="background: url(<?php echo base_url();?>assets/images/<?php echo $image; ?>) no-repeat;background-size: 100% 100%;">
							    <div style="background:rgba(0, 0, 0, 0.8);">
                			        <center>
    									<img src="<?php echo base_url();?>assets/images/<?php echo $image; ?>" alt="<?php echo $row->title; ?>" class="img-responsive vjsvi1 img-bv imgs">
    								</center>
							    </div>
							</div>
						</div><br>
						<div class="row pt-0">
							<div class="box box-widget widget-user boxshv boxshv1 profile-img">
								<center>
								<?php if(isset($row->profile_image) && !empty($row->profile_image)) { ?>
									<div class="widget-user-header" style="height:auto;"> 
										<img src="<?php echo base_url();?>assets/images/<?php echo $row->profile_image; ?>" alt="<?php echo $row->name; ?>" class="img-responsive vjsvi img-circle" style="width: 100px; height:90px;">
									</div>
								<?php } else { ?>
									<div class="widget-user-header" style="height:auto;"> 
										<img src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo $row->name; ?>" class="img-responsive vjsvi img-circle" style="width: 100px; height:90px;">
									</div>
								<?php } ?>
								</center>
								<div class="box-footer" style="padding-top:0; border-top:1px solid #cac8c885;">
									<div class="row pt-0">
										<div class="col-sm-12">
											<center><a href="#" style="color:#000"><h4 style="margin-top:10px"><b><?php echo $row->name; ?></b></h4></a></center>
										</div>
										<div class="col-sm-12">
										    <?php if(!isset($this->session->userdata['logged_in']['user_id']) || empty($this->session->userdata['logged_in']['user_id'])) { ?>
										        <button class="btn btn-primary btn-block notloginmodal"> FOLLOW </button>
											<?php }else if(isset($following) && in_array($row->user_id, $following)) { ?>
												<button class="btn btn-primary btn-block unfollow<?php echo $row->user_id;?>" onclick="writerunfollow(<?php echo $row->user_id;?>,'<?php echo $row->name;?>')"> FOLLOWING </button>
											<?php } else { ?>
												<button class="btn btn-success btn-block follow<?php echo $row->user_id;?>" onclick="writerfollow(<?php echo $row->user_id;?>,'<?php echo $row->name;?>')"> FOLLOW </button>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>
							<div class="box box-widget widget-user boxshv boxshv1 profile-imgm">
								<div class="box-footer" style="padding-top:0; border-top:1px solid #cac8c885;">
									<div class="row pt-0">
									    <div style="padding-top:10px;">
										<span class="" style="float:left">
											<a href="#" style="color:#000"><h4 style="margin-top:10px"><b> <?php echo $row->name; ?></b></h4></a>
										</span>
										<span style="float:right">
											<?php if(isset($following) && in_array($row->user_id, $following)) { ?>
												<button style="padding-left:15px; padding-right:15px; margin-top: 2px;" class="btn btn-primary unfollow<?php echo $row->user_id;?>" onclick="writerunfollow(<?php echo $row->user_id;?>,'<?php echo $row->name;?>')"> FOLLOWING </button>
											<?php } else { ?>
												<button style="padding-left:15px; padding-right:15px; margin-top: 2px;" class="btn btn-success follow<?php echo $row->user_id;?>" onclick="writerfollow(<?php echo $row->user_id;?>,'<?php echo $row->name;?>')"> FOLLOW </button>
											<?php } ?>
										</span>
									</div>
									</div>
								</div>
							</div>
						</div><br>
						<div class="row  pt-0">
							<div class="box box-widget widget-user boxshv boxshv1">
								<div class="box-footer">
									<div class="row">
										<div class="col-sm-12" style="padding-top: 10px;">
											<p>Subscribe to this story for free.</p>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6" style="float:left;margin-top:10px;">
											<p style="color:#9e9e9e;" class="subscribers"><?php if(isset($countsubs)){echo count($countsubs);}else{ echo 0; }?> SUBSCRIBERS</p>
										</div>
										<div class="col-sm-6" style="float:right;margin-top:4px; ">
											<?php if(isset($subscriptions) && in_array($_GET['story_id'], $subscriptions)){ ?>
												<button class="btn btn-primary subscribe  pull-right" onclick="unsubscribe(<?php echo $_GET['story_id'];?>)"> SUBSCRIBED </button>
											<?php } else{ ?>
												<button class="btn btn-success subscribe  pull-right" onclick="subscribe(<?php echo $_GET['story_id'];?>)"> SUBSCRIBE </button>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					 <?php $parablock1 = ''; $parablock2 = ''; $parablock3 = ''; $parablock1count = 0; $parablock2count = 0; ?>
					<div class="storyread pd-10-0 storeadpt">
						<div class="box box-widget widget-user boxshv boxshv1"><br>
							<center><h3><b><?php echo $row->title; ?></b></h3></center>
							<div style="padding:20px 20px 0 20px;">
							    <span class="text-right">
							    	<span class="font-size-label" style="display: inline-block; padding-right:15px;">Zoom</span>
							    	<a id="up" class="plus">+</a>
							    	<span id="font-size" style="margin: 0 5px;width: 30px;height: 30px;"></span>
							    	<a id="down"  class="plus">-</a>
							    </span>
							    <?php if(($row->type == 'series') && ($row->sid == $row->story_id)){ 
									$seriesongo_stop = get_seriesongo_stop($row->story_id); if(isset($seriesongo_stop) && !empty($seriesongo_stop)) { ?>
									<span style="float:right"><i class="fa fa-clock-o"></i> <span><?php echo $seriesongo_stop;?></span></span>
								<?php } }else{ ?>
							        <span style="float:right"  class="time_story"><i class="fa fa-clock-o"></i> <span id="time123"></span> నిమిషాల కథ</span>
								<?php } ?>
							</div>
							<ul class="list-inline" style="padding:20px 20px 0 20px; margin-bottom:2px Solid #999;">
								<li><i class="fa fa-eye"></i> 
								    <?php if($_GET['story_id'] == $_GET['id']){ echo $row->seriesviews; }else{ echo $row->views; }  ?></li>
								<li>
									<?php if(isset($reviews) && !empty($reviews)) {
										$starNumber = explode('.',$reviews[0]->rating);
										for($x=1;$x<=$starNumber[0];$x++) { ?>
											<span class="fa fa-star checked" style="color:rgb(60, 141, 188);" title="<?php echo $x; ?>"></span>
										<?php } if(isset($starNumber[1]) && !empty($starNumber[1])) { if ($starNumber[1] != 0) { ?>
											<span class="fa fa-star-half-full checked" style="color:rgb(60, 141, 188);" title="<?php echo $reviews[0]->rating; ?>"></span>
										<?php $x++;} } 
										$abcd = ''; if($starNumber[0] <= 0){ $abcd = 'style="color:rgb(60, 141, 188);"';} 
										while ($x<=5) { echo '<span class="fa fa-star-o checked" style="color:rgb(60, 141, 188);"></span>';$x++;}
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
										<i class="fa fa-comment"  style="color: #337ab7;"></i>
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
									
								<div style="" id="readTime" class="resizable noselect read_story">
									<!-- <?php echo $row->story; ?><br> -->
									<?php if(isset($parablock1) && !empty($parablock1)){ echo $parablock1; } ?>
								</div>
							</div>
							
							<?php if(isset($parablock2) && !empty($parablock2)){ ?>
							<br><div class="box box-widget widget-user boxshv">
									<div style="" id="readTime" class="resizable noselect read_story">
									  <?php echo $parablock2; ?>
									</div>
								</div>
							<?php } if(isset($parablock3) && !empty($parablock3)){ ?>
							<br><div class="box box-widget widget-user boxshv">
									<div style="" id="readTime" class="resizable noselect read_story">
									  <?php echo $parablock3; ?>
									</div>
								</div>
							<?php } ?>
							
							<?php if(isset($_GET['id']) && isset($_GET['story_id']) && ($_GET['story_id'] == $_GET['id'])){ }else { ?>
							<div class="box-footer" style="padding-top:10px;border: 1px solid #d1d1d1;">
								<div class="row pt-0">
									<div class="col-md-4 col-xs-4">
										<?php if(isset($favorites) && in_array($_GET['id'], $favorites)){ ?>
											<span style="cursor:pointer" onclick="unfavorite(<?php echo $_GET['id'];?>)" class="favbtn<?php echo $_GET['id'];?>" title="Favorite">
												<span class="ratings">FAVORITE :</span> <i class="fa fa-heart favbtn fa-2x" style="color:#ff0000; padding-top:5px;"></i> </span>
										<?php } else{ ?>
											<span style="cursor:pointer" onclick="favorite(<?php echo $_GET['id'];?>)" class="favbtn<?php echo $_GET['id'];?>" title="Favorite">
												<span class="ratings">FAVORITE :</span> <i class="fa fa-heart-o favbtn fa-2x" style="color:#333;  padding-top:5px;"></i> </span>
										<?php } ?>
									</div>
									<div class="col-md-4 hidden-xs"></div>
									<div class="col-md-4 text-right col-xs-8"> <span class="ratings">RATING :</span>
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
							<?php } ?>
							<div class="row pt-0">
								<div class="col-md-3 col-xs-6 pd-0" style="margin-top:8px;">
									<button class="btn btn-success btn-texts" id="opens">SEE ALL EPISODES</button>
								</div>
								<div class="col-md-6 hidden-xs"></div>
								<div class="col-md-3 pull-right col-xs-6 pd-0" style="margin-top:8px;">
									<center>
        				        		<?php if(isset($nextepisode)){ foreach($nextepisode as $row) { if($_GET['id'] === $_GET['story_id']){ ?>
        				        		    <a href="<?php echo base_url('new_series?id='.$row->sid.'&story_id='.$_GET['story_id']);?>" class="pull-right">
        				        			<button class="btn btn-success btn-texts"> START READING</button></a>
        				        		<?php } else { ?>
        				        			<a href="<?php echo base_url('new_series?id='.$row->sid.'&story_id='.$_GET['story_id']);?>" class="pull-right">
        				        			<button class="btn btn-success btn-texts"> NEXT EPISODE</button></a>
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
		    	                    	<div class="titlei">Recommended</div>
		    	                    </div>
		    	                </div>
								<hr>
								<div id="StoryCont" class="StoryCont" style="">
				                    <div id="story-slider" class="story-slider series">
							        <?php foreach ($recentseries->result() as $recentstory) { ?>
							            
							                <div class="card">
					                        	<div class="book-type" style="z-index:0"><?php echo $recentstory->gener;?></div>
					                        		<a href="<?php echo base_url('new_series?id='.$recentstory->sid.'&story_id='.$recentstory->story_id);?>">
    					                    		<?php if(isset($recentstory->image) && !empty($recentstory->image)) { ?>
    					                    		    <img src="<?php echo base_url();?>assets/images/<?php echo $recentstory->image; ?>" alt="<?php echo $recentstory->image; ?>" class="imageme">
    					                    		<?php }else{ ?>
    					                    			<img src="<?php echo base_url();?>assets/dist/img/photo1.png" alt="<?php echo $recentstory->image; ?>" class="imageme">
    					                    		<?php } ?>
					                    		</a>
					                        	<div>
					                        		<font class="max-lines">
					                        			<a href="<?php echo base_url('new_series?id='.$recentstory->sid.'&story_id='.$recentstory->story_id);?>">
					                        				<?php echo ($recentstory->title);?>
					                        			</a>
					                        		</font> 
					                        	</div>
					                        	<div class="flextest">
					                        	    <font class="byname">By<font class="namehere"><a href="<?php echo base_url('profile?id='.$recentstory->user_id);?>" style="color:#000"><?php echo $recentstory->name;?></a></font>
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
					                    		<ul class="dropdown-menu list-inline dropvk">
					                    			<li onclick="groupsuggest(<?php echo $recentstory->sid; ?>);">
					                    				<a href="javascript:void(0);" data-toggle="modal" data-target="#groupsuggest" title="COMMUNITY"><i class="fa fa-users"></i></a>
					                    			</li>
					                    			<li onclick="friend(<?php echo $recentstory->sid;?>);">
					                    				<a href="javascript:void(0);" data-toggle="modal" data-target="#friendsuggest" title="SUGGEST"><i class="fa fa-user"></i></a>
					                    			</li>
					                    			<li>
					                    				<a data-toggle="modal" data-target="#soc" href="javascript:void(0);" title="SOCIAL">
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
						
						<div class="vjbs" id="commentv" style="padding:10px;background: #fff; margin-top:50px">
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
    									<!--<li class="">-->
    										<div class="">
    											<div class="box-footer padding-0 box-comments commentdelete<?php echo $comment->cid;?>" style="padding-bottom:0px;">
    											    <div class="box-comment">
    												    <?php if(!empty($comment->profile_image)){ ?>
    													<img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $comment->profile_image;?>" style="border-radius: 50%;width:40px;height:40px;" alt="<?php echo $comment->name;?>">
    												    <?php } else{ ?>
    													<img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" style="border-radius: 50%;width:40px;height:40px;" alt="<?php echo $comment->name;?>">
    												    <?php } ?>
    												    <div class=" comment-text">
        											        <span class="username" style="padding-top:6px;">&nbsp;<?php echo ucfirst($comment->name); ?>
        											            <span class="dropdown" style="float:right;">
            											            <a href="javascript:void(0);" class="dropdown-toggle elli" data-toggle="dropdown" aria-expanded="false">
                												        <i class="fa fa-ellipsis-v"></i>
                												    </a>
                												    <ul class="dropdown-menu pull-right">
                												        <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($this->session->userdata['logged_in']['user_id'] == $comment->user_id)){ ?>
                    												        <li>
                    												            <a href="javascript:void(0);" onclick="deletecomment(<?php echo $comment->cid;?>);"><span><i class="fa fa-trash"></i> Delete </span></a></li>
                        					                                <li><a href="javascript:void(0);" onclick="editcomment(<?php echo $comment->cid;?>);"><span><i class="fa fa-pencil"></i> Edit </span></a></li>
                        		                                        <?php }else{ ?>   
                        					                                <li><a href="javascript:void(0);" onClick="reportcomment(<?php echo $comment->cid;?>, <?php echo $comment->user_id;?>, <?php echo $comment->story_id;?>);"><span><i class="fa fa-exclamation-triangle"></i> Report </span></a></li>
                                                                        <?php } ?>
                                                                    </ul>
                                                                </span>
                                                                <span class="text-muted pull-right datecv"><?php echo get_ydhmdatetime($comment->date);?></span>
                                                            </span>
        											    </div>
        											    <div class="comment-text" style="margin:8px 0px 6px 2px">
        											        <div class=" more pcomment<?php echo $comment->cid;?>" style="word-break:break-word;"><?php echo $comment->comment; ?></div>
        											        <div style=" margin:5px 0px;">
        											            <a href="javascript:void(0)" onClick="postReplycomment(<?php echo $comment->cid;?>, <?php echo $comment->story_id;?>)" class="pull-left replycv" title="reply">REPLY </a>
        											            <a href="javascript:void(0)" onClick="postReplycomment(<?php echo $comment->cid;?>, <?php echo $comment->story_id;?>)" class="pull-left replycv" title="reply">| 0 REPLIES </a>
        											        </div>
        											    </div><br>
        											    <div class="comment-text">
        											        <div class="input-group postreplycomment<?php echo $comment->cid;?>" style="margin-bottom:5px;"></div>
        											    </div>
    										        </div>
    												
    												
    												
    												<div class="subcomments" style="margin-bottom:10px;" id="mysublist<?php echo $comment->story_id, $comment->cid;?>">
        												<?php $replaycomments = get_replaycomments($comment->story_id, $comment->cid); ?>
        												<?php if(isset($replaycomments) && ($replaycomments->num_rows() > 0 )) { ?>
        													<ul style="list-style: none; padding:0px; margin-top:15px; margin-left:15px;">
        														<li class="postreplycmt<?php echo $comment->cid;?>"></li>
        													<?php foreach($replaycomments->result() as $replaycomment) { ?>
        														<div style="margin-bottom:15px;" class="media commentdelete<?php echo $replaycomment->cid;?>">
        															<!--<div class="media" style="background: #77777745; border-radius: 5px;">-->
                                                                        <span class="media-left">
        																	<?php if(!empty($replaycomment->profile_image)){ ?>
        																		<img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $replaycomment->profile_image;?>" style="width:25px;" alt="<?php echo ucfirst($replaycomment->name); ?>">
        																	<?php } else{ ?>
        																		<img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" style="width:25px;" alt="<?php echo ucfirst($replaycomment->name); ?>">
        																	<?php } ?>
        																</span>
        																	<span class="media-body bodycv">
        																	    <div class="">
            																	    <span class="">&nbsp;<b><?php echo ucfirst($replaycomment->name); ?></b>
                        																<span class="dropdown pull-right" style="padding: 0px 10px 0px 20px;">
                            																<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" title="write" aria-expanded="false">
                            										                            <i class="fa fa-ellipsis-v"></i>
                            										                        </a>
                            										                        <ul class="dropdown-menu pull-right">
                            										                            <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($this->session->userdata['logged_in']['user_id'] == $replaycomment->user_id)){ ?>
                                										                            <li><a href="javascript:void(0);" onClick="editcomment(<?php echo $replaycomment->cid;?>);"><i class="fa fa-pencil"></i> EDIT </a></li>
                                                    				                                <li><a href="javascript:void(0);" onClick="deletecomment(<?php echo $replaycomment->cid;?>);"><i class="fa fa-trash"></i> DELETE </a></li>
                                                					                        	<?php }else{ ?>
                            																	    <li><a href="javascript:void(0);" onClick="reportcomment(<?php echo $replaycomment->cid;?>, <?php echo $replaycomment->user_id;?>, <?php echo $replaycomment->story_id;?>);"><i class="fa fa-exclamation-triangle"></i> REPORT </a></li>
                            																	<?php } ?>
                            																</ul>
                        																</span>
                        																<span class="text-muted pull-right datecv"><?php echo get_ydhmdatetime($replaycomment->date);?></span>
                        															</span><br>
            												                    <!--</div>-->
            															            <span class="more pcomment<?php echo $replaycomment->cid;?>" style="padding-left:6px;word-break:break-word;"><?php echo $replaycomment->comment; ?></span>
            															         </div>
            															    </span>
            														<!--</div>-->
        													    </div>
        													<?php } ?> 
        												</ul>
        												<?php } else{ ?>
        													<ul style="list-style: none; padding:0px; margin-top:15px;">
        														<li class="postreplycmt<?php echo $comment->cid;?>"></li>
        													</ul>
        												<?php } ?>
        											</div>
    											</div>
    										</div>
    									<!--</li> -->
    								<?php } } ?>
    								</ul>		
    							</div>
					    	</div>
					    </div>
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
			        transliterationControl.c.qc.t13n.c[3].c.d.keyup[0].ia.F.p = 'https://www.google.com';  // https ssl activation 
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
			
	    </div>
	</div>
</div>


<!-- Social Popup ---- -->
<div class="modal fade" id="soc">
	<div class="modal-dialog">
		<div class="modal-content socv ">
			<div class="modal-header" style="padding:8px 15px;">
				<button type="button" class="close" style="color:#000; opacity:initial; margin-top:2px;" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h5 class="modal-title text-center" style="color:#808182;">SOCIAL MEDIA SHARE</h5>
			</div>
			<div class="modal-body" style="padding-top:5px;">
				<div class="row">
					<div class="col-md-12 pd-5v">
						<a href="javascript:void(0);" onclick="javascript:genericSocialShare('http://www.facebook.com/sharer.php?u=<?php echo $ogurl;?>')">
						    <img src="<?php echo base_url();?>assets/svg/fb.svg" style="width:40px; height:40px;"/>
						    <span style="padding-left:5px; font-size:18px;">Faceebok</span>
					    </a>
					</div>
					<div class="col-md-12 pd-5v">
						<a href="javascript:void(0);"><img src="<?php echo base_url();?>assets/svg/wa.svg" style="width:40px; height:40px;"/> <span style="padding-left:5px; font-size:18px;">Whatsapp</span></a>
					</div>
					<div class="col-md-12 pd-5v">
						<a href="javascript:void(0);"><img src="<?php echo base_url();?>assets/svg/twitter.svg" style="width:40px; height:40px;"/> <span style="padding-left:5px; font-size:18px;">Twitter</span></a>
					</div>
					<div class="col-md-12 pd-5v">
						<a href="javascript:void(0);"><img src="<?php echo base_url();?>assets/svg/link.svg" style="width:40px; height:40px;"/> <span style="padding-left:5px; font-size:18px;">Copy to link</span></a>
					</div>
				</div>
			</div>
		</div>
	<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<script type="text/javascript">
function genericSocialShare(url){
    window.open(url,'sharer','toolbar=0,status=0,width=648,height=395');
    return true;
}
</script>
<!-- /.modal -->
<!-- Social popup ---- -->
<!-- group suggest popup code ---- -->
<div class="modal fade" id="groupsuggest" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
		    <div class="storysuggesttogroup"></div>
		</div>
	</div>
</div>
<!-- group suggest popup code ----------- -->
<!-- frind popup code ------>
<div class="modal fade" id="friendsuggest" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
		    <div class="storysuggesttofriend"></div>
		</div>
	</div>
</div>
<!--frind popup end ------------->

<!--report stories popup end ------------->
<div class="modal fade" id="reportstories" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
		    <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><b>Report Story</b></h4>
			</div>
			<div class="modal-body">
    		    <input type="hidden" id="reportuserid">
    		    <input type="hidden" id="reportstoryid">
    		    <input type="hidden" id="reportstorytype" value="story">
    		    <textarea id="reportmsg" class="form-control"></textarea> <br>
    		    <center><button class="btn btn-danger" Onclick="reportstoriesdiv();"> Report </button></center>
            </div>
		</div>
	</div>
</div>
<!--report stories popup end ------------->


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
					<input type="hidden" name="report_storytype" value="series_comment" id="report_storytype">
					<br>
					<center>
					    <button class="btn btn-primary" type="submit"> Submit </button>
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


<!--<script src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script> -->
<style>
    .show{
        display: block;
    }
    .hide{
        display: none;
    }
</style>
<script>//dropdown opens on all episodes
$('document').ready(function() {
    $("#opens").on("click", function() {
        //$("#action").toggle();
        var showhide = $("#action").css("display");
        //alert(showhide);
        if(showhide == 'none'){
            $("#action").addClass('show');
        }else if(showhide == 'block'){
             $("#action").removeClass('show');
        }
    });
    
    $('li.dropdown.se-vj').click( function(){
        if($('ul#action').hasClass('show')){
            $("#action").removeClass('show');
        }
    });
    // Close the dropdown if the user clicks outside of it
    window.onclick = function(event) {
        if (!event.target.matches('#opens')) {
            var dropdowns = document.getElementsByClassName("control-sidebar-menu");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }
});
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
		//$.post("<?php echo base_url();?>index.php/welcome/reportcomment",$("form#reportcomment").serialize(),function(resultdata){
		$.post("<?php echo base_url();?>index.php/welcome/reportstoriescomment",$("form#reportcomment").serialize(),function(resultdata){
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
                                    $('#replycmts'+commentid).val('');
                                    var profileimage = "<?php echo $this->session->userdata['logged_in']['profile_image'];?>";
                                    if(profileimage){ }else{ profileimage = '2.png'; }
                                    var htmlcomment = '<li style="margin-bottom:10px;padding-left:0px;" class="commentdelete'+result.response[0].cid+'">'+
                                        '<div class="box-header with-border" style="background: #77777745; border-radius: 5px;">'+
                                        '<div class="user-block"><img class="image-circle" src="<?php echo base_url();?>assets/images/'+profileimage+'" style="border-radius: 50%;width:40px;height:40px;" alt="'+result.response[0].name+'">'+
                                        '<span class="username"><a href="javascript:void(0);">'+result.response[0].name+'</a>'+
                                        '<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">'+
    					                '<i class="fa fa-ellipsis-v pull-right"></i></a><ul class="dropdown-menu dv1">'+
    	                                    '<li><a href="javascript:void(0);" onClick="editcomment('+result.response[0].cid+');"><i class="fa fa-pencil"></i> Edit </a></li>'+
    	                                    '<li><a href="javascript:void(0);" onClick="deletecomment('+result.response[0].cid+');"><i class="fa fa-trash"></i> Delete </a></li>'+
    	                                '</ul></span><span class="description">1 minute ago</span>'+
    				                    '</div><p class="pcomment'+result.response[0].cid+'">'+result.response[0].comment+'</p> </div></li>'; ///'+result.response[0].date+'
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
</script>

<script>
var didScrolls;
var lastScrollTops = 0;
var deltas = 5;
var sidebarHeight = $('header').outerHeight();

$(window).scroll(function(event){
    didScrolls = true;
});

setInterval(function() {
    if (didScrolls) {
        hasScrolleds();
        didScrolls = false;
    }
}, 350);

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