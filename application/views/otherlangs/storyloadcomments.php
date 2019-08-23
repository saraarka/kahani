<?php if(isset($comment_get) && ($comment_get->num_rows() >0)){
    foreach($comment_get->result() as $comment){ ?>
    <div class="">
        <div style="padding-bottom:0px;" class="box-footer padding-0 box-comments commentdelete<?php echo $comment->cid;?>">
            <div class="box-comment">
                <?php if(isset($comment->profile_image) && !empty($comment->profile_image)) { ?>
				<img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $comment->profile_image;?>" alt="<?php echo ucfirst($comment->name); ?>">
			    <?php } else { ?>
				<img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo ucfirst($comment->name); ?>">
			    <?php } ?>
				<div class="comment-text">
                    <span class="username" style="padding-top:6px;"> &nbsp;<b>
                        <a href="<?php echo base_url().$this->uri->segment(1).'/'.$comment->profile_name;?>"><?php echo ucfirst($comment->name); ?></a></b> 
					     <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($this->session->userdata['logged_in']['user_id'] == $comment->user_id)){ ?>
					     <span class="dropdown" style="float:right;">
                            <a href="javascript:void(0);" class="dropdown-toggle elli" data-toggle="dropdown" title="write" aria-expanded="false">
						        <i class="fa fa-ellipsis-v"></i>
						    </a>
						    <ul class="dropdown-menu pull-right">
						        <li><a href="javascript:void(0);" onclick="editcomment(<?php echo $comment->cid;?>);"><i class="fa fa-pencil"></i> EDIT </a></li>
			                    <li><a href="javascript:void(0);" onclick="deletecomment(<?php echo $comment->cid;?>);"><i class="fa fa-trash"></i> DELETE </a></li>
			                </ul>
		                </span>
		                
		                <?php } else if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])){ ?>
		                <span class="dropdown" style="float:right;">
			                <a href="#" class="dropdown-toggle elli" data-toggle="dropdown" title="write" aria-expanded="false">
						        <i class="fa fa-ellipsis-v "></i>
						    </a>
						    <ul class="dropdown-menu pull-right">
			                    <li>
			                        <a href="javascript:void(0);" onClick="reportcomment(<?php echo $comment->cid;?>, <?php echo $comment->user_id;?>, <?php echo $comment->story_id;?>);"><i class="fa fa-exclamation-triangle"></i> REPORT </a>
						        </li>
			                </ul>
			            </span>   
		                <?php } ?>
		                <span class="text-muted pull-right datecv"><?php echo get_ydhmdatetime($comment->date);?></span>
				    </span>
			    </div>
			    <div class="comment-text" style="margin:8px 0px 6px 2px;">
			        <div style="word-break:break-word;" class="more pcomment<?php echo $comment->cid;?>"><?php echo $comment->comment; ?></div>
			        <div style="margin:5px 0px;">
			            <a href="javascript:void(0)" onClick="postReplycomment(<?php echo $comment->cid;?>, <?php echo $comment->story_id;?>)" class="pull-left replycv"> REPLY </a>
			            <span class="pull-left replycv"> I </span>
			            <a href="javascript:void(0)" onClick="displayreplies(<?php echo $comment->cid;?>,<?php echo $comment->story_id;?>)" class="pull-left replycv" title="Replies">| 
                            <span class="old_subcmtcount<?php echo $comment->cid;?>"><?php echo get_storysubcmtcount($comment->cid, $comment->story_id);?></span> REPLIES</a>
			        </div>
			    </div><br>
			    <div class="comment-text">
			        <div style="margin-bottom:5px" class="input-group postreplycomment<?php echo $comment->cid;?>"></div>
			    </div>
			</div>
                
                <?php $replaycomments = get_replaycomments($comment->story_id, $comment->cid); ?>
                <?php if(isset($replaycomments) && ($replaycomments->num_rows() > 0 )){ ?>
                <ul style="list-style: none; padding:0px; margin-top:0px; margin-left:15px;display:none;" class="replycmtlist<?php echo $comment->cid;?>">
                    <span id="spinnertab<?php echo $comment->cid;?>"><center>
                        <img src="<?php echo base_url();?>/assets/landing/svg/spinnertab.svg" class="spinner">
                    </center></span>
                    <li class="postreplycmt<?php echo $comment->cid;?>"></li>
                <?php foreach($replaycomments->result() as $replaycomment){ ?>
                    <div style="margin-bottom:15px;" class="media commentdelete<?php echo $replaycomment->cid;?>">
                        <span class="media-left">
                            <?php if(!empty($replaycomment->profile_image)){ ?>
                                <img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $replaycomment->profile_image;?>" style="width:25px;" alt="<?php echo ucfirst($replaycomment->name); ?>">
                            <?php } else{ ?>
                                <img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" style="width:25px;" alt="<?php echo ucfirst($replaycomment->name); ?>">
                            <?php } ?>
                        </span>
                        <span class="media-body bodycv">
	                        <div class="">
                                <span class="">&nbsp;<b><a href="<?php echo base_url().$this->uri->segment(1).'/'.$replaycomment->profile_name;?>"><?php echo ucfirst($replaycomment->name); ?></a></b>
			                        <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($this->session->userdata['logged_in']['user_id'] == $replaycomment->user_id)){ ?>
                                    <span class="dropdown" style="float:right;">
                                        <a href="javascript:void(0);" class="dropdown-toggle elli" data-toggle="dropdown" title="write" aria-expanded="false">
				                            <i class="fa fa-ellipsis-v"></i>
				                        </a>
				                        <ul class="dropdown-menu pull-right">
	                                        <li><a href="javascript:void(0);" onClick="editcomment(<?php echo $replaycomment->cid;?>);"><i class="fa fa-pencil"></i> EDIT </a></li>
	                                        <li><a href="javascript:void(0);" onClick="deletecomment(<?php echo $replaycomment->cid;?>);"><i class="fa fa-trash"></i> DELETE </a></li>
	                                    </ul>
                                    </span>
                                    <?php } else if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])){ ?>
                                    <span class="dropdown" style="float:right;">
	                                    <a href="javascript:void(0);" class="dropdown-toggle elli" data-toggle="dropdown" title="write" aria-expanded="false">
				                            <i class="fa fa-ellipsis-v"></i>
				                        </a>
				                        <ul class="dropdown-menu pull-right">
	                                        <li><a href="javascript:void(0);" onClick="reportcomment(<?php echo $replaycomment->cid;?>, <?php echo $replaycomment->user_id;?>, <?php echo $replaycomment->story_id;?>);"><i class="fa fa-exclamation-triangle"></i> Report </a>
				                            </li>
	                                    </ul>
	                                </span>
                                    <?php } ?>
                                    <span class="text-muted pull-right datecv"><?php echo get_ydhmdatetime($replaycomment->date);?></span>
		                        </span><br>
		                        <span style="padding-left:6px;word-break:break-word;" class="more pcomment<?php echo $replaycomment->cid;?>">
		                            <?php echo $replaycomment->comment; ?>
		                        </span>
	                        </div>
	                    </span>
                    </div>
                <?php } ?>
                </ul>
                <?php } else{ ?>
                    <ul style="list-style: none; padding:0px; margin-top:0px;">
                        <li class="postreplycmt<?php echo $comment->cid;?>"></li>
                    </ul>
                <?php } ?>
            </div>
        </div>
<?php } } ?>