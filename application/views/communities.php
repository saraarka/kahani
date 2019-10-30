<link rel="stylesheet" href="<?php echo base_url();?>assets/css/communities.css">

    <section class="content">
        <div class="container-fluid" style="justify-content:center;">
            <div class="row pd-0">
                <?php if(isset($joinedcommunities) && ($joinedcommunities->num_rows() > 0)) { ?>
        		<h3>MY COMMUNITIES</h3>
        		<hr>
        		<div class="jcm" style="display:flex; flex-wrap:wrap; justify-content:center;" id="jloadmoreall">
        		    <?php foreach($joinedcommunities->result() as $row) { ?>
        			  <div  style="display:flex; flex-wrap:wrap;justify-content:center;">
            			<div class="card-community" style="padding-bottom: 10px;">
                			<div class="box box-widget" style="border-radius:5px;">
                				<div class="box-body" style="padding:0px;">
                				    <a href="<?php echo base_url();?>community/<?php echo preg_replace("~[^\p{M}\w]+~u", '-', $row->gener);?>">
                				        <?php if(!empty($row->comm_image)){ ?>
                					    <img  src="<?php echo base_url();?>assets/images/293-l.jpg" class="img-responsive lazy" data-src="<?php echo base_url();?>assets/images/<?php echo $row->comm_image; ?>" alt="<?php echo $row->gener; ?>" style="height:200px; border-radius:5px 5px 0 0;">
                					    <?php } else{ ?>
                					    <img  src="<?php echo base_url();?>assets/images/293-l.jpg" class="img-responsive lazy" data-src="<?php echo base_url();?>assets/images/1.jpg" alt="<?php echo $row->gener; ?>" style="height:200px; border-radius:5px 5px 0 0;">
                					    <?php } ?>
                					</a> 
                				</div>
                				<div class="box-footer box-comments" style="border-radius:0 0 5px 5px;">
                					<div class="box-comment">
                		                <div class="comment-text">
                		                    <a href="<?php echo base_url();?>community/<?php echo preg_replace("~[^\p{M}\w]+~u", '-', $row->gener);?>" style="float:left;">
                		                        <span class="username"><?php echo $row->gener; ?></span>
                		                    </a>
                		                    <?php if(isset($join_comm) && in_array($row->id, $join_comm)) { ?>
									            <button class="pull-right btn btn-primary notloginmodal unjoin<?php echo $row->id;?>" onclick="commuunjoin(<?php echo $row->id;?>,'<?php echo $row->gener;?>')">JOINED</button>
									        <?php } ?>
                						</div>
                					</div>
                		        </div>
                			</div>
            			</div>
        		    </div>
        		    <?php } ?>
        		</div>
        		<div id="jload_data_message"></div>
        		<?php } ?>
        	</div>
        	<div class="row">
        		<?php if(isset($unjoinedcommunities) && ($unjoinedcommunities->num_rows() >0)){ ?>
        		<h3>FEATURED COMMUNITIES</h3>
        		<hr>
        		<div class="jcm" style="display:flex; flex-wrap:wrap; justify-content:center;" id="floadmoreall">
        			<?php foreach($unjoinedcommunities->result() as $row) { ?>
            			<div class="card-community" style="padding-bottom: 10px;">
                			<div class="box box-widget" style="border-radius:5px;">
                				<div class="box-body" style="padding:0px;">
            				        <?php if(!empty($row->comm_image)){ ?>
            					    <img  src="<?php echo base_url();?>assets/images/293-l.jpg" class="img-responsive lazy" data-src="<?php echo base_url();?>assets/images/<?php echo $row->comm_image; ?>" alt="<?php echo $row->gener; ?>" style="height:200px; width:100%; border-radius:5px 5px 0 0;">
            					    <?php } else{ ?>
            					    <img  src="<?php echo base_url();?>assets/images/293-l.jpg" class="img-responsive lazy" data-src="<?php echo base_url();?>assets/images/1.jpg" alt="<?php echo $row->gener; ?>" style="height:200px; border-radius:5px 5px 0 0;">
            					    <?php } ?>
                				</div>
                				<div class="box-footer box-comments" style="border-radius:0 0 5px 5px;">
                					<div class="">
                		                <div class="comment-text">
                		                    <?php if(isset($this->session->userdata['logged_in']['user_id']) && !empty($this->session->userdata['logged_in']['user_id'])){ ?>
                		                	<form action="<?php echo base_url();?>communities_joinform" method="POST">
                							    <span class="username"> <?php echo $row->gener; ?>
                    								<input type="hidden" name="comm_id" value="<?php echo $row->id; ?>">
                    								<input type="hidden" name="gener" value="<?php echo $row->gener;?>">
                    							</span>
                    							<span style="float:right">
                    							    <button class="redvj pull-right btn btn-danger">JOIN</button>
                								</span>
                							</form>
                							<?php } else{ ?>
                							<span class="username"> <?php echo $row->gener; ?></span>
            								<span style="float:right;">
            								    <button class="redvj pull-right notloginmodal btn btn-danger">JOIN</button>
            								</span>
            								<?php } ?>
                						</div>
                					</div>
                		        </div>
                			</div>
            			</div>
        			<?php } ?>
        		</div>
        		<div id="fload_data_message"></div>
        		<?php } ?>
            </div>
            <?php if((!isset($joinedcommunities) || ($joinedcommunities->num_rows()==0)) && (!isset($unjoinedcommunities) || ($unjoinedcommunities->num_rows()==0))){ ?>
            <div class="row">
    			<?php if(isset($get_communities) && ($get_communities->num_rows() >0)){ ?>
    			<h3>COMMUNITIES</h3>
    			<hr>
        		<div class="jcm" style="display:flex; flex-wrap:wrap; justify-content:center;" id="loadmoreall">
        			<?php foreach($get_communities->result() as $row){ ?>
            			<div class="card-community" style="padding-bottom:">
                			<div class="box box-widget" style="border-radius:5px;">
                				<div class="box-body" style="padding:0px;">
                					<?php if(!empty($row->comm_image)){ ?>
            					    <img class="img-responsive lazy"  src="<?php echo base_url();?>assets/images/293-l.jpg" data-src="<?php echo base_url();?>assets/images/<?php echo $row->comm_image; ?>" alt="<?php echo $row->gener; ?>" style="height:200px; width:100%; border-radius:5px 5px 0 0;">
            					    <?php } else { ?>
            					    <img  src="<?php echo base_url();?>assets/images/293-l.jpg" class="img-responsive lazy" data-src="<?php echo base_url();?>assets/images/1.jpg" alt="<?php echo $row->gener; ?>" style="height:200px; border-radius:5px 5px 0 0;">
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
                    							<span style="float:right;">	<button class="redvj pull-right btn btn-danger">JOIN</button>
                								</span>
                							</form>
                							<?php }else{ ?>
                							<span class="username"> <?php echo $row->gener; ?>
                							</span>
                							<span style="float:right;">
            								    <button class="redvj pull-right notloginmodal btn btn-danger">JOIN</button>
                							</span>
                							<?php } ?>
                						</div>
                					</div>
                		        </div>
                			  </div>
            			</div>
        			<?php } ?>
        		</div>
        		<div id="load_data_message"></div>
        	    <?php } ?>
            </div>
            <?php } ?>
        </div>
    </section>
<script type="text/javascript">var base_url = "<?php echo base_url();?>";</script>
<script src="<?php echo base_url();?>assets/js/communities.js"></script>
