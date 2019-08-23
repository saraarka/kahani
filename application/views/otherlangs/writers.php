<link rel="stylesheet" href="<?php echo base_url();?>assets/css/writers.css">
<div class="content-wrapper">
    <section class="content">
        <div class="main-container1">
            <div class="row pt-0">
                <div class="titleindex" style="clear:both;">
        		    <span class="titlei">TOP WRITERS</span>
    		    </div><hr>  
    		</div>
    		<?php if(isset($get_writer) && ($get_writer->num_rows() > 0)){ ?>
    		<div style="display:flex; flex-wrap:wrap; justify-content:center;" id="loadmoreall">
    		    <?php foreach($get_writer->result() as $writerrow) { ?>
            		<div class="card1" style="height:215px">
            		    <?php if(isset($writerrow->pbanner_image) && !empty($writerrow->pbanner_image)){ ?>
				        <div class="imageme1" style="height:115px; background-position:center; background:url(<?php echo base_url();?>assets/images/<?php echo $writerrow->pbanner_image; ?>) center center; background-size:cover">
					        <div style="padding:9px; background:rgba(0, 0, 0, 0.64);height:115px;">
					            <a href="<?php echo base_url($this->uri->segment(1).'/'.$writerrow->profile_name);?>">
						            <?php if(isset($writerrow->profile_image) && !empty($writerrow->profile_image)) { ?>
						            	<img src="<?php echo base_url();?>assets/images/<?php echo $writerrow->profile_image; ?>" class="circle-image" alt="<?php echo $writerrow->profile_name;?>" style="height:50px">
						            <?php }else{ ?>
						            	<img src="<?php echo base_url();?>assets/images/2.png" class="circle-image" alt="<?php echo $writerrow->profile_name;?>" style="height:50px">
						            <?php } ?>
					            </a>
					            <h3 class="name-nanostories" style="color:#fff">
					                <a href="<?php echo base_url($this->uri->segment(1).'/'.$writerrow->profile_name);?>" style="color:#FFF;"><?php echo $writerrow->name;?></a>
					            </h3>
					            <p class="writerc"><?php echo $writerrow->aboutus; ?></p>
					        </div>
				        </div>
				        <?php }else{ ?>
				        <div class="imageme1" style="height:115px; background-position:center; background: linear-gradient(-60deg,RoyalBlue,brown); background-size:cover">
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
    							    if(isset($writings['userwcount'])) { echo $writings['userwcount']; }else{ echo 0; } ?><br> WRITINGS
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
            	<?php } ?>
    		</div>
    		<div id="load_data_message"></div>
    		<?php } ?>
    	</div>
	</section>
</div>
<script>
    $(document).ready(function(){
        var limit = 5;
        var start = 5;
        var action = 'inactive';
        function load_country_data(limit, start) {
            $.ajax({
                url:'<?php echo base_url().$this->uri->segment(1);?>/topwriterloading',
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
                setTimeout(function(){load_country_data(limit, start);}, 500);
            }
        });
    });
</script>