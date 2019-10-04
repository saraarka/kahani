<head>
<title>Story Carry</title>
<meta charset="utf-8"/>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css?family=Nunito|Poppins" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/landing/landing.css">
    <script type="text/javascript" src="<?php echo base_url();?>assets/landing/landing.js"></script>

</head>
<body>
    <div class="header">
           <img src="<?php echo base_url();?>assets/landing/images/storycarry-logo2.jpg" alt="storycarry.com" style="width: 70px;margin-top: 10px;margin-left: 15px;">
            <div style="margin:17px 15px 0px 15px; float: right;font-size:1.1em;">
                <font>FAQ</font>
              <font style="margin-left: 15px;">
                  <a href="#loginmodal" style="color:#000;text-decoration:none" data-toggle="modal" data-target="#loginmodal">LOGIN</a>
              </font>
            </div>
          </div>

<div class="totalbody">
      <div class='background-stars'></div>
    <div class="hidden-txt">
            <div style="max-width:400px;margin: 0 auto;">
            <font>
                Read & Write stories, life incidents in the language you wish for free.
          </font>
        </div>
          </div>
<div class="totalbody1">
<header>
  <div class="mainlogo">
    <img src="<?php echo base_url();?>assets/landing/images/storycarry-logo.jpg" style="width:100%">
  </div>
  <div style="display: inline-block;margin:15px 50px 0px 0px; float: right;">
      <font style="color: white;">FAQ</font>
    <font style="color:white;">
        <a href="#loginmodal" onclick="" style="color:#fff; text-decoration:none" data-toggle="modal" data-target="#loginmodal">LOGIN</a></font>
  </div>
</header>

<div>
<div class="landinfo">
    <div>
    <div class="startwrite">
        <i class="fas fa-edit"></i> START WRITING</div>
    </div>
  <font class="infohome">Read & Write stories, life incidents in the language you wish for free.</font>
    <?php if(isset($typewrites) && !empty($typewrites)){ ?>
        <font class="typewrite" data-period="2000" data-type='[ <?php echo implode(',', $typewrites); ?> ]'>
            <span class="wrap"></span>
        </font>
    <?php } else{ ?>
    <font class="typewrite" data-period="2000" data-type='[ "Welcome!" ]'>
        <span class="wrap"></span>
    </font>
    <?php } ?>
    <div style="margin-top:25px;cursor:pointer">
      <img src="https://shuttleexpress.com/wp-content/uploads/2018/10/Play-Store-Logo-2.png" width="150px">
    </div>
<div>
      <font style="font-family: 'Nunito', sans-serif;color:black;font-size: 1.3em;background: linear-gradient(to right, #ffffff 0%, #cbff1b 100%);-webkit-background-clip: text;
  -webkit-text-fill-color: transparent;">
      Download our app</font>
    </div>
</div>


    <div class="language-div">
      <font class="language-intro">Choose your language to Start Reading</font>
      <hr class="style-one">
      
      <div class="language-box">
        <?php if(isset($languages) && ($languages->num_rows() >0)) { 
    		foreach ($languages->result() as $language) { ?>
    	        <a href="<?php echo base_url();?>index.php/welcome/home/<?php echo $language->code; ?>">
    	            <button class="homepage-btn"><?php echo strtoupper($language->language); ?></button>
    	        </a>
    	<?php } } ?>     
      </div>
        <font style="font-family: 'Nunito', sans-serif;color:white">Based on your selection, we will present you with our best content.</font>
    </div>
