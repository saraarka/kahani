<?php if(isset($loadcommustories) && ($loadcommustories->num_rows() > 0)){ foreach ($loadcommustories->result() as $key) { ?>
	<div class="box box-widget" style="background:#fff; border:1px solid #dddddd; margin-bottom:10px;" id="delcomm<?php echo $key->id;?>">        
		<?php if(isset($key->type) && ($key->type='url')) { ?>
		<div class="box-header with-borders">
			<div class="user-block">
			    <span style="width:40px; height:40px;">
				<?php if(isset($key->profile_image) && !empty($key->profile_image)) { ?>
					<img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $key->profile_image;?>" alt="User Image">
				<?php } else { ?>
					<img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="User Image">
				<?php } ?>
				</span>
				<span class="username">
				    <a href="#"><?php echo $key->name;?></a> 
				    <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($key->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
						<span class="dropdown" style="float:right;">
							<a href="#" class="dropdown-toggle elli" data-toggle="dropdown" title="write" aria-expanded="false">
								<i class="fa fa-ellipsis-v"></i>
							</a>
							<ul class="dropdown-menu pull-right">
								<li><a href="javascript:void(0);" onclick="editcomm_post(<?php echo $key->id;?>, <?php echo $key->user_id;?>)"><i class="fa fa-pencil"></i> EDIT </a></li>
								<li><a href="javascript:void(0);" onclick="deletecomm_post(<?php echo $key->id;?>, <?php echo $key->user_id;?>)"><i class="fa fa-trash"></i> DELETE </a></li>
							</ul>
						</span>
	                <?php } else { ?>
	                    <span class="dropdown" style="float:right;">
							<a href="#" class="dropdown-toggle elli" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v pull-right"></i>
							</a>
							<ul class="dropdown-menu pull-right">
								<li><a href="#" class="" style="" onclick="reportcomm_post(<?php echo $key->id;?>, <?php echo $key->user_id;?>)"><i class="fa fa-exclamation-triangle"></i> REPORT </a>
								</li>
							</ul>
					    </span>
	                <?php } ?>
				</span>
				<span class="description datecv"><?php echo get_ydhmdatetime($key->date);?></span>
			</div>
		</div>
		<div class="box-body">
		    <?php if(isset($key->urldescription) && !empty($key->urldescription)){ echo '<div class="user-block">'.$key->urldescription.'</div>'; } ?>
			<?php if(!empty($key->title)) { ?>
				<div class="media border-box" style="margin-top:2px;">
					<div class="media-left">
						<a href="<?php echo $key->titleurl;?>" target="_blank">
							<?php if(!empty($key->image)) { ?>
								<img src="<?php echo $key->image;?>" class="media-object img-v" alt="Community Story Image">
							<?php } else { ?>
								<img src="<?php echo base_url();?>assets/images/1.jpg" class="media-object img-v" alt="Community Story Image">
							<?php } ?>
						</a>
					</div>
					<div class="media-body" style="padding-top:15px;">
						<a href="<?php echo $key->titleurl;?>" target="_blank"> 
							<h4 class="media-heading"><b><?php echo ucfirst($key->title);?></b></h4>
						</a>
						<p class="edittext<?php echo $key->id;?>" style=""><?php echo substr($key->story,0,50);?>...</p>
					</div>
				</div>
			<?php } else { ?>
				<p class="edittext<?php echo $key->id;?>"> <span style="font-size:1.2em"><?php echo $key->story;?></span></p>
			<?php } ?>
		</div>
		<div class="box-body">
			<?php if(isset($commstory_likes) && in_array($key->id, $commstory_likes)) { ?>
			    <button class="btn btn-default btn-xs unlike<?php echo $key->id;?>" onclick="unlikestory(<?php echo $key->id;?>)" style="background:none; color:#337ab7;"><i class="fa fa-thumbs-up"></i> Like</button>
			<?php } else { ?>
			    <button class="btn btn-default btn-xs like<?php echo $key->id;?>" onclick="likestory(<?php echo $key->id;?>)" style="background:none;"><i class="fa fa-thumbs-up"></i> Like</button>
			<?php } ?>
			<span><i class="fa fa-share"></i> Share</span>
			<span class="pull-right text-muted" onClick="comments(<?php echo $key->id;?>);">
				<span id="old_like<?php echo $key->id;?>"><?php echo $key->likes; ?></span> <span id="new_like"></span> Likes &nbsp; 
				<?php $commentcount = 0; if(isset($comm_comment_count) && ($comm_comment_count->num_rows()>0)) {
					foreach($comm_comment_count->result() as $reviews2) {
						if($reviews2->story_id == $key->id) {
						    $commentcount = $reviews2->commentcount;
						}
				} } ?><span id="old_cmt<?php echo $key->id;?>"><?php echo $commentcount;?></span> Comments
			</span>
		</div>
		<?php } else { ?>
			<div class="box-header with-borders">
				<div class="user-block">
				    <span style="width:40px; height:40px;">
					<?php if(isset($key->profile_image) && !empty($key->profile_image)) { ?>
						<img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $key->profile_image;?>" alt="<?php echo $key->name;?>">
					<?php } else { ?>
						<img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo $key->name;?>">
					<?php } ?>
					</span>
					<span class="username"><a href="#"><?php echo $key->name;?></a></span>
					<span class="description"><?php echo get_ydhmdatetime($key->date);?></span>
				</div>
			</div>
			<div class="box-body">
				<p class="text-justify">
					<?php echo $key->story;?>
				</p>
				<button type="submit" class="btn btn-default btn-xs <?php echo $key->id;?>" onclick="likestory(<?php echo $key->id;?>)"><i class="fa fa-heart"></i></button>
				<span class="pull-right text-muted" onClick="comments(<?php echo $key->id;?>);">
    				<span id="old_like<?php echo $key->id;?>"><?php echo $key->likes; ?></span> <span id="new_like"></span> Likes &nbsp; 
    				<?php $commentcount = 0; if(isset($comm_comment_count) && ($comm_comment_count->num_rows()>0)) {
    					foreach($comm_comment_count->result() as $reviews2) {
    						if($reviews2->story_id == $key->id) {
    						    $commentcount = $reviews2->commentcount;
    						}
    				} } ?><span id="old_cmt<?php echo $key->id;?>"><?php echo $commentcount;?></span> Comments
    			</span>
			</div>
		<?php } ?>
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
					<input type="hidden" name="comm_id" value="<?php echo $this->uri->segment(2); ?>">
					<span class="input-group-btn">
						<button type="submit" class="btn btn-success btn-flat" onclick="comm_comments(<?php echo $key->id;?>)"> Comment </button>
					</span>
				</div>
			</div>
		</div>
		<!-- /.box-footer -->
		<div class="box-footer box-comments ajaxcomment<?php echo $key->id;?>" style="background: #fff;"> </div>
		<?php $comments = get_comments($key->id);
			if(isset($comments) && ($comments->num_rows()>0)) { ?>
			<div id="myList<?php echo $key->id;?>">
				<?php foreach($comments->result() as $comment){ ?>
					<div class="box-footer box-comments editdelete<?php echo $comment->id;?>" style="padding-bottom:0px;">
						<div class="box-comment">
							<?php if(isset($comment->profile_image) && !empty($comment->profile_image)){ ?>
							<img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $comment->profile_image;?>" alt="<?php echo ucfirst($comment->name);?>">
							<?php } else { ?>
							<img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo ucfirst($comment->name);?>">
							<?php } ?>
							<div class="comment-text">
								<span class="username" style="padding-top:6px;">&nbsp; <?php echo ucfirst($comment->name);?>
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
                                    <a href="javascript:void(0)" onClick="displayreplies(<?php echo $comment->id;?>,<?php echo $comment->comm_id;?>,<?php echo $comment->story_id;?>)" class="pull-left replycv" title="Replies">| 
                                    <span class="old_subcmtcount<?php echo $comment->id;?>"><?php echo get_subcmtcount($comment->id);?></span> REPLIES</a>
                                </div>
							</div><br>
							<div class="comment-text">
							    <div class="input-group postreplycomment<?php echo $comment->id;?>" style="margin-bottom:5px;"><!-- Reply comment form --></div>
							</div>
						</div>
						
						<div class="subcomments" style="margin-bottom:10px;display:none;" id="mysubList<?php echo $key->id;?>_<?php echo $comment->id;?>">
							<?php $subcomments = get_subcomments($key->id, $comment->id); 
							    if(isset($subcomments) && ($subcomments->num_rows() > 0)){ foreach($subcomments->result() as $subcomment){ ?>
								<div class="media editdelete<?php echo $subcomment->id;?>" style="padding-left:10px;">
								    <span class="media-left">
								        <?php if(isset($subcomment->profile_image) && !empty($subcomment->profile_image)){ ?>
								        <img class="img-circle" style="width:25px;" src="<?php echo base_url();?>assets/images/<?php echo $subcomment->profile_image;?>" alt="<?php echo ucfirst($subcomment->name);?>">
								        <?php } else { ?>
								        <img class="img-circle" style="width:25px;" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo ucfirst($subcomment->name);?>">
								        <?php } ?>
								   </span>
								    <span class="media-body bodycv">
								        <div class=""><!--username-->
								            <span class="">&nbsp;<b><?php echo ucfirst($subcomment->name);?></b>
								                <span class="pull-right">
                                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" style="padding: 0px 10px 0px 20px;">
                                                     <i class="fa fa-ellipsis-v"></i> </a> 
                                                    <ul class="dropdown-menu writemenu" style="top:auto; width:fit-content;">
                                                        <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($subcomment->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
                                                        <li><a href="javascript:void(0);" onClick="editcommcomment(<?php echo $subcomment->id;?>);"><span><i class="fa fa-pencil"></i> EDIT</span></a></li>
                                                        <li><a href="javascript:void(0);" onClick="deletecommcomment(<?php echo $subcomment->id;?>);"><span><i class="fa fa-trash"></i> DELETE</span></a></li>
                                                        <?php } else{ ?>
                                                        <li><a href="javascript:void(0);" onClick="reportcommcomment(<?php echo $subcomment->id;?>, <?php echo $subcomment->user_id;?>);"><span><i class="fa fa-exclamation-triangle"></i> REPORT</span></a></li>
                                                        <?php } ?>
                                                    </ul>
                                                </span>
                                                <span class="text-muted pull-right datecv"><?php echo get_ydhmdatetime($subcomment->date);?></span>
								            </span><br>
								            <span class="more <?php echo $subcomment->id;?>" style="padding-left:6px;"><?php echo $subcomment->comment;?></span>
								            
								       </div>
								   </span>
								</div>
								<?php } $commlastsubcomment = get_commlastsubcomment($key->id, $comment->id); 
								    if($subcomment->id > $commlastsubcomment){ ?>
								<a href="javascript:void(0);"><span class="loadsubcomment<?php echo $comment->id;?>" onClick="commloadsubcomment(<?php echo $key->id;?>, <?php echo $comment->id;?>, <?php echo $subcomment->id;?>)"><center>Read More...</center></span></a>
							    <?php } else{ ?>
							    <span class="loadsubcomment"></span>
							<?php } } ?>
						</div>
					</div>
			    <?php } $commlastcomment = get_commlastcomment($key->id); if($comment->id > $commlastcomment){ ?>
		        <a href="javascript:void(0);"><span class="loadmorespan<?php echo $key->id;?>" onClick="commloadmore(<?php echo $key->id;?>, <?php echo $comment->id;?>)"><center>Read More...</center></span></a>
		        <?php } else{ ?>
		        <span class="loadmorespan"></span>
		        <?php } ?>
		    </div>
		<?php } ?>
	</div>
	<!-- /.box-footer -->

<?php } } if(isset($toploadcommustories) && ($toploadcommustories->num_rows() > 0)){ foreach ($toploadcommustories->result() as $topkey) { ?>
	<div class="box box-widget" style="background:#fff; border:1px solid #dddddd; margin-bottom:10px;">
		<?php if(($topkey->type='url')) { ?>
			<div class="box-header with-border">
				<div class="user-block">
					<?php if(isset($topkey->profile_image) && !empty($topkey->profile_image)) { ?>
						<img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $topkey->profile_image;?>" alt="User Image">
					<?php } else { ?>
						<img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="User Image">
					<?php } ?>
					<span class="username"><a href="#"><?php echo $topkey->name;?></a>
					    <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($topkey->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
					    <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="write" aria-expanded="false">
					        <i class="fa fa-ellipsis-v pull-right"></i>
					    </a>
					    <ul class="dropdown-menu dv1">
					        <li><a href="javascript:void(0);" onclick="editcomm_post(<?php echo $topkey->id;?>, <?php echo $topkey->user_id;?>)"><i class="fa fa-pencil"></i> EDIT </a></li>
		                    <li><a href="javascript:void(0);" onclick="deletecomm_post(<?php echo $topkey->id;?>, <?php echo $topkey->user_id;?>)"><i class="fa fa-trash"></i> DELETE </a></li>
		                </ul>
		                <?php } else { ?>
		                <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="write" aria-expanded="false">
					        <i class="fa fa-ellipsis-v pull-right"></i>
					    </a>
					    <ul class="dropdown-menu dv1">
		                    <li><a href="#" class="" style="" onclick="reportcomm_post(<?php echo $topkey->id;?>, <?php echo $topkey->user_id;?>)"><i class="fa fa-exclamation-triangle"></i> Report </a>
					        </li>
		                </ul>
		                <?php } ?>
					</span>
					<span class="description"><?php echo get_ydhmdatetime($topkey->date);?></span>
				</div>
			</div>
			<div class="box-body">
				<?php if(!empty($topkey->title)) { ?>
					<div class="media border-box" style="margin-top:2px;">
						<div class="media-left">
							<a href="<?php echo $topkey->titleurl;?>" target="_blank">
							<?php if((!empty($topkey->image) && ($topkey->type == "url"))) { ?>
						        <img src="<?php echo $topkey->image;?>" class="media-object img-v">
						    <?php }elseif((!empty($topkey->image) && ($topkey->type != "url"))){ ?>
						        <img src="<?php echo base_url();?>assets/images/<?php echo $topkey->image;?>" class="media-object img-v">
							<?php } else { ?>
								<img src="<?php echo base_url();?>assets/images/1.jpg" class="media-object img-v">
								<?php } ?>
							</a>
						</div>
						<div class="media-body" style="padding-top:15px;">
							<a href="<?php echo $topkey->titleurl;?>" target="_blank"> 
								<h4 class="media-heading"><b><?php echo ucfirst($topkey->title);?></b></h4>
							</a>
							<p class="edittext<?php echo $topkey->id;?>"><?php echo substr($topkey->story,0,150);?>...</p>
						</div>
					</div>
				<?php } else { ?>
					<p class="edittext<?php echo $topkey->id;?>"><?php echo $topkey->story;?></p>
				<?php } ?>
			</div>
			<div class="box-body">
				<?php if(isset($commstory_likes) && in_array($topkey->id, $commstory_likes)) { ?>
				    <button class="btn btn-default btn-xs unlike<?php echo $topkey->id;?>" onclick="tpostunlikestory(<?php echo $topkey->id;?>)" style="background:none; color:#337ab7;"><i class="fa fa-thumbs-up"></i> Like</button>
				<?php } else { ?>
				    <button class="btn btn-default btn-xs like<?php echo $topkey->id;?>" onclick="tpostlikestory(<?php echo $topkey->id;?>)" style="background:none;"><i class="fa fa-thumbs-up"></i> Like</button>
				<?php } ?>
				<span><i class="fa fa-share"></i> Share</span>	
				<span class="pull-right text-muted">
				<span id="told_like<?php echo $topkey->id;?>"><?php echo $topkey->likes; ?></span><span id="tnew_like"></span> Likes &nbsp; 
				<?php if(isset($comm_comment_count) && ($comm_comment_count->num_rows()>0)) {
						foreach($comm_comment_count->result() as $reviews2) { 
							if($reviews2->story_id == $topkey->id) { ?>
								<?php echo $reviews2->commentcount;?> 
							<?php } ?>
					<?php } } ?> Comments			
				</span>
		    </div>
	    <?php } else { ?>
			<div class="box-header with-borders">
				<div class="user-block">
					<?php if(isset($topkey->profile_image) && !empty($topkey->profile_image)) { ?>
					<img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $topkey->profile_image;?>" alt="User Image">
					<?php } else { ?>
						<img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="User Image">
						<?php } ?>
					<span class="username"><a href="#"><?php echo $topkey->name;?></a></span>
					<span class="description"><?php echo get_ydhmdatetime($topkey->date);?></span>
				</div>
			</div>
			<div class="box-body">
				<p class="text-justify"><?php echo $topkey->story;?></p>
				<button type="submit" class="btn btn-default btn-xs <?php echo $topkey->id;?>" onclick="likestory(<?php echo $topkey->id;?>)"><i class="fa fa-heart"></i></button>
				<span class="pull-right text-muted">
				<span id="old_like<?php echo $topkey->id;?>"><?php echo $topkey->likes; ?></span><span id="new_like"></span> Likes &nbsp; 
				<?php if(isset($comm_comment_count) && ($comm_comment_count->num_rows()>0)) {
						foreach($comm_comment_count->result() as $reviews2) { 
							if($reviews2->story_id == $topkey->id) { ?>
								<?php echo $reviews2->commentcount;?> 
							<?php } ?>
					<?php } } ?> Comments 
				</span>
			</div>
		<?php } ?><!-- /.box-footer -->
		<div class="box-footer">
			<div id="tpostscommunity_commentpost<?php echo $topkey->id; ?>">
				<?php if (isset($this->session->userdata['logged_in'])) { 
				    if(isset($this->session->userdata['logged_in']['profile_image']) && 
				        !empty($this->session->userdata['logged_in']['profile_image'])) { ?>
					<img src="<?php echo base_url().'assets/images/'.$this->session->userdata['logged_in']['profile_image']; ?>" style="width: 47px;height: 37px; margin-right:10px;" class="img-responsive img-circle img-sm" alt="User Image">
				<?php } else { ?>
					<img src="<?php echo base_url();?>assets/images/2.png" style="width: 47px;height:37px; margin-right:10px;" class="img-responsive img-circle img-sm" >
				<?php } } ?>
				<div class="input-group">
				    <input type="hidden" name="tstory_id" value="<?php echo $topkey->id; ?>">
					<input type="text" name="tcomment" placeholder="Type Comment Message ..." class="form-control" required="">
					<input type="hidden" name="tcomm_id" value="<?php echo $this->uri->segment(3); ?>">
					<span class="input-group-btn">
						<button type="submit" class="btn btn-success btn-flat" onclick="tpostscomm_comments(<?php echo $topkey->id;?>)"> Comment </button>
					</span>
				</div>
			</div>
		</div>
		<!-- /.box-footer -->        					
        <div class="box-footer box-comments tajaxcomment<?php echo $topkey->id;?>" style="background: #fff;"> </div>
		<?php $comments = get_comments($topkey->id); 
			if(isset($comments) && ($comments->num_rows()>0)) { ?>
			<div id="topmyList<?php echo $topkey->id;?>">
				<?php foreach($comments->result() as $comment) { ?>
					<div class="box-footer box-comments editdelete<?php echo $comment->id;?>">
						<div class="box-comment">
							<?php if(isset($comment->profile_image) && !empty($comment->profile_image)){ ?>
							    <img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $comment->profile_image;?>" alt="User Image">
							<?php } else { ?>
							    <img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="User Image">
							<?php } ?>
							<div class="comment-text">
								<span class="username">&nbsp; <?php echo ucfirst($comment->name);?>
									<span class="text-muted pull-right"><?php echo get_ydhmdatetime($comment->date);?></span>
								</span> <br><span class="more <?php echo $comment->id;?>"><?php echo $comment->comment;?></span>
								<span class="pull-right">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" style="padding: 0px 10px 0px 20px;">
                                     <i class="fa fa-ellipsis-v"></i> </a> 
                                    <ul class="dropdown-menu writemenu" style="top:auto; width:fit-content;">
                                        <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($comment->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
                                        <li><a href="javascript:void(0);" onClick="editcommcomment(<?php echo $comment->id;?>);"><span><i class="fa fa-pencil"></i> EDIT</span></a></li>
                                        <li><a href="javascript:void(0);" onClick="deletecommcomment(<?php echo $comment->id;?>);"><span><i class="fa fa-trash"></i> DELETE</span></a></li>
                                        <?php }else{ ?>
                                        <li><a href="javascript:void(0);" onClick="reportcommcomment(<?php echo $comment->id;?>, <?php echo $comment->user_id;?>);"><span><i class="fa fa-exclamation-triangle"></i> REPORT</span></a></li>
                                        <?php } ?>
                                    </ul>
                                </span>
                                <a href="javascript:void(0)" onClick="toppostReplycomment(<?php echo $comment->id;?>,<?php echo $comment->comm_id;?>,<?php echo $comment->story_id;?>)" class="pull-right" title="Reply"><i class="fa fa-reply" aria-hidden="true"></i> Reply</a>
								<div class="input-group toppostreplycomment<?php echo $comment->id;?>"><!-- Reply comment form --></div>
							</div>
						</div>
						<div class="topsubcomments" style="margin-left:20px;background:#ddd;" id="topmysubList<?php echo $topkey->id;?>_<?php echo $comment->id;?>">
							<?php $topsubcomments = get_subcomments($topkey->id, $comment->id); 
							    if(isset($topsubcomments) && ($topsubcomments->num_rows() > 0)){ foreach($topsubcomments->result() as $topsubcomment){ ?>
								<div class="box-footer box-comments editdelete<?php echo $topsubcomment->id;?>" style="padding-bottom:0px;background:#ddd;">
								    <div class="box-comment">
								        <?php if(isset($topsubcomment->profile_image) && !empty($topsubcomment->profile_image)){ ?>
								        <img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $topsubcomment->profile_image;?>">
								        <?php } else { ?>
								        <img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="User Image">
								        <?php } ?>
								        <div class="comment-text">
								            <span class="username">&nbsp;<?php echo ucfirst($topsubcomment->name);?>
								                <span class="text-muted pull-right"><?php echo get_ydhmdatetime($topsubcomment->date);?></span>
								            </span>	<br> <span class="more <?php echo $topsubcomment->id;?>"><?php echo $topsubcomment->comment;?></span>
								            <span class="pull-right">
                                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" style="padding: 0px 10px 0px 20px;">
                                                 <i class="fa fa-ellipsis-v"></i> </a> 
                                                <ul class="dropdown-menu writemenu" style="top:auto; width:fit-content;">
                                                    <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($topsubcomment->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
                                                    <li><a href="javascript:void(0);" onClick="editcommcomment(<?php echo $topsubcomment->id;?>);"><span><i class="fa fa-pencil"></i> EDIT</span></a></li>
                                                    <li><a href="javascript:void(0);" onClick="deletecommcomment(<?php echo $topsubcomment->id;?>);"><span><i class="fa fa-trash"></i> DELETE</span></a></li>
                                                    <?php } else{ ?>
                                                    <li><a href="javascript:void(0);" onClick="reportcommcomment(<?php echo $topsubcomment->id;?>, <?php echo $topsubcomment->user_id;?>);"><span><i class="fa fa-exclamation-triangle"></i> REPORT</span></a></li>
                                                    <?php } ?>
                                                </ul>
                                            </span>
								       </div>
								   </div>
								</div>
								<?php } $commlastsubcomment = get_commlastsubcomment($topkey->id, $comment->id); 
								    if($topsubcomment->id > $commlastsubcomment){ ?>
								<a href="javascript:void(0);">
								    <span class="toploadsubcomment<?php echo $comment->id;?>" onClick="topcommloadsubcomment(<?php echo $topkey->id;?>, <?php echo $comment->id;?>, <?php echo $topsubcomment->id;?>)">
								        <center>Read More...</center></span></a>
							    <?php } else{ ?>
							    <span class="toploadsubcomment"></span>
							<?php } } ?>
						</div>
					</div>
			    <?php } ?> 
		        <a href="javascript:void(0);"><span class="toploadmorespan<?php echo $topkey->id;?>" onClick="topcommloadmore(<?php echo $topkey->id;?>, <?php echo $comment->id;?>)"><center>Read More...</center></span></a>
		    </div>
		<?php } ?>
    </div>
	<!-- /.box-footer -->
<?php } } ?>