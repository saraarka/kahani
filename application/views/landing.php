<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=100">
	<title>Story Carry - Read & Write stories, life events in 12 languages</title>
    <meta name="title" content="StoryCarry - Write & Read stories, life events in 12 languages for free.">
    <meta name="description" content="Read & Write stories, life events in the language you wish for free. Hindi, Telugu, Tamil, English, Bengali, Marathi, Gujarati, Malayalam, Kannada, Punjabi, Russian, & ItaliaR">
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/landing/images/fav.png" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:title" content="Story Carry - Read & Write stories, life events in 12 languages for free">
    <meta property="og:description" content="Read & Write stories, life events in the language you wish for free. Hindi, Telugu, Tamil, English, Bengali, Marathi, Gujarati, Malayalam, Kannada, Punjabi, Russian, & ItaliaR">
    <meta property="og:url" content="https://storycarry.com/">
    <meta property="og:type" content="website">
    <meta property="og:image" content="">
    <script src="<?php echo base_url();?>assets/landing/landing.js"></script>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/landing/landing.css">
</head>
<body>
    <!-- Mobile Header -->
    <div class="header">
        <img src="<?php echo base_url();?>assets/images/logom.png" alt="storycarry.com" style="height: 40px;margin-top: 10px;margin-left: 15px;">
        <div style="margin:19px 15px 0px 15px; float: right;font-size:1.1em;">
            <font>
                <a href="<?php echo base_url();?>faq" style="color:#000;">FAQ</a>
            </font>
            <font style="margin-left: 15px;">
                <a href="#loginmodal" style="color:#000; text-decoration:none" data-toggle="modal" data-target="#loginmodal">LOGIN</a>
            </font>
        </div>
    </div><!-- Mobile Header end -->

    <div class="totalbody"> 
        <div class='background-stars'></div>
        <div class="hidden-txt">
            <div style="max-width:400px;margin: 0 auto;">
                <font> Read & Write stories, life incidents in the language you wish for free. </font>
            </div>
        </div>
        <div class="totalbody1">
            <!-- Desktop Header -->
            <header>
                <div class="mainlogo">
                    <a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>assets/landing/storylogoland.png" alt="storycarry logo" style="margin-top: 15px; margin-left: 20px;" ></a>
                </div>
                <div style="display: inline-block;margin:15px 50px 0px 0px; float: right;">
                    <a href="<?php echo base_url();?>faq" style="color:#fff;text-decoration:none">FAQ</a>
                    <a  class="login-but" href="#loginmodal" style="color:#fff; text-decoration:none" data-toggle="modal" data-target="#loginmodal">LOGIN</a>
                </div>
            </header> <!-- Desktop Header end -->
            
            <div>
                <div class="landinfo">
                    <div>
                        <a href="#loginmodal" style="color:#fff; text-decoration:none" data-toggle="modal" data-target="#loginmodal">
                        <div class="startwrite">
                            <img src="<?php echo base_url();?>/assets/landing/svg/editsolid.svg" alt="write story" style="width:18px">
                            START WRITING
                        </div>
                        </a>
                    </div>
                    <font class="infohome">Read & Write stories, life incidents in the<br>language you wish for free.</font>
                    
                    <!-- Type Writes start -->
                    <?php if(isset($typewrites) && !empty($typewrites)){ $typewritelist = implode(',',$typewrites); ?>
                        <font class="typewrite" data-period="2000" data-type='[<?php echo $typewritelist; ?>]'>
                            <span class="wrap"></span>
                        </font>
                    <?php }else{ ?>
                        <font class="typewrite" data-period="2000" data-type='[ "Welcome!", "Story Carry..."]'>
                            <span class="wrap"></span>
                        </font>
                    <?php } ?> <!-- Type Writes end -->
                    
                    <div style="margin-top:22px;cursor:pointer">
                        <img src="<?php echo base_url();?>/assets/landing/storycarry-app.png" alt="StoryCarry app">
                    </div>
                    <div>
                        <font class="download-text">  to carry your stories</font>
                    </div>
                </div>
                
                <!-- Languages -->
                <div class="language-div">
                    <font class="language-intro">Choose your language to Start Reading</font>
                    <hr class="style-one">
                    <div class="language-box">
                        <?php if(isset($languages) && ($languages->num_rows() > 0)){ foreach($languages->result() as $language){ ?>
                            <a href="<?php echo base_url();?><?php echo $language->langname; ?>">
                                <button class="homepage-btn"><?php echo $language->language;?> </button>
                            </a>
                        <?php } } ?>
                    </div>
                    <font style="font-family: 'Nunito', sans-serif;color:white;line-height: 1.5em;">Based on your selection, we will present you with our best content.</font>
                </div> <!-- Languages end -->
                
            </div>
        </div>
    </div>
    
    <div class="main-div">
        <?php if(isset($landinggrids) && ($landinggrids->num_rows() > 0)){ foreach($landinggrids->result() as $landinggrid){ ?>
        <div class="inner-div">
            <img src="<?php echo base_url();?>assets/images/lazy-d-j.jpg" data-src="<?php echo base_url();?>assets/images/<?php echo $landinggrid->slideimage;?>" class="but lazy" alt="build audience">
            <div>
                <h1 class="div-text"><?php echo $landinggrid->caption;?></h1>
            </div>
            <div style="width:85%;margin:0 auto;">
                <p class="div-text1"><?php echo $landinggrid->description;?></p>
            </div>
        </div>
        <?php } } ?>
    </div>
    
    <div id="snackbar"></div>
    <div class="footer">
        <font style="float:left;font-size: 18px;margin-top: 8px;margin-left:10px;font-family: 'Varela Round', sans-serif;" class="copyright">
            Copyright © <?php echo date('Y');?> Story Carry
        </font>
        <div class="socialbtns">
            <a href="javascript:void(0);"><img class="soc-img" src="<?php echo base_url();?>/assets/landing/svg/facebook-square-brands.svg" style="margin-right:6px;cursor:pointer;width:21px;height:24px" alt="facebook storycarry"></a>
            <a href="javascript:void(0);"><img class="soc-img" src="<?php echo base_url();?>/assets/landing/svg/instagram-brands.svg" alt="instagram storycarry" style="margin-right:6px;cursor:pointer; width:21px;height:24px"></a>
            <a href="javascript:void(0);"><img class="soc-img" src="<?php echo base_url();?>/assets/landing/svg/twitter-square-brands.svg" style="margin-right:6px;cursor:pointer;width:21px;height:24px" alt="twitter storycarry"></a>
            <a href="javascript:void(0);"><img class="soc-img" src="<?php echo base_url();?>/assets/landing/svg/quora-brands.svg" style="cursor:pointer;width:21px;height:24px" alt="Quora storycarry"></a>
        </div>
    </div>
    <div class="footer1">
        <div style="font-size:14px;color:black;font-family: 'Varela Round', sans-serif;">
            <center>
                <font  class="hover-tems"><a href="<?php echo base_url();?>about">ABOUT</a></font>
                <font  class="hover-tems"><a href="<?php echo base_url();?>contact">CONTACT</a></font>
                <font  class="hover-tems"><a href="<?php echo base_url();?>terms-conditions">TERMS</a></font>
                <font class="hover-tems"><a href="<?php echo base_url();?>privacy-policy">PRIVACY</a></font>
            </center>
        </div>
    </div>  <!-- footer end -->
        
