<?php $readlatersids = get_storiesreadlater('readlater'); 
if(isset($rlseries) && ($rlseries->num_rows() > 0)){ ?>
<div class="jc-m" style="display:flex; flex-wrap:wrap; justify-content:center;">
    <?php foreach($rlseries->result() as $rlseriesrow){ ?>
        <div class="card">
    		<div class="book-type"><?php echo $rlseriesrow->gener;?></div>
    		<a href="<?php echo base_url('series/'.preg_replace("~[^\p{M}\w]+~u",'-', $rlseriesrow->title).'-'.$rlseriesrow->sid.'/'.preg_replace("~[^\p{M}\w]+~u",'-', $rlseriesrow->title).'-'.$rlseriesrow->story_id);?>" class="imagesls-style">
    			<?php if(isset($rlseriesrow->image) && !empty($rlseriesrow->image)) { ?>
    			    <img src="<?php echo base_url();?>assets/images/<?php echo $rlseriesrow->image; ?>" alt="<?php echo ($rlseriesrow->title);?>" class="imagemels">
    			<?php }else{ ?>
    				<img src="<?php echo base_url();?>assets/default/series-stories.jpg" alt="<?php echo ($rlseriesrow->title);?>" class="imagemels">
    			<?php } ?>
    		</a>
    		<div>
    			<font class="max-lines">
    				<a href="<?php echo base_url('series/'.preg_replace("~[^\p{M}\w]+~u",'-', $rlseriesrow->title).'-'.$rlseriesrow->sid.'/'.preg_replace("~[^\p{M}\w]+~u",'-', $rlseriesrow->title).'-'.$rlseriesrow->story_id);?>">
    					<?php echo ($rlseriesrow->title);?>
    				</a>
    			</font> 
    		</div>
    		<div class="flextest">
    			<font class="byname">By<font class="namehere"><a href="<?php echo base_url($rlseriesrow->profile_name);?>" style="color:#000"> <?php echo $rlseriesrow->name;?></a></font></font>
    			<br>
    		</div>
    		<div class="flextest" style="padding-top:4px;">
    			<font class="episodes">
    				<?php $keycount = get_episodecount($rlseriesrow->sid); 
    				if(isset($keycount)){ echo $keycount; }else{ echo 0; }?> EPISODES | <?php $subsmemcount = get_storysubscount($rlseriesrow->sid); 
    				if(isset($subsmemcount)){echo $subsmemcount; }else{echo 0; } ?> MEMBERS
    			</font><br>
    		</div>
    		<div class="flextest" style="padding-top:6px">
    			<?php if(isset($this->session->userdata['logged_in']['user_id']) && ($rlseriesrow->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
    				
    					<button class="read" onclick="yoursreadlater();"><i class="fa fa-bookmark"></i> Read later </button>
    				
    			<?php }else{ ?>
    				<?php if(isset($readlatersids) && (sizeof($readlatersids)>0) && in_array($rlseriesrow->sid, $readlatersids)) { ?>
    					<button onclick="unreadlater(<?php echo $rlseriesrow->sid;?>)" class="readdone notloginmodal readlaterbtnatr<?php echo $rlseriesrow->sid;?>">
    					<i class="fa fa-check faicon<?php echo $rlseriesrow->sid;?>"></i> Read later </button>
    				<?php }else { ?>
    					<button onclick="readlater(<?php echo $rlseriesrow->sid;?>)" class="read notloginmodal readlaterbtnatr<?php echo $rlseriesrow->sid;?>">
    					<i class="fa fa-bookmark faicon<?php echo $rlseriesrow->sid;?>"></i> Read later </button>
    				<?php } ?>
    			<?php } ?>
    			
    			<button type="button" class="btn read dropdown-toggle pull-right" data-toggle="dropdown">
    				<span class=""><i class="fa fa-plus"></i></span>
    			</button>
    			<ul class="dropdown-menu list-inline dropvk">
    				<li onclick="groupsuggest(<?php echo $rlseriesrow->sid; ?>);">
    					<a data-toggle="modal" data-target="#groupsuggest" href="javascript:void(0);"  title="COMMUNITY"><i class="fa fa-users"></i></a>
    				</li>
    				<li onclick="friend(<?php echo $rlseriesrow->sid;?>);">
    					<a data-toggle="modal" data-target="#friendsuggest" href="javascript:void(0);"  title="SUGGEST"><i class="fa fa-user"></i></a>
    				</li>
    				<li onclick="socialshare(<?php echo $rlseriesrow->sid;?>,'series');">
    					<a data-toggle="modal" data-target="#soc"  href="javascript:void(0);"  title="SOCIAL">
    						<i class="fa fa-share-alt"></i>
    					</a>
    				</li>
    			</ul>
    		</div>
    	
    	</div>
    <?php } ?>
</div>
<?php }else if(isset($rlstories) && ($rlstories->num_rows() > 0)) { ?>
<div class="jc-m" style="display:flex; flex-wrap:wrap; justify-content:center;">
	<?php foreach($rlstories->result() as $rlstoryrow) { ?>
    	<div class="card">
        	<div class="book-type"><?php echo $rlstoryrow->gener;?></div>
        	<a href="<?php echo base_url('story/'.preg_replace("~[^\p{M}\w]+~u",'-', $rlstoryrow->title).'-'.$rlstoryrow->sid);?>" class="imagesls-style">
        		<?php if(isset($rlstoryrow->image) && !empty($rlstoryrow->image)) { ?>
        		    <img src="<?php echo base_url();?>assets/images/<?php echo $rlstoryrow->image; ?>" alt="<?php echo ($rlstoryrow->title);?>" class="imageme">
        		<?php }else{ ?>
        			<img src="<?php echo base_url();?>assets/default/series-stories.jpg" alt="<?php echo ($rlstoryrow->title);?>" class="imageme">
        		<?php } ?>
        	</a>
        	<div>
        		<font class="max-lines">
        			<a href="<?php echo base_url('story/'.preg_replace("~[^\p{M}\w]+~u",'-', $rlstoryrow->title).'-'.$rlstoryrow->sid);?>">
        				<?php echo ($rlstoryrow->title);?>
        			</a>
        		</font> 
        	</div>
        	<div class="flextest">
        		<font class="byname">By<font class="namehere"><a href="<?php echo base_url($rlstoryrow->profile_name);?>" style="color:#000"> <?php echo $rlstoryrow->name;?></a></font></font>
        		<br>
        	</div>
        	<div class="flextest" style="padding-top:4px;">
               	<font class = "episodes">
               		<font>
               			<?php $wordcount = explode(' ', $rlstoryrow->story);
                   	$time = round(sizeof($wordcount)/50);	?>
               			<b><?php if($time == 0){ echo 1;}else{ echo $time;}?></b> Min Story&nbsp;</font>
               		<font>&nbsp;<i style="color: #3c8dbc" class="fa fa-eye" aria-hidden="true"></i><b> <?php echo $rlstoryrow->views;?>&nbsp;</b></font>
               		<font>&nbsp;<i style="color: #3c8dbc" class="fa fa-star" aria-hidden="true"></i>
               			<b>
               			<?php if(isset($reviews21) && ($reviews21->num_rows()>0)) {
               				foreach($reviews21->result() as $reviews2) { 
               					if($reviews2->sid == $rlstoryrow->sid) {
               						echo round($reviews2->rating);
               					}
               			} } ?>
               			</b>
               		</font>
               	</font><br>
               </div>
        	<div class="flextest" style="padding-top:6px">
        		<?php if(isset($this->session->userdata['logged_in']['user_id']) && ($rlstoryrow->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
        			
        				<button class="read" onclick="yoursreadlater();"><i class="fa fa-bookmark"></i> Read later </button>
        			
        		<?php }else{ ?>
        			<?php if(isset($readlatersids) && (sizeof($readlatersids)>0) && in_array($rlstoryrow->sid, $readlatersids)) { ?>
        				<button onclick="unreadlater(<?php echo $rlstoryrow->sid;?>)" class="readdone notloginmodal readlaterbtnatr<?php echo $rlstoryrow->sid;?>">
        				<i class="fa fa-check faicon<?php echo $rlstoryrow->sid;?>"></i> Read later </button>
        			<?php }else { ?>
        				<button onclick="readlater(<?php echo $rlstoryrow->sid;?>)" class="read notloginmodal readlaterbtnatr<?php echo $rlstoryrow->sid;?>">
        				<i class="fa fa-bookmark faicon<?php echo $rlstoryrow->sid;?>"></i> Read later </button>
        			<?php } ?>
        		<?php } ?>
        		
        		<button type="button" class="btn read dropdown-toggle pull-right" data-toggle="dropdown">
        			<span class=""><i class="fa fa-plus"></i></span>
        		</button>
        		<ul class="dropdown-menu list-inline dropvk">
        			<li onclick="groupsuggest(<?php echo $rlstoryrow->sid; ?>);">
        				<a data-toggle="modal" data-target="#groupsuggest" href="javascript:void(0);"  title="COMMUNITY"><i class="fa fa-users"></i></a>
        			</li>
        			<li onclick="friend(<?php echo $rlstoryrow->sid;?>);">
        				<a data-toggle="modal" data-target="#friendsuggest" href="javascript:void(0);"  title="SUGGEST"><i class="fa fa-user"></i></a>
        			</li>
        			<li onclick="socialshare(<?php echo $rlstoryrow->sid;?>, 'story');">
        				<a data-toggle="modal" data-target="#soc" href="javascript:void(0);" title="SOCIAL">
        					<i class="fa fa-share-alt"></i>
        				</a>
        			</li>
        		</ul>
        	</div>
        
        </div>
	<?php } ?>
</div>
<?php }else if(isset($rllife) && ($rllife->num_rows() > 0)) { ?>
<div style="display:flex; flex-wrap:wrap;" class="jsw">
    <?php foreach($rllife->result() as $rlliferow) { if($rlliferow->writing_style != 'anonymous'){ ?>
        <div class="card1">
    		<a href="<?php echo base_url('story/'.preg_replace("~[^\p{M}\w]+~u",'-', $rlliferow->title).'-'.$rlliferow->sid);?>" class="imagelife-style">
    			<?php if(isset($rlliferow->image) && !empty($rlliferow->image)) { ?>
    				<img src="<?php echo base_url();?>assets/images/<?php echo $rlliferow->image; ?>" alt="<?php echo $rlliferow->title;?>" class="imageme1">
    			<?php }else{ ?>
    				<img src="<?php echo base_url();?>assets/default/life.jpg" alt="<?php echo $rlliferow->title;?>" class="imageme1">
    			<?php } ?>
    		</a>
    		<div>
    			<font class="max-lines">
    				<a href="<?php echo base_url('story/'.preg_replace("~[^\p{M}\w]+~u",'-', $rlliferow->title).'-'.$rlliferow->sid);?>">
    					<?php echo $rlliferow->title;?>
    				</a>
    			</font> 
    		</div>
    		<div class="flextest">
    			<?php if(($rlliferow->writing_style == 'anonymous') && ($rlliferow->type == 'life')){ ?>
    				<font class="byname">By<font class="namehere"> Anonymous</font></font><br>
    			<?php } else { ?>
    				<font class="byname">By<font class="namehere"><a href="<?php echo base_url().$rlliferow->profile_name; ?>" style="color:#000"> <?php echo $rlliferow->name;?></a></font></font>
    				<br>
    			<?php } ?>
    		</div>
    		<div class="flextest" style="padding-top:4px;">
    			<font class="lifeEvents-text"><?php echo substr(strip_tags($rlliferow->story),0,150);?> </font>
    		</div>
    	
    		<div class="flextest" style="padding-top:6px">
    			<?php if(isset($this->session->userdata['logged_in']['user_id']) && ($rlliferow->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
    				<button class="read" onclick="yoursreadlater();"><i class="fa fa-bookmark"></i> Read later </button>
    			<?php }else{ ?>
    				<?php if(isset($readlatersids) && (sizeof($readlatersids)>0) && in_array($rlliferow->sid, $readlatersids)) { ?>
    					<button onclick="unreadlater(<?php echo $rlliferow->sid;?>)" class="readdone notloginmodal readlaterbtnatr<?php echo $rlliferow->sid;?>">
    					<i class="fa fa-check faicon<?php echo $rlliferow->sid;?>"></i> Read later </button>
    				<?php }else { ?>
    					<button onclick="readlater(<?php echo $rlliferow->sid;?>)" class="read notloginmodal readlaterbtnatr<?php echo $rlliferow->sid;?>">
    					<i class="fa fa-bookmark faicon<?php echo $rlliferow->sid;?>"></i> Read later </button>
    				<?php } ?>
    			<?php } ?>
    			
    			<button type="button" class="btn read dropdown-toggle pull-right" data-toggle="dropdown">
    				<span class=""><i class="fa fa-plus"></i></span>
    			</button>
    			<ul class="dropdown-menu list-inline dropvklife">
    				<li onclick="groupsuggest(<?php echo $rlliferow->sid; ?>);">
    					<a data-toggle="modal" data-target="#groupsuggest"  href="javascript:void(0);" title="COMMUNITY"><i class="fa fa-users"></i></a>
    				</li>
    				<li onclick="friend(<?php echo $rlliferow->sid;?>);">
    					<a data-toggle="modal" data-target="#friendsuggest"  href="javascript:void(0);" title="SUGGEST"><i class="fa fa-user"></i></a>
    				</li>
    				<li onclick="socialshare(<?php echo $rlliferow->sid;?>, 'story');">
    					<a data-toggle="modal" data-target="#soc" href="javascript:void(0);" title="SOCIAL">
    						<i class="fa fa-share-alt"></i>
    					</a>
    				</li>
    			</ul>
    		</div>
    	</div>	
    <?php } } ?>
</div>
<?php } ?>