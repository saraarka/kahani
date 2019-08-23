<?php if(isset($viewallloadmore) && ($viewallloadmore->num_rows() >0) && (($this->uri->segment(3) == 'series') || ($type == 'series'))){ ?>
    <?php $readlatersids = get_storiesreadlater('readlater'); foreach ($viewallloadmore->result() as $topseriesrow) { ?>
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
				<font class="bynamels">By <font class="">
				    <b><a href="<?php echo base_url($this->uri->segment(1).'/'.$topseriesrow->profile_name);?>" style="color:#000"> <?php echo $topseriesrow->name;?></a></b>
				</font></font><br>
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
				<?php }else if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])){ ?>
					<?php if(isset($readlatersids) && (sizeof($readlatersids)>0) && in_array($topseriesrow->sid, $readlatersids)) { ?>
						<button onclick="unreadlater(<?php echo $topseriesrow->sid;?>)" class="readdone notloginmodal readlaterbtnatr<?php echo $topseriesrow->sid;?>">
						<i class="fa fa-check faicon<?php echo $topseriesrow->sid;?>"></i> Read later </button>
					<?php }else { ?>
						<button onclick="readlater(<?php echo $topseriesrow->sid;?>)" class="read notloginmodal readlaterbtnatr<?php echo $topseriesrow->sid;?>">
						<i class="fa fa-bookmark faicon<?php echo $topseriesrow->sid;?>"></i> Read later </button>
					<?php } ?>
				<?php } else{ ?>
				    <button class="read notloginmodal" data-toggle="modal" data-target="#loginmodal"><i class="fa fa-bookmark"></i> Read later </button>
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
    <?php } ?>
