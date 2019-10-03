<?php if(isset($fsloadcomments) && ($fsloadcomments->num_rows()>0)) { foreach($fsloadcomments->result() as $fsloadcomment){ ?>
	<div class="box-footer box-comments fscommentdelete<?php echo $fsloadcomment->cid;?>" style="padding-bottom:0px;display:block;">
		<div class="box-comment">
			<?php if(isset($fsloadcomment->profile_image) && !empty($fsloadcomment->profile_image)){ ?>
			    <img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $fsloadcomment->profile_image;?>" alt="<?php echo $fsloadcomment->name;?>">
			<?php } else { ?>
			    <img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo $fsloadcomment->name;?>">
			<?php } ?>
			<div class="comment-text">
				<span class="username" style="padding-top:6px;">&nbsp; 
				    <a href="<?php echo base_url().$this->uri->segment(1).'/'.$fsloadcomment->profile_name;?>"><?php echo ucfirst($fsloadcomment->name);?></a>
					<span class="dropdown" style="float:right;">
                        <a href="javascript:void(0);" class="dropdown-toggle elli" data-toggle="dropdown" aria-expanded="true">
                            <i class="fa fa-ellipsis-v"></i> </a> 
                        <ul class="dropdown-menu pull-right">
                            <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($fsloadcomment->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
                            <li><a href="javascript:void(0);" onClick="fseditcomment(<?php echo $fsloadcomment->cid;?>);"><span><i class="fa fa-pencil"></i> EDIT</span></a></li>
                            <li><a href="javascript:void(0);" onClick="fsdeletecomment(<?php echo $fsloadcomment->cid;?>);"><span><i class="fa fa-trash"></i> DELETE</span></a></li>
                            <?php } else{ ?>
                            <li><a href="javascript:void(0);" onClick="fsreportcomment(<?php echo $fsloadcomment->cid;?>,<?php echo $fsloadcomment->user_id;?>);"><span><i class="fa fa-exclamation-triangle"></i> REPORT</span></a></li>
                            <?php } ?>
                        </ul>
                    </span>
                    <span class="text-muted pull-right datecv"><?php echo get_ydhmdatetime($fsloadcomment->date);?></span>
                </span>
            </div>
            <div style="margin:8px 0 6px 2px" class="comment-text">
			    <?php if(strlen($fsloadcomment->comment) > 200){ ?>
    		        <div class="fsmore <?php echo $fsloadcomment->cid;?>" style="word-wrap: break-word;"><?php echo mb_substr($fsloadcomment->comment, 0, 200, 'utf-8'); ?>
    		            <span class="showhide<?php echo $fsloadcomment->cid;?>" style="display:none;"><?php echo mb_substr($fsloadcomment->comment,200, 'utf-8'); ?></span>
    		            <u onclick="showhide(<?php echo $fsloadcomment->cid;?>)" class="moreless<?php echo $fsloadcomment->cid;?>">Read More</u></div>
    		    <?php } else{ ?>
    		        <div class="fsmore <?php echo $fsloadcomment->cid;?>" style="word-wrap: break-word;"><?php echo $fsloadcomment->comment; ?></div>
    		    <?php } ?>
				<div style="margin:5px 0;" class="">
                    <a href="javascript:void(0)" onClick="fspostReplycomment(<?php echo $fsloadcomment->cid;?>,<?php echo $fsloadcomment->story_id;?>)" class="pull-left replycv" title="Reply">REPLY</a> 
                    <a href="javascript:void(0)" onClick="fsdisplayreplies(<?php echo $fsloadcomment->cid;?>,<?php echo $fsloadcomment->story_id;?>)" class="pull-left replycv" title="Replies">| 
                        <span class="fsold_subcmtcount<?php echo $fsloadcomment->cid;?>"><?php echo get_storysubcmtcount($fsloadcomment->cid, $fsloadcomment->story_id); ?></span> REPLIES</a>
                </div>
			</div><br>
			<div class="comment-text">
			    <div class="input-group fspostreplycomment<?php echo $fsloadcomment->cid;?>" style="margin-bottom:5px;"><!-- Reply comment form --></div>
			</div>
		</div>
		<div class="subcomments" style="display:none;" id="fsmysubList<?php echo $fsloadcomment->story_id;?>_<?php echo $fsloadcomment->cid;?>">
			<?php $fssubcomments = get_replaycomments($fsloadcomment->story_id, $fsloadcomment->cid, 2); 
			    if(isset($fssubcomments) && ($fssubcomments->num_rows() > 0)){ foreach($fssubcomments->result() as $fssubcomment){ ?>
				<div class="media fscommentdelete<?php echo $fssubcomment->cid;?>" style="padding-bottom:0px;">
				    <span class="media-left">
				        <?php if(isset($fssubcomment->profile_image) && !empty($fssubcomment->profile_image)){ ?>
				        <img class="img-circle" style="width:25px;" src="<?php echo base_url();?>assets/images/<?php echo $fssubcomment->profile_image;?>" alt="<?php echo $fssubcomment->name;?>">
				        <?php } else { ?>
				        <img class="img-circle" style="width:25px;" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo $fssubcomment->name;?>">
				        <?php } ?>
	                </span>
			        <span class="media-body bodycv">
				        <div class=""><!--username-->
				            <span class="">&nbsp; 
				            <a href="<?php echo base_url().$this->uri->segment(1).'/'.$fssubcomment->profile_name;?>"><?php echo ucfirst($fssubcomment->name);?></a>
				                <span class="pull-right">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" style="padding: 0px 10px 0px 20px;">
                                     <i class="fa fa-ellipsis-v"></i> </a> 
                                    <ul class="dropdown-menu writemenu" style="top:auto; width:fit-content;">
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
						        <span class="fsmore <?php echo $fssubcomment->cid;?>" style="word-wrap: break-word;padding-left:10px;"><?php echo mb_substr($fssubcomment->comment, 0, 200, 'utf-8'); ?>
						            <span class="showhide<?php echo $fssubcomment->cid;?>" style="display:none;"><?php echo mb_substr($fssubcomment->comment,200, 'utf-8'); ?></span>
						            <u onclick="showhide(<?php echo $fssubcomment->cid;?>)" class="moreless<?php echo $fssubcomment->cid;?>">Read More</u></span>
						    <?php } else{ ?>
						        <span class="fsmore <?php echo $fssubcomment->cid;?>" style="word-wrap: break-word;padding-left:10px;"><?php echo $fssubcomment->comment;?></span>
						    <?php } ?>
                        </div>
                    </span>
				 </div>
				<?php } $fslastsubcomment = get_fslastsubcomment($fsloadcomment->story_id, $fsloadcomment->cid); 
				    if($fssubcomment->cid > $fslastsubcomment){ ?>
				<a href="javascript:void(0);"><span class="fsloadsubcomment<?php echo $fsloadcomment->cid;?>" onClick="fsloadsubcomment(<?php echo $fsloadcomment->story_id;?>, <?php echo $fsloadcomment->cid;?>, <?php echo $fssubcomment->cid;?>)"><center>View More</center></span></a>
			    <?php } else{ ?>
			    <span class="fsloadsubcomment"></span>
			<?php } } ?>
		</div>
		
	</div>
    <?php } $fslastcomment = get_fslastcomment($fsloadcomment->story_id); if($fsloadcomment->cid > $fslastcomment){ ?>
    <a href="javascript:void(0);"><span class="fsloadmorespan<?php echo $fsloadcomment->story_id;?>" onClick="fsloadmore(<?php echo $fsloadcomment->story_id;?>, <?php echo $fsloadcomment->cid;?>)"><center>View More</center></span></a>
    <?php } else{ ?>
    <span class="fsloadmorespan"></span>
    <?php } ?>
