<?php if(isset($get_communities) && ($get_communities->num_rows() > 0)){ foreach($get_communities->result() as $row){ ?>
	<div class="card-community" style="padding-bottom:">
		<div class="box box-widget" style="border-radius:5px;">
			<div class="box-body" style="padding:0px;">
				<?php if(!empty($row->comm_image)){ ?>
			    <img class="img-responsive" src="<?php echo base_url();?>assets/images/<?php echo $row->comm_image; ?>" alt="<?php echo $row->gener; ?>" style="height:200px; width:100%; border-radius:5px 5px 0 0;">
			    <?php } else { ?>
			    <img class="img-responsive" src="<?php echo base_url();?>assets/images/1.jpg" alt="<?php echo $row->gener; ?>" style="height:200px; border-radius:5px 5px 0 0;">
			    <?php } ?>
			</div>
			<div class="box-footer box-comments" style="border-radius:0 0 5px 5px;">
				<div class="box-comment">
	                <div class="comment-text">
	                    <?php if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])){ ?>
	                	<form action="<?php echo base_url();?>communities_joinform" method="POST">
						    <span class="username"> <?php echo $row->gener; ?>
								<input type="hidden" name="comm_id" value="<?php echo $row->id; ?>">
								<input type="hidden" name="gener" value="<?php echo $row->gener;?>">
							</span>
							<span style="float:right;">	
							    <button class="redvj pull-right btn btn-danger">JOIN</button>
							</span>
						</form>
						<?php }else{ ?>
						<span class="username"> <?php echo $row->gener; ?></span>
						<span style="float:right;">
						    <button class="notloginmodal redvj pull-right btn btn-danger" data-toggle="modal" data-target="#loginmodal">JOIN</button>
						</span>
						<?php } ?>
					</div>
				</div>
	        </div>
		  </div>
	</div>
<?php } } else if(isset($unjoinedcommunities) && ($unjoinedcommunities->num_rows() > 0)){
    foreach($unjoinedcommunities->result() as $fcommunities){ ?>
    <div class="card-community" style="padding-bottom:">
		<div class="box box-widget" style="border-radius:5px;">
			<div class="box-body" style="padding:0px;">
				<?php if(!empty($fcommunities->comm_image)){ ?>
			    <img class="img-responsive" src="<?php echo base_url();?>assets/images/<?php echo $fcommunities->comm_image; ?>" alt="<?php echo $fcommunities->gener; ?>" style="height:200px; width:100%; border-radius:5px 5px 0 0;">
			    <?php } else { ?>
			    <img class="img-responsive" src="<?php echo base_url();?>assets/images/1.jpg" alt="<?php echo $fcommunities->gener; ?>" style="height:200px; border-radius:5px 5px 0 0;">
			    <?php } ?>
			</div>
			<div class="box-footer box-comments" style="border-radius:0 0 5px 5px;">
				<div class="box-comment">
	                <div class="comment-text">
	                    <?php if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])){ ?>
	                	<form action="<?php echo base_url();?>communities_joinform" method="POST">
						    <span class="username"> <?php echo $fcommunities->gener; ?>
								<input type="hidden" name="comm_id" value="<?php echo $fcommunities->id; ?>">
								<input type="hidden" name="gener" value="<?php echo $fcommunities->gener;?>">
							</span>
							<span style="float:right;">
							    <button class="redvj pull-right btn btn-danger">JOIN</button>
							</span>
						</form>
						<?php }else{ ?>
						<span class="username"> <?php echo $fcommunities->gener; ?></span>
						<span style="float:right;">
						    <button class="notloginmodal redvj pull-right btn btn-danger" data-toggle="modal" data-target="#loginmodal">JOIN</button>
						</span>
						<?php } ?>
					</div>
				</div>
	        </div>
		  </div>
	</div>
<?php } } else if(isset($joinedcommunities) && ($joinedcommunities->num_rows() > 0)){ foreach($joinedcommunities->result() as $jrow) { ?>
    <div  style="display:flex; flex-wrap:wrap;justify-content:center;">
        <div class="card-community" style="padding-bottom: 10px;">
        	<div class="box box-widget" style="border-radius:5px;">
        		<div class="box-body" style="padding:0px;">
        		    <a href="<?php echo base_url();?>co_view/<?php echo $jrow->id;?>">
        		        <?php if(!empty($jrow->comm_image)){ ?>
        			    <img class="img-responsive" src="<?php echo base_url();?>assets/images/<?php echo $jrow->comm_image; ?>" alt="<?php echo $jrow->gener; ?>" style="height:200px; border-radius:5px 5px 0 0;">
        			    <?php } else{ ?>
        			    <img class="img-responsive" src="<?php echo base_url();?>assets/images/1.jpg" alt="<?php echo $jrow->gener; ?>" style="height:200px; border-radius:5px 5px 0 0;">
        			    <?php } ?>
        			</a> 
        		</div>
        		<div class="box-footer box-comments" style="border-radius:0 0 5px 5px;">
        			<div class="box-comment">
                        <div class="comment-text">
                            <a href="<?php echo base_url();?>co_view/<?php echo $jrow->id;?>" style="float:left;">
                                <span class="username"><?php echo $jrow->gener; ?></span>
                            </a>
                            <?php if(isset($join_comm) && in_array($jrow->id, $join_comm)) { ?>
        			            <button class="pull-right btn btn-primary unjoin<?php echo $jrow->id;?>" onclick="commuunjoin(<?php echo $jrow->id;?>,'<?php echo $jrow->gener;?>')">JOINED</button>
        			        <?php } ?>
        				</div>
        			</div>
                </div>
        	</div>
        </div>
    </div>
<?php } } ?>