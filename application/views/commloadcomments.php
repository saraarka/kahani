    <?php if(isset($topstory) && ($topstory === 'topstory')){ ?> <!-- From community top stories -->
        <?php if(isset($commloadcomments) && ($commloadcomments->num_rows() > 0)){
            foreach($commloadcomments->result() as $commcomment) { ?>
            <div class="box-footer box-comments editdelete<?php echo $commcomment->id;?>" style="padding-bottom:0;">
    			<div class="box-comment">
    				<?php if(isset($commcomment->profile_image) && !empty($commcomment->profile_image)){ ?>
    				    <img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $commcomment->profile_image;?>" alt="<?php echo ucfirst($commcomment->name);?>">
    				<?php } else { ?>
    				    <img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo ucfirst($commcomment->name);?>">
    				<?php } ?>
            		<div class="comment-text">
						<span class="username" style="padding-top:6px;">&nbsp; <b>
						    <a href="<?php echo base_url().$commcomment->profile_name; ?>">
						        <p class="namers"><?php echo ucfirst($commcomment->name);?></p></a></b>
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
            		<div style="margin:4px 0 6px 2px" class="comment-text">
            		    <?php if(strlen($commcomment->comment) > 200){ ?>
					        <span class="more <?php echo $commcomment->id;?>"><?php echo mb_substr($commcomment->comment, 0, 200); ?>
					            <span class="showhide<?php echo $commcomment->id;?>" style="display:none;word-break:break-word;"><?php echo mb_substr($commcomment->comment,200); ?></span>
					            <span class="smorelessdots<?php echo $commcomment->id;?>">...</span>
					            <u onclick="showhide(<?php echo $commcomment->id;?>)" class="moreless<?php echo $commcomment->id;?>" style="word-break:break-word;cursor: pointer;color:red;">show-more</u></span>
					    <?php } else{ ?>
					        <span class="more <?php echo $commcomment->id;?>" style="word-break:break-word;"><?php echo $commcomment->comment; ?></span>
					    <?php } ?>
						<div style="" class="">
                            <a href="javascript:void(0)" onClick="toppostReplycomment(<?php echo $commcomment->id;?>,<?php echo $commcomment->comm_id;?>,<?php echo $commcomment->story_id;?>)" class="pull-left replycv" title="Reply">REPLY</a>
                            <a href="javascript:void(0)" class="pull-left replycv">I</a>
                            <a href="javascript:void(0)" onClick="toppostdisplayreplies(<?php echo $commcomment->id;?>,<?php echo $commcomment->comm_id;?>,<?php echo $commcomment->story_id;?>)" class="pull-left replycv" title="Replies"> 
                                <span class="told_subcmtcount<?php echo $commcomment->id;?>"><?php echo get_subcmtcount($commcomment->id);?></span> REPLIES</a>
                        </div>
                    </div>
                    <div class="comment-text">
                        <div class="input-group toppostreplycomment<?php echo $commcomment->id;?>" style="width:100%; margin-bottom:5px;"><!-- Reply comment form --></div>
					</div>
            	</div>
            	<div class="topsubcomments" style="display:none;" id="topmysubList<?php echo $commcomment->story_id;?>_<?php echo $commcomment->id;?>">
            	    <center> <span id="topspinnertab<?php echo $commcomment->id;?>">
                        <img src="<?php echo base_url();?>/assets/landing/svg/spinnercomments.svg" class="spinner">
                    </span> </center>
                	<?php $topsubcomments = get_subcomments($commcomment->story_id, $commcomment->id); 
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
            			            <span class="">&nbsp;<b><a href="<?php echo base_url().$topsubcomment->profile_name; ?>">
            			                <p class="namers"><?php echo ucfirst($topsubcomment->name);?></p></a></b>
            			                <span class="dropdown" style="float:right;">
                                            <a href="javascript:void(0);" class="dropdown-toggle elli" data-toggle="dropdown" aria-expanded="true">
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
            			            <!--<?php if(strlen($topsubcomment->comment) > 200){ ?>
                        		        <span class="more pcomment<?php echo $topsubcomment->id;?>" style="padding-left: 6px;word-break:break-word;"><?php echo substr($topsubcomment->comment, 0, 200); ?>
                        		            <span class="showhide<?php echo $topsubcomment->id;?>" style="display:none;"><?php echo substr($topsubcomment->comment,200); ?></span>
                        		            <u onclick="showhide(<?php echo $topsubcomment->id;?>)" class="moreless<?php echo $topsubcomment->id;?>">Read More</u></span>
                        		    <?php } else{ ?>
                        		        <span class="more pcomment<?php echo $topsubcomment->id;?>" style="padding-left: 6px;word-break:break-word;"><?php echo $topsubcomment->comment;?></span>
                        		    <?php } ?> -->
                        		    <?php if(strlen($topsubcomment->comment) > 200){ ?>
            					        <span class="more <?php echo $topsubcomment->id;?>" style="padding-left:10px;"><?php echo mb_substr($topsubcomment->comment, 0, 200); ?>
            					            <span class="showhide<?php echo $topsubcomment->id;?>" style="display:none;word-break:break-word;"><?php echo mb_substr($topsubcomment->comment,200); ?></span>
            					            <span class="smorelessdots<?php echo $topsubcomment->id;?>">...</span>
            					            <u onclick="showhide(<?php echo $topsubcomment->id;?>)" class="moreless<?php echo $topsubcomment->id;?>" style="word-break:break-word;cursor: pointer;color:red;">show-more</u></span>
            					    <?php } else{ ?>
            					        <span class="more <?php echo $topsubcomment->id;?>" style="word-break:break-word;padding-left:10px;"><?php echo $topsubcomment->comment; ?></span>
            					    <?php } ?>
            		            </div>
            		        </span>
    					</div>
					    <?php } $commlastsubcomment = get_commlastsubcomment($commcomment->story_id, $commcomment->id); 
							    if($topsubcomment->id > $commlastsubcomment){ ?>
							<a href="javascript:void(0);">
							    <span class="toploadsubcomment<?php echo $commcomment->id;?>" onClick="topcommloadsubcomment(<?php echo $commcomment->story_id;?>, <?php echo $commcomment->id;?>, <?php echo $topsubcomment->id;?>)">
							        <center>View More</center></span></a>
						    <?php } else{ ?>
						    <span class="loadsubcomment"></span>
						<?php } } ?>
    			</div>
    			
            </div>
        <?php } if($commcomment->id > $commlastcomment){ ?>
            <a href="javascript:void(0);"><span class="toploadmorespan<?php echo $commcomment->story_id;?>" onClick="topcommloadmore(<?php echo $commcomment->story_id;?>, <?php echo $commcomment->id;?>)"><center>View More</center></span></a>
            <?php }else{ ?>
            <span class="loadmorespan"></span>
        <?php } } else { ?>
            <span class="loadmorespan"></span>
        <?php } ?>
        <?php if(isset($commloadsubcomments) && ($commloadsubcomments->num_rows() > 0)){
            foreach($commloadsubcomments->result() as $lsubcomment){ ?>
    		<div class="media editdelete<?php echo $lsubcomment->id;?>" style="padding-left:10px;margin-top:5px;margin-bottom:5px;">
    		    <span class="media-left">
    		        <?php if(isset($lsubcomment->profile_image) && !empty($lsubcomment->profile_image)){ ?>
    		        <img class="img-circle" style="width:25px;" src="<?php echo base_url();?>assets/images/<?php echo $lsubcomment->profile_image;?>" alt="<?php echo ucfirst($lsubcomment->name);?>">
    		        <?php } else { ?>
    		        <img class="img-circle" style="width:25px;" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo ucfirst($lsubcomment->name);?>">
    		        <?php } ?>
    		    </span>
    		        <span class="media-body" style="background:#ddd; padding:5px; border-radius:2px;">
    		            <span class="username" style="padding-left:0px;">&nbsp;
        		            <a href="<?php echo base_url().$lsubcomment->profile_name; ?>">
        		                <p class="namers"><?php echo ucfirst($lsubcomment->name);?></p></a>
    		                <span class="dropdown" style="float:right;">
                                <a href="javascript:void(0);" class="dropdown-toggle elli" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-ellipsis-v"></i> </a> 
                                <ul class="dropdown-menu pull-right">
                                    <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($lsubcomment->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
                                    <li><a href="javascript:void(0);" onClick="editcommcomment(<?php echo $lsubcomment->id;?>);"><span><i class="fa fa-pencil"></i> EDIT</span></a></li>
                                    <li><a href="javascript:void(0);" onClick="deletecommcomment(<?php echo $lsubcomment->id;?>);"><span><i class="fa fa-trash"></i> DELETE</span></a></li>
                                    <?php } else{ ?>
                                    <li><a href="javascript:void(0);" onClick="reportcommcomment(<?php echo $lsubcomment->id;?>, <?php echo $lsubcomment->user_id;?>);"><span><i class="fa fa-exclamation-triangle"></i> REPORT</span></a></li>
                                    <?php } ?>
                                </ul>
                            </span>
    		                <span class="text-muted pull-right datecv"><?php echo get_ydhmdatetime($lsubcomment->date);?></span>
    		            </span>
    		            <!--<?php if(strlen($lsubcomment->comment) > 200){ ?>
            		       <span class="more <?php echo $lsubcomment->id;?>"  style="padding-left: 6px;"><?php echo substr($lsubcomment->comment, 0, 200); ?>
            		            <span class="showhide<?php echo $lsubcomment->id;?>" style="display:none;"><?php echo substr($lsubcomment->comment,200); ?></span>
            		            <u onclick="showhide(<?php echo $lsubcomment->id;?>)" class="moreless<?php echo $lsubcomment->id;?>">Read More</u></span>
            		    <?php } else{ ?>
            		        <span class="more <?php echo $lsubcomment->id;?>"  style="padding-left: 6px;"><?php echo $lsubcomment->comment;?></span>
            		    <?php } ?> -->
            		    <?php if(strlen($lsubcomment->comment) > 200){ ?>
					        <span class="more <?php echo $lsubcomment->id;?>" style="padding-left:10px;"><?php echo mb_substr($lsubcomment->comment, 0, 200); ?>
					            <span class="showhide<?php echo $lsubcomment->id;?>" style="display:none;word-break:break-word;"><?php echo mb_substr($lsubcomment->comment,200); ?></span>
					            <span class="smorelessdots<?php echo $lsubcomment->id;?>">...</span>
					            <u onclick="showhide(<?php echo $lsubcomment->id;?>)" class="moreless<?php echo $lsubcomment->id;?>" style="word-break:break-word;cursor: pointer;color:red;">show-more</u></span>
					    <?php } else{ ?>
					        <span class="more <?php echo $lsubcomment->id;?>" style="word-break:break-word;padding-left:10px;"><?php echo $lsubcomment->comment; ?></span>
					    <?php } ?>
    		       </span>
    		   </div><!--top Posts -->
    	<?php } if($lsubcomment->id > $commlastsubcomment){ ?>
    	    <a href="javascript:void(0);"><span class="toploadsubcomment<?php echo $lsubcomment->comment_id;?>" onClick="topcommloadsubcomment(<?php echo $lsubcomment->story_id;?>, <?php echo $lsubcomment->comment_id;?>, <?php echo $lsubcomment->id;?>)"><center>View More</center></span></a>
    	    <?php }else{ ?>
    	    <span class="loadsubcomment"></span>
    	<?php } } else { ?>
    	    <span class="loadsubcomment"></span>
    	<?php } ?>
    	
    <?php }else{ ?> <!-- From community stories -->
    
        <?php if(isset($commloadcomments) && ($commloadcomments->num_rows() > 0)){
            foreach($commloadcomments->result() as $commcomment) { ?>
            <div class="box-footer box-comments editdelete<?php echo $commcomment->id;?>" style="padding-bottom:0px;">
            	<div class="box-comment">
    				<?php if(isset($commcomment->profile_image) && !empty($commcomment->profile_image)){ ?>
    				<img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $commcomment->profile_image;?>" alt="<?php echo ucfirst($commcomment->name);?>">
    				<?php } else { ?>
    				<img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo ucfirst($commcomment->name);?>">
    				<?php } ?>
    				<div class="comment-text">
    					<span class="username" style="padding-top:6px;">&nbsp; <a href="<?php echo base_url().$commcomment->profile_name; ?>">
    					    <p class="namers"><?php echo ucfirst($commcomment->name);?></p></a>
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
    				<div style="margin:4px 0 6px 2px" class="comment-text">
    				    <!--<?php if(strlen($commcomment->comment) > 200){ ?>
            		       <div class="more <?php echo $commcomment->id;?>"><?php echo substr($commcomment->comment, 0, 200); ?>
            		            <span class="showhide<?php echo $commcomment->id;?>" style="display:none;"><?php echo substr($commcomment->comment,200); ?></span>
            		            <u onclick="showhide(<?php echo $commcomment->id;?>)" class="moreless<?php echo $commcomment->id;?>">Read More</u></div>
            		    <?php } else{ ?>
            		        <div class="more <?php echo $commcomment->id;?>"><?php echo $commcomment->comment; ?></div>
            		    <?php } ?> -->
            		    <?php if(strlen($commcomment->comment) > 200){ ?>
					        <span class="more <?php echo $commcomment->id;?>" style="padding-left:10px;"><?php echo mb_substr($commcomment->comment, 0, 200); ?>
					            <span class="showhide<?php echo $commcomment->id;?>" style="display:none;word-break:break-word;"><?php echo mb_substr($commcomment->comment,200); ?></span>
					            <span class="smorelessdots<?php echo $commcomment->id;?>">...</span>
					            <u onclick="showhide(<?php echo $commcomment->id;?>)" class="moreless<?php echo $commcomment->id;?>" style="word-break:break-word;cursor: pointer;color:red;">show-more</u></span>
					    <?php } else{ ?>
					        <span class="more <?php echo $commcomment->id;?>" style="word-break:break-word;"><?php echo $commcomment->comment; ?></span>
					    <?php } ?>
    					<div style="margin:5px 0;" class="">
                            <a href="javascript:void(0);" onClick="postReplycomment(<?php echo $commcomment->id;?>,<?php echo $commcomment->comm_id;?>,<?php echo $commcomment->story_id;?>)" class="pull-left replycv" title="Reply">REPLY</a> 
                            <a href="javascript:void(0);" class="pull-left replycv">I</a>
                            <a href="javascript:void(0);" onClick="displayreplies(<?php echo $commcomment->id;?>,<?php echo $commcomment->comm_id;?>,<?php echo $commcomment->story_id;?>)" class="pull-left replycv" title="Replies"> 
                                <span class="old_subcmtcount<?php echo $commcomment->id;?>"><?php echo get_subcmtcount($commcomment->id);?></span> REPLIES</a>
                        </div>
    				</div><br>
    				<div class="comment-text">
    				    <div class="input-group postreplycomment<?php echo $commcomment->id;?>" style="margin-bottom:5px;"><!-- Reply comment form --></div>
    				</div>
    			</div><!-- POST -->
            	<div class="subcomments" style="display:none;" id="mysubList<?php echo $commcomment->story_id;?>_<?php echo $commcomment->id;?>">
            	    <center> <span id="spinnertab<?php echo $commcomment->id;?>">
                        <img src="<?php echo base_url();?>/assets/landing/svg/spinnercomments.svg" class="spinner">
                    </span> </center>
                	<?php $subcomments = get_subcomments($commcomment->story_id, $commcomment->id); 
        			    if(isset($subcomments) && ($subcomments->num_rows() > 0)){ foreach($subcomments->result() as $subcomment){ ?>
    					<div class="media editdelete<?php echo $subcomment->id;?>" style="padding-left:10px;margin-top:5px;margin-bottom:5px;">
                		    <span class="media-left">
                		        <?php if(isset($subcomment->profile_image) && !empty($subcomment->profile_image)){ ?>
                		        <img class="img-circle" style="width:25px;" src="<?php echo base_url();?>assets/images/<?php echo $subcomment->profile_image;?>" alt="<?php echo ucfirst($subcomment->name);?>">
                		        <?php } else { ?>
                		        <img class="img-circle" style="width:25px;" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo ucfirst($subcomment->name);?>">
                		        <?php } ?>
                		   </span>
                		    <span class="media-body bodycv">
                		        <div class=""><!--username-->
                		            <span class="">&nbsp;<b><a href="<?php echo base_url().$subcomment->profile_name; ?>">
                		                <p class="namers"><?php echo ucfirst($subcomment->name);?></p></a></b>
                		                <span class="dropdown" style="float:right;">
                                            <a href="javascript:void(0);" class="dropdown-toggle elli" data-toggle="dropdown" aria-expanded="true">
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
                		            <!--<?php if(strlen($subcomment->comment) > 200){ ?>
                        		       <span class="more <?php echo $subcomment->id;?>" style="padding-left:10px;"><?php echo substr($subcomment->comment, 0, 200); ?>
                        		            <span class="showhide<?php echo $subcomment->id;?>" style="display:none;"><?php echo substr($subcomment->comment,200); ?></span>
                        		            <u onclick="showhide(<?php echo $subcomment->id;?>)" class="moreless<?php echo $subcomment->id;?>">Read More</u></div>
                        		    <?php } else{ ?>
                        		        <span class="more <?php echo $subcomment->id;?>" style="padding-left:10px;"><?php echo $subcomment->comment;?></span>
                        		    <?php } ?>-->
                        		    <?php if(strlen($subcomment->comment) > 200){ ?>
								        <span class="more <?php echo $subcomment->id;?>" style="padding-left:10px;"><?php echo mb_substr($subcomment->comment, 0, 200); ?>
								            <span class="showhide<?php echo $subcomment->id;?>" style="display:none;"><?php echo mb_substr($subcomment->comment,200); ?></span>
								            <span class="smorelessdots<?php echo $subcomment->id;?>">...</span>
								            <u onclick="showhide(<?php echo $subcomment->id;?>)" class="moreless<?php echo $subcomment->id;?>" style="cursor: pointer;color:red;">show-more</u></span>
								    <?php } else{ ?>
								        <span class="more <?php echo $subcomment->id;?>" style="padding-left:10px;"><?php echo $subcomment->comment; ?></span>
								    <?php } ?>
                		       </div>
                		   </span>
                		</div>
    					<?php } $commlastsubcomment = get_commlastsubcomment($commcomment->story_id, $commcomment->id); 
                            if($subcomment->id > $commlastsubcomment){ ?>
    					<a href="javascript:void(0);"><span class="loadsubcomment<?php echo $commcomment->id;?>" onClick="commloadsubcomment(<?php echo $commcomment->story_id;?>, <?php echo $commcomment->id;?>, <?php echo $subcomment->id;?>)"><center>View More</center></span></a>
    				    <?php } else{ ?>
    				    <span class="loadsubcomment"></span>
        			<?php } } ?>
    			</div>
    			
            </div> <!-- POST -->
            
        <?php } if($commcomment->id > $commlastcomment){ ?>
            <a href="javascript:void(0);"><span class="loadmorespan<?php echo $commcomment->story_id;?>" onClick="commloadmore(<?php echo $commcomment->story_id;?>, <?php echo $commcomment->id;?>)"><center>View More</center></span></a>
            <?php }else{ ?>
            <span class="loadmorespan"></span>
        <?php } } else { ?>
            <span class="loadmorespan"></span>
        <?php } ?>
        <?php if(isset($commloadsubcomments) && ($commloadsubcomments->num_rows() > 0)){
            foreach($commloadsubcomments->result() as $lsubcomment){ ?>
    		<div class="media editdelete<?php echo $lsubcomment->id;?>" style="padding-left:10px;margin-top:5px;margin-bottom:5px;">
    		    <span class="media-left">
    		        <?php if(isset($lsubcomment->profile_image) && !empty($lsubcomment->profile_image)){ ?>
    		        <img class="img-circle" style="width:25px;" src="<?php echo base_url();?>assets/images/<?php echo $lsubcomment->profile_image;?>" alt="<?php echo ucfirst($lsubcomment->name);?>">
    		        <?php } else { ?>
    		        <img class="img-circle" style="width:25px;" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo ucfirst($lsubcomment->name);?>">
    		        <?php } ?>
    	        </span>
    		        <span class="media-body" style="background:#ddd; padding:5px; border-radius:2px;">
    		            <span class="username" style="padding-left:0px;">&nbsp;<a href="<?php echo base_url().$lsubcomment->profile_name; ?>">
    		                <p class="namers"><?php echo ucfirst($lsubcomment->name);?></p></a>
    		                <span class="dropdown" style="float:right;">
                                <a href="javascript:void(0);" class="dropdown-toggle elli" data-toggle="dropdown" aria-expanded="true">
                                <i class="fa fa-ellipsis-v"></i> </a> 
                                <ul class="dropdown-menu pull-right">
                                    <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($lsubcomment->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
                                    <li><a href="javascript:void(0);" onClick="editcommcomment(<?php echo $lsubcomment->id;?>);"><span><i class="fa fa-pencil"></i> EDIT</span></a></li>
                                    <li><a href="javascript:void(0);" onClick="deletecommcomment(<?php echo $lsubcomment->id;?>);"><span><i class="fa fa-trash"></i> DELETE</span></a></li>
                                    <?php }else{ ?>
                                    <li><a href="javascript:void(0);" onClick="reportcommcomment(<?php echo $lsubcomment->id;?>, <?php echo $lsubcomment->user_id;?>);"><span><i class="fa fa-exclamation-triangle"></i> REPORT</span></a></li>
                                    <?php } ?>
                                </ul>
                            </span>
    		                <span class="text-muted pull-right datecv"><?php echo get_ydhmdatetime($lsubcomment->date);?></span>
    		            </span>
    		            <!-- <?php if(strlen($lsubcomment->comment) > 200){ ?>
            		       <span class="more <?php echo $lsubcomment->id;?>"  style="padding-left: 6px;"><?php echo substr($lsubcomment->comment, 0, 200); ?>
            		            <span class="showhide<?php echo $lsubcomment->id;?>" style="display:none;"><?php echo substr($lsubcomment->comment,200); ?></span>
            		            <u onclick="showhide(<?php echo $lsubcomment->id;?>)" class="moreless<?php echo $lsubcomment->id;?>">Read More</u></div>
            		    <?php } else{ ?>
            		        <span class="more <?php echo $lsubcomment->id;?>"  style="padding-left: 6px;"><?php echo $lsubcomment->comment;?></span>
            		    <?php } ?>-->
            		     <?php if(strlen($lsubcomment->comment) > 200){ ?>
					        <span class="more <?php echo $lsubcomment->id;?>" style="padding-left:10px;"><?php echo mb_substr($lsubcomment->comment, 0, 200); ?>
					            <span class="showhide<?php echo $lsubcomment->id;?>" style="display:none;"><?php echo mb_substr($lsubcomment->comment,200); ?></span>
					            <span class="smorelessdots<?php echo $lsubcomment->id;?>">...</span>
					            <u onclick="showhide(<?php echo $lsubcomment->id;?>)" class="moreless<?php echo $lsubcomment->id;?>" style="cursor: pointer;color:red;">show-more</u></span>
					    <?php } else{ ?>
					        <span class="more <?php echo $lsubcomment->id;?>" style="padding-left:10px;"><?php echo $lsubcomment->comment; ?></span>
					    <?php } ?>
    		       </span>
    		   </div>
    		</div>
    	<?php } if($lsubcomment->id > $commlastsubcomment){ ?>
    	    <a href="javascript:void(0);"><span class="loadsubcomment<?php echo $lsubcomment->comment_id;?>" onClick="commloadsubcomment(<?php echo $lsubcomment->story_id;?>, <?php echo $lsubcomment->comment_id;?>, <?php echo $lsubcomment->id;?>)"><center>View More</center></span></a>
    	    <?php }else{ ?>
    	    <span class="loadsubcomment"></span>
    	<?php } } else { ?>
    	    <span class="loadsubcomment"></span>
    	<?php } ?>
    	
    <?php } ?>