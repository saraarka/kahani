<?php if(isset($get_communities_adout) && !empty($get_communities_adout)) { foreach($get_communities_adout->result() as $row) { ?>
    <div>
        <img src="<?php echo base_url();?>assets/images/<?php echo $row->comm_image; ?>" alt="<?php echo $row->gener; ?>" class="img-responsive" style="min-width:100%; height:auto;">
        <p class="text-justify" style="margin-top:15px;"><?php echo $row->about_communities; ?></p>
    </div>
<?php } } else{ ?>
    <?php if(isset($communities_story_get_likes) && count($communities_story_get_likes) > 0){ ?>
    <div style="padding-top:30px;background:#eeeeee !important;"></div>
	<div id="toploadposts" style="background:#eeeeee;">
		<?php foreach ($communities_story_get_likes as $key) { ?>
		<div class="box box-widget" style="border:1px solid #dddddd; margin-bottom:10px;">
		    <div class="box-header with-border">
				<div class="user-block">
				    <span style="width:40px; height:40px;">
					<?php if(isset($key->profile_image) && !empty($key->profile_image)) { ?>
						<img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $key->profile_image;?>" alt="<?php echo $key->name;?>">
					<?php } else { ?>
						<img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo $key->name;?>">
					<?php } ?>
					</span>
					<span class="username"><a href="<?php echo base_url().$this->uri->segment(1).'/'.$key->profile_name; ?>"><?php echo $key->name;?></a>
					    <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($key->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
					    <!--<span class="dropdown" style="float:right;">
						    <a href="#" class="dropdown-toggle elli" data-toggle="dropdown" title="write" aria-expanded="false">
						        <i class="fa fa-ellipsis-v"></i>
						    </a>
						    <ul class="dropdown-menu pull-right">
			                    <li><a href="javascript:void(0);" onclick="editcomm_post(<?php echo $key->id;?>, <?php echo $key->user_id;?>)"><i class="fa fa-pencil"></i> EDIT </a></li>
			                    <li><a href="javascript:void(0);" onclick="deletecomm_post(<?php echo $key->id;?>, <?php echo $key->user_id;?>)"><i class="fa fa-trash"></i> DELETE </a></li>
			                </ul>
		                </span>-->
		                <?php } else { ?>
		                <span class="dropdown" style="float:right;">
			                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" title="write" aria-expanded="false">
						        <i class="fa fa-ellipsis-v pull-right"></i>
						    </a>
						    <ul class="dropdown-menu pull-right">
			                    <li><a href="javascript:void(0);" class="" style="" onclick="reportcomm_post(<?php echo $key->id;?>, <?php echo $key->user_id;?>)"><i class="fa fa-exclamation-triangle"></i> REPORT </a></li>
			                </ul>
		                </span>
		                <?php } ?>
					</span>
					<span class="description"><?php echo get_ydhmdatetime($key->date);?></span>
				</div>
			</div>
			<?php if(($key->type=='url')) { ?>
				<div class="box-body">
				    <?php if(isset($key->urldescription) && !empty($key->urldescription) && (strlen($key->urldescription) > 200)){ ?>
					    <div class="user-block mb-10"><?php echo mb_substr($key->urldescription, 0, 200); ?>
			                <span class="showhidedesc<?php echo $key->id;?>" style="display:none;"><?php echo mb_substr($key->urldescription,200); ?></span>
			                <span class="smorelessdots<?php echo $key->id;?>">...</span>
			                <u onclick="showhidedesc(<?php echo $key->id;?>)" class="smoreless<?php echo $key->id;?>" style="cursor: pointer;color:red;">show-more</u></div>
					<?php } else if($key->urldescription){ ?>
					    <div class="user-block mb-10"> <?php echo $key->urldescription; ?></div>
					<?php } ?>
					<?php if(!empty($key->title)) { ?>
						<div class="media border-box" style="margin-top:2px;">
							<div class="media-left">
								<a href="<?php echo $key->titleurl;?>" target="_blank">
									<?php if((!empty($key->image) && ($key->type == "url"))) { ?>
								        <img src="<?php echo $key->image;?>" class="media-object img-v" alt="<?php echo ucfirst($key->title);?>">
								    <?php }elseif((!empty($key->image) && ($key->type != "url"))){ ?>
								        <img src="<?php echo base_url();?>assets/images/<?php echo $key->image;?>" class="media-object img-v" alt="<?php echo ucfirst($key->title);?>">
									<?php } else { ?>
									    <img src="<?php echo base_url();?>assets/default/feed_comm.jpeg" class="media-object img-v" alt="<?php echo ucfirst($key->title);?>">
									<?php } ?>
								</a>
							</div>
							<div class="media-body" style="padding-top:15px;">
								<a href="<?php echo $key->titleurl;?>" target="_blank"> 
									<h4 class="media-heading"><b><?php echo ucfirst($key->title);?></b></h4>
								</a>
								<?php if(isset($key->typeoftype) && ($key->typeoftype == 'quotes')){ ?>
    							    <p class="sizep text-justify edittext<?php echo $key->id;?>" style="margin:0px;"><?php echo $key->story;?></p>
    							<?php } else if(strpos($key->story, '<em> Written by <a href=')) { ?>
    							    <p class="edittext<?php echo $key->id;?>" style="margin:0px;"><?php echo $key->story;?></p>
    							<?php } else{ ?>
    							    <?php if(isset($key->story) && (strlen($key->story) > 200)){ ?>
    								    <p class="media-heading text-justify edittext<?php echo $key->id;?>" style="margin:0px;"><?php echo mb_substr($key->story, 0, 200); ?>
    						                <span class="showhidedesc<?php echo $key->id;?>" style="display:none;"><?php echo mb_substr($key->story,200); ?></span>
    						                <span class="smorelessdots<?php echo $key->id;?>">...</span>
    						                <u onclick="showhidedesc(<?php echo $key->id;?>)" class="smoreless<?php echo $key->id;?>" style="cursor: pointer;color:red;">show-more</u></p>
    								<?php } else{ ?>
    								    <p class="media-heading text-justify edittext<?php echo $key->id;?>" style="margin:0px;"><?php echo $key->story;?></p>
    								<?php } ?>
    							<?php } ?>
							</div>
						</div>
					<?php } else { ?>
						<?php if(isset($key->typeoftype) && ($key->typeoftype == 'quotes')){ ?>
    					    <p class="sizep text-justify edittext<?php echo $key->id;?>" style="margin:0px;"><?php echo $key->story;?></p>
    					<?php } else if(strpos($key->story, '<em> Written by <a href=')) { ?>
    					    <p class="edittext<?php echo $key->id;?>" style="margin:0px;"><?php echo $key->story;?></p>
    					<?php } else{ ?>
    					    <?php if(isset($key->story) && !empty($key->story)){ ?> 
    					    <?php if (strlen($key->story) > 200){ ?>
    						    <p class="text-justify edittext<?php echo $key->id;?>" style="margin:0px;"><?php echo mb_substr($key->story, 0, 200); ?>
    				                <span class="showhidedesc<?php echo $key->id;?>" style="display:none;"><?php echo mb_substr($key->story,200); ?></span>
    				                <span class="smorelessdots<?php echo $key->id;?>">...</span>
    				                <u onclick="showhidedesc(<?php echo $key->id;?>)" class="smoreless<?php echo $key->id;?>" style="cursor: pointer;color:red;">show-more</u></p>
    						<?php } else{ ?>
    						    <p class="text-justify edittext<?php echo $key->id;?>" style="margin:0px;"><?php echo $key->story;?></p>
    						<?php } } ?>
    					<?php } ?>
					<?php } ?>
				</div>
		    <?php } else { ?>
				<div class="box-body">
				    <?php if(isset($key->urldescription) && !empty($key->urldescription)){
    			        if(strlen($key->urldescription) > 200){ ?>
    				    <div class="user-block mb-10"><?php echo mb_substr($key->urldescription, 0, 200); ?>
    		                <span class="showhidedesc<?php echo $key->id;?>" style="display:none;"><?php echo mb_substr($key->urldescription,200); ?></span>
    		                <span class="smorelessdots<?php echo $key->id;?>">...</span>
    		                <u onclick="showhidedesc(<?php echo $key->id;?>)" class="smoreless<?php echo $key->id;?>" style="cursor: pointer;color:red;">show-more</u></div>
    				<?php } else if($key->urldescription){ ?>
    				    <div class="user-block mb-10"> <?php echo $key->urldescription; ?></div>
    				<?php } } ?>
                											
					<?php if(isset($key->typeoftype) && ($key->typeoftype == 'quotes')){ ?>
					    <p class="sizep text-justify edittext<?php echo $key->id;?>" style="margin:0px;"><?php echo $key->story;?></p>
					<?php } else if(strpos($key->story, '<em> Written by <a href=')) { ?>
					    <p class="edittext<?php echo $key->id;?>" style="margin:0px;"><?php echo $key->story;?></p>
					<?php } else{ ?>
					    <?php if(isset($key->story) && !empty($key->story)){ ?> 
					    <?php if (strlen($key->story) > 200){ ?>
						    <p class="text-justify edittext<?php echo $key->id;?>" style="margin:0px;line-height: 1.85em;    font-size: 1.2em;"><?php echo mb_substr($key->story, 0, 200); ?>
				                <span class="showhidedesc<?php echo $key->id;?>" style="display:none;"><?php echo mb_substr($key->story,200); ?></span>
				                <span class="smorelessdots<?php echo $key->id;?>">...</span>
				                <u onclick="showhidedesc(<?php echo $key->id;?>)" class="smoreless<?php echo $key->id;?>" style="cursor: pointer;color:red;">show-more</u></p>
						<?php } else{ ?>
						    <p class="text-justify edittext<?php echo $key->id;?>" style="margin:0px;line-height: 1.85em;font-size: 1.2em;"><?php echo $key->story;?></p>
						<?php } } ?>
					<?php } ?>
    			</div>
			<?php } ?>
			<div class="box-body">
				<?php if(isset($commstory_likes) && in_array($key->id, $commstory_likes)) { ?>
				    <button class="btn btn-default btn-xs unlike<?php echo $key->id;?>" onclick="tpostunlikestory(<?php echo $key->id;?>)" style="background:none; color:#337ab7;"><i class="fa fa-thumbs-up"></i> Like</button>
				<?php } else { ?>
				    <button class="btn btn-default btn-xs like<?php echo $key->id;?>" onclick="tpostlikestory(<?php echo $key->id;?>)" style="background:none;"><i class="fa fa-thumbs-up"></i> Like</button>
				<?php } ?>
    			<span style="padding-left:5px;" onclick="commusocialshare(<?php echo $key->id;?>, '<?php echo preg_replace("~[^\p{M}\w]+~u", '-', $communitie_about); ?>');">
				    <a data-toggle="modal" data-target="#soc" style="color:#333;cursor:pointer;"><i class="fa fa-share"></i> Share</a>
				</span>
				<span class="pull-right text-muted" onClick="tcomments(<?php echo $key->id;?>);">
					<span id="told_like<?php echo $key->id;?>"><?php echo $key->likes; ?></span><span id="tnew_like"></span> Likes &nbsp; 
					<?php $commentcount = 0; if(isset($comm_comment_count) && ($comm_comment_count->num_rows()>0)) {
						foreach($comm_comment_count->result() as $reviews2) { 
							if($reviews2->story_id == $key->id) {
								$commentcount = $reviews2->commentcount;
							} ?>
					<?php } } ?><span id="old_cmt<?php echo $key->id;?>" style="cursor:pointer"><?php echo $commentcount; ?> </span> Comments
				</span>
			</div>
			
			<!-- /.box-footer -->
			<div class="box-footer">
				<div id="tpostscommunity_commentpost<?php echo $key->id; ?>">
					<?php if (isset($this->session->userdata['logged_in'])) { 
					    if(isset($this->session->userdata['logged_in']['profile_image']) && 
					        !empty($this->session->userdata['logged_in']['profile_image'])) { ?>
						<img src="<?php echo base_url().'assets/images/'.$this->session->userdata['logged_in']['profile_image']; ?>" style="width: 47px;height: 37px; margin-right:10px;" class="img-responsive img-circle img-sm" alt="<?php echo $this->session->userdata['logged_in']['name'];?>">
					<?php } else { ?>
						<img src="<?php echo base_url();?>assets/images/2.png" style="width: 47px;height:37px; margin-right:10px;" class="img-responsive img-circle img-sm" alt="User Image">
					<?php } } ?>
					<div class="input-group">
					    <input type="hidden" name="tstory_id" value="<?php echo $key->id; ?>">
						<input type="text" name="tcomment" placeholder="Type Comment Message ..." class="form-control" required="">
						<input type="hidden" name="tcomm_id" value="<?php echo $commuid; ?>">
						<span class="input-group-btn">
							<button type="submit" class="btn btn-success btn-flat btnspinner<?php echo $key->id;?>" onclick="tpostscomm_comments(<?php echo $key->id;?>)"> Comment </button>
						</span>
					</div>
				</div>
			</div>
			<!-- /.box-footer -->        					
            <div class="box-comments box-footer tajaxcomment<?php echo $key->id;?>" style="padding-bottom:0px;border:0px;"> </div>
			<?php $comments = get_comments($key->id);
				if(isset($comments) && ($comments->num_rows()>0)) { ?>
				<div id="topmyList<?php echo $key->id;?>" style="display: none;">
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
									    <a href="<?php echo base_url().$this->uri->segment(1).'/'.$comment->profile_name;?>"><?php echo ucfirst($comment->name);?></a>
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
                                        <a href="javascript:void(0)" onClick="toppostReplycomment(<?php echo $comment->id;?>,<?php echo $comment->comm_id;?>,<?php echo $comment->story_id;?>)" class="pull-left replycv" title="Reply">REPLY</a>
                                        <a href="javascript:void(0);" class="pull-left replycv"> I</a>
                                        <a href="javascript:void(0)" onClick="toppostdisplayreplies(<?php echo $comment->id;?>,<?php echo $comment->comm_id;?>,<?php echo $comment->story_id;?>)" class="pull-left replycv" title="Replies"> 
                                            <span class="told_subcmtcount<?php echo $comment->id;?>"><?php echo get_subcmtcount($comment->id);?></span> REPLIES</a>
                                    </div>
								</div><br>
								<div class="comment-text">
								    <div class="input-group toppostreplycomment<?php echo $comment->id;?>" style="margin-bottom:5px;"><!-- Reply comment form --></div>
								</div>
							</div>
							
							<div class="topsubcomments" style="display:none;" id="topmysubList<?php echo $key->id;?>_<?php echo $comment->id;?>">
							    <center> <span id="topspinnertab<?php echo $comment->id;?>">
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
									            <span class="">&nbsp;<b>
									                <a href="<?php echo base_url().$this->uri->segment(1).'/'.$subcomment->profile_name; ?>"><?php echo ucfirst($subcomment->name);?></a></b>
									                <span class="dropdown pull-right">
                                                        <a href="javascript:void(0);" class="dropdown-toggle elli" data-toggle="dropdown" aria-expanded="true" style="padding: 0px 10px 0px 20px;">
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
									<a href="javascript:void(0);"><span class="toploadsubcomment<?php echo $comment->id;?>" onClick="topcommloadsubcomment(<?php echo $key->id;?>, <?php echo $comment->id;?>, <?php echo $subcomment->id;?>)"><center>View More</center></span></a>
								    <?php } else{ ?>
								    <span class="toploadsubcomment"></span>
								<?php } } ?>
							</div>
						</div>
				    <?php } $commlastcomment = get_commlastcomment($key->id); if($comment->id > $commlastcomment){ ?>
			        <a href="javascript:void(0);"><span class="toploadmorespan<?php echo $key->id;?>" onClick="topcommloadmore(<?php echo $key->id;?>, <?php echo $comment->id;?>)"><center>View More</center></span></a>
			        <?php } else{ ?>
			        <span class="toploadmorespan"></span>
			        <?php } ?>
			    </div>
			<?php } ?>
	    </div>
		<!-- /.box-footer -->
	    <?php } ?>
	</div>
	<div id="tload_data_message"></div>
	<?php } ?>