<?php }else if(isset($viewallloadmore) && ($viewallloadmore->num_rows() >0) && ($this->uri->segment(3) == 'story')){ ?>
    <?php foreach($viewallloadmore->result() as $topstorysrow) { ?>
        <div class="cardls">
			<div class="book-typels"><?php echo $topstorysrow->gener;?></div>
			<a href="<?php echo base_url($this->uri->segment(1).'/story/'.preg_replace("~[^\p{M}\w]+~u", '-', $topstorysrow->title).'-'.$topstorysrow->sid);?>" class="product-title imagesls-style">
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
					$time = round(sizeof($wordcount)/50);	?>
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
				<?php }else if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])) { ?>
					<?php if(isset($readlatersids) && (sizeof($readlatersids)>0) && in_array($topstorysrow->sid, $readlatersids)) { ?>
						<button onclick="unreadlater(<?php echo $topstorysrow->sid;?>)" class="readdone notloginmodal readlaterbtnatr<?php echo $topstorysrow->sid;?>">
						<i class="fa fa-check faicon<?php echo $topstorysrow->sid;?>"></i> Read later </button>
					<?php }else { ?>
						<button onclick="readlater(<?php echo $topstorysrow->sid;?>)" class="read notloginmodal readlaterbtnatr<?php echo $topstorysrow->sid;?>">
						<i class="fa fa-bookmark faicon<?php echo $topstorysrow->sid;?>"></i> Read later </button>
					<?php } ?>
				<?php } else { ?>
				    <button class="read notloginmodal" data-toggle="modal" data-target="#loginmodal"><i class="fa fa-bookmark"></i> Read later </button>
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
<?php }else if(isset($viewallloadmore) && ($viewallloadmore->num_rows() >0) && ($this->uri->segment(3) == 'nano')){
    $nanolikes = array(); $nanolikes = get_storiesreadlater('nanolike'); foreach($viewallloadmore->result() as $vahnanorow) { ?>
    	<div class="nano-stories">
			<div>
				<?php if(isset($vahnanorow->profile_image) && !empty($vahnanorow->profile_image)) { ?>
					<img src="<?php echo base_url();?>assets/images/<?php echo $vahnanorow->profile_image; ?>" class="circle-image" style="height:50px;color:#000" alt="<?php echo $vahnanorow->name;?>">
				<?php }else{ ?>
					<img src="<?php echo base_url();?>assets/images/2.png" class="circle-image" style="height:50px;color:#000" alt="<?php echo $vahnanorow->name;?>">
				<?php } ?>
				<h3 class="name-nanostories" style="vertical-align:middle;overflow: inherit;">
				    <a href="<?php echo base_url($this->uri->segment(1).'/'.$vahnanorow->profile_name);?>" style="color:#000"><?php echo $vahnanorow->name;?></a>
				    <span class="dropdown"  style="float:right;margin-top:-2.8px">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-ellipsis-v" style="font-size:14px;"></i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);" onClick=""><i class="fa fa-exclamation-triangle"></i> Report</a></li>
                        </ul>
                    </span>
				</h3>
			</div>
			<div>
				<hr style="width:100%; margin-top:12px;">
				<a href="javascript:void(0);" style="color:#000" data-toggle="modal" data-target="#modal-default<?php echo $vahnanorow->sid;?>">
				    <font class="text-in-nanostory" onclick="nanoviewsadd(<?php echo $vahnanorow->sid;?>);"><?php echo $vahnanorow->story; ?></font>
				</a>
			</div>
			
			<div class="lastdiv">
				<hr style="width:100%;">
				<?php if(isset($this->session->userdata['logged_in']['user_id'])){
				    if(isset($nanolikes) && in_array($vahnanorow->sid,$nanolikes)) { ?>
					<font>
					    <span class="nanolikecount<?php echo $vahnanorow->sid;?>"><?php echo $vahnanorow->nanolikecount;?></span>
					    <a href="javascript:void(0);" onclick="nanodislike(<?php echo $vahnanorow->sid;?>);" class="nanolike<?php echo $vahnanorow->sid;?>" title="Unlike">
							<i class="fa fa-heart favbtn<?php echo $vahnanorow->sid;?>" style="color:#f00; padding-top:5px;"></i>
						</a>
					</font>
				    <?php } else { ?>
				    <font>
				        <span class="nanolikecount<?php echo $vahnanorow->sid;?>"><?php echo $vahnanorow->nanolikecount;?></span>
					    <a href="javascript:void(0);" onclick="nanolike(<?php echo $vahnanorow->sid;?>);" class="nanolike<?php echo $vahnanorow->sid;?>" title="like">
							<i class="fa fa-heart-o favbtn<?php echo $vahnanorow->sid;?>" style="color:#f00; padding-top:5px;"></i>
						</a>
					</font>
				    <?php } }else { ?>
				    <font>
					    <span class="nanolikecount<?php echo $vahnanorow->sid;?>"><?php echo $vahnanorow->nanolikecount;?></span>
					    <a href="javascript:void(0);" class="notloginmodal" title="like">
							<i class="fa fa-heart-o favbtn<?php echo $vahnanorow->sid;?>" style="color:#f00; padding-top:5px;"></i>
						</a>
					</font>
				<?php } ?>
				<div style="float:right;color:#777">
					<a href="javascript:void(0);" class="dropdown-toggle text-muted" data-toggle="dropdown">
						<i class="fa fa-share-alt" aria-hidden="true"></i>
					</a>
					<ul class="dropdown-menu list-inline dropvknano">
						<li onclick="groupsuggest(<?php echo $vahnanorow->sid; ?>);">
							<a href="javascript:void(0);" data-toggle="modal" data-target="#groupsuggest"><i class="fa fa-users"></i></a>
						</li>
						<li onclick="friend(<?php echo $vahnanorow->sid;?>);">
							<a href="javascript:void(0);" data-toggle="modal" data-target="#friendsuggest"><i class="fa fa-user"></i></a>
						</li>
						<li onclick="socialshare(<?php echo $vahnanorow->sid;?>, 'nano');">
							<a data-toggle="modal" data-target="#soc" href="javascript:void(0);" title="SOCIAL"><i class="fa fa-share-alt"></i></a>
						</li>
					</ul>
				</div>
				<font style="float:right;color:#777">
				    <i class="fa fa-eye" aria-hidden="true"></i>&nbsp;
				    <b><span class="nanoviewcount<?php echo $vahnanorow->sid;?>"><?php echo $vahnanorow->views; ?></span></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</font>
			</div>
		</div>
    <?php } ?>
    <?php if(isset($viewallloadmore) && ($viewallloadmore->num_rows() > 0)){ foreach($viewallloadmore->result() as $nanomodalrow) { ?>
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
							    <a href="<?php echo base_url($this->uri->segment(1).'/'.$nanomodalrow->profile_name);?>" style="color:#000"><?php echo $nanomodalrow->name;?></a>
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
				</div>
			</div>
        </div>
    <?php } } ?>
<?php }else if(isset($viewallloadmore) && ($viewallloadmore->num_rows() >0) && (($this->uri->segment(3) == 'life') || ($type == 'life'))){ ?>
    <?php foreach($viewallloadmore->result() as $liferow) { ?>
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
					<font class="byname">By<font class="namehere">
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
				<?php }else if(isset($this->session->userdata['logged_in']['user_id'])) { ?>
					<?php if(isset($readlatersids) && (sizeof($readlatersids)>0) && in_array($liferow->sid, $readlatersids)) { ?>
						<button onclick="unreadlater(<?php echo $liferow->sid;?>)" class="readdone notloginmodal readlaterbtnatr<?php echo $liferow->sid;?>">
						<i class="fa fa-check faicon<?php echo $liferow->sid;?>"></i> Read later </button>
					<?php }else { ?>
						<button onclick="readlater(<?php echo $liferow->sid;?>)" class="read notloginmodal readlaterbtnatr<?php echo $liferow->sid;?>">
						<i class="fa fa-bookmark faicon<?php echo $liferow->sid;?>"></i> Read later </button>
					<?php } ?>
				<?php } else{ ?>
				    <button class="read notloginmodal" data-toggle="modal" data-target="#loginmodal"><i class="fa fa-bookmark"></i> Read later </button>
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
						<a data-toggle="modal" data-target="#soc" href="javascript:void(0);" title="SOCIAL">
							<i class="fa fa-share-alt"></i>
						</a>
					</li>
				</ul>
			</div>
		</div>	
	<?php } ?>
<?php } ?>