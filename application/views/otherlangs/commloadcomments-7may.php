    <?php if(isset($topstory) && ($topstory === 'topstory')){ ?> <!-- From community top stories -->
        <?php if(isset($commloadcomments) && ($commloadcomments->num_rows() > 0)){
            foreach($commloadcomments->result() as $commcomment) { ?>
            <div class="box-footer box-comments editdelete<?php echo $commcomment->id;?>">
    			<div class="box-comment">
    				<?php if(isset($commcomment->profile_image) && !empty($commcomment->profile_image)){ ?>
    				    <img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $commcomment->profile_image;?>" alt="<?php echo ucfirst($commcomment->name);?>">
    				<?php } else { ?>
    				    <img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo ucfirst($commcomment->name);?>">
    				<?php } ?>
            		<div class="comment-text">
						<span class="username" style="padding-top:6px;">&nbsp; <b>
						    <a href="<?php echo base_url().$this->uri->segment(1).'/'.$commcomment->profile_name;?>"><?php echo ucfirst($commcomment->name);?></a></b>
						    <span class="dropdown" style="float:right;">
                                <a href="javascript:void(0);" class="dropdown-toggle elli" data-toggle="dropdown" aria-expanded="true">
                                 <i class="fa fa-ellipsis-v"></i> </a> 
                                <ul class="dropdown-menu pull-right">
                                    <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($commcomment->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
                                    <li><a href="javascript:void(0);" onClick="editcommcomment(<?php echo $commcomment->id;?>);"><span><i class="fa fa-pencil"></i> EDIT</span></a></li>
                                    <li><a href="javascript:void(0);" onClick="deletecommcomment(<?php echo $commcomment->id;?>);"><span><i class="fa fa-trash"></i> DELETE</span></a></li>
                                    <?php }else{ ?>
                                    <li><a href="javascript:void(0);" onClick="reportcommcomment(<?php echo $commcomment->id;?>, <?php echo $commcomment->user_id;?>);"><span><i class="fa fa-exclamation-triangle"></i> REPORT</span></a></li>
                                    <?php } ?>
                                </ul>
                            </span>
							<span class="text-muted pull-right datecv"><?php echo get_ydhmdatetime($commcomment->date);?></span>
						</span>
					</div>
            		<div style="margin:8px 0 6px 2px" class="comment-text">
						<div style="word-break:break-word;" class="more pcomment<?php echo $commcomment->id;?>"><?php echo $commcomment->comment;?></div>
						<div style="" class="">
                            <a href="javascript:void(0)" onClick="toppostReplycomment(<?php echo $commcomment->id;?>,<?php echo $commcomment->comm_id;?>,<?php echo $commcomment->story_id;?>)" class="pull-left replycv" title="Reply">REPLY</a> 
                            <a href="javascript:void(0)" onClick="toppostdisplayreplies(<?php echo $commcomment->id;?>,<?php echo $commcomment->comm_id;?>,<?php echo $commcomment->story_id;?>)" class="pull-left replycv" title="Replies">| 
                                <span class="told_subcmtcount<?php echo $commcomment->id;?>"><?php echo get_subcmtcount($commcomment->id);?></span> REPLIES</a>
                        </div>
                    </div><br>
                    <div class="comment-text">
                        <div class="input-group toppostreplycomment<?php echo $commcomment->id;?>" style="margin-bottom:5px;"><!-- Reply comment form --></div>
					</div>
            	</div>
            	<div class="topsubcomments" style="margin-bottom:10px;display:none;" id="topmysubList<?php echo $commcomment->story_id;?>_<?php echo $commcomment->id;?>">
                	<?php $topsubcomments = get_subcomments($commcomment->story_id, $commcomment->id); 
        			    if(isset($topsubcomments) && ($topsubcomments->num_rows() > 0)){ foreach($topsubcomments->result() as $topsubcomment){ ?>
    					<div class="media editdelete<?php echo $topsubcomment->id;?>" style="margin-bottom:10px;">
					        <span class="media-left">
						        <?php if(isset($topsubcomment->profile_image) && !empty($topsubcomment->profile_image)){ ?>
						        <img class="img-circle" style="width:25px;" src="<?php echo base_url();?>assets/images/<?php echo $topsubcomment->profile_image;?>" alt="<?php echo ucfirst($topsubcomment->name);?>">
						        <?php } else { ?>
						        <img class="img-circle" style="width:25px;" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo ucfirst($topsubcomment->name);?>">
						        <?php } ?>
						    </span>
					        <span class="media-body bodycv">
            		            <div class="">
            			            <span class="">&nbsp;<b>
            			                <a href="<?php echo base_url().$this->uri->segment(1).'/'.$topsubcomment->profile_name;?>"><?php echo ucfirst($topsubcomment->name);?></a></b>
            			                <span class="dropdown" style="float:right;">
                                            <a href="javascript:void(0);" class="dropdown-toggle elli" data-toggle="dropdown" aria-expanded="true" style="padding: 0px 10px 0px 20px;">
                                             <i class="fa fa-ellipsis-v"></i> </a> 
                                            <ul class="dropdown-menu pull-right">
                                                <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($topsubcomment->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
                                                <li><a href="javascript:void(0);" onClick="editcommcomment(<?php echo $topsubcomment->id;?>);"><span><i class="fa fa-pencil"></i> EDIT</span></a></li>
                                                <li><a href="javascript:void(0);" onClick="deletecommcomment(<?php echo $topsubcomment->id;?>);"><span><i class="fa fa-trash"></i> DELETE</span></a></li>
                                                <?php } else{ ?>
                                                <li><a href="javascript:void(0);" onClick="reportcommcomment(<?php echo $topsubcomment->id;?>, <?php echo $topsubcomment->user_id;?>);"><span><i class="fa fa-exclamation-triangle"></i> REPORT</span></a></li>
                                                <?php } ?>
                                            </ul>
                                        </span>
            			                <span class="text-muted pull-right datecv"><?php echo get_ydhmdatetime($topsubcomment->date);?></span>
            			            </span><br>
            			            <span class="more pcomment<?php echo $topsubcomment->id;?>" style="padding-left: 6px;word-break:break-word;"><?php echo $topsubcomment->comment;?></span>
            		            </div>
            		        </span>
    					</div>
					    <?php } $commlastsubcomment = get_commlastsubcomment($commcomment->story_id, $commcomment->id); 
							    if($topsubcomment->id > $commlastsubcomment){ ?>
							<a href="javascript:void(0);">
							    <span class="toploadsubcomment<?php echo $commcomment->id;?>" onClick="topcommloadsubcomment(<?php echo $commcomment->story_id;?>, <?php echo $commcomment->id;?>, <?php echo $topsubcomment->id;?>)">
							        <center>Read More...</center></span></a>
						    <?php } else{ ?>
						    <span class="loadsubcomment"></span>
						<?php } } ?>
    			</div>
    			
            </div>
        <?php } if($commcomment->id > $commlastcomment){ ?>
            <a href="javascript:void(0);"><span class="toploadmorespan<?php echo $commcomment->story_id;?>" onClick="topcommloadmore(<?php echo $commcomment->story_id;?>, <?php echo $commcomment->id;?>)"><center>Read More...</center></span></a>
            <?php }else{ ?>
            <span class="loadmorespan"></span>
        <?php } } else { ?>
            <span class="loadmorespan"></span>
        <?php } ?>
        <?php if(isset($commloadsubcomments) && ($commloadsubcomments->num_rows() > 0)){
            foreach($commloadsubcomments->result() as $lsubcomment){ ?>
    		<div class="media editdelete<?php echo $lsubcomment->id;?>">
    		    <span class="media-left">
    		        <?php if(isset($lsubcomment->profile_image) && !empty($lsubcomment->profile_image)){ ?>
    		        <img class="img-circle" style="width:25px;" src="<?php echo base_url();?>assets/images/<?php echo $lsubcomment->profile_image;?>">
    		        <?php } else { ?>
    		        <img class="img-circle" style="width:25px;" src="<?php echo base_url();?>assets/images/2.png" alt="User Image">
    		        <?php } ?>
    		    </span>
    		        <span class="media-body" style="background:#ddd; padding:5px; border-radius:2px;">
    		            <span class="username">&nbsp;
    		            <a href="<?php echo base_url().$this->uri->segment(1).'/'.$lsubcomment->profile_name;?>"><?php echo ucfirst($lsubcomment->name);?></a>
    		                <span class="pull-right">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" style="padding: 0px 10px 0px 20px;">
                                 <i class="fa fa-ellipsis-v"></i> </a> 
                                <ul class="dropdown-menu writemenu" style="top:auto; width:fit-content;">
                                    <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($lsubcomment->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
                                    <li><a href="javascript:void(0);" onClick="editcommcomment(<?php echo $lsubcomment->id;?>);"><span><i class="fa fa-pencil"></i> EDIT</span></a></li>
                                    <li><a href="javascript:void(0);" onClick="deletecommcomment(<?php echo $lsubcomment->id;?>);"><span><i class="fa fa-trash"></i> DELETE</span></a></li>
                                    <?php } else{ ?>
                                    <li><a href="javascript:void(0);" onClick="reportcommcomment(<?php echo $lsubcomment->id;?>, <?php echo $lsubcomment->user_id;?>);"><span><i class="fa fa-exclamation-triangle"></i> REPORT</span></a></li>
                                    <?php } ?>
                                </ul>
                            </span>
    		                <span class="text-muted pull-right" style="font-weight:300; font-size:0.9em;"><?php echo get_ydhmdatetime($lsubcomment->date);?></span>
    		            </span>
    		            <span class="more <?php echo $lsubcomment->id;?>"  style="padding-left: 6px;"><?php echo $lsubcomment->comment;?></span>
    		       </span>
    		   </div><!--top Posts -->
    	<?php } if($lsubcomment->id > $commlastsubcomment){ ?>
    	    <a href="javascript:void(0);"><span class="toploadsubcomment<?php echo $lsubcomment->comment_id;?>" onClick="topcommloadsubcomment(<?php echo $lsubcomment->story_id;?>, <?php echo $lsubcomment->comment_id;?>, <?php echo $lsubcomment->id;?>)"><center>Read More...</center></span></a>
    	    <?php }else{ ?>
    	    <span class="loadsubcomment"></span>
    	<?php } } else { ?>
    	    <span class="loadsubcomment"></span>
    	<?php } ?>
    	
    <?php }else{ ?> <!-- From community stories -->
    
        <?php if(isset($commloadcomments) && ($commloadcomments->num_rows() > 0)){
            foreach($commloadcomments->result() as $commcomment) { ?>
            <div class="box-footer box-comments editdelete<?php echo $commcomment->id;?>" style="padding-left:10px;">
            	<div class="box-comment">
    				<?php if(isset($commcomment->profile_image) && !empty($commcomment->profile_image)){ ?>
    				<img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $commcomment->profile_image;?>" alt="<?php echo ucfirst($commcomment->name);?>">
    				<?php } else { ?>
    				<img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo ucfirst($commcomment->name);?>">
    				<?php } ?>
    				<div class="comment-text">
    					<span class="username" style="padding-top:6px;">&nbsp; 
    					<a href="<?php echo base_url().$this->uri->segment(1).'/'.$commcomment->profile_name;?>"><?php echo ucfirst($commcomment->name);?></a>
    						<span class="dropdown" style="float:right;">
                                <a href="javascript:void(0);" class="dropdown-toggle elli" data-toggle="dropdown" aria-expanded="true">
                                 <i class="fa fa-ellipsis-v"></i> </a> 
                                <ul class="dropdown-menu pull-right">
                                    <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($commcomment->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
                                    <li><a href="javascript:void(0);" onClick="editcommcomment(<?php echo $commcomment->id;?>);"><span><i class="fa fa-pencil"></i> EDIT</span></a></li>
                                    <li><a href="javascript:void(0);" onClick="deletecommcomment(<?php echo $commcomment->id;?>);"><span><i class="fa fa-trash"></i> DELETE</span></a></li>
                                    <?php } else{ ?>
                                    <li><a href="javascript:void(0);" onClick="reportcommcomment(<?php echo $commcomment->id;?>,<?php echo $commcomment->user_id;?>);"><span><i class="fa fa-exclamation-triangle"></i> REPORT</span></a></li>
                                    <?php } ?>
                                </ul>
                            </span>
    						<span class="text-muted pull-right datecv"><?php echo get_ydhmdatetime($commcomment->date);?></span>
    					</span>
    				</div>
    				<div style="margin:8px 0 6px 2px" class="comment-text">
    				    <div class="more <?php echo $commcomment->id;?>"><?php echo $commcomment->comment; ?></div>
    					<div style="margin:5px 0;" class="">
                            <a href="javascript:void(0)" onClick="postReplycomment(<?php echo $commcomment->id;?>,<?php echo $commcomment->comm_id;?>,<?php echo $commcomment->story_id;?>)" class="pull-left replycv" title="Reply">REPLY</a> 
                            <a href="javascript:void(0)" onClick="displayreplies(<?php echo $commcomment->id;?>,<?php echo $commcomment->comm_id;?>,<?php echo $commcomment->story_id;?>)" class="pull-left replycv" title="Replies">| 
                                <span class="old_subcmtcount<?php echo $commcomment->id;?>"><?php echo get_subcmtcount($commcomment->id);?></span> REPLIES</a>
                        </div>
    				</div><br>
    				<div class="comment-text">
    				    <div class="input-group postreplycomment<?php echo $commcomment->id;?>" style="margin-bottom:5px;"><!-- Reply comment form --></div>
    				</div>
    			</div><!-- POST -->
            	<div class="subcomments" style="margin-bottom:10px;display:none;" id="mysubList<?php echo $commcomment->story_id;?>_<?php echo $commcomment->id;?>">
                	<?php $subcomments = get_subcomments($commcomment->story_id, $commcomment->id); 
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
                		            <span class="">&nbsp;<b>
                		                <a href="<?php echo base_url().$this->uri->segment(1).'/'.$subcomment->profile_name;?>"><?php echo ucfirst($subcomment->name);?></a></b>
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
                		            <span class="more <?php echo $subcomment->id;?>" style="padding-left:10px;"><?php echo $subcomment->comment;?></span>
                		       </div>
                		   </span>
                		</div>
    					<?php } $commlastsubcomment = get_commlastsubcomment($commcomment->story_id, $commcomment->id); 
                            if($subcomment->id > $commlastsubcomment){ ?>
    					<a href="javascript:void(0);"><span class="loadsubcomment<?php echo $commcomment->id;?>" onClick="commloadsubcomment(<?php echo $commcomment->story_id;?>, <?php echo $commcomment->id;?>, <?php echo $subcomment->id;?>)"><center>Read More...</center></span></a>
    				    <?php } else{ ?>
    				    <span class="loadsubcomment"></span>
        			<?php } } ?>
    			</div>
    			
            </div> <!-- POST -->
            
        <?php } if($commcomment->id > $commlastcomment){ ?>
            <a href="javascript:void(0);"><span class="loadmorespan<?php echo $commcomment->story_id;?>" onClick="commloadmore(<?php echo $commcomment->story_id;?>, <?php echo $commcomment->id;?>)"><center>Read More...</center></span></a>
            <?php }else{ ?>
            <span class="loadmorespan"></span>
        <?php } } else { ?>
            <span class="loadmorespan"></span>
        <?php } ?>
        <?php if(isset($commloadsubcomments) && ($commloadsubcomments->num_rows() > 0)){
            foreach($commloadsubcomments->result() as $lsubcomment){ ?>
    		<div class="media editdelete<?php echo $lsubcomment->id;?>" style="padding-bottom:0px;">
    		    <span class="media-left" style="padding-left:10px;">
    		        <?php if(isset($lsubcomment->profile_image) && !empty($lsubcomment->profile_image)){ ?>
    		        <img class="img-circle" style="width:25px;" src="<?php echo base_url();?>assets/images/<?php echo $lsubcomment->profile_image;?>">
    		        <?php } else { ?>
    		        <img class="img-circle" style="width:25px;" src="<?php echo base_url();?>assets/images/2.png" alt="User Image">
    		        <?php } ?>
    	        </span>
    		        <span class="media-body" style="background:#ddd; padding:5px; border-radius:2px;">
    		            <span class="username">&nbsp;
    		                <a href="<?php echo base_url().$this->uri->segment(1).'/'.$lsubcomment->profile_name;?>"><?php echo ucfirst($lsubcomment->name);?></a>
    		                <span class="pull-right">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" style="padding: 0px 10px 0px 20px;">
                                 <i class="fa fa-ellipsis-v"></i> </a> 
                                <ul class="dropdown-menu writemenu" style="top:auto; width:fit-content;">
                                    <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($lsubcomment->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
                                    <li><a href="javascript:void(0);" onClick="editcommcomment(<?php echo $lsubcomment->id;?>);"><span><i class="fa fa-pencil"></i> EDIT</span></a></li>
                                    <li><a href="javascript:void(0);" onClick="deletecommcomment(<?php echo $lsubcomment->id;?>);"><span><i class="fa fa-trash"></i> DELETE</span></a></li>
                                    <?php }else{ ?>
                                    <li><a href="javascript:void(0);" onClick="reportcommcomment(<?php echo $lsubcomment->id;?>, <?php echo $lsubcomment->user_id;?>);"><span><i class="fa fa-exclamation-triangle"></i> REPORT</span></a></li>
                                    <?php } ?>
                                </ul>
                            </span>
    		                <span class="text-muted pull-right" style="font-weight:300; font-size:0.9em;"><?php echo get_ydhmdatetime($lsubcomment->date);?></span>
    		            </span>
    		            <span class="more <?php echo $lsubcomment->id;?>"  style="padding-left: 6px;"><?php echo $lsubcomment->comment;?></span>
    		       </span>
    		   </div>
    		</div>
    	<?php } if($lsubcomment->id > $commlastsubcomment){ ?>
    	    <a href="javascript:void(0);"><span class="loadsubcomment<?php echo $lsubcomment->comment_id;?>" onClick="commloadsubcomment(<?php echo $lsubcomment->story_id;?>, <?php echo $lsubcomment->comment_id;?>, <?php echo $lsubcomment->id;?>)"><center>Read More...</center></span></a>
    	    <?php }else{ ?>
    	    <span class="loadsubcomment"></span>
    	<?php } } else { ?>
    	    <span class="loadsubcomment"></span>
    	<?php } ?>
    	
    <?php } ?>
    
    
<script>
    $(document).ready(function() {
    var showChar = 150;  // How many characters are shown by default
    var ellipsestext = "...";
    var moretext = "More";
    var lesstext = "Less";
    $('.more').each(function() {
        var content = $(this).html();
        if(content.length > showChar) {
            var c = content.substr(0, showChar);
            var h = content.substr(showChar, content.length - showChar);
            var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
            $(this).html(html);
        }
    });
    $(".morelink").click(function(){
        if($(this).hasClass("less")) {
            $(this).removeClass("less");
            $(this).html(moretext);
        } else {
            $(this).addClass("less");
            $(this).html(lesstext);
        }
        $(this).parent().prev().toggle();
        $(this).prev().toggle();
        return false;
    });
});
</script>
<style>
    .morecontent span {
        display: none;
    }
</style>
    