</div>
</div>
</div>

  <div class="main-div">
        <div class="inner-div">
          <img src="<?php echo base_url();?>assets/landing/images/storycarry-writings.PNG" class="but" alt="build audience">
          <div>
          <h1 class="div-text">BUILD AUDIENCE</h1>
          </div>
           <div style="width:85%;margin:0 auto;">
          <p class="div-text1">Write stories, life events in the language you wish for free. Get exposure for your stories & build your audience.
        </p>
          </div>
        </div>
        
          <div class="inner-div">
            <img src="<?php echo base_url();?>assets/landing/images/storycarry-life.jpg" class="but" alt="storycarry life incidents">
          <div>
          <h1 class="div-text">LIFE EVENTS</h1>
          </div>
           <div style="width:85%;margin:0 auto;">
          <p class="div-text1">Every life has stories to tell, your life incidents may entertain or inspire others. Write & read life events on StoryCarry.com
        </p>
          </div>
          </div>
          <div class="inner-div">
            <img src="<?php echo base_url();?>assets/landing/images/storycarry-communities.jpg" class="but" alt="storycarry communities">
          <div>
          <h1 class="div-text">COMMUNITIES</h1>
          </div>
           <div style="width:85%;margin:0 auto;">
          <p class="div-text1">Join communities to interact with other members in community by sharing your thoughts, quotes & stories. 
        </p>
          </div>
          </div>
        
        <div class="inner-div">
          <img src="<?php echo base_url();?>assets/landing/images/storycarry-money.jpg" class="but" alt="storycarry monetisation">
          <div>
          <h1 class="div-text">MONETISATION</h1>
          </div>
           <div style="width:85%;margin:0 auto;">
          <p class="div-text1">Your story could be next big thing. Write great content to build your audience and earn pocket money.
        </p>
          </div>
        </div>
        
          <div class="inner-div">
            <img src="<?php echo base_url();?>assets/landing/images/storycarry-ano.PNG" class="but" alt="storycarry life incidents">
          <div>
          <h1 class="div-text">WRITE ANONYMOUSLY</h1>
          </div>
           <div style="width:85%;margin:0 auto;">
          <p class="div-text1">Never compromise in telling true stories. Write your bold & hard-hitting life incidents by hiding your identity. 
        </p>
          </div>
          </div>
          <div class="inner-div">
            <img src="<?php echo base_url();?>assets/landing/images/storycarry-language.PNG" class="but" alt="storycarry writing">
          <div>
          <h1 class="div-text">TRANSLITERATION</h1>
          </div>
           <div style="width:85%;margin:0 auto;">
          <p class="div-text1">Write stories in 12 languages.
        </p>
          </div>
          </div>
        </div>
   <div class="footer">
    <font style="float:left;font-size: 18px;margin-top: 8px;margin-left:10px;font-family: 'Varela Round', sans-serif;" class="copyright">
    Copyright <i class="fa fa-copyright" aria-hidden="true" style="font-size:12px;"></i> 2019 Story Carry
    </font>
    <div class="socialbtns">
    <font style="font-size:14px;color:black;font-family: 'Varela Round', sans-serif;" class="socialmedia">SOCIAL MEDIA : </font>
    <i class="fa fa-facebook-square hover-tems" aria-hidden="true" style="margin-right:8px"></i>
    <i class="fa fa-instagram hover-tems" aria-hidden="true" style="margin-right:6px"></i>
    <i class="fa fa-twitter-square hover-tems" aria-hidden="true" style="margin-right:6px"></i>
    <i class="fa fa-youtube-square hover-tems" aria-hidden="true"></i>
    </div>
    </div>
    <div class="footer1">
    <div style="font-size:14px;color:black;font-family: 'Varela Round', sans-serif;">
    <center>
    <font style="margin-right:10px" class="hover-tems">ABOUT</font>
    <font style="margin-right:10px" class="hover-tems">CONTACT</font>
    <font style="margin-right:10px" class="hover-tems">TERMS</font>
    <font class="hover-tems">PRIVACY</font>
    </center>
    </div>
    </div>
