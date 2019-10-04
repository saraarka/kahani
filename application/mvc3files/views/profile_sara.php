<link rel="stylesheet" href="<?php echo base_url();?>assets/css/profile.css">

    <?php $readlatersids = get_storiesreadlater('readlater'); ?>
    <div class="margintop">
        <section class="content">
            <div class="row pt-0">
                <?php $about='Hi, I am .... '; $readingliststatus='private'; $email = ''; $phone = ''; $uemailstatus = ''; $uphonestatus = '';
                if(isset($writer_profile) && ($writer_profile->num_rows() >0)){ foreach($writer_profile->result() as $row) { 
                    $about = $row->aboutus; $readingliststatus = $row->readinglist; $email = $row->email; $phone = $row->phone; 
                    $uemailstatus = $row->uemailstatus; $uphonestatus = $row->uphonestatus; ?>
                <div class= pd-0"col-md-12">
                    <div class="box box-widget widget-user-2 ovv">
                        <?php if(isset($row->banner_image) && !empty($row->banner_image)) { ?>
                        <div class="widget-user-header ovv  profile1 bgvv" style="padding:0px; background: url('<?php echo base_url();?>assets/images/<?php echo $row->banner_image; ?>')center center;background-repeat: no-repeat;background-size: cover;">
                            <div style="background-color:rgba(0, 0, 0, 0.55); background-repeat: no-repeat;background-size: cover; padding: 80px 30px; height: 250px;">
                                <div class="widget-user-image">
                                    <?php  if(isset($row->profile_image) && !empty($row->profile_image)) { ?>
                                        <img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $row->profile_image; ?>" alt="<?php echo $row->name;?>" style="width:85px; height:80px;">
                                     <?php } else { ?>
                                        <img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo $row->name;?>" style="width:85px; height:80px;">
                                    <?php } ?>
                                </div><!-- /.widget-user-image -->
                                <h3 class="widget-user-username clrvk" style="color:#fff; margin-left:100px;"><b><?php echo $row->name;?> </b></h3>
                                <h5 class="widget-user-desc clrvk" style="color:#fff; margin-left:100px;">@<?php echo $row->profile_name;?></h5>
                            </div>
                        </div>
                        <?php } else{ ?>
                            <div class="widget-user-header ovv  profile1 bgvv" style="padding:0px; background: linear-gradient(-60deg,RoyalBlue,brown);background-repeat: no-repeat;background-size: cover;">
                            <div style="background-color:rgba(0, 0, 0, 0.55); background-repeat: no-repeat;background-size: cover; padding: 80px 30px; height: 250px;">
                                <div class="widget-user-image">
                                    <?php  if(isset($row->profile_image) && !empty($row->profile_image)) { ?>
                                        <img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $row->profile_image; ?>" alt="<?php echo $row->name;?>" style="width:85px; height:80px;">
                                     <?php } else { ?>
                                        <img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo $row->name;?>" style="width:85px; height:80px;">
                                    <?php } ?>
                                </div><!-- /.widget-user-image -->
                                <h3 class="widget-user-username clrvk" style="color:#fff; margin-left:100px;"><b><?php echo $row->name;?> </b></h3>
                                <h5 class="widget-user-desc clrvk" style="color:#fff; margin-left:100px;">@<?php echo $row->profile_name;?></h5>
                            </div>
                        </div>
                        <?php } ?>
                        <center>
                            <div class="widget-user-header ovv profile2" style="padding:0px; background: url('<?php echo base_url();?>assets/images/<?php echo $row->banner_image; ?>') center center;background-repeat: no-repeat;background-size: cover;">
                                <div style="background-color:rgba(0, 0, 0, 0.55); background-repeat: no-repeat;background-size: cover; padding: 40px 30px;">
                                    <div class="widget-user-imaghidden-lg hidden-mdontent:center;">
                                        <?php  if(isset($row->profile_image) && !empty($row->profile_image)) { ?>
                                            <img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $row->profile_image; ?>" alt="<?php echo $row->name;?>" style="width:85px; float:none; justify-content:center;">
                                         <?php } else { ?>
                                            <img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo $row->name;?>" style="width:85px; float:none; justify-content:center;">
                                        <?php } ?>
                                    </div><!-- /.widget-user-image -->
                                    <h3 class="" style="color:#fff;"><b><?php echo $row->name;?> </b></h3>
                                    <h5 class="" style="color:#fff;">@<?php echo $row->profile_name;?></h5>
                                </div>
                            </div>
                        </center>
                        <div class="box-footer">
                            <div class="row pt-0">
                                <div class="col-sm-4 col-xs-4 col-md-4 col-lg-2 border-right pd-0">
                                    <div class="description-block">
                                        <h5 class="description-header"><?php echo $row->count;?></h5>
                                        <span class="description-text">WRITINGS</span>
                                    </div> <!-- /.description-block -->
                                </div> <!-- /.col -->
                                <div class="col-sm-4 col-xs-4 col-md-4 col-lg-2 border-right pd-0">
        							<div class="description-block">
        								<a href="#" data-toggle="modal" data-target="#fmodal-defaultf">
            								<h5 class="description-header" id="follcount<?php echo $row->user_id;?>">
            								<?php $abcdfollowers = 0; if(isset($follow_count) && ($follow_count->num_rows()>0)){
            								    foreach($follow_count->result() as $reviews2){ 
            								        if($reviews2->writer_id == $row->user_id) { 
            								            $abcdfollowers = $reviews2->follo; 
            								        }
            								    }
            								} ?>
            								<?php echo $abcdfollowers;?>
            								</h5>
            								<span class="description-text">FOLLOWERS</span>
        								</a>
        							</div>
    							</div>
                                <div class="modal fade" id="fmodal-defaultf"> <!-- Modelpop up -->
                                    <div class="modal-dialog">
                                        <div class="modal-content  modalf">
                                            <div class="modal-body" style="padding:0">
                                                <ul class="nav nav-tabs">
                                                    <li class="active"><a href="#tab_1" data-toggle="tab"><b>FOLLOWERS</b></a></li>
                                                    <li><a href="#tab_2" data-toggle="tab"><b>FOLLOWING</b></a></li>
    												<li class="pull-right" style="margin-right:10px;"><button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:10px;color:#000;">
        												<span aria-hidden="true">&times;</span>
        										        </button>
									                </li>
                                                </ul>
                                                <div class="tab-content modal-bodyv">
                                                    <div class="tab-pane active" id="tab_1">
                                                        <div class="box-header with-border">
                                                            <div class="row" style="margin:0 -10px;" id="fersloadmore">
													            <?php if(isset($followers_names) && ($followers_names->num_rows() > 0)){
												                    foreach($followers_names->result() as $followerskey) { ?>
    											                        <div class="user-block" style="padding:0 10px; display:flex;">
    											                            <span style="width:15%;">
    											                                <?php if(isset($followerskey->profile_image) && !empty($followerskey->profile_image)) { ?>
    												                                <img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $followerskey->profile_image; ?>" alt="<?php echo $followerskey->name;?>">
                																<?php } else { ?>
                																	<img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo $followerskey->name;?>">
                																<?php } ?>
            																</span>
        																    <span  class="username" style="padding-top:8px;width:52%;margin-left:2px;">
        																        <a href="<?php echo base_url('profile?id='.$followerskey->user_id);?>" style="margin-left:5px;" class="max-linesf"><?php echo $followerskey->name;?></a>
        																    </span>
        																    <span class="pull-right" style="width:33%;padding-top:6px;">
        																        <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($this->session->userdata['logged_in']['user_id'] == $followerskey->user_id)){ ?>
                                                                                    <button class="pull-right vjw btn btn-success " style="" onclick="yoursfollow()"> FOLLOW </button>
                                                                                <?php } else { ?>
                                                                                    <?php if(isset($following) && in_array($followerskey->user_id, $following)) { ?>
                                                                                        <button class="pull-right vjw btn btn-primary notloginmodal unfollow<?php echo $followerskey->user_id;?>" onclick="writerunfollow(<?php echo $followerskey->user_id;?>,'<?php echo $followerskey->name;?>')" > FOLLOWING </button>
                                                                                    <?php } else { ?>
                                                                                        <button  class="pull-right vjw btn btn-success notloginmodal follow<?php echo $followerskey->user_id;?>" onclick="writerfollow(<?php echo $followerskey->user_id;?>,'<?php echo $followerskey->name;?>')"> FOLLOW </button>
                                                                                    <?php } ?>
                                                                                <?php } ?>
        																    </span>
    											                        </div><hr style="margin-bottom:8px;">
											                    <?php } } else { ?>
												                    <center> <h3> You do not have followers. </h3></center>
           									                    <?php } ?>
                   									        </div>
                   									        <div id="fersload_data_message"></div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="tab-pane" id="tab_2">
                                                        <div class="box-header with-border">
                                                            <div class="row" style="margin:0 -10px;" id="fingloadmore">
    														    <?php if(isset($following_names) && ($following_names->num_rows() > 0)) {
														        foreach($following_names->result() as $followingkey) { ?>
        															<div class="user-block" style="padding:0 10px; display:flex;">
											                            <span style="width:15%;">
            															    <?php if(isset($followingkey->profile_image) && !empty($followingkey->profile_image)) { ?>
            																    <img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $followingkey->profile_image; ?>" alt="<?php echo $followingkey->name;?>">
            																<?php } else { ?>
            																	<img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo $followingkey->name;?>">
            																<?php } ?>
            															</span>
        																<span  class="username" style="padding-top:8px;width:52%;margin-left:2px;">
        																	<a href="<?php echo base_url('profile?id='.$followingkey->user_id);?>" style="margin-left:5px;" class="max-linesf"><?php echo $followingkey->name;?></a>
        																</span>
        																<span class="pull-right" style="width:33%;padding-top:6px;">
        																    <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($this->session->userdata['logged_in']['user_id'] == $followingkey->user_id)){ ?>
                                                                                <button class="pull-right vjw btn btn-success" onclick="yoursfollow()"> FOLLOW </button>
                                                                            <?php } else { ?>
                                                                                <?php if(isset($following) && in_array($followingkey->user_id, $following)) { ?>
                                                                                    <button class="pull-right btn btn-primary notloginmodal unfollow<?php echo $followingkey->user_id;?>" onclick="writerunfollow(<?php echo $followingkey->user_id;?>,'<?php echo $followingkey->name;?>')"> FOLLOWING </button>
                                                                                <?php } else { ?>
                                                                                    <button class="pull-right vjw btn btn-success notloginmodal follow<?php echo $followingkey->user_id;?>" onclick="writerfollow(<?php echo $followingkey->user_id;?>,'<?php echo $followingkey->name;?>')"> FOLLOW </button>
                                                                                <?php } ?>
                                                                            <?php } ?>
        																</span>
        															</div><hr style="margin-bottom:8px;">
													            <?php } } else { ?>
														            <center> <h3> You do not following anyone </h3></center>
                   									            <?php } ?>
        													</div>
        													<div id="fingload_data_message"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-sm-4 col-xs-4 col-md-2 border-right profile1">
                                    <div class="description-block">
        								<h5 class="description-header"><?php if($row->storiesviewcount > 0){ echo $row->storiesviewcount; }else{ echo 0; } ?></h5>
        								<span class="description-text">Views</span>
        							</div>
                                    <div class="description-block hidden-md hidden-lg">
                                        <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($this->session->userdata['logged_in']['user_id'] == $row->user_id)){ ?>
                                        <?php } else { ?>
                                            <?php if(isset($following) && in_array($row->user_id, $following)) { ?>
                                                <button style="font-size:14px; padding:6px 12px;" class="btn btn-primary notloginmodal unfollow<?php echo $row->user_id;?>" onclick="writerunfollow(<?php echo $row->user_id;?>,'<?php echo $row->name;?>')"> FOLLOWING </button>
                                            <?php } else { ?>
                                                <button style="font-size:14px; padding:6px 12px;" class="btn btn-success notloginmodal follow<?php echo $row->user_id;?>" onclick="writerfollow(<?php echo $row->user_id;?>,'<?php echo $row->name;?>')"> FOLLOW </button>
                                            <?php } ?>
                                        <?php } ?>
                                    </div><!-- /.description-block -->
                                </div><!-- /.col -->
                                <div class="col-sm-6 col-xs-6 col-md-4 col-lg-3 profile1">	</div>
        						<div class="col-sm-4 col-xs-4 col-md-4 col-lg-3 pd-0">
                                    <div class="description-block profile1" style="float:right; margin-top:14px;">
                                        <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($this->session->userdata['logged_in']['user_id'] == $row->user_id)){ ?>
                                        <?php } else { ?>
                                            <?php if(isset($following) && in_array($row->user_id, $following)) { ?>
                                                <button style="font-size:14px; padding:6px 12px;" class="btn btn-primaryv notloginmodal unfollow<?php echo $row->user_id;?>" onclick="writerunfollow(<?php echo $row->user_id;?>,'<?php echo $row->name;?>')"> FOLLOWING </button>
                                            <?php } else { ?>
                                                <button style="font-size:14px; padding:6px 12px;" class="btn btn-successv notloginmodal follow<?php echo $row->user_id;?>" onclick="writerfollow(<?php echo $row->user_id;?>,'<?php echo $row->name;?>')"> FOLLOW </button>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                    <div class="description-block profile2 btnv" style="padding-top:4px;">
                                        <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($this->session->userdata['logged_in']['user_id'] == $row->user_id)){ ?>
                                        <?php } else { ?>
                                            <?php if(isset($following) && in_array($row->user_id, $following)) { ?>
                                                <a class="btn btn-primaryv notloginmodal unfollow<?php echo $row->user_id;?>" onclick="writerunfollow(<?php echo $row->user_id;?>,'<?php echo $row->name;?>')"> FOLLOWING </a>
                                            <?php } else { ?>
                                                <a class="btn btn-successv notloginmodal follow<?php echo $row->user_id;?>" onclick="writerfollow(<?php echo $row->user_id;?>,'<?php echo $row->name;?>')"> FOLLOW </a>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div><!-- /.row -->
                        </div>
                    </div><!-- /.widget-user -->
                </div>
                <?php } }else if(isset($clientprofile) && ($clientprofile->num_rows() == 1)){ foreach($clientprofile->result() as $clientp){
                    $about = $clientp->aboutus; $readingliststatus = $clientp->readinglist; $email = $clientp->email; $phone = $clientp->phone; 
                    $uemailstatus = $clientp->uemailstatus; $uphonestatus = $clientp->uphonestatus; ?>
                <div class= pd-0"col-md-12">
                    <div class="box box-widget widget-user-2 ovv">
                        <?php if(isset($clientp->banner_image) && !empty($clientp->banner_image)) { ?>
                        <div class="widget-user-header ovv  profile1 bgvv" style="padding:0px; background: url('<?php echo base_url();?>assets/images/<?php echo $clientp->banner_image; ?>')center center;background-repeat: no-repeat;background-size: cover;">
                            <div style="background-color:rgba(0, 0, 0, 0.55); background-repeat: no-repeat;background-size: cover; padding: 80px 30px; height: 250px;">
                                <div class="widget-user-image">
                                    <?php  if(isset($clientp->profile_image) && !empty($clientp->profile_image)) { ?>
                                        <img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $clientp->profile_image; ?>" alt="<?php echo $clientp->name;?>" style="width:85px; height:80px;">
                                     <?php } else { ?>
                                        <img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo $clientp->name;?>" style="width:85px; height:80px;">
                                    <?php } ?>
                                </div><!-- /.widget-user-image -->
                                <h3 class="widget-user-username clrvk" style="color:#fff;"><b><?php echo $clientp->name;?> </b></h3>
                                <h5 class="widget-user-desc clrvk" style="color:#fff;">@<?php echo $clientp->profile_name;?></h5>
                            </div>
                        </div>
                        <?php } else{ ?>
                            <div class="widget-user-header ovv  profile1 bgvv" style="padding:0px; background: linear-gradient(-60deg,RoyalBlue,brown);background-repeat: no-repeat;background-size: cover;">
                            <div style="background-color:rgba(0, 0, 0, 0.55); background-repeat: no-repeat;background-size: cover; padding: 80px 30px; height: 250px;">
                                <div class="widget-user-image">
                                    <?php  if(isset($clientp->profile_image) && !empty($clientp->profile_image)) { ?>
                                        <img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $clientp->profile_image; ?>" alt="<?php echo $clientp->name;?>" style="width:85px; height:80px;">
                                     <?php } else { ?>
                                        <img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo $clientp->name;?>" style="width:85px; height:80px;">
                                    <?php } ?>
                                </div><!-- /.widget-user-image -->
                                <h3 class="widget-user-username clrvk" style="color:#fff;"><b><?php echo $clientp->name;?> </b></h3>
                                <h5 class="widget-user-desc clrvk" style="color:#fff;">@<?php echo $clientp->profile_name;?></h5>
                            </div>
                        </div>
                        <?php } ?>
                        <center>
                            <div class="widget-user-header ovv profile2" style="padding:0px; background: url('<?php echo base_url();?>assets/images/<?php echo $clientp->banner_image; ?>') center center;background-repeat: no-repeat;background-size: cover;">
                                <div style="background-color:rgba(0, 0, 0, 0.55); background-repeat: no-repeat;background-size: cover; padding: 40px 30px;">
                                    <div class="widget-user-imaghidden-lg hidden-mdontent:center;">
                                        <?php  if(isset($clientp->profile_image) && !empty($clientp->profile_image)) { ?>
                                            <img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $clientp->profile_image; ?>" alt="<?php echo $clientp->name;?>" style="width:85px; float:none; justify-content:center;">
                                         <?php } else { ?>
                                            <img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo $clientp->name;?>" style="width:85px; float:none; justify-content:center;">
                                        <?php } ?>
                                    </div><!-- /.widget-user-image -->
                                    <h3 class="" style="color:#fff;"><b><?php echo $clientp->name;?> </b></h3>
                                    <h5 class="" style="color:#fff;">@<?php echo $clientp->profile_name;?></h5>
                                </div>
                            </div>
                        </center>
                        <div class="box-footer">
                            <div class="row pt-0">
                                <div class="col-sm-4 col-xs-4 col-md-4 col-lg-2 border-right pd-0">
                                    <div class="description-block">
                                        <h5 class="description-header">0</h5>
                                        <span class="description-text">WRITINGS</span>
                                    </div> <!-- /.description-block -->
                                </div> <!-- /.col -->
                                <div class="col-sm-4 col-xs-4 col-md-4 col-lg-2 border-right pd-0">
        							<div class="description-block">
        								<h5 class="description-header" id="follcount<?php echo $clientp->user_id;?>">
        								<?php $abcdfollowers = 0; if(isset($follow_count) && ($follow_count->num_rows()>0)){
        								    foreach($follow_count->result() as $reviews2){ 
        								        if($reviews2->writer_id == $clientp->user_id) { 
        								            $abcdfollowers = $reviews2->follo; 
        								        }
        								    }
        								} ?>
        								<?php echo $abcdfollowers;?>
        								</h5>
        								<a href="#" data-toggle="modal" data-target="#fmodal-defaultf"><span class="description-text">FOLLOWERS</span></a>
        							</div>
    							</div>
                                <div class="modal fade" id="fmodal-defaultf"> <!-- Modelpop up -->
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <ul class="nav nav-tabs">
                                                    <li class="active"><a href="#tab_1" data-toggle="tab"><b>FOLLOWERS</b></a></li>
                                                    <li><a href="#tab_2" data-toggle="tab"><b>FOLLOWING</b></a></li>
    												<li class="pull-right"><button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:10px;color:#000;">
        												<span aria-hidden="true">&times;</span>
        										        </button>
									                </li>
                                                </ul>
                                                <div class="tab-content modal-bodyv">
                                                    <div class="tab-pane active" id="tab_1">
                                                        <div class="box-header with-border">
                                                            <div class="row" style="margin:0 -10px;">
													            <?php if(isset($followers_names) && ($followers_names->num_rows() > 0)){
												                    foreach($followers_names->result() as $followerskey) { ?>
											                        <div class="user-block" style="padding:0 10px; display:flex;">
											                            <span style="width:15%;">
											                                <?php if(isset($followerskey->profile_image) && !empty($followerskey->profile_image)) { ?>
												                                <img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $followerskey->profile_image; ?>" alt="<?php echo $followerskey->name;?>">
            																<?php } else { ?>
            																	<img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo $followerskey->name;?>">
            																<?php } ?>
												                        </span>
    																    <span class="username" style="padding-top:8px;width:52%;margin-left:2px;">
    																        <a href="<?php echo base_url('profile?id='.$followerskey->user_id);?>" style="margin-left:5px;" class="max-linesf"><?php echo $followerskey->name;?></a>
    																    </span>
												                        <span class="pull-right" style="width:33%;padding-top:6px;">
                                    										<?php if(isset($this->session->userdata['logged_in']['user_id']) && ($this->session->userdata['logged_in']['user_id'] == $followerskey->user_id)){ ?>
                                                                                <button class="vjw btn btn-success pull-right" onclick="yoursfollow()"> FOLLOW </button>
                                                                            <?php } else { ?>
                                                                                <?php if(isset($following) && in_array($followerskey->user_id, $following)) { ?>
                                                                                    <button class="pull-right vjw btn btn-primary notloginmodal unfollow<?php echo $followerskey->user_id;?>" onclick="writerunfollow(<?php echo $followerskey->user_id;?>,'<?php echo $followerskey->name;?>')" > FOLLOWING </button>
                                                                                <?php } else { ?>
                                                                                    <button class="pull-right vjw btn btn-success notloginmodal follow<?php echo $followerskey->user_id;?>" onclick="writerfollow(<?php echo $followerskey->user_id;?>,'<?php echo $followerskey->name;?>')"> FOLLOW </button>
                                                                                <?php } ?>
                                                                            <?php } ?>
                														</span>
            														</div>
            														<hr style="margin-bottom:8px;">
											                    <?php } } else { ?>
												                    <center> <h3> You do not have followers. </h3></center>
           									                    <?php } ?>
                   									        </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="tab-pane" id="tab_2">
                                                        <div class="box-header with-border">
                                                            <div class="row" style="margin:0 -10px;">
    														    <?php if(isset($following_names) && ($following_names->num_rows() > 0)) {
														        foreach($following_names->result() as $followingkey) { ?>
														        <div class="user-block" style="padding:0 10px; display:flex;">
        															    <span style="width:15%;">
            															    <?php if(isset($followingkey->profile_image) && !empty($followingkey->profile_image)) { ?>
            																    <img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $followingkey->profile_image; ?>" alt="<?php echo $followingkey->name;?>">
            																<?php } else { ?>
            																	<img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" alt="<?php echo $followingkey->name;?>">
            																<?php } ?>
            															</span>
        																<span class="username" style="padding-top:8px;width:52%;margin-left:2px;">
        																	<a href="<?php echo base_url('profile?id='.$followingkey->user_id);?>" style="margin-left:5px;" class="max-linesf"><?php echo $followingkey->name;?></a>
        																</span>
            														<span class="pull-right" style="width:33%;padding-top:6px;">
            															<?php if(isset($this->session->userdata['logged_in']['user_id']) && ($this->session->userdata['logged_in']['user_id'] == $followingkey->user_id)){ ?>
                                                                            <button class="vjw btn btn-success" style="margin-top: 5px;" onclick="yoursfollow()"> FOLLOW </button>
                                                                        <?php } else { ?>
                                                                            <?php if(isset($following) && in_array($followingkey->user_id, $following)) { ?>
                                                                                <button style="padding:6px 5px; margin-top: 5px;" class="btn btn-primary notloginmodal unfollow<?php echo $followingkey->user_id;?>" onclick="writerunfollow(<?php echo $followingkey->user_id;?>,'<?php echo $followingkey->name;?>')"> FOLLOWING </button>
                                                                            <?php } else { ?>
                                                                                <button style="margin-top: 5px;" class="vjw btn btn-success notloginmodal follow<?php echo $followingkey->user_id;?>" onclick="writerfollow(<?php echo $followingkey->user_id;?>,'<?php echo $followingkey->name;?>')"> FOLLOW </button>
                                                                            <?php } ?>
                                                                        <?php } ?>
            														</span>
            													</div><hr style="margin-bottom:8px;">
													            <?php } } else { ?>
														            <center> <h3> You do not following anyone </h3></center>
                   									            <?php } ?>
        													</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-sm-4 col-xs-4 col-md-2 border-right profile1">
                                    <div class="description-block">
        								<h5 class="description-header">0</h5>
        								<span class="description-text">Views</span>
        							</div>
                                    <div class="description-block hidden-md hidden-lg">
                                        <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($this->session->userdata['logged_in']['user_id'] == $clientp->user_id)){ ?>
                                        <?php } else { ?>
                                            <?php if(isset($following) && in_array($clientp->user_id, $following)) { ?>
                                                <button style="font-size:14px; padding:6px 12px;" class="btn btn-primary notloginmodal unfollow<?php echo $clientp->user_id;?>" onclick="writerunfollow(<?php echo $clientp->user_id;?>,'<?php echo $clientp->name;?>')"> FOLLOWING </button>
                                            <?php } else { ?>
                                                <button style="font-size:14px; padding:6px 12px;" class="btn btn-success notloginmodal follow<?php echo $clientp->user_id;?>" onclick="writerfollow(<?php echo $clientp->user_id;?>,'<?php echo $clientp->name;?>')"> FOLLOW </button>
                                            <?php } ?>
                                        <?php } ?>
                                    </div><!-- /.description-block -->
                                </div><!-- /.col -->
                                <div class="col-sm-6 col-xs-6 col-md-4 col-lg-3 profile1">	</div>
        						<div class="col-sm-4 col-xs-4 col-md-4 col-lg-3 pd-0">
                                    <div class="description-block profile1" style="float:right; margin-top:14px;">
                                        <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($this->session->userdata['logged_in']['user_id'] == $clientp->user_id)){ ?>
                                        <?php } else { ?>
                                            <?php if(isset($following) && in_array($clientp->user_id, $following)) { ?>
                                                <button style="font-size:14px; padding:6px 12px;" class="btn btn-primaryv notloginmodal unfollow<?php echo $clientp->user_id;?>" onclick="writerunfollow(<?php echo $clientp->user_id;?>,'<?php echo $clientp->name;?>')"> FOLLOWING </button>
                                            <?php } else { ?>
                                                <button style="font-size:14px; padding:6px 12px;" class="btn btn-successv notloginmodal follow<?php echo $clientp->user_id;?>" onclick="writerfollow(<?php echo $clientp->user_id;?>,'<?php echo $clientp->name;?>')"> FOLLOW </button>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                    <div class="description-block profile2 btnv" style="padding-top:4px;">
                                        <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($this->session->userdata['logged_in']['user_id'] == $clientp->user_id)){ ?>
                                        <?php } else { ?>
                                            <?php if(isset($following) && in_array($clientp->user_id, $following)) { ?>
                                                <a class="btn btn-primaryv notloginmodal unfollow<?php echo $clientp->user_id;?>" onclick="writerunfollow(<?php echo $clientp->user_id;?>,'<?php echo $clientp->name;?>')"> FOLLOWING </a>
                                            <?php } else { ?>
                                                <a class="btn btn-successv notloginmodal follow<?php echo $clientp->user_id;?>" onclick="writerfollow(<?php echo $clientp->user_id;?>,'<?php echo $clientp->name;?>')"> FOLLOW </a>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div><!-- /.row -->
                        </div>
                    </div><!-- /.widget-user -->
                </div>
                <?php } } ?>
                <!-- /.col -->
            </div>
        </section>
        
        <section class="content pv-0" style="padding-top:15px;">
            <div class="" style="display:flex; flex-wrap:wrap; text-justify:center;">
        		<div class="sidebar side1">
                    <div class="box box-widget widget-user vjc"> <h4>About</h4>
                        <p><?php echo $about; ?></p>
                        <?php if($uemailstatus == 'public') { ?>
                            <div class="row" style="border-top:1px solid #eee; padding-top:10px; margin-top:5px;">
                                <div class="col-md-12"><label><i class="fa fa-envelope"> </i></label> <?php echo $email; ?></div>
                            </div>
                        <?php } if($uphonestatus == 'public') { ?>
                            <div class="row" style="border-top:1px solid #eee; padding-top:10px; margin-top:5px;">
                                <div class="col-md-12"><label><i class="fa fa-phone"> </i></label> <?php echo $phone; ?></div>
                            </div>
                        <?php } ?>
                    </div><br>
                    
                    <h3> Comment for this Profile</h3>
                    <div class="pcmtfwidth" style="min-width:279px; width:100%; background:#fff; box-shadow: 1px 1px 1px rgba(0,0,0,0.1);">
    					<div class="box-comment">
    						<form action="#" method="POST" id="profilecomments">
    							<div class="img-push"> 
    							    <div class="" style="display:flex;padding:10px;">
    									<div class="" style="width:80%">
                                           <textarea class="form-control input-sm" name="pro_comment" id="pro_comment" placeholder="Please Enter comments here...." required  style="resize:none;"></textarea>
                                           <input type="hidden" name="profile_id" value="<?php echo $_GET['id']; ?>">
                                           <input type="hidden" name="comment_id" id="comment_id" value="">
                                        </div>
                                        <div class=""  style="width:20%; padding-left:10px;">
                                            <button class="btn btn-success" style="margin-top: 8px;"><i class="fa fa-envelope" aria-hidden="true"></i></button>
                                        </div>
                                    </div>
    							</div>
    						</form>
    					</div>
    					<div class="commentslist pcmtfwidth" style="max-height:300px;overflow: auto;overflow-x : hidden;">
                            <ul id="commentresults" style="padding:10px 0px 0px;" class="pcmtfwidth"></ul>
                        </div>
                        <span id="loadingcomments">
                            <!--<center><img src="<?php echo base_url();?>assets/images/imgs/loading.gif"></center>-->
                        </span>
				    </div>
        		</div>
        		
        		<div class="main-container1">
        		    <?php $tab1pagescount = 0; $tab2pagescount = 0; ?>
        		    <div class="nav-tabs-custom" style="margin-bottom:0px;">
                        <ul class="nav nav-tabs" style="background:#2a6283!important">
                            <li class="visiblev hidden-lg" onclick="aboutactive();"><a href="#tab_about" data-toggle="tab">ABOUT</a></li>
                            <li class="active" onclick="aboutinactive();"><a href="#tab_writing" data-toggle="tab">WRITINGS</a></li>
                            <?php if($readingliststatus == 'public'){ ?>
                            <li onclick="aboutinactive();"><a href="#tab_reading" data-toggle="tab">READING LIST</a></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="tab-content" style="padding:0px 0">
                        <div class="tab-pane" id="tab_about" style="display:none;">
                            <div class="box box-widget widget-user vjc">
            					<h4><b>About</b></h4><p><?php echo $about; ?></p>
            				</div>
            				
            				<h3>Profile Comments</h3>
            				<div class="pcmtmwidth" style="width:100%; padding:10px 10px 0; background:#fff;box-shadow: 1px 1px 1px rgba(0,0,0,0.1);">
            					<div class="box-comment">
            						<form action="#" method="POST" id="tabprofilecomments">
            							<div class="img-push"> 
            							    <div class="" style="display:flex;">
            									<div class="" style="width:80%">
                                                   <textarea class="form-control input-sm" name="pro_comment" id="pro_comment" placeholder="Please Enter comments here...." required  style="resize:none;"></textarea>
                                                   <input type="hidden" name="profile_id" value="<?php echo $_GET['id']; ?>">
                                                   <input type="hidden" name="comment_id" id="comment_id" value="">
                                                </div>
                                                <div class="" style="width:20%; padding-left:10px;">
                                                    <button class="btn btn-success" style="margin-top: 8px;"><i class="fa fa-envelope" aria-hidden="true"></i></button>
                                                </div>
                                            </div>
            							</div>
            						</form>
            					</div>
            					<!--<div class="commentslist1 pcmtmwidth">-->
            					<div class="commentslist pcmtmwidth" style="width:100%;">
                                    <ul id="commentresults" style="padding:10px; list-style:none;height:-webkit-fill-available;" class="pcmtmwidth"></ul>
                                </div>
                                <span id="loadingcomments"></span>
        				    </div>
                        </div>
                        
                        <div class="tab-pane active" id="tab_writing">
                            <?php if(isset($writerseries) && ($writerseries->num_rows() > 0)){ 
                                $tab1pagescount = $tab1pagescount+$writerseries->num_rows(); ?>
                                <div class="row pt-0" style="margin-top:40px;">
                                    <div class="col-md-6 col-xs-8 pd-0">
    			                    	<div class="titlei">SERIES</div>
    			                    </div>
    			                    <?php if($writerseries->num_rows() > 4) { ?>
    			                    <div class="col-md-6 col-xs-4 pd-0">
    			                    	<a href="<?php echo base_url();?>profileviewall?id=<?php echo $_GET['id'];?>&type=series" class="view pull-right">
    			                    	    <div class="pull-right">View More</div>
    			                    	</a>
    			                    </div>
    			                    <?php } ?>
    			                </div><hr>
                                <div class="">
                                    <div id="StoryContv" class="StoryCont1" style="text-align:left;">
    			                        <div id="story-sliderv" class="story-slider series">
        			                        <?php $i = 0; foreach($writerseries->result() as $wseriesrow){ if($i < 4){ ?>
        			                        	<div class="card">
        			                    		<div class="book-type"><?php echo $wseriesrow->gener;?></div>
        			                    		<a href="<?php echo base_url('new_series?id='.$wseriesrow->sid.'&story_id='.$wseriesrow->story_id);?>">
        			                    			<?php if(isset($wseriesrow->cover_image) && !empty($wseriesrow->cover_image)) { ?>
        			                    			    <img src="<?php echo base_url();?>assets/images/<?php echo $wseriesrow->cover_image; ?>" alt="<?php echo $wseriesrow->title;?>" class="imageme">
        			                    			<?php }else{ ?>
        			                    				<img src="<?php echo base_url();?>assets/dist/img/photo1.png" alt="<?php echo $wseriesrow->title;?>" class="imageme">
        			                    			<?php } ?>
        			                    		</a>
        			                    		<div>
        			                    			<font class="max-lines">
        			                    				<a href="<?php echo base_url('new_series?id='.$wseriesrow->sid.'&story_id='.$wseriesrow->story_id);?>">
        			                    					<?php echo $wseriesrow->title;?>
        			                    				</a>
        			                    			</font> 
        			                    		</div>
        			                    		<div class="flextest">
        			                    			<font class="byname"> By<font class="namehere"><a href="<?php echo base_url('profile?id='.$wseriesrow->user_id);?>" style="color:#000"><?php echo $wseriesrow->name;?></a></font>
        			                    			</font><br>
        			                    		</div>
        			                    		<div class="flextest" style="padding-top:4px;">
        			                    			<font class="episodes">
        			                    				<?php $keycount = get_episodecount($wseriesrow->sid); 
        			                    				if(isset($keycount)){ echo $keycount; }else{ echo 0; }?> EPISODES | <?php $subsmemcount = get_storysubscount($wseriesrow->sid); 
        			                    				if(isset($subsmemcount)){echo $subsmemcount; }else{echo 0; } ?> MEMBERS
        			                    			</font><br>
        			                    		</div>
        			                    		<div class="flextest" style="padding-top:6px">
        			                    			<?php if(isset($this->session->userdata['logged_in']['user_id']) && ($wseriesrow->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
        			                    				<button class="read" onclick="yoursreadlater();"><i class="fa fa-bookmark"></i> Read later </button>
        			                    			<?php }else{ ?>
        			                    				<?php if(isset($readlatersids) && (sizeof($readlatersids)>0) && in_array($wseriesrow->sid, $readlatersids)) { ?>
        			                    					<button onclick="unreadlater(<?php echo $wseriesrow->sid;?>)" class="readdone notloginmodal readlaterbtnatr<?php echo $wseriesrow->sid;?>">
        			                    					<i class="fa fa-check faicon<?php echo $wseriesrow->sid;?>"></i> Read later </button>
        			                    				<?php }else { ?>
        			                    					<button onclick="readlater(<?php echo $wseriesrow->sid;?>)" class="read notloginmodal readlaterbtnatr<?php echo $wseriesrow->sid;?>">
        			                    					<i class="fa fa-bookmark faicon<?php echo $wseriesrow->sid;?>"></i> Read later </button>
        			                    				<?php } ?>
        			                    			<?php } ?>
        			                    			
        			                    			<button type="button" class="btn read dropdown-toggle pull-right" data-toggle="dropdown">
        			                    				<span class=""><i class="fa fa-plus"></i></span>
        			                    			</button>
        			                    			<ul class="dropdown-menu list-inline dropvk">
        			                    				<li onclick="groupsuggest(<?php echo $wseriesrow->sid; ?>);">
        			                    					<a data-toggle="modal" data-target="#groupsuggest" title="COMMUNITY"><i class="fa fa-users"></i></a>
        			                    				</li>
        			                    				<li onclick="friend(<?php echo $wseriesrow->sid;?>);">
        			                    					<a data-toggle="modal" data-target="#friendsuggest" title="SUGGEST"><i class="fa fa-user"></i></a>
        			                    				</li>
        			                    				<li onclick="socialshare(<?php echo $wseriesrow->sid;?>, 'series');">
        			                    					<a data-toggle="modal" data-target="#soc" href="" title="SOCIAL">
        			                    						<i class="fa fa-share-alt"></i>
        			                    					</a>
        			                    				</li>
        			                    			</ul>
        			                    		</div>
        				                    	
        				                    	</div>        
        				                        <?php $i++; } } ?>
    				                        </div>
    			                    </div>
                                </div>
                            <?php } ?>
                            <!-- SERIES -->
                           
                            <!-- STORIES -->
                		    <?php if(isset($writerstories) && ($writerstories->num_rows() > 0)){
                		        $tab1pagescount = $tab1pagescount+$writerstories->num_rows(); ?>
                    		    <div class="row pt-0" style="margin-top:20px;">
                    		        <div class="col-md-6 col-xs-8 pd-0">
    		                        	<div class="titlei">stories</div>
    		                        </div>
    		                        <?php if(($writerstories->num_rows() > 4)){ ?>
    		                        <div class="col-md-6 col-xs-4 pd-0">
    		                            <a href="<?php echo base_url();?>profileviewall?id=<?php echo $_GET['id'];?>&type=story"  class="view pull-right">
    		                        	    <div class="pull-right">View More</div>
    		                        	</a>
    		                        </div>
    		                        <?php } ?>
                    		    </div> <hr>
                    		    <div class="">
                                    <div id="StoryCont2" class="StoryCont1" style="text-align:left;">
    				                    <div id="story-slider2" class="story-slider series">
    				                        <?php $i = 0; foreach($writerstories->result() as $wstoryrow) { if($i < 4 ){  ?>
    				                            <div class="card">
    				                    		<div class="book-type"><?php echo $wstoryrow->gener;?></div>
    			                    			<a href="<?php echo base_url('only_story_view?id='.$wstoryrow->sid);?>">
        			                    			<?php if(isset($wstoryrow->cover_image) && !empty($wstoryrow->cover_image)) { ?>
        			                    			    <img src="<?php echo base_url();?>assets/images/<?php echo $wstoryrow->cover_image; ?>" alt="<?php echo $wstoryrow->title;?>" class="imageme">
        			                    			<?php }else{ ?>
        			                    				<img src="<?php echo base_url();?>assets/dist/img/photo1.png" alt="<?php echo $wstoryrow->title;?>" class="imageme">
        			                    			<?php } ?>
    			                    			</a>
    				                    		<div>
    				                    			<font class="max-lines">
    				                    				<a href="<?php echo base_url('only_story_view?id='.$wstoryrow->sid);?>">
    				                    					<?php echo $wstoryrow->title;?>
    				                    				</a>
    				                    			</font> 
    				                    		</div>
    				                    		<div class="flextest">
    				                    			<font class="byname">By<font class="namehere"><a href="<?php echo base_url('profile?id='.$wstoryrow->name);?>" style="color:#000"><?php echo $wstoryrow->name;?></a></font>
    				                    			</font><br>
    				                    		</div>
    				                    		<div class="flextest" style="padding-top:4px;">
    						                    	<font class = "episodes">
    						                    		<font>
    						                    			<?php $wordcount = explode(' ', $wstoryrow->story);
    					                            	$time = round(sizeof($wordcount)/50);	?>
    						                    			<b><?php if($time == 0){ echo 1;}else{ echo $time;}?></b> Min Story&nbsp;</font>
    						                    		<font>&nbsp;<i style="color: #3c8dbc" class="fa fa-eye" aria-hidden="true"></i><b> <?php echo $wstoryrow->views;?>&nbsp;</b></font>
    						                    		<font>&nbsp;<i style="color: #3c8dbc" class="fa fa-star" aria-hidden="true"></i>
    						                    			<b>
    						                    			<?php if(isset($reviews21) && ($reviews21->num_rows()>0)) {
    						                    				foreach($reviews21->result() as $reviews2) { 
    						                    					if($reviews2->sid == $wstoryrow->sid) {
    						                    						echo round($reviews2->rating);
    						                    					}
    						                    			} } ?>
    						                    			</b>
    						                    		</font>
    						                    	</font><br>
    						                    </div>
    				                    		<div class="flextest" style="padding-top:6px">
    				                    			<?php if(isset($this->session->userdata['logged_in']['user_id']) && ($wstoryrow->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
    				                    				<button class="read" onclick="yoursreadlater();"><i class="fa fa-bookmark"></i> Read later </button>
    				                    			<?php }else{ ?>
    				                    				<?php if(isset($readlatersids) && (sizeof($readlatersids)>0) && in_array($wstoryrow->sid, $readlatersids)) { ?>
    				                    					<button onclick="unreadlater(<?php echo $wstoryrow->sid;?>)" class="readdone notloginmodal readlaterbtnatr<?php echo $wstoryrow->sid;?>">
    				                    					<i class="fa fa-check faicon<?php echo $wstoryrow->sid;?>"></i> Read later </button>
    				                    				<?php }else { ?>
    				                    					<button onclick="readlater(<?php echo $wstoryrow->sid;?>)" class="read notloginmodal readlaterbtnatr<?php echo $wstoryrow->sid;?>">
    				                    					<i class="fa fa-bookmark faicon<?php echo $wstoryrow->sid;?>"></i> Read later </button>
    				                    				<?php } ?>
    				                    			<?php } ?>
    				                    			
    				                    			<button type="button" class="btn read dropdown-toggle pull-right" data-toggle="dropdown">
    				                    				<span class=""><i class="fa fa-plus"></i></span>
    				                    			</button>
    				                    			<ul class="dropdown-menu list-inline dropvk">
    				                    				<li onclick="groupsuggest(<?php echo $wstoryrow->sid; ?>);">
    				                    					<a data-toggle="modal" data-target="#groupsuggest" title="COMMUNITY"><i class="fa fa-users"></i></a>
    				                    				</li>
    				                    				<li onclick="friend(<?php echo $wstoryrow->sid;?>);">
    				                    					<a data-toggle="modal" data-target="#friendsuggest" title="SUGGEST"><i class="fa fa-user"></i></a>
    				                    				</li>
    				                    				<li onclick="socialshare(<?php echo $wstoryrow->sid;?>, 'story');">
    				                    					<a data-toggle="modal" data-target="#soc" href="" title="SOCIAL">
    				                    						<i class="fa fa-share-alt"></i>
    				                    					</a>
    				                    				</li>
    				                    			</ul>
    				                    		</div>
    				                    	</div>        
    				                        <?php $i++; } } ?>
    			                        </div>
    		                        </div>
                            	</div>
                        	<?php } ?>
                        	<!-- STORIES -->
                        	
                        	<!-- LIFE EVENTS -->
                        	<?php if(isset($writerlifes) && ($writerlifes->num_rows() > 0)){ 
                        	    $tab1pagescount = $tab1pagescount+$writerlifes->num_rows(); ?>
                            <div class="row pt-0" style="margin-top:20px;">
		                        <div class="col-md-6 col-xs-8 pd-0">
		                        	<div class="titlei">LIFE EVENTS</div>
		                        </div>
		                        <?php if($writerlifes->num_rows() > 3) { ?>
		                        <div class="col-md-6 col-xs-4 pd-0">
		                        	<a href="<?php echo base_url();?>profileviewall?id=<?php echo $_GET['id'];?>&type=life"  class="view pull-right">
		                        	    <div class="pull-right">View More</div>
		                        	</a>
		                        </div>
		                        <?php } ?>
	                        </div><hr>
                			<div class="" style="justify-content:center;"> 
                			    <div id="StoryContl" class="StoryCont StoryContl1">
		                        	<div id="story-sliderl" class="story-slider">
		                        		<?php $j = 0; foreach($writerlifes->result() as $liferow) { if($j < 3){ ?>
		                        			<div class="card1">
		                        			    <a href="<?php echo base_url('only_story_view?id='.$liferow->sid);?>">
    		                        				<?php if(isset($liferow->cover_image) && !empty($liferow->cover_image)) { ?>
    		                        					<img src="<?php echo base_url();?>assets/images/<?php echo $liferow->cover_image; ?>" alt="<?php echo $liferow->title;?>" class="imageme1">
    		                        				<?php }else{ ?>
    		                        					<img src="<?php echo base_url();?>assets/dist/img/photo1.png" alt="<?php echo $liferow->title;?>" class="imageme1">
    		                        				<?php } ?>
		                        				</a>
		                        				<div>
			                        				<font class="max-lines">
			                        					<a href="<?php echo base_url('only_story_view?id='.$liferow->sid);?>">
			                        							<?php echo $liferow->title;?>
			                        					</a>
			                        				</font> 
		                        				</div>
		                        				<div class="flextest">
	                        						<font class="byname">By<font class="namehere"><a href="<?php echo base_url('profile?id='.$liferow->user_id);?>" style="color:#000"> <?php echo $liferow->name;?></a></font></font>
	                        						<br>
		                        				</div>
		                        				<div class="flextest" style="padding-top:4px;">
		                        					<font class="lifeEvents-text"><?php echo $liferow->story;?> 
		                        						<a href="<?php echo base_url('only_story_view?id='.$liferow->sid);?>"></a>
		                        					</font>
		                        				</div>
		                        				<div class="flextest" style="padding-top:6px">
		                        					<?php if(isset($this->session->userdata['logged_in']['user_id']) && ($liferow->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
		                        						<button class="read" onclick="yoursreadlater();"><i class="fa fa-bookmark"></i> Read later </button>
		                        					<?php }else{ ?>
		                        						<?php if(isset($readlatersids) && (sizeof($readlatersids)>0) && in_array($liferow->sid, $readlatersids)) { ?>
		                        							<button onclick="unreadlater(<?php echo $liferow->sid;?>)" class="readdone notloginmodal readlaterbtnatr<?php echo $liferow->sid;?>">
		                        							<i class="fa fa-check faicon<?php echo $liferow->sid;?>"></i> Read later </button>
		                        						<?php }else { ?>
		                        							<button onclick="readlater(<?php echo $liferow->sid;?>)" class="read notloginmodal readlaterbtnatr<?php echo $liferow->sid;?>">
		                        							<i class="fa fa-bookmark faicon<?php echo $liferow->sid;?>"></i> Read later </button>
		                        						<?php } ?>
		                        					<?php } ?>
		                        					<button type="button" class="btn read dropdown-toggle pull-right" data-toggle="dropdown">
		                        						<span class=""><i class="fa fa-plus"></i></span>
		                        					</button>
		                        					<ul class="dropdown-menu list-inline dropvklife">
		                        						<li onclick="groupsuggest(<?php echo $liferow->sid; ?>);">
		                        							<a data-toggle="modal" data-target="#groupsuggest" title="COMMUNITY"><i class="fa fa-users"></i></a>
		                        						</li>
		                        						<li onclick="friend(<?php echo $liferow->sid;?>);">
		                        							<a data-toggle="modal" data-target="#friendsuggest" title="SUGGEST"><i class="fa fa-user"></i></a>
		                        						</li>
		                        						<li onclick="socialshare(<?php echo $liferow->sid;?>, 'story');">
		                        							<a data-toggle="modal" data-target="#soc" href="" title="SOCIAL">
		                        								<i class="fa fa-share-alt"></i>
		                        							</a>
		                        						</li>
		                        					</ul>
		                        				</div>
		                        			</div>
		                        		<?php $j++; } } ?>
		                        	</div>
		                        </div>
                            </div>
                            <?php } ?>
                        	
                        	<!-- NANO STORIES -->
                		    <?php if(isset($writernanos) && ($writernanos->num_rows() > 0)){ 
                		        $tab1pagescount = $tab1pagescount+$writernanos->num_rows(); ?>
                    		    <div class="row pt-0" style="margin-top:20px;">
                    		        <div class="col-md-6 col-xs-8 pd-0">
    		                        	<div class="titlei">Nano Stories</div>
    		                        </div>
    		                        <?php if($writernanos->num_rows() > 3) { ?>
    		                        <div class="col-md-6 col-xs-4 pd-0">
    		                        	<a href="<?php echo base_url();?>profileviewall?id=<?php echo $_GET['id'];?>&type=nano" class="view pull-right">
    		                        	    <div class="pull-right">View More</div>
    		                        	</a>
    		                        </div>
    		                        <?php } ?>
                                </div> <hr>
                    			<div class="">
                    			    <div id="StoryContn" class="StoryCont1">
    		                        	<div id="story-slidern" class="story-slider">
    		                        		<?php $i = 0; foreach($writernanos->result() as $wnanorow) { if($i < 3){ ?>
    		                        			<div class="nano-stories">
    		                        				<div>
    		                        					<?php if(isset($wnanorow->profile_image) && !empty($wnanorow->profile_image)) { ?>
                        									<img src="<?php echo base_url();?>assets/images/<?php echo $wnanorow->profile_image; ?>" class="circle-image" style="height:50px;" alt="<?php echo $wnanorow->name;?>">
                        								<?php }else{ ?>
                        									<img src="<?php echo base_url();?>assets/dist/img/photo1.png" class="circle-image" style="height:50px;" alt="<?php echo $wnanorow->name;?>">
                        								<?php } ?>
                        								<h3 class="name-nanostories">
                        								    <a href="<?php echo base_url('profile?id='.$wnanorow->user_id);?>" style="color:#000"><?php echo $wnanorow->name;?></a>
                        								</h3>
    		                        				</div>
    		                        				<div>
    		                        					<hr style="width:100%;margin-top: 12px;">
    		                        					<a href="#" style="color:#000" data-toggle="modal" data-target="#modal-default<?php echo $wnanorow->sid;?>">
                        								    <font class="text-in-nanostory" onclick="nanoviewsadd(<?php echo $wnanorow->sid;?>);"><?php echo $wnanorow->story; ?></font>
                        								</a>
    		                        				</div>
    		                        				<div class="lastdiv">
    		                        					<hr style="width:100%;">
    		                        					<font style="color:#777" onclick="nanolike(<?php echo $wnanorow->sid;?>);">
                        								    <b class="nanolike<?php echo $wnanorow->sid;?>">
                        								        <span class="nanolikecount<?php echo $wnanorow->sid;?>"><?php echo $wnanorow->nanolikecount;?></span>
                        								    </b><i class="fa fa-heart-o" aria-hidden="true" style="color:#f00;"></i>
                        								</font>
    		                        					<div style="float:right;color:#777">
    		                        						<a href="" class="dropdown-toggle text-muted" data-toggle="dropdown">
                        										<i class="fa fa-share-alt" aria-hidden="true"></i>
                        									</a>
    		                        						<ul class="dropdown-menu list-inline dropvknano">
                            									<li onclick="groupsuggest(<?php echo $wnanorow->sid; ?>);">
                            										<a data-toggle="modal" data-target="#groupsuggest"><i class="fa fa-users"></i></a>
                            									</li>
                            									<li onclick="friend(<?php echo $wnanorow->sid;?>);">
                            										<a data-toggle="modal" data-target="#friendsuggest"><i class="fa fa-user"></i></a>
                            									</li>
                        										<li>
                        											<a data-toggle="modal" data-target="#soc" href=""><i class="fa fa-share-alt"></i></a>
                        										</li>
                        									</ul>
    		                        					</div>
    		                        					<font style="float:right;color:#777">
                        								    <i class="fa fa-eye" aria-hidden="true"></i>
                        								    <b><span class="nanoviewcount<?php echo $wnanorow->sid;?>"><?php echo $wnanorow->views; ?></span></b>&nbsp;&nbsp;
                        								</font>
    		                        				</div>
    		                        			</div>
    		                        		<?php $i++; } } ?>
    		                        	</div>
                        			</div>
                            	</div>	<br>
                			<?php } ?>
                    		    <!-- Modelpop up -->
                            <?php if(isset($writernanos) && ($writernanos->num_rows() > 0)){
                    	        foreach($writernanos->result() as $wmnanorow) { ?>
                        		<div class="modal fade" id="modal-default<?php echo $wmnanorow->sid;?>">
                        			<div class="modal-dialog">
                        				<div class="modal-content">
                        					<div class="modal-header">
                        						<div class="">
                        						    <?php if(isset($wmnanorow->profile_image) && !empty($wmnanorow->profile_image)) { ?>
                    									<img src="<?php echo base_url();?>assets/images/<?php echo $wmnanorow->profile_image; ?>" class="user-image img-circle" style="height:50px;" alt="<?php echo $wmnanorow->name;?>">
                    								<?php }else{ ?>
                    									<img src="<?php echo base_url();?>assets/dist/img/user2-160x160.jpg" class="user-image img-circle" style="height:50px;" alt="<?php echo $wmnanorow->name;?>">
                    								<?php } ?>
                        							<h3 class="name-nanostories" style="margin-top: -40px; margin-left: 50px;">
                        							    <a href="<?php echo base_url('profile?id='.$wmnanorow->user_id);?>" style="color:#000"><?php echo $wmnanorow->name;?></a>
                        			                    <span class="pull-right">
                        			                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    	        <span aria-hidden="true">&times;</span>
                                                            </button>
                        			                    </span>
                        			                </h3>
                        						</div>
                        					</div>
                        					<div class="modal-body modal-bodyv" style="overflow-y:scroll;">
                        						<font class="text-in-nanostory-p" style="border-left:none; overflow-y:scroll;"><?php echo $wmnanorow->story; ?></font>
                        					</div>
                        					<div class="modal-footer">
                        						<ul class="list-inline">
                        							<li class="text-muted pull-left" onclick="nanolike(<?php echo $wmnanorow->sid;?>);">
                        							    <b class="nanolike<?php echo $wmnanorow->sid;?>">
                    								        <span class="nanolikecount<?php echo $wmnanorow->sid;?>"><?php echo $wmnanorow->nanolikecount;?></span>
                    								    </b><i class="fa fa-heart-o" aria-hidden="true" style="color:#f00;"></i>
                        							</li>
                        							<li class="pull-right">
                                                    	<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-share-alt"></i></a>
                                                        <ul class="dropdown-menu list-inline dropvknano1">
                                                            <li onclick="groupsuggest(<?php echo $wmnanorow->sid; ?>);">
                    										    <a data-toggle="modal" data-target="#groupsuggest"><i class="fa fa-users"></i></a>
                        									</li>
                        									<li onclick="friend(<?php echo $wmnanorow->sid;?>);">
                        										<a data-toggle="modal" data-target="#friendsuggest"><i class="fa fa-user"></i></a>
                        									</li>
                    										<li>
                    											<a data-toggle="modal" data-target="#soc" href=""><i class="fa fa-share-alt"></i></a>
                    										</li>
                                                        </ul>
                                                    </li>
                        						</ul>
                        					</div>
                        				</div> <!-- /.modal-content -->
                        			</div> <!-- /.modal-dialog -->
                                </div> <!-- /.modal -->
                            <?php } } ?>
                            
                            <?php if($tab1pagescount < 1){  ?>
                                <center><img src="<?php echo base_url();?>assets/images/nodata.svg"></center>
                            <?php } ?>
                		</div>
                		<!-- END TAB 1 -->
                		
                		<!-- START TAB 2 -->
                		<div class="tab-pane" id="tab_reading" <?php if($readingliststatus != 'public'){ ?>style="display:none;" <?php } ?>>
                		    <?php if(isset($rlseries) && ($rlseries->num_rows() > 0)){ 
                		        $tab2pagescount = $tab2pagescount+$rlseries->num_rows(); ?>
                            <div class="row pt-0" style="margin-top:40px;">
	                            <div class="col-md-6 col-xs-8 pd-0">
		                        	<div class="titlei">SERIES</div>
		                        </div>
		                    </div><hr>
                            <div class="">
                                <div id="StoryContv1" class="StoryCont1" style="text-align:left;">
			                        <div id="story-sliderv1" class="story-slider series">
			                        <?php foreach($rlseries->result() as $rlseriesrow){ ?>
			                        	<div class="card">
			                    		    <div class="book-type"><?php echo $rlseriesrow->gener;?></div>
			                    			<a href="<?php echo base_url('only_story_view?id='.$rlseriesrow->sid.'&story_id='.$rlseriesrow->story_id);?>">
    			                    			<?php if(isset($rlseriesrow->cover_image) && !empty($rlseriesrow->cover_image)) { ?>
    			                    			    <img src="<?php echo base_url();?>assets/images/<?php echo $rlseriesrow->cover_image; ?>" alt="<?php echo $rlseriesrow->title;?>" class="imageme">
    			                    			<?php }else{ ?>
    			                    				<img src="<?php echo base_url();?>assets/dist/img/photo1.png" alt="<?php echo $rlseriesrow->title;?>" class="imageme">
    			                    			<?php } ?>
    			                    		</a>
    			                    		<div>
    			                    			<font class="max-lines">
    			                    				<a href="<?php echo base_url('only_story_view?id='.$rlseriesrow->sid.'&story_id='.$rlseriesrow->story_id);?>">
    			                    					<?php echo $rlseriesrow->title;?>
    			                    				</a>
    			                    			</font> 
    			                    		</div>
    			                    		<div class="flextest">
    			                    			<font class="byname">By<font class="namehere"><a href="<?php echo base_url('profile?id='.$rlseriesrow->user_id);?>" style="color:#000"><?php echo $rlseriesrow->name;?></a></font>
    			                    			</font><br>
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
    			                    					<a data-toggle="modal" data-target="#groupsuggest" title="COMMUNITY"><i class="fa fa-users"></i></a>
    			                    				</li>
    			                    				<li onclick="friend(<?php echo $rlseriesrow->sid;?>);">
    			                    					<a data-toggle="modal" data-target="#friendsuggest" title="SUGGEST"><i class="fa fa-user"></i></a>
    			                    				</li>
    			                    				<li onclick="socialshare(<?php echo $rlseriesrow->sid;?>, 'series');">
    			                    					<a data-toggle="modal" data-target="#soc" href="" title="SOCIAL">
    			                    						<i class="fa fa-share-alt"></i>
    			                    					</a>
    			                    				</li>
    			                    			</ul>
    			                    		</div>
			                    	    </div>        
			                        <?php } ?>
			                        </div>
	                            </div>
                            </div>
                            <?php } ?>
                            <!-- END SERIES -->
                            <!-- START STORIES -->
                		    <?php if(isset($rlstories) && ($rlstories->num_rows() > 0)){ 
                		        $tab2pagescount = $tab2pagescount+$rlstories->num_rows(); ?>
                		    <div class="row pt-0" style="margin-top:20px;">
	                            <div class="col-md-6 col-xs-8 pd-0">
		                        	<div class="titlei">stories</div>
		                        </div>
	                        </div>
                		    <hr>
                		    <div class="">
                                <div id="StoryCont2s" class="StoryCont1" style="text-align:left;">
				                    <div id="story-slider2s" class="story-slider series">
				                        <?php foreach($rlstories->result() as $rlstoryrow) { ?>
				                        <div class="card">
				                    		<div class="book-type"><?php echo $rlstoryrow->gener;?></div>
			                    			<a href="<?php echo base_url('only_story_view?id='.$rlstoryrow->sid.'&story_id='.$rlstoryrow->story_id);?>">
    			                    			<?php if(isset($rlstoryrow->cover_image) && !empty($rlstoryrow->cover_image)) { ?>
    			                    			    <img src="<?php echo base_url();?>assets/images/<?php echo $rlstoryrow->cover_image; ?>" alt="<?php echo $rlstoryrow->title;?>" class="imageme">
    			                    			<?php }else{ ?>
    			                    				<img src="<?php echo base_url();?>assets/dist/img/photo1.png" alt="<?php echo $rlstoryrow->title;?>" class="imageme">
    			                    			<?php } ?>
			                    			</a>
				                    		<div>
				                    			<font class="max-lines">
				                    				<a href="<?php echo base_url('only_story_view?id='.$rlstoryrow->sid.'&story_id='.$rlstoryrow->story_id);?>">
				                    					<?php echo $rlstoryrow->title;?>
				                    				</a>
				                    			</font> 
				                    		</div>
				                    		<div class="flextest">
				                    			<font class="byname">By<font class="namehere"><a href="<?php echo base_url('profile?id='.$rlstoryrow->user_id);?>" style="color:#000"><?php echo $rlstoryrow->name;?></a>				                    			</font>
				                    			</font><br>
				                    		</div>
				                    		<div class="flextest" style="padding-top:4px;">
						                    	<font class = "episodes">
						                    		<font>
						                    			<?php $wordcount = explode(' ', $rlstoryrow->story);
					                            	$time = round(sizeof($wordcount)/180);	?>
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
				                    					<a data-toggle="modal" data-target="#groupsuggest" title="COMMUNITY"><i class="fa fa-users"></i></a>
				                    				</li>
				                    				<li onclick="friend(<?php echo $rlstoryrow->sid;?>);">
				                    					<a data-toggle="modal" data-target="#friendsuggest" title="SUGGEST"><i class="fa fa-user"></i></a>
				                    				</li>
				                    				<li onclick="socialshare(<?php echo $rlstoryrow->sid;?>, 'story');">
				                    					<a data-toggle="modal" data-target="#soc" href="" title="SOCIAL">
				                    						<i class="fa fa-share-alt"></i>
				                    					</a>
				                    				</li>
				                    			</ul>
				                    		</div>
				                        </div>        
				                        <?php } ?>
				                    </div>
		                        </div>
                        	</div>
                        	<?php } ?>
                        	
                        	<?php if(isset($rllife) && ($rllife->num_rows() > 0)){
                        	    $tab2pagescount = $tab2pagescount+$rllife->num_rows(); ?>
                		    <div class="row pt-0" style="margin-top:20px;">
	                            <div class="col-md-6 col-xs-8 pd-0">
		                        	<div class="titlei">life events</div>
		                        </div>
	                        </div>
                		    <hr>
                		    <div class="">
                                <div id="StoryContls" class="StoryCont" >
		                        	<div id="story-sliderls" class="story-slider" >
		                        		<?php foreach($rllife->result() as $rlliferow) { ?>
		                        			<div class="card1">
		                        			    <a href="<?php echo base_url('only_story_view?id='.$rlliferow->sid);?>">
		                        				<?php if(isset($rlliferow->cover_image) && !empty($rlliferow->cover_image)) { ?>
		                        					<img src="<?php echo base_url();?>assets/images/<?php echo $rlliferow->cover_image; ?>" alt="<?php echo $rlliferow->title;?>" class="imageme1">
		                        				<?php }else{ ?>
		                        					<img src="<?php echo base_url();?>assets/dist/img/photo1.png" alt="<?php echo $rlliferow->title;?>" class="imageme1">
		                        				<?php } ?>
		                        				</a>	
		                        				<div>
		                        				<font class="max-lines">
		                        					<a href="<?php echo base_url('only_story_view?id='.$rlliferow->sid);?>">
		                        							<?php echo $rlliferow->title;?>
		                        					</a>
		                        				</font> 
		                        				</div>
		                        				
		                        				
		                        				<div class="flextest">
		                        					<?php if(($rlliferow->writing_style == 'anonymous') && ($rlliferow->type == 'life')){ ?>
		                        						<font class="byname">By<font class="namehere">Anonymous</font></font><br>
		                        					<?php } else { ?>
		                        						<font class="byname">By<font class="namehere"><?php echo $rlliferow->name;?></font></font>
		                        						<br>
		                        					<?php } ?>
		                        				</div>
		                        				
		                        				<div class="flextest" style="padding-top:4px;">
		                        					<font class="lifeEvents-text"><?php echo $rlliferow->story;?> 
		                        						<a href="<?php echo base_url('only_story_view?id='.$rlliferow->sid);?>"></a>
		                        					</font>
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
		                        							<a data-toggle="modal" data-target="#groupsuggest" title="COMMUNITY"><i class="fa fa-users"></i></a>
		                        						</li>
		                        						<li onclick="friend(<?php echo $rlliferow->sid;?>);">
		                        							<a data-toggle="modal" data-target="#friendsuggest" title="SUGGEST"><i class="fa fa-user"></i></a>
		                        						</li>
		                        						<li onclick="socialshare(<?php echo $rlliferow->sid;?>, 'story');">
		                        							<a data-toggle="modal" data-target="#soc" href="" title="SOCIAL">
		                        								<i class="fa fa-share-alt"></i>
		                        							</a>
		                        						</li>
		                        					</ul>
		                        				</div>
		                        			</div>
		                        		<?php } ?>
		                        	</div>
		                        </div>
                            </div>
                            <?php } ?>
                            
                            <?php if($tab2pagescount < 1){  ?>
                                <center><img src="<?php echo base_url();?>assets/images/nodata.svg"></center>
                            <?php } ?>
                        </div>
                	</div>
        		</div>
        	</div>
        </section>
        
    
    
    </div>
<!-- group suggest popup code ---- -->
<div class="modal fade" id="groupsuggest" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="storysuggesttogroup"></div>
        </div>
    </div>
</div>
<!-- group suggest popup code ----------- -->

<!-- frind popup code ------>
<div class="modal fade" id="friendsuggest" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="storysuggesttofriend"></div>
        </div>
    </div>
</div>
<!--frind popup end ------------->
<div class="modal fade" id="editpro_comment" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><b>Update your Comments</b></h4>
            </div>
            <div class="modal-body">
                <form id="editprocomment" >
                    <textarea class="form-control input-sm" name="pro_comment" id="pro_editcomment" placeholder="Enter comment" style="resize:none;"></textarea>
                    <span class="text-danger pro_comment"></span>
                    <input type="hidden" id="commentid" name="commentid">
                    <br>
                    <center>
                        <button class="btn btn-primary" type="submit"> Update </button>
                    </center>
                </form>
            </div>
        </div>
    </div>
</div>




<!-- Social Popup ---- -->
<div class="modal fade" id="soc">
	<div class="modal-dialog">
		<div class="modal-content socv ">
			<div class="modal-header" style="padding:8px 15px;">
				<button type="button" class="close" style="color:#000; opacity:initial; margin-top:0px;" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h5 class="modal-title text-center" style="color:#808182;">SOCIAL MEDIA SHARE</h5>
			</div>
			<div class="modal-body" style="padding-top:5px;">
				<div class="row">
					<div class="col-md-12 pd-5v">
						<a href="javascript:void(0);" class="facebookshare">
						    <img src="<?php echo base_url();?>assets/svg/fb.svg" style="width:40px; height:40px;"/> <span style="vertical-align: -webkit-baseline-middle; padding-left:5px; font-size:18px;">Faceebok</span></a>
					</div>
					<div class="col-md-12 pd-5v">
					    <a href="javascript:void(0);" class="whatsappshare">
						    <img src="<?php echo base_url();?>assets/svg/wa.svg" style="width:40px; height:40px;"/> <span style="vertical-align: -webkit-baseline-middle; padding-left:5px; font-size:18px;">Whatsapp</span></a>
					</div>
					<div class="col-md-12 pd-5v">
						<a href="javascript:void(0);" class="twittershare">
						    <img src="<?php echo base_url();?>assets/svg/twitter.svg" style="width:40px; height:40px;"/> <span style="vertical-align: -webkit-baseline-middle; padding-left:5px; font-size:18px;">Twitter</span></a>
					</div>
					<div class="col-md-12 pd-5v">
						<a href="javascript:void(0);" onclick="copylinkshare('#copylinkshare')">
						    <img src="<?php echo base_url();?>assets/svg/link.svg" style="width:40px; height:40px;"/> <span style="vertical-align: -webkit-baseline-middle; padding-left:5px; font-size:18px;">Copy to link</span></a>
					    <input type="hidden" id="copylinkshare" value="<?php echo base_url();?>">
					</div>
				</div>
			</div>
		</div>
	<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- Social popup ---- -->



<div class="modal fade" id="reportpro_comment" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><b>Report Your Comments</b></h4>
            </div>
            <div class="modal-body">
                <form id="reportprocomment">
                    <textarea class="form-control input-sm" name="reportpro_cmt" id="reportpro_cmt" placeholder="Enter Repost message" style="resize:none;"></textarea>
                    <span class="text-danger reportpro_cmt"></span>
                    <input type="hidden" name="reportcommentid" value="" id="reportcommentid">
                    <input type="hidden" name="reportuser_id" value="" id="reportuser_id">
                    <br>
                    <center>
                        <button class="btn btn-primary" type="submit"> Update </button>
                    </center>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- ./wrapper -->
<script src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>

<script type="text/javascript">
$("#profilecomments").submit(function(event) {
    event.preventDefault();
    $.ajax({
      url: "<?php echo base_url('index.php/welcome/pro_comment'); ?>",
      type: 'POST',
      data: $("form#profilecomments").serialize(),
      success: function(data) {
          $('#pro_comment').val('');
        if(data == 1){
            $.ajax({
                url: "<?php echo base_url('index.php/welcome/pro_commentpost'); ?>",
                type: 'POST',
                dataType: 'json',
                success: function(result) {
                    if(result.response){
                       // console.log(result.response[0]);
                        $("#commentresults").prepend('<li class="commentdelete'+result.response[0].cid+'" style="margin-bottom:5px;">'+
                        '<div class=""><a href="<?php echo base_url();?>profile?id='+result.response[0].user_id+'">'+
                        '<img src="<?php echo base_url();?>assets/images/2.png" style="border-radius: 50%;width:40px !important;height: 40px !important;margin-right: 10px;">'+
                        '</a></div><div class="comment_right clearfix"><div class="comment_info" style="padding-left:10px;">'+
                        '<a href="<?php echo base_url();?>profile?id='+result.response[0].user_id+'">'+result.response[0].name+'</a>'+
                        '<span class="pull-right"><a href="#" class="dropdown-toggle" data-toggle="dropdown" title="write" aria-expanded="true" style="padding: 0px 15px;">'+
                        '<i class="fa fa-ellipsis-v"></i></a> <ul class="dropdown-menu writemenu" style="top:auto; width:fit-content; padding:10px; left:140px">'+
                        '<li><a href="javascript:void(0);"><span onClick="editpro_comment('+result.response[0].cid+');"><i class="fa fa-pencil"></i> EDIT</span></a></li>'+
                        '<li><a href="javascript:void(0);"><span onClick="deletepro_comment('+result.response[0].cid+');"><i class="fa fa-trash"></i> DELETE</span></a></li></ul></span>'+
                        '<br>'+result.response[0].date+'<br></div><p style="margin: 8px 0px 2px 0px;" class="pcomment'+result.response[0].cid+'">'+result.response[0].pro_comment+'</p>'+
                        '<a href="javascript:void(0)" onClick="postReplycomment('+result.response[0].cid+')" style="color:#de1800;font-size:0.8em;"> REPLY </a> I '+
                        '<a href="javascript:void(0)" onClick="replycomments('+result.response[0].profile_id+', '+result.response[0].cid+')" style="color:#de1800;font-size:0.8em;"> 0 REPLIES</a>'+
                        '<input type="hidden" id="replycmtcount'+result.response[0].cid+'" value="0"><div class="input-group postreplycomment'+result.response[0].cid+'"></div>'+
                        '<span class="text-danger addreplaycmt'+result.response[0].cid+'"></span><div class="box-comment replycommentslist">'+
                        '<ul id="replycommentresults'+result.response[0].cid+'" style="padding-left:10px;list-style:none;"></ul><span class="viewmore'+result.response[0].cid+'"></span>'+
                        '</div></div></li>');
                    }
                }
            });
          //alert('Your Comment Posted Successfully.');
        }else{
          alert('Failed to Post Comment. Please try Again.');
        }
        //location.reload();
      }
    });
  });
</script>
<script>
$(function() { // auto scroll load comments
    var profileid = "<?php echo $_GET['id'];?>";
    loadResults(0);
    $('.commentslist').scroll(function() {
        if($("#loadingcomments").css('display') == 'none') {
            if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
                var limitStart = $("#commentresults li").length;
                loadResults(limitStart); 
            }
        }
    }); 
    function loadResults(limitStart) {
        //$("#loadingcomments").show();
        $.ajax({
            url: "<?php echo base_url();?>index.php/welcome/profilecomments/"+profileid,
            type: "post",
            data: {limitStart: limitStart},
            success: function(data) {
                $("#commentresults").append(data);
                $("#loadingcomments").hide();
            }
        });
    };
});
function replycomments(profileid, commentid){ //replay comments view more
    var limitstarting = $("#replycommentresults"+commentid+" > li").length;
    var replycmtcount = $('#replycmtcount'+commentid).val();
    if(limitstarting){ }else{ limitstarting = 0; }
    $.ajax({
        url: "<?php echo base_url();?>index.php/welcome/profilereplycomments/"+profileid,
        type: "post",
        data: {'limitStart': limitstarting, 'cid': commentid},
        success: function(data) {
            $("#replycommentresults"+commentid).append(data);
            $('.viewmore'+commentid).html('<a href="javascript:void(0)" onClick="replycomments('+profileid+','+commentid+')" style="color:#de1800;padding-left: 55px;">View More</a>');
            if(replycmtcount <= limitstarting+2){
                $('.viewmore'+commentid).css('display','none');
            }
        }
    });
};

function editpro_comment(commentid){
    $('#editpro_comment').modal('show');
    $.ajax({
        url:'<?php echo base_url();?>index.php/welcome/editpro_comment/'+commentid,
        method: 'POST',
        dataType: "json",
        success:function(data){
            if(data.response[0].pro_comment) {
                console.log(data.response[0].pro_comment);
                $('textarea#pro_editcomment').val(data.response[0].pro_comment);
                $('#commentid').val(commentid);
           }else{
               $('#editpro_comment').modal('hide');
           }
        } 
    });
}
$( "form#editprocomment" ).submit(function( event ) {
    event.preventDefault();
    var comments = $('textarea#pro_editcomment').val();
    var cid = $('#commentid').val();
    $.post("<?php echo base_url();?>index.php/welcome/updateprocomment",{'comment':comments,'cid':cid},function(resultdata){
        if(resultdata == 2){
            $('span.pro_comment').text('Please Enter Comment');
        }else if(resultdata == 1){
            console.log('success');
            $('p.pcomment'+cid).html(comments);
            $('#editpro_comment').modal('hide');
        }else{
            console.log('fail');
        }
    });
});
    
function deletepro_comment(commentid){
    $.ajax({
        url:'<?php echo base_url();?>index.php/welcome/deletepro_comment/'+commentid,
        method: 'POST',
        dataType: "json",
        success:function(data){
            if(data == 1) {
                $('li.commentdelete'+commentid).css('display','none');
            }
        } 
    });
}
function postReplycomment(commentid){
    $('div.postreplycomment'+commentid).html('<input type="text" id="replycmts'+commentid+'" value="" class="form-control" placeholder="Replay Comment..." required>'+
    '<span class="input-group-btn"><button type="submit" class="btn btn-success btn-flat" onclick="addreplycomment('+commentid+')">POST</button></span>');
}
function addreplycomment(commentid){
    var comments = $('#replycmts'+commentid).val();
    var profile_id = "<?php echo $_GET['id'];?>";
    if(comments){
        $.ajax({
            url:'<?php echo base_url();?>index.php/welcome/addreplycomment',
            method: 'POST',
            data: {'comment_id': commentid, 'pro_comment':comments, 'profile_id': profile_id},
            dataType: "json",
            success:function(data){
                if(data == 2){
                    $('.addreplaycmt'+commentid).text('Enter your Comments.');
                }else if(data == 1){
                    var loginname = '';
                    $('#replycommentresults'+commentid).html('<li style="margin-bottom:10px;" class="commentdelete'+commentid+'">'+
                    '<div class="media"><div class="media-left" style="padding-right:5px;"><img src="<?php echo base_url();?>assets/images/2.png" style="border-radius: 50%;width:30px !important;height: 30px !important;">'+
                    '</div><div class="media-body" style="background-color:#ddd; padding-left:8px; border-radius: 10px;">'+
                    '<b>'+loginname+'</b><p style="margin: 8px 0px 2px 0px;" class="pcomment'+commentid+'">'+comments+'</p></div></div></li>');
                }else{
                    $('.addreplaycmt'+commentid).text('Failed to Post your Comments.');
                }
            }
        });
    }else{
        $('.addreplaycmt'+commentid).text('Enter your Comments.');
    }
}
function reportpro_comment(commentid, user_id){
    $('#reportpro_comment').modal('show');
    $('#reportcommentid').val(commentid);
    $('#reportuser_id').val(user_id);
}
$( "form#reportprocomment" ).submit(function( event ) {
    event.preventDefault();
    $.post("<?php echo base_url();?>index.php/welcome/reportpro_comment",$("form#reportprocomment").serialize(),function(resultdata){
        if(resultdata == 2){
            $('span.reportpro_cmt').text('Please Enter your Report Message');
        }else if(resultdata == 1){
            console.log('success');
            $('#reportpro_comment').modal('hide');
        }else{
            console.log('fail');
        }
    });
});
</script>
<script>
    function aboutactive(){
        $('#tab_about').addClass('visiblev');
    }
    function aboutinactive(){
        $('#tab_about').removeClass('visiblev');
    }
</script>
<script>
    var text_max = 1000;
    $('#count_message').html(text_max + ' remaining');
    $('#story').keyup(function() {
        var text_length = $('#story').val().length;
        var text_remaining = text_max - text_length;
        $('#count_message').html(text_remaining + ' Remaining');
    });
</script>

<script>
// responsive tab script profile comments
       $(document).ready( function (){
        if($( window ).width() > 1230) {
            $('ul.pcmtmwidth').removeAttr('id','commentresults');
            $('.pcmtmwidth').css('display','none');
            $('ul.pcmtfwidth').addAttr('id','commentresults');
            $('pcmtfwidth').css('display','block');
            
        }else{
            $('ul.pcmtfwidth').removeAttr('id','commentresults');
            $('.pcmtfwidth').css('display','none');
            $('ul.pcmtmwidth').addAttr('id','commentresults');
            $('.pcmtmwidth').css('display','block');
        }
    });
    $( window ).resize(function() {
        if($( window ).width() > 1230) {
            $('ul.pcmtmwidth').removeAttr('id','commentresults');
            $('.pcmtmwidth').css('display','none');
            $('ul.pcmtfwidth').addAttr('id','commentresults');
            $('pcmtfwidth').css('display','block');
            
        }else{
            $('ul.pcmtfwidth').removeAttr('id','commentresults');
            $('.pcmtfwidth').css('display','none');
            $('ul.pcmtmwidth').addAttr('id','commentresults');
            $('.pcmtmwidth').css('display','block');
        }
    });
    
      // responsive tab view
  $("#tabprofilecomments").submit(function(event) {
      event.preventDefault();
    $.ajax({
      url: "<?php echo base_url('index.php/welcome/pro_comment'); ?>",
      type: 'POST',
      data: $("form#tabprofilecomments").serialize(),
      success: function(data) {
          $('textarea#pro_comment').val('');
          //$('textarea[name="pro_comment"]').html(' ');
        if(data == 1){
            $.ajax({
                url: "<?php echo base_url('index.php/welcome/pro_commentpost'); ?>",
                type: 'POST',
                dataType: 'json',
                success: function(result) {
                    if(result.response){
                        var profile_image = "<?php echo $this->session->userdata['logged_in']['profile_image'];?>";
                        if(profile_image){  }else{ profile_image="2.png"; }
                    		    
                        $("#commentresults").prepend('<li class="commentdelete'+result.response[0].cid+'" style="margin-bottom:5px;"><hr>'+
                        '<div style="float: left;"><a href="<?php echo base_url();?>index.php/welcome/profile?id='+result.response[0].user_id+'">'+
                        '<img src="<?php echo base_url();?>assets/images/'+profile_image+'" style="border-radius: 50%;width:40px !important;height: 40px !important;margin-right: 10px;">'+
                        '</a></div><div class="comment_right clearfix"><div class="comment_info" style="padding-left:10px;">'+
                        '<a href="<?php echo base_url();?>index.php/welcome/profile?id='+result.response[0].user_id+'">'+result.response[0].name+'</a>'+
                        '<span class="pull-right" style="margin-right:20px;"><a href="#" class="dropdown-toggle" data-toggle="dropdown" title="write" aria-expanded="true">'+
                        '<i class="fa fa-ellipsis-v"></i></a> <ul class="dropdown-menu writemenu" style="top:auto; width:fit-content;">'+
                        '<li><span class="" onClick="editpro_comment('+result.response[0].cid+');"><i class="fa fa-pencil"></i> Edit</span>	</li>'+
                        '<li><span class="" onClick="deletepro_comment('+result.response[0].cid+');"><i class="fa fa-trash"></i> Delete</span></li></ul></span>'+
                        '<br>1 minute ago<br></div><p style="margin: 8px 0px 2px 0px;" class="pcomment'+result.response[0].cid+'">'+result.response[0].pro_comment+'</p>'+
                        '<a href="javascript:void(0)" onClick="postReplycomment('+result.response[0].cid+')" style="color:#de1800;font-size:0.8em;"> REPLY </a> I '+
                        '<a href="javascript:void(0)" onClick="replycomments('+result.response[0].profile_id+', '+result.response[0].cid+')" style="color:#de1800;font-size:0.8em;">'+
                        '<span id="repliescount'+result.response[0].cid+'">0</span> REPLIES</a>'+
                        '<input type="hidden" id="replycmtcount'+result.response[0].cid+'" value="0"><div class="input-group postreplycomment'+result.response[0].cid+'"></div>'+
                        '<span class="text-danger addreplaycmt'+result.response[0].cid+'"></span><div class="box-comment replycommentslist">'+
                        '<ul id="replycommentresults'+result.response[0].cid+'" style="padding-left:10px;list-style:none;"></ul><span class="viewmore'+result.response[0].cid+'"></span>'+
                        '</div></div></li>');
                    }
                }
            });
        }else{
          alert('Failed to Post Comment. Please try Again.');
        }
      }
    });
  });


    function readinglist(rlstatus) {
        if(rlstatus == 'private'){
            $('#readinglist').attr('checked','true');
            $.ajax({
        		url: "<?php echo base_url();?>index.php/welcome/readingliststatus/"+rlstatus,
        		type: 'POST',
        		success: function (resultdata) {
                    $('#readinglist').val('public');
                    $('span.readinglist').text('Public');
        		}
    	    });
        }else{
            $('#readinglist').attr('checked', false);
            $.ajax({
        		url: "<?php echo base_url();?>index.php/welcome/readingliststatus/"+rlstatus,
        		type: 'POST',
        		success: function (resultdata) {
                    $('#readinglist').val('private');
                    $('span.readinglist').text('Private');
        		}
    	    });
        }
    }
</script>


<script>
    var rightButtonv = $("#right-btnv");
    var leftButtonv = $("#left-btnv");
    var containerv = $("#StoryContv");
    var slideContv = $("#story-sliderv");
    if($("#story-sliderv > div").length<5){
      $('#right-btnv').hide();
      $('#left-btnv').hide();
    }
    var maxcountv=$("#story-sliderv > div").length;
    var marLeftv = 0, maxXv = maxcountv*210, diffv = 0 ;
    
    function slidev() {
    marLeftv-=219;
    if( marLeftv < -maxXv ){ 
      marLeftv = -maxXv+183 ;
    }
      slideContv.animate({"margin-left" : marLeftv + "px"}, 400);
    }
    
    function slideBackv() {
      marLeftv +=219;
      if ( marLeftv > 0 ) { marLeftv = 0 ;}
      slideContv.animate({"margin-left" : marLeftv + "px"}, 400);
    }
    rightButtonv.click(slidev);
    leftButtonv.click(slideBackv);
    
    /*touch code from here*/
    
    $(containerv).on("mousedown touchstart", function(e) {
      
      var startXv = e.pageX || e.originalEvent.touches[0].pageX;
      diffv = 0;
    
      $(containerv).on("mousemove touchmove", function(e) {
        
          var xtv = e.pageX || e.originalEvent.touches[0].pageX;
          diffv = (xtv - startXv) * 100 / window.innerWidth;
        if( marLeftv == 0 && diffv > 10 ) { 
          event.preventDefault() ;
        } else if (  marLeftv == -maxXv && diffv < -10 ) {
           event.preventDefault();   
        }
      });
    });
    
    $(containerv).on("mouseup touchend", function(e) {
      $(containerv).off("mousemove touchmove");
      if(  marLeftv == 0 && diffv > 4 ) { 
          sliderContv.animate({"margin-left" :  0 + "px"},100);
       } else if (  marLeftv == -maxXv  && diffv < 4 ){
           sliderContv.animate({"margin-left" : -maxXv  + "px"},100);  
       } else {
          if (diffv < -10) {
            slidev();
          } else if (diffv > 10) {
            slideBackv();
          } 
      }
    });

</script>

<script>
    var rightButtonv1 = $("#right-btnv1");
    var leftButtonv1 = $("#left-btnv1");
    var containerv1 = $("#StoryContv1");
    var slideContv1 = $("#story-sliderv1");
    if($("#story-sliderv1 > div").length<5){
      $('#right-btnv1').hide();
      $('#left-btnv1').hide();
    }
    var maxcountv1=$("#story-sliderv1 > div").length;
    var marLeftv1 = 0, maxXv1 = maxcountv1*210, diffv1 = 0 ;
    
    function slidev1() {
    marLeftv1-=219;
    if( marLeftv1 < -maxXv1 ){ 
      marLeftv1 = -maxXv1+183 ;
    }
      slideContv1.animate({"margin-left" : marLeftv1 + "px"}, 400);
    }
    
    function slideBackv1() {
      marLeftv1 +=219;
      if ( marLeftv1 > 0 ) { marLeftv1 = 0 ;}
      slideContv1.animate({"margin-left" : marLeftv1 + "px"}, 400);
    }
    rightButtonv1.click(slidev1);
    leftButtonv1.click(slideBackv1);
    
    /*touch code from here*/
    
    $(containerv1).on("mousedown touchstart", function(e) {
      
      var startXv1 = e.pageX || e.originalEvent.touches[0].pageX;
      diffv1 = 0;
    
      $(containerv1).on("mousemove touchmove", function(e) {
        
          var xtv1 = e.pageX || e.originalEvent.touches[0].pageX;
          diffv1 = (xtv1 - startXv1) * 100 / window.innerWidth;
        if( marLeftv1 == 0 && diffv1 > 10 ) { 
          event.preventDefault() ;
        } else if (  marLeftv1 == -maxXv1 && diffv1 < -10 ) {
           event.preventDefault();   
        }
      });
    });
    
    $(containerv1).on("mouseup touchend", function(e) {
      $(containerv1).off("mousemove touchmove");
      if(  marLeftv1 == 0 && diffv1 > 4 ) { 
          sliderContv1.animate({"margin-left" :  0 + "px"},100);
       } else if (  marLeftv1 == -maxXv1  && diffv1 < 4 ){
           sliderContv1.animate({"margin-left" : -maxXv1  + "px"},100);  
       } else {
          if (diffv1 < -10) {
            slidev1();
          } else if (diffv1 > 10) {
            slideBackv1();
          } 
      }
    });

</script>
<!-- Seriesv1 -->

<!-- stories -->
<script>
    var rightButton = $("#right-btn");
    var leftButton = $("#left-btn");
    var container = $("#StoryCont2");
    var slideCont = $("#story-slider2");
    if($("#story-slider2 > div").length<5){
      $('#right-btn').hide();
      $('#left-btn').hide();
    }
    var maxcount=$("#story-slider2 > div").length;
    var marLeft = 0, maxX = maxcount*210, diff = 0 ;
    
    function slide() {
    marLeft-=219;
    if( marLeft < -maxX ){ 
      marLeft = -maxX+183 ;
    }
      slideCont.animate({"margin-left" : marLeft + "px"}, 500);
    }
    
    function slideBack() {
      marLeft +=219;
      if ( marLeft > 0 ) { marLeft = 0 ;}
      slideCont.animate({"margin-left" : marLeft + "px"}, 500);
    }
    rightButton.click(slide);
    leftButton.click(slideBack);
    
    /*touch code from here*/
    
    $(container).on("mousedown touchstart", function(e) {
      
      var startX = e.pageX || e.originalEvent.touches[0].pageX;
      diff = 0;
    
      $(container).on("mousemove touchmove", function(e) {
        
          var xt = e.pageX || e.originalEvent.touches[0].pageX;
          diff = (xt - startX) * 100 / window.innerWidth;
        if( marLeft == 0 && diff > 10 ) { 
          event.preventDefault() ;
        } else if (  marLeft == -maxX && diff < -10 ) {
           event.preventDefault();   
        }
      });
    });
    
    $(container).on("mouseup touchend", function(e) {
      $(container).off("mousemove touchmove");
      if(  marLeft == 0 && diff > 4 ) { 
          sliderCont.animate({"margin-left" :  0 + "px"},100);
       } else if (  marLeft == -maxX  && diff < 4 ){
           sliderCont.animate({"margin-left" : -maxX  + "px"},100);  
       } else {
          if (diff < -10) {
            slide();
          } else if (diff > 10) {
            slideBack();
          } 
      }
    });

</script>
<!-- End stories -->

<!-- reading stories1 -->
<script>
    var rightButton2s = $("#right-btn2s");
    var leftButton2s = $("#left-btn2s");
    var container2s = $("#StoryCont2s");
    var slideCont2s = $("#story-slider2s");
    if($("#story-slider2s > div").length<5){
      $('#right-btn2s').hide();
      $('#left-btn2s').hide();
    }
    var maxcount2s=$("#story-slider2s > div").length;
    var marLeft2s = 0, maxX2s = maxcount*210, diff2s = 0 ;
    
    function slide2s() {
    marLeft2s-=219;
    if( marLeft2s < -maxX2s ){ 
      marLeft2s = -maxX2s+183 ;
    }
      slideCont2s.animate({"margin-left" : marLeft2s + "px"}, 500);
    }
    
    function slideBack2s() {
      marLeft2s +=219;
      if ( marLeft2s > 0 ) { marLeft2s = 0 ;}
      slideCont2s.animate({"margin-left" : marLeft2s + "px"}, 500);
    }
    rightButton2s.click(slide2s);
    leftButton2s.click(slideBack2s);
    
    /*touch code from here*/
    
    $(container2s).on("mousedown touchstart", function(e) {
      
      var startX2s = e.pageX || e.originalEvent.touches[0].pageX;
      diff2s = 0;
    
      $(container2s).on("mousemove touchmove", function(e) {
        
          var xt2s = e.pageX || e.originalEvent.touches[0].pageX;
          diff2s = (xt2s - startX2s) * 100 / window.innerWidth;
        if( marLeft2s == 0 && diff2s > 10 ) { 
          event.preventDefault() ;
        } else if (  marLeft2s == -maxX2s && diff2s < -10 ) {
           event.preventDefault();   
        }
      });
    });
    
    $(container2s).on("mouseup touchend", function(e) {
      $(container2s).off("mousemove touchmove");
      if(  marLeft2s == 0 && diff2s > 4 ) { 
          sliderCont2s.animate({"margin-left" :  0 + "px"},100);
       } else if (  marLeft2s == -maxX2s  && diff2s < 4 ){
           sliderCont2s.animate({"margin-left" : -maxX2s  + "px"},100);  
       } else {
          if (diff2s < -10) {
            slide2s();
          } else if (diff2s > 10) {
            slideBack2s();
          } 
      }
    });

</script>
<!-- end reading stories -->

<!-- Nano -->
<script>

var rightButtonn = $("#right-btnn");
var leftButtonn = $("#left-btnn");
var containern = $("#StoryContn");
var slideContn = $("#story-slidern");
if($("#story-slidern > div").length<4){
  $('#right-btnn').hide();
  $('#left-btnn').hide();
}
var maxcountn=$("#story-slidern > div").length;
var marLeftn = 0, maxXn = maxcountn*267, diffn = 0 ;

function sliden() {
marLeftn-=284;
if( marLeftn < -maxXn ){ 
  marLeftn = -maxXn+250 ;
}
  slideContn.animate({"margin-left" : marLeftn + "px"}, 500);
}

function slideBackn() {
  marLeftn +=284;
  if ( marLeftn > 0 ) { marLeftn = 0 ;}
  slideContn.animate({"margin-left" : marLeftn + "px"}, 500);
}
rightButtonn.click(sliden);
leftButtonn.click(slideBackn);

/*touch code from here*/

$(containern).on("mousedown touchstart", function(e) {
  
  var startXn = e.pageX || e.originalEvent.touches[0].pageX;
  diffn = 0;

  $(containern).on("mousemove touchmove", function(e) {
    
      var xtn = e.pageX || e.originalEvent.touches[0].pageX;
      diffn = (xtn - startXn) * 100 / window.innerWidth;
    if( marLeftn == 0 && diffn > 10 ) { 
      event.preventDefault() ;
    } else if (  marLeftn == -maxXn && diffn < -10 ) {
       event.preventDefault();   
    }
  });
});

$(containern).on("mouseup touchend", function(e) {
  $(containern).off("mousemove touchmove");
  if(  marLeftn == 0 && diffn > 4 ) { 
      sliderContn.animate({"margin-left" :  0 + "px"},100);
   } else if (  marLeftn == -maxXn  && diffn < 4 ){
       sliderContn.animate({"margin-left" : -maxXn  + "px"},100);  
   } else {
      if (diffn < -10) {
        sliden();
      } else if (diffn > 10) {
        slideBackn();
      } 
  }
});

</script>
<!-- END NANO STORIES -->

<!-- TOP Life Events-->
<script>

var rightButtonl = $("#right-btnl");
var leftButtonl = $("#left-btnl");
var containerl = $("#StoryContl");
var slideContl = $("#story-sliderl");
if($("#story-sliderl > div").length<3){
  $('#right-btnl').hide();
  $('#left-btnl').hide();
}
var maxcountl=$("#story-sliderl > div").length;
var marLeftl = 0, maxXl = maxcountl*267, diffl = 0 ;

function slidel() {
marLeftl-=284;
if( marLeftl < -maxXl ){ 
  marLeftl = -maxXl+250 ;
}
  slideContl.animate({"margin-left" : marLeftl + "px"}, 500);
}

function slideBackl() {
  marLeftl +=284;
  if ( marLeftl > 0 ) { marLeftl = 0 ;}
  slideContl.animate({"margin-left" : marLeftl + "px"}, 500);
}
rightButtonl.click(slidel);
leftButtonl.click(slideBackl);

/*touch code from here*/

$(containerl).on("mousedown touchstart", function(e) {
  
  var startXl = e.pageX || e.originalEvent.touches[0].pageX;
  diffl = 0;

  $(containerl).on("mousemove touchmove", function(e) {
    
      var xtl = e.pageX || e.originalEvent.touches[0].pageX;
      diffl = (xtl - startXl) * 100 / window.innerWidth;
    if( marLeftl == 0 && diffl > 10 ) { 
      event.preventDefault() ;
    } else if (  marLeftl == -maxXl && diffl < -10 ) {
       event.preventDefault();   
    }
  });
});

$(containerl).on("mouseup touchend", function(e) {
  $(containerl).off("mousemove touchmove");
  if(  marLeftl == 0 && diffl > 4 ) { 
      sliderContl.animate({"margin-left" :  0 + "px"},100);
   } else if (  marLeftl == -maxXl  && diffl < 4 ){
       sliderContl.animate({"margin-left" : -maxXl  + "px"},100);  
   } else {
      if (diffl < -10) {
        slidel();
      } else if (diffl > 10) {
        slideBackl();
      } 
  }
});

</script>
<!-- //  Life Events-->

<!-- reading Life Events-->
<script>

var rightButtonls = $("#right-btnls");
var leftButtonls = $("#left-btnls");
var containerls = $("#StoryContls");
var slideContls = $("#story-sliderls");
if($("#story-sliderls > div").length<3){
  $('#right-btnls').hide();
  $('#left-btnls').hide();
}
var maxcountls=$("#story-sliderls > div").length;
var marLeftls = 0, maxXls = maxcountls*267, diffls = 0 ;

function slidels() {
marLeftls-=284;
if( marLeftls < -maxXls ){ 
  marLeftls = -maxXls+250 ;
}
  slideContls.animate({"margin-left" : marLeftls + "px"}, 500);
}

function slideBackls() {
  marLeftls +=284;
  if ( marLeftls > 0 ) { marLeftls = 0 ;}
  slideContls.animate({"margin-left" : marLeftls + "px"}, 500);
}
rightButtonls.click(slidels);
leftButtonls.click(slideBackls);

/*touch code from here*/

$(containerls).on("mousedown touchstart", function(e) {
  
  var startXls = e.pageX || e.originalEvent.touches[0].pageX;
  diffls = 0;

  $(containerls).on("mousemove touchmove", function(e) {
    
      var xtls = e.pageX || e.originalEvent.touches[0].pageX;
      diffls = (xtls - startXls) * 100 / window.innerWidth;
    if( marLeftls == 0 && diffls > 10 ) { 
      event.preventDefault() ;
    } else if (  marLeftls == -maxXls && diffls < -10 ) {
       event.preventDefault();   
    }
  });
});

$(containerls).on("mouseup touchend", function(e) {
  $(containerls).off("mousemove touchmove");
  if(  marLeftls == 0 && diffls > 4 ) { 
      sliderContls.animate({"margin-left" :  0 + "px"},100);
   } else if (  marLeftls == -maxXls  && diffls < 4 ){
       sliderContls.animate({"margin-left" : -maxXls  + "px"},100);  
   } else {
      if (diffls < -10) {
        slidels();
      } else if (diffls > 10) {
        slideBackls();
      } 
  }
});

</script>
<!-- // Top Life Events-->

<script type="text/javascript">
function genericSocialShare(url){
    window.open(url,'sharer','toolbar=0,status=0,width=648,height=395');
    return true;
}
function copylinkshare(element) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(element).val()).select();
    document.execCommand("copy");
    $temp.remove();
}
</script>


<script>
    $(document).ready(function(){
        var ferslimit = 5;
        var fersstart = 5;
        var fersaction = 'inactive';
        var userid = "<?php echo $_GET['id'];?>";
        function fersload_country_data(ferslimit, fersstart) {
            $.ajax({
                url:'<?php echo base_url();?>index.php/welcome/fersloadmore',
                method:"POST",
                data:{limit:ferslimit, start:fersstart, user_id: userid},
                cache:false,
                success:function(data){
                    $('#fersloadmore').append(data);
                    if(data == '') {
                        $('#fersload_data_message').html("<center><div class='col-md-12' style='padding-top:20px;'> No More Results!</div></center>");
                        fersaction = 'active';
                    }else{
                        $('#fersload_data_message').html("<center><div class='col-md-12' style='padding-top:20px;'> Loading ...</div></center>");
                        fersaction = "inactive";
                    }
                }
            });
        }
        if(fersaction == 'inactive') {
            fersaction = 'active';
            fersload_country_data(ferslimit, fersstart);
        }
        $(".modal-bodyv").scroll(function() {
        //$(window).scroll(function(){
            if($(".modal-bodyv").scrollTop() + $(".modal-bodyv").height() > $("#fersloadmore").height() && fersaction == 'inactive'){
                fersaction = 'active';
                fersstart = fersstart + ferslimit;
                setTimeout(function(){ fersload_country_data(ferslimit, fersstart); }, 100);
            }
        });
    });
</script>

<script>
    $(document).ready(function(){
        var finglimit = 5;
        var fingstart = 5;
        var fingaction = 'inactive';
        var userid = "<?php echo $_GET['id'];?>";
        function fingload_country_data(finglimit, fingstart) {
            $.ajax({
                url:'<?php echo base_url();?>index.php/welcome/fingloadmore',
                method:"POST",
                data:{limit:finglimit, start:fingstart, user_id: userid},
                cache:false,
                success:function(data){
                    $('#fingloadmore').append(data);
                    if(data == '') {
                        $('#fingload_data_message').html("<center><div class='col-md-12' style='padding-top:20px;'> No More Results!</div></center>");
                        fingaction = 'active';
                    }else{
                        $('#fingload_data_message').html("<center><div class='col-md-12' style='padding-top:20px;'> Loading ...</div></center>");
                        fingaction = "inactive";
                    }
                }
            });
        }
        if(fingaction == 'inactive') {
            fingaction = 'active';
            fingload_country_data(finglimit, fingstart);
        }
        $(".modal-bodyv").scroll(function() {
        //$(window).scroll(function(){
            if($(".modal-bodyv").scrollTop() + $(".modal-bodyv").height() > $("#fingloadmore").height() && fingaction == 'inactive'){
                fingaction = 'active';
                fingstart = fingstart + finglimit;
                setTimeout(function(){ fingload_country_data(finglimit, fingstart); }, 100);
           }
        });
    });
</script>