<?php if(isset($comment_get) && ($comment_get->num_rows() >0)){ foreach($comment_get->result() as $comment){ ?>
<div class="box-footer padding-0 box-comments commentdelete<?php echo $comment->cid;?>">
    <div class="box-comment">
        <?php if(isset($this->session->userdata['logged_in']['profile_image']) && !empty($this->session->userdata['logged_in']['profile_image'])) { ?>
		<img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $this->session->userdata['logged_in']['profile_image'];?>" alt="User Image">
	    <?php } else { ?>
		<img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="User Image">
	    <?php } ?>
	    <div class="comment-text">
            <span class="username" style="padding-top:6px;">&nbsp;
            <a href="<?php echo base_url().$this->uri->segment(1).'/'.$comment->profile_name;?>" style="color: #337ab7;"><?php echo ucfirst($comment->name); ?></a> 
    		    <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($this->session->userdata['logged_in']['user_id'] == $comment->user_id)){ ?>
                <span class="dropdown" style="float:right;">
                    <a href="javascript:void(0);" class="dropdown-toggle elli" data-toggle="dropdown" aria-expanded="false">
        		        <i class="fa fa-ellipsis-v" style="color: #337ab7;"></i>
        		    </a>
        		    <ul class="dropdown-menu pull-right">
                        <li><a href="javascript:void(0);" onclick="deletecomment(<?php echo $comment->cid;?>);"><i class="fa fa-trash"></i> Delete </a></li>
                        <li><a href="javascript:void(0);" onclick="editcomment(<?php echo $comment->cid;?>);"><i class="fa fa-pencil"></i> Edit </a></li>
                    </ul>
                </span>
                <?php } else if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])){ ?>
                <span class="dropdown" style="float:right;">
                    <a href="javascript:void(0);" class="dropdown-toggle elli" data-toggle="dropdown" aria-expanded="false">
        		        <i class="fa fa-ellipsis-v"></i>
        		    </a>
        		    <ul class="dropdown-menu pull-right">
                        <li><a href="javascript:void(0);" class="" style="" onClick="reportcomment(<?php echo $comment->cid;?>, <?php echo $comment->user_id;?>, <?php echo $comment->story_id;?>);"><i class="fa fa-exclamation-triangle"></i> Report </a>
        		        </li>
                    </ul>
                </span>
                <?php } ?>
                <span class=" text-muted pull-right datecv"><?php echo get_ydhmdatetime($comment->date);?></span>
    	    </span>
        </div>
        <div class="comment-text" style="margin:8px 0px 6px 2px">
            <div class="more pcomment<?php echo $comment->cid;?>"><?php echo $comment->comment; ?></div>
            <div style=" margin:5px 0px;">
                <a href="javascript:void(0)" onClick="postReplycomment(<?php echo $comment->cid;?>, <?php echo $comment->story_id;?>)" class="pull-left replycv">REPLY </a>
                <!--<a href="javascript:void(0)" onClick="postReplycomment(<?php echo $comment->cid;?>, <?php echo $comment->story_id;?>)" class="pull-left replycv">|  0 REPLIES </a>-->
                <a href="javascript:void(0)" onClick="displayreplies(<?php echo $comment->cid;?>,<?php echo $comment->story_id;?>)" class="pull-left replycv" title="Replies">| 
                    <span class="old_subcmtcount<?php echo $comment->cid;?>"><?php echo get_storysubcmtcount($comment->cid, $comment->story_id);?></span> REPLIES</a>
            </div>
        </div><br>
        <div class="comment-text">
            <div class="input-group postreplycomment<?php echo $comment->cid;?>"></div>
        </div>
    </div>   
        
        <?php $replaycomments = get_replaycomments($comment->story_id, $comment->cid); ?>
        <?php if(isset($replaycomments) && ($replaycomments->num_rows() > 0 )){ ?>
            <ul style="list-style: none; padding:0px; margin-top:15px; margin-left:15px;">
                <li class="postreplycmt<?php echo $comment->cid;?>"></li>
            <?php foreach($replaycomments->result() as $replaycomment){ ?>
                <li style="margin-bottom:15px;" class="commentdelete<?php echo $replaycomment->cid;?>">
                   <div class="box-header with-border" style="background: #77777745; border-radius: 5px;">
                        <div class="user-block">
                                <?php if(isset($this->session->userdata['logged_in']['profile_image']) && !empty($this->session->userdata['logged_in']['profile_image'])){ ?>
                                    <img src="<?php echo base_url();?>assets/images/<?php echo $this->session->userdata['logged_in']['profile_image'];?>" style="border-radius: 50%;width:40px;height:40px;" alt="<?php echo $replaycomment->name;?>">
                                <?php } else{ ?>
                                    <img src="<?php echo base_url();?>assets/images/2.png" style="border-radius: 50%;width:40px;height:40px;" alt="<?php echo $replaycomment->name;?>">
                                <?php } ?>
	                    
                            <span class="username"><a href="<?php echo base_url().$this->uri->segment(1).'/'.$replaycomment->profile_name;?>"><?php echo ucfirst($replaycomment->name); ?></a>
		                        <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($this->session->userdata['logged_in']['user_id'] == $replaycomment->user_id)){ ?>
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" title="write" aria-expanded="false">
		                            <i class="fa fa-ellipsis-v pull-right"></i>
		                        </a>
		                        <ul class="dropdown-menu dv1">
                                    <li><a href="javascript:void(0);" onClick="editcomment(<?php echo $replaycomment->cid;?>);"><i class="fa fa-pencil"></i> Edit </a></li>
                                    <li><a href="javascript:void(0);" onClick="deletecomment(<?php echo $replaycomment->cid;?>);"><i class="fa fa-trash"></i> Delete </a></li>
                                </ul>
                                <?php } else if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])){ ?>
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" title="write" aria-expanded="false">
		                            <i class="fa fa-ellipsis-v pull-right"></i>
		                        </a>
		                        <ul class="dropdown-menu dv1">
                                    <li><a href="javascript:void(0);" onClick="reportcomment(<?php echo $replaycomment->cid;?>, <?php echo $replaycomment->user_id;?>, <?php echo $replaycomment->story_id;?>);"><i class="fa fa-exclamation-triangle"></i> Report </a>
		                            </li>
                                </ul>
                                <?php } ?>
	                        </span>
	                        <span class="description"><?php echo get_ydhmdatetime($replaycomment->date);?></span>
	                    </div>
                        
                        <p class="pcomment<?php echo $replaycomment->cid;?>"><?php echo $replaycomment->comment; ?></p>
                    </div>
                </li>
            <?php } ?>
        </ul>
        <?php } else{ ?>
            <ul style="list-style: none; padding:0px; margin-top:15px;">
                <li class="postreplycmt<?php echo $comment->cid;?>"></li>
            </ul>
        <?php } ?>
    </div>
</div>
<?php } } ?>