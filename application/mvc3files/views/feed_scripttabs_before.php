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
							<li class=""><a href="#tab_stories" data-toggle="tab">YOUR NETWORK</a></li>
						</ul>
					</div>
						
					<div class="tab-content" style="background:none!important; padding:0px;">
					    
						<div class="tab-pane active" id="tab_feed"><br>
							<?php if(isset($feed) && ($feed->num_rows() > 0)){ ?><div id="loadmoreall"><?php foreach ($feed->result() as $key) { ?>
								<div class="box box-widget" style="background:#fff; border:1px solid #dddddd;margin-bottom: 10px;" id="delcomm<?php echo $key->id;?>">
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
    											        <li><a href="javascript:void(0);" onclick="editcomm_post(<?php echo $key->id;?>, <?php echo $key->user_id;?>)"><i class="fa fa-pencil"></i> EDIT </a></li>
    											        <li><a href="javascript:void(0);" onclick="deletecomm_post(<?php echo $key->id;?>, <?php echo $key->user_id;?>)"><i class="fa fa-trash"></i> DELETE </a></li>
    												<?php }else { ?>
    												    <li><a href="javascript:void(0);" onclick="reportcomm_post(<?php echo $key->id;?>, <?php echo $key->user_id;?>)"><i class="fa fa-exclamation-triangle"></i> REPORT </a></li>
    												<?php } ?>
												</ul>
											</span>
											<span class="username"><a href="<?php echo base_url().$key->profile_name; ?>"><?php echo $key->name;?></a></span>
											<span class="description"><a href="<?php echo base_url().'community/'.$key->gener; ?>">
											    <i style="color:#040cff;"><?php echo $key->gener;?></i></a> - <?php echo get_ydhmdatetime($key->date);?></span>
										</div>
									</div>
									<!-- /.box-header -->
									<?php if(isset($key->type) && ($key->type=='url')) { ?>
										<div class="box-body">
											<?php if(isset($key->urldescription) && !empty($key->urldescription) && (strlen($key->urldescription) > 200)){ ?>
											    <div class="user-block mb-10"><?php echo substr($key->urldescription, 0, 200); ?>
									                <span class="showhidedesc<?php echo $key->id;?>" style="display:none;"><?php echo substr($key->urldescription,200); ?></span>
									                <u onclick="showhidedesc(<?php echo $key->id;?>)" class="smoreless<?php echo $key->id;?>" style="cursor: pointer;">Read More</u></div>
											<?php } else{ ?>
											    <div class="user-block mb-10"> <?php echo $key->urldescription; ?></div>
											<?php } ?>
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
														<p class="media-heading edittext<?php echo $key->id;?>"><?php echo strip_tags($key->story);?></p>
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
											<span class="pl-10"><a data-toggle="modal" data-target="#soc" href="javascript:void(0);"><i class="fa fa-share"></i> Share</a></span>
											<span class="pull-right text-muted" onClick="comments(<?php echo $key->id;?>);">
												<span id="old_like<?php echo $key->id;?>"><?php echo $key->likes; ?></span> <span id="new_like"></span> Likes &nbsp; 
												<span id="old_cmt<?php echo $key->id;?>" style="cursor:pointer"><?php echo get_storycmtcount($key->id);?></span> <span style="cursor:pointer"> Comments</span>
											</span>
										</div>
									<?php } else { ?>
										<div class="box-body">
										    <?php if(isset($key->typeoftype) && ($key->typeoftype == 'quotes')){ ?>
											    <p class="mb-15 sizep text-justify edittext<?php echo $key->id;?>"><?php echo $key->story;?></p>
											<?php } else{ ?>
											    <?php if(isset($key->story) && (strlen($key->story) > 200)){ ?>
    											    <p class="text-justify edittext<?php echo $key->id;?>"><?php echo substr($key->story, 0, 200); ?>
    									                <span class="showhidedesc<?php echo $key->id;?>" style="display:none;"><?php echo substr($key->story,200); ?></span>
    									                <u onclick="showhidedesc(<?php echo $key->id;?>)" class="smoreless<?php echo $key->id;?>" style="cursor: pointer;">Read More</u></p>
    											<?php } else{ ?>
    											    <p class="mb-15 text-justify edittext<?php echo $key->id;?>"><?php echo $key->story;?></p>
    											<?php } ?>
											<?php } ?>
											<?php if(isset($commstory_likes) && in_array($key->id, $commstory_likes)) { ?>
												<button class="btn btn-default btn-xs unlike<?php echo $key->id;?>" onclick="unlikestory(<?php echo $key->id;?>)" style="background:none; color:#337ab7;"><i class="fa fa-thumbs-up"></i> Like</button>
											<?php } else { ?>
												<button class="btn btn-default btn-xs like<?php echo $key->id;?>" onclick="likestory(<?php echo $key->id;?>)" style="background:none;"><i class="fa fa-thumbs-up"></i> Like</button>
											<?php } ?>
											<span class="pl-10"><a data-toggle="modal" data-target="#soc" href="javascript:void(0);"><i class="fa fa-share"></i> Share</a></span>
											<span class="pull-right text-muted" onClick="comments(<?php echo $key->id;?>);">
												<span id="old_like<?php echo $key->id;?>"><?php echo $key->likes; ?></span><span id="new_like"></span> Likes &nbsp; 
												<span id="old_cmt<?php echo $key->id;?>"  style="cursor:pointer"><?php echo get_storycmtcount($key->id);?></span> <span  style="cursor:pointer"> Comments</span>
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
									
									<div class="box-comments ajaxcomment<?php echo $key->id;?>" style="background: #fff;"> </div>
									<?php $comments = get_comments($key->id);
        							    if(isset($comments) && ($comments->num_rows()>0)){ ?>
										<div id="myList<?php echo $key->id;?>" style="display: none;">
											<?php foreach($comments->result() as $comment){ ?>
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
														    <?php if(strlen($comment->comment) > 200){ ?>
														        <div class="more <?php echo $comment->id;?>"><?php echo substr($comment->comment, 0, 200); ?>
														            <span class="showhide<?php echo $comment->id;?>" style="display:none;"><?php echo substr($comment->comment,200); ?></span>
														            <u onclick="showhide(<?php echo $comment->id;?>)" class="moreless<?php echo $comment->id;?>" style="cursor: pointer;">Read More</u></div>
														    <?php } else{ ?>
														        <div class="more <?php echo $comment->id;?>"><?php echo $comment->comment; ?></div>
														    <?php } ?>
															<div style="margin:5px 0;" class="">
                                                                <a href="javascript:void(0);" onClick="postReplycomment(<?php echo $comment->id;?>,<?php echo $comment->comm_id;?>,<?php echo $comment->story_id;?>)" class="pull-left replycv" title="Reply">REPLY</a> <a href="" class="pull-left replycv">I</a> 
                                                                <a href="javascript:void(0);" onClick="displayreplies(<?php echo $comment->id;?>,<?php echo $comment->comm_id;?>,<?php echo $comment->story_id;?>)" class="pull-left replycv" title="Replies"> 
                                                                    <span class="old_subcmtcount<?php echo $comment->id;?>"><?php echo get_subcmtcount($comment->id);?></span> REPLIES</a>
                                                            </div>
														</div><br>
														<div class="comment-text">
														    <div class="input-group postreplycomment<?php echo $comment->id;?>" style="margin-bottom:5px;"><!-- Reply comment form --></div>
														</div>
													</div>
													
													<div class="subcomments" style="display:none;" id="mysubList<?php echo $key->id;?>_<?php echo $comment->id;?>">
    													<?php $subcomments = get_subcomments($key->id, $comment->id); 
    													    if(isset($subcomments) && ($subcomments->num_rows() > 0)){ foreach($subcomments->result() as $subcomment){ ?>
        													<div class="media editdelete<?php echo $subcomment->id;?>" style="padding-left:10px; margin-top:5px;margin-bottom:5px;">
        													    <span class="media-left">
        													        <?php if(isset($subcomment->profile_image) && !empty($subcomment->profile_image)){ ?>
        													        <img class="img-circle" style="width:25px;" src="<?php echo base_url();?>assets/images/<?php echo $subcomment->profile_image;?>" alt="<?php echo ucfirst($subcomment->name);?>">
        													        <?php } else { ?>
        													        <img class="img-circle" style="width:25px;" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo ucfirst($subcomment->name);?>">
        													        <?php } ?>
        													   </span>
        													   <span class="media-body bodycv">
        													        <div class=""><!--username-->
        													            <span class="">&nbsp;<b> <a href="<?php echo base_url().$subcomment->profile_name; ?>"><?php echo ucfirst($subcomment->name);?></a></b>
        													                <span class="dropdown pull-right">
                                                                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" style="padding: 0px 10px 0px 20px;">
                                                                                 <i class="fa fa-ellipsis-v"></i> </a> 
                                                                                <ul class="dropdown-menu pull-right">
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
        													            <?php if(strlen($subcomment->comment) > 200){ ?>
            														        <span class="more <?php echo $subcomment->id;?>" style="padding-left:10px;"><?php echo substr($subcomment->comment, 0, 200); ?>
            														            <span class="showhide<?php echo $subcomment->id;?>" style="display:none;"><?php echo substr($subcomment->comment,200); ?></span>
            														            <u onclick="showhide(<?php echo $subcomment->id;?>)" class="moreless<?php echo $subcomment->id;?>" style="cursor: pointer;">Read More</u></span>
            														    <?php } else{ ?>
            														        <span class="more <?php echo $subcomment->id;?>" style="padding-left:10px;"><?php echo $subcomment->comment;?></span>
            														    <?php } ?>
        													       </div>
        													   </span>
        													</div>
        													<?php } $commlastsubcomment = get_commlastsubcomment($key->id, $comment->id); 
        													    if($subcomment->id > $commlastsubcomment){ ?>
        													<a href="javascript:void(0);"><span class="loadsubcomment<?php echo $comment->id;?>" onClick="commloadsubcomment(<?php echo $key->id;?>, <?php echo $comment->id;?>, <?php echo $subcomment->id;?>)"><center>View More</center></span></a>
        												    <?php } else{ ?>
        												    <span class="loadsubcomment"></span>
            											<?php } } ?>
        											</div>
												</div>
										    <?php } $commlastcomment = get_commlastcomment($key->id); if($comment->id > $commlastcomment){ ?>
									        <a href="javascript:void(0);"><span class="loadmorespan<?php echo $key->id;?>" onClick="commloadmore(<?php echo $key->id;?>, <?php echo $comment->id;?>)"><center>View More</center></span></a>
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
								<div class="box box-widget" style="background:#fff; border:1px solid #dddddd;margin-bottom: 10px;" id="delcomm<?php echo $yourfeed->id;?>"> 
									<div class="box-header with-border">
										<div class="user-block">
											<?php if(isset($yourfeed->profile_image) && !empty($yourfeed->profile_image)) { ?>
												<img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $yourfeed->profile_image;?>" alt="User Image">
											<?php } else { ?>
												<img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="User Image">
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
											<span class="username"><a href="<?php echo base_url().$yourfeed->profile_name; ?>"><?php echo $yourfeed->name;?></a></span>
											<span class="description"><a href="<?php echo base_url().'community/'.$yourfeed->gener; ?>">
											    <i style="color:#040cff;"><?php echo $yourfeed->gener;?></i></a> - <?php echo get_ydhmdatetime($yourfeed->date);?></span>
										</div>
									</div>
									<?php if(($yourfeed->type=='url')) { ?>
										<div class="box-body">
										    <?php if(isset($yourfeed->urldescription) && !empty($yourfeed->urldescription) && (strlen($yourfeed->urldescription) > 200)){ ?>
											    <div class="user-block mb-10"><?php echo substr($yourfeed->urldescription, 0, 200); ?>
									                <span class="showhidedesc<?php echo $yourfeed->id;?>" style="display:none;"><?php echo substr($yourfeed->urldescription,200); ?></span>
									                <u onclick="showhidedesc(<?php echo $yourfeed->id;?>)" class="smoreless<?php echo $yourfeed->id;?>" style="cursor: pointer;">Read More</u></div>
											<?php } else{ ?>
											    <div class="user-block mb-10"> <?php echo $yourfeed->urldescription; ?></div>
											<?php } ?>
											<?php if(!empty($yourfeed->title)){ ?>
												<div class="media border-box" style="margin-top:2px;">
            										<div class="media-left">
														<a href="<?php echo $yourfeed->titleurl;?>" target="_blank">
															<?php if((!empty($yourfeed->image) && ($yourfeed->type == "url"))) { ?>
																<img src="<?php echo $yourfeed->image;?>" class="media-object img-v" alt="Community Story Image">
															<?php }elseif((!empty($yourfeed->image) && ($yourfeed->type != "url"))){ ?>
																<img src="<?php echo base_url();?>assets/images/<?php echo $yourfeed->image;?>" class="media-object img-v" alt="Community Story Image">
															<?php } else { ?>
																<img src="<?php echo base_url();?>assets/images/1.jpg" class="media-object img-v" alt="Community Story Image">
															<?php } ?>
														</a>
													</div>
													<div class="media-body" style="padding-top:15px;">
														<a href="<?php echo $yourfeed->titleurl;?>" target="_blank"> 
															<h4 class="media-heading"><b><?php echo ucfirst($yourfeed->title);?></b></h4>
														</a>
														<p class="media-heading edittext<?php echo $yourfeed->id;?>"><?php echo substr(strip_tags($yourfeed->story),0,150);?>...</p>
													</div>
												</div>
											<?php } else { ?>
												<p class="media-heading edittext<?php echo $yourfeed->id;?>"><?php echo $yourfeed->story;?></p>
											<?php } ?>
										</div>
										<div class="box-body">
											<?php if(isset($commstory_likes) && in_array($yourfeed->id, $commstory_likes)) { ?>
												<button class="btn btn-default btn-xs unlike<?php echo $yourfeed->id;?>" onclick="unlikestory(<?php echo $yourfeed->id;?>)" style="background:none; color:#337ab7;"><i class="fa fa-thumbs-up"></i> Like</button>
											<?php } else { ?>
												<button class="btn btn-default btn-xs like<?php echo $yourfeed->id;?>" onclick="likestory(<?php echo $yourfeed->id;?>)" style="background:none;"><i class="fa fa-thumbs-up"></i> Like</button>
											<?php } ?>
											<span class="pl-10"><a data-toggle="modal" data-target="#soc" href="javascript:void(0);"><i class="fa fa-share"></i> Share</a></span>	
											<span class="pull-right text-muted" onClick="tcomments(<?php echo $yourfeed->id;?>);">
												<span id="told_like<?php echo $yourfeed->id;?>"><?php echo $yourfeed->likes; ?></span> <span id="tnew_like"></span> Likes &nbsp; 
											    <span id="told_cmt<?php echo $yourfeed->id;?>"  style="cursor:pointer"><?php echo get_storycmtcount($yourfeed->id);?></span> <span  style="cursor:pointer">Comments</span>
											</span>
										</div>
									<?php } else { ?>
										<div class="box-body">
										    <?php if(isset($yourfeed->typeoftype) && ($yourfeed->typeoftype == 'quotes')){ ?>
											    <p class="text-justify sizep edittext<?php echo $yourfeed->id;?>"><?php echo $yourfeed->story;?></p>
											<?php } else{ ?>
    											<?php if(isset($yourfeed->story) && (strlen($yourfeed->story) > 200)){ ?>
    											    <p class="text-justify edittext<?php echo $yourfeed->id;?>"><?php echo substr($yourfeed->story, 0, 200); ?>
    									                <span class="showhidedesc<?php echo $yourfeed->id;?>" style="display:none;"><?php echo substr($yourfeed->story,200); ?></span>
    									                <u onclick="showhidedesc(<?php echo $yourfeed->id;?>)" class="smoreless<?php echo $yourfeed->id;?>" style="cursor: pointer;">Read More</u></p>
    											<?php } else{ ?>
    											    <p class="text-justify edittext<?php echo $yourfeed->id;?>"><?php echo $yourfeed->story;?></p>
    											<?php } ?>
											<?php } ?>
											<?php if(isset($commstory_likes) && in_array($yourfeed->id, $commstory_likes)) { ?>
												<button class="btn btn-default btn-xs unlike<?php echo $yourfeed->id;?>" onclick="unlikestory(<?php echo $yourfeed->id;?>)" style="background:none; color:#337ab7;"><i class="fa fa-thumbs-up"></i> Like</button>
											<?php } else { ?>
												<button class="btn btn-default btn-xs like<?php echo $yourfeed->id;?>" onclick="likestory(<?php echo $yourfeed->id;?>)" style="background:none;"><i class="fa fa-thumbs-up"></i> Like</button>
											<?php } ?>
											<span class="pl-10"><a data-toggle="modal" data-target="#soc" href="javascript:void(0);"><i class="fa fa-share"></i> Share</a></span>	
											<span class="pull-right text-muted" onClick="tcomments(<?php echo $yourfeed->id;?>);">
												<span id="old_like<?php echo $yourfeed->id;?>"><?php echo $yourfeed->likes; ?></span><span id="new_like"></span> Likes &nbsp; 
												<span id="told_cmt<?php echo $yourfeed->id;?>" style="cursor:pointer"><?php echo get_storycmtcount($yourfeed->id);?></span> <span style="cursor:pointer">Comments</span>
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
															<div class="comment-text">
    															<span class="username" style="padding-top:6px;">&nbsp; <b><a href="<?php echo base_url().$ycomment->profile_name; ?>"><?php echo ucfirst($ycomment->name);?></a></b>
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
                											<div style="margin:8px 0 6px 2px" class="comment-text">
    															<?php if(strlen($ycomment->comment) > 200){ ?>
    														        <div style="word-break:break-word;" class="more pcomment<?php echo $ycomment->id;?>"><?php echo substr($ycomment->comment, 0, 200); ?>
    														            <span class="showhide<?php echo $ycomment->id;?>" style="display:none;"><?php echo substr($ycomment->comment,200); ?></span>
    														            <u onclick="showhide(<?php echo $ycomment->id;?>)" class="moreless<?php echo $ycomment->id;?>" style="cursor: pointer;">Read More</u></div>
    														    <?php } else{ ?>
    														        <div style="word-break:break-word;" class="more pcomment<?php echo $ycomment->id;?>"><?php echo $ycomment->comment;?></div>
    														    <?php } ?>
    															<div style="" class="">
                                                                    <a href="javascript:void(0);" onClick="toppostReplycomment(<?php echo $ycomment->id;?>,<?php echo $ycomment->comm_id;?>,<?php echo $ycomment->story_id;?>)" class="pull-left replycv" title="Reply">REPLY</a> <a href="" class="pull-left replycv">I</a>
                                                                    <a href="javascript:void(0);" onClick="toppostdisplayreplies(<?php echo $ycomment->id;?>,<?php echo $ycomment->comm_id;?>,<?php echo $ycomment->story_id;?>)" class="pull-left replycv" title="Replies"> 
                                                                        <span class="told_subcmtcount<?php echo $ycomment->id;?>"><?php echo get_subcmtcount($ycomment->id);?></span> REPLIES</a>
                                                                </div>
			                                                </div>
			                                                <div class="comment-text">
                                                                <div class="input-group toppostreplycomment<?php echo $ycomment->id;?>" style="width:100%; margin-bottom:5px;"><!-- Reply comment form --></div>
    														</div>
														</div>
    													<div class="topsubcomments" style="display:none;" id="topmysubList<?php echo $yourfeed->id;?>_<?php echo $ycomment->id;?>">
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
        													            <div class="">
            													            <span class=""><b><a href="<?php echo base_url().$topsubcomment->profile_name; ?>"><?php echo ucfirst($topsubcomment->name);?></a></b><span class="dropdown" style="float:right;">
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
            													            </span><br>
            													            <?php if(strlen($topsubcomment->comment) > 200){ ?>
                														        <span class="more pcomment<?php echo $topsubcomment->id;?>" style="padding-left: 6px;word-break:break-word;"><?php echo substr($topsubcomment->comment, 0, 200); ?>
                														            <span class="showhide<?php echo $topsubcomment->id;?>" style="display:none;"><?php echo substr($topsubcomment->comment,200); ?></span>
                														            <u onclick="showhide(<?php echo $topsubcomment->id;?>)" class="moreless<?php echo $topsubcomment->id;?>" style="cursor: pointer;">Read More</u></span>
                														    <?php } else{ ?>
                														        <span class="more pcomment<?php echo $topsubcomment->id;?>" style="padding-left: 6px;word-break:break-word;"><?php echo $topsubcomment->comment;?></span>
                														    <?php } ?>
        													            </div>
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
													    <a href="javascript:void(0);" onClick="reportstories(<?php echo $storyfeed->user_id;?>,<?php echo $storyfeed->sid;?>);"><i class="fa fa-exclamation-triangle"></i> REPORT </a>
													    <?php }else { ?>
													    <a href="javascript:void(0);" onClick="reportseries(<?php echo $storyfeed->user_id;?>,<?php echo $storyfeed->sid;?>)"><i class="fa fa-exclamation-triangle"></i> REPORT </a>
													    <?php } ?>
												    </li>
												</ul>
											</span>
											<span class="username"><a href="<?php echo base_url().$storyfeed->profile_name; ?>"><?php echo $storyfeed->name;?></a></span>
											<span class="description"><a href="<?php echo base_url().'community/'.$storyfeed->gener; ?>">
											    <i style="color:#040cff;"><?php echo $storyfeed->gener;?></i></a> - <?php echo get_ydhmdatetime($storyfeed->created_at);?></span>
										</div>
									</div>
									<div class="box-body">
										<div class="media border-box" style="margin-top:2px;">
											<div class="media-left">
                                    		    <?php $hrefurl = "#"; $uriseg = get_langshortname($this->uri->segment(1)); if($storyfeed->type == 'story'){
                                    		        //$hrefurl = base_url().'welcome/only_story_view?id='.$storyfeed->sid;
                                    		        if(isset($uriseg) && !empty($uriseg) && ($uriseg != 'en')){
                                    		            $hrefurl = base_url().$this->uri->segment(1).'/story/'.preg_replace('/\s+/', '-', $storyfeed->title).'-'.$storyfeed->sid;
                                    		        }else{
                                    		            $hrefurl = base_url().'story/'.preg_replace('/\s+/', '-', $storyfeed->title).'-'.$storyfeed->sid;
                                    		        }
                                    		    }elseif($storyfeed->type == 'series'){
                                    		        //$hrefurl = base_url().'welcome/new_series?id='.$storyfeed->story_id.'&story_id='.$storyfeed->sid;
                                    		        if(isset($uriseg) && !empty($uriseg) && ($uriseg != 'en')){
                                    		            $hrefurl = base_url().$this->uri->segment(1).'/series/'.preg_replace('/\s+/', '-', $storyfeed->title).'-'.$storyfeed->sid.'/'.preg_replace('/\s+/', '-', $storyfeed->title).'-'.$storyfeed->story_id;
                                    		        }else{
                                    		            $hrefurl = base_url().'series/'.preg_replace('/\s+/', '-', $storyfeed->title).'-'.$storyfeed->sid.'/'.preg_replace('/\s+/', '-', $storyfeed->title).'-'.$storyfeed->story_id;
                                    		        }
                                    		    } ?>
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
												<p class="media-heading  edittext<?php echo $storyfeed->sid;?>"><?php echo strip_tags($storyfeed->story); ?></p>
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
									
									<div class="box-comments fsajaxcomment<?php echo $storyfeed->sid;?>" style="background: #fff;"> </div>
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
														<span class="username" style="padding-top:6px;">&nbsp; <a href="<?php echo base_url().$fscomment->profile_name; ?>"><?php echo ucfirst($fscomment->name);?></a>
															<span class="dropdown" style="float:right;">
                                                                <a href="javascript:void(0);" class="dropdown-toggle elli" data-toggle="dropdown" aria-expanded="true">
                                                                    <i class="fa fa-ellipsis-v"></i> </a> 
                                                                <ul class="dropdown-menu pull-right">
                                                                    <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($fscomment->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
                                                                    <li><a href="javascript:void(0);" onClick="fseditcomment(<?php echo $fscomment->cid;?>);"><span><i class="fa fa-pencil"></i> EDIT</span></a></li>
                                                                    <li><a href="javascript:void(0);" onClick="fsdeletecomment(<?php echo $fscomment->cid;?>);"><span><i class="fa fa-trash"></i> DELETE</span></a></li>
                                                                    <?php } else{ ?>
                                                                    <li><a href="javascript:void(0);" onClick="fsreportcomment(<?php echo $fscomment->cid;?>,<?php echo $fscomment->user_id;?>);"><span><i class="fa fa-exclamation-triangle"></i> REPORT</span></a></li>
                                                                    <?php } ?>
                                                                </ul>
                                                            </span>
                                                            <span class="text-muted pull-right datecv"><?php echo get_ydhmdatetime($fscomment->date);?></span>
                                                        </span>
                                                    </div>
                                                    <div style="margin:8px 0 6px 2px" class="comment-text">
                                                        <?php if(strlen($fscomment->comment) > 200){ ?>
													        <div class="fsmore <?php echo $fscomment->cid;?>" style="word-wrap: break-word;"><?php echo substr($fscomment->comment, 0, 200); ?>
													            <span class="showhide<?php echo $fscomment->id;?>" style="display:none;"><?php echo substr($fscomment->comment,200); ?></span>
													            <u onclick="showhide(<?php echo $fscomment->id;?>)" class="moreless<?php echo $fscomment->id;?>" style="cursor: pointer;">Read More</u></div>
													    <?php } else{ ?>
													        <div class="fsmore <?php echo $fscomment->cid;?>" style="word-wrap: break-word;"><?php echo $fscomment->comment; ?></div>
													    <?php } ?>
            											<div style="margin:5px 0;" class="">
                                                            <a href="javascript:void(0);" onClick="fspostReplycomment(<?php echo $fscomment->cid;?>,<?php echo $fscomment->story_id;?>)" class="pull-left replycv" title="Reply">REPLY</a> <a href="" class="pull-left replycv">I</a>
                                                            <a href="javascript:void(0);" onClick="fsdisplayreplies(<?php echo $fscomment->cid;?>,<?php echo $fscomment->story_id;?>)" class="pull-left replycv" title="Replies"> 
                                                                <span class="fsold_subcmtcount<?php echo $fscomment->cid;?>"><?php echo get_storysubcmtcount($fscomment->cid, $fscomment->story_id); ?></span> REPLIES</a>
                                                        </div>
            										</div><br>
            										<div class="comment-text">
            										    <div class="input-group fspostreplycomment<?php echo $fscomment->cid;?>" style="margin-bottom:5px;"><!-- Reply comment form --></div>
            										</div>
												</div>
												
												<div class="subcomments" style="display:none;" id="fsmysubList<?php echo $storyfeed->sid;?>_<?php echo $fscomment->cid;?>">
													<?php $fssubcomments = get_replaycomments($fscomment->story_id, $fscomment->cid, 2); 
													    if(isset($fssubcomments) && ($fssubcomments->num_rows() > 0)){ foreach($fssubcomments->result() as $fssubcomment){ ?>
    													<div class="media fscommentdelete<?php echo $fssubcomment->cid;?>" style="padding-bottom:0px;margin-bottom:10px;">
    													    <span class="media-left">
    													        <?php if(isset($fssubcomment->profile_image) && !empty($fssubcomment->profile_image)){ ?>
    													        <img class="img-circle" style="width:25px;" src="<?php echo base_url();?>assets/images/<?php echo $fssubcomment->profile_image;?>">
    													        <?php } else { ?>
    													        <img class="img-circle" style="width:25px;" src="<?php echo base_url();?>assets/images/2.png" alt="User Image">
    													        <?php } ?>
    										                </span>
													        <span class="media-body bodycv">
    													        <div class=""><!--username-->
    													            <span class="">&nbsp; <a href="<?php echo base_url().$fssubcomment->profile_name; ?>"><?php echo ucfirst($fssubcomment->name);?></a>
    													                <span class="dropdown pull-right">
                                                                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" style="padding: 0px 10px 0px 20px;">
                                                                             <i class="fa fa-ellipsis-v"></i> </a> 
                                                                            <ul class="dropdown-menu pull-right">
        													                    <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($fssubcomment->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
                                                                                <li><a href="javascript:void(0);" onClick="fseditcomment(<?php echo $fssubcomment->cid;?>);"><span><i class="fa fa-pencil"></i> EDIT</span></a></li>
                                                                                <li><a href="javascript:void(0);" onClick="fsdeletecomment(<?php echo $fssubcomment->cid;?>);"><span><i class="fa fa-trash"></i> DELETE</span></a></li>
                                                                                <?php } else{ ?>
                                                                                <li><a href="javascript:void(0);" onClick="fsreportcomment(<?php echo $fssubcomment->cid;?>, <?php echo $fssubcomment->user_id;?>);"><span><i class="fa fa-exclamation-triangle"></i> REPORT</span></a></li>
                                                                                <?php } ?>
                                                                            </ul>
                                                                        </span>
                                                                        <span class="text-muted pull-right datecv"><?php echo get_ydhmdatetime($fssubcomment->date);?></span>
                                                                    </span><br>
                                                                    <?php if(strlen($fssubcomment->comment) > 200){ ?>
            													        <span class="fsmore <?php echo $fssubcomment->cid;?>" style="word-wrap: break-word;padding-left:10px;"><?php echo substr($fssubcomment->comment, 0, 200); ?>
            													            <span class="showhide<?php echo $fssubcomment->id;?>" style="display:none;"><?php echo substr($fssubcomment->comment,200); ?></span>
            													            <u onclick="showhide(<?php echo $fssubcomment->id;?>)" class="moreless<?php echo $fssubcomment->id;?>" style="cursor: pointer;">Read More</u></span>
            													    <?php } else{ ?>
            													        <span class="fsmore <?php echo $fssubcomment->cid;?>" style="word-wrap: break-word;padding-left:10px;"><?php echo $fssubcomment->comment;?></span>
            													    <?php } ?>
                                                                </div>
                                                            </span>
    													 </div>
    													<?php } $fslastsubcomment = get_fslastsubcomment($storyfeed->sid, $fscomment->cid); 
    													    if($fssubcomment->cid > $fslastsubcomment){ ?>
    													<a href="javascript:void(0);"><span class="fsloadsubcomment<?php echo $fscomment->cid;?>" onClick="fsloadsubcomment(<?php echo $storyfeed->sid;?>, <?php echo $fscomment->cid;?>, <?php echo $fssubcomment->cid;?>)"><center>View More</center></span></a>
    												    <?php } else{ ?>
    												    <span class="fsloadsubcomment"></span>
        											<?php } } ?>
    											</div>
											</div>
									    <?php } $fslastcomment = get_fslastcomment($storyfeed->sid); if($fscomment->cid > $fslastcomment){ ?>
								        <a href="javascript:void(0);"><span class="fsloadmorespan<?php echo $storyfeed->sid;?>" onClick="fsloadmore(<?php echo $storyfeed->sid;?>, <?php echo $fscomment->cid;?>)"><center>View More</center></span></a>
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
							<p><b>JOINED COMMUNITIES <span class="pull-right"><a href="<?php echo base_url('communities');?>">More</a></span>
							</b></p>
						</div><br>
						<?php $j = 0; if(isset($get_communities_all) && !empty($get_communities_all)){
						foreach($get_communities_all->result() as $row) { if((in_array($row->id, $join_comm)) && ($j < 15)) { ?>
							<div class="row pt-0">
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
						<?php $j++; } } } ?>
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
.pd-5v {
    margin: 5px 0;
}
span a{
    color:#333;
}
</style>


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
                <button type="button" class="close" data-dismiss="modal" style="margin-top:4px;">&times;</button>
                <h4 class="modal-title">Report The Post</h4>
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
<div class="modal fade" id="reportstories" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
		    <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" style="margin-top:4px;">&times;</button>
				<h4 class="modal-title">Report Story</h4>
			</div>
			<div class="modal-body">
    		    <input type="hidden" id="reportuserid">
    		    <input type="hidden" id="reportstoryid">
    		    <input type="hidden" id="reportstorytype" value="story">
    		    <textarea id="reportmsg" class="form-control"  style="resize:none;"></textarea> <br>
    		    <center><button class="btn btn-danger" Onclick="reportstoriesdiv();"> Report </button></center>
            </div>
		</div>
	</div>
</div>
<!--report stories popup end ------------->
<!-- comment update popup code ------>
<div class="modal fade" id="commentedit" role="dialog" aria-hidden="true">
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
<div class="modal fade" id="reportcomment" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" style="margin-top:4px;">&times;</button>
                <h4 class="modal-title">Report The Comment</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="reportcommentid">
                <input type="hidden" id="reportcommentuserid">
                <textarea class="form-control" id="reportcmtmsg" placeholder ="Enter your Report Comments" style="resize:none;"></textarea>
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
		url:'<?php echo base_url();?>welcome/comm_likes',
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
		url:'<?php echo base_url();?>welcome/comm_likes',
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
		url:'<?php echo base_url();?>welcome/comm_likes',
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
		url:'<?php echo base_url();?>welcome/comm_likes',
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
    var x = confirm("Are you sure you want to delete the Story?");
    if (x) {
    	$.ajax({
    		url:'<?php echo base_url();?>welcome/deletecomm_post',
    		method: 'POST',
    		data: {'comm_story_id':comm_story_id, 'posted_by':posted_by},
    		dataType:'json',
    		success:function(data){
    			if(data) {
    				$('#delcomm'+comm_story_id).css('display', 'none');
               }
            } 
        });
    }else{
        return false;
    }
}
function editcomm_post(comm_story_id, posted_by){
    $('#editcomm_post').modal('show');
	$.ajax({
		url:'<?php echo base_url();?>welcome/editcomm_post',
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
function comments(story_id){
    $('#myList'+story_id).css('display','block');
}
function displayreplies(commentid, comm_id, story_id){
    $('#mysubList'+story_id+'_'+commentid).css('display','block');
}
function comm_comments(story_id){ //Comments post submit
	var inputdata = $('#community_commentpost'+story_id+' :input').serialize();
	var old_cmtcount = $('#old_cmt'+story_id).text();
	$.post("<?php echo base_url();?>welcome/communities_comments",inputdata,function(resultdata, status) {
		var result=JSON.parse(resultdata);
		if(result.status == -1){
			alert('Please Enter Comments Message.');
		}else if(result.status == 1){
		    //console.log(result);
			$("#community_commentpost"+story_id).find('input[name="comment" ]').val('');
			$('.ajaxcomment'+story_id).css('display','block');
			$('.ajaxcomment'+story_id).prepend('<div class="box-footer box-comment" style="padding-bottom:0px;">'+
		        '<img class="img-circle" src="<?php echo base_url();?>assets/images/'+result.response.profile_image+'" alt="'+result.response.name+'">'+
		        '<div class="comment-text"><span class="username" style="padding-top:6px;">&nbsp; '+result.response.name+
			    '<span class="dropdown pull-right">'+
                    '<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" style="padding: 0px 10px 0px 20px;">'+
                     '<i class="fa fa-ellipsis-v"></i> </a> '+
                    '<ul class="dropdown-menu pull-right">'+
                        '<li><a href="javascript:void(0);" onclick="editcommcomment('+result.response.id+');"><span><i class="fa fa-pencil"></i> EDIT</span></a></li>'+
                        '<li><a href="javascript:void(0);" onclick="deletecommcomment('+result.response.id+');"><span><i class="fa fa-trash"></i> DELETE</span></a></li>'+
                    '</ul>'+
                    '</span>'+
    		        '<span class="text-muted pull-right" style="font-weight:300; font-size:0.9em;">1 minute ago</span></span></div>'+
    	            '<div style="margin:8px 0 6px 2px" class="comment-text"><div class="more '+result.response.id+'">'+result.response.comment+'</div>'+
    	            
                    '<div style="margin:5px 0;" class=""><a href="javascript:void(0);" style="padding-right:8px; font-size:0.8em; color:red" onclick="postReplycomment('+result.response.id+','+result.response.comm_id+','+result.response.story_id+')" class="pull-left" title="Reply">REPLY</a> <a href="" class="pull-left replycv">I</a>'+
                    '<a href="javascript:void(0);" style="font-size:0.8em;color:red;" onClick="displayreplies('+result.response.id+','+result.response.comm_id+','+result.response.story_id+')" class="pull-left" title="Reply"><span class="old_subcmtcount'+result.response.id+'">0</span> REPLIES</a></div></div><br>'+
                    '<div class="comment-text"><div class="input-group postreplycomment'+result.response.id+'" style="margin-bottom:5px;"></div></div>'+
    		        
    		    '</div>'+'<div class="subcomments" style="margin-left:10px;" id="mysubList'+result.response.story_id+'_'+result.response.id+'"></div>');
    		    $('#old_cmt'+story_id).html(parseInt(old_cmtcount)+1);
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
	var topoldcmtcount = $('#told_cmt'+story_id).text();
	$.post("<?php echo base_url();?>welcome/communities_comments",inputdata,function(resultdata, status) {
		var result=JSON.parse(resultdata);
		if(result.status == -1){
			alert('Please Enter Comments Message.');
		}else if(result.status == 1){
			$("#tpostscommunity_commentpost"+story_id).find('input[name="tcomment" ]').val('');
			$('.tajaxcomment'+story_id).css('display','block');
			var profile_image = '<?php echo $this->session->userdata['logged_in']['profile_image']; ?>';
			if((profile_image != '') || (profile_image != ' ') || (profile_image != 'undefined')){ }else{ profile_image = '2.png'; }
			
			var yourfeedcommenthtml = '<div class="box-footer box-comment editdelete'+result.response.id+'" style="padding-bottom:0px;">'+
			    '<img class="img-circle" src="<?php echo base_url();?>assets/images/'+profile_image+'" alt="'+result.response.name+'">'+
			        '<div class="comment-text"><div class="comment-text"><span class="username" style="padding-top:6px;">&nbsp; <b>'+result.response.name+'</b>'+
			            '<span class="dropdown" style="float:right;">'+
                            '<a href="javascript:void(0);" class="dropdown-toggle elli" data-toggle="dropdown" aria-expanded="true">'+
                              '<i class="fa fa-ellipsis-v"></i> </a> '+
                            '<ul class="dropdown-menu pull-right">'+
                                '<li><a href="javascript:void(0);" onclick="editcommcomment('+result.response.id+');"><span><i class="fa fa-pencil"></i> EDIT</span></a></li>'+
                                '<li><a href="javascript:void(0);" onclick="deletecommcomment('+result.response.id+');"><span><i class="fa fa-trash"></i> DELETE</span></a></li>'+
                            '</ul>'+
                        '</span><span class="text-muted pull-right datecv">1 minutes ago</span></div>'+
                        '<div style="margin:8px 0 6px 2px" class="comment-text">'+
                            '<div style="word-break:break-word;" class="more pcomment'+result.response.id+'">'+result.response.comment+'</div>'+
								'<div style="margin:5px 0;" class="">'+
                                    '<a href="javascript:void(0);" onclick="toppostReplycomment('+result.response.id+','+result.response.comm_id+','+result.response.story_id+')" class="pull-left replycv" title="Reply">REPLY</a> <a href="" class="pull-left replycv">I</a>'+
                                    '<a href="javascript:void(0);" onclick="toppostdisplayreplies('+result.response.id+','+result.response.comm_id+','+result.response.story_id+')" class="pull-left replycv" title="Replies">'+
                                        '<span class="told_subcmtcount'+result.response.id+'">0</span> REPLIES</a>'+
                                '</div></div><br><div class="comment-text">'+
                                '<div class="input-group toppostreplycomment'+result.response.id+'" style="margin-bottom:5px;"></div>'+
						'</div>'+
        		'<div class="topsubcomments" id="topmysubList'+result.response.story_id+'_'+result.response.id+'"></div>';
			$('.tajaxcomment'+story_id).prepend(yourfeedcommenthtml);
			$('#told_cmt'+story_id).text(parseInt(topoldcmtcount)+1);
		}else{
			alert('Failed to Post Comment.');
		}
	});
}
</script>
<script>
function commujoin(comm_id, gener) { // community join button 
    $.ajax({
		type :'POST',
		url :'<?php echo base_url(); ?>welcome/communities_join',
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
		url :'<?php echo base_url(); ?>welcome/communities_join',
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
		$.post("<?php echo base_url();?>welcome/updatecomm_post",$("form#updatecomm_post").serialize(),function(resultdata, status) {
			$('span.text-danger').empty();
			var result=JSON.parse(resultdata);
			console.log(result);
			if(result.status == -1){
				$.each(result.validations,function (p,q){
					$('span.'+p).text(q);
				});
			}else if((result.status == 1) && (result.response == 'success')){
			    if(pquotes == 'quotes'){
			        $('.edittext'+ptextid).html(ptext);
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
		$.post("<?php echo base_url();?>welcome/reportcomm_post",$("form#reportcommpost").serialize(),function(resultdata, status) {
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
	    $('#mysubList'+story_id+'_'+commentid).css('display','block');
	}
	function addreplycomment(commentid, comm_id, story_id){
	    var comments = $('#replycmts'+commentid).val();
	    var old_cmtcount = $('#old_cmt'+story_id).text();
	    var old_subcmtcount = $('.old_subcmtcount'+commentid).text();
	    if(comments){
	        $.ajax({
        		url:'<?php echo base_url();?>welcome/communities_comments',
        		method: 'POST',
        		data: {'comment_id': commentid, 'comm_id': comm_id, 'story_id': story_id,'comment':comments},
        		dataType: "json",
        		success:function(data){
                    $('#replycmts'+commentid).val('');
        		    if(data.status == 2){
                        $('.addreplaycmt'+commentid).text('Enter your Comments.');
                    }else if(data.status == 1){
                        $.ajax({
                            url: "<?php echo base_url('welcome/communities_commentslast'); ?>",
                            type: 'POST',
                            dataType: 'json',
                            success: function(result) {
                                if(result.response){
                                    var profile_image = result.response[0].profile_image;
                                    if((profile_image != '') || (profile_image != ' ') || (profile_image != 'undefined')){
                                    }else{ profile_image = '2.png'; }
                                    var htmlcomment ='<div class="media editdelete'+result.response[0].id+'" style="padding-left:10px;margin-top:5px;margin-bottom:5px;">'+
									    '<span class="media-left"><img class="img-circle" src="<?php echo base_url();?>assets/images/'+profile_image+'" alt="'+result.response[0].name+'" style="width:25px;"></span>'+
                                            '<span class="media-body bodycv"><span class="username"> &nbsp;'+result.response[0].name+
                                                '<span class="dropdown" style="float:right;">'+
                                                    '<a href="javascript:void(0);" class="dropdown-toggle elli" data-toggle="dropdown" aria-expanded="true">'+
                                                     '<i class="fa fa-ellipsis-v"></i></a> '+
                                                    '<ul class="dropdown-menu pull-right">'+
                                                        '<li><a href="javascript:void(0);" onclick="editcommcomment('+result.response[0].id+');"><span><i class="fa fa-pencil"></i> EDIT</span></a></li>'+
                                                        '<li><a href="javascript:void(0);" onclick="deletecommcomment('+result.response[0].id+');"><span><i class="fa fa-trash"></i> DELETE</span></a></li>'+
                                                    '</ul>'+
                                                '</span>'+
                                                '<span class="text-muted pull-right datecv">1 minute ago</span></span>'+
                                                '<span class="more '+result.response[0].id+'" style="padding-left:10px; word-break:break-word;">'+result.response[0].comment+'</span>'+
                                                
                                            '</span>'+
                                        //'</div>'+
                                    '</div>';
                                    $('#mysubList'+result.response[0].story_id+'_'+result.response[0].comment_id).prepend(htmlcomment);
                                    $('#old_cmt'+story_id).html(parseInt(old_cmtcount)+1);
                                    $('.old_subcmtcount'+commentid).html(parseInt(old_subcmtcount)+1);
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
            url:"<?php echo base_url();?>welcome/commloadcomments",
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
            url:"<?php echo base_url();?>welcome/commloadsubcomments",
            data:{'storyid':storyid, 'comment_id':comment_id,'subcommentid':subcommentid },
            success:function(html){
                $('#mysubList'+storyid+'_'+comment_id).append(html);
            }
        });
    }
    function deletecommcomment(commentid){
        var x = confirm("Are you sure you want to delete the Comment?");
        if (x) {
            $.ajax({
                type:'POST',
                url:"<?php echo base_url();?>welcome/deletecommcomment",
                data:{'commentid':commentid},
                success:function(response){
                    if(response){
                        var result = jQuery.parseJSON(response);
                        $('#old_cmt'+result.story_id).text(result.delcmtcount);
                        $('.old_subcmtcount'+result.comment_id).text(result.delsubcmtcount);
                        $('.editdelete'+commentid).css('display','none');
                        $('#snackbar').text('Comment Deleted Successfully.').addClass('show');
        	            setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
        	            $('#told_cmt'+result.story_id).text(result.delcmtcount);
                        $('.told_subcmtcount'+result.comment_id).text(result.delsubcmtcount);
                    }else{
                        $('#snackbar').text('Failed to Delete Comment.').addClass('show');
        	            setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
                    }
                }
                /*success:function(response){
                    if(response == 1){
                        $('.editdelete'+commentid).css('display','none');
                        $('#snackbar').text('Comment Deleted Successfully.').addClass('show');
        	            setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
                    }else{
                        $('#snackbar').text('Failed to Delete Comment.').addClass('show');
        	            setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
                    }
                }*/
            });
        }else{
            return false;
        }
    }
    function editcommcomment(commentid){
        $.ajax({
            type:'POST',
            url:"<?php echo base_url();?>welcome/editcommcomment",
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
            url:"<?php echo base_url();?>welcome/updatecommcomment",
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
    		url:'<?php echo base_url();?>welcome/reportcommcomment',
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
	
	    $('#topmysubList'+story_id+'_'+commentid).css('display','block');
    }
    function toppostdisplayreplies(commentid, comm_id, story_id){
        $('#topmysubList'+story_id+'_'+commentid).css('display','block');
    }
	function topaddreplycomment(commentid, comm_id, story_id){
	    var comments = $('#topreplycmts'+commentid).val();
	    var topsubcmtcount = $('.told_subcmtcount'+commentid).text();
	    var topoldcmtcount = $('#told_cmt'+story_id).text();
	    if(comments){
	        $.ajax({
        		url:'<?php echo base_url();?>welcome/communities_comments',
        		method: 'POST',
        		data: {'comment_id': commentid, 'comm_id': comm_id, 'story_id': story_id,'comment':comments},
        		dataType: "json",
        		success:function(data){
                    $('#topreplycmts'+commentid).val('');
        		    if(data.status == 2){
                        $('.topaddreplaycmt'+commentid).text('Enter your Comments.');
                    }else if(data.status == 1){
                        $.ajax({
                            url: "<?php echo base_url('welcome/communities_commentslast'); ?>",
                            type: 'POST',
                            dataType: 'json',
                            success: function(result) {
                                if(result.response){
                                    var profile_image = result.response[0].profile_image;
                                    if((profile_image != '') || (profile_image != ' ') || (profile_image != 'undefined')){
                                    }else{ profile_image = '2.png'; }
                                    var yourfeedsubcommenthtml = '<div class="media editdelete'+result.response[0].id+'" style="padding-left:10px;margin-top:5px;margin-bottom:5px;">'+
                                        '<span class="media-left"><img class="img-circle" style="width:25px;" src="<?php echo base_url();?>assets/images/'+profile_image+'"></span>'+
        									' <span class="media-body bodycv"><div class=""><span class="">&nbsp; <b>'+result.response[0].name+'</b>'+
                                            '<span class="dropdown" style="float:right;">'+
                                                '<a href="javascript:void(0);" class="dropdown-toggle elli" data-toggle="dropdown" aria-expanded="true" style="padding: 0px 10px 0px 20px;">'+
                                                  '<i class="fa fa-ellipsis-v"></i> </a> '+
                                                    '<ul class="dropdown-menu pull-right">'+
                                                        '<li><a href="javascript:void(0);" onclick="editcommcomment('+result.response[0].id+');"><span><i class="fa fa-pencil"></i> EDIT</span></a></li>'+
                                                        '<li><a href="javascript:void(0);" onclick="deletecommcomment('+result.response[0].id+');"><span><i class="fa fa-trash"></i> DELETE</span></a></li>'+
                                                    '</ul>'+
                                                '</span><span class="text-muted pull-right datecv">1 Minute ago</span> </span><br>'+
                                            '<span class="more '+result.response[0].id+'">'+result.response[0].comment+'</span>'+
        									'</div>'+
        								'</span></div>';
                                    $('#topmysubList'+story_id+'_'+commentid).prepend(yourfeedsubcommenthtml);
                                    $('.told_subcmtcount'+commentid).text(parseInt(topsubcmtcount)+1);
                                    $('#told_cmt'+story_id).text(parseInt(topoldcmtcount)+1);
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
	function tcomments(story_id){
        $('#topmyList'+story_id).css('display','block');
    }
    function topcommloadmore(storyid, commentid){
        $('.toploadmorespan'+storyid).hide();
        $.ajax({
            type:'POST',
            url:"<?php echo base_url();?>welcome/commloadcomments/topstory",
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
            url:"<?php echo base_url();?>welcome/commloadsubcomments/topstory",
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
		$.post("<?php echo base_url();?>welcome/fscomment",{'comment':comment,'storyid':sid},function(resultdata, status) {
			var result=JSON.parse(resultdata);
			if(result.status == -1){
				$('#snackbar').text('Please enter Comments Message.').addClass('show');
    	        setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
			}else if(result.status == 1){
				$('#fscomment'+sid).val('');
				$('.fsajaxcomment'+sid).css('display','block');
				var profile_image = '<?php echo $this->session->userdata['logged_in']['profile_image']; ?>';
				if(profile_image){  }else{  profile_image = '2.png'; }
				$('.fsajaxcomment'+sid).prepend('<div class="box-footer box-comments fscommentdelete'+result.response.cid+'">'+
    		        '<div class="box-comment"><img class="img-circle" src="<?php echo base_url();?>assets/images/'+profile_image+'" alt="'+result.response.name+'">'+
    			    '<div class="comment-text"><span class="username"> &nbsp;'+result.response.name+'<span class="dropdown" style="float:right;">'+
                        '<a href="javascript:void(0);" class="dropdown-toggle elli" data-toggle="dropdown" aria-expanded="true">'+
                          '<i class="fa fa-ellipsis-v"></i> </a> '+
                            '<ul class="dropdown-menu pull-right">'+
                                '<li><a href="javascript:void(0);" onclick="fseditcomment('+result.response.cid+');"><span><i class="fa fa-pencil"></i> EDIT</span></a></li>'+
                                '<li><a href="javascript:void(0);" onclick="fsdeletecomment('+result.response.cid+');"><span><i class="fa fa-trash"></i> DELETE</span></a></li>'+
                            '</ul>'+
                        '</span><span class="text-muted pull-right datecv">1 minute ago</span> </span> </div>'+
                        '<div style="margin:8px 0 6px 2px" class="comment-text">'+
						    '<div class="fsmore '+result.response.cid+'" style="word-wrap: break-word;">'+result.response.comment+'</div>'+
							'<div style="margin:5px 0;" class="">'+
                                '<a href="javascript:void(0);" onclick="fspostReplycomment('+result.response.cid+','+result.response.story_id+')" class="pull-left replycv" title="Reply">REPLY</a> <a href="" class="pull-left replycv">I</a>'+
                                '<a href="javascript:void(0);" onclick="fsdisplayreplies('+result.response.cid+','+result.response.story_id+')" class="pull-left replycv" title="Replies"> '+
                                    '<span class="fsold_subcmtcount'+result.response.cid+'">0</span> REPLIES</a>'+
                            '</div></div><br><div class="comment-text">'+
						    '<div class="input-group fspostreplycomment'+result.response.cid+'" style="margin-bottom:5px;"></div>'+
						'</div>'+
    		    '<div class="subcomments" id="fsmysubList'+result.response.story_id+'_'+result.response.cid+'"></div></div>');
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
            url:"<?php echo base_url();?>welcome/editpro_comment/"+commentid,
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
		$.post("<?php echo base_url();?>welcome/updatecomment",{'comment':comments,'cid':cid},function(resultdata){
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
	    /*$.ajax({
    		url:'<?php echo base_url();?>welcome/deletepro_comment/'+commentid,
    		method: 'POST',
    		dataType: "json",
    		success:function(data){
    		    if(data == 1) {
                    $('div.fscommentdelete'+commentid).css('display','none');
                }
            } 
        });*/
        var x = confirm("Are you sure you want to delete the Comment?");
        if (x) {
            $.ajax({
                type:'POST',
                url:'<?php echo base_url();?>welcome/deletepro_comment/'+commentid,
                success:function(response){
                    if(response){
                        var result = jQuery.parseJSON(response);
                        $('.fsold_subcmtcount'+result.comment_id).text(result.delsubcmtcount);
                        $('div.fscommentdelete'+commentid).css('display','none');
                        $('#snackbar').text('Comment Deleted Successfully.').addClass('show');
        	            setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
                    }else{
                        $('#snackbar').text('Failed to Delete Comment.').addClass('show');
        	            setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
                    }
                }
            });
        }else{
            return false;
        }
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
	    
	    $('#fsmysubList'+storyid+'_'+commentid).css('display','block');
	}
	function fsdisplayreplies(commentid, storyid){
	    $('#fsmysubList'+storyid+'_'+commentid).css('display','block');
	}
	function fsaddreplycomment(commentid, storyid){
	    var comments = $('#replycmts'+commentid).val();
	    var fsold_subcmtcount = $('.fsold_subcmtcount'+commentid).text();
	    if(comments){
	        $.ajax({
        		url:'<?php echo base_url();?>welcome/addstoryreplycomment',
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
                            url: "<?php echo base_url('welcome/pro_commentpost'); ?>",
                            type: 'POST',
                            dataType: 'json',
                            success: function(result) {
                                if(result.response){
                                    var profile_image = "<?php echo $this->session->userdata['logged_in']['profile_image'];?>";
                                    if((profile_image != '') || (profile_image != ' ') || (profile_image != 'undefined')){
                                    }else{ profile_image = '2.png'; }
                                    var htmlcomment ='<div class="media fscommentdelete'+result.response[0].cid+'" style="padding-bottom:0px;margin-bottom:10px;">'+
    								    '<span class="media-left"><img class="img-circle" style="width:25px;" src="<?php echo base_url();?>assets/images/'+profile_image+'" alt="'+result.response[0].name+'"></span>'+
    								    '<span class="media-body bodycv">'+
                                            '<div class=""><span class=""> &nbsp;'+result.response[0].name+
                                                '<span class="dropdown pull-right">'+
                                                    '<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" style="padding: 0px 10px 0px 20px;">'+
                                                        '<i class="fa fa-ellipsis-v"></i> </a>  '+
                                                    '<ul class="dropdown-menu pull-right">'+
                                                        '<li><a href="javascript:void(0);" onclick="fseditcomment('+result.response[0].cid+');"><span><i class="fa fa-pencil"></i> EDIT</span></a></li>'+
                                                        '<li><a href="javascript:void(0);" onclick="fsdeletecomment('+result.response[0].cid+');"><span><i class="fa fa-trash"></i> DELETE</span></a></li>'+
                                                    '</ul>'+
                                                '</span><span class="text-muted pull-right datecv">'+result.response[0].hydhmdatetime+'</span></span><br>'+
                                                '<span class="fsmore '+result.response[0].cid+'" style="word-wrap: break-word;">'+result.response[0].comment+'</span>'+
                                            '</div>'+
                                        '</span>'+
                                    '</div>';
                                    $('#fsmysubList'+storyid+'_'+commentid).prepend(htmlcomment);
                                    $('.fsold_subcmtcount'+commentid).text(parseInt(fsold_subcmtcount)+1);
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
            url:"<?php echo base_url();?>welcome/fsloadcomments",
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
            url:"<?php echo base_url();?>welcome/fsloadsubcomment",
            data:{'storyid':storyid, 'comment_id':comment_id,'subcommentid':subcommentid },
            success:function(html){
                $('#fsmysubList'+storyid+'_'+comment_id).append(html);
            }
        });
    }
</script>
<!-- Feed Story Comments end -->
<script>
    function showhide(commentid){ // comments read more & less
        $(".showhide"+commentid).toggle();
        if ($('.moreless'+commentid).text() == "Read Less") {
            $('.moreless'+commentid).text("Read More");
        } else {
           $('.moreless'+commentid).text("Read Less");
        }
    }
    function showhidedesc(storypostid){ // Story posts read more & less
        $(".showhidedesc"+storypostid).toggle();
        if ($('.smoreless'+storypostid).text() == "Read Less") {
            $('.smoreless'+storypostid).text("Read More");
        } else {
           $('.smoreless'+storypostid).text("Read Less");
        }
    }
</script>

<script> 
    $(document).ready(function(){ // feed auto scroll
        var limit = 6;
        var start = 6;
        var action = 'inactive';
        function load_country_data(limit, start) {
            $.ajax({
                url:'<?php echo base_url();?>welcome/loadmorefeed',
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
                url:'<?php echo base_url();?>welcome/loadmoreyourfeed',
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
                url:'<?php echo base_url();?>welcome/loadmorestoryfeed',
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