<div id="loginmodal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true"> <!-- Login Modal popup start -->
	<div class="modal-dialog msv">
		<div class="modal-content">
			<div class="modal-body">
				<div class="login-logo">
					<span class="heads"><b>SIGN IN</b>
					    	<button type="button" class="close" data-dismiss="modal">&times;</button>
					</span>
				</div>
				<div class="login-box-body">
					<span class="text-danger lerror"><?php echo $this->session->flashdata('signinmsg'); ?></span>
					
					<form id="loginform" action="#" method="POST" style="margin-bottom: 0;">
					    <div class="input-container has-feedback">
                            <i class="fa fa-envelope icon"></i>
                            <input class="input-field" type="email" placeholder="Email" name="email">
                            <span class="text-danger email"></span>
                        </div>
                        <div class="input-container has-feedback">
                            <i class="fa fa-key icon"></i>
                            <input class="input-field" type="password" placeholder="Password" name="password">
                            <span class="text-danger password"></span>
                        </div>
						<div class="row">
							<div class="col-xs-12">
								<center> <button type="submit" class="btn bg-green">Sign In</button></center>
							</div>
						</div>
					</form>
					
					<div class="" style="margin-bottom:20px;"> 
						<center><p class="text-centerv" style="margin:5px;"> - or - </p></center>
						<div class="flex">
						    <div style="float:left; width:49%"><button type="submit" class="btn bg-fb" style="width:100%">facebook</button></div>
						    <div style="width:2%"></div>
						    <div style="float:right; width:49%"><button type="submit" class="btn bg-google" style="width:100%">google</button></div>
						</div>
					</div> <hr>
					<div class="">
					    <center>
					        <p  class="text-centerv"   style="margin:5px;">Don't have an account? <a href="#signup" data-toggle="modal" data-target="#signup" data-dismiss="modal" style="color:#0e92af">Sign Up</a></p>
					        
					        <p class="text-centerv"  style="margin:5px;">or</p>
					        <p  class="text-centerv"   style="margin:5px;"><a href="#forgotpassmodal" data-toggle="modal" data-target="#forgotpassmodal" data-dismiss="modal" style="color:#0e92af"> FORGOT PASSWORD</a></p>
					    </center>
					</div>
				</div>
			</div>
		</div>
	</div>
</div> <!-- Login Modal popup end -->

<div class="modal fade" id="signup" role="dialog" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<div class="login-logo">
					<span class="heads"><b>SIGN UP</b>
					    	<button type="button" class="close" data-dismiss="modal">&times;</button>
					</span>
				</div>
				<div class="login-box-body">
					<span class="text-danger lerror"><?php echo $this->session->flashdata('signinmsg'); ?></span>
					
					<form id="signup" action="#" method="POST" style="margin-bottom: 0;">
					    <div class="input-container has-feedback">
                            <i class="fa fa-envelope icon"></i>
                            <input class="input-field" type="text" placeholder="Name" name="name">
                            <span class="text-danger email"></span>
                        </div>
					    <div class="input-container has-feedback">
                            <i class="fa fa-envelope icon"></i>
                            <input class="input-field" type="email" placeholder="Email" name="email">
                            <span class="text-danger email"></span>
                        </div>
                        <div class="input-container has-feedback">
                            <i class="fa fa-key icon"></i>
                            <input class="input-field" type="password" placeholder="Password" name="password">
                            <span class="text-danger password"></span>
                        </div>
                        <div class="row">
							<div class="col-xs-12">
								<center> <button type="submit" class="btn bg-green">Sign Up</button></center>
							</div>
						</div>
					</form>
					
					<div class="" style="margin-bottom:20px;"> 
						<center><p class="text-centerv" style="margin:5px;"> - or - </p></center>
						<div class="flex">
						    <div style="float:left; width:49%"><button type="submit" class="btn bg-fb" style="width:100%">Facebook</button></div>
						    <div style="width:2%"></div>
						    <div style="float:right; width:49%"><button type="submit" class="btn bg-google" style="width:100%"> Google</button></div>
						</div>
		                <center>
		                    <p class="text-centervv">By signing up, you agree to our <a href="" style="color:#0e92af">Terms of Use</a> and <a href="" style="color:#0e92af">Privacy Policy</a>.</p>
		                </center>
					</div> <hr>
					<div class="">
					    <center>
					        <p  class="text-centerv">Already have an account? <a href="#loginform" data-toggle="modal" data-target="#loginform" data-dismiss="modal" style="color:#0e92af">Sign In</a></p>
					    </center>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="forgotpassmodal" role="dialog" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<div class="login-logo">
					<span class="heads"><b>RESET PASSWORD</b>
					    	<button type="button" class="close" data-dismiss="modal">&times;</button>
					</span>
				</div>
				<div class="login-box-body">
					<span class="text-danger ferror"><?php echo $this->session->flashdata('signinmsg'); ?></span>
					<form id="forgot" action="#" method="POST">
					    <div class="input-container has-feedback">
                            <i class="fa fa-envelope icon"></i>
                            <input class="input-field" type="email" placeholder="Email" name="email">
                            <span class="text-danger email"></span>
                        </div>
                        <div class="row">
							<div class="col-xs-12">
								<center> <button type="submit" class="btn bg-green">Reset Password</button></center>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>


<script src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
</body>