<!-- Login Modal popup start -->      
<div id="loginmodal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog msv">
		<div class="modal-content ">
			<div class="modal-body">
				<div class="login-logo">
					<span class="headsvj"><b>SIGN IN</b>
					    <button type="button" class="close" data-dismiss="modal">&times;</button>
					</span>
				</div>
				<div class="login-box-body">
					<span class="text-danger lerror" style="color:red;font-family: sans-serif; font-size: 14px;"><?php echo $this->session->flashdata('signinmsg'); ?></span>
					<form id="loginform" action="#" method="POST" style="margin-bottom: 0;">
					    <div class="input-container has-feedback">
                            <img src="<?php echo base_url();?>assets/landing/svg/email.svg" class="icon" alt="Email">
                            <input class="input-field" type="text" placeholder="Email" name="email" id="email" autocomplete="off">
                        </div>
                        <span class="text-danger email" style="color:red;font-family:sans-serif; font-size: 14px;"></span>
                        <div class="input-container has-feedback" style="margin-top:5px;">
                            <img src="<?php echo base_url();?>assets/landing/svg/lock.svg" class="icon" alt="Password">
                            <input class="input-field" type="password" placeholder="Password" name="password" autocomplete="off">
                        </div>
                        <span class="text-danger password" style="color:red;font-family: sans-serif; font-size: 14px;"></span>
						<div class="row" style="margin-top:5px;">
							<div class="col-xs-12">
								<center> <button type="submit" class="btn bg-green btnspinner" style="cursor:pointer;">Sign in</button></center>
							</div>
						</div>
					</form>
					<div class="" style="margin-bottom:5px;"> 
						<center><p class="text-centerv" style="margin:5px;"> - or - </p></center>
						<div class="flex">
						    <div style="float:left; width:49%;"><button onclick="fbLogin()" id="fbLink" class="btn bg-fb" style="width:100%;cursor:pointer;">facebook</button></div>
						    <div style="width:2%"></div>
						    <div style="float:right; width:49%"><button data-onsuccess="onSignIn" class="g-signin2 btn bg-google" style="width:100%;cursor:pointer;">google</button></div>
						</div>
						<div style="margin-top:50px; border-top:1px solid rgba(221, 221, 221, 1);"></div>
					</div>
					<div class="">
					    <center>
					        <p class="text-centerv" style="margin:5px;">Don't have an account? 
					            <a href="#signupmodal" class="signupvj" data-dismiss="modal" data-toggle="modal" data-target="#signupmodal" style="color:#0e92af">Sign Up</a>
					        </p>
					        <p class="text-centerv" style="margin:5px;">or</p>
					        <p  class="text-centerv" style="margin:5px;">
					            <a href="#forgotpassmodal" data-toggle="modal" class="forv" data-target="#forgotpassmodal" data-dismiss="modal" style="color:#0e92af"> FORGOT PASSWORD</a>
					        </p>
					    </center>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Login Modal popup end -->

