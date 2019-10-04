	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/editmy_profile.css">
    <script src="<?php echo base_url();?>assets/dist/js/js/jquery.Jcrop.min.js"></script>
    
<?php $writerlanguage = ''; if(isset($editprofile) && ($editprofile->num_rows()>0)){ foreach($editprofile->result() as $row){ 
        $writerlanguage = $row->writer_language; ?>
    <div class="wrapper">
        <div class="" style="padding:0px;">
       	    <form action="<?php echo base_url();?>welcome/updateprofile/<?php echo $row->user_id;?>" method="POST" enctype="multipart/form-data" id="updateform">
                <section class="content"> 
    		        <div class="row">
    			        <div class="col-md-12">
    			            <div class="box box-widget widget-user-2">
    				            <?php if(isset($row->banner_image) && !empty($row->banner_image)) { ?>
    					        <div class="widget-user-header" style="padding:0; background: url('<?php echo base_url();?>assets/images/<?php echo $row->banner_image; ?>') center center; background-repeat: no-repeat; background-size: auto;  background-size: cover;" id="blah">
        							<div style="height:250px; background-color:rgba(0, 0, 0, 0.55); background-repeat: no-repeat;background-size: cover; padding: 60px 30px;">
            							<div class="widget-user-image" style="float:left;">
                							<?php if(isset($row->profile_image) && !empty($row->profile_image)) { ?>
                							<label class="" style="background:none; color:#fff;" for="upload-file-profile">
            									<img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $row->profile_image; ?>" style="width:75px;height:75px;" alt="<?php echo $row->name; ?>">
            								    <input id="upload-file-profile" name="profile_image" type="file">
            								    <span style="padding:8px; border:1px solid #ddd; cursor:pointer;float:right;margin-top:17px;margin-left:12px;" class="btnspinner"><i class="fa fa-image"></i> Profile Photo</span>
            								</label>
                							<?php } else { ?>
            							    <label class="" style="background:none;color:#fff;" for="upload-file-profile">
                                                <img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" style="width:75px;height:75px;" alt="<?php echo $row->name; ?>">
                                                <input id="upload-file-profile" name="profile_image" type="file">
                                                <span style="padding:10px; border:1px solid #ddd; cursor:pointer;float:right;margin-top:17px;margin-left:12px;" class="btnspinner"><i class="fa fa-image"></i> Profile Photo</span>
                                            </label>
                                            <?php } ?>
                                            <div class="clearfix"></div>
                                            <label class="pull-left" style="padding-left:5%;">
                                                <a href="<?php echo base_url();?>welcome/removeprofilepic/<?php echo $row->user_id;?>" class="btn btn-default">Remove</a>
                                            </label>
                                        </div>
                                        
                                        <label class="" style="background:none!important; color:#fff; float:right; margin-top: 35px;" for="upload-file-selector">
            								<input id="upload-file-selector" name="banner_image" type="file">
            								<span style="padding:10px; border:1px solid #ddd; cursor:pointer;" class="btnspinnerc"><i class="fa fa-image"></i> Cover Photo</span> 
            							</label>
            							<label class="pull-right" style="margin: -15px -100px 0px 0px;">
            							    <a href="<?php echo base_url();?>welcome/removeprofilecover/<?php echo $row->user_id;?>" class="btn btn-default">Remove</a>
            							</label>
        					        </div>
    					        </div>
    					        <?php } else{ ?>
    					        <div class="widget-user-header" style="padding:0; background: linear-gradient(-60deg,RoyalBlue,brown); background-repeat: no-repeat; background-size: auto;  background-size: cover;" id="blah">
                                    <div style="height:250px; background-color:rgba(0, 0, 0, 0.55); background-repeat: no-repeat;background-size: cover; padding: 60px 30px;">
            							<div class="widget-user-image" style="float:left;">
                							<?php if(isset($row->profile_image) && !empty($row->profile_image)) { ?>
                							<label class="" style="background:none; color:#fff;" for="upload-file-profile">
            									<img class="img-circle" src="<?php echo base_url();?>assets/images/<?php echo $row->profile_image; ?>" style="width:75px;height:75px;" alt="<?php echo $row->name; ?>">
            								    <input id="upload-file-profile" name="profile_image" type="file">
            								    <span style="padding:10px; border:1px solid #ddd; cursor:pointer;float:right;margin-top:17px;margin-left:12px;" class="btnspinner"><i class="fa fa-image"></i> Profile Photo</span>
            								</label>
                							<?php } else { ?>
            							    <label class="" style="background:none; color:#fff;" for="upload-file-profile">
                                                <img class="img-circle" src="<?php echo base_url();?>assets/images/2.png" style="width:75px;height:75px;" alt="<?php echo $row->name; ?>">
                                                <input id="upload-file-profile" name="profile_image" type="file">
                                                <span style="padding:10px; border:1px solid #ddd; cursor:pointer;float:right;margin-top:17px;margin-left:12px;" class="btnspinner"><i class="fa fa-image"></i> Profile Photo</span>
                                            </label>
                                            <?php } ?>
                                            <label class="pull-left" style="padding-left:5%;">
                                                <a href="<?php echo base_url();?>welcome/removeprofilepic/<?php echo $row->user_id;?>" class="btn btn-default">Remove</a>
                                            </label>
                                        </div>
                                        <label class="" style="background:none!important; color:#fff; float:right; margin-top: 35px;" for="upload-file-selector">
            								<input id="upload-file-selector" name="banner_image" type="file">
            								<span style="padding:10px; border:1px solid #ddd; cursor:pointer;" class="btnspinnerc"><i class="fa fa-image"></i> Cover Photo</span> 
            							</label>
            							<label class="pull-right" style="margin: -15px -100px 0px 0px;">
            							    <a href="<?php echo base_url();?>welcome/removeprofilecover/<?php echo $row->user_id;?>" class="btn btn-default">Remove</a></label>
        					        </div>
    					        </div>
    					        <?php } ?>
    				        </div>
            				<div class="box-footer">
            					<div class="row">
            					    <div class="col-sm-10 col-xs-10 col-md-10">
            					        <center><?php echo $this->session->flashdata('editmsg');?></center>
            					        </div>
            						<div class="col-sm-2 col-xs-2 col-md-2">
            							<div class="description-block" style="float:right">
            							    <button type='submit' name='edit' class='btn btn-primary'> Update profile </button>
            							</div>
            						</div>
                                </div>
                            </div>
    				    </div>
    			    </div><br>
    	        </section>
    	        
    	    <section class="content pd">
                <div class="" style="display:flex;flex-wrap:wrap; padding:0">
    			    <div class="side1">
			            <div class="box box-widget widget-user vjc">
					        <h4> About </h4>
        					<div class="box-body" style="padding:0px;">
        						<textarea id="editor1" name="aboutus" class="form-control" rows="10" cols="35" required placeholder="Write My Self..." style="resize:none"> <?php echo $row->aboutus; ?> </textarea>
        					</div>
				        </div> <br>
                    </div>
    		        <div class="side2">
    		            <div class=""  style="display:flex;flex-wrap:wrap; padding:0">
    			            <div class="box1">
                			    <div class="box box-widget widget-user vjc">
                    				<h4><b>General Information</b></h4>
                					<div class="" style="border-top:1px solid #ddd; padding-top:10px; display:flex;flex-wrap:wrap;">
                						<div class="form1v"> <b>Name</b> </div>
                                        <div class="form1v form-horizontal" style="padding-bottom:5px;">
                                            <input type="text" class="form-control" name="name" required="" value="<?php echo $row->name; ?>">
                					    </div> 
                                        <!--<div class="form1v"> <b>Last Name</b></div>
                                        <div class="form1v form-horizontal" style="padding-bottom:5px;">
                                            <input type="text" class="form-control" name="lastname" value="<?php echo $row->lastname; ?>">
                					    </div> -->
                					    <div class="form1v"> <b>Gender</b></div>
                                        <div class="form1v form-horizontal" style="padding-bottom:5px;">
                                            <select class="form-control" name="gender" required="">
                                                <option value="male" <?php if($row->gender == 'male'){echo 'selected';} ?>>Male</option>
                                                <option value="female" <?php if($row->gender == 'female'){echo 'selected';} ?>>Female</option>
                                            </select>
                					    </div> 
                					    <div class="form1v"> <b>Birth Date</b></div>
                                        <div class="form1v form-horizontal" style="padding-bottom:5px;">
                                            <input type="date" class="form-control" name="dob" value="<?php echo $row->dob; ?>">
                					    </div>
                				    </div>
                			    </div>
    			            </div>
            	            <div class="box2">
            	                <div class="box box-widget widget-user vjc">
                				    <h4> <b> Contact </b> </h4>
                					<div class="" style="border-top:1px solid #ddd; padding:10px 0px; display:flex;flex-wrap:wrap;">
                					    <div class="userv">
                					        <i class="fa fa-user" aria-hidden="true"></i>
                					    </div>
                						<div class="inputv">
                                            <input type="text" class="form-control" value="<?php echo $row->profile_name; ?>" name="username" <?php if($row->pfnamestatus != 'updated'){ ?>id="username" <?php }else{ ?> readonly <?php } ?>>
                                            <span class="text-danger username"></span>
                    					</div>
                    					<div class="upadtev">
                    					    <?php if($row->pfnamestatus == 'updated'){ ?>
                    					    <span class="btn" style="color:#605ca8;"><u> Updated </u></span>
                    					    <?php }else{ ?>
                    					    <span class="profile_name btn" style="color:#3c8dbc;"><u> Update </u></span>
                    					    <span data-toggle="modal" data-target="#que"><i class="fa fa-question-circle"></i></span>
                    					    <?php } ?>
                    					</div>
                    				</div>
                    				<div class="" style=" display:flex;flex-wrap:wrap;">
                						<div class="userv"> <i class="fa fa-envelope" aria-hidden="true"></i> </div>
                                        <?php if($row->user_activation == 1){ ?>
                    					    <div class="inputv">
                    						    <input type="email" class="form-control" value="<?php echo $row->email; ?>" name="email">
                    						    <span class="btn pull-right" style="color:#605ca8;"><u> Verified </u></span>
                        					</div>
                						<?php } else{ ?>
                    						<div class="inputv">
                                                <input type="email" class="form-control" value="<?php echo $row->email; ?>" name="email" id="useremail">
                                                <span class="profile_email btn pull-right" style="color:#3c8dbc;"><u> Not Verified </u></span>
                        				    </div>
                                        <?php } ?>
                    					<div class="upadtev" style="padding:3px;">
                    					    <label class="switch">  
                						        <input type="checkbox" onclick="useremailstatus(this.value)" id="uemailstatus" name="uemailstatus" value="<?php echo $row->uemailstatus;?>" <?php if($row->uemailstatus == 'public'){ echo 'checked'; }?>> 
                						        <span class="slider"> </span> 
                						    </label> &nbsp; <span class="uemailstatus"> <?php echo ucfirst($row->uemailstatus);?> </span>
                    					</div>
                    				</div>
                    				<div class="" style="display:flex;flex-wrap:wrap;">
                						<div class="userv">
                    						<i class="fa fa-phone" aria-hidden="true"></i>
                    					</div>
                						<div class="inputv">
                                            <input type="number" class="form-control" value="<?php echo $row->phone; ?>" name="phone" maxlength="10" onkeypress="return NumbersOnly(this,event)">
                    					</div>
                    					<div class="upadtev" style="padding:3px;">
                    					    <label class="switch">  
                						        <input type="checkbox" onclick="userphonestatus(this.value)" id="uphonestatus" name="uphonestatus" value="<?php echo $row->uphonestatus;?>" <?php if($row->uphonestatus == 'public'){ echo 'checked'; }?>> 
                						        <span class="slider"> </span> 
                						    </label> &nbsp; <span class="uphonestatus"> <?php echo ucfirst($row->uphonestatus);?> </span>
                    				    </div>
                    				</div>
            			        </div>
            	            </div>
            	            </form>
            	            <?php $selectedlang = get_langshortname($this->uri->segment(1)); ?>
                            <div class="box3" style="margin-top: 15px;">
                			    <div class="box box-widget widget-user vjc">
                				    <h4><b> Preferred Genres </b>
                				    <span class="pull-right">
                				        <a href="" data-toggle="modal" data-target="#choosecommunitypedit" style="color:#333;"><i class="fa fa-pencil"></i></a>
                				    </span></h4>
                				    <div class="" style="border-top:1px solid #ddd; padding-top:10px; display:flex; flex-wrap:wrap; justify-content:center;">
                    				    <?php if(isset($geners) && ($geners->num_rows() > 0)){ foreach($geners->result() as $gener) { 
                    				        if(isset($usercomms) && in_array($gener->gener, $usercomms)){ ?>
                    				        <a class="community-btn-selected removegenre<?php echo $gener->gener; ?>" onclick="removegenre('<?php echo $gener->gener; ?>', '<?php echo $selectedlang;?>')">
                                                <?php echo $gener->gener; ?> <span class="pull-right" title="Delete"> X </span>
                                            </a>
                                        <?php } } } ?>
                                    </div>
        			            </div>
            			    </div>
            			    
                            <div class="box3" style="margin-top: 15px;">
                			    <div class="box box-widget widget-user vjc">
                				    <h4><b> Preferred Language </b> 
                				    <span class="pull-right">
                				        <a href="" data-toggle="modal" data-target="#chooselanguagepedit" style="color:#333;"><i class="fa fa-pencil"></i></a>
                				    </span></h4>
                				    <div class="" style="border-top:1px solid #ddd; padding-top:10px; display:flex; flex-wrap:wrap; justify-content:center;">
                    				    <?php if(isset($languages) && ($languages->num_rows() > 0)){ foreach($languages->result() as $language) { 
                    				        if(isset($row->writer_language) && ($language->code == $row->writer_language)){ ?>
                    				        <a class="community-btn-selected"><?php echo $language->language; ?></a>
                                        <?php } } } ?>
                                    </div>
        			            </div>
            			    </div>
            			    
            	        </div>
            	        <div class="box3">
            	            <div class="" style="margin-top:15px; margin-bottom:15px;">
    			                <div class="box box-widget widget-user vjc">
    				                <h4><b>Change Password</b></h4><hr>
            				        <span class="cpwderror"><?php echo $this->session->flashdata('msg'); ?></span>
            						<div id="changepassword">
            							<div class="box-body form-horizontal">
            								<div class="form-group form-horizontal">
            									<label for="" class="col-sm-3 control-label">Current Password :</label>
            									<div class="col-sm-9">
            									    <input type="password" class="form-control" name="oldpassword" id="oldpassword" placeholder="Current Password">
            									    <span class="text-danger oldpassword"><?php echo form_error('oldpassword'); ?></span>
            									</div>
            								</div>
            								<div class="form-group">
            									<label for="" class="col-sm-3 control-label">New Password :</label>
            									<div class="col-sm-9">
                									<input type="password" class="form-control" name="password" id="password" placeholder="New Password">
                									<span class="text-danger password"><?php echo form_error('password'); ?></span>
            									</div>
            								</div>
            								<div class="form-group">
            									<label for="" class="col-sm-3 control-label">Confirm Password :</label>
            									<div class="col-sm-9">
                									<input type="password" class="form-control" name="repassword" id="repassword" placeholder="Confirm Password">
                									<span class="text-danger repassword"><?php echo form_error('repassword'); ?></span>
            									</div>
            								</div>
            								<div class="">
            									<div class="col-md-12">
            										<center>
            											<div class="form-group">
            	 										    <input onclick="changepassword()" class="btn btn-primary" value="Change Password"/>
            											</div>
            										</center>
            									</div>
            								</div>
            							</div>
            						</div>
            						<br>
    					        </div>
                            </div>
            	        </div>
            	    </div>
                </div>
            </section>
        </div>           
    </div>
    
    <input type="hidden" id="cslangp" value="<?php echo $selectedlang;?>">
    <input type="hidden" id="useridp" value="<?php echo $row->user_id;?>">
<?php } } ?>


