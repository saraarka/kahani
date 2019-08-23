<?php $frscount = 0; if(isset($frseries) && ($frseries->num_rows() > 0)){ $frscount = $frscount+$frseries->num_rows();  ?>
    <div class="row pt-0">
        <div class="col-md-6 col-xs-8 pd-0">
        	<div class="titlei">SERIES</div>
        </div>
    </div><hr>
    <div class="jc-m" style="display:flex; flex-wrap:wrap; margin-bottom:25px;">
        <?php foreach($frseries->result() as $frseriesrow){ ?>
            <div class="cardls" id="frlibdel<?php echo $frseriesrow->sid;?>">
		        <div class="book-typels"><?php echo $frseriesrow->gener;?></div>
	            <a href="<?php echo base_url('series/'.preg_replace("~[^\p{M}\w]+~u",'-', $frseriesrow->title).'-'.$frseriesrow->sid.'/'.preg_replace("~[^\p{M}\w]+~u",'-', $frseriesrow->title).'-'.$frseriesrow->story_id);?>" class="imagesls-style">
    	            <?php if(isset($frseriesrow->image) && !empty($frseriesrow->image)) { ?>
    	                <img src="<?php echo base_url();?>assets/images/<?php echo $frseriesrow->image; ?>" alt="<?php echo $frseriesrow->title;?>" class="imagemels">
    	            <?php }else{ ?>
    	            	<img src="<?php echo base_url();?>assets/default/series-stories.jpg" alt="<?php echo $frseriesrow->title;?>" class="imagemels">
    	            <?php } ?>
	            </a>
    	            <div class="bottom-left">
    	                <a href="javascript:void(0)" onclick="deletefrlibrary(<?php echo $frseriesrow->sid;?>);">
					    <i class="fa fa-trash"></i></a>
					</div>
    	            <div class="clear-fix"></div>
				    <div style="margin-top:-18px;">
    	            	<font class="max-linesls">
    	            		<a href="<?php echo base_url('series/'.preg_replace("~[^\p{M}\w]+~u",'-', $frseriesrow->title).'-'.$frseriesrow->sid.'/'.preg_replace("~[^\p{M}\w]+~u",'-', $frseriesrow->title).'-'.$frseriesrow->story_id);?>">
    	            			<?php echo $frseriesrow->title;?>
    	            		</a>
    	            	</font> 
    	            </div>
					<div class="flextestls">
		                <font class="bynamels">By<font class="nameherels"><a href="<?php echo base_url($frseriesrow->profile_name);?>" style="color:#000;"> <?php echo $frseriesrow->name;?></a></font></font>
                        <br>
					</div>
				    <div class="flextestls" style="padding-top:4px;">
	                  <font class="episodesls">
		                    <?php $keycount = get_episodecount($frseriesrow->sid); 
			                    if(isset($keycount)){ echo $keycount; }else{ echo 0; }?> EPISODES |
			                <?php $subsmemcount = get_storysubscount($frseriesrow->sid); 
								if(isset($subsmemcount)){echo $subsmemcount; }else{echo 0; } ?> MEMBERS
						</font><br>
					</div>
		            <div class="flextestls" style="padding-top:6px">
		                <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($frseriesrow->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
                            <button class="read" style="background:none; border:none;" onclick="yoursreadlater();"><i class="fa fa-bookmark"></i> Read later </button>
                        <?php }else{ ?>
        	            	<?php if(isset($readlatersids) && (sizeof($readlatersids)>0) && in_array($frseriesrow->sid, $readlatersids)) { ?>
        	            		<button onclick="unreadlater(<?php echo $frseriesrow->sid;?>)" class="readdone notloginmodal readlaterbtnatr<?php echo $frseriesrow->sid;?>">
        	            		<i class="fa fa-check faicon<?php echo $frseriesrow->sid;?>"></i> Read later </button>
        	            	<?php }else { ?>
        	            		<button onclick="readlater(<?php echo $frseriesrow->sid;?>)" class="read notloginmodal readlaterbtnatr<?php echo $frseriesrow->sid;?>">
        	            		<i class="fa fa-bookmark faicon<?php echo $frseriesrow->sid;?>"></i> Read later </button>
        	            	<?php } ?>
        	            <?php } ?>
            	        <button type="button" class="btn read dropdown-toggle pull-right" data-toggle="dropdown">
            				<span class=""><i class="fa fa-plus"></i></span>
            			</button>
            			<ul class="dropdown-menu list-inline dropvk">
            				<li onclick="groupsuggest(<?php echo $frseriesrow->sid; ?>);">
            					<a href="javascript:void(0)" data-toggle="modal" data-target="#groupsuggest" title="COMMUNITY"><i class="fa fa-users"></i></a>
            				</li>
            				<li onclick="friend(<?php echo $frseriesrow->sid;?>);">
            					<a href="javascript:void(0)" data-toggle="modal" data-target="#friendsuggest" title="SUGGEST"><i class="fa fa-user"></i></a>
            				</li>
            				<li onclick="socialshare(<?php echo $frseriesrow->sid;?>, 'series');">
            					<a data-toggle="modal" data-target="#soc" href="javascript:void(0)" title="SOCIAL">
            						<i class="fa fa-share-alt"></i>
            					</a>
            				</li>
            			</ul>
	                </div>
		        </div>
        <?php } ?>
    </div>
<?php } ?>

