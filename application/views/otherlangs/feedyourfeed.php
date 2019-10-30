<?php if(isset($yourfeeds) && ($yourfeeds->num_rows() > 0)){ ?>
    <div id="yloadmoreall">
    <?php foreach ($yourfeeds->result() as $yourfeed) { ?>
    	<div class="box box-widget" style="background:#fff; border:1px solid #dddddd;margin-bottom: 10px;" id="delcomm<?php echo $yourfeed->id;?>"> 
    		<div class="box-header with-border">
    			<div class="user-block">
    				<?php if(isset($yourfeed->profile_image) && !empty($yourfeed->profile_image)) { ?>
    					<img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $yourfeed->profile_image;?>" alt="<?php echo $yourfeed->name;?>">
    				<?php } else { ?>
    					<img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo $yourfeed->name;?>">
    				<?php } ?>
    				<span class="dropdown pull-right">
    					<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" title="Click Here to Report" aria-expanded="false">
    						<i class="fa fa-ellipsis-v pull-right"></i>
    					</a>
    					<ul class="dropdown-menu pull-right">
    				    <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($yourfeed->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
    				        <li><a href="javascript:void(0);" onclick="editcomm_post(<?php echo $yourfeed->id;?>, <?php echo $yourfeed->user_id;?>)"><i class="fa fa-pencil"></i> EDIT </a></li>
    				        <li><a href="javascript:void(0);" onclick="deletecomm_post(<?php echo $yourfeed->id;?>, <?php echo $yourfeed->user_id;?>)"><i class="fa fa-trash"></i> DELETE </a></li>
    					<?php }else { ?>
    					    <li><a href="javascript:void(0);" onclick="reportcomm_post(<?php echo $yourfeed->id;?>, <?php echo $yourfeed->user_id;?>)"><i class="fa fa-exclamation-triangle"></i> REPORT </a></li>
    					<?php } ?>
    					</ul>
    				</span>
    				<span class="username"><a href="<?php echo base_url().$this->uri->segment(1).'/'.$yourfeed->profile_name; ?>"><?php echo $yourfeed->name;?></a></span>
    				<span class="description"><a href="<?php echo base_url().$this->uri->segment(1).'/'.'community/'.$yourfeed->gener; ?>">
    				    <i style="color:#040cff;"><?php echo $yourfeed->gener;?></i></a> - <?php echo get_ydhmdatetime($yourfeed->date);?></span>
    			</div>
    		</div>
    		<?php if(($yourfeed->type=='url')) { ?>
    			<div class="box-body">
    			    <?php if(isset($yourfeed->urldescription) && !empty($yourfeed->urldescription)){
						if(strlen($yourfeed->urldescription) > 200){ ?>
    				    <div class="user-block mb-10"><?php echo mb_substr($yourfeed->urldescription, 0, 200); ?>
    		                <span class="showhidedesc<?php echo $yourfeed->id;?>" style="display:none;"><?php echo mb_substr($yourfeed->urldescription,200); ?></span>
    		                <span class="smorelessdots<?php echo $yourfeed->id;?>">...</span>
    		                <u onclick="showhidedesc(<?php echo $yourfeed->id;?>)" class="smoreless<?php echo $yourfeed->id;?>" style="cursor: pointer;color:red;">show-more</u></div>
    				<?php } else{ ?>
    				    <div class="user-block mb-10"> <?php echo $yourfeed->urldescription; ?></div>
    				<?php } } ?>
    				<?php if(!empty($yourfeed->title)){ ?>
    					<div class="media border-box" style="margin-top:2px;">
    						<div class="media-left">
    							<a href="<?php echo $yourfeed->titleurl;?>" target="_blank">
    								<?php if((!empty($yourfeed->image) && ($yourfeed->type == "url"))) { ?>
    									<img src="<?php echo $yourfeed->image;?>" class="media-object img-v" alt="<?php echo $yourfeed->title;?>">
    								<?php }elseif((!empty($yourfeed->image) && ($yourfeed->type != "url"))){ ?>
    									<img src="<?php echo base_url();?>assets/images/<?php echo $yourfeed->image;?>" class="media-object img-v" alt="<?php echo $yourfeed->title;?>">
    								<?php } else { ?>
    									<img src="<?php echo base_url();?>assets/default/feed_comm.jpeg" class="media-object img-v" alt="<?php echo $yourfeed->title;?>">
    								<?php } ?>
    							</a>
    						</div>
    						<div class="media-body" style="padding-top:15px;">
    							<a href="<?php echo $yourfeed->titleurl;?>" target="_blank"> 
    								<h4 class="media-heading"><b><?php echo ucfirst($yourfeed->title);?></b></h4>
    							</a>
    							<p class="media-heading edittext<?php echo $yourfeed->id;?>"><?php echo strip_tags($yourfeed->story);?></p>
    						</div>
    					</div>
    				<?php } else { ?>
    					<p class="media-heading edittext<?php echo $yourfeed->id;?>"><?php echo $yourfeed->story;?></p>
    				<?php } ?>
    			</div>
    		<?php } else { ?>
    			<div class="box-body">
    			    <?php if(isset($yourfeed->urldescription) && !empty($yourfeed->urldescription)){
						if(strlen($yourfeed->urldescription) > 200){ ?>
    				    <div class="user-block mb-10"><?php echo mb_substr($yourfeed->urldescription, 0, 200); ?>
    		                <span class="showhidedesc<?php echo $yourfeed->id;?>" style="display:none;"><?php echo mb_substr($yourfeed->urldescription,200); ?></span>
    		                <span class="smorelessdots<?php echo $yourfeed->id;?>">...</span>
    		                <u onclick="showhidedesc(<?php echo $yourfeed->id;?>)" class="smoreless<?php echo $yourfeed->id;?>" style="cursor: pointer;color:red;">show-more</u></div>
    				<?php } else{ ?>
    				    <div class="user-block mb-10"> <?php echo $yourfeed->urldescription; ?></div>
    				<?php } } ?>
    				
    			    <?php if(isset($yourfeed->typeoftype) && ($yourfeed->typeoftype == 'quotes')){ ?>
    				    <p class="sizep text-justify edittext<?php echo $yourfeed->id;?>" style="margin:0px;"><?php echo $yourfeed->story;?></p>
    				<?php } else if(strpos($yourfeed->story, '<em> Written by <a href=')) { ?>
			            <p class="edittext<?php echo $yourfeed->id;?>" style="margin:0px;"><?php echo $yourfeed->story;?></p>
    				<?php } else{ ?>
    					<?php if(isset($yourfeed->story) && (strlen($yourfeed->story) > 200)){ ?>
    					    <p class="text-justify edittext<?php echo $yourfeed->id;?>" style="margin:0px;"><?php echo mb_substr($yourfeed->story, 0, 200); ?>
    			                <span class="showhidedesc<?php echo $yourfeed->id;?>" style="display:none;"><?php echo mb_substr($yourfeed->story,200); ?></span>
    			                <span class="smorelessdots<?php echo $yourfeed->id;?>">...</span>
    			                <u onclick="showhidedesc(<?php echo $yourfeed->id;?>)" class="smoreless<?php echo $yourfeed->id;?>" style="cursor: pointer;color:red;">show-more</u></p>
    					<?php } else{ ?>
    					    <p class="text-justify edittext<?php echo $yourfeed->id;?>" style="margin:0px;"><?php echo $yourfeed->story;?></p>
    					<?php } ?>
    				<?php } ?> 
    			</div>
    		<?php } ?>
    		<div class="box-body">
				<?php if(isset($commstory_likes) && in_array($yourfeed->id, $commstory_likes)) { ?>
					<button class="btn btn-default btn-xs unlike<?php echo $yourfeed->id;?>" onclick="unlikestory(<?php echo $yourfeed->id;?>)" style="background:none; color:#337ab7;"><i class="fa fa-thumbs-up"></i> Like</button>
				<?php } else { ?>
					<button class="btn btn-default btn-xs like<?php echo $yourfeed->id;?>" onclick="likestory(<?php echo $yourfeed->id;?>)" style="background:none;"><i class="fa fa-thumbs-up"></i> Like</button>
				<?php } ?>
				<span class="pl-10" onclick="commusocialshare(<?php echo $yourfeed->id;?>, '<?php echo preg_replace('/\s+/', '-', $yourfeed->gener); ?>');">
                    <a data-toggle="modal" data-target="#soc" style="color:#333;cursor:pointer;"><i class="fa fa-share"></i> Share</a>
                </span>
				<span class="pull-right text-muted" onClick="tcomments(<?php echo $yourfeed->id;?>);">
					<span id="told_like<?php echo $yourfeed->id;?>"><?php echo $yourfeed->likes; ?></span> <span id="tnew_like"></span> Likes &nbsp; 
				    <span id="told_cmt<?php echo $yourfeed->id;?>"  style="cursor:pointer"><?php echo get_storycmtcount($yourfeed->id);?></span> <span  style="cursor:pointer">Comments</span>
				</span>
			</div>
    		
    		<!-- /.box-footer -->
    		<div class="box-footer">
    			<div id="tpostscommunity_commentpost<?php echo $yourfeed->id; ?>">
    				<?php if (isset($this->session->userdata['logged_in'])) { 
    				    if(isset($this->session->userdata['logged_in']['profile_image']) && 
    				        !empty($this->session->userdata['logged_in']['profile_image'])) { ?>
    					<img src="<?php echo base_url().'assets/images/'.$this->session->userdata['logged_in']['profile_image']; ?>" style="width: 47px;height:37px; margin-right:10px;" class="img-responsive img-circle img-sm" alt="<?php echo $yourfeed->title;?>">
    				<?php } else { ?>
    					<img src="<?php echo base_url();?>assets/images/2.png" style="width: 47px;height:37px; margin-right:10px;" class="img-responsive img-circle img-sm" alt="<?php echo $yourfeed->title;?>">
    				<?php } } ?>
    				<div class="input-group">
    				    <input type="hidden" name="tstory_id" value="<?php echo $yourfeed->id; ?>">
    					<input type="text" name="tcomment" placeholder="Type Comment Message ..." class="form-control" required="">
    					<input type="hidden" name="tcomm_id" value="<?php echo $yourfeed->comm_id; ?>">
    					<span class="input-group-btn">
    						<button type="submit" class="btn btn-success btn-flat btnspinner<?php echo $yourfeed->id;?>" onclick="tpostscomm_comments(<?php echo $yourfeed->id;?>)"> Comment </button>
    					</span>
    				</div>
    			</div>
    		</div>
    		<!-- /.box-footer -->
            
            <div class="box-comments tajaxcomment<?php echo $yourfeed->id;?>" style="background: #fff;"> </div>
    		<?php $comments = get_comments($yourfeed->id);
    			if(isset($comments) && ($comments->num_rows()>0)){ ?>
    			<div id="topmyList<?php echo $yourfeed->id;?>" style="display:none;">
    				<?php foreach($comments->result() as $ycomment){ ?>
    					<div class="box-footer box-comments editdelete<?php echo $ycomment->id;?>" style="padding-bottom:0;">
    						<div class="box-comment">
    							<?php if(isset($ycomment->profile_image) && !empty($ycomment->profile_image)){ ?>
    								<img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $ycomment->profile_image;?>" alt="<?php echo ucfirst($ycomment->name);?>">
    							<?php } else { ?>
    								<img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo ucfirst($ycomment->name);?>">
    							<?php } ?>
								<div class="comment-text">
									<span class="username" style="padding-top:6px;">&nbsp; <a href="<?php echo base_url().$this->uri->segment(1).'/'.$ycomment->profile_name; ?>"><p class="namers"><?php echo ucfirst($ycomment->name);?></p></a>
									    <span class="dropdown" style="float:right;">
                                            <a href="javascript:void(0);" class="dropdown-toggle elli" data-toggle="dropdown" aria-expanded="true">
                                             <i class="fa fa-ellipsis-v"></i> </a> 
                                            <ul class="dropdown-menu pull-right">
                                                <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($ycomment->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
                                                <li><a href="javascript:void(0);" onClick="editcommcomment(<?php echo $ycomment->id;?>);"><span><i class="fa fa-pencil"></i> EDIT</span></a></li>
                                                <li><a href="javascript:void(0);" onClick="deletecommcomment(<?php echo $ycomment->id;?>);"><span><i class="fa fa-trash"></i> DELETE</span></a></li>
                                                <?php }else{ ?>
                                                <li><a href="javascript:void(0);" onClick="reportcommcomment(<?php echo $ycomment->id;?>, <?php echo $ycomment->user_id;?>);"><span><i class="fa fa-exclamation-triangle"></i> REPORT</span></a></li>
                                                <?php } ?>
                                            </ul>
                                        </span>
                                        <span class="text-muted pull-right datecv"><?php echo get_ydhmdatetime($ycomment->date);?></span>
									</span>
								</div>
								<div style="margin:4px 0px 6px 2px" class="comment-text">
									<?php if(strlen($ycomment->comment) > 200){ ?>
								        <span style="word-break:break-word;" class="more pcomment<?php echo $ycomment->id;?>"><?php echo mb_substr($ycomment->comment, 0, 200); ?>
								            <span class="showhide<?php echo $ycomment->id;?>" style="display:none;"><?php echo mb_substr($ycomment->comment,200); ?></span>
								            <span class="smorelessdots<?php echo $ycomment->id;?>">...</span>
								            <u onclick="showhide(<?php echo $ycomment->id;?>)" class="moreless<?php echo $ycomment->id;?>" style="cursor: pointer;color:red;">show-more</u></span>
								    <?php } else{ ?>
								        <span style="word-break:break-word;" class="more pcomment<?php echo $ycomment->id;?>"><?php echo $ycomment->comment;?></span>
								    <?php } ?>
									<div style="margin:5px 0;" class="">
                                        <a href="javascript:void(0);" onClick="toppostReplycomment(<?php echo $ycomment->id;?>,<?php echo $ycomment->comm_id;?>,<?php echo $ycomment->story_id;?>)" class="pull-left replycv" title="Reply">REPLY</a> <a href="javascript:void(0);" class="pull-left replycv">I</a>
                                        <a href="javascript:void(0);" onClick="toppostdisplayreplies(<?php echo $ycomment->id;?>,<?php echo $ycomment->comm_id;?>,<?php echo $ycomment->story_id;?>)" class="pull-left replycv" title="Replies"> 
                                            <span class="told_subcmtcount<?php echo $ycomment->id;?>"><?php echo get_subcmtcount($ycomment->id);?></span> REPLIES</a>
                                    </div>
                                </div>
                                <div class="comment-text">
                                    <div class="input-group toppostreplycomment<?php echo $ycomment->id;?>" style="width:100%; margin-bottom:5px;"><!-- Reply comment form --></div>
								</div>
    							<div class="topsubcomments" style="display:none;" id="topmysubList<?php echo $yourfeed->id;?>_<?php echo $ycomment->id;?>">
    							    <center> <span id="topspinnertab<?php echo $ycomment->id;?>">
                                        <img src="<?php echo base_url();?>/assets/landing/svg/spinnertab.svg" class="spinner" style="float: inherit;">
                                    </span> </center>
    								<?php $topsubcomments = get_subcomments($yourfeed->id, $ycomment->id); 
    								    if(isset($topsubcomments) && ($topsubcomments->num_rows() > 0)){ foreach($topsubcomments->result() as $topsubcomment){ ?>
    									<div class="media editdelete<?php echo $topsubcomment->id;?>" style="padding-left:10px;margin-top:5px;margin-bottom:5px;">
    									    <span class="media-left">
    									        <?php if(isset($topsubcomment->profile_image) && !empty($topsubcomment->profile_image)){ ?>
    									            <img class="img-circle" style="width:25px;" src="<?php echo base_url();?>assets/images/<?php echo $topsubcomment->profile_image;?>" alt="<?php echo ucfirst($topsubcomment->name);?>">
    									        <?php } else { ?>
    									            <img class="img-circle" style="width:25px;" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo ucfirst($topsubcomment->name);?>">
    									        <?php } ?>
    						                </span>
    									    <span class="media-body bodycv">
									            <span class="username"><a href="<?php echo base_url().$this->uri->segment(1).'/'.$topsubcomment->profile_name; ?>"><p class="namers"><?php echo ucfirst($topsubcomment->name);?></p></a><span class="dropdown" style="float:right;">
                                                    <a href="javascript:void(0);" class="dropdown-toggle elli" data-toggle="dropdown" aria-expanded="true" style="padding: 0px 10px 0px 20px;">
                                                     <i class="fa fa-ellipsis-v"></i> </a> 
                                                    <ul class="dropdown-menu pull-right">
                                                        <?php if($topsubcomment->user_id == $this->session->userdata['logged_in']['user_id']){ ?>
                                                        <li><a href="javascript:void(0);" onClick="editcommcomment(<?php echo $topsubcomment->id;?>);"><span><i class="fa fa-pencil"></i> EDIT</span></a></li>
                                                        <li><a href="javascript:void(0);" onClick="deletecommcomment(<?php echo $topsubcomment->id;?>);"><span><i class="fa fa-trash"></i> DELETE</span></a></li>
                                                        <?php } else{ ?>
                                                        <li><a href="javascript:void(0);" onClick="reportcommcomment(<?php echo $topsubcomment->id;?>, <?php echo $topsubcomment->user_id;?>);"><span><i class="fa fa-exclamation-triangle"></i> REPORT</span></a></li>
                                                        <?php } ?>
                                                    </ul>
                                                </span><span class="text-muted pull-right datecv"><?php echo get_ydhmdatetime($topsubcomment->date);?></span>
									            </span>
									            <?php if(strlen($topsubcomment->comment) > 200){ ?>
											        <span class="more pcomment<?php echo $topsubcomment->id;?>" style="padding-left: 6px;word-break:break-word;"><?php echo mb_substr($topsubcomment->comment, 0, 200); ?>
											            <span class="showhide<?php echo $topsubcomment->id;?>" style="display:none;"><?php echo mb_substr($topsubcomment->comment,200); ?></span>
											            <span class="smorelessdots<?php echo $topsubcomment->id;?>">...</span>
											            <u onclick="showhide(<?php echo $topsubcomment->id;?>)" class="moreless<?php echo $topsubcomment->id;?>" style="cursor: pointer;color:red;">show-more</u></span>
											    <?php } else{ ?>
											        <span class="more pcomment<?php echo $topsubcomment->id;?>" style="padding-left: 6px;word-break:break-word;"><?php echo $topsubcomment->comment;?></span>
											    <?php } ?>
    								        </span>
    								    </div>
    									<?php } $commlastsubcomment = get_commlastsubcomment($yourfeed->id, $ycomment->id); 
    									    if($topsubcomment->id > $commlastsubcomment){ ?>
    									<a href="javascript:void(0);">
    									    <span class="toploadsubcomment<?php echo $ycomment->id;?>" onClick="topcommloadsubcomment(<?php echo $yourfeed->id;?>, <?php echo $ycomment->id;?>, <?php echo $topsubcomment->id;?>)">
    									        <center>View More</center></span></a>
    								    <?php } else{ ?>
    								    <span class="toploadsubcomment"></span>
    								<?php } } ?>
    							</div>
    					    </div>
    					</div>
    			    <?php } ?>
    		        <a href="javascript:void(0);"><span class="toploadmorespan<?php echo $yourfeed->id;?>" onClick="topcommloadmore(<?php echo $yourfeed->id;?>, <?php echo $ycomment->id;?>)"><center>View More</center></span></a>
    		    </div>
    		<?php } ?>
    	</div>
    	<!-- /.box-footer -->
    <?php } ?>
    </div>
    <div id="yload_data_message"></div>
<?php } else{ ?><center><div style="padding-top:50px;">No Posts yet!</div></center><?php } ?>