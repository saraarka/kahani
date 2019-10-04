<link rel="stylesheet" href="<?php echo base_url();?>assets/css/feed.css">
<style>
    .more{
        word-break: break-word;
    }
</style>
<div class="mg-right" style="margin-top:50px;">
	<div class="content-wrapper cv1">    
		<section class="">
			<div class="" style="margin-top:10px; display:flex;">
				<div class="feed pd-0" style="">
					<div class="nav-tabs-custom">
						<ul class="nav nav-tabs" style="background: #23678e;">
							<li class="active"><a href="#tab_feed" data-toggle="tab">FEED</a></li>
							<li class=""><a href="#tab_yourfeed" data-toggle="tab">YOUR POSTS</a></li>
							<li class=""><a href="#tab_stories" data-toggle="tab">STORIES POSTS</a></li>
						</ul>
					</div>
						
					<div class="tab-content" style="background:none!important; padding:0px;">
					    
						<div class="tab-pane active" id="tab_feed"><br>
							<?php if(isset($feed) && ($feed->num_rows() > 0)){ ?><div id="loadmoreall"><?php foreach ($feed->result() as $key) { ?>
								<div class="box box-widget" style="background:#fff; border:1px solid #dddddd;margin-bottom: 10px;">
									<div class="box-header with-border">
										<div class="user-block">
											<?php if(isset($key->profile_image) && !empty($key->profile_image)) { ?>
												<img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $key->profile_image;?>" alt="User Image">
											<?php } else { ?>
												<img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="User Image">
											<?php } ?>
											<span class="dropdown pull-right">
												<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" title="Click Here to Report" aria-expanded="false">
													<i class="fa fa-ellipsis-v pull-right"></i>
												</a>
												<ul class="dropdown-menu pull-right">
											    <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($key->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
											        <li><a href="javascript:void(0);" onclick="deletecomm_post(<?php echo $key->id;?>, <?php echo $key->user_id;?>)"><i class="fa fa-trash"></i> Delete </a></li>
													<li><a href="javascript:void(0);" onclick="editcomm_post(<?php echo $key->id;?>, <?php echo $key->user_id;?>)"><i class="fa fa-pencil"></i> Edit </a></li>
												<?php }else { ?>
												    <li><a href="javascript:void(0);" onclick="reportcomm_post(<?php echo $key->id;?>, <?php echo $key->user_id;?>)"><i class="fa fa-exclamation-triangle"></i> Report </a></li>
												<?php } ?>
												</ul>
											</span>
											<span class="username"><a href="javascript:void(0);"><?php echo $key->name;?></a></span>
											<span class="description"><i style="color:#040cff;"><?php echo $key->gener;?></i> - <?php echo get_ydhmdatetime($key->date);?></span>
										</div>
									</div>
									<!-- /.box-header -->
									<?php if(isset($key->type) && ($key->type='url')) { ?>
										<div class="box-body">
											<?php if(isset($key->urldescription) && !empty($key->urldescription)){ echo '<div class="user-block">'.$key->urldescription.'</div>'; }?>
											<?php if(!empty($key->title)){ ?>
												<div class="media border-box" style="margin-top:2px;">
													<div class="media-left">
														<a href="<?php echo $key->titleurl;?>" target="_blank">
															<?php if(!empty($key->image)) { ?>
														<img src="<?php echo $key->image;?>" class="media-object img-v">
														<?php } else { ?>
															<img src="<?php echo base_url();?>assets/images/1.jpg" class="media-object img-v">
															<?php } ?>
														</a>
													</div>
													<div class="media-body" style="padding-top:15px;">
														<a href="<?php echo $key->titleurl;?>" target="_blank"> 
															<h4 class="media-heading"><b><?php echo ucfirst($key->title);?></b></h4>
														</a>
														<p class="media-heading edittext<?php echo $key->id;?>"><?php echo substr($key->story,0,150);?>...</p>
													</div>
												</div>
											<?php } else { ?>
												<p class="media-heading edittext<?php echo $key->id;?>"><?php echo $key->story;?></p>
											<?php } ?>
										</div>
										<div class="box-body">
											<?php if(isset($commstory_likes) && in_array($key->id, $commstory_likes)) { ?>
												<button class="btn btn-default btn-xs unlike<?php echo $key->id;?>" onclick="unlikestory(<?php echo $key->id;?>)" style="background:none; color:#337ab7;"><i class="fa fa-thumbs-up"></i> Like</button>
											<?php } else { ?>
												<button class="btn btn-default btn-xs like<?php echo $key->id;?>" onclick="likestory(<?php echo $key->id;?>)" style="background:none;"><i class="fa fa-thumbs-up"></i> Like</button>
											<?php } ?>
											<span><i class="fa fa-share"></i> Share</span>
											<span class="pull-right text-muted">
												<span id="old_like<?php echo $key->id;?>"><?php echo $key->likes; ?></span> <span id="new_like"></span> Likes &nbsp; 
												<?php if(isset($comm_comment_count) && ($comm_comment_count->num_rows()>0)) {
													foreach($comm_comment_count->result() as $reviews2) { 
														if($reviews2->story_id == $key->id) { ?>
															<?php echo $reviews2->commentcount;?> 
														<?php } ?>
												<?php } } ?> Comments			
											</span>
										</div>
									<?php } else { ?>
										<div class="box-body border-box">
											<p class="text-justify"><?php echo $key->story;?></p>
											<button type="submit" class="btn btn-default btn-xs <?php echo $key->id;?>" onclick="likestory(<?php echo $key->id;?>)"><i class="fa fa-heart"></i></button>
											<span class="pull-right text-muted">
												<span id="old_like<?php echo $key->id;?>"><?php echo $key->likes; ?></span><span id="new_like"></span> Likes &nbsp; 
												<?php if(isset($comm_comment_count) && ($comm_comment_count->num_rows()>0)) {
													foreach($comm_comment_count->result() as $reviews2) { 
														if($reviews2->story_id == $key->id) { ?>
															<?php echo $reviews2->commentcount;?> 
														<?php } ?>
												<?php } } ?> Comments			
											</span>
										</div>
									<?php } ?>
									<!-- /.box-footer -->
									<div class="box-footer">
										<div id="community_commentpost<?php echo $key->id; ?>">
											<?php if (isset($this->session->userdata['logged_in'])) { 
												if(isset($this->session->userdata['logged_in']['profile_image']) && 
													!empty($this->session->userdata['logged_in']['profile_image'])) { ?>
														<img src="<?php echo base_url().'assets/images/'.$this->session->userdata['logged_in']['profile_image']; ?>" style="width: 47px;height:37px; margin-right:10px;" class="img-responsive img-circle img-sm" >
											<?php } else { ?>
												<img src="<?php echo base_url();?>assets/images/2.png" style="width: 47px;height:37px; margin-right:10px;" class="img-responsive img-circle img-sm" >
											<?php } } ?>
											<div class="input-group">
												<input type="hidden" name="story_id" value="<?php echo $key->id; ?>">
												<input type="text" name="comment" placeholder="Type Comment Message ..." class="form-control" required="">
												<input type="hidden" name="comm_id" value="<?php echo $key->id; ?>">
												<span class="input-group-btn">
													<button type="submit" class="btn btn-success btn-flat" onclick="comm_comments(<?php echo $key->id;?>)"> Comment </button>
												</span>
											</div>
										</div>
									</div>
									
									<div class="box-footer box-comments ajaxcomment<?php echo $key->id;?>" style="background: #fff;"> </div>
									<?php $comments = get_comments($key->id);
        							    if(isset($comments) && ($comments->num_rows()>0)){ ?>
										<div id="myList<?php echo $key->id;?>">
											<?php foreach($comments->result() as $comment){ ?>
												<div class="box-footer box-comments editdelete<?php echo $comment->id;?>" style="padding-bottom:0px;">
													<div class="box-comment">
														<?php if(isset($comment->profile_image) && !empty($comment->profile_image)){ ?>
														    <img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $comment->profile_image;?>" alt="User Image">
														<?php } else { ?>
														    <img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="User Image">
														<?php } ?>
														<div class="comment-text">
															<span class="username">&nbsp; <?php echo ucfirst($comment->name);?>
																<span class="text-muted pull-right"><?php echo get_ydhmdatetime($comment->date);?></span>
															</span> <br><span class="more <?php echo $comment->id;?>"><?php echo $comment->comment; ?></span>
															<span class="pull-right">
                                                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" style="padding: 0px 10px 0px 20px;">
                                                                 <i class="fa fa-ellipsis-v"></i> </a> 
                                                                <ul class="dropdown-menu writemenu" style="top:auto; width:fit-content;">
                                                                    <?php if($comment->user_id == $this->session->userdata['logged_in']['user_id']){ ?>
                                                                    <li><a href="javascript:void(0);" onClick="editcommcomment(<?php echo $comment->id;?>);"><span><i class="fa fa-pencil"></i> Edit</span></a></li>
                                                                    <li><a href="javascript:void(0);" onClick="deletecommcomment(<?php echo $comment->id;?>);"><span><i class="fa fa-trash"></i> Delete</span></a></li>
                                                                    <?php } else{ ?>
                                                                    <li><a href="javascript:void(0);" onClick="reportcommcomment(<?php echo $comment->id;?>,<?php echo $comment->user_id;?>);"><span><i class="fa fa-exclamation-triangle"></i> Report</span></a></li>
                                                                    <?php } ?>
                                                                </ul>
                                                            </span>
                                                            <a href="javascript:void(0)" onClick="postReplycomment(<?php echo $comment->id;?>,<?php echo $comment->comm_id;?>,<?php echo $comment->story_id;?>)" class="pull-right" title="Reply"><i class="fa fa-reply" aria-hidden="true"></i> Reply</a>
															<div class="input-group postreplycomment<?php echo $comment->id;?>"><!-- Reply comment form --></div>
														</div>
													</div>
													<div class="subcomments" style="margin-left:20px;background:#ddd;" id="mysubList<?php echo $key->id;?>_<?php echo $comment->id;?>">
    													<?php $subcomments = get_subcomments($key->id, $comment->id); 
    													    if(isset($subcomments) && ($subcomments->num_rows() > 0)){ foreach($subcomments->result() as $subcomment){ ?>
        													<div class="box-footer box-comments editdelete<?php echo $subcomment->id;?>" style="padding-bottom:0px;background:#ddd;">
        													    <div class="box-comment">
        													        <?php if(isset($subcomment->profile_image) && !empty($subcomment->profile_image)){ ?>
        													        <img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $subcomment->profile_image;?>">
        													        <?php } else { ?>
        													        <img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="User Image">
        													        <?php } ?>
        													        <div class="comment-text">
        													            <span class="username">&nbsp;<?php echo ucfirst($subcomment->name);?>
        													                <span class="text-muted pull-right"><?php echo get_ydhmdatetime($subcomment->date);?></span>
        													            </span>	<br> <span class="more <?php echo $subcomment->id;?>"><?php echo $subcomment->comment;?></span>
        													            <span class="pull-right">
                                                                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" style="padding: 0px 10px 0px 20px;">
                                                                             <i class="fa fa-ellipsis-v"></i> </a> 
                                                                            <ul class="dropdown-menu writemenu" style="top:auto; width:fit-content;">
                                                                                <?php if($subcomment->user_id == $this->session->userdata['logged_in']['user_id']){ ?>
                                                                                <li><a href="javascript:void(0);" onClick="editcommcomment(<?php echo $subcomment->id;?>);"><span><i class="fa fa-pencil"></i> Edit</span></a></li>
                                                                                <li><a href="javascript:void(0);" onClick="deletecommcomment(<?php echo $subcomment->id;?>);"><span><i class="fa fa-trash"></i> Delete</span></a></li>
                                                                                <?php } else{ ?>
                                                                                <li><a href="javascript:void(0);" onClick="reportcommcomment(<?php echo $subcomment->id;?>, <?php echo $subcomment->user_id;?>);"><span><i class="fa fa-exclamation-triangle"></i> Report</span></a></li>
                                                                                <?php } ?>
                                                                            </ul>
                                                                        </span>
        													       </div>
        													   </div>
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
									<!-- /.box-footer -->
								</div>
							<?php } ?> </div><div id="load_data_message"></div> <?php } ?>
						</div>
						
						<div class="tab-pane" id="tab_yourfeed"> <br>
							<?php if(isset($yourfeeds) && !empty($yourfeeds)){ ?><div id="yloadmoreall">
							<?php foreach ($yourfeeds->result() as $yourfeed) { ?>
								<div class="box box-widget" style="background:#fff; border:1px solid #dddddd;margin-bottom: 10px;">
									<?php if(($yourfeed->type='url')) { ?>
										<div class="box-header with-border">
											<div class="user-block">
												<?php if(isset($yourfeed->profile_image) && !empty($yourfeed->profile_image)) { ?>
												    <img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $yourfeed->profile_image;?>" alt="User Image">
												<?php } else { ?>
													<img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="User Image">
												<?php } ?>
												<span class="username"><a href="javascript:void(0);"><?php echo $yourfeed->name;?></a>
													<?php if(isset($this->session->userdata['logged_in']['user_id']) && ($yourfeed->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
														<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" title="write" aria-expanded="false">
															<i class="fa fa-ellipsis-v pull-right"></i>
														</a>
														<ul class="dropdown-menu" style="float:right;right: 0;top: 24px;left:72%;">
															<li><a href="javascript:void(0);" onclick="deletecomm_post(<?php echo $yourfeed->id;?>, <?php echo $yourfeed->user_id;?>)"><i class="fa fa-trash"></i> Delete </a></li>
															<li><a href="javascript:void(0);" onclick="editcomm_post(<?php echo $yourfeed->id;?>, <?php echo $yourfeed->user_id;?>)"><i class="fa fa-pencil"></i> Edit </a></li>
														</ul>
													<?php } else { ?>
														<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" title="write" aria-expanded="false">
															<i class="fa fa-ellipsis-v pull-right"></i>
														</a>
														<ul class="dropdown-menu" style="float:right;right: 0;top: 24px;left:72%;width:25%">
															<li><a href="javascript:void(0);" class="" style="" onclick="reportcomm_post(<?php echo $yourfeed->id;?>, <?php echo $yourfeed->user_id;?>)"><i class="fa fa-exclamation-triangle"></i> Report </a>
															</li>
														</ul>
													<?php } ?>
												</span>
												<span class="description"><?php echo get_ydhmdatetime($yourfeed->date);?></span>
											</div>
										</div>
										<div class="box-body">
											<?php if(!empty($yourfeed->title)){ ?>
												<div class="media border-box" style="margin-top:2px;">
													<div class="media-left">
														<a href="<?php echo $yourfeed->titleurl;?>" target="_blank">
															<?php if((!empty($yourfeed->image) && ($yourfeed->type == "url"))) { ?>
																<img src="<?php echo $yourfeed->image;?>" class="media-object img-v">
															<?php }elseif((!empty($yourfeed->image) && ($yourfeed->type != "url"))){ ?>
																<img src="<?php echo base_url();?>assets/images/<?php echo $yourfeed->image;?>" class="media-object img-v">
															<?php } else { ?>
																<img src="<?php echo base_url();?>assets/images/1.jpg" class="media-object img-v">
															<?php } ?>
														</a>
													</div>
													<div class="media-body" style="padding-top:15px;">
														<a href="<?php echo $yourfeed->titleurl;?>" target="_blank"> 
															<h4 class="media-heading"><b><?php echo ucfirst($yourfeed->title);?></b></h4>
														</a>
														<p class="media-heading edittext<?php echo $yourfeed->id;?>"><?php echo substr($yourfeed->story,0,150);?>...</p>
													</div>
												</div>
											<?php } else { ?>
												<p class="media-heading edittext<?php echo $yourfeed->id;?>"><?php echo $yourfeed->story;?></p>
											<?php } ?>
										</div>
										<div class="box-body">
											<!--<?php if(isset($commstory_likes) && in_array($yourfeed->id, $commstory_likes)) { ?>
												<button class="btn btn-default btn-xs unlike<?php echo $yourfeed->id;?>" onclick="tpostunlikestory(<?php echo $yourfeed->id;?>)" style="background:none; color:#337ab7;"><i class="fa fa-thumbs-up"></i> Like</button>
											<?php } else { ?>
												<button class="btn btn-default btn-xs like<?php echo $yourfeed->id;?>" onclick="tpostlikestory(<?php echo $yourfeed->id;?>)" style="background:none;"><i class="fa fa-thumbs-up"></i> Like</button>
											<?php } ?>-->
											<button class="btn btn-default btn-xs" onclick="yourscommpostlike();" style="background:none;"><i class="fa fa-thumbs-up"></i> Like</button>
											
											<span><i class="fa fa-share"></i> Share</span>	
											<span class="pull-right text-muted">
												<span id="told_like<?php echo $yourfeed->id;?>"><?php echo $yourfeed->likes; ?></span><span id="tnew_like"></span> Likes &nbsp; 
												<?php if(isset($comm_comment_count) && ($comm_comment_count->num_rows()>0)) {
														foreach($comm_comment_count->result() as $reviews2) { 
															if($reviews2->story_id == $yourfeed->id) { ?>
																<?php echo $reviews2->commentcount;?> 
															<?php } ?>
												<?php } } ?> Comments			
											</span>
										</div>
									<?php } else { ?>
										<div class="box-header with-border">
											<div class="user-block">
												<?php if(isset($yourfeed->profile_image) && !empty($yourfeed->profile_image)) { ?>
													<img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $yourfeed->profile_image;?>" alt="User Image">
												<?php } else { ?>
													<img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="User Image">
												<?php } ?>
												<span class="username"><a href="javascript:void(0);"><?php echo $yourfeed->name;?></a></span>
												<span class="description"><?php echo get_ydhmdatetime($yourfeed->date);?></span>
											</div>
										</div>
										<div class="box-body">
											<p class="text-justify"><?php echo $yourfeed->story;?></p>
											<button type="submit" class="btn btn-default btn-xs <?php echo $yourfeed->id;?>" onclick="likestory(<?php echo $yourfeed->id;?>)"><i class="fa fa-heart"></i></button>
											<span class="pull-right text-muted">
												<span id="old_like<?php echo $yourfeed->id;?>"><?php echo $yourfeed->likes; ?></span><span id="new_like"></span> Likes &nbsp; 
												<?php if(isset($comm_comment_count) && ($comm_comment_count->num_rows()>0)) {
														foreach($comm_comment_count->result() as $reviews2) { 
															if($reviews2->story_id == $yourfeed->id) { ?>
																<?php echo $reviews2->commentcount;?> 
															<?php } ?>
												<?php } } ?> Comments 
											</span>
										</div>
									<?php } ?><!-- /.box-footer -->
									<div class="box-footer">
										<div id="tpostscommunity_commentpost<?php echo $yourfeed->id; ?>">
											<?php if (isset($this->session->userdata['logged_in'])) { 
											    if(isset($this->session->userdata['logged_in']['profile_image']) && 
											        !empty($this->session->userdata['logged_in']['profile_image'])) { ?>
												<img src="<?php echo base_url().'assets/images/'.$this->session->userdata['logged_in']['profile_image']; ?>" style="width: 47px;height:37px; margin-right:10px;" class="img-responsive img-circle img-sm" >
											<?php } else { ?>
												<img src="<?php echo base_url();?>assets/images/2.png" style="width: 47px;height:37px; margin-right:10px;" class="img-responsive img-circle img-sm" >
											<?php } } ?>
											<div class="input-group">
											    <input type="hidden" name="tstory_id" value="<?php echo $yourfeed->id; ?>">
												<input type="text" name="tcomment" placeholder="Type Comment Message ..." class="form-control" required="">
												<input type="hidden" name="tcomm_id" value="<?php echo $yourfeed->comm_id; ?>">
												<span class="input-group-btn">
													<button type="submit" class="btn btn-success btn-flat" onclick="tpostscomm_comments(<?php echo $yourfeed->id;?>)"> Comment </button>
												</span>
											</div>
										</div>
									</div>
									<!-- /.box-footer -->
				                    
				                    <div class="box-footer box-comments tajaxcomment<?php echo $yourfeed->id;?>" style="background: #fff;"> </div>
									<?php $comments = get_comments($yourfeed->id);
										if(isset($comments) && ($comments->num_rows()>0)){ ?>
										<div id="topmyList<?php echo $yourfeed->id;?>">
											<?php foreach($comments->result() as $ycomment){ ?>
												<div class="box-footer box-comments editdelete<?php echo $ycomment->id;?>">
													<div class="box-comment">
														<?php if(isset($ycomment->profile_image) && !empty($ycomment->profile_image)){ ?>
															<img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $ycomment->profile_image;?>" alt="User Image">
														<?php } else { ?>
															<img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="User Image">
														<?php } ?>
														<div class="comment-text">
															<span class="username">&nbsp; <?php echo ucfirst($ycomment->name);?>
																<span class="text-muted pull-right"><?php echo get_ydhmdatetime($ycomment->date);?></span>
															</span> <br><span class="more <?php echo $ycomment->id;?>"><?php echo $ycomment->comment;?></span>
															<span class="pull-right">
                                                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" style="padding: 0px 10px 0px 20px;">
                                                                 <i class="fa fa-ellipsis-v"></i> </a> 
                                                                <ul class="dropdown-menu writemenu" style="top:auto; width:fit-content;">
                                                                    <?php if($ycomment->user_id == $this->session->userdata['logged_in']['user_id']){ ?>
                                                                    <li><a href="javascript:void(0);" onClick="editcommcomment(<?php echo $ycomment->id;?>);"><span><i class="fa fa-pencil"></i> Edit</span></a></li>
                                                                    <li><a href="javascript:void(0);" onClick="deletecommcomment(<?php echo $ycomment->id;?>);"><span><i class="fa fa-trash"></i> Delete</span></a></li>
                                                                    <?php }else{ ?>
                                                                    <li><a href="javascript:void(0);" onClick="reportcommcomment(<?php echo $ycomment->id;?>, <?php echo $ycomment->user_id;?>);"><span><i class="fa fa-exclamation-triangle"></i> Report</span></a></li>
                                                                    <?php } ?>
                                                                </ul>
                                                            </span>
                                                            <a href="javascript:void(0)" onClick="toppostReplycomment(<?php echo $ycomment->id;?>,<?php echo $ycomment->comm_id;?>,<?php echo $ycomment->story_id;?>)" class="pull-right" title="Reply"><i class="fa fa-reply" aria-hidden="true"></i> Reply</a>
        													<div class="input-group toppostreplycomment<?php echo $ycomment->id;?>"><!-- Reply comment form --></div>
														</div>
													</div>
													<div class="topsubcomments" style="margin-left:20px;background:#ddd;" id="topmysubList<?php echo $yourfeed->id;?>_<?php echo $ycomment->id;?>">
    													<?php $topsubcomments = get_subcomments($yourfeed->id, $ycomment->id); 
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
                                                                                <?php if($topsubcomment->user_id == $this->session->userdata['logged_in']['user_id']){ ?>
                                                                                <li><a href="javascript:void(0);" onClick="editcommcomment(<?php echo $topsubcomment->id;?>);"><span><i class="fa fa-pencil"></i> Edit</span></a></li>
                                                                                <li><a href="javascript:void(0);" onClick="deletecommcomment(<?php echo $topsubcomment->id;?>);"><span><i class="fa fa-trash"></i> Delete</span></a></li>
                                                                                <?php } else{ ?>
                                                                                <li><a href="javascript:void(0);" onClick="reportcommcomment(<?php echo $topsubcomment->id;?>, <?php echo $topsubcomment->user_id;?>);"><span><i class="fa fa-exclamation-triangle"></i> Report</span></a></li>
                                                                                <?php } ?>
                                                                            </ul>
                                                                        </span>
        													       </div>
        													   </div>
        													</div>
        													<?php } $commlastsubcomment = get_commlastsubcomment($yourfeed->id, $ycomment->id); 
        													    if($topsubcomment->id > $commlastsubcomment){ ?>
        													<a href="javascript:void(0);">
        													    <span class="toploadsubcomment<?php echo $ycomment->id;?>" onClick="topcommloadsubcomment(<?php echo $yourfeed->id;?>, <?php echo $ycomment->id;?>, <?php echo $topsubcomment->id;?>)">
        													        <center>Read More...</center></span></a>
        												    <?php } else{ ?>
        												    <span class="toploadsubcomment"></span>
            											<?php } } ?>
        											</div>
												</div>
										    <?php } ?>
									        <a href="javascript:void(0);"><span class="toploadmorespan<?php echo $yourfeed->id;?>" onClick="topcommloadmore(<?php echo $yourfeed->id;?>, <?php echo $ycomment->id;?>)"><center>Read More...</center></span></a>
									    </div>
									<?php } ?>
								</div>
								<!-- /.box-footer -->
							<?php } ?></div><div id="yload_data_message"></div><?php } ?>
						</div>
						
						<div class="tab-pane" id="tab_stories"><br>
						    <?php if(isset($storiesfeed) && ($storiesfeed->num_rows() > 0)){ ?><div id="sloadmoreall">
						    <?php foreach ($storiesfeed->result() as $storyfeed) { ?>
						        <div class="box box-widget" style="background:#fff; border:1px solid #dddddd;margin-bottom: 10px;">
						            <div class="box-header with-border">
										<div class="user-block">
											<?php if(isset($storyfeed->profile_image) && !empty($storyfeed->profile_image)) { ?>
												<img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $storyfeed->profile_image;?>" alt="User Image">
											<?php } else { ?>
												<img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="User Image">
											<?php } ?>
											<span class="dropdown pull-right">
												<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" title="Click Here to Report" aria-expanded="false">
													<i class="fa fa-ellipsis-v pull-right"></i>
												</a>
												<ul class="dropdown-menu pull-right">
													<li><?php if($storyfeed->type == 'story'){ ?>
													    <a href="javascript:void(0);" onClick="reportstories(<?php echo $storyfeed->user_id;?>,<?php echo $storyfeed->sid;?>);"><i class="fa fa-exclamation-triangle"></i> Report </a>
													    <?php }else { ?>
													    <a href="javascript:void(0);" onClick="reportseries(<?php echo $storyfeed->user_id;?>,<?php echo $storyfeed->sid;?>)"><i class="fa fa-exclamation-triangle"></i> Report </a>
													    <?php } ?>
												    </li>
												</ul>
											</span>
											<span class="username"><a href="javascript:void(0);"><?php echo $storyfeed->name;?></a></span>
											<span class="description"><i style="color:#040cff;"><?php echo $storyfeed->gener;?></i> - <?php echo get_ydhmdatetime($storyfeed->created_at);?></span>
										</div>
									</div>
									<div class="box-body">
										<div class="media border-box" style="margin-top:2px;">
											<div class="media-left">
										    <?php $hrefurl = "#"; if($storyfeed->type == 'story'){ 
										        $hrefurl = base_url().'index.php/welcome/only_story_view?id='.$storyfeed->sid;
										    }elseif($storyfeed->type == 'series'){
										        $hrefurl = base_url().'index.php/welcome/new_series?id='.$storyfeed->story_id.'&story_id='.$storyfeed->sid;} ?>
												<a href="<?php echo $hrefurl;?>" target="_blank">
													<?php if(!empty($storyfeed->cover_image)) { ?>
												    <img src="<?php echo base_url();?>assets/images/<?php echo $storyfeed->cover_image;?>" class="media-object img-v">
												    <?php } else { ?>
													<img src="<?php echo base_url();?>assets/images/1.jpg" class="media-object img-v">
													<?php } ?>
												</a>
											</div>
											<div class="media-body" style="padding-top:15px;">
												<a href="<?php echo $hrefurl;?>" target="_blank"> 
													<h4 class="media-heading"><b><?php echo ucfirst($storyfeed->title);?></b></h4>
												</a>
												<p class="edittext<?php echo $storyfeed->sid;?>"><?php echo substr(strip_tags($storyfeed->story),0,150); ?>...</p>
											</div>
										</div>
									</div>
									<!-- /.box-footer -->
									<div class="box-footer">
										<div id="storyfeed<?php echo $storyfeed->sid; ?>">
											<?php if(isset($this->session->userdata['logged_in']['profile_image']) && 
												    !empty($this->session->userdata['logged_in']['profile_image'])) { ?>
												<img src="<?php echo base_url().'assets/images/'.$this->session->userdata['logged_in']['profile_image']; ?>" style="width: 47px;height: 37px; margin-right:10px;" class="img-responsive img-circle img-sm" alt="User Image">
											<?php } else { ?>
												<img src="<?php echo base_url();?>assets/images/2.png" style="width: 47px;height:37px; margin-right:10px;" class="img-responsive img-circle img-sm" >
											<?php } ?>
											<div class="input-group">
												<input type="text" fssid="<?php echo $storyfeed->sid;?>" id="fscomment<?php echo $storyfeed->sid;?>" name="fscomment" placeholder="Type Comment Message for Story..." class="form-control" required="">
												<span class="input-group-btn">
													<button type="submit" class="btn btn-success btn-flat" onClick="storyfeed(<?php echo $storyfeed->sid;?>)"> Comment </button>
												</span>
											</div>
										</div>
									</div>
									
									<div class="box-footer box-comments fsajaxcomment<?php echo $storyfeed->sid;?>" style="background: #fff;"> </div>
									<!-- /.box-footer -->
    							    <?php $fscomments = get_feedstorycomment($storyfeed->sid); ?>
							        <div id="fsmyList<?php echo $storyfeed->sid;?>">
									    <?php if(isset($fscomments) && ($fscomments->num_rows()>0)) { 
									    foreach($fscomments->result() as $fscomment){ ?>
											<div class="box-footer box-comments fscommentdelete<?php echo $fscomment->cid;?>" style="padding-bottom:0px;">
												<div class="box-comment">
													<?php if(isset($fscomment->profile_image) && !empty($fscomment->profile_image)){ ?>
													<img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $fscomment->profile_image;?>" alt="User Image">
													<?php } else { ?>
													<img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="User Image">
													<?php } ?>
													<div class="comment-text">
														<span class="username">&nbsp; <?php echo ucfirst($fscomment->name);?>
															<span class="text-muted pull-right"><?php echo get_ydhmdatetime($fscomment->date);?></span>
														</span> <br><span class="fsmore <?php echo $fscomment->cid;?>" style="word-wrap: break-word;"><?php echo $fscomment->comment; ?></span>
														<span class="pull-right">
                                                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" style="padding: 0px 10px 0px 20px;">
                                                             <i class="fa fa-ellipsis-v"></i> </a> 
                                                            <ul class="dropdown-menu writemenu" style="top:auto; width:fit-content;">
                                                                <?php if($fscomment->user_id == $this->session->userdata['logged_in']['user_id']){ ?>
                                                                <li><a href="javascript:void(0);" onClick="fseditcomment(<?php echo $fscomment->cid;?>);"><span><i class="fa fa-pencil"></i> Edit</span></a></li>
                                                                <li><a href="javascript:void(0);" onClick="fsdeletecomment(<?php echo $fscomment->cid;?>);"><span><i class="fa fa-trash"></i> Delete</span></a></li>
                                                                <?php } else{ ?>
                                                                <li><a href="javascript:void(0);" onClick="fsreportcomment(<?php echo $fscomment->cid;?>,<?php echo $fscomment->user_id;?>);"><span><i class="fa fa-exclamation-triangle"></i> Report</span></a></li>
                                                                <?php } ?>
                                                            </ul>
                                                        </span>
                                                        <a href="javascript:void(0)" onClick="fspostReplycomment(<?php echo $fscomment->cid;?>,<?php echo $fscomment->story_id;?>)" class="pull-right" title="Reply"><i class="fa fa-reply" aria-hidden="true"></i> Reply</a>
														<div class="input-group fspostreplycomment<?php echo $fscomment->cid;?>"><!-- Reply comment form --></div>
													</div>
												</div>
												
												<div class="subcomments" style="margin-left:20px;background:#ddd;" id="fsmysubList<?php echo $storyfeed->sid;?>_<?php echo $fscomment->cid;?>">
													<?php $fssubcomments = get_replaycomments($fscomment->story_id, $fscomment->cid, 2); 
													    if(isset($fssubcomments) && ($fssubcomments->num_rows() > 0)){ foreach($fssubcomments->result() as $fssubcomment){ ?>
    													<div class="box-footer box-comments fscommentdelete<?php echo $fssubcomment->cid;?>" style="padding-bottom:0px;background:#ddd;">
    													    <div class="box-comment">
    													        <?php if(isset($fssubcomment->profile_image) && !empty($fssubcomment->profile_image)){ ?>
    													        <img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $fssubcomment->profile_image;?>">
    													        <?php } else { ?>
    													        <img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="User Image">
    													        <?php } ?>
    													        <div class="comment-text">
    													            <span class="username">&nbsp;<?php echo ucfirst($fssubcomment->name);?>
    													                <span class="text-muted pull-right"><?php echo get_ydhmdatetime($fssubcomment->date);?></span>
    													            </span>	<br> <span class="fsmore <?php echo $fssubcomment->cid;?>" style="word-wrap: break-word;"><?php echo $fssubcomment->comment;?></span>
    													            <span class="pull-right">
                                                                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" style="padding: 0px 10px 0px 20px;">
                                                                         <i class="fa fa-ellipsis-v"></i> </a> 
                                                                        <ul class="dropdown-menu writemenu" style="top:auto; width:fit-content;">
                                                                            <?php if($fssubcomment->user_id == $this->session->userdata['logged_in']['user_id']){ ?>
                                                                            <li><a href="javascript:void(0);" onClick="fseditcomment(<?php echo $fssubcomment->cid;?>);"><span><i class="fa fa-pencil"></i> Edit</span></a></li>
                                                                            <li><a href="javascript:void(0);" onClick="fsdeletecomment(<?php echo $fssubcomment->cid;?>);"><span><i class="fa fa-trash"></i> Delete</span></a></li>
                                                                            <?php } else{ ?>
                                                                            <li><a href="javascript:void(0);" onClick="fsreportcomment(<?php echo $fssubcomment->cid;?>, <?php echo $fssubcomment->user_id;?>);"><span><i class="fa fa-exclamation-triangle"></i> Report</span></a></li>
                                                                            <?php } ?>
                                                                        </ul>
                                                                    </span>
    													       </div>
    													   </div>
    													</div>
    													<?php } $fslastsubcomment = get_fslastsubcomment($storyfeed->sid, $fscomment->cid); 
    													    if($fssubcomment->cid > $fslastsubcomment){ ?>
    													<a href="javascript:void(0);"><span class="fsloadsubcomment<?php echo $fscomment->cid;?>" onClick="fsloadsubcomment(<?php echo $storyfeed->sid;?>, <?php echo $fscomment->cid;?>, <?php echo $fssubcomment->cid;?>)"><center>Read More...</center></span></a>
    												    <?php } else{ ?>
    												    <span class="fsloadsubcomment"></span>
        											<?php } } ?>
    											</div>
											</div>
									    <?php } $fslastcomment = get_fslastcomment($storyfeed->sid); if($fscomment->cid > $fslastcomment){ ?>
								        <a href="javascript:void(0);"><span class="fsloadmorespan<?php echo $storyfeed->sid;?>" onClick="fsloadmore(<?php echo $storyfeed->sid;?>, <?php echo $fscomment->cid;?>)"><center>Read More...</center></span></a>
								        <?php } else{ ?>
								        <span class="fsloadmorespan"></span>
								        <?php } } ?>
								    </div>
								    
					            </div>
						    <?php } ?></div><div id="sload_data_message"></div>
						    <?php } ?>
						</div>
						
					</div>
				</div>
				
				
				<div class="hidden-xs side-feed">
					<div class="sidebarvj" style="box-shadow:0 1px 1px 0 rgba(0,0,0,0.14), 0 2px 1px -1px rgba(0,0,0,0.12), 0 1px 3px 0 rgba(0,0,0,0.2)!important">
						<div class="header">
							<p><b>JOINED COMMUNITIES <span class="pull-right"><a href="<?php echo base_url('index.php/Welcome/communities');?>">More</a></span>
							</b></p>
						</div><br>
						<?php if(isset($get_communities_all) && !empty($get_communities_all)){
						foreach($get_communities_all->result() as $row) { if(in_array($row->id, $join_comm)) { ?>
							<div class="row pt-0">
							<!-- <div class="col-md-3" style="padding-right:0px;">
									<div>
										<img class="img-circle img-responsive" style="width:47px; height:47px" src="<?php echo base_url();?>assets/images/<?php  echo $row->comm_image;?>" alt="Photo">
									</div>
								</div>
								<div class="col-md-12  pd-0" style="padding-left:5px;">
								    <span class="pull-left" style="padding-top:8px;">
        					            <a href="" style="text-transform:uppercase; padding-top:10px; text-overflow:ellipsis;"><b><?php echo $row->gener; ?></b></a>
        					        </span>
        					        <span class="pull-right">
        					            <?php if(in_array($row->id, $join_comm)) { ?>
											<button class="btn btn-success unjoin<?php echo $row->id;?>" style="border-radius:4px!important;" onclick="commuunjoin(<?php echo $row->id;?>,'<?php echo $row->gener;?>')"> JOINED </button>
										<?php } else { ?>
											<button class="btn btn-danger join<?php echo $row->id;?>" style="border-radius:4px!important;" onclick="commujoin(<?php echo $row->id;?>,'<?php echo $row->gener;?>')"> JOIN </button>
										<?php } ?>
        					        </span>
									<div class="" style="border-radius:0 0 0px 5px;">
										<a href=""><b><?php echo $row->gener; ?></b></a>
										<p class="text-justify" style="font-size:12px;"><?php echo substr($row->about_communities,0,50); ?></p>
										<input type="hidden" name="comm_id" value="<?php echo $row->id; ?>">
										<input type="hidden" name="gener" value="<?php echo $row->gener;?>">
										<center>
											<?php if(in_array($row->id, $join_comm)) { ?>
												<button class="btn-block btn btn-success unjoin<?php echo $row->id;?>" onclick="commuunjoin(<?php echo $row->id;?>,'<?php echo $row->gener;?>')"> JOINED </button>
											<?php } else { ?>
												<button class="btn-block btn btn-danger join<?php echo $row->id;?>" onclick="commujoin(<?php echo $row->id;?>,'<?php echo $row->gener;?>')"> JOIN </button>
											<?php } ?>
										</center>
									</div>
								</div>-->
								
								<div class="col-md-12  pd-0" style="padding-left:5px;">
								    <span class="pull-left" style="padding-top:8px;">
        					            <a href="" style="text-transform:uppercase; padding-top:10px; text-overflow:ellipsis;"><b><?php echo $row->gener; ?></b></a>
        					        </span>
        					        <span class="pull-right">
        					            <button class="btn btn-success unjoin<?php echo $row->id;?>" style="border-radius:4px!important;" onclick="commuunjoin(<?php echo $row->id;?>,'<?php echo $row->gener;?>')"> JOINED </button>
									</span>
								</div>
								
							</div>
							<hr style="margin:3px 0 3px; border:0.6px solid #f4f4f4;">
						<?php } } } ?>
					</div>
				</div><!-- COL-MD-3 -->
			
			</div>
		</section>
	</div>
</div>

<style>
    .box-footer {
    border-top: 0.6px solid #f4f4f4;
}
</style>


<div id="editcomm_post" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><center>Update Your Post</center></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="updatecomm_post" action="#"></form>
            </div>
        </div>
    </div>
</div>
<div id="reportcomm_post" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><center>Report The Post</center></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="reportcommpost" action="#">
                    <textarea name="reportmsg" Placeholder="Why is it inappropriate? Write your reason here..." class="form-control" style="resize:none;"></textarea>
                    <span class="text-danger reportmsg"></span>
                    <input type="hidden" name="comm_story_id" id="comm_story_id" value="">
                    <input type="hidden" name="posted_byid" id="posted_byid" value=""><br>
                    <center><button type="submit" class="btn btn-danger"> Report </button></center>
                </form>
            </div>
        </div>
    </div>
</div>

<!--report stories popup end ------------->
<div class="modal" id="reportstories" role="dialog" aria-hidden="true">
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
<!-- comment update popup code ------>
<div class="modal" id="commentedit" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div id="commenteditdiv"></div>
            </div>
        </div>
	</div>
</div>
<!--comment update popup end ------------->
<!-- report comment popup code ------>
<div class="modal" id="reportcomment" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h4>Report The Comment</h4>
                <input type="hidden" id="reportcommentid">
                <input type="hidden" id="reportcommentuserid">
                <textarea class="form-control" id="reportcmtmsg" placeholder ="Enter your Report Comments"></textarea>
                <br>
                <center><button type="submit" onClick="reportcommentdiv()" class="btn btn-danger">Report</button></center>
            </div>
        </div>
	</div>
</div>
<!--report comment popup end ------------->

<!-- fsstory comment update popup code ------>
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
<!-- fsstory comment update popup end ------------->





<script type="text/javascript">
function likestory(id){ // like Story
	var totallikes = $('#old_like'+id).text();
	$.ajax({
		url:'<?php echo base_url();?>index.php/welcome/comm_likes',
		method: 'POST',
		data: {'story_id':id},
		dataType:'json',
		success:function(data){
		if(data) {
			$('#old_like'+id).text(parseInt(totallikes)+1);
			$('.like'+id).css('color', '#337ab7');
			$('button.like'+id).attr('onclick', "unlikestory("+id+")");
			$('.like'+id).removeClass('like'+id).addClass('unlike'+id);
           }
        } 
    });
}
function unlikestory(id){ // unlike Story
	var totallikes = $('#old_like'+id).text();
	$.ajax({
		url:'<?php echo base_url();?>index.php/welcome/comm_likes',
		method: 'POST',
		data: {'story_id':id},
		dataType:'json',
		success:function(data){
		if(data) {
			$('#old_like'+id).text(parseInt(totallikes)-1);
			$('.unlike'+id).css('color', '#444');
			$('button.unlike'+id).attr('onclick', "likestory("+id+")");
			$('.unlike'+id).removeClass('unlike'+id).addClass('like'+id);
           }
        } 
    })
}
function tpostlikestory(id){ // like Story
	var totallikes = $('#told_like'+id).text();
	$.ajax({
		url:'<?php echo base_url();?>index.php/welcome/comm_likes',
		method: 'POST',
		data: {'story_id':id},
		dataType:'json',
		success:function(data){
		if(data) {
			$('#told_like'+id).text(parseInt(totallikes)+1);
			$('.like'+id).css('color', '#337ab7');
			$('button.like'+id).attr('onclick', "tpostunlikestory("+id+")");
			$('.like'+id).removeClass('like'+id).addClass('unlike'+id);
           }
        } 
    });
}
function tpostunlikestory(id){ // unlike Story
	var totallikes = $('#told_like'+id).text();
	$.ajax({
		url:'<?php echo base_url();?>index.php/welcome/comm_likes',
		method: 'POST',
		data: {'story_id':id},
		dataType:'json',
		success:function(data){
		if(data) {
			$('#told_like'+id).text(parseInt(totallikes)-1);
			$('.unlike'+id).css('color', '#444');
			$('button.unlike'+id).attr('onclick', "tpostlikestory("+id+")");
			$('.unlike'+id).removeClass('unlike'+id).addClass('like'+id);
           }
        } 
    })
}
function deletecomm_post(comm_story_id, posted_by){
	$.ajax({
		url:'<?php echo base_url();?>index.php/welcome/deletecomm_post',
		method: 'POST',
		data: {'comm_story_id':comm_story_id, 'posted_by':posted_by},
		dataType:'json',
		success:function(data){
			if(data) {
				$('#delcomm'+comm_story_id).css('display', 'none');
           }
        } 
    });
}
function editcomm_post(comm_story_id, posted_by){
    $('#editcomm_post').modal('show');
	$.ajax({
		url:'<?php echo base_url();?>index.php/welcome/editcomm_post',
		method: 'POST',
		data: {'comm_story_id':comm_story_id, 'posted_by':posted_by},
		success:function(data){
			if(data) {
			    $('#updatecomm_post').html(data);
           }
        } 
    });
}
function reportcomm_post(comm_story_id, posted_by){
    $('#reportcomm_post').modal('show');
    $('#comm_story_id').val(comm_story_id);
    $('#posted_byid').val(posted_by);
}
</script>
<script type="text/javascript">
$(document).ready(function(){
    $('input[name="comment"]').on("keydown", function (e) {
        if (e.keyCode === 13) {  //checks whether the pressed key is "Enter"
            var story_id = $(this).parent().find('input[name="story_id"]').val();
            if(story_id){
                comm_comments(story_id);
            }
        }
    });
});
function comm_comments(story_id){ //Comments post submit
	var inputdata = $('#community_commentpost'+story_id+' :input').serialize();
	$.post("<?php echo base_url();?>index.php/welcome/communities_comments",inputdata,function(resultdata, status) {
		var result=JSON.parse(resultdata);
		if(result.status == -1){
			alert('Please Enter Comments Message.');
		}else if(result.status == 1){
		    //console.log(result);
			$("#community_commentpost"+story_id).find('input[name="comment" ]').val('');
			$('.ajaxcomment'+story_id).css('display','block');
			$('.ajaxcomment'+story_id).prepend('<div class="box-comment">'+
		        '<img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="User Image">'+
			    '<div class="comment-text"><span class="username">'+result.response.name+'<span class="text-muted pull-right">1 minute ago</span></span> <br>'+
		            '<span class="more '+result.response.id+'">'+result.response.comment+'</span>'+
		            '<span class="pull-right">'+
                        '<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" style="padding: 0px 10px 0px 20px;">'+
                         '<i class="fa fa-ellipsis-v"></i> </a> '+
                        '<ul class="dropdown-menu writemenu" style="top:auto; width:fit-content;">'+
                            '<li><a href="javascript:void(0);" onclick="editcommcomment('+result.response.id+');"><span><i class="fa fa-pencil"></i> Edit</span></a></li>'+
                            '<li><a href="javascript:void(0);" onclick="deletecommcomment('+result.response.id+');"><span><i class="fa fa-trash"></i> Delete</span></a></li>'+
                        '</ul>'+
                    '</span>'+
                    '<a href="javascript:void(0)" onclick="postReplycomment('+result.response.id+','+result.response.comm_id+','+result.response.story_id+')" class="pull-right" title="Reply"><i class="fa fa-reply" aria-hidden="true"></i> Reply</a>'+
                    '<div class="input-group postreplycomment'+result.response.id+'"></div>'+
		        '</div>'+
		    '</div>'+'<div class="subcomments" style="margin-left:20px;background:#ddd;" id="mysubList'+result.response.story_id+'_'+result.response.id+'"></div>');
		}else{
			alert('Failed to Post Comment.');
		}
	})
}
$(document).ready(function(){
    $('input[name="tcomment"]').on("keydown", function (e) {
        if (e.keyCode === 13) {  //checks whether the pressed key is "Enter"
            var story_id = $(this).parent().find('input[name="tstory_id"]').val();
            if(story_id){
                tpostscomm_comments(story_id);
            }
        }
    });
});
function tpostscomm_comments(story_id){ //top posts Comments post submit
	var inputdata = $('#tpostscommunity_commentpost'+story_id+' :input').serialize();
	$.post("<?php echo base_url();?>index.php/welcome/communities_comments",inputdata,function(resultdata, status) {
		var result=JSON.parse(resultdata);
		if(result.status == -1){
			alert('Please Enter Comments Message.');
		}else if(result.status == 1){
			$("#tpostscommunity_commentpost"+story_id).find('input[name="tcomment" ]').val('');
			$('.tajaxcomment'+story_id).css('display','block');
			var profile_image = '<?php echo $this->session->userdata['logged_in']['profile_image']; ?>';
			if((profile_image != '') || (profile_image != ' ') || (profile_image != 'undefined')){ }else{ profile_image = '2.png'; }
			
			var yourfeedcommenthtml = '<div class="box-comment">'+
			    '<img class="img-circle" src="<?php echo base_url();?>assets/images/'+profile_image+'" alt="User Image">'+
			        '<div class="comment-text"><span class="username">&nbsp; '+result.response.name+'<span class="text-muted pull-right">'+
			        '1 minute ago</span></span><br>'+
    					'<span class="more '+result.response.id+'">'+result.response.comment+'</span><span class="pull-right">'+
                            '<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" style="padding: 0px 10px 0px 20px;">'+
                                '<i class="fa fa-ellipsis-v"></i> </a> '+
                            '<ul class="dropdown-menu writemenu" style="top:auto; width:fit-content;">'+
                                '<li><a href="javascript:void(0);" onclick="editcommcomment('+result.response.id+');"><span><i class="fa fa-pencil"></i> Edit</span></a></li>'+
                                '<li><a href="javascript:void(0);" onclick="deletecommcomment('+result.response.id+');"><span><i class="fa fa-trash"></i> Delete</span></a></li>'+
                            '</ul>'+
                        '</span>'+
                        '<a href="javascript:void(0)" onclick="toppostReplycomment('+result.response.id+','+result.response.comm_id+','+result.response.story_id+')" class="pull-right" title="Reply">'+
                            '<i class="fa fa-reply" aria-hidden="true"></i> Reply</a>'+
            			'<div class="input-group toppostreplycomment'+result.response.id+'"></div>'+
        		'</div></div>'+
        		'<div class="topsubcomments" style="margin-left:20px;background:#ddd;" id="topmysubList'+result.response.story_id+'_'+result.response.id+'"></div>';
			$('.tajaxcomment'+story_id).prepend(yourfeedcommenthtml);
		}else{
			alert('Failed to Post Comment.');
		}
	})
}
</script>
<script>
function commujoin(comm_id, gener) { // community join button 
    $.ajax({
		type :'POST',
		url :'<?php echo base_url(); ?>index.php/welcome/communities_join',
		data :{'comm_id':comm_id, 'gener':gener},
		dataType :"json",
		success:function(data){
		    if(data == 1){
		        $('button.join'+comm_id).text('JOINED');
		        $('button.join'+comm_id).removeClass('btn-danger').addClass('btn-success');
		        $('button.join'+comm_id).attr('onclick','commuunjoin('+comm_id+',"'+gener+'")');
		        $('button.join'+comm_id).removeClass('join'+comm_id).addClass('unjoin'+comm_id);
			    alert('You Are Successfully joind to the Community.');
			}else{
			    alert('Failed to join the Community.');
			}
		}
	});
}
function commuunjoin(comm_id, gener) { // community unjoin button 
    $.ajax({
		type :'POST',
		url :'<?php echo base_url(); ?>index.php/welcome/communities_join',
		data :{'comm_id':comm_id, 'gener':gener},
		dataType :"json",
		success:function(data){
		    if(data == 2){
		        $('button.unjoin'+comm_id).text('JOIN');
		        $('button.unjoin'+comm_id).removeClass('btn-success').addClass('btn-danger');
		        $('button.unjoin'+comm_id).attr('onclick','commujoin('+comm_id+',"'+gener+'")');
		        $('button.unjoin'+comm_id).removeClass('unjoin'+comm_id).addClass('join'+comm_id);
			    alert('You Are Successfully Un Joined the Community.');
			}else{
			    alert('Failed to un join the Community.');
			}
		}
	});
}
</script>

<script>
    $( "form#updatecomm_post" ).submit(function( event ) {
		event.preventDefault();
		var ptextid = $("form#updatecomm_post").serializeArray()[0].value;
		var ptext = $("form#updatecomm_post").serializeArray()[1].value;
		var pquotes = '';
		if($("form#updatecomm_post").serializeArray().length > 2) {
		    pquotes = $("form#updatecomm_post").serializeArray()[2].value;
		}
		$.post("<?php echo base_url();?>index.php/welcome/updatecomm_post",$("form#updatecomm_post").serialize(),function(resultdata, status) {
			$('span.text-danger').empty();
			var result=JSON.parse(resultdata);
			if(result.status == -1){
				$.each(result.validations,function (p,q){
					$('span.'+p).text(q);
				});
			}else if((result.status == 1) && (result.response == 'success')){
			    if(pquotes == 'quotes'){
			        $('.edittext'+ptextid).html('<b><q>'+ptext+'</q></b>');
			    }else{
    			    $('.edittext'+ptextid).text(ptext.substr(0, 100));
			    }
    			    $('#editcomm_post').modal('hide');
			}else{
			}
		});
	});
	$( "form#reportcommpost" ).submit(function( event ) {
		event.preventDefault();
		$.post("<?php echo base_url();?>index.php/welcome/reportcomm_post",$("form#reportcommpost").serialize(),function(resultdata, status) {
			$('span.text-danger').empty();
			var result=JSON.parse(resultdata);
			if(result.status == -1){
				$.each(result.validations,function (p,q){
					$('span.'+p).text(q);
				});
			}else if((result.status == 1) && (result.response == 'success')){
			    $('#reportcomm_post').modal('hide');
			}else{
				alert('Failed to report.');
			}
		});
	});

    function postReplycomment(commentid, comm_id, story_id){
	    $('div.postreplycomment'+commentid).html('<input type="text" id="replycmts'+commentid+'" value="" class="form-control" placeholder="Reply Comment..." required>'+
	    '<span class="text-danger addreplaycmt'+commentid+'"></span><span class="input-group-btn">'+
	    '<button type="submit" class="btn btn-success btn-flat" onclick="addreplycomment('+commentid+','+comm_id+','+story_id+')">POST</button></span>');
	}
	function addreplycomment(commentid, comm_id, story_id){
	    var comments = $('#replycmts'+commentid).val();
	    if(comments){
	        $.ajax({
        		url:'<?php echo base_url();?>index.php/welcome/communities_comments',
        		method: 'POST',
        		data: {'comment_id': commentid, 'comm_id': comm_id, 'story_id': story_id,'comment':comments},
        		dataType: "json",
        		success:function(data){
                    $('#replycmts'+commentid).val('');
        		    if(data.status == 2){
                        $('.addreplaycmt'+commentid).text('Enter your Comments.');
                    }else if(data.status == 1){
                        $.ajax({
                            url: "<?php echo base_url('index.php/welcome/communities_commentslast'); ?>",
                            type: 'POST',
                            dataType: 'json',
                            success: function(result) {
                                if(result.response){
                                    var profile_image = "<?php echo $this->session->userdata['logged_in']['profile_image'];?>";
                                    if((profile_image != '') || (profile_image != ' ') || (profile_image != 'undefined')){
                                    }else{ profile_image = '2.png'; }
                                    
                                    var htmlcomment ='<div class="box-footer box-comments editdelete'+result.response[0].id+'" style="padding-bottom:0px;background:#ddd;">'+
									    '<div class="box-comment"><img class="img-circle" src="<?php echo base_url();?>assets/images/'+profile_image+'" alt="User Image">'+
                                            '<div class="comment-text"><span class="username"> &nbsp;'+result.response[0].name+
                                                '<span class="text-muted pull-right">1 minute ago</span></span><br>'+
                                                '<span class="more '+result.response[0].id+'">'+result.response[0].comment+'</span>'+
                                                '<span class="pull-right">'+
                                                    '<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" style="padding: 0px 10px 0px 20px;">'+
                                                     '<i class="fa fa-ellipsis-v"></i> </a> '+
                                                    '<ul class="dropdown-menu writemenu" style="top:auto; width:fit-content;">'+
                                                        '<li><a href="javascript:void(0);" onclick="editcommcomment('+result.response[0].id+');"><span><i class="fa fa-pencil"></i> Edit</span></a></li>'+
                                                        '<li><a href="javascript:void(0);" onclick="deletecommcomment('+result.response[0].id+');"><span><i class="fa fa-trash"></i> Delete</span></a></li>'+
                                                    '</ul>'+
                                                '</span>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>';
                                    $('#mysubList'+result.response[0].story_id+'_'+result.response[0].comment_id).prepend(htmlcomment);
                                }else{
                                    
                                }
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
	function commloadmore(storyid, commentid){
        $('.loadmorespan'+storyid).hide();
        $.ajax({
            type:'POST',
            url:"<?php echo base_url();?>index.php/welcome/commloadcomments",
            data:{'storyid':storyid, 'commentid':commentid},
            success:function(html){
                $('#myList'+storyid).append(html);
            }
        });
    }
    function commloadsubcomment(storyid, comment_id, subcommentid ){
        $('.loadsubcomment'+comment_id).hide();
        $.ajax({
            type:'POST',
            url:"<?php echo base_url();?>index.php/welcome/commloadsubcomments",
            data:{'storyid':storyid, 'comment_id':comment_id,'subcommentid':subcommentid },
            success:function(html){
                $('#mysubList'+storyid+'_'+comment_id).append(html);
            }
        });
    }
    function deletecommcomment(commentid){
        $.ajax({
            type:'POST',
            url:"<?php echo base_url();?>index.php/welcome/deletecommcomment",
            data:{'commentid':commentid},
            success:function(response){
                if(response == 1){
                    $('.editdelete'+commentid).css('display','none');
                    $('#snackbar').text('Comment Deleted Successfully.').addClass('show');
    	            setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
                }else{
                    $('#snackbar').text('Failed to Delete Comment.').addClass('show');
    	            setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
                }
            }
        });
    }
    function editcommcomment(commentid){
        $.ajax({
            type:'POST',
            url:"<?php echo base_url();?>index.php/welcome/editcommcomment",
            data:{'commentid':commentid},
            success:function(response){
                if(response == 0){
                    $('#snackbar').text('Failed to Edit Comment.').addClass('show');
    	            setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
                }else{
    	            $('#commenteditdiv').html(response);
    	            $('#commentedit').modal('show');
                }
            }
        });
    }
    function updatecommcomment(commentid){
        var comment = $('textarea#ucomment').val();
        $.ajax({
            type:'POST',
            url:"<?php echo base_url();?>index.php/welcome/updatecommcomment",
            data:{'comment':comment,'commentid': commentid},
            success:function(response){
                if(response == 1){
                    $('#commentedit').modal('hide');
                    $('.'+commentid).text(comment);
                    $('#snackbar').text('Comment Update Successfully.').addClass('show');
    	            setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
                }else{
                    $('#snackbar').text('Failed to Update Comment.').addClass('show');
    	            setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
                }
            }
        });
    }
    function reportcommcomment(commentid, userid){
        $('#reportcommentid').val(commentid);
        $('#reportcommentuserid').val(userid);
        $('#reportcomment').modal('show');
    }
    function reportcommentdiv(){
        var reportcommentid = $('#reportcommentid').val();
        var reportcommentuserid = $('#reportcommentuserid').val();
        var reportmsg = $('#reportcmtmsg').val();
        $.ajax({
    		url:'<?php echo base_url();?>index.php/welcome/reportcommcomment',
    		method: 'POST',
    		data: {'commentid': reportcommentid, 'userid': reportcommentuserid, 'reportmsg': reportmsg},
    		dataType: "json",
    		success:function(data){
    		    if((data.status == 1) && (data.response == 'success')){
        		    $('#snackbar').text('Successfully Reported.').addClass('show');
        	        setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
        	        $('#reportcomment').modal('hide');
    		    }else if((data.status == 2) && (data.response == 'fail')){
    		        $('#snackbar').text('Report Failed. Try Again').addClass('show');
        	        setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
        	        location.reload();
    		    }else{
    		        $('#snackbar').text('Please Enter report Message.').addClass('show');
        	        setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
    		    }
    		}
        });
    }
    
    /* top posts */
    function toppostReplycomment(commentid, comm_id, story_id){
	    $('div.toppostreplycomment'+commentid).html('<input type="text" id="topreplycmts'+commentid+'" value="" class="form-control" placeholder="Reply Comment..." required>'+
	    '<span class="text-danger addreplaycmt'+commentid+'"></span><span class="input-group-btn">'+
	    '<button type="submit" class="btn btn-success btn-flat" onclick="topaddreplycomment('+commentid+','+comm_id+','+story_id+')">POST</button></span>');
	}
	function topaddreplycomment(commentid, comm_id, story_id){
	    var comments = $('#topreplycmts'+commentid).val();
	    if(comments){
	        $.ajax({
        		url:'<?php echo base_url();?>index.php/welcome/communities_comments',
        		method: 'POST',
        		data: {'comment_id': commentid, 'comm_id': comm_id, 'story_id': story_id,'comment':comments},
        		dataType: "json",
        		success:function(data){
                    $('#topreplycmts'+commentid).val('');
        		    if(data.status == 2){
                        $('.topaddreplaycmt'+commentid).text('Enter your Comments.');
                    }else if(data.status == 1){
                        $.ajax({
                            url: "<?php echo base_url('index.php/welcome/communities_commentslast'); ?>",
                            type: 'POST',
                            dataType: 'json',
                            success: function(result) {
                                if(result.response){
                                    var profile_image = "<?php echo $this->session->userdata['logged_in']['profile_image'];?>";
                                    if((profile_image != '') || (profile_image != ' ') || (profile_image != 'undefined')){
                                    }else{ profile_image = '2.png'; }
                                    var yourfeedsubcommenthtml = '<div class="box-footer box-comments editdelete367" style="padding-bottom:0px;background:#ddd;">'+
                                        '<div class="box-comment"><img class="img-circle" src="<?php echo base_url();?>assets/images/'+profile_image+'">'+
        									'<div class="comment-text"><span class="username">&nbsp; '+result.response[0].name+'<span class="text-muted pull-right">'+
        									'1 minute ago</span></span><br>'+
        									    '<span class="more '+result.response[0].id+'">'+result.response[0].comment+'</span><span class="pull-right">'+
                                                    '<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" style="padding: 0px 10px 0px 20px;">'+
                                                        '<i class="fa fa-ellipsis-v"></i> </a> '+
                                                    '<ul class="dropdown-menu writemenu" style="top:auto; width:fit-content;">'+
                                                        '<li><a href="javascript:void(0);" onclick="editcommcomment('+result.response[0].id+');"><span><i class="fa fa-pencil"></i> Edit</span></a></li>'+
                                                        '<li><a href="javascript:void(0);" onclick="deletecommcomment('+result.response[0].id+');"><span><i class="fa fa-trash"></i> Delete</span></a></li>'+
                                                    '</ul>'+
                                                '</span>'+
        									'</div>'+
        								'</div></div>';
                                    $('#topmysubList'+story_id+'_'+commentid).prepend(yourfeedsubcommenthtml);
                                }else{
                                }
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
    function topcommloadmore(storyid, commentid){
        $('.toploadmorespan'+storyid).hide();
        $.ajax({
            type:'POST',
            url:"<?php echo base_url();?>index.php/welcome/commloadcomments/topstory",
            data:{'storyid':storyid, 'commentid':commentid},
            success:function(html){
                $('#topmyList'+storyid).append(html);
            }
        });
    }
    function topcommloadsubcomment(storyid, comment_id, subcommentid ){
        $('.toploadsubcomment'+comment_id).hide();
        $.ajax({
            type:'POST',
            url:"<?php echo base_url();?>index.php/welcome/commloadsubcomments/topstory",
            data:{'storyid':storyid, 'comment_id':comment_id,'subcommentid':subcommentid },
            success:function(html){
                $('#topmysubList'+storyid+'_'+comment_id).append(html);
            }
        });
    }
</script>

<!-- Feed Story Comments start-->
<script type="text/javascript">
    $(document).ready(function(){
        $('input[name="fscomment"]').on("keydown", function (e) {
            if (e.keyCode === 13) {  //checks whether the pressed key is "Enter"
                var sid = $(this).attr('fssid');
                if(sid){
                    storyfeed(sid);
                }
            }
        });
    });
	function storyfeed(sid){ //Comments post submit
		var comment = $('#fscomment'+sid).val();
		$.post("<?php echo base_url();?>index.php/welcome/fscomment",{'comment':comment,'storyid':sid},function(resultdata, status) {
			var result=JSON.parse(resultdata);
			if(result.status == -1){
				$('#snackbar').text('Please enter Comments Message.').addClass('show');
    	        setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
			}else if(result.status == 1){
				$('#fscomment'+sid).val('');
				$('.fsajaxcomment'+sid).css('display','block');
				var profile_image = '<?php echo $this->session->userdata['logged_in']['profile_image']; ?>';
				if(profile_image){  }else{  profile_image = '2.png'; }
				$('.fsajaxcomment'+sid).prepend('<div class="box-comment fscommentdelete'+result.response.cid+'">'+
    		        '<img class="img-circle" src="<?php echo base_url();?>assets/images/'+profile_image+'" alt="User Image">'+
    			    '<div class="comment-text"><span class="username">'+result.response.name+'<span class="text-muted pull-right">'+result.response.hydhmdatetime+'</span></span> <br>'+
    		            '<span class="fsmore '+result.response.cid+'" style="word-wrap: break-word;">'+result.response.comment+'</span>'+
    		            '<span class="pull-right">'+
                            '<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" style="padding: 0px 10px 0px 20px;">'+
                             '<i class="fa fa-ellipsis-v"></i> </a> '+
                            '<ul class="dropdown-menu writemenu" style="top:auto; width:fit-content;">'+
                                '<li><a href="javascript:void(0);" onclick="fseditcomment('+result.response.cid+');"><span><i class="fa fa-pencil"></i> Edit</span></a></li>'+
                                '<li><a href="javascript:void(0);" onclick="fsdeletecomment('+result.response.cid+');"><span><i class="fa fa-trash"></i> Delete</span></a></li>'+
                            '</ul>'+
                        '</span>'+
                        '<a href="javascript:void(0)" onclick="fspostReplycomment('+result.response.cid+','+result.response.story_id+')" class="pull-right" title="Reply"><i class="fa fa-reply" aria-hidden="true"></i> Reply</a>'+
                        '<div class="input-group fspostreplycomment'+result.response.cid+'"></div>'+
    		        '</div>'+
    		    '<div class="subcomments" style="margin-left:20px;background:#ddd;" id="fsmysubList'+result.response.story_id+'_'+result.response.cid+'"></div></div>');
			}else{
				$('#snackbar').text('Failed to Post Comment.').addClass('show');
    	        setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
			}
		});
	}
	function fseditcomment(commentid){
	    $('#edit_comment').modal('show');
        $.ajax({
            type:'POST',
            url:"<?php echo base_url();?>index.php/welcome/editpro_comment/"+commentid,
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
				$('#snackbar').text('Please enter Comments.').addClass('show');
    	        setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
			}else if(resultdata == 1){
			    $('#snackbar').text('Comment Updated Successfully.').addClass('show');
    	        setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
			    $('.fsmore.'+cid).html(comments);
			    $('#edit_comment').modal('hide');
			}else{
			    $('#snackbar').text('Failed to Update Comment.').addClass('show');
    	        setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
			}
		});
	});
	function fsdeletecomment(commentid){
	    $.ajax({
    		url:'<?php echo base_url();?>index.php/welcome/deletepro_comment/'+commentid,
    		method: 'POST',
    		dataType: "json",
    		success:function(data){
    		    if(data == 1) {
                    $('div.fscommentdelete'+commentid).css('display','none');
                }
            } 
        });
	}
	$(document).ready(function(){
        $('input[name="fssubcomment"]').on("keydown", function (e) {
            if (e.keyCode === 13) {  //checks whether the pressed key is "Enter"
                var sid = $(this).attr('fssubsid');
                var commentid = $(this).attr('fscommentid');
                if(sid){
                    fsaddreplycomment(commentid,storyid);
                }
            }
        });
    });
	function fspostReplycomment(commentid, storyid){
	    $('div.fspostreplycomment'+commentid).html('<input type="text" fssubsid="'+storyid+'" fscommentid="'+commentid+'" name="fssubcomment" id="replycmts'+commentid+'" value="" class="form-control" placeholder="Replay Comment..." required>'+
	    '<span class="text-danger"></span><span class="input-group-btn">'+
	    '<button type="submit" class="btn btn-success btn-flat" onclick="fsaddreplycomment('+commentid+','+storyid+')">POST</button></span>');
	}
	function fsaddreplycomment(commentid, storyid){
	    var comments = $('#replycmts'+commentid).val();
	    if(comments){
	        $.ajax({
        		url:'<?php echo base_url();?>index.php/welcome/addstoryreplycomment',
        		method: 'POST',
        		data: {'comment_id': commentid, 'comment':comments, 'story_id': storyid},
        		dataType: "json",
        		success:function(data){
        		    if(data == 2){
                         $('#snackbar').text('Enter Reply Comment text.').addClass('show');
    	                 setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
                    }else if(data == 1){
                        $('#replycmts'+commentid).val('');
                        $.ajax({
                            url: "<?php echo base_url('index.php/welcome/pro_commentpost'); ?>",
                            type: 'POST',
                            dataType: 'json',
                            success: function(result) {
                                if(result.response){
                                    var profile_image = "<?php echo $this->session->userdata['logged_in']['profile_image'];?>";
                                    if((profile_image != '') || (profile_image != ' ') || (profile_image != 'undefined')){
                                    }else{ profile_image = '2.png'; }
                                    var htmlcomment ='<div class="box-footer box-comments fscommentdelete'+result.response[0].cid+'" style="padding-bottom:0px;background:#ddd;">'+
    								    '<div class="box-comment"><img class="img-circle" src="<?php echo base_url();?>assets/images/'+profile_image+'" alt="User Image">'+
                                            '<div class="comment-text"><span class="username"> &nbsp;'+result.response[0].name+
                                                '<span class="text-muted pull-right">'+result.response[0].hydhmdatetime+'</span></span><br>'+
                                                '<span class="fsmore '+result.response[0].cid+'" style="word-wrap: break-word;">'+result.response[0].comment+'</span>'+
                                                '<span class="pull-right">'+
                                                    '<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" style="padding: 0px 10px 0px 20px;">'+
                                                     '<i class="fa fa-ellipsis-v"></i> </a> '+
                                                    '<ul class="dropdown-menu writemenu" style="top:auto; width:fit-content;">'+
                                                        '<li><a href="javascript:void(0);" onclick="fseditcomment('+result.response[0].cid+');"><span><i class="fa fa-pencil"></i> Edit</span></a></li>'+
                                                        '<li><a href="javascript:void(0);" onclick="fsdeletecomment('+result.response[0].cid+');"><span><i class="fa fa-trash"></i> Delete</span></a></li>'+
                                                    '</ul>'+
                                                '</span>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>';
                                    $('#fsmysubList'+storyid+'_'+commentid).prepend(htmlcomment);
                                }else{
                                }
                            }
                        })
                    }else{
                        $('#snackbar').text('Failed to Post your Comments.').addClass('show');
    	                setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
                    }
                }
            });
	    }else{
	        $('#snackbar').text('Enter Reply Comment text.').addClass('show');
            setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
	    }
	}
	function fsloadmore(storyid, commentid){
        $('.fsloadmorespan'+storyid).hide();
        $.ajax({
            type:'POST',
            url:"<?php echo base_url();?>index.php/welcome/fsloadcomments",
            data:{'storyid':storyid, 'commentid':commentid},
            success:function(html){
                $('#fsmyList'+storyid).append(html);
            }
        });
    }
    function fsloadsubcomment(storyid, comment_id, subcommentid ){
        $('.fsloadsubcomment'+comment_id).hide();
        $.ajax({
            type:'POST',
            url:"<?php echo base_url();?>index.php/welcome/fsloadsubcomment",
            data:{'storyid':storyid, 'comment_id':comment_id,'subcommentid':subcommentid },
            success:function(html){
                $('#fsmysubList'+storyid+'_'+comment_id).append(html);
            }
        });
    }
</script>
<!-- Feed Story Comments end -->


<script> 
    $(document).ready(function(){ // feed auto scroll
        var limit = 6;
        var start = 6;
        var action = 'inactive';
        function load_country_data(limit, start) {
            $.ajax({
                url:'<?php echo base_url();?>index.php/welcome/loadmorefeed',
                method:"POST",
                data:{limit:limit, start:start},
                cache:false,
                success:function(data){
                    $('#loadmoreall').append(data);
                    if(data == '') {
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
            if($(window).scrollTop() + $(window).height()+3000 > $("#loadmoreall").height() && action == 'inactive'){
                action = 'active';
                start = start + limit;
                setTimeout(function(){load_country_data(limit, start);}, 100);
            }
        });
    });
</script>

<script> 
    $(document).ready(function(){ // yourfeed auto scroll
        var ylimit = 6;
        var ystart = 6;
        var yaction = 'inactive';
        function yload_country_data(ylimit, ystart) {
            $.ajax({
                url:'<?php echo base_url();?>index.php/welcome/loadmoreyourfeed',
                method:"POST",
                data:{limit:ylimit, start:ystart},
                cache:false,
                success:function(data){
                    $('#yloadmoreall').append(data);
                    if(data == '') {
                        $('#yload_data_message').html("<center><div class='col-md-12' style='padding-top:20px;'> No More Results!</div></center>");
                        yaction = 'active';
                    }else{
                        $('#yload_data_message').html("<center><div class='col-md-12' style='padding-top:20px;'> Loading ...</div></center>");
                        yaction = "inactive";
                    }
                }
            });
        }
        if(yaction == 'inactive') {
            yaction = 'active';
            yload_country_data(ylimit, ystart);
        } 
        $(window).scroll(function(){
            if($(window).scrollTop() + $(window).height() + 3000 > $("#yloadmoreall").height() && yaction == 'inactive'){
                yaction = 'active';
                ystart = ystart + ylimit;
                setTimeout(function(){yload_country_data(ylimit, ystart);}, 100);
            }
        });
    });
</script>


<script> 
    $(document).ready(function(){ // Stories feed auto scroll
        var slimit = 6;
        var sstart = 6;
        var saction = 'inactive';
        function sload_country_data(slimit, sstart) {
            $.ajax({
                url:'<?php echo base_url();?>index.php/welcome/loadmorestoryfeed',
                method:"POST",
                data:{limit:slimit, start:sstart},
                cache:false,
                success:function(data){
                    $('#sloadmoreall').append(data);
                    if(data == '') {
                        $('#sload_data_message').html("<center><div class='col-md-12' style='padding-top:20px;'> No More Results!</div></center>");
                        saction = 'active';
                    }else{
                        $('#sload_data_message').html("<center><div class='col-md-12' style='padding-top:20px;'> Loading ...</div></center>");
                        saction = "inactive";
                    }
                }
            });
        }
        if(saction == 'inactive') {
            saction = 'active';
            sload_country_data(slimit, sstart);
        } 
        $(window).scroll(function(){
            if($(window).scrollTop() + $(window).height() + 3000 >= $("#sloadmoreall").height() && saction == 'inactive'){
                saction = 'active';
                sstart = sstart + slimit;
                setTimeout(function(){sload_country_data(slimit, sstart);}, 100);
            }
        });
    });
</script>