<div id="emailverify" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <center><h4>Verification Code Sent to your registered Email. <br>Check Your Inbox and Verify.</h4></center>
            </div>
        </div>
    </div>
</div>

<div id="que" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <center><h4>You Can Change your Username Only Once.</h4></center>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="choosecommunitypedit">
    <div class="modal-dialog modalv">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="h5titile">PREFERRED GENRES
                <span class="pull-right"><button type="button" class="close" data-dismiss="modal">&times;</button></span>
                </h5>
            </div>
            <div class="modal-body">
                <div class="row" style="padding: 0px;">
                    <center>
                        <form id="choosecommupedit" method="POST">
                            <div  style="height:250px; overflow-y:scroll">
                            <?php if(isset($geners) && ($geners->num_rows() > 0)){ foreach($geners->result() as $gener) { ?>
                                <div class="col-md-4">
                                    <?php if(in_array($gener->gener, $usercomms)){ ?>
            				        <label class="btn btn-primary btn-block choosecomm" style="padding: 10px 5px 10px 0px; font-size:17px;margin-bottom:5px;" id="<?php echo $gener->id;?>">
                                        <input type="checkbox" class="checkbox<?php echo $gener->id;?>" name="choosecomm[]" value="<?php echo $gener->id;?>" style="height:1px;" checked="checked"><?php echo $gener->gener; ?>
                                    </label>
                                    <?php } else{ ?>
                                    <label class="btn btn-default btn-block choosecomm" style="padding: 10px 5px 10px 0px; font-size:17px;margin-bottom:5px;" id="<?php echo $gener->id;?>">
                                        <input type="checkbox" class="checkbox<?php echo $gener->id;?>" name="choosecomm[]" value="<?php echo $gener->id;?>" style="height:1px;"><?php echo $gener->gener; ?>
                                    </label>
                                    <?php } ?>
            				    </div>
        				    <?php } } ?>
        				    </div>
        				    <div class="col-xs-12"><br>
        				        <button type="submit" class="btn btn-primary choosecommsave"> Save </button>
        				    </div>
				        </form>
				    </center>
				</div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="chooselanguagepedit">
	<div class="modal-dialog modalv">
		<div class="modal-content">
		    <div class="modal-header">
                <h5 class="h5titile">PREFERRED LANGUAGE
                <span class="pull-right"><button type="button" class="close" data-dismiss="modal">&times;</button></span>
                </h5>
            </div>
			<div class="modal-body">
			    <div class="row" style="padding: 0px;">
			        <center>
        			    <form id="chooselangpedit" action="#" method="POST">
        				    <div style="height:250px; overflow-y:scroll">
    					        <?php if(isset($languages) && ($languages->num_rows() >0)) { foreach ($languages->result() as $language) { ?>
    								<div class="col-md-4">
        								<a href="javascript:void(0);" class="btn btn-default btn-block community-btn langbtn <?php echo $language->code;?>" onclick="chooselangpbtn('<?php echo $language->code;?>')" 
        								    style="<?php if($writerlanguage == $language->code){ echo 'background:#3c8dbc; color:#FFF;'; } else { echo 'background: #fff;'; } ?>padding: 5px;margin-bottom:5px;border: 1px solid #adadad;width: 100%;">
        								    <?php echo $language->language; ?>
        								</a>
    								</div>
        						<?php } } ?>
        						<input type="hidden" id="plang" value="<?php echo $writerlanguage;?>">
            				</div>
            				<div class="col-xs-12"><br>
            				        <!--<button type="submit" class="btn-next chooselangsave"> SAVE </button>
            				        <a href="javascript:void(0);" class="btn-next chooselanguagebtn btnlangspin" style="color:#bcb2b2; background:#eee;">SAVE</a>-->
                				<button type="submit" class="btn btn-primary chooselangsave"> Save </button>
            				</div>
            			</form>
            		</center>
        		</div>
			</div>
		</div>
	</div>
