<link rel="stylesheet" href="<?php echo base_url();?>assets/css/viewallhome.css">
    <div class="main-container-2">
	    <div class="row pt-0">
		    <div class="col-md-12 col-xs-12 pd-0">
		    	<div class="titlei">NANO STORY</div>
		    </div>
		</div><hr>
		<div>
	        <div style="display:flex;flex-wrap:wrap;" class="jsw">
		        <?php foreach($nano_view->result() as $nanorow) { ?>
        			<div class="nano-stories" style="margin: auto 35%;">
						<div>
							<?php if(isset($nanorow->profile_image) && !empty($nanorow->profile_image)) { ?>
								<img src="<?php echo base_url();?>assets/images/<?php echo $nanorow->profile_image; ?>" class="circle-image" style="height:50px;" alt="<?php echo $nanorow->name;?>">
							<?php }else{ ?>
								<img src="<?php echo base_url();?>assets/dist/img/photo1.png" class="circle-image" style="height:50px;" alt="<?php echo $nanorow->name;?>">
							<?php } ?>
							<h3 class="name-nanostories">
							    <a href="<?php echo base_url($nanorow->profile_name);?>" style="color:#000"><?php echo $nanorow->name;?></a>
							    <span style="float:right;">
			                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			                            <i class="fa fa-ellipsis-v" style="font-size:14px;"></i>
			                        </a>
			                        <ul class="dropdown-menu" style="top:50px; float:right; left: 127px;">
			                            <li><a href="javascript:void(0);" onClick=""><i class="fa fa-exclamation-triangle"></i> Report</a></li>
			                        </ul>
			                    </span>
							</h3>
						</div>
						<div>
							<hr style="width:100%; margin-top:12px;">
							<a href="javascript:void(0);" style="color:#000" data-toggle="modal" data-target="#modal-default<?php echo $nanorow->sid;?>">
							    <font class="text-in-nanostory" id="sharescreen<?php echo $nanorow->sid;?>" onclick="nanoviewsadd(<?php echo $nanorow->sid;?>);"><?php echo $nanorow->story; ?></font>
							</a>
						</div>
						<div class="lastdiv">
							<hr style="width:100%;">
							<font style="color:#777" onclick="nanolike(<?php echo $nanorow->sid;?>);">
							    <b class="nanolike<?php echo $nanorow->sid;?>">
							        <span class="nanolikecount<?php echo $nanorow->sid;?>"><?php echo $nanorow->nanolikecount;?></span>
							    </b> 
							    <a href="javascript:void(0);" <?php if(isset($nanolikes) && in_array($nanorow->sid,$nanolikes)){ }else{ echo 'style="color:#777"'; } ?>>
							    <i class="fa fa-heart-o" aria-hidden="true"></i></a>
							</font>
							<div style="float:right;color:#777">
								<a href="javascript:void(0);" class="dropdown-toggle text-muted" data-toggle="dropdown">
									<i class="fa fa-share-alt" aria-hidden="true"></i>
								</a>
								<ul class="dropdown-menu list-inline dropvknano">
									<li onclick="groupsuggest(<?php echo $nanorow->sid; ?>);">
										<a href="javascript:void(0);" data-toggle="modal" data-target="#groupsuggest"><i class="fa fa-users"></i></a>
									</li>
									<li onclick="friend(<?php echo $nanorow->sid;?>);">
										<a href="javascript:void(0);" data-toggle="modal" data-target="#friendsuggest"><i class="fa fa-user"></i></a>
									</li>
									<li onclick="socialshare(<?php echo $nanorow->sid;?>, 'nano');">
										<a data-toggle="modal" data-target="#soc" href="javascript:void(0);" title="SOCIAL"><i class="fa fa-share-alt"></i></a>
									</li>
								</ul>
							</div>
							<font style="float:right;color:#777">
							    <i class="fa fa-eye" aria-hidden="true"></i>
							    <b><span class="nanoviewcount<?php echo $nanorow->sid;?>"><?php echo $nanorow->views; ?></span></b>&nbsp;&nbsp;
							</font>
						</div>
					</div>
        		<?php } ?>
	        </div>
	        <?php if(isset($nano_view) && ($nano_view->num_rows() > 0)){ foreach($nano_view->result() as $nanomodalrow) { ?>
    		<div class="modal fade" id="modal-default<?php echo $nanomodalrow->sid;?>">
    			<div class="modal-dialog">
    				<div class="modal-content">
    					<div class="modal-header">
    						<div class="">
    						    <?php if(isset($nanomodalrow->profile_image) && !empty($nanomodalrow->profile_image)) { ?>
    								<img src="<?php echo base_url();?>assets/images/<?php echo $nanomodalrow->profile_image; ?>" class="user-image img-circle" style="height:50px;" alt="<?php echo $nanomodalrow->name;?>">
    							<?php }else{ ?>
    								<img src="<?php echo base_url();?>assets/dist/img/user2-160x160.jpg" class="user-image img-circle" style="height:50px;" alt="<?php echo $nanomodalrow->name;?>">
    							<?php } ?>
    							<h3 class="name-nanostories" style="margin-top: -40px; margin-left: 50px;">
    							    <a href="<?php echo base_url($nanomodalrow->profile_name);?>" style="color:#000"><?php echo $nanomodalrow->name;?></a>
    			                    <span class="pull-right">
    			                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:4px;">
                                	        <span aria-hidden="true">&times;</span>
                                        </button>
    			                    </span>
    			                </h3>
    						</div>
    					</div>
    					<div class="modal-body modal-bodyv" style="overflow-y:scroll;">
    						<font class="text-in-nanostory-p" style="border-left:none; overflow-y:scroll;"><?php echo $nanomodalrow->story; ?></font>
    					</div>
    					<div class="modal-footer">
    						<ul class="list-inline">
    							<li class="text-muted pull-left" onclick="nanolike(<?php echo $nanomodalrow->sid;?>);">
    							    <b class="nanolike<?php echo $nanomodalrow->sid;?>">
    							        <span class="nanolikecount<?php echo $nanomodalrow->sid;?>"><?php echo $nanomodalrow->nanolikecount;?></span>
    							    </b>
    							    <a href="javascript:void(0);" <?php if(isset($nanolikes) && in_array($nanorow->sid,$nanolikes)){ }else{ echo 'style="color:#777"'; } ?>>
    							    <i class="fa fa-heart-o" aria-hidden="true"></i></a>
    							</li>
    							<li class="pull-right">
                                	<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-share-alt"></i></a>
                                    <ul class="dropdown-menu list-inline dropvknano1">
                                        <li onclick="groupsuggest(<?php echo $nanomodalrow->sid; ?>);">
    									    <a href="javascript:void(0);" data-toggle="modal" data-target="#groupsuggest"><i class="fa fa-users"></i></a>
    									</li>
    									<li onclick="friend(<?php echo $nanomodalrow->sid;?>);">
    										<a href="javascript:void(0);" data-toggle="modal" data-target="#friendsuggest"><i class="fa fa-user"></i></a>
    									</li>
    									<li onclick="socialshare(<?php echo $nanomodalrow->sid;?>, 'nano');">
											<a data-toggle="modal" data-target="#soc" href="javascript:void(0);" title="SOCIAL"><i class="fa fa-share-alt"></i></a>
										</li>
                                    </ul>
                                </li>
    						</ul>
    					</div>
    				</div> <!-- /.modal-content -->
    			</div> <!-- /.modal-dialog -->
            </div> <!-- /.modal -->
        <?php } } ?><!-- // NANO STORIES end-->
        </div>
    </div>

<script>
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