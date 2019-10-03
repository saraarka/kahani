<?php if(isset($insertedposts) && ($insertedposts->num_rows() > 0)){ foreach ($insertedposts->result() as $key) { ?>
	<div class="box box-widget" style="background:#fff; border:1px solid #dddddd; margin-bottom:10px;" id="delcomm<?php echo $key->id;?>">
	    <div class="box-header with-border">
			<div class="user-block">
			    <span style="width:40px; height:40px;">
				<?php if(isset($key->profile_image) && !empty($key->profile_image)) { ?>
					<img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $key->profile_image;?>" alt="<?php echo $key->name;?>">
				<?php } else { ?>
					<img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo $key->name;?>">
				<?php } ?>
				</span>
				<span class="username">
				    <a href="<?php echo base_url().$key->profile_name; ?>"><?php echo $key->name;?></a>
				    <span class="dropdown" style="float:right;">
    				    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" title="write" aria-expanded="false">
    						<i class="fa fa-ellipsis-v pull-right"></i>
    					</a>
    					<ul class="dropdown-menu pull-right">
    						<li><a href="javascript:void(0);" onclick="editcomm_post(<?php echo $key->id;?>, <?php echo $key->user_id;?>)"><i class="fa fa-pencil"></i> EDIT </a></li>
    						<li><a href="javascript:void(0);" onclick="deletecomm_post(<?php echo $key->id;?>, <?php echo $key->user_id;?>)"><i class="fa fa-trash"></i> DELETE </a></li>
    					</ul>
    				</span>
				</span>
				<span class="description datecv">1 minute ago</span>
			</div>
		</div>
	    <?php if(isset($key->type) && ($key->type=='url')) { ?>
    		<div class="box-body">
    	        <?php if(isset($key->urldescription) && !empty($key->urldescription) && (strlen($key->urldescription) > 200)){ ?>
    			    <div class="user-block mb-10"><?php echo mb_substr($key->urldescription, 0, 200); ?>
    	                <span class="showhidedesc<?php echo $key->id;?>" style="display:none;"><?php echo mb_substr($key->urldescription,200); ?></span>
    	                <span class="smorelessdots<?php echo $key->id;?>">...</span>
    	                <u onclick="showhidedesc(<?php echo $key->id;?>)" class="smoreless<?php echo $key->id;?>" style="cursor: pointer;color:red;">show-more</u></div>
    			<?php } else{ ?>
    			    <div class="user-block mb-10"> <?php echo $key->urldescription; ?></div>
    			<?php } ?>
    			<?php if(!empty($key->title)) { ?>
    				<div class="media border-box" style="margin-top:2px;">
    					<div class="media-left">
    						<a href="<?php echo $key->titleurl;?>" target="_blank">
    							<?php if(!empty($key->image)) { ?>
    								<img src="<?php echo $key->image;?>" class="media-object img-v" alt="<?php echo ucfirst($key->title);?>">
    							<?php } else { ?>
    								<img src="<?php echo base_url();?>assets/default/feed_comm.jpeg" class="media-object img-v" alt="<?php echo ucfirst($key->title);?>">
    							<?php } ?>
    						</a>
    					</div>
    					<div class="media-body" style="padding-top:15px;">
    						<a href="<?php echo $key->titleurl;?>" target="_blank"> 
    							<h4 class="media-heading"><b><?php echo ucfirst($key->title);?></b></h4>
    						</a>
    						<?php if(isset($key->typeoftype) && ($key->typeoftype == 'quotes')){ ?>
    						    <p class="sizep text-justify edittext<?php echo $key->id;?>" style="margin:0px;"><?php echo $key->story;?></p>
    						<?php } else if(strpos($key->story, '<em> Written by <a href=')) { ?>
    						    <p class="edittext<?php echo $key->id;?>" style="margin:0px;"><?php echo $key->story;?></p>
    						<?php } else{ ?>
    						    <?php if(isset($key->story) && !empty($key->story)){ ?> 
    						    <?php if (strlen($key->story) > 200){ ?>
    							    <p class="media-heading text-justify edittext<?php echo $key->id;?>" style="margin:0px;"><?php echo mb_substr($key->story, 0, 200); ?>
    					                <span class="showhidedesc<?php echo $key->id;?>" style="display:none;"><?php echo mb_substr($key->story,200); ?></span>
    					                <span class="smorelessdots<?php echo $key->id;?>">...</span>
    					                <u onclick="showhidedesc(<?php echo $key->id;?>)" class="smoreless<?php echo $key->id;?>" style="cursor: pointer;color:red;">show-more</u></p>
    							<?php } else{ ?>
    							    <p class="media-heading text-justify edittext<?php echo $key->id;?>" style="margin:0px;"><?php echo $key->story;?></p>
    							<?php } } ?>
    						<?php } ?>
    					</div>
    				</div>
    			<?php } else { ?>
    				<?php if(isset($key->typeoftype) && ($key->typeoftype == 'quotes')){ ?>
    				    <p class="sizep text-justify edittext<?php echo $key->id;?>" style="margin:0px;"><?php echo $key->story;?></p>
    				<?php } else if(strpos($key->story, '<em> Written by <a href=')) { ?>
    				    <p class="edittext<?php echo $key->id;?>" style="margin:0px;"><?php echo $key->story;?></p>
    				<?php } else{ ?>
    				    <?php if(isset($key->story) && !empty($key->story)){ ?> 
    				    <?php if (strlen($key->story) > 200){ ?>
    					    <p class="text-justify edittext<?php echo $key->id;?>" style="margin:0px;"><?php echo mb_substr($key->story, 0, 200); ?>
    			                <span class="showhidedesc<?php echo $key->id;?>" style="display:none;"><?php echo mb_substr($key->story,200); ?></span>
    			                <span class="smorelessdots<?php echo $key->id;?>">...</span>
    			                <u onclick="showhidedesc(<?php echo $key->id;?>)" class="smoreless<?php echo $key->id;?>" style="cursor: pointer;color:red;">show-more</u></p>
    					<?php } else{ ?>
    					    <p class="text-justify edittext<?php echo $key->id;?>" style="margin:0px;"><?php echo $key->story;?></p>
    					<?php } } ?>
    				<?php } ?>
    			<?php } ?>
    		</div>
    	<?php } else { ?>
    		<div class="box-body">
    		    <?php if(isset($key->urldescription) && !empty($key->urldescription)){
    		        if(strlen($key->urldescription) > 200){ ?>
    			    <div class="user-block mb-10"><?php echo mb_substr($key->urldescription, 0, 200); ?>
    	                <span class="showhidedesc<?php echo $key->id;?>" style="display:none;"><?php echo mb_substr($key->urldescription,200); ?></span>
    	                <span class="smorelessdots<?php echo $key->id;?>">...</span>
    	                <u onclick="showhidedesc(<?php echo $key->id;?>)" class="smoreless<?php echo $key->id;?>" style="cursor: pointer;color:red;">show-more</u></div>
    			<?php } else{ ?>
    			    <div class="user-block mb-10"> <?php echo $key->urldescription; ?></div>
    			<?php } } ?>
    
    			<?php if(isset($key->typeoftype) && ($key->typeoftype == 'quotes')){ ?>
    			    <p class="sizep text-justify edittext<?php echo $key->id;?>" style="margin:0px;"><?php echo $key->story;?></p>
    			<?php } else if(strpos($key->story, '<em> Written by <a href=')) { ?>
    			    <p class="edittext<?php echo $key->id;?>" style="margin:0px;"><?php echo $key->story;?></p>
    			<?php } else{ ?>
    			    <?php if(isset($key->story) && !empty($key->story)){ ?> 
    			    <?php if (strlen($key->story) > 200){ ?>
    				    <p class="text-justify edittext<?php echo $key->id;?>" style="margin:0px;line-height: 1.85em;    font-size: 1.2em;"><?php echo mb_substr($key->story, 0, 200); ?>
    		                <span class="showhidedesc<?php echo $key->id;?>" style="display:none;"><?php echo mb_substr($key->story,200); ?></span>
    		                <span class="smorelessdots<?php echo $key->id;?>">...</span>
    		                <u onclick="showhidedesc(<?php echo $key->id;?>)" class="smoreless<?php echo $key->id;?>" style="cursor: pointer;color:red;">show-more</u></p>
    				<?php } else{ ?>
    				    <p class="text-justify edittext<?php echo $key->id;?>" style="margin:0px;line-height: 1.85em;font-size: 1.2em;"><?php echo $key->story;?></p>
    				<?php } } ?>
    			<?php } ?>
    		</div>
    	<?php } ?>
    	<div class="box-body">
    		<?php if(isset($commstory_likes) && in_array($key->id, $commstory_likes)) { ?>
    		    <button class="btn btn-default btn-xs unlike<?php echo $key->id;?>" onclick="unlikestory(<?php echo $key->id;?>)" style="background:none; color:#337ab7;"><i class="fa fa-thumbs-up"></i> Like</button>
    		<?php } else { ?>
    		    <button class="btn btn-default btn-xs like<?php echo $key->id;?>" onclick="likestory(<?php echo $key->id;?>)" style="background:none;"><i class="fa fa-thumbs-up"></i> Like</button>
    		<?php } ?>
    		<span style="padding-left:5px;"><a data-toggle="modal" data-target="#soc" href="javascript:void(0);" style="color:#333;"><i class="fa fa-share"></i> Share</a></span>
    		<span class="pull-right text-muted" onClick="comments(<?php echo $key->id;?>);">
    			<span id="old_like<?php echo $key->id;?>"><?php echo $key->likes; ?></span><span id="new_like"></span> Likes &nbsp; 
    			<?php $commentcount = 0; if(isset($comm_comment_count) && ($comm_comment_count->num_rows()>0)) {
    				foreach($comm_comment_count->result() as $reviews2) { 
    					if($reviews2->story_id == $key->id) {
    						$commentcount = $reviews2->commentcount;
    					} ?>
    			<?php } } ?><span id="old_cmt<?php echo $key->id;?>" style="cursor:pointer"><?php echo $commentcount; ?></span> Comments
    		</span>
    	</div>
		
		<!-- /.box-footer -->
		<div class="box-footer">
			<div id="community_commentpost<?php echo $key->id; ?>">
				<?php if (isset($this->session->userdata['logged_in'])) { 
				    if(isset($this->session->userdata['logged_in']['profile_image']) && 
				        !empty($this->session->userdata['logged_in']['profile_image'])) { ?>
							<img src="<?php echo base_url().'assets/images/'.$this->session->userdata['logged_in']['profile_image']; ?>" style="width: 47px;height: 37px; margin-right:10px;" class="img-responsive img-circle img-sm" alt="User Image">
				<?php } else { ?>
					<img src="<?php echo base_url();?>assets/images/2.png" style="width: 47px;height:37px; margin-right:10px;" class="img-responsive img-circle img-sm" >
				<?php } } ?>
				<div class="input-group">
				    <input type="hidden" name="story_id" value="<?php echo $key->id; ?>">
					<input type="text" name="comment" placeholder="Type Comment Message ..." class="form-control" required="">
					<input type="hidden" name="comm_id" value="<?php echo $key->comm_id; ?>">
					<span class="input-group-btn">
						<button type="submit" class="btn btn-success btn-flat" onclick="comm_comments(<?php echo $key->id;?>)"> Comment </button>
					</span>
				</div>
			</div>
		</div>
		<!-- /.box-footer -->
		<div class="box-footer box-comments ajaxcomment<?php echo $key->id;?>" style="background: #fff;"> </div>
		<?php $comments = get_comments($key->id);
			if(isset($comments) && ($comments->num_rows()>0)){ ?>
			<div id="myList<?php echo $key->id;?>" style="display: none;">
				<?php foreach($comments->result() as $comment) { ?>
					<div class="box-footer box-comments editdelete<?php echo $comment->id;?>" style="padding-bottom:0px;">
						<div class="box-comment">
							<?php if(isset($comment->profile_image) && !empty($comment->profile_image)){ ?>
							    <img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $comment->profile_image;?>" alt="<?php echo ucfirst($comment->name);?>">
							<?php } else { ?>
								<img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo ucfirst($comment->name);?>">
							<?php } ?>
							<div class="comment-text">
								<span class="username" style="padding-top:6px;">&nbsp; 
								    <a href="<?php echo base_url().$comment->profile_name; ?>"><?php echo ucfirst($comment->name);?></a>
									<span class="dropdown" style="float:right;">
                                        <a href="javascript:void(0);" class="dropdown-toggle elli" data-toggle="dropdown" aria-expanded="true">
                                         <i class="fa fa-ellipsis-v"></i> </a> 
                                        <ul class="dropdown-menu pull-right">
                                            <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($comment->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
                                            <li><a href="javascript:void(0);" onClick="editcommcomment(<?php echo $comment->id;?>);"><span><i class="fa fa-pencil"></i> EDIT</span></a></li>
                                            <li><a href="javascript:void(0);" onClick="deletecommcomment(<?php echo $comment->id;?>);"><span><i class="fa fa-trash"></i> DELETE</span></a></li>
                                            <?php } else{ ?>
                                            <li><a href="javascript:void(0);" onClick="reportcommcomment(<?php echo $comment->id;?>,<?php echo $comment->user_id;?>);"><span><i class="fa fa-exclamation-triangle"></i> REPORT</span></a></li>
                                            <?php } ?>
                                        </ul>
                                    </span>
									<span class="text-muted pull-right datecv"><?php echo get_ydhmdatetime($comment->date);?></span>
								</span>
							</div>
							<div style="margin:8px 0 6px 2px" class="comment-text">
							    <div class="more <?php echo $comment->id;?>"><?php echo $comment->comment; ?></div>
								<div style="margin:5px 0;" class="">
                                    <a href="javascript:void(0)" onClick="postReplycomment(<?php echo $comment->id;?>,<?php echo $comment->comm_id;?>,<?php echo $comment->story_id;?>)" class="pull-left replycv" title="Reply">REPLY</a> 
                                    <a href="javascript:void(0)" onClick="displayreplies(<?php echo $comment->id;?>,<?php echo $comment->comm_id;?>,<?php echo $comment->story_id;?>)" class="pull-left replycv" title="Replies">| <?php echo get_subcmtcount($comment->id);?> REPLIES</a>
                                </div>
							</div><br>
							<div class="comment-text">
							    <div class="input-group postreplycomment<?php echo $comment->id;?>" style="margin-bottom:5px;"><!-- Reply comment form --></div>
							</div>
						</div>
					</div>
			    <?php } ?> 
		        <span class="loadmorespan" id="<?php echo $key->id;?>">
					<center>Read More...</center>
				</span>
		    </div>
		<?php } ?>
	</div>
<?php } } ?>