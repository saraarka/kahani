<?php if(isset($loadgenerstories) && ($loadgenerstories->num_rows() > 0)){ ?>
    <?php foreach($loadgenerstories->result() as $loadgenerstory) { ?>
        <div class="cardls">
        	<div class="book-typels"><?php echo $loadgenerstory->gener;?></div>
                <a href="<?php echo base_url($this->uri->segment(1).'/story/'.preg_replace('/\s+/', '-', $loadgenerstory->title).'-'.$loadgenerstory->sid);?>" class="imagesls-style">
        		    <?php if(isset($loadgenerstory->image) && !empty($loadgenerstory->image)) { ?>
                	    <img src="<?php echo base_url();?>assets/images/<?php echo $loadgenerstory->image; ?>" alt="<?php echo $loadgenerstory->title;?>" class="imagemels">
                	<?php }else{ ?>
                		<img src="<?php echo base_url();?>assets/images/series-stories.jpg" alt="<?php echo $loadgenerstory->title;?>" class="imagemels">
                	<?php } ?>
                </a>
            <div>
            	<font class="max-linesls">
            		<a href="<?php echo base_url($this->uri->segment(1).'/story/'.preg_replace('/\s+/', '-', $loadgenerstory->title).'-'.$loadgenerstory->sid);?>" class="product-title"><?php echo $loadgenerstory->title;?></a>
            	</font> 
            </div>
        							
        	<div class="flextestls">
        		<font class="bynamels">By<font class="namehere">
        		    <a href="<?php echo base_url($this->uri->segment(1)."/".$loadgenerstory->profile_name);?>" style="color: #000;"> <?php echo $loadgenerstory->name;?></a></font></font><br>
        	</div>
        				
        	<div class="flextestls" style="padding-top:4px;">
    	        <font class="episodesls">
    	        	<font>
    	        		<?php $wordcount = explode(' ', $loadgenerstory->story);
    	        	$time = round(sizeof($wordcount)/50);	?>
    	        		<b><?php if($time == 0){ echo 1;}else{ echo $time;}?></b> Min Story&nbsp;</font>
    	        	<font>&nbsp;<i style="color: #3c8dbc" class="fa fa-eye" aria-hidden="true"></i><b> <?php echo $loadgenerstory->views;?>&nbsp;</b></font>
    	        	<font>&nbsp;<i style="color: #3c8dbc" class="fa fa-star" aria-hidden="true"></i>
    	        		<b>
    	        		<?php if(isset($reviews21) && ($reviews21->num_rows()>0)) {
    	        			foreach($reviews21->result() as $reviews2) { 
    	        				if($reviews2->sid == $loadgenerstory->sid) {
    	        					echo round($reviews2->rating);
    	        				}
    	        		} } ?>
    	        		</b>
    	        	</font>
    	        </font><br>
            </div>
        				
        	<div class="flextestls" style="padding-top:6px">
    	        <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($loadgenerstory->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
    		        <button class="read" onclick="yoursreadlater();"><i class="fa fa-bookmark"></i> Read later </button>
    		    <?php }else if(isset($this->session->userdata['logged_in']['user_id'])){ ?>
            		<?php if(isset($readlatersids) && (sizeof($readlatersids)>0) && in_array($loadgenerstory->sid, $readlatersids)) { ?>
            			<button onclick="unreadlater(<?php echo $loadgenerstory->sid;?>)" class="readdone notloginmodal readlaterbtnatr<?php echo $loadgenerstory->sid;?>">
            			<i class="fa fa-check faicon<?php echo $loadgenerstory->sid;?>"></i> Read later </button>
            		<?php }else { ?>
            			<button onclick="readlater(<?php echo $loadgenerstory->sid;?>)" class="read notloginmodal readlaterbtnatr<?php echo $loadgenerstory->sid;?>">
            			<i class="fa fa-bookmark faicon<?php echo $loadgenerstory->sid;?>"></i> Read later </button>
            	<?php } } else{ ?>
				    <button class="read notloginmodal" data-toggle="modal" data-target="#loginmodal"><i class="fa fa-bookmark"></i> Read later </button>
				<?php } ?>
    	    <button type="button" class="btn read dropdown-toggle pull-right" data-toggle="dropdown">
    		    <span class=""><i class="fa fa-plus"></i></span>
    	    </button>
    	    <ul class="dropdown-menu list-inline dropvk">
        		<li onclick="groupsuggest(<?php echo $loadgenerstory->sid; ?>);">
        			<a href="javascript:void(0)" data-toggle="modal" data-target="#groupsuggest" title="COMMUNITY"><i class="fa fa-users"></i></a>
        		</li>
        		<li onclick="friend(<?php echo $loadgenerstory->sid;?>);">
        			<a href="javascript:void(0)" data-toggle="modal" data-target="#friendsuggest" title="SUGGEST"><i class="fa fa-user"></i></a>
        		</li>
        		<li onclick="socialshare(<?php echo $loadgenerstory->sid;?>, 'story');">
        			<a data-toggle="modal" data-target="#soc" href="javascript:void(0)" title="SOCIAL">
        				<i class="fa fa-share-alt"></i>
        			</a>
        		</li>
        	</ul>
        </div>
	</div>
<?php } } ?>