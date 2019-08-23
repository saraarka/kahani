<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Story Carry</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue layout-top-nav">
	<div class="wrapper" style="background:#fff;">
		<header class="main-header mvj_h">
			<div class="container">
				<div class="row">
					<div class="col-md-4 col-xs-4">
						<a href="<?php echo base_url('index.php');?>" class="navbar-brand"><b>Story</b>Carry</a>
					</div>
					<div class="col-md-6 col-xs-2">
						
					</div>
					<div class="col-md-1 col-xs-3">
						<a href="#" class="navbar-brand pull-right">
							FAQ
						</a>
					</div>
					<div class="col-md-1 col-xs-3">
						<a href="#" class="navbar-brand pull-right" data-toggle="modal" data-target="#loginmodal" id="notloginmodal">
							LOGIN
						</a>
					</div>
				</div>
				<div class="navbar-header"></div>
				<!-- /.navbar-custom-menu -->
			</div>
			<!-- /.container-fluid -->
		</header>  
		<style>  
		.bgr{
			padding:30px;
			background:#fff;
		}
		.mvj{
			background:#fff;
			color:#000;
		}
		.main-header .navbar-brand {
			color: #000;
		}
		.vjl{
			background-image:url(<?php echo base_url();?>assets/images/bg1.png);
			background-size: cover;
			background-position: center center;
			background-repeat: no-repeat;
			background-attachment: fixed;
			height: 90vh;
		}	
		.vjc{
			background:#fff;
			padding:20px;
			box-shadow: 0 10px 16px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19) !important;
		}
		.container{
			width:1350px;
		}
		.pt10{
			padding:10px;
		}
		.pt50{
			padding-top:98px;
		}
		.pt35{
			padding-top:20px;
		}
		.vjle{
			text-align:left;
		}
		.vjr{
			text-align:right;
		}
		.opvj{
			/*opacity: 0.5;*/
			-webkit-filter: blur(2px); /* Safari 6.0 - 9.0 */
		  filter: blur(1px);	
		}	
		.centv {
			position: absolute;
			top: 33%;
			padding:15px;
			border-radius:2px;
			left: 50%;
			color:#FFF;
			transform: translate(-50%, -50%);
			background:#00000061
		}
		.ovv{
			background:#00000061;
			height:115px;
		}
		/* Blur */
		.hover07 figure img {
			-webkit-filter: blur(1px);
			filter: blur(1px);
			-webkit-transition: .3s ease-in-out;
			transition: .3s ease-in-out;
		}
		.hover07 figure:hover img {
			-webkit-filter: blur(0);
			filter: blur(0);
		}
		.hvj{
			display:block!important;
			}
		.hvj2{
			display:block!important;
		}
		a {
			color: #777;
		}	
		@media (max-width: 767px){
			.container {
				width:auto;
				padding:0!important;
			}
			.hvj{
				display:block!important;
			}
			.hvj2{
				display:block!important;
			}
			
			.pt50{
				padding:10px;
			}
			.carouselvj{
				display:none;
			}
			.vjl{
				background-image:url(<?php echo base_url();?>assets/img/bg1.png);
				background-size: cover;
				background-position: center center;
				background-repeat: no-repeat;
				background-attachment: fixed;
				height: auto;
			}
			.vjle{
				text-align:left;
			}
			.vjr{
				text-align:left;
			}
			.imgin{
				width:350px;
			}
			.centv {
				position: absolute;
				top: 33%;
				padding: 9px;
				border-radius: 2px;
				left: 50%;
				color: #FFF;
				transform: translate(-50%, -50%);
				background: #00000061;
				font-size: 15px;
			}			
			.content {
				padding: 0px; 
				margin-right: auto;
				margin-left: auto;
			}
			.bgr{
				padding:15px !important;
				background:#fff;
			}
		}
		footer .fa-2x{
			font-size:25px;
		}
		footer p{
			margin:0;
		}
		.svv2{
			padding:10px 20px;
		}
		.main-footer {
			background: #ecf0f5;
			padding: 0px;
			color: #444;
		}
		.sv{
			padding:0 40px;
			background:#fff;
			box-shadow:0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 1px 5px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2);
			margin-bottom:5px;
		}
		.sv1{
			padding:15px 0;
		}
		.btn_textv{
			font-size:14px;
			height:42px;
			width:99.66px;
		}
		.btn_textv1{
			font-size:14px;
			height:42px;
			width:99.66px;
		}
		.btn_textv2{
			font-size:14px;
		    height: 58px;
            width: 177.66px;
		}
		@media (max-width:768px){
			.btn_textv{
				font-size:10px;
				height:40px;
			}
			.btn_textv1{
				font-size:10px;
				height:40px;
			}
				.mvj_h {
				width:auto!important;
			}
			.sv{
				padding:0 5px;
				background:#fff;
				box-shadow:0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 1px 5px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2);
				margin-bottom:5px;
			}
			.sv1{
				padding:5px 0;
			}
			.svv2{
				padding:10px 5px;
			}
		}
		ul#ui-id-1{
			width: 501px;
		}
		.ui-menu .ui-menu-item-wrapper {
			padding: 0px;
		}
		h4.ui-menu-item {
			text-transform: uppercase;
		}
		footer {
			display: none;
		}
	</style>
	<script>
		var TxtType = function(el, toRotate, period) {
			this.toRotate = toRotate;
			this.el = el;
			this.loopNum = 0;
			this.period = parseInt(period, 10) || 2000;
			this.txt = '';
			this.tick();
			this.isDeleting = false;
		};
		TxtType.prototype.tick = function() {
			var i = this.loopNum % this.toRotate.length;
			var fullTxt = this.toRotate[i];
			if (this.isDeleting) {
				this.txt = fullTxt.substring(0, this.txt.length - 1);
			} else {
				this.txt = fullTxt.substring(0, this.txt.length + 1);
			}
			this.el.innerHTML = '<span class="wrap">'+this.txt+'</span>';	
			var that = this;
			var delta = 200 - Math.random() * 100;
			if (this.isDeleting) { delta /= 2; }
			if (!this.isDeleting && this.txt === fullTxt) {
				delta = this.period;
				this.isDeleting = true;
			} else if (this.isDeleting && this.txt === '') {
				this.isDeleting = false;
				this.loopNum++;
				delta = 500;
			}
			setTimeout(function() {
				that.tick();
			}, delta);
		};
		window.onload = function() {
			var elements = document.getElementsByClassName('typewrite');
			for (var i=0; i<elements.length; i++) {
				var toRotate = elements[i].getAttribute('data-type');
				var period = elements[i].getAttribute('data-period');
				if (toRotate) {
				  new TxtType(elements[i], JSON.parse(toRotate), period);
				}
			}
			// INJECT CSS
			var css = document.createElement("style");
			css.type = "text/css";
			css.innerHTML = ".typewrite > .wrap { border-right: 0.08em solid red}";
			document.body.appendChild(css);
		};
	</script>
	<!-- Full Width Column -->
    <div class="vjl">
        <div class="container">
            <section class="content">
                <div class="col-md-4 col-sm-push-8 pt10">
                    <div class="hvj2">
            			<div class="vjc">
            				<h4 class="text-muted">Choose your language to start reading</h4>			
            				<div class="row">				    
                                <?php if(isset($languages) && ($languages->num_rows() >0)) { 
            						foreach ($languages->result() as $language) { ?>
            						<div class="col-xs-4  pt10">
            					        <a href="<?php echo base_url();?>index.php/welcome/home/<?php echo $language->code; ?>">
            					            <button class="btn btn-defaultv btn-block btn_v btn_textv"><?php echo strtoupper($language->language); ?></button>
            					        </a>
            					    </div>
            					<?php } } ?>            					
            				</div>
            				<p class="text-muted">(We will use the selected language to present you with the best collection we have in store.)</p>
            				<div class="pt20"></div>
            			</div>
        			</div>
                </div>  
                <div class="col-md-4 pt10">
					<div class="pt50">
        				<h1>
							<b>
								<a class="typewrite" data-period="2000" data-type='[ "FANFICTION", "SCIENCE FICTION", "ROMANCE", "FICTION", "THRILLER" ]' style="color:red">
									<span class="wrap"></span>
								</a>
        					</b>
        				</h1>
        				<p>What is Lorem Ipsum? Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>        				
        				<img src="<?php echo base_url();?>assets/images/gplay.png" alt="googleplay" class="img-responsive" width="150"/>
        			</div>
                </div>                
                <div class="col-md-4 col-sm-pull-8 pt10">
                     <div class="hvj2">
            			<div class="vjc">
            				<div class="login-box-body">
                                <p class="login-box-msg">Sign up to start your writing</p>
                                <span><?php echo $this->session->flashdata('msg'); ?></span>
                                <form action="#" method="POST" id="signupform">
                                    <div class="form-group has-feedback">
                                        <input type="text" class="form-control" name="name" placeholder="Name" required="" value="<?php echo set_value('name');?>">
                                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                        <span class="text-danger name"><?php echo form_error('name');?></span>
                                    </div>            
                                    <div class="form-group has-feedback">
                                        <input type="text" class="form-control" name="email" placeholder="Email" pattern="[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required="" value="<?php echo set_value('email');?>">
                                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                        <span class="text-danger email"><?php echo form_error('email');?></span>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <input type="password" class="form-control" name="password" placeholder="******"  value="<?php echo set_value('password');?>">
                                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                        <span class="text-danger password"><?php echo form_error('password');?></span>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" id="confirm_password" value="<?php echo set_value('confirm_password');?>">
                                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                        <span class="text-danger confirm_password"><?php echo form_error('confirm_password');?></span>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <center>
											<p>By clicking Signup, you agree our <a href="<?php echo base_url();?>index.php/welcome/terms">Terms</a> & <a href="<?php echo base_url();?>index.php/welcome/privacy">Privacy policy</a></p>
                                        </center>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign Up</button>
                                    </div>
                                    <div>
                                        <center>
                                            <p>Or</p>
                                        </center>
                                    </div>
                                </form>
                                <form action="#" method="POST">
                                    <div class="form-group has-feedback">
                                        <button type="submit" class="btn btn-block" style="background:#116494;color:#fff; border-color:#116494"> <i class="fa fa-facebook"></i>  Sign Up with Facebook</button>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <button type="submit" class="btn btn-block btn-danger"> <i class="fa fa-google-plus"></i>  Sign Up with Google +</button>
                                    </div>
                                </form>
                                <center><div class="processing"></div></center>
                            </div> <!-- /.login-box-body -->
            			</div><!-- /.login-box -->
        			</div>
                </div>
            </section>
        </div>
    </div>
	<div class="content-wrapper" style="background:#fff;">
		<div class="container">
			<section class="content bgr"><br>
				<div class="row">
					<div class="col-md-6">
						<center>
							<img src="<?php echo base_url();?>assets/images/1.png" class="img-responsive"/>
						</center>
					</div>
					<div class="col-md-1"></div>
					<div class="col-md-5">
						<h2 class="pt50"><b>What is Lorem Ipsum?</b></h2>
						<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
					</div>
				</div><br>
				<div class="row">
					<div class="col-md-6 col-sm-push-7">
						<center>
							<img src="<?php echo base_url();?>assets/images/2.png" class="img-responsive"/>
						</center>
					</div>
					<div class="col-md-1"></div>
					<div class="col-md-5 col-sm-pull-6">
						<h2 class="pt50"><b>What is Lorem Ipsum?</b></h2>
						<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
					</div>
				</div><br>
				<div class="row">
					<div class="col-md-6">
						<center>
							<img src="<?php echo base_url();?>assets/images/3.png" class="img-responsive"/>
						</center>
					</div>
					<div class="col-md-1"></div>
					<div class="col-md-5">
						<h2 class="pt50"><b>What is Lorem Ipsum?</b></h2>
						<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
					</div>
				</div><br>
			</section>
			<div class="clearfix"></div>
		</div>
	</div>
	<div class="clearfix"></div>
	<input type="hidden" id="cslang" value="">
	<div class="modal" id="chooselanguage" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<center>
								<h4 class="modal-title">WELCOME!</h4>
								<h5 style="font-size:20px;">SELECT YOUR PREFERRED LANGUAGE</h5>
							</center>
						</div>
					</div>
					<div class="row" style="padding: 0 50px;">
						<center>
						<?php if(isset($languages) && ($languages->num_rows() >0)) { 
							foreach ($languages->result() as $language) { ?>
							<div class="col-xs-4  pt10">
								<button class="btn btn-default btn_textv1" onclick="chooselanguage('<?php echo $language->code;?>')"><?php echo strtoupper($language->language); ?></button>
							</div>
						<?php } } ?>
						</center>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal" id="choosecommunity" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<center>
								<h4 class="modal-title">WELCOME!</h4>
								<h5 style="font-size:20px;">SELECT 2 OR MORE PREFERRED GENRES</h5>
							</center>
						</div>
					</div>
					<div class="row" style="padding: 0 50px;">
						<center>
							<form id="choosecommu" method="POST">
								<?php if(isset($geners) && ($geners->num_rows() > 0)){ foreach($geners->result() as $gener) { ?>
								<div class="col-xs-3 pt10">
									<label class="btn btn-default btn-block choosecomm btn_textv2" style="padding-top:18px; padding-bottom:18px; font-size:17px;" id="<?php echo $gener->id;?>">
										<input type="checkbox" class="checkbox<?php echo $gener->id;?>" name="choosecomm[]" value="<?php echo $gener->id;?>" style="visibility:hidden;"><?php echo $gener->gener; ?>
									</label>
								</div>
								<?php } } ?>
								<button type="submit" class="btn btn-primary choosecommsave" style="display:none;"> Save </button>
							</form>
						</center>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- jQuery 3 -->
	<script src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>
	<script src="<?php echo base_url();?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url();?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="<?php echo base_url();?>assets/bower_components/fastclick/lib/fastclick.js"></script>
	<script src="<?php echo base_url();?>assets/dist/js/adminlte.min.js"></script>
	<script src="<?php echo base_url();?>assets/dist/js/demo.js"></script>
	<script type="text/javascript">
		$( document ).ready(function() {
		// Register Script
			$( "form#signupform" ).submit(function( event ) {
				event.preventDefault();
				$('.processing').html('<img src="<?php echo base_url();?>assets/images/processing.gif" style="height:80px;">'); 
				$.post("<?php echo base_url();?>index.php/welcome/signup",$("form#signupform").serialize(),function(resultdata, status) {
					$('span.text-danger').empty();
					var result=JSON.parse(resultdata);
					if(result.status == -1){
						$('.processing').html(' ');
						$.each(result.validations,function (p,q){
							$('span.'+p).text(q);
						});
					}else if((result.status == 1) && (result.response)){
						$('input').val('');
						$('.processing').html(' ');
						$('#chooselanguage').modal('show');
					}else{
						alert('Registration failed please try again.');
						location.reload();
					}
				});
			});
		});
		function resendmail(email){
			$.ajax({
				url: "<?php echo base_url();?>index.php/welcome/resendemail",
				type: 'POST',
				data: {'email':email},
				dataType: 'json',
				success: function (resultdata) {
					if(resultdata == 1){
						$('.resendmail').html('<span class="text-success">Mail sent successfully. Please check your inbox.</span>');
					}else{
						$('.resendmail').html('<span class="text-danger">Mail sent Fail. Please try again (or) Contact Us.</span>');
					}
				}
			});
		}
		function chooselanguage(choselanguage){
			$.ajax({
				url: "<?php echo base_url();?>index.php/welcome/chooselanguage",
				type: 'POST',
				data: {'choselanguage':choselanguage},
				dataType: 'json',
				success: function (resultdata) {
					if(resultdata == 1){
						$('#cslang').val(choselanguage);
						$('#chooselanguage').modal('hide');
						$('#choosecommunity').modal('show');
					}else{
					   console.log('fail');
					}
				}
			});
		}
		$( document ).ready(function() {
			var commids = [];
			$('.choosecomm').on('click', function(){
			   var chosenid = $(this).attr('id');
				if($('.checkbox'+chosenid).prop('checked')){
					commids.push(chosenid);
					$(this).removeClass('btn-default').addClass('btn-primary');
				}else if($('#'+chosenid).hasClass('btn-primary')){
					$('#'+chosenid).removeClass('btn-primary').addClass('btn-default');
					$('.checkbox'+chosenid).prop('checked',false);
				}
				var choosecommcount = $('input[name="choosecomm[]"]:checked').length;
				if(choosecommcount >= 2){
					$('.choosecommsave').css('display','block');
				}else{
					$('.choosecommsave').css('display','none');
				}
			});
			$( "form#choosecommu" ).submit(function( event ) {
				event.preventDefault();
				var choosecommcount = $('input[name="choosecomm[]"]:checked').length;
				var cslang = $('#cslang').val();
				if(choosecommcount >= 2){
					$.ajax({
						url: "<?php echo base_url();?>index.php/welcome/choosecommu",
						type: 'POST',
						data: {'commids': commids},
						success: function (resultdata) {
							if(resultdata == 1){
								location.href = "<?php echo base_url();?>index.php/welcome/home/"+cslang;
							}
						}
					});
				}else{
					$('.choosecommsave').css('display','none');
				}
			});  
		});
	</script>