<!-- Signup Modal popup start -->
<div class="modal fade modal-signup singup-one" id="signupmodal" role="dialog">
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
                        
					    <div class="input-container has-feedback" style="margin-top:5px;">
                            <img src="<?php echo base_url();?>assets/landing/svg/email.svg" class="icon" alt="Email">
                            <input class="input-field" type="email" placeholder="Email" name="email">
                        </div>
                        <span class="text-danger email" style="color:red;font-family:sans-serif;font-size:14px;"></span>
                        
                        <div class="input-container has-feedback" style="margin-top:6px;">
                            <img src="<?php echo base_url();?>assets/landing/svg/lock.svg" class="icon" alt="Password">
                            <input class="input-field" type="password" placeholder="Password" name="password">
                        </div>
                        <span class="text-danger password" style="color:red;font-family:sans-serif;font-size:14px;"></span>
                        <div class="row" style="margin-top:5px;">
							<div class="col-xs-12">
								<center><button type="submit" class="btn bg-green btnsignupspinner" style="cursor:pointer;">Sign Up</button></center>
							</div>
						</div>
					</form>
					
					<div class="" style="margin-bottom:5px;"> 
						<center><p class="text-centerv" style="margin:5px;"> - or - </p></center>
						<div class="flex">
						    <div style="float:left; width:49%"><button onclick="fbLogin()" id="fbLink" class="btn bg-fb" style="cursor:pointer;width:100%;">Facebook</button></div>
						    <div style="width:2%"></div>
						    <div style="float:right; width:49%"><button data-onsuccess="onSignIn" class="g-signin2 btn bg-google" style="cursor:pointer;width:100%;"> Google</button></div>
						</div>
		                <center style="margin-top:50px;">
		                    <p class="text-centervv" style="margin-bottom:0;">By signing up, you agree to our <a href="<?php echo base_url();?>terms-conditions" style="color:#0e92af">Terms of Use</a> and <a href="<?php echo base_url();?>privacy-policy" style="color:#0e92af">Privacy Policy</a>.</p>
		                </center>
		                <div style="margin-top:5px; border-top:1px solid rgba(221, 221, 221, 1);"></div>
					</div>
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
					    <div class="input-container has-feedback" style="margin-top:2px;">
                            <img src="<?php echo base_url();?>assets/landing/svg/email.svg" class="icon" alt="Email">
                            <input class="input-field" type="email" placeholder="Email" name="femail" required>
                        </div>
                        <span class="text-danger femail" style="color:red;font-family: sans-serif;font-size: 14px;"></span>
                        <div class="row" style="margin-top:5px;">
							<div class="col-xs-12">
								<center> <button type="submit" class="btn bg-green forgotpwdresendbtn" style="cursor:pointer;">Reset</button></center>
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
					    <button type="button" class="close" data-dismiss="modal"> </button>
					</span>
				</div>
				<div class="login-box-body">
					<span class="text-danger nerror" style="color:red;font-family:sans-serif;font-size:14px;"></span>
                    <?php if($hash == 'expired') { ?>
                        <h4> Forget password request is expired. Please try again.</h4>
                        <center> <a href="<?php echo base_url();?>" class="btn" style="cursor:pointer;"> GO BACK </a></center>
                    <?php } else if($hash == 'wrong'){ ?>
                        <h4> Oops! Something wrong. Please try again.</h4>
                        <center> <a href="<?php echo base_url();?>" class="btn" style="cursor:pointer;"> GO BACK </a></center>
                    <?php } else{ ?>
					<form id="newpasswordform" action="#" method="POST" style="margin-bottom: 0;">
					    <input type="hidden" name="userid" value="<?php echo $hash;?>" id="fpwduserid">
					    <div class="input-container has-feedback" style="margin-top:2px;">
                            <img src="<?php echo base_url();?>assets/landing/svg/lock.svg" class="icon" alt="Password">
                            <input class="input-field" type="password" placeholder="New Password" name="newpassword">
                        </div>
                        <span class="text-danger newpassword" style="color:red;font-family: sans-serif; font-size: 14px;"></span>
                        
                        <div class="input-container has-feedback" style="margin-top:5px;">
                            <img src="<?php echo base_url();?>assets/landing/svg/lock.svg" class="icon" alt="Password">
                            <input class="input-field" type="password" placeholder="Confirm New Password" name="cnewpassword">
                        </div>
                        <span class="text-danger cnewpassword" style="color:red;font-family: sans-serif; font-size: 14px;"></span>
                        <div class="row" style="margin-top:5px;">
							<div class="col-xs-12">
								<center> <button type="submit" class="btn bg-green cpwdspinnerbtn" style="cursor:pointer;">Submit</button></center>
							</div>
						</div>
					</form>
                    <?php } ?>
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
<div class="modal fade lang-selec" id="chooselanguage" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content modal-contentvl">
			<div class="modal-body" style="padding:0">
				<div class="login-logo" style="height:50px;border:none;">
				    <center>
				        <p style="margin:0 0 10px; font-size:25px;">Welcome!</p>
					    <span class="heads" style="text-transform:uppercase;font-size:0.6em">
					        <b>Select Your Preferred reading language</b>
					    </span>
					</center>
				</div>
				<div class="login-box-body" style="margin-top:20px; max-height:256px; overflow-y:auto; margin-top:20px;">
					<form id="lang" action="#" method="POST" style="margin-bottom: 0;">
					    <div class="pt10" style="display:flex; flex-wrap:wrap; justify-content:center;">
					        <?php if(isset($languages) && ($languages->num_rows() >0)) { 
							foreach ($languages->result() as $language) { ?>
								<a href="javascript:void(0);" class="community-btn langbtn <?php echo $language->code;?>" onclick="chooselangbtn('<?php echo $language->code;?>')">
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
<div class="modal fade lang-selec" id="choosecommunity" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content modal-contentvl" style="padding-bottom:0">
			<div class="modal-body" style="padding:0">
				<div class="login-logo" style="height:50px;border:none;">
				    <center>
				        <p style="margin:0 0 10px;font-size:25px;">Welcome!</p>
					    <span class="heads"><b>Select 2 or more preferred genres</b>
					    </span>
					</center>
				</div>
				<form id="choosecommu" method="POST" style="margin-bottom:0;padding:0">
    				<div class="login-box-body" style="margin-top:20px; max-height:256px; overflow-y:scroll; margin-top:20px;">
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
					<span class="heads"><b>SIGN UP</b>
					    <button type="button" class="close" data-dismiss="modal">&times;</button>
					</span>
				</div>
				<div class="login-box-body">
					<span class="text-danger slerror" style="color:red;font-family: sans-serif; font-size: 14px;"><?php echo $this->session->flashdata('sfbgmsg'); ?></span>
					<form id="socialfbg" action="#" method="POST" style="margin-bottom: 0;">
					    <div class="input-container has-feedback" style="margin-top:2px;">
                            <img src="<?php echo base_url();?>assets/landing/svg/user.svg" class="icon" alt="User">
                            <input class="input-field" type="text" placeholder="Name" name="fbgname" readonly style="background-color: #eee;opacity: 1;">
                        </div>
                        <span class="text-danger fbgname" style="color:red;font-family:sans-serif; font-size:14px;"></span>
                        
					    <div class="input-container has-feedback" style="margin-top:5px;">
                            <img src="<?php echo base_url();?>assets/landing/svg/email.svg" class="icon" alt="Email">
                            <input class="input-field" type="email" placeholder="Email" name="fbgemail">
                        </div>
                        <span class="text-danger fbgemail" style="color:red;font-family:sans-serif;font-size:14px;"></span>
                        
                        <div class="input-container has-feedback" style="margin-top:5px;">
                            <img src="<?php echo base_url();?>assets/landing/svg/lock.svg" class="icon" alt="Password">
                            <input class="input-field" type="password" placeholder="Enter new Password" name="fbgpassword">
                        </div>
                        <span class="text-danger fbgpassword" style="color:red;font-family:sans-serif;font-size:14px;"></span>
                        
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

<script src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript">var base_url = '<?php echo base_url();?>';</script>
<script src="<?php echo base_url();?>assets/js/landing.js"></script>

</body>
</html>