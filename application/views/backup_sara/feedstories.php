<?php if(isset($storiesfeed) && ($storiesfeed->num_rows() > 0)){ ?>
    <div id="sloadmoreall">
        <?php foreach ($storiesfeed->result() as $storyfeed) { ?>
        <div class="box box-widget" style="background:#fff; border:1px solid #dddddd;margin-bottom: 10px;">
            <div class="box-header with-border">
        		<div class="user-block">
        			<?php if(isset($storyfeed->profile_image) && !empty($storyfeed->profile_image)) { ?>
        				<img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $storyfeed->profile_image;?>" alt="<?php echo $storyfeed->name;?>">
        			<?php } else { ?>
        				<img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo $storyfeed->name;?>">
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
            		        if(isset($uriseg) && !empty($uriseg) && ($uriseg != 'en')){
            		            $hrefurl = base_url().$this->uri->segment(1).'/story/'.preg_replace('/\s+/', '-', $storyfeed->title).'-'.$storyfeed->sid;
            		        }else{
            		            $hrefurl = base_url().'story/'.preg_replace('/\s+/', '-', $storyfeed->title).'-'.$storyfeed->sid;
            		        }
            		    }elseif($storyfeed->type == 'series'){
            		        if(isset($uriseg) && !empty($uriseg) && ($uriseg != 'en')){
            		            $hrefurl = base_url().$this->uri->segment(1).'/series/'.preg_replace('/\s+/', '-', $storyfeed->title).'-'.$storyfeed->sid.'/'.preg_replace('/\s+/', '-', $storyfeed->title).'-'.$storyfeed->story_id;
            		        }else{
            		            $hrefurl = base_url().'series/'.preg_replace('/\s+/', '-', $storyfeed->title).'-'.$storyfeed->sid.'/'.preg_replace('/\s+/', '-', $storyfeed->title).'-'.$storyfeed->story_id;
            		        }
            		    } ?>
        				<a href="<?php echo $hrefurl;?>" target="_blank">
        					<?php if(!empty($storyfeed->cover_image)) { ?>
        				    <img src="<?php echo base_url();?>assets/images/<?php echo $storyfeed->cover_image;?>" class="media-object img-v" alt="<?php echo $storyfeed->title;?>">
        				    <?php } else { ?>
        					<img src="<?php echo base_url();?>assets/images/1.jpg" class="media-object img-v" alt="<?php echo $storyfeed->title;?>">
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
        	<!--<div class="box-footer">
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
        	</div> -->
        	
        	<!--
        	<div class="box-comments fsajaxcomment<?php echo $storyfeed->sid;?>" style="background: #fff;"> </div>
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
        					    <div class="input-group fspostreplycomment<?php echo $fscomment->cid;?>" style="margin-bottom:5px;"></div>
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
        						        <div class="">
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
            </div> -->
            
        </div>
        <?php } ?>
    </div>
    <div id="sload_data_message"></div>
<?php } ?>