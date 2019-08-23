<?php if(isset($scseries) && ($scseries->num_rows() > 0)){ $readlatersids = get_storiesreadlater('readlater'); 
    foreach($scseries->result() as $scseriesrow){ ?>
    <div class="cardls" id="sclibdel<?php echo $scseriesrow->sid;?>">
	    <div class="book-typels"><?php echo $scseriesrow->gener;?></div>
        <a href="<?php echo base_url('series/'.preg_replace("~[^\p{M}\w]+~u",'-', $scseriesrow->title).'-'.$scseriesrow->sid.'/'.preg_replace("~[^\p{M}\w]+~u",'-', $scseriesrow->title).'-'.$scseriesrow->story_id);?>" class="imagesls-style">
            <?php if(isset($scseriesrow->image) && !empty($scseriesrow->image)) { ?>
                <img src="<?php echo base_url();?>assets/images/<?php echo $scseriesrow->image; ?>" alt="<?php echo $scseriesrow->title;?>" class="imagemels">
            <?php }else{ ?>
            	<img src="<?php echo base_url();?>assets/default/series-stories.jpg" alt="<?php echo $scseriesrow->title;?>" class="imagemels">
            <?php } ?>
        </a>
        <div class="bottom-left">
            <a href="javascript:void(0)" onclick="deletesclibrary(<?php echo $scseriesrow->sid;?>);">
		    <i class="fa fa-trash"></i></a>
		</div>
        <div class="clear-fix"></div>
	    <div style="margin-top:-18px;">
        	<font class="max-linesls">
        		<a href="<?php echo base_url('series/'.preg_replace("~[^\p{M}\w]+~u",'-', $scseriesrow->title).'-'.$scseriesrow->sid.'/'.preg_replace("~[^\p{M}\w]+~u",'-', $scseriesrow->title).'-'.$scseriesrow->story_id);?>">
        			<?php echo $scseriesrow->title;?>
        		</a>
        	</font> 
        </div>
		<div class="flextestls">
            <font class="bynamels">By<font class="nameherels"><a href="<?php echo base_url($scseriesrow->profile_name);?>" style="color:#000;"> <?php echo $scseriesrow->name;?></a></font></font>
            <br>
		</div>
	    <div class="flextestls" style="padding-top:4px;">
            <font class="episodesls">
                <?php $keycount = get_episodecount($scseriesrow->sid); 
                    if(isset($keycount)){ echo $keycount; }else{ echo 0; }?> EPISODES | 
                <?php $subsmemcount = get_storysubscount($scseriesrow->sid); 
				    if(isset($subsmemcount)){echo $subsmemcount; }else{echo 0; } ?> MEMBERS
			</font><br>
		</div>
        <div class="flextestls" style="padding-top:6px">
            <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($scseriesrow->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
                <button class="read" style="background:none; border:none;" onclick="yoursreadlater();"><i class="fa fa-bookmark"></i> Read later </button>
        	<?php }else{ ?>
            	<?php if(isset($readlatersids) && (sizeof($readlatersids)>0) && in_array($scseriesrow->sid, $readlatersids)) { ?>
            		<button onclick="unreadlater(<?php echo $scseriesrow->sid;?>)" class="readdone notloginmodal readlaterbtnatr<?php echo $scseriesrow->sid;?>">
            		<i class="fa fa-check faicon<?php echo $scseriesrow->sid;?>"></i> Read later </button>
            	<?php }else { ?>
            		<button onclick="readlater(<?php echo $scseriesrow->sid;?>)" class="read notloginmodal readlaterbtnatr<?php echo $scseriesrow->sid;?>">
            		<i class="fa fa-bookmark faicon<?php echo $scseriesrow->sid;?>"></i> Read later </button>
            	<?php } ?>
            <?php } ?>
	        <button type="button" class="btn read dropdown-toggle pull-right" data-toggle="dropdown">
				<span class=""><i class="fa fa-plus"></i></span>
			</button>
			<ul class="dropdown-menu list-inline dropvk">
				<li onclick="groupsuggest(<?php echo $scseriesrow->sid; ?>);">
					<a href="javascript:void(0)" data-toggle="modal" data-target="#groupsuggest" title="COMMUNITY"><i class="fa fa-users"></i></a>
				</li>
				<li onclick="friend(<?php echo $scseriesrow->sid;?>);">
					<a href="javascript:void(0)" data-toggle="modal" data-target="#friendsuggest" title="SUGGEST"><i class="fa fa-user"></i></a>
				</li>
				<li onclick="socialshare(<?php echo $scseriesrow->sid;?>, 'series');">
					<a data-toggle="modal" data-target="#soc" href="javascript:void(0)" title="SOCIAL">
						<i class="fa fa-share-alt"></i>
					</a>
				</li>
			</ul>
        </div>
    </div>
<?php } } ?>