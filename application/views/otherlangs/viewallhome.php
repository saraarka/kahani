<link rel="stylesheet" href="<?php echo base_url();?>assets/css/viewallhome.css">
<?php $readlatersids = get_storiesreadlater('readlater'); ?>
<div class="content-wrapper">
    <section class="content">
        <?php if(isset($viewallhome) && ($viewallhome->num_rows() > 0) && (($this->uri->segment(3) == 'series') || (($this->uri->segment(2) == 'series') && ($this->uri->segment(3) == 'latest')) ) ){ ?>
        <div class="main-container1">
		    <div class="row pt-0">
			    <div class="col-md-12 col-xs-12 pd-0">
			    	<div class="titlei">SERIES</div>
			    </div> 
			</div><hr>
			<div>
		        <div id="loadmoreall"  style="display:flex; flex-wrap:wrap;" class="jsw">
    			<?php foreach($viewallhome->result() as $topseriesrow) { ?>
        			<div class="cardls">
            			<div class="book-typels"><?php echo $topseriesrow->gener;?></div>
            				<a href="<?php echo base_url($this->uri->segment(1).'/series/'.preg_replace("~[^\p{M}\w]+~u", '-', $topseriesrow->title).'-'.$topseriesrow->sid.'/'.preg_replace("~[^\p{M}\w]+~u", '-', $topseriesrow->title).'-'.$topseriesrow->story_id);?>" class="imagesls-style">
                				<?php if(isset($topseriesrow->image) && !empty($topseriesrow->image)) { ?>
                				    <img src="<?php echo base_url();?>assets/images/<?php echo $topseriesrow->image; ?>" alt="<?php echo $topseriesrow->title;?>" class="imagemels">
                				<?php }else{ ?>
                					<img src="<?php echo base_url();?>assets/default/series-stories.jpg" alt="<?php echo $topseriesrow->title;?>" class="imagemels">
                				<?php } ?>
            				</a>
            			<div>
            				<font class="max-linesls">
            					<a href="<?php echo base_url($this->uri->segment(1).'/series/'.preg_replace("~[^\p{M}\w]+~u", '-', $topseriesrow->title).'-'.$topseriesrow->sid.'/'.preg_replace("~[^\p{M}\w]+~u", '-', $topseriesrow->title).'-'.$topseriesrow->story_id);?>">
            						<?php echo $topseriesrow->title;?>
            					</a>
            				</font> 
            			</div>
            			<div class="flextestls">
            				<font class="bynamels">By <font class="nameherels">
            				    <a href="<?php echo base_url($this->uri->segment(1).'/'.$topseriesrow->profile_name);?>" style="color:#000"> <?php echo $topseriesrow->name;?></a></font>
            				</font><br>
            			</div>
            			<div class="flextestls" style="padding-top:4px;">
            				<font class="episodesls">
            					<?php $keycount = get_episodecount($topseriesrow->sid); 
            					if(isset($keycount)){ echo $keycount; }else{ echo 0; }?> EPISODES | <?php $subsmemcount = get_storysubscount($topseriesrow->sid); 
            					if(isset($subsmemcount)){echo $subsmemcount; }else{echo 0; } ?> MEMBERS
            				</font><br>
            			</div>
            			<div class="flextestls" style="padding-top:6px">
            				<?php if(isset($this->session->userdata['logged_in']['user_id']) && ($topseriesrow->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
            					
            						<button class="read" onclick="yoursreadlater();"><i class="fa fa-bookmark"></i> Read later </button>
            					
            				<?php }else{ ?>
            					<?php if(isset($readlatersids) && (sizeof($readlatersids)>0) && in_array($topseriesrow->sid, $readlatersids)) { ?>
            						<button onclick="unreadlater(<?php echo $topseriesrow->sid;?>)" class="readdone notloginmodal readlaterbtnatr<?php echo $topseriesrow->sid;?>">
            						<i class="fa fa-check faicon<?php echo $topseriesrow->sid;?>"></i> Read later </button>
            					<?php }else { ?>
            						<button onclick="readlater(<?php echo $topseriesrow->sid;?>)" class="read notloginmodal readlaterbtnatr<?php echo $topseriesrow->sid;?>">
            						<i class="fa fa-bookmark faicon<?php echo $topseriesrow->sid;?>"></i> Read later </button>
            					<?php } ?>
            				<?php } ?>
            				
            				<button type="button" class="btn read dropdown-toggle pull-right" data-toggle="dropdown">
            					<span class=""><i class="fa fa-plus"></i></span>
            				</button>
            				<ul class="dropdown-menu list-inline dropvk">
            					<li onclick="groupsuggest(<?php echo $topseriesrow->sid; ?>);">
            						<a href="javascript:void(0);" data-toggle="modal" data-target="#groupsuggest" title="COMMUNITY"><i class="fa fa-users"></i></a>
            					</li>
            					<li onclick="friend(<?php echo $topseriesrow->sid;?>);">
            						<a href="javascript:void(0);" data-toggle="modal" data-target="#friendsuggest" title="SUGGEST"><i class="fa fa-user"></i></a>
            					</li>
            					<li onclick="socialshare(<?php echo $topseriesrow->sid;?>, 'series');">
									<a data-toggle="modal" data-target="#soc" href="javascript:void(0);" title="SOCIAL">
										<i class="fa fa-share-alt"></i>
									</a>
								</li>
            				</ul>
            			</div>
        					
        	</div>
        			<!-- /.col -->
    			<?php } ?>
    			</div>
            </div>
        </div>
        <?php } else if(isset($viewallhome) && ($viewallhome->num_rows() > 0) && (($this->uri->segment(3) == 'story') || (($this->uri->segment(2) == 'stories') && ($this->uri->segment(3) == 'latest')) ) ){ ?>
        <div class="main-container1">
		    <div class="row pt-0">
			    <div class="col-md-12 col-xs-12 pd-0">
			    	<div class="titlei">STORIES</div>
			    </div>
			</div><hr>
			<div>
			    <div id="loadmoreall"  style="display:flex; flex-wrap:wrap;" class="jsw">
	            <?php foreach($viewallhome->result() as $topstorysrow) { ?>
        	        <div class="cardls">
						<div class="book-typels"><?php echo $topstorysrow->gener;?></div>
						<a href="<?php echo base_url($this->uri->segment(1).'/story/'.preg_replace("~[^\p{M}\w]+~u", '-', $topstorysrow->title).'-'.$topstorysrow->sid);?>" class="imagesls-style">
							<?php if(isset($topstorysrow->image) && !empty($topstorysrow->image)) { ?>
    						    <img src="<?php echo base_url();?>assets/images/<?php echo $topstorysrow->image; ?>" alt="<?php echo $topstorysrow->title;?>" class="imagemels">
    						<?php }else{ ?>
    							<img src="<?php echo base_url();?>assets/default/series-stories.jpg" alt="<?php echo $topstorysrow->title;?>" class="imagemels">
    						<?php } ?>
						</a>
						<div>
							<font class="max-linesls">
								<a href="<?php echo base_url($this->uri->segment(1).'/story/'.preg_replace("~[^\p{M}\w]+~u", '-', $topstorysrow->title).'-'.$topstorysrow->sid);?>" class="product-title"><?php echo $topstorysrow->title;?></a>
							</font> 
						</div>
												
						<div class="flextestls">
							<font class="bynamels">By <font class="nameherels">
							    <a href="<?php echo base_url().$this->uri->segment(1).'/'.$topstorysrow->profile_name;?>" style="color:#000"> <?php echo $topstorysrow->name;?></a>
							</font></font><br>
						</div>
									
						<div class="flextestls" style="padding-top:4px;">
							<font class = "episodesls">
								<font>
									<?php $wordcount = explode(' ', $topstorysrow->story);
								        $time = round(sizeof($wordcount)/180);	?>
									<b><?php if($time == 0){ echo 1;}else{ echo $time;}?></b> Min Story&nbsp;</font>
								<font>&nbsp;<i style="color: #3c8dbc" class="fa fa-eye" aria-hidden="true"></i><b> <?php echo $topstorysrow->views;?>&nbsp;</b></font>
								<font>&nbsp;<i style="color: #3c8dbc" class="fa fa-star" aria-hidden="true"></i>
									<b>
									<?php if(isset($reviews21) && ($reviews21->num_rows()>0)) {
										foreach($reviews21->result() as $reviews2) { 
											if($reviews2->sid == $topstorysrow->sid) {
												echo round($reviews2->rating);
											}
									} } ?>
									</b>
								</font>
							</font><br>
						</div>
						
						<div class="flextestls" style="padding-top:6px">
							<?php if(isset($this->session->userdata['logged_in']['user_id']) && ($topstorysrow->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
								<button class="read" onclick="yoursreadlater();"><i class="fa fa-bookmark"></i> Read later </button>
								
							<?php }else{ ?>
								<?php if(isset($readlatersids) && (sizeof($readlatersids)>0) && in_array($topstorysrow->sid, $readlatersids)) { ?>
									<button onclick="unreadlater(<?php echo $topstorysrow->sid;?>)" class="readdone notloginmodal readlaterbtnatr<?php echo $topstorysrow->sid;?>">
									<i class="fa fa-check faicon<?php echo $topstorysrow->sid;?>"></i> Read later </button>
								<?php }else { ?>
									<button onclick="readlater(<?php echo $topstorysrow->sid;?>)" class="read notloginmodal readlaterbtnatr<?php echo $topstorysrow->sid;?>">
									<i class="fa fa-bookmark faicon<?php echo $topstorysrow->sid;?>"></i> Read later </button>
								<?php } ?>
							<?php } ?>
							
							<button type="button" class="btn read dropdown-toggle pull-right" data-toggle="dropdown">
								<span class=""><i class="fa fa-plus"></i></span>
							</button>
							<ul class="dropdown-menu list-inline dropvk">
								<li onclick="groupsuggest(<?php echo $topstorysrow->sid; ?>);">
									<a href="javascript:void(0);" data-toggle="modal" data-target="#groupsuggest" title="COMMUNITY"><i class="fa fa-users"></i></a>
								</li>
								<li onclick="friend(<?php echo $topstorysrow->sid;?>);">
									<a href="javascript:void(0);" data-toggle="modal" data-target="#friendsuggest" title="SUGGEST"><i class="fa fa-user"></i></a>
								</li>
								<li onclick="socialshare(<?php echo $topstorysrow->sid;?>, 'story');">
									<a data-toggle="modal" data-target="#soc" href="javascript:void(0);" title="SOCIAL">
										<i class="fa fa-share-alt"></i>
									</a>
								</li>
							</ul>
						</div>
					</div>
                <?php } ?>
			    </div>
			    <center>
                    <div class="load-more" lastID="<?php echo $topstorysrow->sid; ?>" style="display: none;">
                        <img src="<?php echo base_url();?>assets/images/imgs/loading.gif"/>
                    </div>
                </center>
            </div>    
        </div>
        <?php } else if(isset($viewallhome) && ($viewallhome->num_rows() > 0) && (($this->uri->segment(3) == 'nano') || ($this->uri->segment(2) == 'shortstories'))){
            $nanolikes = array(); $nanolikes = get_storiesreadlater('nanolike'); ?>
        <div class="main-container-2">
		    <div class="row pt-0">
			    <div class="col-md-12 col-xs-12 pd-0">
			    	<div class="titlei">NANO STORIES</div>
			    </div>
			</div><hr>
			<div>
		        <div id="loadmoreall" style="display:flex;flex-wrap:wrap;" class="jsw">
			        <?php foreach($viewallhome->result() as $nanorow) { ?>
            			<div class="nano-stories deletenano<?php echo $nanorow->sid;?>">
							<div>
    							<?php if(isset($nanorow->profile_image) && !empty($nanorow->profile_image)) { ?>
									<img src="<?php echo base_url();?>assets/images/<?php echo $nanorow->profile_image; ?>" class="circle-image" style="height:50px;color:#000;" alt="<?php echo $nanorow->name;?>">
								<?php }else{ ?>
									<img src="<?php echo base_url();?>assets/images/2.png" class="circle-image" style="height:50px;color:#000;" alt="<?php echo $nanorow->name;?>">
								<?php } ?>
								<h3 class="name-nanostories">
								    <a href="<?php echo base_url($this->uri->segment(1).'/'.$nanorow->profile_name);?>" style="color:#000"><?php echo $nanorow->name;?></a>
								    <span class="dropdown" style="float:right;margin-top:-2.8px;">
    			                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
    			                            <i class="fa fa-ellipsis-v" style="font-size:14px;"></i>
    			                        </a>
    			                        <ul class="dropdown-menu pull-right">
    			                            <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($this->session->userdata['logged_in']['user_id'] == $nanorow->user_id)){ ?>
    			                            <li><a href="javascript:void(0);" onClick="editnano(<?php echo $nanorow->sid;?>);"><i class="fa fa-edit pr-10"></i> EDIT</a></li>
			                        		<li><a href="javascript:void(0);" onClick="deletenano(<?php echo $nanorow->sid;?>);"><i class="fa fa-trash pr-10"></i> DELETE</a></li>
    			                            <?php } else { ?>
    			                            <li><a href="javascript:void(0);" onClick=""><i class="fa fa-exclamation-triangle"></i> REPORT</a></li>
    			                            <?php } ?>
    			                        </ul>
    			                    </span>
    							</h3>
							</div>
							<div>
								<hr style="width:100%; margin-top:12px;">
								<a href="javascript:void(0);" style="color:#000" data-toggle="modal" data-target="#modal-default<?php echo $nanorow->sid;?>">
								    <font class="text-in-nanostory" onclick="nanoviewsadd(<?php echo $nanorow->sid;?>);"><?php echo $nanorow->story; ?></font>
								</a>
							</div>
							<div class="lastdiv">
								<hr style="width:100%;">
								<?php if(isset($this->session->userdata['logged_in']['user_id'])){
								    if(isset($nanolikes) && in_array($nanorow->sid,$nanolikes)) { ?>
    								<font>
    								    <span class="nanolikecount<?php echo $nanorow->sid;?>"><?php echo $nanorow->nanolikecount;?></span>
    								    <a href="javascript:void(0);" onclick="nanodislike(<?php echo $nanorow->sid;?>);" class="nanolike<?php echo $nanorow->sid;?>" title="Unlike">
    										<i class="fa fa-heart favbtn<?php echo $nanorow->sid;?>" style="color:#f00; padding-top:5px;"></i>
    									</a>
    								</font>
    							    <?php } else { ?>
    							    <font>
    							        <span class="nanolikecount<?php echo $nanorow->sid;?>"><?php echo $nanorow->nanolikecount;?></span>
    								    <a href="javascript:void(0);" onclick="nanolike(<?php echo $nanorow->sid;?>);" class="nanolike<?php echo $nanorow->sid;?>" title="like">
    										<i class="fa fa-heart-o favbtn<?php echo $nanorow->sid;?>" style="color:#f00; padding-top:5px;"></i>
    									</a>
    								</font>
    							    <?php } }else { ?>
    							    <font>
    								    <span class="nanolikecount<?php echo $nanorow->sid;?>"><?php echo $nanorow->nanolikecount;?></span>
    								    <a href="javascript:void(0);" class="notloginmodal" title="like">
    										<i class="fa fa-heart-o favbtn<?php echo $nanorow->sid;?>" style="color:#f00; padding-top:5px;"></i>
    									</a>
    								</font>
    							<?php } ?>
								<div style="float:right;color:#777">
									<a href="javascript:void(0);" class="dropdown-toggle text-muted" data-toggle="dropdown">
										<i class="fa fa-share-alt" aria-hidden="true"></i>
									</a>
									<ul class="dropdown-menu list-inline dropvknano">
    									<li onclick="groupsuggest(<?php echo $nanorow->sid; ?>);">
    										<a href="javascript:void(0);" data-toggle="modal" data-target="#groupsuggest"><i class="fa fa-users"></i></a>
    									</li>
    									<li onclick="friend(<?php echo $nanorow->sid;?>);">
    										<a href="javascript:void(0);" data-toggle="modal" data-target="#friendsuggest"><i class="fa fa-user"></i></a>
    									</li>
										<li onclick="socialshare(<?php echo $nanorow->sid;?>, 'nano');">
											<a data-toggle="modal" data-target="#soc" href="javascript:void(0);" title="SOCIAL"><i class="fa fa-share-alt"></i></a>
										</li>
									</ul>
								</div>
								<font style="float:right;color:#777">
								    <i class="fa fa-eye" aria-hidden="true"></i>
								    <b><span class="nanoviewcount<?php echo $nanorow->sid;?>"><?php echo $nanorow->views; ?></span></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								</font>
							</div>
						</div>
            		<?php } ?>
		        </div>
		        <?php if(isset($viewallhome) && ($viewallhome->num_rows() > 0)){ foreach($viewallhome->result() as $nanomodalrow) { ?>
            		<div class="modal fade" id="modal-default<?php echo $nanomodalrow->sid;?>">
            			<div class="modal-dialog">
            				<div class="modal-content">
            					<div class="modal-header">
            						<div class="">
            						    <?php if(isset($nanomodalrow->profile_image) && !empty($nanomodalrow->profile_image)) { ?>
        									<img src="<?php echo base_url();?>assets/images/<?php echo $nanomodalrow->profile_image; ?>" class="user-image img-circle" style="height:50px;color:#000" alt="<?php echo $nanomodalrow->name;?>">
        								<?php }else{ ?>
        									<img src="<?php echo base_url();?>assets/images/2.png" class="user-image img-circle" style="height:50px;color:#000" alt="<?php echo $nanomodalrow->name;?>">
        								<?php } ?>
            							<h3 class="name-nanostories" style="margin-top: -40px;">
            							    <a href="<?php echo base_url($this->uri->segment(1)."/".$nanomodalrow->profile_name);?>" style="color:#000"><?php echo $nanomodalrow->name;?></a>
            			                    <span class="pull-right">
            			                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:4px;">
                                        	        <span aria-hidden="true">&times;</span>
                                                </button>
            			                    </span>
            			                </h3>
            						</div>
            					</div>
            					<div class="modal-body modal-bodyv" style="overflow-y:scroll;">
            						<font class="text-in-nanostory-p" style="border-left:none; overflow-y:scroll;"><?php echo $nanomodalrow->story; ?></font>
            					</div>
            					<div class="modal-footer">
            						<ul class="list-inline">
            							<li class="text-muted pull-left">
            						        <?php if(isset($this->session->userdata['logged_in']['user_id'])){
            								    if(isset($nanolikes) && in_array($nanomodalrow->sid,$nanolikes)) { ?>
                    							    <span class="nanolikecount<?php echo $nanomodalrow->sid;?>"><?php echo $nanomodalrow->nanolikecount;?></span>
                								    <a href="javascript:void(0);" onclick="nanodislike(<?php echo $nanomodalrow->sid;?>);" class="nanolike<?php echo $nanomodalrow->sid;?>" title="Unlike">
                										<i class="fa fa-heart favbtn<?php echo $nanomodalrow->sid;?>" style="color:#f00; padding-top:5px;"></i>
                									</a>
                								<?php } else { ?>
                									<span class="nanolikecount<?php echo $nanomodalrow->sid;?>"><?php echo $nanomodalrow->nanolikecount;?></span>
                								    <a href="javascript:void(0);" onclick="nanolike(<?php echo $nanomodalrow->sid;?>);" class="nanolike<?php echo $nanomodalrow->sid;?>" title="like">
                										<i class="fa fa-heart-o favbtn<?php echo $nanomodalrow->sid;?>" style="color:#f00; padding-top:5px;"></i>
                									</a>
                							<?php } } else{ ?>
                						        <span class="nanolikecount<?php echo $nanomodalrow->sid;?>"><?php echo $nanomodalrow->nanolikecount;?></span>
            								    <a href="javascript:void(0);" class="notloginmodal" title="like">
            										<i class="fa fa-heart-o favbtn<?php echo $nanomodalrow->sid;?>" style="color:#f00; padding-top:5px;"></i>
            									</a>
                						    <?php } ?>
            							</li>
            							<li class="pull-right">
                                        	<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-share-alt"></i></a>
                                            <ul class="dropdown-menu list-inline dropvknano1">
                                                <li onclick="groupsuggest(<?php echo $nanomodalrow->sid; ?>);">
        										    <a href="javascript:void(0);" data-toggle="modal" data-target="#groupsuggest"><i class="fa fa-users"></i></a>
            									</li>
            									<li onclick="friend(<?php echo $nanomodalrow->sid;?>);">
            										<a href="javascript:void(0);" data-toggle="modal" data-target="#friendsuggest"><i class="fa fa-user"></i></a>
            									</li>
        										<li onclick="socialshare(<?php echo $nanomodalrow->sid;?>, 'nano');">
        											<a data-toggle="modal" data-target="#soc" href="javascript:void(0);" title="SOCIAL"><i class="fa fa-share-alt"></i></a>
        										</li>
                                            </ul>
                                        </li>
            						</ul>
            					</div>
            				</div> <!-- /.modal-content -->
            			</div> <!-- /.modal-dialog -->
                    </div> <!-- /.modal -->
                <?php } } ?><!-- // NANO STORIES end-->
            </div>
        </div>
        <?php } else if(isset($viewallhome) && ($viewallhome->num_rows() > 0) && (($this->uri->segment(3) == 'life') || (($this->uri->segment(2) == 'lifeevents') && ($this->uri->segment(3) == 'latest')) ) ){ ?>
        <div class="main-container-2">
            <div class="row pt-0">
		        <?php if(isset($lifetagslist) && ($lifetagslist->num_rows() > 0)){ ?>
		        <div class="tagv" style="display:flex;">
	                <div class="brv1 hidden-xs">Popular Tags :</div>
	                <button id="left-btnt" class="left-btnt right-btnt"><i class="fa fa-arrow-left" aria-hidden="true"></i></button>
	                <div id="tag1" class="tags1">
	                    <div id="tag2" class="tags2">
	                        <?php if(isset($lifetagslist) && ($lifetagslist->num_rows() > 0)){
	                        foreach($lifetagslist->result() as $lifetaglist){ ?>
	                            <div class="brv" style="display:inline-block;"><a href="<?php echo base_url().$this->uri->segment(1);?>/searchresult?type=life&searchtext=<?php echo $lifetaglist->tagname; ?>">
	                                <?php echo $lifetaglist->tagname; ?></a>
	                            </div>
	                        <?php } } ?>
	                    </div>
	                </div>
	                <button id="right-btnt" class="right-btnt right-btnt"><i class="fa fa-arrow-right" aria-hidden="true"></i></button>
	            </div>
	            <?php } ?>
		    </div>
		    <div class="row pt-0">
                <div class="col-md-12 col-xs-12 pd-0">
			    	<div class="titlei">LIFE EVENTS</div>
			    </div>
			</div><hr>
			<div>
		        <div id="loadmoreall"  style="display:flex; flex-wrap:wrap;" class="jsw">
                    <?php foreach($viewallhome->result() as $liferow) { ?>
        			    <div class="card1">
							<a href="<?php echo base_url($this->uri->segment(1).'/story/'.preg_replace("~[^\p{M}\w]+~u", '-', $liferow->title).'-'.$liferow->sid);?>" class="imagelife-style">
    							<?php if(isset($liferow->image) && !empty($liferow->image)) { ?>
    								<img src="<?php echo base_url();?>assets/images/<?php echo $liferow->image; ?>" alt="<?php echo $liferow->title;?>" class="imageme1">
    							<?php }else{ ?>
    								<img src="<?php echo base_url();?>assets/default/life.jpg" alt="<?php echo $liferow->title;?>" class="imageme1">
    							<?php } ?>
							</a>
							<div>
    							<font class="max-lines">
    								<a href="<?php echo base_url($this->uri->segment(1).'/story/'.preg_replace("~[^\p{M}\w]+~u", '-', $liferow->title).'-'.$liferow->sid);?>">
    									<?php echo $liferow->title;?>
    								</a>
    							</font> 
							</div>
							<div class="flextest">
								<?php if(($liferow->writing_style == 'anonymous') && ($liferow->type == 'life')){ ?>
									<font class="byname">By <font class="namehere" style="color:#000"> Anonymous</font></font><br>
								<?php } else { ?>
									<font class="byname">By <font class="namehere">
									    <a href="<?php echo base_url().$this->uri->segment(1).'/'.$liferow->profile_name;?>" style="color:#000"> <?php echo $liferow->name;?></a>
								    </font></font><br>
								<?php } ?>
							</div>
							<div class="flextest" style="padding-top:4px;">
								<font class="lifeEvents-text"><?php echo mb_substr(strip_tags($liferow->story),0,150);?> </font>
							</div>
							<div class="flextest" style="padding-top:6px">
								<?php if(isset($this->session->userdata['logged_in']['user_id']) && ($liferow->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
									<button class="read" onclick="yoursreadlater();"><i class="fa fa-bookmark"></i> Read later </button>
								<?php }else{ ?>
									<?php if(isset($readlatersids) && (sizeof($readlatersids)>0) && in_array($liferow->sid, $readlatersids)) { ?>
										<button onclick="unreadlater(<?php echo $liferow->sid;?>)" class="readdone notloginmodal readlaterbtnatr<?php echo $liferow->sid;?>">
										<i class="fa fa-check faicon<?php echo $liferow->sid;?>"></i> Read later </button>
									<?php }else { ?>
										<button onclick="readlater(<?php echo $liferow->sid;?>)" class="read notloginmodal readlaterbtnatr<?php echo $liferow->sid;?>">
										<i class="fa fa-bookmark faicon<?php echo $liferow->sid;?>"></i> Read later </button>
									<?php } ?>
								<?php } ?>
								
								<button type="button" class="btn read dropdown-toggle pull-right" data-toggle="dropdown">
									<span class=""><i class="fa fa-plus"></i></span>
								</button>
								<ul class="dropdown-menu list-inline dropvklife">
									<li onclick="groupsuggest(<?php echo $liferow->sid; ?>);">
										<a href="javascript:void(0);" data-toggle="modal" data-target="#groupsuggest" title="COMMUNITY"><i class="fa fa-users"></i></a>
									</li>
									<li onclick="friend(<?php echo $liferow->sid;?>);">
										<a href="javascript:void(0);" data-toggle="modal" data-target="#friendsuggest" title="SUGGEST"><i class="fa fa-user"></i></a>
									</li>
									<li onclick="socialshare(<?php echo $liferow->sid;?>, 'story');">
										<a data-toggle="modal" data-target="#soc" href="javascript:void(0);" title="SOCIAL"><i class="fa fa-share-alt"></i></a>
									</li>
								</ul>
							</div>
						</div>	
        			<?php } ?>
                </div>
            </div>
        </div>
        <?php } ?>
        <div id="load_data_message"></div>
    </section>
</div>

<!-- group suggest popup code ---- -->
<div class="modal fade" id="groupsuggest" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
		    <div class="storysuggesttogroup"></div>
		</div>
	</div>
</div>
<!-- group suggest popup code ----------- -->
<!-- frind popup code ------>
<div class="modal fade" id="friendsuggest" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
		    <div class="storysuggesttofriend"></div>
		</div>
	</div>
</div>
<!--frind popup end ------------->
<!-- Social Popup ---- -->
<div class="modal fade" id="soc">
	<div class="modal-dialog">
		<div class="modal-content socv ">
			<div class="modal-header" style="padding:8px 15px;">
				<button type="button" class="close" style="color:#000; opacity:initial; margin-top:0px;margin-bottom:-2px;" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h5 class="modal-title text-center" style="color:#808182;">SOCIAL MEDIA SHARE</h5>
			</div>
			<div class="" style="padding-top:10px;">
				<div class="row">
					<div class="col-md-12 pd-5v" style="margin:12px;padding-bottom:5px;">
						<a href="javascript:void(0);" class="facebookshare socsh">
						    <img src="<?php echo base_url();?>assets/svg/fb.svg" style="width:40px; height:40px;margin-top:-10px;"/><p class="socialsharepopupspan">Facebook</p></a>
					</div>
					<div class="col-md-12 pd-5v" style="margin:12px;padding-bottom:5px;">
					    <a href="javascript:void(0);" class="whatsappshare socsh">
						    <img src="<?php echo base_url();?>assets/svg/wa.svg" style="width:40px; height:40px;margin-top:-10px;"/><p class="socialsharepopupspan">Whatsapp</p></a>
					</div>
					<div class="col-md-12 pd-5v" style="margin:12px;padding-bottom:5px;">
						<a href="javascript:void(0);" class="twittershare socsh">
						    <img src="<?php echo base_url();?>assets/svg/twitter.svg" style="width:40px; height:40px;margin-top:-10px;"/> <p class="socialsharepopupspan">Twitter</p></a>
					</div>
					<div class="col-md-12 pd-5v" style="margin:12px;">
						<a href="javascript:void(0);" onclick="copylinkshare('#copylinkshare')" class="socsh">
						    <img src="<?php echo base_url();?>assets/svg/link.svg" style="width:40px;height:40px;margin-top:-10px;"/> <p class="socialsharepopupspan">Copy to link</p></a>
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
<!-- Social popup ---- -->

<!-- Nano edit update -->		
<div class="modal fade" id="nanoedit" role="dialog">		
	<div class="modal-dialog">		
		<div class="modal-content">		
			<div class="modal-header">		
				<button type="button" class="close" data-dismiss="modal">&times;</button>		
				<h4>UPDATE NANO STORY</h4>		
			</div>		
			<div class="modal-body">		
			    <!--<h5 class="updatenano"></h5>-->		
			    <input type="hidden" id="nanolang" value="">		
			    <h6 class="pull-left" id="count_message"></h6>		
			    <input type="hidden" name="nanosid" id="nanosid" value="">		
				<textarea name="story" id="story" rows="8" cols="96" required="" class="form-control" placeholder="Start Writing Here...." maxlength="1000" style="resize:none; overflow-y:scroll;"></textarea>		
			    <br><center><button class="btn btn-primary" onclick="updatenano()"> Update </button></center>		
			</div>		
		</div>		
	</div>		
</div>		
<!-- Nano edit update -->

<script>
    $(document).ready(function(){
        var limit = 7;
        var start = 7;
        var action = 'inactive';
        function load_country_data(limit, start) {
            var vatype = "<?php echo $this->uri->segment(3);?>";
            var typeseg = "<?php echo $this->uri->segment(2);?>";
            if((typeseg == 'series') && (vatype == 'latest')){
                vatype = 'series';
            }else if((typeseg == 'stories') && (vatype == 'latest')){
                vatype = 'story';
            }else if((typeseg == 'lifeevents') && (vatype == 'latest')){
                vatype = 'life';
            }else if(typeseg == 'shortstories'){
                vatype = 'nano';
            }
            $.ajax({
                url:'<?php echo base_url().$this->uri->segment(1);?>/viewallloadmore/'+vatype,
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
            if ($(window).scrollTop() >= (($("#loadmoreall").height() - $(window).height())*0.6) && action == 'inactive'){
                action = 'active';
                start = start + limit;
                setTimeout(function(){load_country_data(limit, start);}, 10);
            }
        });
    });
</script>
<script>		
    function genericSocialShare(url){		
        window.open(url,'sharer','toolbar=0,status=0,width=648,height=395');		
        return true;		
    }		
    function copylinkshare(element) {		
        var $temp = $("<input>");		
        $("body").append($temp);		
        $temp.val($(element).val()).select();		
        document.execCommand("copy");		
        $temp.remove();		
    }		
</script>		
<script>		
    function editnano(nanosid){		
        $.ajax({		
    		url:'<?php echo base_url().$this->uri->segment(1);?>/editnano/'+nanosid,		
    		method: 'POST',		
    		dataType: "json",		
    		success:function(data){		
    		    $('#story').text(data.story);		
    		    $('#nanolang').val(data.nanolang);		
    		    $('#nanosid').val(nanosid);		
    		    $('#nanoedit').modal('show');		
    		    languageChangeHandler();		
            }		
        });		
    }		
    function updatenano(){		
        var nanosid = $('#nanosid').val();		
        var story = $('textarea#story').val();		
        $.ajax({		
    		url:'<?php echo base_url().$this->uri->segment(1);?>/updatenano',		
    		method: 'POST',		
    		data: {'story': story, 'nanosid': nanosid},		
    		dataType: "json",		
    		success:function(data){		
    		    $('.updatenano').html('<span class="text-success"> Nano story updated successfully.</span>');		
    		    setTimeout(function(){ $('#nanoedit').modal('hide'); }, 2000);		
    		    location.reload();		
            }		
        });		
    }		
    function deletenano(nanosid){		
        $.ajax({		
    		url:'<?php echo base_url().$this->uri->segment(1);?>/deletenano/'+nanosid,		
    		method: 'POST',		
    		success:function(data){		
    		    if(data == 1){		
    		        $('.deletenano'+nanosid).css('display', 'none');		
    		    }		
            }		
        });		
    }		
</script>		
<script type="text/javascript" src="https://www.google.com/jsapi"></script>		
<script type="text/javascript">		
    	// Load the Google Transliterate API		
    	google.load("elements", "1", {		
    		packages: "transliteration"		
    	});		
	  var languagetoc = document.getElementById('nanolang').value;		
	  var transliterationControl;		
	  function onLoad() { 		
		var options = {		
			sourceLanguage: 'en',		
			destinationLanguage: ['te','hi','ml','ta','bn','gu','kn','mr','ru','pa','or'],		
			transliterationEnabled: true,		
		};		
		// Create an instance on TransliterationControl with the required		
		// options.		
		transliterationControl =		
		  new google.elements.transliteration.TransliterationControl(options);		
		// Enable transliteration in the textfields with the given ids.jk		
        var ids = [ "story"];		
        transliterationControl.makeTransliteratable(ids);		
        transliterationControl.c.qc.t13n.c[3].c.d.keyup[0].ia.F.p = 'https://www.google.com';  // https ssl activation 		
		// Add the STATE_CHANGED event handler to correcly maintain the state		
		// of the checkbox.		
		transliterationControl.addEventListener(		
			google.elements.transliteration.TransliterationControl.EventType.STATE_CHANGED,		
			transliterateStateChangeHandler);		
		// Add the SERVER_UNREACHABLE event handler to display an error message		
		// if unable to reach the server.		
		transliterationControl.addEventListener(		
			google.elements.transliteration.TransliterationControl.EventType.SERVER_UNREACHABLE,		
			serverUnreachableHandler);		
		// Add the SERVER_REACHABLE event handler to remove the error message		
		// once the server becomes reachable.		
		transliterationControl.addEventListener(		
			google.elements.transliteration.TransliterationControl.EventType.SERVER_REACHABLE,		
			serverReachableHandler);		
			// Set the checkbox to the correct state.		
		document.getElementById('checkboxId').checked =		
		  transliterationControl.isTransliterationEnabled();		
		// Populate the language dropdown		
	  }		
	  // Handler for STATE_CHANGED event which makes sure checkbox status		
	  // reflects the transliteration enabled or disabled status.		
	  function transliterateStateChangeHandler(e) {		
		document.getElementById('checkboxId').checked = e.transliterationEnabled;		
	  }		
	  // Handler for dropdown option change event.  Calls setLanguagePair to		
	  // set the new language.		
	  function languageChangeHandler() {		
        //transliterationControl.toggleTransliteration();		
		var dropdown = document.getElementById('nanolang').value;		
        transliterationControl.setLanguagePair(		
           google.elements.transliteration.LanguageCode.ENGLISH, dropdown);		
	  }		
	  // SERVER_UNREACHABLE event handler which displays the error message.		
	  function serverUnreachableHandler(e) {		
		document.getElementById("errorDiv").innerHTML =		
			"Transliteration Server unreachable";		
	  }		
	  // SERVER_UNREACHABLE event handler which clears the error message.		
	  function serverReachableHandler(e) {		
		document.getElementById("errorDiv").innerHTML = "";		
	  }		
    google.setOnLoadCallback(onLoad);		
</script>		

<script>
var rightButtont = $("#right-btnt");
var leftButtont = $("#left-btnt");
var containert = $("#tag1");
var slideContt = $("#tag2");
if($("#tag2 > div").length<3){
  $('#right-btnt').hide();
  $('#left-btnt').hide();
}
var maxcountt=$("#tag2 > div").length;
var marLeftt = 0, maxXt = maxcountt*60, difft = 0 ;

function slidet() {
marLeftt-=100;
if( marLeftt < -maxXt ){ 
  marLeftt = -maxXt+100 ;
}
  slideContt.animate({"margin-left" : marLeftt + "px"}, 500);
}

function slideBackt() {
  marLeftt +=100;
  if ( marLeftt > 0 ) { marLeftt = 0 ;}
  slideContt.animate({"margin-left" : marLeftt + "px"}, 500);
}
rightButtont.click(slidet);
leftButtont.click(slideBackt);

/*touch code from here*/

$(containert).on("mousedown touchstart", function(e) {
  
  var startXt = e.pageX || e.originalEvent.touches[0].pageX;
  difft = 0;

  $(containert).on("mousemove touchmove", function(e) {
    
      var xtt = e.pageX || e.originalEvent.touches[0].pageX;
      difft = (xtt - startXt) * 100 / window.innerWidth;
    if( marLeftt == 0 && difft > 10 ) { 
      event.preventDefault() ;
    } else if (  marLeftt == -maxXt && difft < -10 ) {
       event.preventDefault();   
    }
  });
});

$(containert).on("mouseup touchend", function(e) {
  $(containert).off("mousemove touchmove");
  if(  marLeftt == 0 && difft > 4 ) { 
      sliderContt.animate({"margin-left" :  0 + "px"},100);
   } else if (  marLeftt == -maxXt  && difft < 4 ){
       sliderContt.animate({"margin-left" : -maxXt  + "px"},100);  
   } else {
      if (difft < -10) {
        slidet();
      } else if (difft > 10) {
        slideBackt();
      } 
  }
});
</script>