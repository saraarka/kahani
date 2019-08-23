<?php if(isset($viewallyournetwork) && ($viewallyournetwork->num_rows() >0)){ foreach($viewallyournetwork->result() as $loadyournetwork) { ?>
    <div class="cardls">
		<div class="book-typels"><?php echo $loadyournetwork->gener;?></div>
		<?php $yournwurl = base_url('story/'.preg_replace("~[^\p{M}\w]+~u",'-', $loadyournetwork->title).'-'.$loadyournetwork->sid);
			$langfullname = get_langfullname($loadyournetwork->language); 
			if(isset($langfullname) && !empty($langfullname)){
			    $yournwurl = base_url($langfullname.'/story/'.preg_replace("~[^\p{M}\w]+~u",'-', $loadyournetwork->title).'-'.$loadyournetwork->sid);
			} ?>
			<a href="<?php echo $yournwurl;?>" class="imagesls-style">
				<?php if(isset($loadyournetwork->cover_image) && !empty($loadyournetwork->cover_image)) { ?>
			        <img src="<?php echo base_url();?>assets/images/<?php echo $loadyournetwork->cover_image; ?>" alt="<?php echo $loadyournetwork->title;?>" class="imagemels">
			    <?php }else{ ?>
				    <img src="<?php echo base_url();?>assets/default/series-stories.jpg" alt="<?php echo $loadyournetwork->title;?>" class="imagemels">
			    <?php } ?>
			</a>
		<div>
			<font class="max-linesls"><a href="<?php echo $yournwurl;?>" class="product-title"><?php echo $loadyournetwork->title;?></a></font> 
		</div>
		<div class="flextestls">
			<font class="bynamels">By<font class="nameherels">
			    <a href="<?php echo base_url().$loadyournetwork->profile_name; ?>" style="color:#000"><?php echo $loadyournetwork->name;?></a></font></font><br>
		</div>
					
		<div class="flextestls" style="padding-top:4px;">
			<font class="episodesls">
				<font>
					<?php $wordcount = explode(' ', $loadyournetwork->story);
				        $time = round(sizeof($wordcount)/180);	?>
					<b><?php if($time == 0){ echo 1;}else{ echo $time;}?></b> Min Story&nbsp;</font>
				<font>&nbsp;<i style="color: #3c8dbc" class="fa fa-eye" aria-hidden="true"></i><b> <?php echo $loadyournetwork->views;?>&nbsp;</b></font>
				<font>&nbsp;<i style="color: #3c8dbc" class="fa fa-star" aria-hidden="true"></i>
					<b>
					<?php if(isset($reviews21) && ($reviews21->num_rows()>0)) {
						foreach($reviews21->result() as $reviews2) { 
							if($reviews2->sid == $loadyournetwork->sid) {
								echo round($reviews2->rating);
							}
					} } ?>
					</b>
				</font>
			</font><br>
		</div>
		
		<div class="flextestls" style="padding-top:6px">
			<?php if(isset($this->session->userdata['logged_in']['user_id']) && ($loadyournetwork->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
				<button class="read" onclick="yoursreadlater();"><i class="fa fa-bookmark"></i> Read later </button>
			<?php }else{ ?>
				<?php if(isset($readlatersids) && (sizeof($readlatersids)>0) && in_array($loadyournetwork->sid, $readlatersids)) { ?>
					<button onclick="unreadlater(<?php echo $loadyournetwork->sid;?>)" class="readdone notloginmodal readlaterbtnatr<?php echo $loadyournetwork->sid;?>">
					<i class="fa fa-check faicon<?php echo $loadyournetwork->sid;?>"></i> Read later </button>
				<?php }else { ?>
					<button onclick="readlater(<?php echo $loadyournetwork->sid;?>)" class="read notloginmodal readlaterbtnatr<?php echo $loadyournetwork->sid;?>">
					<i class="fa fa-bookmark faicon<?php echo $loadyournetwork->sid;?>"></i> Read later </button>
				<?php } ?>
			<?php } ?>
			
			<button type="button" class="btn read dropdown-toggle pull-right" data-toggle="dropdown">
				<span class=""><i class="fa fa-plus"></i></span>
			</button>
			<ul class="dropdown-menu list-inline dropvk">
				<li onclick="groupsuggest(<?php echo $loadyournetwork->sid; ?>);">
					<a href="javascript:void(0);" data-toggle="modal" data-target="#groupsuggest" title="COMMUNITY"><i class="fa fa-users"></i></a>
				</li>
				<li onclick="friend(<?php echo $loadyournetwork->sid;?>);">
					<a href="javascript:void(0);" data-toggle="modal" data-target="#friendsuggest" title="SUGGEST"><i class="fa fa-user"></i></a>
				</li>
				<li onclick="socialshare(<?php echo $loadyournetwork->sid;?>, 'story');">
					<a data-toggle="modal" data-target="#soc" href="javascript:void(0);" title="SOCIAL">
						<i class="fa fa-share-alt"></i>
					</a>
				</li>
			</ul>
		</div>
	</div>
<?php } } ?>