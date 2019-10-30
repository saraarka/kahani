<link rel="stylesheet" href="<?php echo base_url();?>assets/css/modal.css">
<style>
.heads {
    text-transform: uppercase;
    font-size: 1em;
    font-family: 'Nunito', sans-serif;
}
.community-btn{
    font-size:16px;
    font-weight:200;
	
}

.login-but{
    cursor: pointer; 
    margin-left: 23px;
    padding: 2px 7px 2px 7px;
    border: 1px solid rgba(255, 255, 255, 0.22);
    background: rgba(0, 0, 0, 0.13);
    }

.download-text{
    font-family: 'Nunito', sans-serif;
    color:black;
    font-size: 1.3em;
    background: linear-gradient(to right, #ffffff 0%, #daef93 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}


/* popup */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1050; /* Sit on top */
  padding-top:100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background:rgba(0, 0, 0, 0.48);
  -webkit-overflow-scrolling:touch;
  outline:0;
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
   padding: 17px 20px;
  border: 1px solid #888;
      border-radius: 5px;
}

.modal-contentv {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid rgb(136, 136, 136);
  width: 25%;
  min-width:320px;
  max-width:358px;
  border-radius: 5px;
  height:auto;
}
.close{float:right;font-size:21px;font-weight:700;line-height:1;color:#000;text-shadow:0 1px 0 rgb(255, 255, 255);filter:alpha(opacity=20);}
.close:focus,.close:hover{color:#000;text-decoration:none;cursor:pointer;filter:alpha(opacity=50);opacity:.5}

.modal.fade .modal-dialog{
    -webkit-transition:-webkit-transform .3s ease-out;
    -o-transition:-o-transform .3s ease-out;transition:transform .3s ease-out;
    -webkit-transform:translate(0,-25%);
    -ms-transform:translate(0,-25%);
    -o-transform:translate(0,-25%);
    transform:translate(0,-25%);
   margin: auto;
  
  min-width:300px;
  max-width:358px;
	
  height:auto;
}
.modal.in .modal-dialog{-webkit-transform:translate(0,0);-ms-transform:translate(0,0);-o-transform:translate(0,0);transform:translate(0,0)}
.modal-open .modal{overflow-x:hidden;overflow-y:auto}
.abcRioButtonLightBlue {
    background-color: #ce0c0c !important;
    color: #fefefe !important;
    height: 37px !important;
}
.abcRioButtonContents:after {
    content: 'Google';
    font-size: 14px;
    font-weight: 400;
    font-family: Arial, sans-serif;
    line-height: 37px;
}
</style>
<div id="snackbar"></div>

<!-- Login Modal popup start -->      
<div id="loginmodal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true" style="padding-left: 0px;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<div class="login-logo">
					<span class="headsvj"><b>SIGN IN</b>
					    <button type="button" class="close" data-dismiss="modal">&times;</button>
					</span>
				</div>
				<div class="login-box-body">
					<span class="text-danger lerror" style="color:red; font-family: sans-serif; font-size: 14px;"><?php echo $this->session->flashdata('signinmsg'); ?></span>
					<form id="loginform" action="#" method="POST" style="margin-bottom: 0;">
					    <div class="input-container has-feedback">
                            <img src="<?php echo base_url();?>assets/landing/svg/email.svg" class="icon">
                            <input class="input-field" type="text" placeholder="Email" name="email" autocomplete="off">
                        </div>
                        <span class="text-danger email" style="color:red;"></span>
                        <div class="input-container has-feedback" style="margin-top:2px;">
                            <img src="<?php echo base_url();?>assets/landing/svg/lock.svg" class="icon">
                            <input class="input-field" type="password" placeholder="Password" name="password" autocomplete="off">
                        </div>
                        <span class="text-danger password" style="color:red;"></span>
						<div class="row" style="margin-top:2px;">
							<div class="col-xs-12">
								<center> <button type="submit" class=" bg-green btnspinner" style="cursor:pointer;">Sign In</button></center>
							</div>
						</div>
					</form>
					
					<div class=""> 
						<center><p class="text-centerv" style="margin:3px;"> - or - </p></center>
						<div class="flex">
						    <div style="float:left; width:49%"><button onclick="fbLogin()" id="fbLink" class="bg-fb" style="width:100%;cursor:pointer;">facebook</button></div>
						    <div style="width:2%"></div>
						    <div style="float:right; width:49%"><button data-onsuccess="onSignIn" class="g-signin2 bg-google" style="width:100%;cursor:pointer;">google</button></div>
						</div>
						<div style="margin-top:48px; border-top:1px solid rgba(221, 221, 221, 1);"></div>
					</div>

					<div class="">
					    <center>
					        <p class="text-centerv" style="margin:3px 3px 1px 3px;">Don't have an account? 
					            <a href="#signupmodal" data-toggle="modal" class="signupvj" data-target="#signupmodal" data-dismiss="modal" style="color:#0e92af;">Sign Up</a>
					        </p>
					        <p class="text-centerv" style="margin-bottom:1px;">or</p>
					        <p  class="text-centerv" style="margin-bottom:5px;" >
					            <a href="#forgotpassmodal" data-toggle="modal" class="signupvj" data-target="#forgotpassmodal" data-dismiss="modal" style="color:#0e92af;"> FORGOT PASSWORD</a>
					        </p>
					    </center>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Login Modal popup end -->

<!-- Signup Modal popup langue start -->
<div class="modal fade modal-signup" id="signupmodal" role="dialog" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<div class="login-logo">
					<span class="headsvj"><b>SIGN UP</b>
					    <button type="button" class="close" data-dismiss="modal">&times;</button>
					</span>
				</div>
				<div class="login-box-body">
					<form id="signup" action="#" method="POST" style="margin-bottom: 0;">
					    <div class="input-container has-feedback" style="margin-bottom:0px;">
                            <img src="<?php echo base_url();?>assets/landing/svg/user.svg" class="icon" alt="User">
                            <input class="input-field" type="text" placeholder="Name" name="name">
                        </div>
                        <span class="text-danger name" style="color:red;font-family:sans-serif;font-size:14px;"></span>
                        
					    <div class="input-container has-feedback" style="margin-top:2px;">
                            <img src="<?php echo base_url();?>assets/landing/svg/email.svg" class="icon" alt="Email">
                            <input class="input-field" type="email" placeholder="Email" name="email">
                        </div>
                        <span class="text-danger email" style="color:red;font-family:sans-serif;font-size:14px;"></span>
                        
                        <div class="input-container has-feedback" style="margin-top:2px;">
                            <img src="<?php echo base_url();?>assets/landing/svg/lock.svg" class="icon" alt="Password">
                            <input class="input-field" type="password" placeholder="Password" name="password">
                        </div>
                        <span class="text-danger password" style="color:red;font-family:sans-serif;font-size:14px;"></span>
                        <div class="row" style="margin-top:2px;">
							<div class="col-xs-12">
								<center><button type="submit" class="bg-green btnsignupspinner" style="cursor:pointer;">Sign Up</button></center>
							</div>
						</div>
					</form>
					
					<div class="" style="margin-bottom:2px;"> 
						<center><p class="text-centerv" style="margin:2px;"> - or - </p></center>
						<div class="flex" style="margin-top:5px">
						    <div style="float:left; width:49%">
						        <button onclick="fbLogin()" id="fbLink" class="bg-fb" style="cursor:pointer;width:100%;">Facebook</button>
						    </div>
						    <div style="width:2%"></div>
						    <div style="float:right; width:49%">
						        <button data-onsuccess="onSignIn" class="g-signin2 bg-google" style="cursor:pointer;width:100%;"> Google</button>
						    </div>
						</div>
		                <center style="margin-top:50px;">
		                    <p class="text-centervv" style="margin-bottom:0;font-size:0.8em;line-height:12px">By signing up, you agree to our <a href="<?php echo base_url();?>terms-conditions" style="color:#0e92af">Terms of Use</a> and <a href="<?php echo base_url();?>privacy-policy" style="color:#0e92af">Privacy Policy</a>.</p>
		                </center>
		                <div style=" margin-top:6px; border-top:1px solid rgba(221, 221, 221, 1); margin-bottom:10px;"></div>
					</div>

					<div class="">
					    <center>
					        <p class="text-centerv" style="margin-bottom:0;margin-top:13px;">Already have an account? <a href="#loginmodal" data-toggle="modal" data-target="#loginmodal" data-dismiss="modal" style="color:#0e92af">Sign In</a></p>
					    </center>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Signup Modal popup end -->

<!-- Forgotpassword Modal popup start -->
<div class="modal fade" id="forgotpassmodal" role="dialog" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content modal-contentv">
			<div class="modal-body">
				<div class="login-logo">
					<span class="headsvj"><b>RESET PASSWORD</b>
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
					</span>
				</div>
				<div class="login-box-body">
					<span class="text-danger ferror" style="color:red;font-family:sans-serif;font-size:14px;"><?php echo $this->session->flashdata('signinmsg'); ?></span>
					<span class="ferrorresend"></span>
					<form id="forgotpassword" action="#" method="POST">
					    <div class="input-container has-feedback">
                            <img src="<?php echo base_url();?>assets/landing/svg/email.svg" class="icon">
                            <input class="input-field" type="email" placeholder="Email" name="femail">
                        </div>
                        <span class="text-danger femail" style="color:red;"></span>
                        <div class="row" style="margin-top:5px;">
							<div class="col-xs-12">
								<center> <button type="submit" class="btn bg-green forgotpwdresendbtn">Reset</button></center>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Forgotpassword Modal popup end -->

<!-- Change Newpassword Modal popup start -->
<?php if(isset($hash) && !empty($hash)){ ?>
<div class="modal fade in" role="dialog" tabindex="-1" aria-hidden="true" style="display: block; padding-right: 0px;">
	<div class="modal-dialog">
		<div class="modal-content modal-contentv">
			<div class="modal-body">
				<div class="login-logo">
					<span class="headsvj"><b>CHANGE PASSWORD</b>
					    <button type="button" class="close" data-dismiss="modal">&times;</button>
					</span>
				</div>
				<div class="login-box-body">
					<span class="text-danger nerror" style="color:red;"></span>
					<form id="newpasswordform" action="#" method="POST" style="margin-bottom: 0;">
					    <input type="hidden" name="userid" value="<?php echo $hash;?>" id="fpwduserid">
					    <div class="input-container has-feedback">
                            <img src="<?php echo base_url();?>assets/landing/svg/lock.svg" class="icon">
                            <input class="input-field" type="password" placeholder="New Password" name="newpassword">
                        </div>
                        <span class="text-danger newpassword" style="color:red;"></span>
                        
                        <div class="input-container has-feedback">
                            <img src="<?php echo base_url();?>assets/landing/svg/lock.svg" class="icon">
                            <input class="input-field" type="password" placeholder="Confirm New Password" name="cnewpassword">
                        </div>
                        <span class="text-danger cnewpassword" style="color:red;"></span>
                        <div class="row">
							<div class="col-xs-12">
								<center> <button type="submit" class="btn bg-green">Submit</button></center>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php } ?>
<!-- Newpassword Modal popup end -->


<!-- Languages list Modal popup when first time signup start -->
<input type="hidden" id="cslang" value="">
<input type="hidden" id="userid" value="">
<div class="modal fade" id="chooselanguage" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog1" style="width:0 auto; position:relative;">
		<div class="modal-content modal-contentvl" style="max-width: 642px;">
			<div class="modal-body">
				<div class="login-logo" style="height:50px;border:none;">
				    <center>
				        <p style="margin:0 0 10px;font-size:25px;font-family:'times';">Welcome!</p>
					    <span class="heads" style="text-transform:uppercase;font-size:0.7em">
					        <b>Select Your Preferred reading language</b>
					    </span>
					</center>
				</div>
				<div class="login-box-body" style="margin-top:20px; max-height:256px; overflow-y:auto;">
					<form id="lang" action="#" method="POST" style="margin-bottom: 0;">
					    <div class="pt10" style="display:flex;flex-wrap:wrap;justify-content:center;">
					        <?php if(isset($languages) && ($languages->num_rows() >0)) { 
							foreach ($languages->result() as $language) { ?>
								<a href="javascript:void(0);" class="community-btn langbtn <?php echo $language->code;?>" onclick="chooselangbtn('<?php echo $language->code;?>')" style="height: 52px;">
								    <?php echo $language->language; ?>
								</a>
    						<?php } } ?>
        				</div>
					</form>
				</div>
				<div style="margin-top:14px;">
				    <center>
				        <a href="javascript:void(0);" class="btn-next chooselanguagebtn btnlangspin" style="color:#bcb2b2; background:#eee;" onclick="chooselanguage()">NEXT</a>
				    </center>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Languages list Modal popup when first time signup end -->

<!-- Community(Geners) list Modal popup when first time signup start -->
<div class="modal fade" id="choosecommunity" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog1" style="width:0 auto; positon:relative;">
		<div class="modal-content modal-contentvl" style="padding-bottom:0">
			<div class="modal-body">
				<div class="login-logo" style="height:50px;border:none;">
				    <center>
				        <p style="margin:0 0 10px; font-size:25px;font-family:'times';">Welcome!</p>
					    <span class="heads"><b>Select 2 or more preferred genres</b>
					    </span>
					</center>
				</div>
				<form id="choosecommu" method="POST" style="margin-bottom:0;padding:0">
    				<div class="login-box-body" style="margin-top:20px; max-height:256px; overflow-y:scroll;">
    				    <div class="pt10" style="display:flex; flex-wrap:wrap; justify-content:center; color:white;">
						<?php if(isset($gener) && ($gener->num_rows() > 0)) { foreach($gener->result() as $generrow) { ?>
							<label class="btn-default community-btn choosecomm" id="<?php echo $generrow->id;?>" style="padding:6px 2px;">
								<input type="checkbox" class="checkbox<?php echo $generrow->id;?>" style="float:left; display:none;" name="choosecomm[]" value="<?php echo $generrow->id;?>"><?php echo $generrow->gener; ?>
							</label>
						<?php } } ?>
        				</div>
    				</div>
    				<div style="margin-top:8px;">
    				    <center>
    				        <button type="submit" class="btn-next choosecommsave btncommspin" style="color:#bcb2b2; background:#eee; width:82.67px; height:37px;"> NEXT </button>
    				    </center>
    				</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- Community(Geners) list Modal popup when first time signup end -->

<!-- social fb g+ Signup/ Login Modal popup start -->
<div class="modal fade" id="socialfbgmodal" role="dialog" tabindex="-1" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content modal-contentv">
			<div class="modal-body">
				<div class="login-logo">
					<span class="headsvj"><b>SIGN UP</b>
					    <button type="button" class="close" data-dismiss="modal">&times;</button>
					</span>
				</div>
				<div class="login-box-body">
					<span class="text-danger slerror" style="color:red;"><?php echo $this->session->flashdata('sfbgmsg'); ?></span>
					<form id="socialfbg" action="#" method="POST" style="margin-bottom: 0;">
					    <div class="input-container has-feedback">
                            <img src="<?php echo base_url();?>assets/landing/svg/user.svg" class="icon">
                            <input class="input-field" type="text" placeholder="Name" name="fbgname" readonly style="background-color: #eee;opacity: 1;">
                        </div>
                        <span class="text-danger fbgname" style="color:red;"></span>
                        
					    <div class="input-container has-feedback">
                            <img src="<?php echo base_url();?>assets/landing/svg/email.svg" class="icon">
                            <input class="input-field" type="email" placeholder="Email" name="fbgemail">
                        </div>
                        <span class="text-danger fbgemail" style="color:red;"></span>
                        
                        <div class="input-container has-feedback">
                            <img src="<?php echo base_url();?>assets/landing/svg/lock.svg" class="icon">
                            <input class="input-field" type="password" placeholder="Enter new Password" name="fbgpassword">
                        </div>
                        <span class="text-danger fbgpassword" style="color:red;"></span>
                        
                        <input type="hidden" name="fbgid" value="">
                        <input type="hidden" name="fbgtype" value="">
                        
                        <div class="row">
							<div class="col-xs-12">
								<center> <button type="submit" class="btn bg-green">Sign Up </button></center>
							</div>
						</div>
					</form>
					<div class="" style="margin-bottom:20px;"><center>
		                <p class="text-centervv" style="margin-bottom:0;">By signing up, you agree to our <a href="javascript:void(0);" style="color:#0e92af">Terms of Use</a> and <a href="javascript:void(0);" style="color:#0e92af">Privacy Policy</a>.</p>
                    </center></div> <hr style="margin-top:-10px; border:1px solid rgba(221, 221, 221, 1);">
					<div class="">
					    <center>
					        <p  class="text-centerv" style="margin-bottom:0">Already have an account? <a href="#loginmodal" data-toggle="modal" data-target="#loginmodal" data-dismiss="modal" style="color:#0e92af">Sign In</a></p>
					    </center>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- social fb g+ Signup/ Login Modal popup end -->

<!-- Delete confirm popup start -->
<div class="modal fade" id="confirmdelpopup" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" style="width: 300px;max-width: 90%;">
        <div class="modal-content" style="padding:0">
            <div class="modal-header" style="padding: 15px">
                <div class=" deletemessage">Are You Sure? Do you want to Delete?</div>
            </div>           
            <div class="modal-footer">
                <center>
                    <button type="button" data-dismiss="modal" class="btn delcancelled">Cancel</button>
                    <button type="button" data-dismiss="modal" class="btn btn-primary" id="delconfirmed">Delete</button>
                </center>
            </div>
        </div>
    </div>
</div>
<!-- Delete confirm popup end -->

<!-- Write Modal popup start -->
<div id="writeapp" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<div class="login-logo">
					<span class="headsvj"><b>TO START WRITING</b>
					    <button type="button" class="close" data-dismiss="modal" style="margin-top:4px;">&times;</button>
					</span>
				</div>
				<div class="">
					<center>
					    INSTALL OUR APP <br>
					    <a href="javascript:void(0);">
					        <img src="<?php echo base_url();?>assets/landing/storycarry-app.png" />
					    </a><br>
					    <p>(Or)</p>
					    <p id="apptext" style="line-height:2em;">OPEN SITE ON DESKTOP</p>
					</center>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Write Modal popup end -->

<div id="modalRegister" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
			    <div class="login-logo">
					<span class="headsvj"><b> WRITE </b>
					    <button type="button" class="close" data-dismiss="modal" style="margin-top:4px;">&times;</button>
					</span>
				</div>
				<a href="<?php echo base_url();?>write-series">
			        <div style="height:50px;background:#ddd;border-radius:5px;line-height:50px;margin:10px 0px;padding:0px 10px;text-decoration:none;color:#000;">
			            SERIES
			            <img src="<?php echo base_url();?>assets/images/angle-arrow-pointing-to-right.svg" height="20px;" style="margin-top:15px;float:right;" />
			        </div>
			    </a>
			    <a href="<?php echo base_url();?>write-story">
			        <div style="height:50px;background:#ddd;border-radius:5px;line-height:50px;margin:10px 0px;padding:0px 10px;text-decoration:none;color:#000;">
			            STORY
			            <img src="<?php echo base_url();?>assets/images/angle-arrow-pointing-to-right.svg" height="20px;" style="margin-top:15px;float:right;" />
			        </div>
			    </a>
			    <a href="<?php echo base_url();?>write-life">
			        <div style="height:50px;background:#ddd;border-radius:5px;line-height:50px;margin:10px 0px;padding:0px 10px;text-decoration:none;color:#000;">
			            LIFE EVENT
			            <img src="<?php echo base_url();?>assets/images/angle-arrow-pointing-to-right.svg" height="20px;" style="margin-top:15px;float:right;" />
			        </div>
			    </a>
			    <a href="<?php echo base_url();?>write-nanostory">
			        <div style="height:50px;background:#ddd;border-radius:5px;line-height:50px;margin:10px 0px;padding:0px 10px;text-decoration:none;color:#000;">
			            SHORT STORY
			            <img src="<?php echo base_url();?>assets/images/angle-arrow-pointing-to-right.svg" height="20px;" style="margin-top:15px;float:right;" />
			        </div>
			    </a>
			</div>
		</div>
	</div>
</div>

<script src="<?php echo base_url();?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/dist/js/adminlte.min.js"></script>
<script type="text/javascript">var base_url = "<?php echo base_url();?>";</script>
<?php if(!isset($this->session->userdata['logged_in']['user_id']) || empty($this->session->userdata['logged_in']['user_id'])){ ?>
	<script>
		$(document).ready(function(){
			$(".notloginmodal").click(function(){
				$('#notloginmodal').trigger('click');
			});
		});
	</script>
<?php } ?>
<script src="<?php echo base_url();?>assets/js/footer.js"></script>

    </body>
</html>