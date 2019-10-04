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
							<li class="" onclick="tab_yourfeed();"><a href="#tab_yourfeed" data-toggle="tab">YOUR POSTS</a></li>
							<li class="" onclick="tab_stories();"><a href="#tab_stories" data-toggle="tab">YOUR NETWORK</a></li>
						</ul>
					</div>
						
					<div class="tab-content" style="background:none!important; padding:0px;">
					    
						<div class="tab-pane active" id="tab_feed">
							<?php if(isset($feed) && ($feed->num_rows() > 0)){ ?><div id="loadmoreall"><?php foreach ($feed->result() as $key) { ?>
								<div class="box box-widget" style="background:#fff; border:1px solid #dddddd;margin-bottom: 10px;" id="delcomm<?php echo $key->id;?>">
									<div class="box-header with-border">
										<div class="user-block">
											<?php if(isset($key->profile_image) && !empty($key->profile_image)) { ?>
												<img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $key->profile_image;?>" alt="<?php echo $key->name;?>">
											<?php } else { ?>
												<img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo $key->name;?>">
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
											    <div class="user-block mb-10"><?php echo mb_substr($key->urldescription, 0, 200); ?>
									                <span class="showhidedesc<?php echo $key->id;?>" style="display:none;"><?php echo mb_substr($key->urldescription,200); ?></span>
									                <span class="smorelessdots<?php echo $key->id;?>">...</span>
									                <u onclick="showhidedesc(<?php echo $key->id;?>)" class="smoreless<?php echo $key->id;?>" style="cursor: pointer;color:red;">show-more</u></div>
											<?php } else{ ?>
											    <div class="user-block mb-10"> <?php echo $key->urldescription; ?></div>
											<?php } ?>
											<?php if(!empty($key->title)){ ?>
												<div class="media border-box" style="margin-top:2px;">
													<div class="media-left">
														<a href="<?php echo $key->titleurl;?>" target="_blank">
														<?php if(!empty($key->image)) { ?>
													        <img src="<?php echo $key->image;?>" class="media-object img-v" alt="<?php echo $key->title; ?>">
														<?php } else { ?>
															<img src="<?php echo base_url();?>assets/images/2.png" class="media-object img-v" alt="<?php echo $key->title; ?>">
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
										    <?php if(isset($key->urldescription) && !empty($key->urldescription) && (strlen($key->urldescription) > 200)){ ?>
											    <div class="user-block mb-10"><?php echo mb_substr($key->urldescription, 0, 200); ?>
									                <span class="showhidedesc<?php echo $key->id;?>" style="display:none;"><?php echo mb_substr($key->urldescription,200); ?></span>
									                <span class="smorelessdots<?php echo $key->id;?>">...</span>
									                <u onclick="showhidedesc(<?php echo $key->id;?>)" class="smoreless<?php echo $key->id;?>" style="cursor: pointer;color:red;">show-more</u></div>
											<?php } else{ ?>
											    <div class="user-block mb-10"> <?php echo $key->urldescription; ?></div>
											<?php } ?>
										    <?php if(isset($key->typeoftype) && ($key->typeoftype == 'quotes')){ ?>
											    <p class="mb-15 sizep text-justify edittext<?php echo $key->id;?>"><?php echo $key->story;?></p>
											<?php } else if(strpos($key->story, '<span><em> Writen by <a href=')) { ?>
											    <p class="mb-15 edittext<?php echo $key->id;?>"><?php echo $key->story;?></p>
											<?php } else{ ?>
											    <?php if(isset($key->story) && (strlen($key->story) > 200)){ ?>
    											    <p class="text-justify edittext<?php echo $key->id;?>"><?php echo mb_substr($key->story, 0, 200); ?>
    									                <span class="showhidedesc<?php echo $key->id;?>" style="display:none;"><?php echo mb_substr($key->story,200); ?></span>
    									                <span class="smorelessdots<?php echo $key->id;?>">...</span>
    									                <u onclick="showhidedesc(<?php echo $key->id;?>)" class="smoreless<?php echo $key->id;?>" style="cursor: pointer;color:red;">show-more</u></p>
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
												<span id="old_cmt<?php echo $key->id;?>"  style="cursor:pointer"><?php echo get_storycmtcount($key->id);?></span> <span style="cursor:pointer"> Comments</span>
											</span>
										</div>
									<?php } ?>
									<!-- /.box-footer -->
									<div class="box-footer">
										<div id="community_commentpost<?php echo $key->id; ?>">
											<?php if (isset($this->session->userdata['logged_in'])) { 
												if(isset($this->session->userdata['logged_in']['profile_image']) && !empty($this->session->userdata['logged_in']['profile_image'])) { ?>
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
														        <div class="more <?php echo $comment->id;?>"><?php echo mb_substr($comment->comment, 0, 200); ?>
														            <span class="showhide<?php echo $comment->id;?>" style="display:none;"><?php echo mb_substr($comment->comment,200); ?></span>
														            <span class="smorelessdots<?php echo $comment->id;?>">...</span>
														            <u onclick="showhide(<?php echo $comment->id;?>)" class="moreless<?php echo $comment->id;?>" style="cursor: pointer;color:red;">show-more</u></div>
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
													    <center> <span id="spinnertab<?php echo $comment->id;?>">
                                                            <img src="<?php echo base_url();?>/assets/landing/svg/spinnercomments.svg" class="spinner">
                                                        </span> </center>
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
            														        <span class="more <?php echo $subcomment->id;?>" style="padding-left:10px;"><?php echo mb_substr($subcomment->comment, 0, 200); ?>
            														            <span class="showhide<?php echo $subcomment->id;?>" style="display:none;"><?php echo mb_substr($subcomment->comment,200); ?></span>
            														            <span class="smorelessdots<?php echo $subcomment->id;?>">...</span>
            														            <u onclick="showhide(<?php echo $subcomment->id;?>)" class="moreless<?php echo $subcomment->id;?>" style="cursor: pointer;color:red;">show-more</u></span>
            														    <?php } else{ ?>
            														        <span class="more <?php echo $subcomment->id;?>" style="padding-left:10px;"><?php echo $subcomment->comment;?></span>
            														    <?php } ?>
        													       </div>
        													   </span>
        													</div>
        													<?php } $commlastsubcomment = get_commlastsubcomment($key->id, $comment->id); 
        													    if($subcomment->id > $commlastsubcomment){ ?>
        													<a href="javascript:void(0);">
        													    <span class="loadsubcomment<?php echo $comment->id;?>" onClick="commloadsubcomment(<?php echo $key->id;?>, <?php echo $comment->id;?>, <?php echo $subcomment->id;?>)">
        													        <center>View More</center></span>
        													</a>
        												    <?php } else{ ?>
        												    <span class="loadsubcomment"></span>
            											<?php } } ?>
        											</div>
												</div>
										    <?php } $commlastcomment = get_commlastcomment($key->id); if($comment->id > $commlastcomment){ ?>
									        <a href="javascript:void(0);">
									            <span class="loadmorespan<?php echo $key->id;?>" onClick="commloadmore(<?php echo $key->id;?>, <?php echo $comment->id;?>)">
									                <center>View More</center></span>
									        </a>
									        <?php } else{ ?>
									        <span class="loadmorespan"></span>
									        <?php } ?>
									    </div>
									<?php } ?>
									<!-- /.box-footer -->
								</div>
							<?php } ?> </div><div id="load_data_message"></div> <?php } ?>
						</div>
						
						<div class="tab-pane" id="tab_yourfeed">
						    <div style="margin-top:50px;"><center>
						        <img src="<?php echo base_url();?>/assets/landing/svg/spinnertab.svg" class="spinner">
						    </center></div>
						</div>
						
						<div class="tab-pane" id="tab_stories">
						    <div style="margin-top:50px;"><center>
						        <img src="<?php echo base_url();?>/assets/landing/svg/spinnertab.svg" class="spinner">
						    </center></div>
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
						    <img src="<?php echo base_url();?>assets/svg/fb.svg" style="width:40px; height:40px;"/>
						    <span style="vertical-align: -webkit-baseline-middle; padding-left:5px; font-size:18px;">Faceebok</span></a>
					</div>
					<div class="col-md-12 pd-5v">
					    <a href="javascript:void(0);" class="whatsappshare">
						    <img src="<?php echo base_url();?>assets/svg/wa.svg" style="width:40px; height:40px;"/>
						    <span style="vertical-align: -webkit-baseline-middle; padding-left:5px; font-size:18px;">Whatsapp</span></a>
					</div>
					<div class="col-md-12 pd-5v">
						<a href="javascript:void(0);" class="twittershare">
						    <img src="<?php echo base_url();?>assets/svg/twitter.svg" style="width:40px; height:40px;"/>
						    <span style="vertical-align: -webkit-baseline-middle; padding-left:5px; font-size:18px;">Twitter</span></a>
					</div>
					<div class="col-md-12 pd-5v">
						<a href="javascript:void(0);" onclick="copylinkshare('#copylinkshare')">
						    <img src="<?php echo base_url();?>assets/svg/link.svg" style="width:40px; height:40px;"/>
						    <span style="vertical-align: -webkit-baseline-middle; padding-left:5px; font-size:18px;">Copy to link</span></a>
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
    function tab_yourfeed(){ // your feed tab
        $.ajax({
    		url:'<?php echo base_url();?>welcome/tab_yourfeed',
    		method: 'POST',
    		success:function(data){
    			$('#tab_yourfeed').html(data);
            } 
        });
    }
    function tab_stories(){ // stories or your network tab
        $.ajax({
    		url:'<?php echo base_url();?>welcome/tab_stories',
    		method: 'POST',
    		success:function(data){
    			$('#tab_stories').html(data);
            } 
        });
    }
    
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
    });
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
    setTimeout(function(){ $('#spinnertab'+commentid).html(' '); }, 50);
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
    		        '<div class="subcomments" style="margin-left:10px;" id="mysubList'+result.response.story_id+'_'+result.response.id+'"></div>'+'</div>');
    		    $('#old_cmt'+story_id).html(parseInt(old_cmtcount)+1);
		}else{
			alert('Failed to Post Comment.');
		}
	});
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
    			    $('.edittext'+ptextid).text(ptext.mb_substr(0, 100));
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
	    setTimeout(function(){ $('#spinnertab'+commentid).html(' '); }, 50);
	}
	function addreplycomment(commentid, comm_id, story_id){
	    var comments = $('#replycmts'+commentid).val();
	    //var old_cmtcount = $('#old_cmt'+story_id).text();
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
                                    var htmlcomment ='<div class="media editdelete'+result.response[0].id+'" style="margin-top:5px;margin-bottom:5px;">'+
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
                                    //$('#old_cmt'+story_id).html(parseInt(old_cmtcount)+1);
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
        $('#myList'+storyid).append('<span id="spinnertab'+storyid+'"><center> '+
            '<img src="<?php echo base_url();?>/assets/landing/svg/spinnercomments.svg" class="spinner"></center></span>');
        $.ajax({
            type:'POST',
            url:"<?php echo base_url();?>welcome/commloadcomments",
            data:{'storyid':storyid, 'commentid':commentid},
            success:function(html){
                //$('#myList'+storyid).append(html);
                $('#spinnertab'+storyid).html(' ');
                $('#spinnertab'+storyid).removeAttr('id');
                $('#myList'+storyid).append(html);
            }
        });
    }
    function commloadsubcomment(storyid, comment_id, subcommentid ){
        $('.loadsubcomment'+comment_id).hide();
        $('#mysubList'+storyid+'_'+comment_id).append('<span id="spinnertab'+storyid+'_'+comment_id+'"><center> '+
            '<img src="<?php echo base_url();?>/assets/landing/svg/spinnercomments.svg" class="spinner" style="float: inherit;"></center></span>');
        $.ajax({
            type:'POST',
            url:"<?php echo base_url();?>welcome/commloadsubcomments",
            data:{'storyid':storyid, 'comment_id':comment_id,'subcommentid':subcommentid },
            success:function(html){
                //$('#mysubList'+storyid+'_'+comment_id).append(html);
                $('#spinnertab'+storyid+'_'+comment_id).html(' ');
                $('#spinnertab'+storyid+'_'+comment_id).removeAttr('id');
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
	    setTimeout(function(){ $('#topspinnertab'+commentid).html(' '); }, 50);
    }
    function toppostdisplayreplies(commentid, comm_id, story_id){
        $('#topmysubList'+story_id+'_'+commentid).css('display','block');
        setTimeout(function(){ $('#topspinnertab'+commentid).html(' '); }, 50);
    }
	function topaddreplycomment(commentid, comm_id, story_id){
	    var comments = $('#topreplycmts'+commentid).val();
	    var topsubcmtcount = $('.told_subcmtcount'+commentid).text();
	    //var topoldcmtcount = $('#told_cmt'+story_id).text();
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
                                    //$('#told_cmt'+story_id).text(parseInt(topoldcmtcount)+1);
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
        $('#topmyList'+storyid).append('<span id="topspinnertab'+storyid+'"><center> '+
            '<img src="<?php echo base_url();?>/assets/landing/svg/spinnercomments.svg" class="spinner"></center></span>');
        $.ajax({
            type:'POST',
            url:"<?php echo base_url();?>welcome/commloadcomments/topstory",
            data:{'storyid':storyid, 'commentid':commentid},
            success:function(html){
                //$('#topmyList'+storyid).append(html);
                $('#topspinnertab'+storyid).html(' ');
                $('#topspinnertab'+storyid).removeAttr('id');
                $('#topmyList'+storyid).append(html);
            }
        });
    }
    function topcommloadsubcomment(storyid, comment_id, subcommentid ){
        $('.toploadsubcomment'+comment_id).hide();
        $('#topmysubList'+storyid+'_'+comment_id).append('<span id="topspinnertab'+storyid+'_'+comment_id+'"><center> '+
            '<img src="<?php echo base_url();?>/assets/landing/svg/spinnercomments.svg" class="spinner" style="float: inherit;"></center></span>');
        $.ajax({
            type:'POST',
            url:"<?php echo base_url();?>welcome/commloadsubcomments/topstory",
            data:{'storyid':storyid, 'comment_id':comment_id,'subcommentid':subcommentid },
            success:function(html){
                //$('#topmysubList'+storyid+'_'+comment_id).append(html);
                $('#topspinnertab'+storyid+'_'+comment_id).html(' ');
                $('#topspinnertab'+storyid+'_'+comment_id).removeAttr('id');
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
        if ($('.moreless'+commentid).text() == "show-less") {
            $('.smorelessdots'+commentid).show();
            $('.moreless'+commentid).text("show-more");
        } else {
            $('.smorelessdots'+commentid).hide();
            $('.moreless'+commentid).text("show-less");
        }
    }
    function showhidedesc(storypostid){ // Story posts read more & less
        $(".showhidedesc"+storypostid).toggle();
        if ($('.smoreless'+storypostid).text() == "show-less") {
            $('.smorelessdots'+storypostid).show();
            $('.smoreless'+storypostid).text("show-more");
        } else {
            $('.smorelessdots'+storypostid).hide();
            $('.smoreless'+storypostid).text("show-less");
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
            //if($(window).scrollTop() + $(window).height() > $("#loadmoreall").height() && action == 'inactive'){
            if ($(window).scrollTop() >= (($("#loadmoreall").height() - $(window).height())*0.6) && action == 'inactive'){
                action = 'active';
                start = start + limit;
                setTimeout(function(){load_country_data(limit, start);}, 10);
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
            //if($(window).scrollTop() + $(window).height() + 3000 > $("#yloadmoreall").height() && yaction == 'inactive'){
            if ($(window).scrollTop() >= (($("#yloadmoreall").height() - $(window).height())*0.6) && yaction == 'inactive'){
                yaction = 'active';
                ystart = ystart + ylimit;
                setTimeout(function(){yload_country_data(ylimit, ystart);}, 10);
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
            //if($(window).scrollTop() + $(window).height() + 3000 >= $("#sloadmoreall").height() && saction == 'inactive'){
            if ($(window).scrollTop() >= (($("#sloadmoreall").height() - $(window).height())*0.6) && saction == 'inactive'){
                saction = 'active';
                sstart = sstart + slimit;
                setTimeout(function(){sload_country_data(slimit, sstart);}, 10);
            }
        });
    });
</script>
    			    <?php if(isset($yourfeed->urldescription) && !empty($yourfeed->urldescription) && (strlen($yourfeed->urldescription) > 200)){ ?>
    				    <div class="user-block mb-10"><?php echo mb_substr($yourfeed->urldescription, 0, 200); ?>
    		                <span class="showhidedesc<?php echo $yourfeed->id;?>" style="display:none;"><?php echo mb_substr($yourfeed->urldescription,200); ?></span>
    		                <span class="smorelessdots<?php echo $yourfeed->id;?>">...</span>
    		                <u onclick="showhidedesc(<?php echo $yourfeed->id;?>)" class="smoreless<?php echo $yourfeed->id;?>" style="cursor: pointer;color:red;">show-more</u></div>
    				<?php } else{ ?>
    				    <div class="user-block mb-10"> <?php echo $yourfeed->urldescription; ?></div>
    				<?php } ?>    				
