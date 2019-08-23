<?php if(isset($proreply_comments) && ($proreply_comments->num_rows() >0)){ 
    foreach($proreply_comments->result() as $proreply_comment){ ?>
    <li style="margin-bottom:10px;" class="commentdelete<?php echo $proreply_comment->cid;?>">
        <div class="media">
            <div class="media-left" style="padding-right:5px;">
                <?php if(!empty($proreply_comment->profile_image)){ ?>
                    <img src="<?php echo base_url();?>assets/images/<?php echo $proreply_comment->profile_image;?>" style="border-radius: 50%;width:30px !important;height: 30px !important;" alt="<?php echo ucfirst($proreply_comment->name); ?>">
                <?php } else{ ?>
                    <img src="<?php echo base_url();?>assets/images/2.png" style="border-radius: 50%;width:30px !important;height: 30px !important;" alt="<?php echo ucfirst($proreply_comment->name); ?>">
                <?php } ?>
            </div>
            <div class="media-body" style="background-color:#ddd; padding-left:8px; border-radius: 10px; padding-top:5px;">
                <b>
                    <div class="namers">
                        <a href="<?php echo base_url().$proreply_comment->profile_name; ?>"><?php echo ucfirst($proreply_comment->name); ?></a>
                    </div>
                </b>
                <span class="dropdown" style="float:right;">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" title="write" aria-expanded="true" style="padding: 0px 15px;">
                    <i class="fa fa-ellipsis-v"></i></a>
                    <ul class="dropdown-menu pull-right">
                        <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($this->session->userdata['logged_in']['user_id'] == $proreply_comment->user_id)){ ?>
                        <li><a href="javascript:void(0);"><span onClick="editpro_comment(<?php echo $proreply_comment->cid;?>);"><i class="fa fa-pencil"></i> EDIT</span></a></li>
                        <li><a href="javascript:void(0);"><span onClick="deletepro_comment(<?php echo $proreply_comment->cid;?>);"><i class="fa fa-trash"></i> DELETE</span></a></li>
                        <?php }else{ ?>
                        <li><a href="javascript:void(0);"><span onClick="reportpro_comment(<?php echo $proreply_comment->cid;?>, <?php echo $proreply_comment->user_id;?>);"><i class="fa fa-exclamation-triangle"></i> REPORT</span></a></li>
                        <?php } ?>
                    </ul>
                </span>
                <div style="font-size:11px;color: #777;margin-top:-4px;"><?php echo get_ydhmdatetime($proreply_comment->date);?></div>
                <p style="margin: 5px 0px 2px 0px;" class="pcomment<?php echo $proreply_comment->cid;?>"><?php echo $proreply_comment->pro_comment; ?></p>
            </div>
        </div>
    </li> 
<?php } } ?>