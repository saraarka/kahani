<link rel="stylesheet" href="<?php echo base_url();?>assets/css/profileviewall.css">
    <?php $readlatersids = get_storiesreadlater('readlater'); ?>
    <div class="pd-l margintop">
        <?php $profile_name = ''; if(isset($writer_profile) && ($writer_profile->num_rows() >0)){ foreach($writer_profile->result() as $row) {
            $profile_name = $row->profile_name; ?>
        <section class="content pv-0">
            <div class="row pt-0">
	            <div class="col-md-12 pd-0">
	                <div class="box box-widget widget-user-2 ovv">
	                <?php $banner_image = '1.jpg'; if(isset($row->banner_image) && !empty($row->banner_image)){ 
	                    $banner_image = $row->banner_image; } ?>
                        <div class="widget-user-header ovv  profile1 bgvv" style="background: url('<?php echo base_url();?>assets/images/<?php echo $banner_image; ?>')center center;background-repeat: no-repeat; background-size: auto;background-size: cover; padding:0px;">
                            <div style="background-color:rgba(0, 0, 0, 0.55); background-repeat: no-repeat;background-size: cover; padding: 80px 30px; height: 250px;">
				                <div class="widget-user-image">
                                    <?php  if(isset($row->profile_image) && !empty($row->profile_image)) { ?>
                                        <img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $row->profile_image; ?>" style="width:85px;" alt="<?php echo $row->name;?>">
                                    <?php } else { ?>
                                        <img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" style="width:85px;" alt="<?php echo $row->name;?>">
                                    <?php } ?>
                                </div>
					             <h3 class="widget-user-username clrvk" style="color:#fff; margin-left:100px;"><b>
					                 <a href="<?php echo base_url().$this->uri->segment(1).'/'.$row->profile_name;?>" style="color:#fff;"><?php echo $row->name;?></a> </b> </h3>
					             <?php if($row->user_activation == 1){ ?>
					                 
			                     <?php } ?>
					             <h5 class="widget-user-desc clrvk" style="color:#fff; margin-left:100px;">@<?php echo $row->profile_name;?></h5>
					        </div>
					    </div>
					       <center>
                                <div class="widget-user-header ovv profile2" style="padding:0px; background: url('<?php echo base_url();?>assets/images/<?php echo $banner_image; ?>') center center;background-repeat: no-repeat;background-size: cover;">
                                    <div style="background-color:rgba(0, 0, 0, 0.55); background-repeat: no-repeat;background-size: cover; padding: 40px 30px;">
                                        <div class="widget-user-image" style="justify-content:center;">
                                            <?php  if(isset($row->profile_image) && !empty($row->profile_image)) { ?>
                                                <img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $row->profile_image; ?>" alt="<?php echo $row->name;?>" style="width:85px; float:none; justify-content:center;">
                                             <?php } else { ?>
                                                <img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo $row->name;?>" style="width:85px;float:none; justify-content:center;">
                                            <?php } ?>
                                        </div><!-- /.widget-user-image -->
                                        <h3 class="" style="color:#fff;"><b>
                                            <a href="<?php echo base_url().$this->uri->segment(1).'/'.$row->profile_name;?>"><?php echo $row->name;?></a></b></h3>
                                        <h5 class="" style="color:#fff;">@<?php echo $row->profile_name;?></h5>
                                    </div>
                                </div>
                            </center>
			            </div>	
				        <div class="box-footer">
					        <div class="row pt-0">
					            <div class="col-sm-2 col-xs-4 col-md-4 col-lg-2 pd-0 hidden-sm hidden-xs hidden-md hidden-lg"></div>
    							<div class="col-sm-4 col-xs-4 col-md-4 col-lg-2 border-right pd-0">
        							<div class="description-block">
        								<h5 class="description-header"><?php echo $row->count;?></h5>
        								<span class="description-text">Writings</span>
        							</div>
    							</div>
    							<div class="col-sm-4 col-xs-4 col-md-4 col-lg-2 border-right pd-0">
        							<div class="description-block">
        								<a href="#" data-toggle="modal" data-target="#modal-defaultf">
            								<h5 class="description-header" id="follcount<?php echo $row->user_id;?>">
            								<?php $abcdfollowers = 0; if(isset($follow_count) && ($follow_count->num_rows()>0)){
            								    foreach($follow_count->result() as $reviews2){ 
            								        if($reviews2->writer_id == $row->user_id) { 
            								            $abcdfollowers = $reviews2->follo; 
            								        }
            								    }
            								} ?>
            								<?php echo $abcdfollowers;?>
            								</h5>
            								<span class="description-text">FOLLOWERS</span>
        								</a>
        							</div>
    							</div>
								<!-- Modelpop up -->
    							<div class="modal fade" id="modal-defaultf">
    								<div class="modal-dialog">
    									<div class="modal-content modalf">
        									<div class="modal-body" style="padding:0">
    											<ul class="nav nav-tabs">
    												<li class="active"><a href="#tab_1" data-toggle="tab"><b>Followers</b></a></li>
    												<li><a href="#tab_2" data-toggle="tab"><b>Following</b></a></li>
    												<li class="pull-right" style="margin-right:10px;"><button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:10px;">
        												<span aria-hidden="true">&times;</span>
        										        </button>
									                </li>
    											</ul>
									            <div class="tab-content modal-bodyv">
										            <div class="tab-pane active" id="tab_1">
											            <div class="box-header with-border">
												            <div class="row" style="margin:0 -10px;">
													            <?php if(isset($followers_names) && ($followers_names->num_rows() > 0)){
													                foreach($followers_names->result() as $followerskey) { ?>
												                        <div class="">
													                        <div class="user-block" style="padding:0 10px; display:flex;">
												                                <span style="width:15%;">
    												                                <?php if(isset($followerskey->profile_image) && !empty($followerskey->profile_image)) { ?>
    													                                <img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $followerskey->profile_image; ?>" alt="<?php echo $followerskey->name;?>">
                    																<?php } else { ?>
                    																	<img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo $followerskey->name;?>">
                    																<?php } ?>
                    															</span>
            																    <span  class="username" style="padding-top:8px;width:52%;margin-left:2px;">
            																        <a href="<?php echo base_url($this->uri->segment(1).'/'.$followerskey->profile_name);?>" style="margin-left:5px;" class="max-linesf"><?php echo $followerskey->name;?></a>
            																    </span>
            																    <span class="pull-right" style="width:33%;padding-top:6px;">
                                            										<?php if(isset($this->session->userdata['logged_in']['user_id']) && ($this->session->userdata['logged_in']['user_id'] == $followerskey->user_id)){ ?>
                                                                                        <button class="pull-right vjw btn btn-success" onclick="yoursfollow()"> FOLLOW </button>
                                                                                    <?php } else { ?>
                                                                                        <?php if(isset($following) && in_array($followerskey->user_id, $following)) { ?>
                                                                                            <button class="pull-right vjw btn btn-primary notloginmodal unfollow<?php echo $followerskey->user_id;?>" onclick="writerunfollow(<?php echo $followerskey->user_id;?>,'<?php echo $followerskey->name;?>')"> FOLLOWING </button>
                                                                                        <?php } else { ?>
                                                                                            <button class="pull-right vjw btn btn-success notloginmodal follow<?php echo $followerskey->user_id;?>" onclick="writerfollow(<?php echo $followerskey->user_id;?>,'<?php echo $followerskey->name;?>')"> FOLLOW </button>
                                                                                        <?php } ?>
                                                                                    <?php } ?>
            																    </span>
													                        </div>
												                        </div><hr style="margin-bottom:8px;">
												                    <?php } } else { ?>
													                    <center> <h3> You do not have followers. </h3></center>
                   									            <?php } ?>
												            </div>
											            </div>
										            </div>
										            <div class="tab-pane" id="tab_2">
        												<div class="box-header with-border">
        													<div class="row" style="margin:0 -10px;">
        														<?php if(isset($following_names) && ($following_names->num_rows() > 0)) {
        														    foreach($following_names->result() as $followingkey) { ?>
            														<div class="">
            															<div class="user-block" style="padding:0 10px; display:flex;">
											                                <span style="width:15%;">
                															    <?php if(isset($followingkey->profile_image) && !empty($followingkey->profile_image)) { ?>
                																    <img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $followingkey->profile_image; ?>" alt="<?php echo $followingkey->name;?>">
                																<?php } else { ?>
                																	<img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo $followingkey->name;?>">
                																<?php } ?>
                															</span>
            																<span  class="username" style="padding-top:8px;width:52%;margin-left:2px;">
            																	<a href="<?php echo base_url($this->uri->segment(1).'/'.$followingkey->profile_name);?>" style="margin-left:5px;" class="max-linesf"><?php echo $followingkey->name;?></a>
            																</span>
            																<span class="pull-right" style="width:33%;padding-top:6px;">
            																    <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($this->session->userdata['logged_in']['user_id'] == $followingkey->user_id)){ ?>
                                                                                    <button class="pull-right vjw btn btn-success" onclick="yoursfollow()"> FOLLOW </button>
                                                                                <?php } else { ?>
                                                                                    <?php if(isset($following) && in_array($followingkey->user_id, $following)) { ?>
                                                                                        <button class="pull-right vjw btn btn-primary notloginmodal unfollow<?php echo $followingkey->user_id;?>" onclick="writerunfollow(<?php echo $followingkey->user_id;?>,'<?php echo $followingkey->name;?>')"> FOLLOWING </button>
                                                                                    <?php } else { ?>
                                                                                        <button class="pull-right vjw btn btn-success notloginmodal follow<?php echo $followingkey->user_id;?>" onclick="writerfollow(<?php echo $followingkey->user_id;?>,'<?php echo $followingkey->name;?>')"> FOLLOW </button>
                                                                                    <?php } ?>
                                                                                <?php } ?>
            																</span>
            															</div>
            														</div><hr style="margin-bottom:8px;">
													            <?php } } else { ?>
														            <center> <h3> You do not following anyone </h3></center>
                   									            <?php } ?>
        													</div>
        												</div>
        											</div>
									            </div>
								            </div>
								        </div><!-- /.modal-content -->
							        </div><!-- /.modal-dialog -->
    						    </div><!-- /.modal -->
    							<div class="col-sm-4 col-xs-4 col-md-2 border-right profile1">
        							<div class="description-block">
        								<h5 class="description-header"><?php echo $row->storiesviewcount;?></h5>
                                        <span class="description-text">Views</span>
        							</div>
        						</div>
    							<div class="col-sm-6 col-xs-6 col-md-4 col-lg-3 profile1">	</div>
    							<div class="col-sm-4 col-xs-4 col-md-4 col-lg-3 pd-0">
    							    <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($this->session->userdata['logged_in']['user_id'] == $row->user_id)){ ?>
        							<div class="description-block  profile1" style="float:right; margin-top:14px; cursor:pointer;">
        								<a href="<?php echo base_url().$this->uri->segment(1);?>/my_profile/<?php echo $this->session->userdata['logged_in']['user_id'];?>" style="color:#fff;" class="btn btn-successv">Edit Profile</a>
        							</div>
    								<span class="profile1" style="padding-left:25px;"><a href="" class=""></a></span>
    								
    								<div class="description-block profile2 btnv" style="padding-top:4px; cursor:pointer;">
        								<a href="<?php echo base_url().$this->uri->segment(1);?>/my_profile/<?php echo $this->session->userdata['logged_in']['user_id'];?>" style="color:#fff;" class="btn btn-successv">Edit Profile</a>
        							</div>
        							<?php } else { ?>
        							<div class="description-block profile1 pull-right" style="width:33%;padding-top:6px;">
                                        <?php if(isset($following) && in_array($row->user_id, $following)) { ?>
                                            <button class="btn btn-primaryv notloginmodal unfollow<?php echo $row->user_id;?>" onclick="writerunfollow(<?php echo $row->user_id;?>,'<?php echo $row->name;?>')" > FOLLOWING </button>
                                        <?php } else { ?>
                                            <button  class="btn btn-successv notloginmodal follow<?php echo $row->user_id;?>" onclick="writerfollow(<?php echo $row->user_id;?>,'<?php echo $row->name;?>')"> FOLLOW </button>
                                        <?php } ?>
								    </div>
        							<div class="description-block profile2 btnv" style="padding-top:5px; cursor:pointer;">
                                        <?php if(isset($following) && in_array($row->user_id, $following)) { ?>
                                            <button class="btn btn-primaryv notloginmodal unfollow<?php echo $row->user_id;?>" onclick="writerunfollow(<?php echo $row->user_id;?>,'<?php echo $row->name;?>')" > FOLLOWING </button>
                                        <?php } else { ?>
                                            <button  class="btn btn-successv notloginmodal follow<?php echo $row->user_id;?>" onclick="writerfollow(<?php echo $row->user_id;?>,'<?php echo $row->name;?>')"> FOLLOW </button>
                                        <?php } ?>
								    </div>
								    <?php } ?>
    							</div>
					        </div>
				        </div>
		            </div>
	            </div>
	        </div>
        </section>
        <?php }  } ?>
        
        
        <section class="content" style="pdding-top:15px;">
          <div class="" style="display:flex; flex-wrap:wrap;">
                <div class="sidebar side1">
                    <?php if(isset($writer_profile) && ($writer_profile->num_rows() > 0)){ foreach($writer_profile->result() as $row) { ?>
        			    <div class="box box-widget widget-user vjc"> <h4>About</h4>
                            <p><?php echo $row->aboutus; ?></p>
                            <?php if($row->uemailstatus == 'public') { ?>
                                <div class="row" style="border-top:1px solid #eee; padding-top:10px; margin-top:5px;">
                                    <div class="col-md-12"><label><i class="fa fa-envelope"> </i></label> <?php echo $row->email; ?></div>
                                </div>
                            <?php } if($row->uphonestatus == 'public') { ?>
                                <div class="row" style="border-top:1px solid #eee; padding-top:10px; margin-top:5px;">
                                    <div class="col-md-12"><label><i class="fa fa-phone"> </i></label> <?php echo $row->phone; ?></div>
                                </div>
                            <?php } ?>
                        </div>
        		    <?php } } ?><br>
        			<h3> Comment On Your Profile</h3>
				    <div class="" style="min-width:279px; width:100%; padding:10px; background:#fff; box-shadow: 1px 1px 1px rgba(0,0,0,0.1);">
    					<div class="box-comment">
    						<form action="#" method="POST" id="profilecomments">
    							<div class="img-push"> 
    							    <div class="" style="display:flex;">
    									<div class="" style="width:80%">
                                           <textarea class="form-control input-sm" name="pro_comment" id="pro_comment" placeholder="Please Enter comments here...." required  style="resize:none;"></textarea>
                                           <input type="hidden" name="profile_id" id="profile_id" value="<?php echo $userid; ?>">
                                           <input type="hidden" name="comment_id" id="comment_id" value="">
                                        </div>
                                        <div class=""  style="width:20%; padding-left:10px;">
                                            <button class="btn btn-success" style="margin-top: 8px;"><i class="fa fa-envelope" aria-hidden="true"></i></button>
                                        </div>
                                    </div>
    							</div>
    						</form><br>
    					</div>
    					<!--<div class="commentslist">
                            <ul id="commentresults" style="padding:0px;"></ul>
                        </div>-->
                        <div class="commentslist pcmtmwidth">
                            <ul id="commentresults" style="padding:10px 0px 0px;" class="pcmtfwidth"></ul>
                        </div>
                        <span id="loadingcomments">
                            <!--<center><img src="<?php echo base_url();?>assets/images/imgs/loading.gif"></center>-->
                        </span>
				    </div>
                </div>
            
                <div class="main-container1">
                    <div class="tab-content">
                        <?php if(isset($profileviewall) && ($profileviewall->num_rows() > 0) && isset($type) && ($type == 'series')){ ?>
                            <div class="row pv-0" style="margin-top:20px;">
        		                <div class="col-md-6 col-xs-8">
        			            	<div class="titlei">SERIES</div>
        			            </div>
        			            <div class="col-md-6 col-xs-4">
        			            	<a href="<?php echo base_url().$this->uri->segment(1).'/'.$profile_name;?>" class="view pull-right">
        			            	    <div class="pull-right">BACK</div>
        			            	</a>
        			            </div>
        			        </div>
                            <hr>
                            <div class="jc-m" id="loadmoreall" style="display:flex; flex-wrap:wrap; justify-content:center;">
                                <?php foreach($profileviewall->result() as $vaseriesrow){ ?>
                                    <div class="cardls">
        	                    		<div class="book-typels"><?php echo $vaseriesrow->gener;?></div>
        	                    		<a href="<?php echo base_url($this->uri->segment(1).'/series/'.preg_replace('/\s+/', '-', $vaseriesrow->title).'-'.$vaseriesrow->sid.'/'.preg_replace('/\s+/', '-', $vaseriesrow->title).'-'.$vaseriesrow->story_id);?>">
        	                    			<?php if(isset($vaseriesrow->image) && !empty($vaseriesrow->image)) { ?>
        	                    			    <img src="<?php echo base_url();?>assets/images/<?php echo $vaseriesrow->image; ?>" alt="<?php echo ($vaseriesrow->title);?>" class="imagemels">
        	                    			<?php }else{ ?>
        	                    				<img src="<?php echo base_url();?>assets/default/series-stories.jpg" alt="<?php echo ($vaseriesrow->title);?>" class="imagemels">
        	                    			<?php } ?>
        	                    		</a>
        	                    		<div>
        	                    			<font class="max-linesls">
        	                    				<a href="<?php echo base_url($this->uri->segment(1).'/series/'.preg_replace('/\s+/', '-', $vaseriesrow->title).'-'.$vaseriesrow->sid.'/'.preg_replace('/\s+/', '-', $vaseriesrow->title).'-'.$vaseriesrow->story_id);?>">
        	                    					<?php echo ($vaseriesrow->title);?>
        	                    				</a>
        	                    			</font> 
        	                    		</div>
        	                    		<div class="flextestls">
        	                    			<font class="bynamels">By<font class="namehere"><a href="<?php echo base_url($this->uri->segment(1).'/'.$vaseriesrow->profile_name);?>" style="color:#000"><?php echo $vaseriesrow->name;?></a></font></font>
        	                    			<br>
        	                    		</div>
        	                    		<div class="flextestls" style="padding-top:4px;">
        	                    			<font class="episodesls">
        	                    				<?php $keycount = get_episodecount($vaseriesrow->sid); 
        	                    				if(isset($keycount)){ echo $keycount; }else{ echo 0; }?> EPISODES | <?php $subsmemcount = get_storysubscount($vaseriesrow->sid); 
        	                    				if(isset($subsmemcount)){echo $subsmemcount; }else{echo 0; } ?> MEMBERS
        	                    			</font><br>
        	                    		</div>
        	                    		<div class="flextestls" style="padding-top:6px">
        	                    			<?php if(isset($this->session->userdata['logged_in']['user_id']) && ($vaseriesrow->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
        	                    				
        	                    					<button class="readls" onclick="yoursreadlater();"><i class="fa fa-bookmark"></i> Read later </button>
        	                    				
        	                    			<?php }else{ ?>
        	                    				<?php if(isset($readlatersids) && (sizeof($readlatersids)>0) && in_array($vaseriesrow->sid, $readlatersids)) { ?>
        	                    					<button onclick="unreadlater(<?php echo $vaseriesrow->sid;?>)" class="readdone notloginmodal readlaterbtnatr<?php echo $vaseriesrow->sid;?>">
        	                    					<i class="fa fa-check faicon<?php echo $vaseriesrow->sid;?>"></i> Read later </button>
        	                    				<?php }else { ?>
        	                    					<button onclick="readlater(<?php echo $vaseriesrow->sid;?>)" class="readls notloginmodal readlaterbtnatr<?php echo $vaseriesrow->sid;?>">
        	                    					<i class="fa fa-bookmark faicon<?php echo $vaseriesrow->sid;?>"></i> Read later </button>
        	                    				<?php } ?>
        	                    			<?php } ?>
        	                    			
        	                    			<button type="button" class="btn readls dropdown-toggle pull-right" data-toggle="dropdown">
        	                    				<span class=""><i class="fa fa-plus"></i></span>
        	                    			</button>
        	                    			<ul class="dropdown-menu list-inline dropvk">
        	                    				<li onclick="groupsuggest(<?php echo $vaseriesrow->sid; ?>);">
        	                    					<a data-toggle="modal" data-target="#groupsuggest" title="COMMUNITY"><i class="fa fa-users"></i></a>
        	                    				</li>
        	                    				<li onclick="friend(<?php echo $vaseriesrow->sid;?>);">
        	                    					<a data-toggle="modal" data-target="#friendsuggest" title="SUGGEST"><i class="fa fa-user"></i></a>
        	                    				</li>
        	                    				<li onclick="socialshare(<?php echo $vaseriesrow->sid;?>, 'series');">
        	                    					<a data-toggle="modal" data-target="#soc" href="" title="SOCIAL">
        	                    						<i class="fa fa-share-alt"></i>
        	                    					</a>
        	                    				</li>
        	                    			</ul>
        	                    		</div>
        	                    	
        	                    	</div>
                                <?php } ?>
                            </div>
                            <div id="load_data_message"></div>
                        <?php } else if(isset($profileviewall) && ($profileviewall->num_rows() > 0) && isset($type) && ($type == 'story')){ ?>
            	            <div class="row pv-0" style="margin-top:20px;">
        		                <div class="col-md-6 col-xs-8">
        			            	<div class="titlei">STORIES</div>
        			            </div>
        			            <div class="col-md-6 col-xs-4">
    			            	    <a href="<?php echo base_url().$this->uri->segment(1).'/'.$profile_name;?>" class="view pull-right">
    			            	        <div class="pull-right">BACK</div> 
    			            	    </a>
    			                </div>
    			            </div>
            	            <hr>
            	            <div class="">
                    			<div class="jc-m" id="loadmoreall" style="display:flex; flex-wrap:wrap; justify-content:center;">
                        			<?php foreach($profileviewall->result() as $vastorysrow) { ?>
                        		    	<div class="card">
    				                    	<div class="book-type"><?php echo $vastorysrow->gener;?></div>
    				                    	<a href="<?php echo base_url($this->uri->segment(1).'/story/'.preg_replace('/\s+/', '-', $vastorysrow->title).'-'.$vastorysrow->sid);?>">
    				                    		<?php if(isset($vastorysrow->image) && !empty($vastorysrow->image)) { ?>
    				                    		    <img src="<?php echo base_url();?>assets/images/<?php echo $vastorysrow->image; ?>" alt="<?php echo ($vastorysrow->title);?>" class="imageme">
    				                    		<?php }else{ ?>
    				                    			<img src="<?php echo base_url();?>assets/default/series-stories.jpg" alt="<?php echo ($vastorysrow->title);?>" class="imageme">
    				                    		<?php } ?>
    				                    	</a>
    				                    	<div>
    				                    		<font class="max-lines">
    				                    			<a href="<?php echo base_url($this->uri->segment(1).'/story/'.preg_replace('/\s+/', '-', $vastorysrow->title).'-'.$vastorysrow->sid);?>">
    				                    				<?php echo ($vastorysrow->title);?>
    				                    			</a>
    				                    		</font> 
    				                    	</div>
    				                    	<div class="flextest">
    				                    		<font class="byname">By<font class="namehere"><a href="<?php echo base_url($this->uri->segment(1).'/'.$vastorysrow->profile_name);?>" style="color:#000"><?php echo $vastorysrow->name;?></a></font></font>
    				                    		<br>
    				                    	</div>
    				                    	<div class="flextest" style="padding-top:4px;">
    						                   	<font class = "episodes">
    						                   		<font>
    						                   			<?php $wordcount = explode(' ', $vastorysrow->story);
    					                           	$time = round(sizeof($wordcount)/50);	?>
    						                   			<b><?php if($time == 0){ echo 1;}else{ echo $time;}?></b> Min Story&nbsp;</font>
    						                   		<font>&nbsp;<i style="color: #3c8dbc" class="fa fa-eye" aria-hidden="true"></i><b> <?php echo $vastorysrow->views;?>&nbsp;</b></font>
    						                   		<font>&nbsp;<i style="color: #3c8dbc" class="fa fa-star" aria-hidden="true"></i>
    						                   			<b>
    						                   			<?php if(isset($reviews21) && ($reviews21->num_rows()>0)) {
    						                   				foreach($reviews21->result() as $reviews2) { 
    						                   					if($reviews2->sid == $vastorysrow->sid) {
    						                   						echo round($reviews2->rating);
    						                   					}
    						                   			} } ?>
    						                   			</b>
    						                   		</font>
    						                   	</font><br>
    						                   </div>
    				                    	<div class="flextest" style="padding-top:6px">
    				                    		<?php if(isset($this->session->userdata['logged_in']['user_id']) && ($vastorysrow->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
    				                    			
    				                    				<button class="read" onclick="yoursreadlater();"><i class="fa fa-bookmark"></i> Read later </button>
    				                    			
    				                    		<?php }else{ ?>
    				                    			<?php if(isset($readlatersids) && (sizeof($readlatersids)>0) && in_array($vastorysrow->sid, $readlatersids)) { ?>
    				                    				<button onclick="unreadlater(<?php echo $vastorysrow->sid;?>)" class="readdone notloginmodal readlaterbtnatr<?php echo $vastorysrow->sid;?>">
    				                    				<i class="fa fa-check faicon<?php echo $vastorysrow->sid;?>"></i> Read later </button>
    				                    			<?php }else { ?>
    				                    				<button onclick="readlater(<?php echo $vastorysrow->sid;?>)" class="read notloginmodal readlaterbtnatr<?php echo $vastorysrow->sid;?>">
    				                    				<i class="fa fa-bookmark faicon<?php echo $vastorysrow->sid;?>"></i> Read later </button>
    				                    			<?php } ?>
    				                    		<?php } ?>
    				                    		
    				                    		<button type="button" class="btn read dropdown-toggle pull-right" data-toggle="dropdown">
    				                    			<span class=""><i class="fa fa-plus"></i></span>
    				                    		</button>
    				                    		<ul class="dropdown-menu list-inline dropvk">
    				                    			<li onclick="groupsuggest(<?php echo $vastorysrow->sid; ?>);">
    				                    				<a data-toggle="modal" data-target="#groupsuggest" title="COMMUNITY"><i class="fa fa-users"></i></a>
    				                    			</li>
    				                    			<li onclick="friend(<?php echo $vastorysrow->sid;?>);">
    				                    				<a data-toggle="modal" data-target="#friendsuggest" title="SUGGEST"><i class="fa fa-user"></i></a>
    				                    			</li>
    				                    			<li onclick="socialshare(<?php echo $vastorysrow->sid;?>, 'story');">
    				                    				<a data-toggle="modal" data-target="#soc" href="" title="SOCIAL">
    				                    					<i class="fa fa-share-alt"></i>
    				                    				</a>
    				                    			</li>
    				                    		</ul>
    				                    	</div>
    				                    
    				                    </div>
                        			<?php } ?>
                    		    </div>
                            </div>
                            <div id="load_data_message"></div>
                        <?php }else if(isset($profileviewall) && ($profileviewall->num_rows() > 0) && isset($type) && ($type == 'life')){ ?>
                    	    <div class="row pv-0" style="margin-top:20px;">
        		                <div class="col-md-6 col-xs-8">
        			            	<div class="titlei">LIFE EVENTS</div>
        			            </div>
        			            <div class="col-md-6 col-xs-4">
    			            	    <a href="<?php echo base_url().$this->uri->segment(1).'/'.$profile_name;?>" class="view pull-right">
    			            	        <div class="pull-right">BACK</div> 
    			            	    </a>
    			                </div>
    		                </div>
    		                <hr>
                		    <div class=""> 
                			    <div id="loadmoreall"  style="display:flex; flex-wrap:wrap;" class="jsw">
                                    <?php foreach($profileviewall->result() as $valiferow) { 
                                        if($valiferow->writing_style != 'anonymous'){ ?>
                        			    <div class="card1">
                							<a href="<?php echo base_url($this->uri->segment(1).'/story/'.preg_replace('/\s+/', '-', $valiferow->title).'-'.$valiferow->sid);?>">
                    							<?php if(isset($valiferow->image) && !empty($valiferow->image)) { ?>
                    								<img src="<?php echo base_url();?>assets/images/<?php echo $valiferow->image; ?>" alt="<?php echo $valiferow->title;?>" class="imageme1">
                    							<?php }else{ ?>
                    								<img src="<?php echo base_url();?>assets/default/life.jpg" alt="<?php echo $valiferow->title;?>" class="imageme1">
                    							<?php } ?>
                							</a>
                							<div>
                    							<font class="max-lines">
                    								<a href="<?php echo base_url($this->uri->segment(1).'/story/'.preg_replace('/\s+/', '-', $valiferow->title).'-'.$valiferow->sid);?>">
                    									<?php echo $valiferow->title;?>
                    								</a>
                    							</font> 
                							</div>
                							<div class="flextest">
                								<?php if(($valiferow->writing_style == 'anonymous') && ($valiferow->type == 'life')){ ?>
                									<font class="byname">By<font class="namehere">Anonymous</font></font><br>
                								<?php } else { ?>
                									<font class="byname">By<font class="namehere"><a href="<?php echo base_url().$this->uri->segment(1).'/'.$valiferow->profile_name;?>" style="color:#000"><?php echo $valiferow->name;?></a></font></font>
                									<br>
                								<?php } ?>
                							</div>
                							<div class="flextest" style="padding-top:4px;">
                								<font class="lifeEvents-text"><?php echo mb_substr(strip_tags($valiferow->story),0,150, 'utf-8');?> </font>
                							</div>
                						
                							<div class="flextest" style="padding-top:6px">
                								<?php if(isset($this->session->userdata['logged_in']['user_id']) && ($valiferow->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
                									<button class="read" onclick="yoursreadlater();"><i class="fa fa-bookmark"></i> Read later </button>
                								<?php }else{ ?>
                									<?php if(isset($readlatersids) && (sizeof($readlatersids)>0) && in_array($valiferow->sid, $readlatersids)) { ?>
                										<button onclick="unreadlater(<?php echo $valiferow->sid;?>)" class="readdone notloginmodal readlaterbtnatr<?php echo $valiferow->sid;?>">
                										<i class="fa fa-check faicon<?php echo $valiferow->sid;?>"></i> Read later </button>
                									<?php }else { ?>
                										<button onclick="readlater(<?php echo $valiferow->sid;?>)" class="read notloginmodal readlaterbtnatr<?php echo $valiferow->sid;?>">
                										<i class="fa fa-bookmark faicon<?php echo $valiferow->sid;?>"></i> Read later </button>
                									<?php } ?>
                								<?php } ?>
                								
                								<button type="button" class="btn read dropdown-toggle pull-right" data-toggle="dropdown">
                									<span class=""><i class="fa fa-plus"></i></span>
                								</button>
                								<ul class="dropdown-menu list-inline dropvklife">
                									<li onclick="groupsuggest(<?php echo $valiferow->sid; ?>);">
                										<a data-toggle="modal" data-target="#groupsuggest" title="COMMUNITY"><i class="fa fa-users"></i></a>
                									</li>
                									<li onclick="friend(<?php echo $valiferow->sid;?>);">
                										<a data-toggle="modal" data-target="#friendsuggest" title="SUGGEST"><i class="fa fa-user"></i></a>
                									</li>
                									<li onclick="socialshare(<?php echo $valiferow->sid;?>, 'story');">
                										<a data-toggle="modal" data-target="#soc" href="" title="SOCIAL">
                											<i class="fa fa-share-alt"></i>
                										</a>
                									</li>
                								</ul>
                							</div>
                						</div>	
                        			<?php } } ?>
                                </div>
                            </div>
                            <div id="load_data_message"></div>
            	        <?php } elseif(isset($profileviewall) && ($profileviewall->num_rows() > 0) && isset($type) && ($type == 'nano')){ ?>
            	            <div class="row pv-0" style="margin-top:40px;">
    		                    <div class="col-md-6 col-xs-8">
    			                	<div class="titlei">NANO STORIES</div>
    			                </div>
    			                <div class="col-md-6 col-xs-4">
    			                	<a href="<?php echo base_url().$this->uri->segment(1).'/'.$profile_name;?>" class="view pull-right">
    			                	<div class="pull-right">BACK</div> 
    			            	    </a>
    			                </div>
    		                </div><hr>
            	            <div class="">
                			    <div class="jc-m" id="loadmoreall" style="display:flex; flex-wrap:wrap">
                        			<?php foreach($profileviewall->result() as $vananorow) { ?>
    			                        <div class="nano-stories" style="margin:8px">
    			                        	<div>
    			                        		<?php if(isset($vananorow->image) && !empty($vananorow->image)) { ?>
    			                        			<img src="<?php echo base_url();?>assets/images/<?php echo $vananorow->image; ?>" alt="<?php echo $vananorow->name;?>" class="circle-image" alt="USER-NAME" style="height:50px;">
    			                        		<?php }else{ ?>
    			                        			<img src="<?php echo base_url();?>assets/dist/img/photo1.png" alt="<?php echo $vananorow->name;?>" class="circle-image" alt="USER-NAME" style="height:50px;">
    			                        		<?php } ?>
    			                        		<h3 class="name-nanostories">
    			                        		    <a href="<?php echo base_url($this->uri->segment(1).'/'.$vananorow->profile_name);?>" style="color:#000"><?php echo $vananorow->name;?></a>
    			                        		    <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($vananorow->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
        			                        		    <span class="dropdown" style="float:right;margin-right:-2.8px;">
        			                        		        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        			                        		            <i class="fa fa-ellipsis-v" style="font-size:14px;"></i>
        			                        		        </a>
        			                        		        <ul class="dropdown-menu pull-right">
        			                        		            <li><a href="javascript:void(0);" onClick="editnano(<?php echo $vananorow->sid;?>);"><i class="fa fa-edit pr-10"></i> EDIT</a></li>
    			                        		                <li><a href="javascript:void(0);" onClick="deletenano(<?php echo $vananorow->sid;?>);"><i class="fa fa-trash pr-10"></i> DELETE</a></li>
        			                        		        </ul>
        			                        		    </span>
    			                        		    <?php } ?>
    			                        	    </h3>
    			                        	</div>
    			                        	<div>
    			                        		<hr style="width:100%;margin-top: 12px;">
    			                        		<a href="#" style="color:#000" data-toggle="modal" data-target="#modal-default<?php echo $vananorow->sid;?>">
                								    <font class="text-in-nanostory" onclick="nanoviewsadd(<?php echo $vananorow->sid;?>);"><?php echo $vananorow->story; ?></font>
                								</a>
    			                        	</div>
    			                        	<div class="lastdiv">
                								<hr style="width:100%;">
                								<?php if(isset($this->session->userdata['logged_in']['user_id'])){
                								    if(isset($nanolikes) && in_array($vananorow->sid,$nanolikes)) { ?>
                    								<font>
                    								    <span class="nanolikecount<?php echo $vananorow->sid;?>"><?php echo $vananorow->nanolikecount;?></span>
                    								    <a href="javascript:void(0);" onclick="nanodislike(<?php echo $vananorow->sid;?>);" class="nanolike<?php echo $vananorow->sid;?>" title="Unlike">
                    										<i class="fa fa-heart favbtn<?php echo $vananorow->sid;?>" style="color:#f00; padding-top:5px;"></i>
                    									</a>
                    								</font>
                    							    <?php } else { ?>
                    							    <font>
                    							        <span class="nanolikecount<?php echo $vananorow->sid;?>"><?php echo $vananorow->nanolikecount;?></span>
                    								    <a href="javascript:void(0);" onclick="nanolike(<?php echo $vananorow->sid;?>);" class="nanolike<?php echo $vananorow->sid;?>" title="like">
                    										<i class="fa fa-heart-o favbtn<?php echo $vananorow->sid;?>" style="color:#f00; padding-top:5px;"></i>
                    									</a>
                    								</font>
                    							    <?php } }else { ?>
                    							    <font>
                    								    <span class="nanolikecount<?php echo $vananorow->sid;?>"><?php echo $vananorow->nanolikecount;?></span>
                    								    <a href="javascript:void(0);" class="notloginmodal" title="like">
                    										<i class="fa fa-heart-o favbtn<?php echo $vananorow->sid;?>" style="color:#f00; padding-top:5px;"></i>
                    									</a>
                    								</font>
                    							<?php } ?>
                								<div style="float:right;color:#777">
                									<a href="javascript:void(0);" class="dropdown-toggle text-muted" data-toggle="dropdown">
                										<i class="fa fa-share-alt" aria-hidden="true"></i>
                									</a>
                									<ul class="dropdown-menu list-inline dropvknano">
                    									<li onclick="groupsuggest(<?php echo $vananorow->sid; ?>);">
                    										<a href="javascript:void(0);" data-toggle="modal" data-target="#groupsuggest"><i class="fa fa-users"></i></a>
                    									</li>
                    									<li onclick="friend(<?php echo $vananorow->sid;?>);">
                    										<a href="javascript:void(0);" data-toggle="modal" data-target="#friendsuggest"><i class="fa fa-user"></i></a>
                    									</li>
                										<li onclick="socialshare(<?php echo $vananorow->sid;?>, 'nano');">
                											<a data-toggle="modal" data-target="#soc" href="javascript:void(0);" title="SOCIAL"><i class="fa fa-share-alt"></i></a>
                										</li>
                									</ul>
                								</div>
                								<font style="float:right;color:#777">
                								    <i class="fa fa-eye" aria-hidden="true"></i>
                								    <b><span class="nanoviewcount<?php echo $vananorow->sid;?>"><?php echo $vananorow->views; ?></span></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                								</font>
                							</div>
    			                        </div>
    			                    <?php } ?>
                    			</div>
                		    </div>
                		    
                            <?php if(isset($profileviewall) && ($profileviewall->num_rows() > 0) && isset($type) && ($type == 'nano')){
                                foreach($profileviewall->result() as $vamodalnanorow) { ?>
                        		<div class="modal fade" id="modal-default<?php echo $vamodalnanorow->sid;?>">
                        			<div class="modal-dialog">
                        				<div class="modal-content">
                        					<div class="modal-header">
                        					    <div>
                        					        <?php if(isset($vamodalnanorow->profile_image) && !empty($vamodalnanorow->profile_image)) { ?>
                    									<img src="<?php echo base_url();?>assets/images/<?php echo $vamodalnanorow->profile_image; ?>" alt="<?php echo $vamodalnanorow->name;?>" class="user-image img-circle" style="height:50px;">
                    								<?php }else{ ?>
                    									<img src="<?php echo base_url();?>assets/dist/img/user2-160x160.jpg" alt="<?php echo $vamodalnanorow->name;?>" class="user-image img-circle" style="height:50px;">
                    								<?php } ?>
    			                        		    <h3 class="name-nanostories" style="margin-top: -40px;margin-left:50px;">
    			                        		        <a href="<?php echo base_url($this->uri->segment(1).'/'.$vamodalnanorow->profile_name);?>" style="color:#000"><?php echo $vamodalnanorow->name;?></a>
    			                        		        <span class="pull-right">
    			                        		            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:4px;">
                                						        <span aria-hidden="true">&times;</span>
                                					        </button>
    			                        		        </span>
    			                        		    </h3>
    			                        		</div>
                        					</div>
                        					<div class="modal-body modal-bodyv" style="overflow-y:scroll;">
                        						<font class="text-in-nanostory-p" style="border-left:none; overflow-y:scroll;"><?php echo $vamodalnanorow->story; ?></font>
                        					</div>
                        					<div class="modal-footer">
                        						<ul class="list-inline">
                        							<li class="text-muted pull-left" onclick="nanolike(<?php echo $vamodalnanorow->sid;?>);">
                        							    <b class="nanolike<?php echo $vamodalnanorow->sid;?>">
                    								        <span class="nanolikecount<?php echo $vamodalnanorow->sid;?>"><?php echo $vamodalnanorow->nanolikecount;?></span>
                    								    </b><i class="fa fa-heart-o" aria-hidden="true" style="color:#f00;"></i>
                        							</li>
                        							<li class="pull-right">
                                                    	<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-share-alt"></i></a>
                                                        <ul class="dropdown-menu list-inline dropvknano1">
                                                            <li onclick="groupsuggest(<?php echo $vamodalnanorow->sid; ?>);">
                    										    <a data-toggle="modal" data-target="#groupsuggest"><i class="fa fa-users"></i></a>
                        									</li>
                        									<li onclick="friend(<?php echo $vamodalnanorow->sid;?>);">
                        										<a data-toggle="modal" data-target="#friendsuggest"><i class="fa fa-user"></i></a>
                        									</li>
                    										<li>
                    											<a data-toggle="modal" data-target="#soc" href=""><i class="fa fa-share-alt"></i></a>
                    										</li>
                                                        </ul>
                                                    </li>
                        						</ul>
                        					</div>
                        				</div> <!-- /.modal-content -->
                        			</div> <!-- /.modal-dialog -->
                                </div> <!-- /.modal -->
                            <?php } } ?>
                            <div id="load_data_message"></div>
            	        <?php } ?>
            	        
            	    </div>
                </div>
          </div>
        </section>
    
    </div>

<!-- Nano edit update -->
<div class="modal fade" id="nanoedit" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4>Update nano story</h4>
			</div>
			<div class="modal-body">
			    <h5 class="updatenano"></h5>
			    <input type="hidden" id="nanolang" value="">
			    <h6 class="pull-left" id="count_message"></h6>
			    <input type="hidden" name="nanosid" id="nanosid" value="">
				<textarea name="story" id="story" rows="15" cols="96" required="" class="form-control" placeholder="Start Writing Here...." maxlength="1000" style="resize:none;"></textarea>
			    <br><center><button class="btn btn-primary" onclick="updatenano()"> Update </button></center>
			</div>
		</div>
	</div>
</div>
<!-- Nano edit update -->

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


<!-- Social Popup ---- -->
<div class="modal fade" id="soc">
	<div class="modal-dialog">
		<div class="modal-content socv ">
			<div class="modal-header" style="padding:8px 15px;">
				<button type="button" class="close" style="color:#000; opacity:initial; margin-top:0px;" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h5 class="modal-title text-center" style="color:#808182;">SOCIAL MEDIA SHARE</h5>
			</div>
			<div class="modal-body" style="padding-top:5px;">
				<div class="row">
					<div class="col-md-12 pd-5v">
						<a href="javascript:void(0);" class="facebookshare">
						    <img src="<?php echo base_url();?>assets/svg/fb.svg" style="width:40px; height:40px;"/> <span style="vertical-align: -webkit-baseline-middle; padding-left:5px; font-size:18px;">Faceebok</span></a>
					</div>
					<div class="col-md-12 pd-5v">
					    <a href="javascript:void(0);" class="whatsappshare">
						    <img src="<?php echo base_url();?>assets/svg/wa.svg" style="width:40px; height:40px;"/> <span style="vertical-align: -webkit-baseline-middle; padding-left:5px; font-size:18px;">Whatsapp</span></a>
					</div>
					<div class="col-md-12 pd-5v">
						<a href="javascript:void(0);" class="twittershare">
						    <img src="<?php echo base_url();?>assets/svg/twitter.svg" style="width:40px; height:40px;"/> <span style="vertical-align: -webkit-baseline-middle; padding-left:5px; font-size:18px;">Twitter</span></a>
					</div>
					<div class="col-md-12 pd-5v">
						<a href="javascript:void(0);" onclick="copylinkshare('#copylinkshare')">
						    <img src="<?php echo base_url();?>assets/svg/link.svg" style="width:40px; height:40px;"/> <span style="vertical-align: -webkit-baseline-middle; padding-left:5px; font-size:18px;">Copy to link</span></a>
					    <input type="hidden" id="copylinkshare" value="<?php echo base_url();?>">
					</div>
				</div>
			</div>
		</div>
	<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- Social popup ---- -->

<div class="modal fade" id="editpro_comment" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><b>Update your Comments</b></h4>
            </div>
            <div class="modal-body">
                <form id="editprocomment" >
                    <textarea class="form-control input-sm" name="pro_comment" id="pro_editcomment" placeholder="Enter comment" style="resize:none;"></textarea>
                    <span class="text-danger pro_comment"></span>
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
<div class="modal fade" id="reportpro_comment" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><b>Report Your Comments</b></h4>
            </div>
            <div class="modal-body">
                <form id="reportprocomment">
                    <textarea class="form-control input-sm" name="reportpro_cmt" id="reportpro_cmt" placeholder="Enter Repost message" style="resize:none;"></textarea>
                    <span class="text-danger reportpro_cmt"></span>
                    <input type="hidden" name="reportcommentid" value="" id="reportcommentid">
                    <input type="hidden" name="reportuser_id" value="" id="reportuser_id">
                    <br>
                    <center>
                        <button class="btn btn-primary" type="submit"> Update </button>
                    </center>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- ./wrapper -->
<script src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
$("#profilecomments").submit(function(event) {
    event.preventDefault();
    $.ajax({
      url: "<?php echo base_url($this->uri->segment(1).'/pro_comment'); ?>",
      type: 'POST',
      data: $("form#profilecomments").serialize(),
      success: function(data) {
          $('#pro_comment').val('');
        if(data == 1){
            $.ajax({
                url: "<?php echo base_url($this->uri->segment(1).'/pro_commentpost'); ?>",
                type: 'POST',
                dataType: 'json',
                success: function(result) {
                    if(result.response){
                        var profile_image = result.response[0].profile_image;
                        if(profile_image){  }else{ profile_image="2.png"; }
                    		    
                        $("#commentresults").prepend('<li class="commentdelete'+result.response[0].cid+'" style="margin-bottom:5px;"><hr>'+
                        '<div style="float: left;"><a href="<?php echo base_url().$this->uri->segment(1);?>/'+result.response[0].profile_name+'">'+
                        '<img src="<?php echo base_url();?>assets/images/'+profile_image+'" style="border-radius: 50%;width:40px !important;height: 40px !important;margin-right: 10px;" alt="'+result.response[0].name+'">'+
                        '</a></div><div class="comment_right clearfix"><div class="comment_info" style="padding-left:10px;">'+
                        '<a href="<?php echo base_url().$this->uri->segment(1);?>/'+result.response[0].profile_name+'">'+result.response[0].name+'</a>'+
                        '<span class="pull-right" style="margin-right:15px;"><a href="#" class="dropdown-toggle" data-toggle="dropdown" title="write" aria-expanded="true">'+
                            '<i class="fa fa-ellipsis-v"></i></a>'+
                            '<ul class="dropdown-menu writemenu" style="top:auto; width:fit-content;">'+
                                '<li><a href="javascript:void(0)"><span class="" onClick="editpro_comment('+result.response[0].cid+');">'+
                                    '<i class="fa fa-pencil"></i> Edit</span></a></li>'+
                                '<li><a href="javascript:void(0)"><span class="" onClick="deletepro_comment('+result.response[0].cid+');">'+
                                    '<i class="fa fa-trash"></i> Delete</span></a></li>'+
                            '</ul></span><div style="color:#777; font-size:11px;">1 minute ago</div>'+
                        '</div><p style="margin: 8px 0px 2px 0px;" class="pcomment'+result.response[0].cid+'">'+result.response[0].pro_comment+'</p>'+
                        '<a href="javascript:void(0)" onClick="postReplycomment('+result.response[0].cid+')" style="color:#de1800; font-size:0.8em;"> REPLY </a> I '+
                        '<a href="javascript:void(0)" onClick="replycomments('+result.response[0].profile_id+', '+result.response[0].cid+')" style="color:#de1800;font-size:0.8em;">'+
                        '<span id="repliescount'+result.response[0].cid+'">0</span> REPLIES</a>'+
                        '<input type="hidden" id="replycmtcount'+result.response[0].cid+'" value="0"><div class="input-group postreplycomment'+result.response[0].cid+'"></div>'+
                        '<span class="text-danger addreplaycmt'+result.response[0].cid+'"></span><div class="box-comment replycommentslist">'+
                        '<ul id="replycommentresults'+result.response[0].cid+'" style="padding-left:10px;list-style:none;"></ul><span class="viewmore'+result.response[0].cid+'"></span>'+
                        '</div></div></li>');
                    }
                }
            });
          //alert('Your Comment Posted Successfully.');
        }else{
          alert('Failed to Post Comment. Please try Again.');
        }
      }
    });
  });
</script>

<script>
    $(function() { // auto scroll load comments
        var profileid = $('#profile_id').val();
        loadResults(0);
        $('.commentslist').scroll(function() {
            if($("#loadingcomments").css('display') == 'none') {
                if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
                   var limitStart = $("#commentresults li").length;
                   loadResults(limitStart); 
                }
            }
    	}); 
     
        function loadResults(limitStart) {
        	//$("#loadingcomments").show();
            $.ajax({
                url: "<?php echo base_url().$this->uri->segment(1);?>/profilecomments/"+profileid,
                type: "post",
                data: {limitStart: limitStart},
                success: function(data) {
                    $("#commentresults").append(data);
                    $("#loadingcomments").hide();
                }
            });
        };
    });
    function replycomments(profileid, commentid){ //replay comments view more
        var limitstarting = $("#replycommentresults"+commentid+" > li").length;
        var replycmtcount = $('#replycmtcount'+commentid).val();
        if(limitstarting){ }else{ limitstarting = 0; }
        $.ajax({
            url: "<?php echo base_url().$this->uri->segment(1);?>/profilereplycomments/"+profileid,
            type: "post",
            data: {'limitStart': limitstarting, 'cid': commentid},
            success: function(data) {
                $("#replycommentresults"+commentid).append(data);
                $('.viewmore'+commentid).html('<a href="javascript:void(0)" onClick="replycomments('+profileid+','+commentid+')" style="color:#de1800;padding-left: 55px;">View More</a>');
                if(replycmtcount <= limitstarting+2){
                    $('.viewmore'+commentid).css('display','none');
                }
            }
        });
    };

    function editpro_comment(commentid){
        $('#editpro_comment').modal('show');
        $.ajax({
    		url:'<?php echo base_url().$this->uri->segment(1);?>/editpro_comment/'+commentid,
    		method: 'POST',
    		dataType: "json",
    		success:function(data){
    			if(data.response[0].pro_comment) {
    			    //console.log(data.response[0].pro_comment);
    			    $('textarea#pro_editcomment').val(data.response[0].pro_comment);
    			    $('#commentid').val(commentid);
               }else{
                   $('#editpro_comment').modal('hide');
               }
            } 
        });
    }
    $( "form#editprocomment" ).submit(function( event ) {
		event.preventDefault();
		var comments = $('textarea#pro_editcomment').val();
		var cid = $('#commentid').val();
		$.post("<?php echo base_url().$this->uri->segment(1);?>/updateprocomment",{'comment':comments,'cid':cid},function(resultdata){
			if(resultdata == 2){
				$('span.pro_comment').text('Please Enter Comment');
			}else if(resultdata == 1){
			    //console.log('success');
			    $('p.pcomment'+cid).html(comments);
			    $('#editpro_comment').modal('hide');
			}else{
			    //console.log('fail');
			}
		});
	});
	
	function deletepro_comment(commentid){
	    $.post("<?php echo base_url().$this->uri->segment(1);?>/deleteprocmtcount",{'cid':commentid},function(result){
	        var repliescmtcount = $('span#repliescount'+result).text();
    	    $.ajax({
        		url:'<?php echo base_url().$this->uri->segment(1);?>/deletepro_comment/'+commentid,
        		method: 'POST',
        		dataType: "json",
        		success:function(data){
        		    if(data == 1) {
                        $('li.commentdelete'+commentid).css('display','none'); 
                        $('span#repliescount'+result).text(parseInt(repliescmtcount)-1);
                    }
                } 
            });
	    });
	}

    function postReplycomment(commentid){
	    $('div.postreplycomment'+commentid).html('<input type="text" id="replycmts'+commentid+'" value="" class="form-control" placeholder="Replay Comment..." required>'+
	    '<span class="input-group-btn"><button type="submit" class="btn btn-success btn-flat" onclick="addreplycomment('+commentid+')">POST</button></span>');
	}
    function addreplycomment(commentid){
	    var repliescmtcount = $('span#repliescount'+commentid).text();
	    var comments = $('#replycmts'+commentid).val();
	    var profile_id = $('#profile_id').val();
	    if(comments){
	        $.ajax({
        		url:'<?php echo base_url().$this->uri->segment(1);?>/addreplycomment',
        		method: 'POST',
        		data: {'comment_id': commentid, 'pro_comment':comments, 'profile_id': profile_id},
        		dataType: "json",
        		success:function(data){
        		    $('#replycmts'+commentid).val('');
        		    if(data == 2){
                        $('.addreplaycmt'+commentid).text('Enter your Comments.');
                    }else if(data == 1){
                        $.ajax({
                    		url:'<?php echo base_url().$this->uri->segment(1);?>/pro_commentpost',
                    		method: 'POST',
                    		dataType: "json",
                    		success:function(datares){
                    		    var profile_image = result.response[0].profile_image;
                                if(profile_image){  }else{ profile_image="2.png"; }
                    		    var cmthtml='';
                    		    cmthtml = '<li style="margin-bottom:10px;" class="commentdelete'+datares.response[0].cid+'"><hr>'+
                    		        '<div class="media"><div class="media-left" style="padding-right:5px;">'+
                                    '<img src="<?php echo base_url();?>assets/images/'+profile_image+'" style="border-radius: 50%;width:30px !important;height: 30px !important;" alt="'+datares.response[0].name+'">'+
                                    '</div><div class="media-body" style="background-color:#ddd; padding-left:8px; border-radius: 10px;">'+
                                    '<b>'+datares.response[0].name+'</b><span class="pull-right">'+
                                        '<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" title="write" aria-expanded="true" style="padding: 0px 15px;">'+
                                            '<i class="fa fa-ellipsis-v"></i></a>'+
                                        '<ul class="dropdown-menu writemenu" style="top:auto; width:fit-content;">'+
                                            '<li><a href="javascript:void(0);"><span onclick="editpro_comment('+datares.response[0].cid+');">'+
                                                '<i class="fa fa-pencil"></i> Edit</span></a></li>'+
                                            '<li><a href="javascript:void(0);"><span onclick="deletepro_comment('+datares.response[0].cid+');">'+
                                                '<i class="fa fa-trash"></i> Delete</span></a></li>'+
                                        '</ul>'+                
                                    '</span><div style="color:#777; font-size:11px;">1 minute ago</div>'+
                                    '<p style="margin: 8px 0px 2px 0px;" class="pcomment'+datares.response[0].cid+'">'+datares.response[0].pro_comment+'</p></div>'+
                                    '</div></li>';
                                $('#replycommentresults'+commentid).prepend(cmthtml);
                                $('span#repliescount'+commentid).text(parseInt(repliescmtcount)+1);
                    		}
                        });
                    }else{
                        $('.addreplaycmt'+commentid).text('Failed to Post your Comments.');
                    }
                }
            });
	    }else{
	        $('.addreplaycmt'+commentid).text('Enter your Comments.');
	    }
	}
	
	function reportpro_comment(commentid, user_id){
	    $('#reportpro_comment').modal('show');
	    $('#reportcommentid').val(commentid);
	    $('#reportuser_id').val(user_id);
	}
	$( "form#reportprocomment" ).submit(function( event ) {
		event.preventDefault();
		$.post("<?php echo base_url().$this->uri->segment(1);?>/reportpro_comment",$("form#reportprocomment").serialize(),function(resultdata){
			if(resultdata == 2){
				$('span.reportpro_cmt').text('Please Enter your Report Message');
			}else if(resultdata == 1){
			    //console.log('success');
			    $('#reportpro_comment').modal('hide');
			}else{
			    //console.log('fail');
			}
		});
	});
</script>

<script>
    function editnano(nanosid){
        $.ajax({
    		url:'<?php echo base_url().$this->uri->segment(1);?>/editnano/'+nanosid,
    		method: 'POST',
    		dataType: "json",
    		success:function(data){
    		    $('#story').text(data.story);
    		    $('#nanolang').val(data.nanolang);
    		    $('#nanosid').val(nanosid);
    		    $('#nanoedit').modal('show');
    		    languageChangeHandler();
            }
        });
    }
    function updatenano(){
        var nanosid = $('#nanosid').val();
        var story = $('textarea#story').val();
        $.ajax({
    		url:'<?php echo base_url().$this->uri->segment(1);?>/updatenano',
    		method: 'POST',
    		data: {'story': story, 'nanosid': nanosid},
    		dataType: "json",
    		success:function(data){
    		    $('.updatenano').html('<span class="text-success"> Nano story updated successfully.</span>');
    		    setTimeout(function(){ $('#nanoedit').modal('hide'); }, 2000);
    		    location.reload();
            }
        });
    }
    function deletenano(nanosid){
        $.ajax({
    		url:'<?php echo base_url().$this->uri->segment(1);?>/deletenano/'+nanosid,
    		method: 'POST',
    		success:function(data){
    		    if(data == 1){
    		        $('.nano').css('display', 'none');
    		        location.reload();
    		    }
            }
        });
    }
</script>

<script>
    $(document).ready(function(){
        var limit = 7;
        var start = 7;
        var action = 'inactive';
        var profile = "<?php echo $this->uri->segment(3);?>";
        function load_country_data(limit, start) {
            $.ajax({
                url:'<?php echo base_url().$this->uri->segment(1);?>/profilealloadmore',
                method:"POST",
                data:{limit:limit, start:start, profile:profile},
                cache:false,
                success:function(data){
                    $('#loadmoreall').append(data);
                    if(data.replace(/\s/g, "") == '') {
                        $('#load_data_message').html("<center><div class='col-md-12' style='padding-top:20px;'> No More Results!</div></center>");
                        action = 'active';
                    }else{
                        $('#load_data_message').html("<center><div class='col-md-12' style='padding-top:20px;'> Loading ...</div></center>");
                        action = "inactive";
                    }
                }
            });
        }
        if(action == 'inactive') {
            action = 'active';
            load_country_data(limit, start);
        }
        $(window).scroll(function(){
            if($(window).scrollTop() + $(window).height() > $("#loadmoreall").height() && action == 'inactive'){
                action = 'active';
                start = start + limit;
                setTimeout(function(){load_country_data(limit, start);}, 500);
            }
        });
    });
</script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
    	// Load the Google Transliterate API
    	google.load("elements", "1", {
    		packages: "transliteration"
    	});
	  var languagetoc = document.getElementById('nanolang').value;
	  var transliterationControl;
	  function onLoad() {
		var options = {
			sourceLanguage: 'en',
			destinationLanguage: ['te','hi','ml','ta','bn','gu','kn','mr','ru','pa','or'],
			transliterationEnabled: true,
		};
		// Create an instance on TransliterationControl with the required
		// options.
		transliterationControl =
		  new google.elements.transliteration.TransliterationControl(options);

		// Enable transliteration in the textfields with the given ids.jk
        var ids = [ "story"];
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
        //transliterationControl.toggleTransliteration();
		var dropdown = document.getElementById('nanolang').value;
        transliterationControl.setLanguagePair(
           google.elements.transliteration.LanguageCode.ENGLISH, dropdown);
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
<script type="text/javascript">
function genericSocialShare(url){
    window.open(url,'sharer','toolbar=0,status=0,width=648,height=395');
    return true;
}
function copylinkshare(element) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(element).val()).select();
    document.execCommand("copy");
    $temp.remove();
}
</script>