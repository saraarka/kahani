<?php if(isset($viewallloadmore) && ($viewallloadmore->num_rows() >0)){ ?>
    <?php foreach ($viewallloadmore->result() as $vahseriesrow) { ?>
        <div class="cardls">
			<div class="book-type"><?php echo $vahseriesrow->gener;?></div>
			    <a href="<?php echo base_url($this->uri->segment(1).'/series/'.preg_replace('/\s+/', '-', $vahseriesrow->title).'-'.$vahseriesrow->sid.'/'.preg_replace('/\s+/', '-', $vahseriesrow->title).'-'.$vahseriesrow->story_id);?>" class="product-title imagess-style">
    			    <?php if(isset($vahseriesrow->image) && !empty($vahseriesrow->image)) { ?>
    				<img src="<?php echo base_url();?>assets/images/<?php echo $vahseriesrow->image; ?>" alt="<?php echo $vahseriesrow->title;?>" class="imageme">
    				<?php }else{ ?>
    					<img src="<?php echo base_url();?>assets/images/series-stories.jpg" alt="<?php echo $vahseriesrow->title;?>" class="imageme">
    				<?php } ?>
				</a>
				<div>
					<font class="max-lines">
						<a href="<?php echo base_url($this->uri->segment(1).'/series/'.preg_replace('/\s+/', '-', $vahseriesrow->title).'-'.$vahseriesrow->sid.'/'.preg_replace('/\s+/', '-', $vahseriesrow->title).'-'.$vahseriesrow->story_id);?>" class="product-title">
							<?php echo $vahseriesrow->title;?>
						</a>
					</font> 
				</div>
			    <div class="flextest">
				    <font class="byname">By<font class="namehere">
				        <a href="<?php echo base_url($this->uri->segment(1)."/".$vahseriesrow->profile_name);?>" style="color:#000"><?php echo $vahseriesrow->name;?></a></font>
				    </font><br>
			    </div>
				<div class="flextest" style="padding-top:4px;">
			        <font class="episodes">
				<?php $keycount = get_episodecount($vahseriesrow->sid); 
					if(isset($keycount)){ echo $keycount; }else{ echo 0; }?> EPISODES | 
					<?php $subsmemcount = get_storysubscount($vahseriesrow->sid); 
					if(isset($subsmemcount)){echo $subsmemcount; }else{echo 0; } ?> MEMBERS</font><br>
			    </div>
		        <div class="flextest" style="padding-top:6px">
		        <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($vahseriesrow->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
			    	<button class="read" style="background:none; border:none;" onclick="yoursreadlater();"><i class="fa fa-bookmark"></i> Read later </button>
	            <?php }else if(isset($this->session->userdata['logged_in']['user_id'])){ ?>
                	<?php if(isset($readlatersids) && (sizeof($readlatersids)>0) && in_array($vahseriesrow->sid, $readlatersids)) { ?>
                		<button onclick="unreadlater(<?php echo $vahseriesrow->sid;?>)" class="readdone notloginmodal readlaterbtnatr<?php echo $vahseriesrow->sid;?>">
                		<i class="fa fa-check faicon<?php echo $vahseriesrow->sid;?>"></i> Read later </button>
                	<?php }else { ?>
                		<button onclick="readlater(<?php echo $vahseriesrow->sid;?>)" class="read notloginmodal readlaterbtnatr<?php echo $vahseriesrow->sid;?>">
                		<i class="fa fa-bookmark faicon<?php echo $vahseriesrow->sid;?>"></i> Read later </button>
                	<?php } ?>
                <?php } else{ ?>
                    <button class="read notloginmodal" data-toggle="modal" data-target="#loginmodal"><i class="fa fa-bookmark"></i> Read later </button>
				<?php } ?>
		            
		            <button type="button" class="btn read dropdown-toggle pull-right" data-toggle="dropdown">
			    		<span class=""><i class="fa fa-plus"></i></span>
			    	</button>
			    	<ul class="dropdown-menu list-inline dropvk">
			    		<li onclick="groupsuggest(<?php echo $vahseriesrow->sid; ?>);">
			    			<a href="javascript:void(0)" data-toggle="modal" data-target="#groupsuggest" title="COMMUNITY"><i class="fa fa-users"></i></a>
			    		</li>
			    		<li onclick="friend(<?php echo $vahseriesrow->sid;?>);">
			    			<a href="javascript:void(0)" data-toggle="modal" data-target="#friendsuggest" title="SUGGEST"><i class="fa fa-user"></i></a>
			    		</li>
			    		<li onclick="socialshare(<?php echo $vahseriesrow->sid;?>, 'series');">
			    			<a data-toggle="modal" data-target="#soc" href="javascript:void(0)" title="SOCIAL">
			    				<i class="fa fa-share-alt"></i>
			    			</a>
			    		</li>
			    	</ul>
		        </div><!-- flextest -->
		</div>
	<?php } ?>
<?php } ?>