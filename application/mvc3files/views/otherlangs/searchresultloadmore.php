<?php if(isset($loadsearchresults) && ($loadsearchresults->num_rows() > 0) && ($_GET['type'] == 'series')){
    $readlatersids = get_storiesreadlater('readlater');
    foreach($loadsearchresults->result() as $seriesrow) { ?>
	    <div class="card">
		    <div class="book-type"><?php echo $seriesrow->gener;?></div>
			<a href="<?php echo base_url($this->uri->segment(1).'/series/'.preg_replace("~[^\p{M}\w]+~u", '-', $seriesrow->title).'-'.$seriesrow->sid.'/'.preg_replace("~[^\p{M}\w]+~u", '-', $seriesrow->title).'-'.$seriesrow->story_id);?>" class="imagesls-style">
				<?php if(isset($seriesrow->image) && !empty($seriesrow->image)) { ?>
				    <img src="<?php echo base_url();?>assets/images/<?php echo $seriesrow->image; ?>" alt="<?php echo ($seriesrow->title);?>" class="imageme">
				<?php }else{ ?>
					<img src="<?php echo base_url();?>assets/default/series-stories.jpg" alt="<?php echo ($seriesrow->title);?>" class="imageme">
				<?php } ?>
			</a>
			<div>
				<font class="max-lines">
					<a href="<?php echo base_url($this->uri->segment(1).'/series/'.preg_replace("~[^\p{M}\w]+~u", '-', $seriesrow->title).'-'.$seriesrow->sid.'/'.preg_replace("~[^\p{M}\w]+~u", '-', $seriesrow->title).'-'.$seriesrow->story_id);?>">
						<?php echo ($seriesrow->title);?>
					</a>
				</font> 
			</div>
			<div class="flextest">
				<font class="byname">By<font class="namehere">
				    <a href="<?php echo base_url($this->uri->segment(1).'/'.$seriesrow->profile_name);?>" style="color:#000"> <?php echo $seriesrow->name;?></a></font>
				</font><br>
			</div>
			<div class="flextest" style="padding-top:4px;">
				<font class="episodes">
					<?php $keycount = get_episodecount($seriesrow->sid); 
					if(isset($keycount)){ echo $keycount; }else{ echo 0; }?> EPISODES | 
					<?php $subsmemcount = get_storysubscount($seriesrow->sid); 
					if(isset($subsmemcount)){echo $subsmemcount; }else{echo 0; } ?> MEMBERS
				</font><br>
			</div>
		    <div class="flextest" style="padding-top:6px">
				<?php if(isset($this->session->userdata['logged_in']['user_id']) && ($seriesrow->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
					<button class="read" onclick="yoursreadlater();"><i class="fa fa-bookmark"></i> Read later </button>
				<?php }else{ ?>
					<?php if(isset($readlatersids) && (sizeof($readlatersids)>0) && in_array($seriesrow->sid, $readlatersids)) { ?>
						<button onclick="unreadlater(<?php echo $seriesrow->sid;?>)" class="readdone notloginmodal readlaterbtnatr<?php echo $seriesrow->sid;?>">
						<i class="fa fa-check faicon<?php echo $seriesrow->sid;?>"></i> Read later </button>
					<?php }else { ?>
						<button onclick="readlater(<?php echo $seriesrow->sid;?>)" class="read notloginmodal readlaterbtnatr<?php echo $seriesrow->sid;?>">
						<i class="fa fa-bookmark faicon<?php echo $seriesrow->sid;?>"></i> Read later </button>
					<?php } ?>
				<?php } ?>
				<button type="button" class="btn read dropdown-toggle pull-right" data-toggle="dropdown">
					<span class=""><i class="fa fa-plus"></i></span>
				</button>
				<ul class="dropdown-menu list-inline dropvk">
					<li onclick="groupsuggest(<?php echo $seriesrow->sid; ?>);">
						<a href="javascript:void(0);" title="COMMUNITY"><i class="fa fa-users"></i></a>
					</li>
					<li onclick="friend(<?php echo $seriesrow->sid;?>);">
						<a href="javascript:void(0);" title="SUGGEST"><i class="fa fa-user"></i></a>
					</li>
					<li onclick="socialshare(<?php echo $seriesrow->sid;?>, 'series');">
						<a data-toggle="modal" data-target="#soc" href="javascript:void(0);" title="SOCIAL">
							<i class="fa fa-share-alt"></i>
						</a>
					</li>
				</ul>
		    </div>
	    </div>
	<?php } } else if(isset($loadsearchresults) && ($loadsearchresults->num_rows() > 0) && ($_GET['type'] == 'story')){
	    $readlatersids = get_storiesreadlater('readlater');
        foreach($loadsearchresults->result() as $storyrow) { ?>
	        <div class="card">
				<div class="book-type"><?php echo $storyrow->gener;?></div>
				<a href="<?php echo base_url($this->uri->segment(1).'/story/'.preg_replace("~[^\p{M}\w]+~u", '-', $storyrow->title).'-'.$storyrow->sid);?>" class="imagesls-style">
					<?php if(isset($storyrow->image) && !empty($storyrow->image)) { ?>
					<img src="<?php echo base_url();?>assets/images/<?php echo $storyrow->image; ?>" alt="<?php echo ($storyrow->title);?>" class="imageme">
					<?php }else{ ?>
						<img src="<?php echo base_url();?>assets/default/series-stories.jpg" alt="<?php echo ($storyrow->title);?>" class="imageme">
					<?php } ?>
			    </a>
				<div>
					<font class="max-lines">
						<a href="<?php echo base_url($this->uri->segment(1).'/story/'.preg_replace("~[^\p{M}\w]+~u", '-', $storyrow->title).'-'.$storyrow->sid);?>">
							<?php echo ($storyrow->title);?>
						</a>
					</font> 
				</div>
				<div class="flextest">
					<font class="byname">By<font class="namehere">
					    <a href="<?php echo base_url($this->uri->segment(1).'/'.$storyrow->profile_name);?>" style="color:#000"> <?php echo $storyrow->name;?></a></font>
					</font><br>
				</div>
				<div class="flextest" style="padding-top:4px;">
					<font class="episodes">
						<font>
							<?php $wordcount = explode(' ', $storyrow->story);
					        $time = round(sizeof($wordcount)/180);	?>
							<b><?php if($time == 0){ echo 1;}else{ echo $time;}?></b> Min Story&nbsp;</font>
						<font>&nbsp;<i style="color: #3c8dbc" class="fa fa-eye" aria-hidden="true"></i><b> <?php echo $storyrow->views;?>&nbsp;</b></font>
						<font>&nbsp;<i style="color: #3c8dbc" class="fa fa-star" aria-hidden="true"></i>
							<b>
							<?php if(isset($reviews21) && ($reviews21->num_rows()>0)) {
								foreach($reviews21->result() as $reviews2) { 
									if($reviews2->sid == $storyrow->sid) {
										echo round($reviews2->rating);
									}
							} } ?>
							</b>
						</font>
					</font><br>
				</div>
				<div class="flextest" style="padding-top:6px">
					<?php if(isset($this->session->userdata['logged_in']['user_id']) && ($storyrow->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
						<button class="read" onclick="yoursreadlater();"><i class="fa fa-bookmark"></i> Read later </button>
					<?php }else{ ?>
						<?php if(isset($readlatersids) && (sizeof($readlatersids)>0) && in_array($storyrow->sid, $readlatersids)) { ?>
							<button onclick="unreadlater(<?php echo $storyrow->sid;?>)" class="readdone notloginmodal readlaterbtnatr<?php echo $storyrow->sid;?>">
							<i class="fa fa-check faicon<?php echo $storyrow->sid;?>"></i> Read later </button>
						<?php }else { ?>
							<button onclick="readlater(<?php echo $storyrow->sid;?>)" class="read notloginmodal readlaterbtnatr<?php echo $storyrow->sid;?>">
							<i class="fa fa-bookmark faicon<?php echo $storyrow->sid;?>"></i> Read later </button>
						<?php } ?>
					<?php } ?>
					
					<button type="button" class="btn read dropdown-toggle pull-right" data-toggle="dropdown">
						<span class=""><i class="fa fa-plus"></i></span>
					</button>
					<ul class="dropdown-menu list-inline dropvk">
						<li onclick="groupsuggest(<?php echo $storyrow->sid; ?>);">
							<a href="javascript:void(0);" title="COMMUNITY"><i class="fa fa-users"></i></a>
						</li>
						<li onclick="friend(<?php echo $storyrow->sid;?>);">
							<a href="javascript:void(0);" title="SUGGEST"><i class="fa fa-user"></i></a>
						<li onclick="socialshare(<?php echo $storyrow->sid;?>, 'story');">
							<a data-toggle="modal" data-target="#soc" href="javascript:void(0);" title="SOCIAL">
								<i class="fa fa-share-alt"></i>
							</a>
						</li>
					</ul>
				</div>
			</div> 
    <?php } } else if(isset($loadsearchresults) && ($loadsearchresults->num_rows() > 0) && ($_GET['type'] == 'life')){
        $readlatersids = get_storiesreadlater('readlater');
        foreach($loadsearchresults->result() as $liferow) { ?>
			<div class="card1">
				<a href="<?php echo base_url($this->uri->segment(1).'/story/'.preg_replace("~[^\p{M}\w]+~u", '-', $liferow->title).'-'.$liferow->sid);?>" class="imagelife-style">
    				<?php if(isset($liferow->image) && !empty($liferow->image)) { ?>
    					<img src="<?php echo base_url();?>assets/images/<?php echo $liferow->image; ?>" alt="<?php echo $liferow->title;?>" class="imageme1">
    				<?php }else{ ?>
    					<img src="<?php echo base_url();?>assets/images/life.jpg" alt="<?php echo $liferow->title;?>" class="imageme1">
    				<?php } ?>
				</a>	
				<div>
    				<font class="max-lines">
    					<a href="<?php echo base_url($this->uri->segment(1).'/story/'.preg_replace("~[^\p{M}\w]+~u", '-', $liferow->title).'-'.$liferow->sid);?>"><?php echo $liferow->title;?></a>
    				</font> 
				</div>
				<div class="flextest">
					<?php if(($liferow->writing_style == 'anonymous') && ($liferow->type == 'life')){ ?>
						<font class="byname">By<font class="namehere"><a href="" style="color:#000"> Anonymous</a></font></font><br>
					<?php } else { ?>
						<font class="byname">By<font class="namehere">
						    <a href="<?php echo base_url($this->uri->segment(1).'/'.$liferow->profile_name);?>" style="color:#000"> <?php echo $liferow->name;?></a></font></font>
						<br>
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
							<a data-toggle="modal" data-target="#groupsuggest" href="javascript:void(0);" title="COMMUNITY"><i class="fa fa-users"></i></a>
						</li>
						<li onclick="friend(<?php echo $liferow->sid;?>);">
							<a data-toggle="modal" data-target="#friendsuggest" href="javascript:void(0);" title="SUGGEST"><i class="fa fa-user"></i></a>
						</li>
						<li onclick="socialshare(<?php echo $liferow->sid;?>, 'story');">
							<a data-toggle="modal" data-target="#soc" href="javascript:void(0);" title="SOCIAL">
								<i class="fa fa-share-alt"></i>
							</a>
						</li>
					</ul>
				</div>
			</div>
	<?php } } else if(isset($loadsearchresults) && ($loadsearchresults->num_rows() > 0) && ($_GET['type'] == 'people')){
        foreach($loadsearchresults->result() as $writerrow) { ?>
			<div class="card1" style="height:215px">
    		    <?php if(isset($writerrow->pbanner_image) && !empty($writerrow->pbanner_image)){ ?>
		        <div class="imageme1" style="height:115px; background-position:center; background:url(<?php echo base_url();?>assets/images/<?php echo $writerrow->pbanner_image; ?>) center center; background-size:cover">
			        <div style="padding:9px; background:rgba(0, 0, 0, 0.64);height:115px;">
			            <a href="<?php echo base_url($this->uri->segment(1).'/'.$writerrow->profile_name);?>">
				            <?php if(isset($writerrow->profile_image) && !empty($writerrow->profile_image)) { ?>
				            	<img src="<?php echo base_url();?>assets/images/<?php echo $writerrow->profile_image; ?>" class="circle-image" alt="<?php echo $writerrow->name;?>" style="height:50px">
				            <?php }else{ ?>
				            	<img src="<?php echo base_url();?>assets/images/2.png" class="circle-image" alt="<?php echo $writerrow->name;?>" style="height:50px">
				            <?php } ?>
			            </a>
			            <h3 class="name-nanostories" style="color:#fff">
			                <a href="<?php echo base_url($this->uri->segment(1).'/'.$writerrow->profile_name);?>" style="color:#FFF;"><?php echo $writerrow->name;?></a>
			            </h3>
			            <p class="writerc"><?php echo $writerrow->aboutus; ?></p>
			        </div>
		        </div>
		        <?php }else{ ?>
		       <div class="imageme1" style="height:115px; background: linear-gradient(-60deg,RoyalBlue,brown); background-size:cover">
			        <div style="padding:9px; background:rgba(0, 0, 0, 0.64);height:115px;">
			            <a href="<?php echo base_url($this->uri->segment(1).'/'.$writerrow->profile_name);?>">
				            <?php if(isset($writerrow->profile_image) && !empty($writerrow->profile_image)) { ?>
				            	<img src="<?php echo base_url();?>assets/images/<?php echo $writerrow->profile_image; ?>" class="circle-image" alt="<?php echo $writerrow->name;?>" style="height:50px">
				            <?php }else{ ?>
				            	<img src="<?php echo base_url();?>assets/images/2.png" class="circle-image" alt="<?php echo $writerrow->name;?>" style="height:50px">
				            <?php } ?>
			            </a>
			            <h3 class="name-nanostories" style="color:#fff">
			                <a href="<?php echo base_url($this->uri->segment(1).'/'.$writerrow->profile_name);?>" style="color:#FFF;"><?php echo $writerrow->name;?></a>
			            </h3>
			            <p class="writerc"><?php echo $writerrow->aboutus; ?></p>
			        </div>
		        </div>
		        <?php } ?>
		        <div style="padding-top:6px;">
		            <center>
		                <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($this->session->userdata['logged_in']['user_id'] == $writerrow->user_id)){ ?>
                            <button class="vjw btn btn-success" onclick="yoursfollow()"> FOLLOW </button>
                        <?php } else { ?>
                            <?php if(isset($following) && in_array($writerrow->user_id, $following)) { ?>
                                <button class="vjw btn btn-primary notloginmodal unfollow<?php echo $writerrow->user_id;?>" onclick="writerunfollow(<?php echo $writerrow->user_id;?>,'<?php echo $writerrow->name;?>')"> FOLLOWING </button>
                            <?php } else { ?>
                                <button class="vjw btn btn-success notloginmodal follow<?php echo $writerrow->user_id;?>" onclick="writerfollow(<?php echo $writerrow->user_id;?>,'<?php echo $writerrow->name;?>')"> FOLLOW </button>
                            <?php } ?>
                        <?php } ?>
		            </center>
		            <ul class="list-inlinev writers" style="padding:0">
		                <li>
		                <?php $writings = get_writingsjoins($writerrow->user_id);
						    if(isset($writings['userwcount'])) { echo $writings['userwcount']; }else{ echo 0; } ?><br>
		                    WRITINGS
		                </li>
		                <li class="border-lr">
                        <?php $wstoriesviews = get_wstoriesviews($writerrow->user_id);
							if(isset($wstoriesviews['wstoriesviews'])) { echo $wstoriesviews['wstoriesviews']; }else{ echo 0; } ?><br>
		                    VIEWS
		                </li>
		                <li>
		                    <span id="follcount<?php echo $writerrow->user_id;?>">
                            <?php $reviewscount = 0; if(isset($follow_count) && ($follow_count->num_rows()>0)) {
                                foreach($follow_count->result() as $reviews2){ if($reviews2->writer_id == $writerrow->user_id) {
                                    $reviewscount = $reviews2->follo; 
                                }   } 
                            } echo $reviewscount; ?> </span><br>
		                    FOLLOWERS
		                </li>
		            </ul>
		        </div>
	        </div>
	<?php } } ?>