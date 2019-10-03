<?php if(isset($pro_comments) && ($pro_comments->num_rows() >0)){ foreach($pro_comments->result() as $pro_comment){ ?>
    <li class="commentdelete<?php echo $pro_comment->cid;?>">
        <div class="" style="float: left;">
            <a href="<?php echo base_url($pro_comment->profile_name);?>">
                <?php if(!empty($pro_comment->profile_image)){ ?>
                    <img src="<?php echo base_url();?>assets/images/<?php echo $pro_comment->profile_image;?>" style="border-radius: 50%;width:40px !important;height: 40px !important;margin-right: 10px;" alt="<?php echo $pro_comment->name; ?>">
                <?php } else{ ?>
                    <img src="<?php echo base_url();?>assets/images/2.png" style="border-radius: 50%;width:40px !important;height: 40px !important;margin-right: 10px;" alt="<?php echo $pro_comment->name; ?>">
                <?php } ?>
            </a>
        </div>
        <div class="comment_right clearfix">
            <div class="comment_info" style="padding-left:10px;">
                <div class="namers1">
                    <a href="<?php echo base_url($pro_comment->profile_name);?>"><?php echo $pro_comment->name; ?></a>
                </div>
                <span class="dropdown" style="float:right;">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" title="write" aria-expanded="true" style="padding: 0px 15px;">
                    <i class="fa fa-ellipsis-v"></i></a>
                    <ul class="dropdown-menu pull-right">
                        <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($this->session->userdata['logged_in']['user_id'] == $pro_comment->user_id)){ ?>
                        <li><a onClick="editpro_comment(<?php echo $pro_comment->cid;?>);" style="cursor:pointer;"><span><i class="fa fa-pencil"></i> EDIT</span></a></li>
                        <li><a onClick="deletepro_comment(<?php echo $pro_comment->cid;?>);" style="cursor:pointer;"><span><i class="fa fa-trash"></i> DELETE</span></a></li>
                        <?php } else if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])){ ?>
                        <li><a href="javascript:void(0);"><span onClick="reportpro_comment(<?php echo $pro_comment->cid;?>, <?php echo $pro_comment->user_id;?>);"><i class="fa fa-exclamation-triangle"></i> REPORT</span></a></li>
                        <?php } else{ ?>
                        <li><a href="javascript:void(0);" data-toggle="modal" data-target="#loginmodal"><span><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> REPORT</span></a></li>
                        <?php } ?>
                    </ul>
                </span>
                <div style="color:#777; font-size:11px;margin-top:-4px;"><?php echo get_ydhmdatetime($pro_comment->date);?></div>
            </div>
            <p style="margin: 11px 0px 2px 0px;" class="pcomment<?php echo $pro_comment->cid;?>"><?php echo $pro_comment->pro_comment; ?></p>
            <a href="javascript:void(0)" onClick="postReplycomment(<?php echo $pro_comment->cid;?>)" style="color:#de1800;font-size:0.8em;"> REPLY </a>
            <a style="color:#de1800; font-size:0.8em;">I</a>
            <a href="javascript:void(0)" onClick="replycomments(<?php echo $pro_comment->profile_id;?>, <?php echo $pro_comment->cid;?>)" style="color:#de1800;font-size:0.8em;"> 
                <?php $count = get_proreplaycmtcount($pro_comment->profile_id, $pro_comment->cid); ?>
                <span id="repliescount<?php echo $pro_comment->cid;?>"><?php echo $count; ?></span> REPLIES</a>
                <input type="hidden" id="replycmtcount<?php echo $pro_comment->cid;?>" value="<?php echo $count;?>">
                    <div class="input-group postreplycomment<?php echo $pro_comment->cid;?>"></div><!-- add replay comments -->
                    <span class="text-danger addreplaycmt<?php echo $pro_comment->cid;?>"></span>
                <div class="box-comment replycommentslist">
                    <ul id="replycommentresults<?php echo $pro_comment->cid;?>" style="padding-left:10px;list-style:none;margin-top:5px;"></ul>
                    <span class="viewmore<?php echo $pro_comment->cid;?>"></span> 
                </div>
        </div>
        <hr style="margin-top:0px; margin-bottom:8px;">
    </li>
<?php } } ?>