</div>
<!--<script src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script> -->


<div id="upload_profileimg" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Upload Profile Image (You Can Crop)</h4>
            </div>
            <div class="modal-body" id="cropboxmodaldiv"> </div>
            <div class="modal-footer"> </div>
        </div>
    </div>
</div>

<script>
    function useremailstatus(uemailstatus) {
        if(uemailstatus == 'private'){
            $('#uemailstatus').attr('checked','true');
            $('#uemailstatus').val('public');
            $('span.uemailstatus').text('Public');
        }else{
            $('#uemailstatus').attr('checked', false);
            $('#uemailstatus').val('private');
            $('span.uemailstatus').text('Private');
        }
    }
    
    function userphonestatus(uphonestatus) {
        if(uphonestatus == 'private'){
            $('#uphonestatus').attr('checked','true');
            $('#uphonestatus').val('public');
            $('span.uphonestatus').text('Public');
        }else{
            $('#uphonestatus').attr('checked', false);
            $('#uphonestatus').val('private');
            $('span.uphonestatus').text('Private');
        }
    }
    
    $("#username").keyup(function() {
        var username = $(this).val();
        $.ajax({
    		url: "<?php echo base_url();?>welcome/username",
    		type: 'POST',
    		data: {'username': username},
    		success: function (resultdata) {
    		    if(resultdata == 1){
    		         $('.username').text('Username available. Click on Update.');
    		    }else if(resultdata == 2){
    		         $('.username').text('The Username field is required.');
    		    }else if(resultdata == 3){
    		         $('.username').text('Username should be at least 5 characters.');
    		    }else if(resultdata == 4){
    		         $('.username').text('Username already taken. Choose another.');
    		    }
    		}
	    });
    });
    
     $("span.profile_name").on('click',function() {
        var username = $('#username').val();
        $.ajax({
    		url: "<?php echo base_url();?>welcome/updateusername",
    		type: 'POST',
    		data: {'username': username},
    		success: function (resultdata) {
    		    console.log(resultdata);
    		    if(resultdata == 1){
    		        $('.username').text('Updated Success!');
    		    }else if(resultdata == 2){
    		        $('.username').text('The Username field is not empty.');
    		    }else if(resultdata == 3){
    		        $('.username').text('Username already taken. Try with another.');
    		    }else if(resultdata == 4){
    		        $('.username').text('Failed to update Username.');
    		    }
    		}
	    });
    });
    
    $("span.profile_email").on('click',function() {
        var useremail = $('#useremail').val();
        $.ajax({
    		url: "<?php echo base_url();?>welcome/resendemail",
    		type: 'POST',
    		data: {'email': useremail},
    		dataType: 'json',
    		success: function (resultdata) {
    		    $('#emailverify').modal('show');
    		    console.log(resultdata);
    		}
	    });
    });

    function changepassword(){
        var oldpassword = $('#oldpassword').val();
        var password = $('#password').val();
        var repassword = $('#repassword').val();
        var profileid = "<?php echo $this->session->userdata['logged_in']['user_id'];?>";
        $('span.text-danger').html(' ');
        $.ajax({
            url: "<?php echo base_url();?>welcome/changepassword",
            type: "post",
            data: {'oldpassword': oldpassword, 'password': password, 'repassword': repassword },
            success: function(resultdata) {
                var result=JSON.parse(resultdata);
               if(result.status == -1){
					$.each(result.validations,function (p,q){
						$('span.'+p).text(q);
					});
				}else if((result.status == 1) && (result.response == 'success')){
					location.href = "<?php echo base_url();?>welcome/my_profile/"+profileid;
				}else if((result.status == 2) && (result.response == 'wrongoldpwd')){
					$('span.oldpassword').text('Please Enter Correct Old Password.');
				}else {
					$('span.cpwderror').text(' Password Change Request Failed. Try Again');
				}
            }
        });
    }
    
    function removegenre(genre, language){
        $('.deletemessage').html('Are You Sure? Do you want to delete.');
        $('#confirmdelpopup').modal().one('click', '#delconfirmed', function (e) {
            $.ajax({
    			url: "<?php echo base_url();?>welcome/unchoosecommu/bynamelang",
    			type: 'POST',
    			data: {'genre': genre, 'language':language},
    			success: function (resultdata) {
    			    if(resultdata){
    			        $('.removegenre'+genre).css('display','none');
    				    $('#snackbar').text('prefered gener deleted successfully.').addClass('show');
        		        setTimeout(function(){ $('#snackbar').removeClass('show'); }, 5000);
        		        
    			    }
    			}
    		});
        });
    }
    
    function chooselangpbtn(language){
        $('#plang').val(language);
        $('.langbtn').css('background','#fff');
    	$('.langbtn').css('color','#000');
        $('.'+language).css('background','#3c8dbc');
	    $('.'+language).css('color','#fff');
    }
	$( "form#chooselangpedit" ).submit(function( event ) {
		event.preventDefault();
		var planguage = $('#plang').val();
		var userid = $('#useridp').val();
		if(planguage){
			$.ajax({
				url: "<?php echo base_url();?>welcome/chooselanguage",
				type: 'POST',
				data: {'choselanguage': planguage, 'userid':userid },
				success: function (resultdata) {
				    if(resultdata){
    				    $('#snackbar').text('prefered Language updated successfully.').addClass('show');
        		        setTimeout(function(){ $('#snackbar').removeClass('show'); }, 5000);
        		        setTimeout(function(){ location.reload(); }, 1000);
				    }
				}
			});
		}
	});

    $( document ).ready(function() {
	    var commids = [];
		$('.choosecomm').on('click', function(){
		   var chosenid = $(this).attr('id');
			if($('.checkbox'+chosenid).prop('checked')){
				commids.push(chosenid);
				$(this).removeClass('btn-default').addClass('btn-primary').css({"background":"#3c8dbc", "color": "#fff"});
			}else if($('#'+chosenid).hasClass('btn-primary')){
				$('#'+chosenid).removeClass('btn-primary').addClass('btn-default').css({"background":"#fff", "color":"#000"});
				$('.checkbox'+chosenid).prop('checked',false);
			}
			var choosecommcount = $('input[name="choosecomm[]"]:checked').length;
			if(choosecommcount >= 2){
				$('.choosecommsave').css({"display":"block", "background":"#3c8dbc", "color": "white"});
				//$('.choosecommsave').css('background','3c8dbc');
			}else{
				//$('.choosecommsave').css('display','none');
				$('.choosecommsave').css({"display":"block!important", "background":"#fff", "color": "#fff"});
			}
		});
	    
	    	//Sign up choose communities
		$( "form#choosecommupedit" ).submit(function( event ) {
			event.preventDefault();
			var choosecommcount = $('input[name="choosecomm[]"]:checked').length;
			var cslangp = $('#cslangp').val();
			var useridp = $('#useridp').val();
			if(choosecommcount >= 2){
				$.ajax({
					url: "<?php echo base_url();?>welcome/choosecommu",
					type: 'POST',
					data: {'commids': commids, 'cslang': cslangp, 'userid':useridp },
					success: function (resultdata) {
						/*if((resultdata != 1) || (resultdata != 0)){
							location.href = "<?php echo base_url();?>"+resultdata;
						}else{
						    location.href = "<?php echo base_url();?>";
						}*/
						$('#snackbar').text('prefered communities updated successfully.').addClass('show');
        		        setTimeout(function(){ $('#snackbar').removeClass('show'); }, 5000);
        		        setTimeout(function(){ location.reload(); }, 500);
					}
				});
			}else{
				$('.choosecommsave').css('display','none');
			}
		});
    });