<?php if(isset($frstories) && ($frstories->num_rows() > 0)){ $frscount = $frscount+$frstories->num_rows(); ?>
    <div class="row pt-0">
        <div class="col-md-6 col-xs-8 pd-0">
        	<div class="titlei">STORIES</div>
        </div>
    </div><hr>
    <div class="jc-m" style="display:flex; flex-wrap:wrap; margin-bottom:25px;">
		<?php foreach($frstories->result() as $frstoriesrow) { ?>
		<div class="cardls" id="frlibdel<?php echo $frstoriesrow->sid;?>">
	        <div class="book-type"><?php echo $frstoriesrow->gener;?></div>
			<a href="<?php echo base_url('story/'.preg_replace("~[^\p{M}\w]+~u",'-', $frstoriesrow->title).'-'.$frstoriesrow->sid);?>" class="product-title imagesls-style">
				<?php if(isset($frstoriesrow->image) && !empty($frstoriesrow->image)) { ?>
			        <img src="<?php echo base_url();?>assets/images/<?php echo $frstoriesrow->image; ?>" alt="<?php echo $frstoriesrow->name; ?>" class="imagemels">
				<?php }else{ ?>
					<img src="<?php echo base_url();?>assets/default/series-stories.jpg" alt="<?php echo $frstoriesrow->name; ?>" class="imagemels">
				<?php } ?>
			</a>
			<div class="bottom-left">
			    <a href="javascript:void(0)" onclick="deletefrlibrary(<?php echo $frstoriesrow->sid;?>);">
			    <i class="fa fa-trash"></i></a>
			</div>
	    	<div class="clear-fix"></div>
			<div style="margin-top:-18px;">
				<font class="max-lines">
					<a href="<?php echo base_url('story/'.preg_replace("~[^\p{M}\w]+~u",'-', $frstoriesrow->title).'-'.$frstoriesrow->sid);?>" class="product-title">
					    <?php echo $frstoriesrow->title;?>
					</a>
				</font> 
			</div>
			<div class="flextest">
				<font class="byname">By<font class="namehere"><a href="<?php echo base_url($frstoriesrow->profile_name);?>" style="color:#000;"> <?php echo $frstoriesrow->name;?></a></font></font>
				<br>
			</div>
			<div class="flextest" style="padding-top:4px;">
				<font class = "episodes">
					<font>
						<?php $wordcount = explode(' ', $frstoriesrow->story);
					    $time = round(sizeof($wordcount)/50);	?>
						<b><?php if($time == 0){ echo 1;}else{ echo $time;}?></b> Min Story&nbsp;</font>
					<font>&nbsp;<i style="color: #3c8dbc" class="fa fa-eye" aria-hidden="true"></i><b> <?php echo $frstoriesrow->views;?>&nbsp;</b></font>
					<font>&nbsp;<i style="color: #3c8dbc" class="fa fa-star" aria-hidden="true"></i>
						<b><?php if(isset($reviews21) && ($reviews21->num_rows()>0)) {
							foreach($reviews21->result() as $reviews2) { 
								if($reviews2->sid == $frstoriesrow->sid) {
									echo round($reviews2->rating);
								}
						} } ?></b>
					</font>
				</font><br>
			</div>
		    <div class="flextest" style="padding-top:6px">
				<?php if(isset($this->session->userdata['logged_in']['user_id']) && ($frstoriesrow->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
					<button class="read" style="background:none; border:none;" onclick="yoursreadlater();"><i class="fa fa-bookmark"></i> Read later </button>
				<?php }else{ ?>
					<?php if(isset($readlatersids) && (sizeof($readlatersids)>0) && in_array($frstoriesrow->sid, $readlatersids)) { ?>
						<button onclick="unreadlater(<?php echo $frstoriesrow->sid;?>)" class="readdone notloginmodal readlaterbtnatr<?php echo $frstoriesrow->sid;?>">
						<i class="fa fa-check faicon<?php echo $frstoriesrow->sid;?>"></i> Read later </button>
					<?php }else { ?>
						<button onclick="readlater(<?php echo $frstoriesrow->sid;?>)" class="read notloginmodal readlaterbtnatr<?php echo $frstoriesrow->sid;?>">
						<i class="fa fa-bookmark faicon<?php echo $frstoriesrow->sid;?>"></i> Read later </button>
					<?php } ?>
				<?php } ?>
			
				<button type="button" class="btn read dropdown-toggle pull-right" data-toggle="dropdown">
					<span class=""><i class="fa fa-plus"></i></span>
				</button>
				<ul class="dropdown-menu list-inline dropvk">
					<li onclick="groupsuggest(<?php echo $frstoriesrow->sid; ?>);">
						<a href="javascript:void(0)" data-toggle="modal" data-target="#groupsuggest" title="COMMUNITY"><i class="fa fa-users"></i></a>
					</li>
					<li onclick="friend(<?php echo $frstoriesrow->sid;?>);">
						<a href="javascript:void(0)" data-toggle="modal" data-target="#friendsuggest" title="SUGGEST"><i class="fa fa-user"></i></a>
					</li>
					<li onclick="socialshare(<?php echo $frstoriesrow->sid;?>, 'story');">
						<a data-toggle="modal" data-target="#soc" href="javascript:void(0)" title="SOCIAL">
							<i class="fa fa-share-alt"></i>
						</a>
					</li>
				</ul>
			</div>
        </div><!-- cardls -->
		<?php } ?>
    </div>
<?php } ?>

<?php if(isset($frlife) && ($frlife->num_rows() > 0)){ $frscount = $frscount+$frlife->num_rows(); ?>
    <div class="row pt-0">
        <div class="col-md-6 col-xs-8 pd-0">
        	<div class="titlei">LIFE EVENTS</div>
        </div>
    </div><hr>
    <div class="jc-m" style="display:flex; flex-wrap:wrap; margin-bottom:25px;">
        <?php foreach($frlife->result() as $frliferow) { ?>
            <div class="card1" style="margin-top:10px" id="frlibdel<?php echo $frliferow->sid;?>">
				<a href="<?php echo base_url('story/'.preg_replace("~[^\p{M}\w]+~u",'-', $frliferow->title).'-'.$frliferow->sid);?>" class="imagelife-style">
					<?php if(isset($frliferow->image) && !empty($frliferow->image)) { ?>
						<img src="<?php echo base_url();?>assets/images/<?php echo $frliferow->image; ?>" alt="<?php echo $frliferow->title;?>" class="imageme1">
					<?php }else{ ?>
						<img src="<?php echo base_url();?>assets/default/life.jpg" alt="<?php echo $frliferow->title;?>" class="imageme1">
					<?php } ?>
			    </a>
			    <div class="bottom-left bottom-left-life" style="top: -158px;">
				    <a href="javascript:void(0)" onclick="deletefrlibrary(<?php echo $frliferow->sid;?>);">
				    <i class="fa fa-trash"></i></a>
				</div>
				<div style="margin-top:-22px;">
					<font class="max-lines">
						<a href="<?php echo base_url('story/'.preg_replace("~[^\p{M}\w]+~u",'-', $frliferow->title).'-'.$frliferow->sid);?>">
						    <?php echo $frliferow->title;?>
						</a>
					</font> 
				</div>
				<div class="flextest">
					<?php if(($frliferow->writing_style == 'anonymous') && ($frliferow->type == 'life')){ ?>
						<font class="byname">By<font class="namehere"> Anonymous</font></font><br>
					<?php } else { ?>
						<font class="byname">By<font class="namehere"><a href="<?php echo base_url($frliferow->profile_name);?>" style="color:#000;"> <?php echo $frliferow->name;?></a></font></font>
						<br>
					<?php } ?>
				</div>
				<div class="flextest" style="padding-top:4px;">
					<font class="lifeEvents-text"><?php echo substr(strip_tags($frliferow->story),0,150);?></font>
				</div>
				<div class="flextest" style="padding-top:6px">
					<?php if(isset($this->session->userdata['logged_in']['user_id']) && ($frliferow->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
						<button class="read" onclick="yoursreadlater();"><i class="fa fa-bookmark"></i> Read later </button>
					<?php }else{ ?>
						<?php if(isset($readlatersids) && (sizeof($readlatersids)>0) && in_array($frliferow->sid, $readlatersids)) { ?>
							<button onclick="unreadlater(<?php echo $frliferow->sid;?>)" class="readdone notloginmodal readlaterbtnatr<?php echo $frliferow->sid;?>">
							<i class="fa fa-check faicon<?php echo $frliferow->sid;?>"></i> Read later </button>
						<?php }else { ?>
							<button onclick="readlater(<?php echo $frliferow->sid;?>)" class="read notloginmodal readlaterbtnatr<?php echo $frliferow->sid;?>">
							<i class="fa fa-bookmark faicon<?php echo $frliferow->sid;?>"></i> Read later </button>
						<?php } ?>
					<?php } ?>
					
					<button type="button" class="btn read dropdown-toggle pull-right" data-toggle="dropdown">
						<span class=""><i class="fa fa-plus"></i></span>
					</button>
					<ul class="dropdown-menu list-inline dropvklife">
						<li onclick="groupsuggest(<?php echo $frliferow->sid; ?>);">
							<a href="javascript:void(0)" data-toggle="modal" data-target="#groupsuggest" title="COMMUNITY"><i class="fa fa-users"></i></a>
						</li>
						<li onclick="friend(<?php echo $frliferow->sid;?>);">
							<a href="javascript:void(0)" data-toggle="modal" data-target="#friendsuggest" title="SUGGEST"><i class="fa fa-user"></i></a>
						</li>
						<li onclick="socialshare(<?php echo $frliferow->sid;?>, 'story');">
							<a data-toggle="modal" data-target="#soc" href="javascript:void(0)" title="SOCIAL">
								<i class="fa fa-share-alt"></i>
							</a>
						</li>
					</ul>
				</div>
	        </div>
        <?php } ?>
    </div>
<?php } ?>
<?php if($frscount <= 0){ ?>
    <div class="outerv">
        <div class="middlev">
            <div class="innerv">
                <img src="<?php echo base_url();?>assets/images/nodata.svg" class="img-responsive" style="width:100%;" alt="No Data">
            </div>
            <div class="innervd">NO STORIES FOUND</div>
        </div>
    </div>
<?php } ?>