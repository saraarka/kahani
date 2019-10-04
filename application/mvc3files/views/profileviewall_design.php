
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/profileviewall_design.css">


    <?php $readlatersids = get_storiesreadlater('readlater'); ?>
    <div class="pd-l" style="background:#ecf0f5;">
        <?php if(isset($writer_profile) && ($writer_profile->num_rows() >0)){ foreach($writer_profile->result() as $row) { ?>
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
    						                 <img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $row->profile_image; ?>" style="width:85px;" alt="User Avatar">
    						             <?php } else { ?>
                                              <img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" style="width:85px;" alt="User Avatar">
                                         <?php } ?>
                                    </div>
    					             <h3 class="widget-user-username clrvk" style="color:#fff"><b><?php echo $row->name;?> </b>
    					             <?php if($row->user_activation == 1){ ?>
    					                 </h3>
    			                     <?php } ?>
    					             <h5 class="widget-user-desc clrvk" style="color:#fff">@<?php echo $row->profile_name;?></h5>
    					        </div>
    					    </div>
    					       <center>
                                    <div class="widget-user-header ovv profile2" style="padding:0px; background: url('<?php echo base_url();?>assets/images/<?php echo $banner_image; ?>') center center;background-repeat: no-repeat;background-size: cover;">
                                        <div style="background-color:rgba(0, 0, 0, 0.55); background-repeat: no-repeat;background-size: cover; padding: 40px 30px;">
                                            <div class="widget-user-image" style="justify-content:center;">
                                                <?php  if(isset($row->profile_image) && !empty($row->profile_image)) { ?>
                                                    <img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $row->profile_image; ?>" alt="User Avatar" style="width:85px; float:none; justify-content:center;">
                                                 <?php } else { ?>
                                                    <img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="User Avatar" style="width:85px;float:none; justify-content:center;">
                                                <?php } ?>
                                            </div><!-- /.widget-user-image -->
                                            <h3 class="" style="color:#fff;"><b><?php echo $row->name;?> </b></h3>
                                            <h5 class="" style="color:#fff;">@<?php echo $row->profile_name;?></h5>
                                        </div>
                                    </div>
                                </center>
				            </div>	
    				        <div class="box-footer">
    					        <div class="row pt-0">
        							<!--<div class="col-sm-12 col-xs-12 col-md-2 hidden-xs">
            							<input type="hidden" name="writer_id" value="<?php echo $row->user_id; ?>">
            							<input type="hidden" name="writer_name" value="<?php echo $row->name; ?>">
            							<div class="description-block">
                							<?php if(isset($this->session->userdata['logged_in']['user_id']) && ($this->session->userdata['logged_in']['user_id'] == $row->user_id)){ ?>
                							<?php } else { ?>
                							    <button class="btn btn-success vjw" onclick="writerfollow(<?php echo $row->user_id;?>,'<?php echo $row->name;?>')"> Follow </button>
                							<?php } ?>
            							</div>
        							</div>-->
        							<div class="col-sm-4 col-xs-4 col-md-4 col-lg-2 border-right pd-0">
            							<div class="description-block">
            								<h5 class="description-header"><?php echo $row->count;?></h5>
            								<span class="description-text">Writings</span>
            							</div>
        							</div>
        							<div class="col-sm-4 col-xs-4 col-md-4 col-lg-2 border-right pd-0">
            							<div class="description-block">
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
            								<a href="#" data-toggle="modal" data-target="#modal-default"><span class="description-text">FOLLOWERS</span></a>
            							</div>
        							</div>
    								<!-- Modelpop up -->
        							<div class="modal fade" id="modal-default">
        								<div class="modal-dialog">
        									<div class="modal-content">
            									<div class="modal-header">
            										<div class="box-header">
            											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
            												<span aria-hidden="true">&times;</span>
            											</button>
            										</div>
            									</div>
    								            <div class="modal-body">
        											<ul class="nav nav-tabs">
        												<li class="active"><a href="#tab_1" data-toggle="tab"><b>Followers</b></a></li>
        												<li><a href="#tab_2" data-toggle="tab"><b>Following</b></a></li>
        											</ul>
    									            <div class="tab-content">
    										            <div class="tab-pane active" id="tab_1">
    											            <div class="box-header with-border">
    												            <div class="row">
    													            <?php if(isset($followers_names) && ($followers_names->num_rows() > 0)){
    													                foreach($followers_names->result() as $followerskey) { ?>
    												                        <div class="col-md-10">
    													                        <div class="user-block">
    												                                <?php if(isset($followerskey->profile_image) && !empty($followerskey->profile_image)) { ?>
    													                                <img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $followerskey->profile_image; ?>" alt="User Image">
                    																<?php } else { ?>
                    																	<img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="User Image">
                    																<?php } ?>
                																    <span class="username" style="padding-top:8px;">
                																        <a href="<?php echo base_url('index.php/welcome/profile?id='.$followerskey->user_id);?>"><?php echo $followerskey->name;?></a>
                																    </span>
    													                        </div>
    												                        </div>
                    														<div class="col-md-2">
                                        										<?php if(isset($this->session->userdata['logged_in']['user_id']) && ($this->session->userdata['logged_in']['user_id'] == $followerskey->user_id)){ ?>
                                                                                    <button class="vjw btn btn-success" onclick="yoursfollow()"> Follow </button>
                                                                                <?php } else { ?>
                                                                                    <?php if(isset($following) && in_array($followerskey->user_id, $following)) { ?>
                                                                                        <button class="vjw btn btn-primary notloginmodal unfollow<?php echo $followerskey->user_id;?>" onclick="writerunfollow(<?php echo $followerskey->user_id;?>,'<?php echo $followerskey->name;?>')"> Following </button>
                                                                                    <?php } else { ?>
                                                                                        <button class="vjw btn btn-success notloginmodal follow<?php echo $followerskey->user_id;?>" onclick="writerfollow(<?php echo $followerskey->user_id;?>,'<?php echo $followerskey->name;?>')"> Follow </button>
                                                                                    <?php } ?>
                                                                                <?php } ?>
                    														</div>
    												                    <?php } } else { ?>
    													                    <center> <h3> You do not have followers. </h3></center>
                       									            <?php } ?>
    												            </div>
    											            </div>
    										            </div>
    										            <div class="tab-pane" id="tab_2" style="padding-top:20px;">
            												<div class="box-header with-border">
            													<div class="row">
            														<?php if(isset($following_names) && ($following_names->num_rows() > 0)) {
            														    foreach($following_names->result() as $followingkey) { ?>
                														<div class="col-md-10">
                															<div class="user-block">
                															    <?php if(isset($followingkey->profile_image) && !empty($followingkey->profile_image)) { ?>
                																    <img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $followingkey->profile_image; ?>" alt="User Image">
                																<?php } else { ?>
                																	<img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="User Image">
                																<?php } ?>
                																<span class="username" style="padding-top:8px;">
                																	<a href="<?php echo base_url('index.php/welcome/profile?id='.$followingkey->user_id);?>"><?php echo $followingkey->name;?></a>
                																</span>
                															</div>
                														</div>
                														<div class="col-md-2">
                															<?php if(isset($this->session->userdata['logged_in']['user_id']) && ($this->session->userdata['logged_in']['user_id'] == $followingkey->user_id)){ ?>
                                                                                <button class="vjw btn btn-success" onclick="yoursfollow()"> Follow </button>
                                                                            <?php } else { ?>
                                                                                <?php if(isset($following) && in_array($followingkey->user_id, $following)) { ?>
                                                                                    <button class="vjw btn btn-primary notloginmodal unfollow<?php echo $followingkey->user_id;?>" onclick="writerunfollow(<?php echo $followingkey->user_id;?>,'<?php echo $followingkey->name;?>')"> Following </button>
                                                                                <?php } else { ?>
                                                                                    <button class="vjw btn btn-success notloginmodal follow<?php echo $followingkey->user_id;?>" onclick="writerfollow(<?php echo $followingkey->user_id;?>,'<?php echo $followingkey->name;?>')"> Follow </button>
                                                                                <?php } ?>
                                                                            <?php } ?>
                														</div>
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
        							<div class="col-sm-4 col-xs-4 col-md-2 border-right   profile1">
            							<div class="description-block">
            								<h5 class="description-header"><?php echo $row->storiesviewcount;?></h5>
                                            <span class="description-text">Views</span>
            							</div>
            						</div>
        							<div class="col-sm-6 col-xs-6 col-md-4 col-lg-3 profile1">	</div>
        							<div class="col-sm-4 col-xs-4 col-md-4 col-lg-3 pd-0">
            							<div class="description-block  profile1" style="float:right; margin-top:14px;">
            								<a href="<?php echo base_url();?>index.php/Welcome/my_profile/<?php echo ($this->session->userdata['logged_in']['user_id']);?>" class="btn btn-successv">Edit Profile</a>
            							</div>
        								<span class="profile1" style="padding-left:25px;"><a href="" class=""></a></span>
        								
        								<div class="description-block profile2 btnv" style="padding-top:4px;">
            								<a href="<?php echo base_url();?>index.php/Welcome/my_profile/<?php echo ($this->session->userdata['logged_in']['user_id']);?>" class="btn btn-successv" style="">Edit Profile</a>
            							</div>
        							</div>
    					        </div>
    				        </div>
			            </div>
		            </div>
		        </div>
            </section>
        <?php }  } ?>
        
        
        <section class="content">
          <div class="" style="display:flex; flex-wrap:wrap;">
                <div class="sidebar side1">
                    <?php if(isset($writer_profile) && ($writer_profile->num_rows() > 0)){ foreach($writer_profile->result() as $row) { ?>
        			    <div class="box box-widget widget-user vjc"> <h4>About</h4> <br>
                            <p><?php echo $row->aboutus; ?></p>
                            <div class="row" style="border-top:1px solid #000; padding-top:10px;">
                                <?php if($row->uemailstatus == 'public') { ?>
                                <div class="col-md-12"><label><i class="fa fa-envelope"> </i></label> <?php echo $row->email; ?></div>
                                <?php } if($row->uphonestatus == 'public') { ?>
                                <div class="col-md-12"><label><i class="fa fa-phone"> </i></label> <?php echo $row->phone; ?></div>
                                <?php } ?>
                            </div>
                        </div>
        		    <?php } } ?><br>
        			<h3> Comment On Your Profile</h3>
				    <div class="box-footer box-comments">
    					<div class="box-comment">
    						<form action="#" method="POST" id="profilecomments">
    							<div class="img-push"> 
									<div class="col-md-10 pd-0">
                                       <textarea class="form-control input-sm" name="pro_comment" id="pro_comment" placeholder="Please Enter comments here...." required  style="resize:none;"></textarea>
                                       <input type="hidden" name="profile_id" value="<?php echo $this->session->userdata['logged_in']['user_id']; ?>">
                                       <input type="hidden" name="comment_id" id="comment_id" value="">
                                    </div>
                                    <div class="col-md-2" style="padding-left:6px;">
                                        <button class="btn btn-success" style="margin-top: 8px;"><i class="fa fa-envelope" aria-hidden="true"></i></button>
                                    </div>
    							</div>
    						</form><br>
    					</div>
    					<div class="box-comment commentslist">
                            <ul id="commentresults" style="padding:0px;"></ul>
                        </div>
                        <span id="loadingcomments">
                            <center><img src="<?php echo base_url();?>assets/images/imgs/loading.gif"></center>
                        </span>
				    </div>
                </div>
            
            <div class="main-container1">
                <div class="tab-content">
                    
                    <?php if(isset($profileviewall) && ($profileviewall->num_rows() > 0) && isset($_GET['type']) && ($_GET['type'] == 'series')){ ?>
                    <div class="row pv-0" style="margin-top:20px;">
		                <div class="col-md-6 col-xs-8">
			            	<div class="titlei">SERIES</div>
			            </div>
			           <div class="col-md-6 col-xs-4">
			            	<div class="view pull-right">
			            	   <a href="<?php echo base_url();?>index.php/welcome/profileviewall?id=<?php echo $_GET['id'];?>">Back</a> 
			            	</div>
			            </div>
			        </div>
                    <hr>
                    <div class="jc-m" id="loadmoreall" style="display:flex; flex-wrap:wrap;">
                                <?php foreach($profileviewall->result() as $vaseriesrow){ ?>
                                    <div class="cardls">
				                    		<div class="book-typels"><?php echo $vaseriesrow->gener;?></div>
				                    			<?php if(isset($vaseriesrow->cover_image) && !empty($vaseriesrow->cover_image)) { ?>
				                    			<img src="<?php echo base_url();?>assets/images/<?php echo $vaseriesrow->cover_image; ?>" alt="Avatar" class="imagemels">
				                    			<?php }else{ ?>
				                    				<img src="<?php echo base_url();?>assets/dist/img/photo1.png" alt="Avatar" class="imagemels">
				                    			<?php } ?>
				                    		<div>
				                    			<font class="max-linesls">
				                    				<a href="<?php echo base_url('index.php/welcome/new_series?id='.$vaseriesrow->sid.'&story_id='.$vaseriesrow->story_id);?>">
				                    					<?php echo ($vaseriesrow->title);?>
				                    				</a>
				                    			</font> 
				                    		</div>
				                    		<div class="flextestls">
				                    			<font class="bynamels">By<font class="namehere"><a href="<?php echo base_url('index.php/welcome/profile?id='.$vaseriesrow->user_id);?>" style="color:#000"><?php echo $vaseriesrow->name;?></a>
				                    			</font>
				                    			</font><br>
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
				                    			<ul class="dropdown-menu list-inline" style="margin-top:-120px; position:relative; float:right;">
				                    				<li onclick="groupsuggest(<?php echo $vaseriesrow->sid; ?>);">
				                    					<a data-toggle="modal" data-target="#groupsuggest" title="COMMUNITY"><i class="fa fa-users"></i></a>
				                    				</li>
				                    				<li onclick="friend(<?php echo $vaseriesrow->sid;?>);">
				                    					<a data-toggle="modal" data-target="#friendsuggest" title="SUGGEST"><i class="fa fa-user"></i></a>
				                    				</li>
				                    				<li>
				                    					<a data-toggle="modal" data-target="#soc" href="" title="SOCIAL">
				                    						<i class="fa fa-share-alt"></i>
				                    					</a>
				                    				</li>
				                    			</ul>
				                    		</div>
				                    	
				                    	</div>
                                <?php } ?>
                     </div>
                    <center>
                        <div class="load-more" lastID="<?php echo $vaseriesrow->sid; ?>" style="display: none;">
                            <img src="<?php echo base_url();?>assets/images/imgs/loading.gif"/>
                        </div>
                    </center>
                    
                    <?php } else if(isset($profileviewall) && ($profileviewall->num_rows() > 0) && isset($_GET['type']) && ($_GET['type'] == 'story')){ ?>
        	            <div class="row pv-0" style="margin-top:20px;">
    		                <div class="col-md-6 col-xs-8">
    			            	<div class="titlei">STORIES</div>
    			            </div>
    			            <div class="col-md-6 col-xs-4">
			            	    <div class="view pull-right">
			            	       <a href="<?php echo base_url();?>index.php/welcome/profileviewall?id=<?php echo $_GET['id'];?>">Back</a> 
			            	    </div>
			                </div>
			            </div>
        	            <hr>
        	            <div class="">
                			<div class="jc-m" id="loadmoreall" style="display:flex; flex-wrap:wrap">
                    			<?php foreach($profileviewall->result() as $vastorysrow) { ?>
                    		    	<div class="card">
				                    	<div class="book-type"><?php echo $vastorysrow->gener;?></div>
				                    		<?php if(isset($vastorysrow->cover_image) && !empty($vastorysrow->cover_image)) { ?>
				                    		<img src="<?php echo base_url();?>assets/images/<?php echo $vastorysrow->cover_image; ?>" alt="Avatar" class="imageme">
				                    		<?php }else{ ?>
				                    			<img src="<?php echo base_url();?>assets/dist/img/photo1.png" alt="Avatar" class="imageme">
				                    		<?php } ?>
				                    	<div>
				                    		<font class="max-lines">
				                    			<a href="<?php echo base_url('index.php/welcome/new_series?id='.$vastorysrow->sid.'&story_id='.$vastorysrow->story_id);?>">
				                    				<?php echo ($vastorysrow->title);?>
				                    			</a>
				                    		</font> 
				                    	</div>
				                    	<div class="flextest">
				                    		<font class="byname">By<font class="namehere"><a href="<?php echo base_url('index.php/welcome/profile?id='.$vastorysrow->user_id);?>" style="color:#000"><?php echo $vastorysrow->name;?></a>
				                    		</font>
				                    		</font><br>
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
				                    		<ul class="dropdown-menu list-inline" style="margin-top:-120px; position:relative; float:right;">
				                    			<li onclick="groupsuggest(<?php echo $vastorysrow->sid; ?>);">
				                    				<a data-toggle="modal" data-target="#groupsuggest" title="COMMUNITY"><i class="fa fa-users"></i></a>
				                    			</li>
				                    			<li onclick="friend(<?php echo $vastorysrow->sid;?>);">
				                    				<a data-toggle="modal" data-target="#friendsuggest" title="SUGGEST"><i class="fa fa-user"></i></a>
				                    			</li>
				                    			<li>
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
                        <center>
                            <div class="load-more" lastID="<?php echo $vastorysrow->sid; ?>" style="display: none;">
                                <img src="<?php echo base_url();?>assets/images/imgs/loading.gif"/>
                            </div>
                        </center>
        	        <?php } elseif(isset($profileviewall) && ($profileviewall->num_rows() > 0) && isset($_GET['type']) && ($_GET['type'] == 'nano')){ ?>
        	            <div class="row pv-0" style="margin-top:40px;">
		                    <div class="col-md-6 col-xs-8">
			                	<div class="titlei">Nano Stories</div>
			                </div>
			                <div class="col-md-6 col-xs-4">
			                	<div class="view pull-right">
			            	        <a href="<?php echo base_url();?>index.php/welcome/profileviewall?id=<?php echo $_GET['id'];?>">Back</a> 
			            	    </div>
			                </div>
		                </div>
        	            <hr>
        	            <div class="">
            			    <div class="jc-m" id="loadmoreall" style="display:flex; flex-wrap:wrap">
                    			<?php foreach($profileviewall->result() as $vananorow) { ?>
			                        <div class="nano-stories" style="margin:8px">
			                        	<div>
			                        		<?php if(isset($vananorow->cover_image) && !empty($vananorow->cover_image)) { ?>
			                        			<img src="<?php echo base_url();?>assets/images/<?php echo $vananorow->cover_image; ?>" alt="Avatar" class="circle-image" alt="USER-NAME" style="height:50px;">
			                        		<?php }else{ ?>
			                        			<img src="<?php echo base_url();?>assets/dist/img/photo1.png" alt="Avatar" class="circle-image" alt="USER-NAME" style="height:50px;">
			                        		<?php } ?>
			                        		<h3 class="name-nanostories"><?php echo $vananorow->name;?> 
			                        		    <span style="float:right;">
			                        		        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			                        		            <i class="fa fa-ellipsis-v" style="font-size:14px;"></i>
			                        		        </a>
			                        		        <ul class="dropdown-menu" style="top:50px; float:right; left: 127px;">
			                        		            <li><a href=""><i class="fa fa-edit pr-10"></i> EDIT</a></li>
			                        		            <li><a href=""><i class="fa fa-trash pr-10"></i> DELETE</a></li>
			                        		        </ul>
			                        		    </span>
			                        	    </h3>
			                        	</div>
			                        	<div>
			                        		<hr style="width:100%;">
			                        		<a href="#" style="color:#000" data-toggle="modal" data-target="#modal-default270">
			                        		    <font class="text-in-nanostory"><?php echo ($vananorow->story); ?>
			                        		    </font>
			                        	    </a>
			                        	</div>
			                        	<div class="lastdiv">
			                        					<hr style="width:100%;">
			                        					<font style="color:#777"><b>7777</b>&nbsp;<i class="fa fa-thumbs-up" aria-hidden="true"></i></font>
			                        					<div style="float:right;color:#777">
			                        						<a href="" class="dropdown-toggle text-muted" data-toggle="dropdown">
			                        							<i class="fa fa-share-alt" aria-hidden="true"></i>
			                        						</a>
			                        						<ul class="dropdown-menu list-inline" style="margin-top:-85px; left:128px; position:absolute">
    		                        							<li onclick="groupsuggest(<?php echo $vananorow->sid; ?>);">
    		                        								<a data-toggle="modal" data-target="#groupsuggest"><i class="fa fa-users"></i></a>
    		                        							</li>
    		                        							<li onclick="friend(<?php echo $vananorow->sid;?>);">
    		                        								<a data-toggle="modal" data-target="#friendsuggest"><i class="fa fa-user"></i></a>
    		                        							</li>
			                        							<li>
			                        								<a data-toggle="modal" data-target="#soc" href="">
			                        									<i class="fa fa-share-alt"></i>
			                        								</a>
			                        							</li>
			                        						</ul>
			                        					</div>
			                        					<font style="float:right;color:#777"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;<b>77777</b>&nbsp;&nbsp;</font>
			                        				</div>
			                        </div>
			                    <?php } ?>
                			</div>
            		    </div>
            		    <center>
                            <div class="load-more" lastID="<?php echo $vananorow->sid; ?>" style="display: none;">
                                <img src="<?php echo base_url();?>assets/images/imgs/loading.gif"/>
                            </div>
                        </center>
                        
                        <?php if(isset($profileviewall) && ($profileviewall->num_rows() > 0) && isset($_GET['type']) && ($_GET['type'] == 'nano')){
                            foreach($profileviewall->result() as $vamodalnanorow) { ?>
                    		<div class="modal fade" id="modal-default<?php echo $vamodalnanorow->sid;?>">
                    			<div class="modal-dialog">
                    				<div class="modal-content">
                    					<div class="modal-header">
                    					    <div>
			                        		    <img src="<?php echo base_url();?>assets/dist/img/user2-160x160.jpg" alt="Avatar" class="circle-image" style="height:50px;">
			                        		    <h3 class="name-nanostories" style="padding-top:15px;"><?php echo $vamodalnanorow->name;?>
			                        		        <span class="pull-right">
			                        		            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            						        <span aria-hidden="true">&times;</span>
                            					        </button>
			                        		        </span>
			                        		    </h3>
			                        		</div>
                    						<!--<div class="box-header">
                    							<img src="<?php echo base_url();?>assets/dist/img/user2-160x160.jpg" class="user-image img-circle" alt="User Image" height="50">
                    							<h3 class="box-title"><?php echo $vamodalnanorow->name;?></h3>
                    							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    								<span aria-hidden="true">&times;</span>
                    							</button>
                    						</div>-->
                    					</div>
                    					<div class="modal-body">
                    						<p><?php echo $vamodalnanorow->story;?></p>
                    					</div>
                    					<div class="modal-footer">
                    						<ul class="list-inline">
                    							<li class="text-muted pull-left">
                    								10 <i class="fa fa-thumbs-up"></i>
                    							</li>
                    							<li class="pull-right">
                    								<a class="btn btn-social-icon btn-facebook"><i class="fa fa-facebook"></i></a>
                    							</li>
                    							<li class="pull-right">
                    								<a class="btn btn-social-icon btn-google"><i class="fa fa-google-plus"></i></a>
                    							</li>
                    							<li class="pull-right">
                    								<a class="btn btn-social-icon btn-twitter"><i class="fa fa-twitter"></i></a>
                    							</li>
                    						</ul>
                    					</div>
                    				</div> <!-- /.modal-content -->
                    			</div> <!-- /.modal-dialog -->
                            </div> <!-- /.modal -->
                        <?php } } ?>
                        
        	        <?php } ?>
        	        
        	    </div>
            </div>
          </div>
        </section>
    
    </div>
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
      url: "<?php echo base_url('index.php/welcome/pro_comment'); ?>",
      type: 'POST',
      data: $("form#profilecomments").serialize(),
      success: function(data) {
        if(data == 1){
            $.ajax({
                url: "<?php echo base_url('index.php/welcome/pro_commentpost'); ?>",
                type: 'POST',
                dataType: 'json',
                success: function(result) {
                    if(result.response){
                       // console.log(result.response[0]);
                        $("#commentresults").prepend('<li class="commentdelete'+result.response[0].cid+'" style="margin-bottom:5px;">'+
                        '<div class=""><a href="<?php echo base_url();?>index.php/welcome/profile?id='+result.response[0].user_id+'">'+
                        '<img src="<?php echo base_url();?>assets/images/2.png" style="border-radius: 50%;width:40px !important;height: 40px !important;margin-right: 10px;">'+
                        '</a></div><div class="comment_right clearfix"><div class="comment_info" style="padding-left:10px;">'+
                        '<a href="<?php echo base_url();?>index.php/welcome/profile?id='+result.response[0].user_id+'">'+result.response[0].name+'</a>'+
                        '<span class="pull-right"><a href="#" class="dropdown-toggle" data-toggle="dropdown" title="write" aria-expanded="true" style="padding: 0px 15px;">'+
                        '<i class="fa fa-ellipsis-v"></i></a> <ul class="dropdown-menu writemenu" style="top:auto; width:fit-content; padding:10px; left:200px">'+
                        '<li><a href="javascript:void(0);"><span onClick="editpro_comment('+result.response[0].cid+');"><i class="fa fa-pencil"></i> Edit</span></a></li>'+
                        '<li><a href="javascript:void(0);"><span onClick="deletepro_comment('+result.response[0].cid+');"><i class="fa fa-trash"></i> Delete</span></a></li></ul></span>'+
                        '<br>'+result.response[0].date+'<br></div><p style="margin: 8px 0px 2px 0px;" class="pcomment'+result.response[0].cid+'">'+result.response[0].pro_comment+'</p>'+
                        '<a href="javascript:void(0)" onClick="postReplycomment('+result.response[0].cid+')" style="color:#de1800;"> REPLY </a> | '+
                        '<a href="javascript:void(0)" onClick="replycomments('+result.response[0].profile_id+', '+result.response[0].cid+')" style="color:#de1800;"> 0 REPLIES</a>'+
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
        //location.reload();
      }
    });
  });
</script>
<script>
$(function() { // auto scroll load comments
    var profileid = "<?php echo $_GET['id'];?>";
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
        $("#loadingcomments").show();
        $.ajax({
            url: "<?php echo base_url();?>index.php/welcome/profilecomments/"+profileid,
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
    var limitstarting = $("#replycommentresults"+commentid+" li").length;
    var replycmtcount = $('#replycmtcount'+commentid).val();
    if(limitstarting){ }else{ limitstarting = 0; }
    $.ajax({
        url: "<?php echo base_url();?>index.php/welcome/profilereplycomments/"+profileid,
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
        url:'<?php echo base_url();?>index.php/welcome/editpro_comment/'+commentid,
        method: 'POST',
        dataType: "json",
        success:function(data){
            if(data.response[0].pro_comment) {
                console.log(data.response[0].pro_comment);
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
    $.post("<?php echo base_url();?>index.php/welcome/updateprocomment",{'comment':comments,'cid':cid},function(resultdata){
        if(resultdata == 2){
            $('span.pro_comment').text('Please Enter Comment');
        }else if(resultdata == 1){
            console.log('success');
            $('p.pcomment'+cid).html(comments);
            $('#editpro_comment').modal('hide');
        }else{
            console.log('fail');
        }
    });
});
    
function deletepro_comment(commentid){
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
function postReplycomment(commentid){
    $('div.postreplycomment'+commentid).html('<input type="text" id="replycmts'+commentid+'" value="" class="form-control" placeholder="Replay Comment..." required>'+
    '<span class="input-group-btn"><button type="submit" class="btn btn-success btn-flat" onclick="addreplycomment('+commentid+')">POST</button></span>');
}
function addreplycomment(commentid){
    var comments = $('#replycmts'+commentid).val();
    var profile_id = "<?php echo $_GET['id'];?>";
    if(comments){
        $.ajax({
            url:'<?php echo base_url();?>index.php/welcome/addreplycomment',
            method: 'POST',
            data: {'comment_id': commentid, 'pro_comment':comments, 'profile_id': profile_id},
            dataType: "json",
            success:function(data){
                if(data == 2){
                    $('.addreplaycmt'+commentid).text('Enter your Comments.');
                }else if(data == 1){
                    $('#replycommentresults'+commentid).html('<li style="margin-bottom:10px;" class="commentdelete'+commentid+'">'+
                    '<div class="media"><div class="media-left" style="padding-right:5px;"><img src="<?php echo base_url();?>assets/images/2.png" style="border-radius: 50%;width:30px !important;height: 30px !important;">'+
                    '</div><div class="media-body" style="background-color:#ddd; padding-left:8px; border-radius: 10px;">'+
                    '<b><?php echo ucfirst($this->session->userdata['logged_in']['name']); ?></b><p style="margin: 8px 0px 2px 0px;" class="pcomment'+commentid+'">'+comments+'</p></div></div></li>');
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
    $.post("<?php echo base_url();?>index.php/welcome/reportpro_comment",$("form#reportprocomment").serialize(),function(resultdata){
        if(resultdata == 2){
            $('span.reportpro_cmt').text('Please Enter your Report Message');
        }else if(resultdata == 1){
            console.log('success');
            $('#reportpro_comment').modal('hide');
        }else{
            console.log('fail');
        }
    });
});
</script>
<style>
.commentslist { height: 300px; overflow: auto;}
</style>

<script type="text/javascript">
$(document).ready(function(){
    $(window).scroll(function(){
        var lastID = $('.load-more').attr('lastID');
        if(($(window).scrollTop() == ($(document).height() - $(window).height())) && (lastID != 0)){
            $.ajax({
                type:'POST',
                url:'<?php echo base_url();?>index.php/welcome/profilealloadmore?id=<?php echo $_GET["id"];?>&type=<?php echo $_GET["type"];?>',
                data:'id='+lastID,
                beforeSend:function(){
                    $('.load-more').show();
                },
                success:function(html){
                    $('.load-more').remove();
                    $('#loadmoreall').append(html);
                }
            });
        }
    });
});
</script>