</script>


<script type="text/javascript">
	$("#upload-file-profile").change(function() {
	    $('.btnspinner').html('<img src="<?php echo base_url();?>/assets/landing/svg/spinner.svg" class="spinner">');
	    //var form = $('form#uploadpimgform')[0];
	    /*var fileUpload = document.getElementById("upload-file-profile");
	    var reader = new FileReader(); //Read the contents of Image File.
        reader.readAsDataURL(fileUpload.files[0]);
        reader.onload = function (e) {      //Initiate the JavaScript Image object.
            var image = new Image();
            image.src = e.target.result;
            image.onload = function () {
                imagewidth = this.width;*/
                //if(imagewidth < 480){
                    var $formData = new FormData();
                    $formData.append('profileimg', $("#upload-file-profile").get(0).files[0]);
                    $.ajax({
            			url: "<?php echo base_url();?>welcome/upload_profileimg",
            			type: 'POST',
            			data: $formData,
            			processData: false,
                        contentType: false,
            			success: function (resultdata) {
            			    if(resultdata){
            			       $('#cropboxmodaldiv').html(resultdata);
            			        //$('#cropbox').removeAttr('src');
            			        //$('#cropbox').attr('src',resultdata);
            			        $('#upload_profileimg').modal('show');
            			    }else{
            			        $('#upload_profileimg').modal('show');
            			    }
            			    $('.btnspinner').html('Profile Image');
            			}
                    });
        	   /* }else{
        	        $('#snackbar').text('The selected Image width should be lessthan 480PX').addClass('show');
            		setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
        	    }*/
            //}
        //}
    });
    $("#upload-file-selector").change(function() {
        //$('.btnspinnerc').html('<i class="fa fa-image"></i><img src="<?php echo base_url();?>/assets/landing/svg/spinner.svg" class="spinner">');
        var $formData = new FormData();
        var bannerimage = $("#upload-file-selector").get(0).files[0];
        if(bannerimage.name){
            $('#updateform').submit();
        }
    });
</script>