<?php if(isset($loadmoreresults) && ($loadmoreresults->num_rows() > 0)){
    foreach($loadmoreresults->result() as $followerskey) { ?>
        <div class="user-block" style="padding:0 10px; display:flex;">
            <span style="width:15%;">
                <?php if(isset($followerskey->profile_image) && !empty($followerskey->profile_image)) { ?>
                    <img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $followerskey->profile_image; ?>" alt="<?php echo $followerskey->name;?>">
			    <?php } else { ?>
				    <img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo $followerskey->name;?>">
			    <?php } ?>
			</span>
		    <span  class="username" style="padding-top:8px;width:40%;margin-left:2px;">
		        <a href="<?php echo base_url($this->uri->segment(1)."/".$followerskey->profile_name);?>" style="margin-left:5px;" class="max-lines"><?php echo $followerskey->name;?></a>
		    </span>
		    <span class="pull-right" style="width:45%;padding-top:6px;">
                <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($this->session->userdata['logged_in']['user_id'] == $followerskey->user_id)){ ?>
                    <button class="vjw btn btn-success pull-right" onclick="yoursfollow()" > FOLLOW </button>
                <?php } else { ?>
                <?php if(isset($following) && in_array($followerskey->user_id, $following)) { ?>
                    <button class="pull-right vjw btn btn-primary notloginmodal unfollow<?php echo $followerskey->user_id;?>" onclick="writerunfollow(<?php echo $followerskey->user_id;?>,'<?php echo $followerskey->name;?>')"> FOLLOWING </button>
                <?php } else { ?>
                    <button class="pull-right vjw btn btn-success notloginmodal follow<?php echo $followerskey->user_id;?>" onclick="writerfollow(<?php echo $followerskey->user_id;?>,'<?php echo $followerskey->name;?>')"> FOLLOW </button>
                <?php } ?>
                <?php } ?>
            </span>
        </div><hr>
<?php } } else if(isset($loadmoreresultdatas) && ($loadmoreresultdatas->num_rows() > 0)){
    foreach($loadmoreresultdatas->result() as $followingkey) { ?>
    	<div class="user-block" style="padding:0 10px; display:flex;">
    	    <span style="width:15%;">
    		    <?php if(isset($followingkey->profile_image) && !empty($followingkey->profile_image)) { ?>
    			    <img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $followingkey->profile_image; ?>" alt="<?php echo $followingkey->name;?>">
    			<?php } else { ?>
    				<img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo $followingkey->name;?>">
    			<?php } ?>
    		</span>
    	    <span  class="username" style="padding-top:8px;width:40%;margin-left:2px;">
    		    <a href="<?php echo base_url($this->uri->segment(1)."/".$followingkey->profile_name);?>"><?php echo $followingkey->name;?></a>
    	    </span>
    	    <span class="pull-right" style="width:45%;padding-top:6px;">
    	        <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($this->session->userdata['logged_in']['user_id'] == $followingkey->user_id)){ ?>
                    <button class="pull-right vjw btn btn-success" onclick="yoursfollow()"> Follow </button>
                <?php } else { ?>
                    <?php if(isset($following) && in_array($followingkey->user_id, $following)) { ?>
                        <button class="pull-right vjw btn btn-primary notloginmodal unfollow<?php echo $followingkey->user_id;?>" onclick="writerunfollow(<?php echo $followingkey->user_id;?>,'<?php echo $followingkey->name;?>')"> FOLLOWING </button>
                    <?php } else { ?>
                        <button class="pull-right vjw btn btn-success notloginmodal follow<?php echo $followingkey->user_id;?>" onclick="writerfollow(<?php echo $followingkey->user_id;?>,'<?php echo $followingkey->name;?>')"> FOLLOW </button>
                    <?php } ?>
                <?php } ?>
    	    </span>
    	</div> <hr>
    <?php } ?>
<?php } ?>