<?php } ?>
<script>
    $(document).ready(function(){
        var tlimit = 6;
        var tstart = 6;
        var taction = 'inactive';
        function tload_country_data(tlimit, tstart) {
            var commuid = "<?php echo $commuid;?>";
            var communitie_about = $.trim($('h4#communitie_about').text());
            $.ajax({
                url:'<?php echo base_url().$this->uri->segment(1);?>/toploadcommustories/'+commuid,
                method:"POST",
                data:{limit:tlimit, start:tstart, 'communitie_about':communitie_about},
                cache:false,
                success:function(data){
                    $('#toploadposts').append(data);
                    if(data == '') {
                        $('#tload_data_message').html("<center><div class='col-md-12' style='padding-top:20px;'> No More Results!</div></center>");
                        taction = 'active';
                    }else{
                        $('#tload_data_message').html("<center><div class='col-md-12' style='padding-top:20px;'> Loading ...</div></center>");
                        taction = "inactive";
                    }
                }
            });
        }
        if(taction == 'inactive') {
            taction = 'active';
            tload_country_data(tlimit, tstart);
        } 
        $(window).scroll(function(){
            if ($(window).scrollTop() >= (($("#toploadposts").height() - $(window).height())*0.6) && taction == 'inactive'){
                taction = 'active';
                tstart = tstart + tlimit;
                setTimeout(function(){tload_country_data(tlimit, tstart);}, 10);
            }
        });
    });
</script>