<?php } elseif(isset($fsloadsubcomments) && ($fsloadsubcomments->num_rows() > 0)){ foreach($fsloadsubcomments->result() as $fsloadsubcomment){ ?>
	<div class="media fscommentdelete<?php echo $fsloadsubcomment->cid;?>" style="padding-bottom:0px;">
	    <span class="media-left">
	        <?php if(isset($fsloadsubcomment->profile_image) && !empty($fsloadsubcomment->profile_image)){ ?>
	        <img class="img-circle" style="width:25px;" src="<?php echo base_url();?>assets/images/<?php echo $fsloadsubcomment->profile_image;?>" alt="<?php echo $fsloadsubcomment->name;?>">
	        <?php } else { ?>
	        <img class="img-circle" style="width:25px;" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo $fsloadsubcomment->name;?>">
	        <?php } ?>
        </span>
        <span class="media-body bodycv">
	        <div class=""><!--username-->
	            <span class="">&nbsp; 
	                <a href="<?php echo base_url().$this->uri->segment(1).'/'.$fsloadsubcomment->profile_name;?>"><?php echo ucfirst($fsloadsubcomment->name);?></a>
	                <span class="pull-right">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" style="padding: 0px 10px 0px 20px;">
                         <i class="fa fa-ellipsis-v"></i> </a> 
                        <ul class="dropdown-menu writemenu" style="top:auto; width:fit-content;">
		                    <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($fsloadsubcomment->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
                            <li><a href="javascript:void(0);" onClick="fseditcomment(<?php echo $fsloadsubcomment->cid;?>);"><span><i class="fa fa-pencil"></i> EDIT</span></a></li>
                            <li><a href="javascript:void(0);" onClick="fsdeletecomment(<?php echo $fsloadsubcomment->cid;?>);"><span><i class="fa fa-trash"></i> DELETE</span></a></li>
                            <?php } else{ ?>
                            <li><a href="javascript:void(0);" onClick="fsreportcomment(<?php echo $fsloadsubcomment->cid;?>, <?php echo $fsloadsubcomment->user_id;?>);"><span><i class="fa fa-exclamation-triangle"></i> REPORT</span></a></li>
                            <?php } ?>
                        </ul>
                    </span>
                    <span class="text-muted pull-right datecv"><?php echo get_ydhmdatetime($fsloadsubcomment->date);?></span>
                </span><br>
	            <?php if(strlen($fsloadsubcomment->comment) > 200){ ?>
			        <span class="fsmore <?php echo $fsloadsubcomment->cid;?>" style="word-wrap: break-word;padding-left:10px;"><?php echo mb_substr($fsloadsubcomment->comment, 0, 200, 'utf-8'); ?>
			            <span class="showhide<?php echo $fsloadsubcomment->cid;?>" style="display:none;"><?php echo mb_substr($fsloadsubcomment->comment,200, 'utf-8'); ?></span>
			            <u onclick="showhide(<?php echo $fsloadsubcomment->cid;?>)" class="moreless<?php echo $fsloadsubcomment->cid;?>">Read More</u></span>
			    <?php } else{ ?>
			        <span class="fsmore <?php echo $fsloadsubcomment->cid;?>" style="word-wrap: break-word;padding-left:10px;"><?php echo $fsloadsubcomment->comment;?></span>
			    <?php } ?>
            </div>
        </span>
	 </div>
	<?php } if($fsloadsubcomment->cid > $fslastsubcomment){ ?>
	<a href="javascript:void(0);"><span class="fsloadsubcomment<?php echo $fsloadsubcomment->comment_id;?>" onClick="fsloadsubcomment(<?php echo $fsloadsubcomment->story_id;?>, <?php echo $fsloadsubcomment->comment_id;?>, <?php echo $fsloadsubcomment->cid;?>)"><center>View More</center></span></a>
    <?php } else{ ?>
    <span class="fsloadsubcomment"></span>
<?php } } ?>