<link rel="stylesheet" href="<?php echo base_url();?>assets/css/modal.css">

<div id="snackbar"></div>

<!-- Login Modal popup start -->      
<div id="loginmodal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog msv">
		<div class="modal-contentv">
			<div class="modal-body">
				<div class="login-logo">
					<span class="headsvj"><b>SIGN IN</b>
					    <button type="button" class="close" data-dismiss="modal">&times;</button>
					</span>
				</div>
				<div class="login-box-body">
					<span class="text-danger lerror" style="color:red;"><?php echo $this->session->flashdata('signinmsg'); ?></span>
					<form id="loginform" action="#" method="POST" style="margin-bottom: 0;">
					    <div class="input-container has-feedback">
                            <img src="<?php echo base_url();?>assets/landing/svg/email.svg" class="icon">
                            <input class="input-field" type="email" placeholder="Email" name="email" autocomplete="off">
                        </div>
                        <span class="text-danger email" style="color:red;"></span>
                        <div class="input-container has-feedback">
                            <img src="<?php echo base_url();?>assets/landing/svg/lock.svg" class="icon">
                            <input class="input-field" type="password" placeholder="Password" name="password" autocomplete="off">
                        </div>
                        <span class="text-danger password" style="color:red;"></span>
						<div class="row">
							<div class="col-xs-12">
								<center> <button type="submit" class="btn bg-green" style="cursor:pointer;">Sign In</button></center>
							</div>
						</div>
					</form>
					
					<div class="" style="margin-bottom:5px;"> 
						<center><p class="text-centerv" style="margin:5px;"> - or - </p></center>
						<div class="flex">
						    <div style="float:left; width:49%"><button onclick="fbLogin()" id="fbLink" class="btn bg-fb" style="width:100%;cursor:pointer;">facebook</button></div>
						    <div style="width:2%"></div>
						    <div style="float:right; width:49%"><button data-onsuccess="onSignIn" class="g-signin2 btn bg-google" style="width:100%;cursor:pointer;">google</button></div>
						</div>
						<div style="margin-top:55px; border-top:1px solid rgba(221, 221, 221, 1);"></div>
					</div>
					<!--<hr style="margin-top:50px; border:1px solid rgba(221, 221, 221, 1);">-->
					<div class="">
					    <center>
					        <p class="text-centerv" style="margin:5px;">Don't have an account? 
					            <a href="#signupmodal" data-toggle="modal" data-target="#signupmodal" data-dismiss="modal" style="color:#0e92af;">Sign Up</a>
					        </p>
					        <p class="text-centerv" style="margin:5px;">or</p>
					        <p  class="text-centerv" style="margin:5px;">
					            <a href="#forgotpassmodal" data-toggle="modal" data-target="#forgotpassmodal" data-dismiss="modal" style="color:#0e92af;"> FORGOT PASSWORD</a>
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
<div class="modal fade" id="signupmodal" role="dialog" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content modal-contentv">
			<div class="modal-body">
				<div class="login-logo">
					<span class="headsvj"><b>SIGN UP</b>
					    <button type="button" class="close" data-dismiss="modal">&times;</button>
					</span>
				</div>
				<div class="login-box-body">
					<span class="text-danger lerror" style="color:red;"><?php echo $this->session->flashdata('signinmsg'); ?></span>
					<form id="signup" action="#" method="POST" style="margin-bottom: 0;">
					    <div class="input-container has-feedback">
                            <img src="<?php echo base_url();?>assets/landing/svg/user.svg" class="icon">
                            <input class="input-field" type="text" placeholder="Name" name="name">
                        </div>
                        <span class="text-danger name" style="color:red;"></span>
                        
					    <div class="input-container has-feedback">
                            <img src="<?php echo base_url();?>assets/landing/svg/email.svg" class="icon">
                            <input class="input-field" type="email" placeholder="Email" name="email">
                        </div>
                        <span class="text-danger email" style="color:red;"></span>
                        
                        <div class="input-container has-feedback">
                            <img src="<?php echo base_url();?>assets/landing/svg/lock.svg" class="icon">
                            <input class="input-field" type="password" placeholder="Password" name="password">
                        </div>
                        <span class="text-danger password" style="color:red;"></span>
                        <div class="row">
							<div class="col-xs-12">
								<center> <button type="submit" class="btn bg-green">Sign Up</button></center>
							</div>
						</div>
					</form>
					
					<div class="" style="margin-bottom:20px;"> 
						<center><p class="text-centerv" style="margin:5px;"> - or - </p></center>
						<div class="flex">
						    <div style="float:left; width:49%"><button onclick="fbLogin()" id="fbLink" class="btn bg-fb" style="width:100%">Facebook</button></div>
						    <div style="width:2%"></div>
						    <div style="float:right; width:49%"><button data-onsuccess="onSignIn" class="g-signin2 btn bg-google" style="width:100%"> Google</button></div>
						</div>
		                <center style="margin-top:50px;">
		                    <p class="text-centervv" style="margin-bottom:0;">By signing up, you agree to our <a href="" style="color:#0e92af">Terms of Use</a> and <a href="" style="color:#0e92af">Privacy Policy</a>.</p>
		                </center>
		                <div style="margin-top:5px; border-top:1px solid rgba(221, 221, 221, 1);"></div>
					</div>
					<!--<hr style="margin-top:-10px; border:1px solid rgba(221, 221, 221, 1);">-->
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
					<span class="text-danger ferror" style="color:red;"><?php echo $this->session->flashdata('signinmsg'); ?></span>
					<form id="forgotpassword" action="#" method="POST">
					    <div class="input-container has-feedback">
                            <img src="<?php echo base_url();?>assets/landing/svg/email.svg" class="icon">
                            <input class="input-field" type="email" placeholder="Email" name="femail">
                        </div>
                        <span class="text-danger femail" style="color:red;"></span>
                        <div class="row">
							<div class="col-xs-12">
								<center> <button type="submit" class="btn bg-green">Reset</button></center>
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
    <!--<div class="modal fade" id="newpasswordmodal" role="dialog" tabindex="-1" aria-hidden="true">-->
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
	<div class="modal-dialog1">
		<div class="modal-content modal-contentvl">
			<div class="modal-body">
				<div class="login-logo" style="height:50px;border:none;">
				    <center>
				        <p style="margin:0 0 10px; font-size:25px;">Welcome!</p>
					    <span class="heads" style="text-transform:uppercase;font-size:1em">
					        <b>Select Your Preferred reading language</b>
					    </span>
					</center>
				</div>
				<div class="login-box-body" style="margin-top:20px; max-height:256px; overflow-y:scroll;">
					<form id="lang" action="#" method="POST" style="margin-bottom: 0;">
					    <div class="pt10" style="display:flex; flex-wrap:wrap; justify-content:center;">
					        <?php if(isset($languages) && ($languages->num_rows() >0)) { 
							foreach ($languages->result() as $language) { ?>
								<a href="javascript:void(0);" class="community-btn" onclick="chooselanguage('<?php echo $language->code;?>')">
								    <?php echo strtoupper($language->language); ?>
								</a>
    						<?php } } ?>
        				</div>
					</form>
				</div>
				<div style="margin-top:18px;">
				    <center>
				        <a href="javascript:void(0);" class="btn-next">NEXT</a>
				    </center>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Languages list Modal popup when first time signup end -->

<!-- Community(Geners) list Modal popup when first time signup start -->
<div class="modal fade" id="choosecommunity" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog1">
		<div class="modal-content modal-contentvl">
			<div class="modal-body">
				<div class="login-logo" style="height:50px;border:none;">
				    <center>
				        <p style="margin:0 0 10px; font-size:25px;">Welcome!</p>
					<span class="heads"><b>Select 2 or more preferred genres</b>
					</span>
					</center>
				</div>
				<form id="choosecommu" method="POST">
    				<div class="login-box-body" style="margin-top:20px; max-height:256px; overflow-y:scroll;">
    				    <div class="pt10" style="display:flex; flex-wrap:wrap; justify-content:center;">
						<?php if(isset($gener) && ($gener->num_rows() > 0)){ foreach($gener->result() as $generrow) { ?>
							<label class="btn-default community-btn choosecomm" id="<?php echo $generrow->id;?>" style="padding:6px 2px;">
								<input type="checkbox" class="checkbox<?php echo $generrow->id;?>" style="float:left;display:none;" name="choosecomm[]" value="<?php echo $generrow->id;?>" style="visibility:hidden;"><?php echo $generrow->gener; ?>
							</label>
						<?php } } ?>
        				</div>
    				</div>
    				<div style="margin-top:18px;">
    				    <center>
    				        <button type="submit" class="btn-next choosecommsave" style="color:#bcb2b2; background:#eee;"> NEXT </button>
    				    </center>
    				</div>
    				<!--<div style="margin-top:18px;">
    				    <center>
    				        <button type="submit" class="btn-next choosecommsave" style="display:none;"> NEXT </button>
    				    </center>
    				</div>-->
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
		                <p class="text-centervv" style="margin-bottom:0;">By signing up, you agree to our <a href="" style="color:#0e92af">Terms of Use</a> and <a href="" style="color:#0e92af">Privacy Policy</a>.</p>
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


<!-- Write Modal popup start -->      
<div id="writeapp" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-contentv">
			<div class="modal-body">
				<div class="login-logo">
					<span class="headsvj"><b>TO START WRITING</b>
					    <button type="button" class="close" data-dismiss="modal">&times;</button>
					</span>
				</div>
				<div class="">
					<center>
					    INSTALL OUR APP <br>
					    <a href=""><img src="<?php echo base_url();?>assets/landing/storycarry app.png" /></a><br>
					    Or<br>
					    OPEN SITE ON DESKTOP
					</center>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Write Modal popup end -->

<!--<script src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>-->
<script src="<?php echo base_url();?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/dist/js/adminlte.min.js"></script>

<!--<script src="<?php echo base_url();?>assets/js/footer.js"></script>
<?php if(!isset($this->session->userdata['logged_in']['user_id'])){ ?>
<script>
    $(document).ready(function(){
        $(".notloginmodal").click(function(){
            $('#notloginmodal').trigger('click');
        });
    });
</script>
<?php } ?>
-->


<script type="text/javascript"> // modal popup Language start
/*	$( document ).ready(function() {
	    //var slanguage = $('input[name="language"]').val();
		//var slanguage = $('select[name="language"] option:selected').val();
		if(slanguage){ }else{
			languages();
		}
	}); */
	function languages(){
		$.post("<?php echo base_url();?>welcome/languages",function(resultdata,status){
			var result=JSON.parse(resultdata);
			var languageslist = '<option value=""> Select Language </option>';
			if(result.status == 1){
				$.each(result.response,function (p,q){
					languageslist+= '<option value="'+q.code+'">'+q.language+'</option>';
				});
				$('select[name="language"]').html(languageslist);
			}else{
				$('select[name="language"]').html('<option value=""> No Languages Were Found. </option>');
			}
			$("#myModallang").modal({
			    backdrop: 'static',
			    keyboard: false,
			    show: true
			})
		});
	}
	function selectlang(language){
		$.ajax({
			type :'POST',
			url :'<?php echo base_url();?>welcome/selectlang/'+language,
			success:function(data){
			    if(data == 1){
			        $('input[name="language"]').val(language);
			        location.reload();
			    }else{
			        location.href = "<?php echo base_url();?>";
			    }
			}
		});
	}
</script>

<script type="text/javascript">	
	$( "form#signup" ).submit(function( event ) {
		event.preventDefault();
		$('.processing').html('<img src="<?php echo base_url();?>assets/images/processing.gif" style="height:80px;">'); 
		$.post("<?php echo base_url();?>index.php/welcome/signup",$("form#signup").serialize(),function(resultdata, status) {
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
	
	//// Login  Script	
	$( "form#loginform" ).submit(function( event ) {
		event.preventDefault();
		$.post("<?php echo base_url();?>index.php/welcome/signin",$("form#loginform").serialize(),function(resultdata, status) {
			$('span.text-danger').empty();
			var result=JSON.parse(resultdata);
			if(result.status == -1){
				$.each(result.validations,function (p,q){
					$('span.'+p).text(q);
				});
			}else if((result.status == 1) && (result.response == 'success')){
				//location.reload();
				location.href = "<?php echo base_url();?>home";
			}else if((result.status == 1) && (result.response.res == 'nolanguage') && (result.response.userid)){
			    $('#userid').val(result.response.userid);
			    $('#chooselanguage').modal('show');
			}else if((result.status == 1) && (result.response.res == 'nocommunities') && (result.response.userid)){
			    $('#userid').val(result.response.userid);
			    $('#choosecommunity').modal('show');
			}else{
				$('.lerror').text('Please Enter Correct Email Id and Password.');
			}
		});
	});
	
	// Forgot Password  Script
	$( "form#forgotpassword" ).submit(function( event ) {
		event.preventDefault();
		$.post("<?php echo base_url();?>forgotpassword",$("form#forgotpassword").serialize(),function(resultdata, status) {
			$('span.text-danger').empty();
			var result=JSON.parse(resultdata);
			if(result.status == -1){
				$.each(result.validations,function (p,q){
					$('span.'+p).text(q);
				});
			}else if((result.status == 1) && (result.response > 0)){
			    $('#fpwduserid').val(result.response);
			    $('#forgotpassmodal').modal('hide');
				//$('#newpasswordmodal').modal('show');
				$('#snackbar').text('Please check Your Email Inbox for new Password').addClass('show');
    	        setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
			}else if((result.status == 2) && (result.response == 'fail')){
			    $('#snackbar').text('The Email Id Entered is not found.').addClass('show');
    	        setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
			}else{
				$('.ferror').text('Please Enter Correct Email Id.');
			}
		});
	});
	
	// Forgot Password  new pwd Script
	$( "form#newpasswordform" ).submit(function( event ) {
		event.preventDefault();
		$.post("<?php echo base_url();?>newpassword",$("form#newpasswordform").serialize(),function(resultdata, status) {
			$('span.text-danger').empty();
			var result=JSON.parse(resultdata);
			if(result.status == -1){
				$.each(result.validations,function (p,q){
					$('span.'+p).text(q);
				});
			}else if((result.status == 1) && (result.response == 'success')){
				$('#snackbar').text('Change Password Success. Please Login').addClass('show');
    	        setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
				/*setTimeout(function(){
					$('#newpasswordmodal').modal('hide')
					location.reload()
				}, 3100);*/
				setTimeout(function(){
					location.href = "<?php echo base_url();?>";
				}, 3100);
			}else if((result.status == 2) && (result.response == 'fail')){
			    $('#snackbar').text('Failed to change Password.').addClass('show');
    	        setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
			}else if((result.status == 3) && (result.response == 'notmatch')){
				$('.nerror').text('New Password and Confirm New Password not matched.');
			}else{
			    $('.nerror').text('Somthing Wrong... Try Again');
			    setTimeout(function(){
					$('#newpasswordmodal').modal('hide')
					location.reload()
				}, 2000);
			}
		});
	});
	
	//Sign up choose language
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
	//Sign up select and deselect community
	$( document ).ready(function() {
		var commids = [];
		$('.choosecomm').on('click', function(){
		   var chosenid = $(this).attr('id');
			if($('.checkbox'+chosenid).prop('checked')){
				commids.push(chosenid);
				$(this).removeClass('btn-default').addClass('btn-primary').css('background','#3c8dbc');
			}else if($('#'+chosenid).hasClass('btn-primary')){
				$('#'+chosenid).removeClass('btn-primary').addClass('btn-default').css('background','#eee');
				$('.checkbox'+chosenid).prop('checked',false);
			}
			var choosecommcount = $('input[name="choosecomm[]"]:checked').length;
			if(choosecommcount >= 2){
				$('.choosecommsave').css('display','block');
			}else{
				$('.choosecommsave').css('display','none');
			}
		});
		
		//Sign up choose communities
		$( "form#choosecommu" ).submit(function( event ) {
			event.preventDefault();
			var choosecommcount = $('input[name="choosecomm[]"]:checked').length;
			var cslang = $('#cslang').val();
			var userid = $('#userid').val();
			if(choosecommcount >= 2){
				$.ajax({
					url: "<?php echo base_url();?>index.php/welcome/choosecommu",
					type: 'POST',
					data: {'commids': commids, 'cslang': cslang, 'userid':userid },
					success: function (resultdata) {
						if(resultdata == 1){
							location.href = "<?php echo base_url();?>home/"+cslang;
						}
					}
				});
			}else{
				$('.choosecommsave').css('display','none');
			}
		});  
	});
	
	$( "form#socialfbg" ).submit(function( event ) {
		event.preventDefault();
		$('.processing').html('<img src="<?php echo base_url();?>assets/images/processing.gif" style="height:80px;">'); 
		$.post("<?php echo base_url();?>index.php/welcome/socialfbg",$("form#socialfbg").serialize(),function(resultdata, status) {
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
				$('#socialfbgmodal').modal('hide');
				$('#chooselanguage').modal('show');
			}else{
				alert('Registration failed please try again.');
			//	location.reload();
			}
		});
	});
	
</script>


<?php if(!isset($this->session->userdata['logged_in']['user_id'])){ ?>
<script>
    $(document).ready(function(){
        $(".notloginmodal").click(function(){
            $('#notloginmodal').trigger('click');
        });
    });
</script>
<?php } ?>


<!-- Read Later Button status readlater -->
<script type="text/javascript">
    function yoursreadlater(){
        $('#snackbar').text('You Can not read later the Story').addClass('show');
    	setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
    }
	function readlater(id){
		$.ajax({
			type :'POST',
			url :'<?php echo base_url(); ?>index.php/welcome/readlater',
			data :{'sid':id, 'type':'readlater'},
			dataType :"json", 
			success:function(data){
                if(data == 1){
    		        //$('a.readlaterbtn'+id).removeClass('read').addClass('readdone');
    		        $('button.readlaterbtnatr'+id).removeClass('read').addClass('readdone');
    		        $('button.readlaterbtnatr'+id).attr('onclick','unreadlater('+id+')');
    		        $('.faicon'+id).removeClass('fa-bookmark').addClass('fa-check');
    		        $('#snackbar').text('Successfully added to Read later.').addClass('show');
    				setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
                }else{
                    //console.log(' Read Later Fail.');
                    //$('#snackbar').text('Failed to add Read later.').addClass('show');
    				setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
                }
			}
		});
	}
	function unreadlater(id){
		$.ajax({
			type :'POST',
			url :'<?php echo base_url(); ?>index.php/welcome/readlater',
			data :{'sid':id, 'type':'readlater'},
			dataType :"json", 
			success:function(data){
                if(data == 2){
    		        //$('a.readlaterbtn'+id).removeClass('readdone').addClass('read');
    		        $('button.readlaterbtnatr'+id).removeClass('readdone').addClass('read');
    		        $('button.readlaterbtnatr'+id).attr('onclick','readlater('+id+')');
    		        $('.faicon'+id).removeClass('fa-check').addClass('fa-bookmark');
    		        $('#snackbar').text('Successfully removed from Read later.').addClass('show');
    				setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
                }else{
                    //console.log(' Unread Fail. ');
                    $('#snackbar').text('Failed to remove from Read later.').addClass('show');
    				setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
                }
			}
		});
	}
	
	/* Favorite Button status favorite */
	function favorite(id){
	    var favcount = parseInt($('.favcount').text());
		$.ajax({
			type :'POST',
			url :'<?php echo base_url(); ?>index.php/Welcome/readlater',
			data :{'sid':id, 'type':'favorite'},
			dataType :"json",
			success:function(data){
			    if(data == 1){
			        $('.favbtn').css('color','#ff0000');
			        $('i.fa.fa-2x.fa-heart-o.favbtn').addClass('fa-heart').removeClass('fa-heart-o');
			        $('span.favbtn'+id).attr('onclick','unfavorite('+id+')');
			        favocount = favcount+1;
			        $('.favcount').html(favocount);
                    //console.log('Favorite Success');
                    $('#snackbar').text('Successfully added to Favorites.').addClass('show');
    				setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
			    }else{
			        //console.log('Favorite Fail');
			        $('#snackbar').text('failed to add Favorites.').addClass('show');
    				setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
			    }
			}
		});
	}
	function unfavorite(id){
	    var favcount = parseInt($('.favcount').text());
		$.ajax({
			type :'POST',
			url :'<?php echo base_url(); ?>index.php/Welcome/readlater',
			data :{'sid':id, 'type':'favorite'},
			dataType :"json",
			success:function(data){
			    if(data == 2){
			        $('.favbtn').css('color','#333');
			        $('i.fa.fa-heart.favbtn').addClass('fa-heart-o fa-2x').removeClass('fa-heart');
			        $('span.favbtn'+id).attr('onclick','favorite('+id+')');
			        favocount = favcount-1;
			        $('.favcount').html(favocount);
                    //console.log('Unfavorite Success');
                    $('#snackbar').text('Successfully removed from Favorites.').addClass('show');
    				setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
			    }else{
			        //console.log('Unfavorite Fail');
			        $('#snackbar').text('Fail to remove from Favorites.').addClass('show');
    				setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
			    }
			}
		});
	}
	
	function yoursfavorite(){
	     $('#snackbar').text('You Can not favorite the Story.').addClass('show');
    	 setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
	}
	
	/* Subscribe Button status seriessubscribe */
	function subscribe(id){
        var subscribers = parseInt($('p.subscribers').text());
		$.ajax({
			type :'POST',
			url :'<?php echo base_url(); ?>index.php/welcome/readlater',
			data :{'sid':id, 'type':'seriessubscribe'},
			dataType :"json",
			success:function(data){
			    if(data == 1){
			        $('.subscribe').text('SUBSCRIBED');
			        $('.subscribe').attr('onclick','unsubscribe('+id+')');
			        $('.subscribe').removeClass('btn-success').addClass('btn-primary');
			        $('p.subscribers').text(subscribers+1+' SUBSCRIBERS');
			        $('#snackbar').text('Successfully Subscribed Series').addClass('show');
    				setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
			    }else{
					$('#snackbar').text('Failed to Subscribed Series').addClass('show');
    				setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
			    }
			}
		});
	}
	function unsubscribe(id){
	    var subscribers = parseInt($('p.subscribers').text());
		$.ajax({
			type :'POST',
			url :'<?php echo base_url(); ?>index.php/welcome/readlater',
			data :{'sid':id, 'type':'seriessubscribe'},
			dataType :"json",
			success:function(data){
			    if(data == 2){
			        $('.subscribe').text('SUBSCRIBE');
			        $('.subscribe').attr('onclick','subscribe('+id+')');
			        $('.subscribe').removeClass('btn-primary').addClass('btn-success');
			        $('p.subscribers').text(subscribers-1+' SUBSCRIBERS');
			        $('#snackbar').text('Successfully Unsubscribed Series').addClass('show');
    				setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
			    }else{
					$('#snackbar').text('Fail to Unsubscribe Series').addClass('show');
    				setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
			    }
			}
		});
	}
	
	/* writerfollow writerunfollow Button and count in home page */
	function yoursfollow(){
	    $('#snackbar').text('You Can not Follow the Writer.').addClass('show');
    	setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
	}
	function writerfollow(writer_id, writer_name) { // follow button 
        var follcount = $('#follcount'+writer_id).text();
        $.ajax({
    		type :'POST',
    		url :'<?php echo base_url(); ?>index.php/welcome/follow',
    		data :{'writer_id':writer_id, 'writer_name':writer_name},
    		dataType :"json",
    		success:function(data){
    		    if(data == 1){
    		        $('button.follow'+writer_id).text('FOLLOWING');
    		        $('button.follow'+writer_id).removeClass('btn-success').addClass('btn-primary');
    		        $('button.follow'+writer_id).attr('onclick','writerunfollow('+writer_id+',"'+writer_name+'")');
    		        $('button.follow'+writer_id).removeClass('follow'+writer_id).addClass('unfollow'+writer_id);
    			    var followcount = parseInt(follcount)+1;
    			    $('#follcount'+writer_id).text(followcount);
    			    //console.log('writerfollow success');
    			    $('#snackbar').text('Follow success').addClass('show');
    				setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
    			}else{
    				//console.log('writerfollow fail');
    				$('#snackbar').text('Follow fail').addClass('show');
    				setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
    			}
    		}
    	});
    }
    function writerunfollow(writer_id, writer_name) { // unfollow button 
        var follcount = $('#follcount'+writer_id).text();
        $.ajax({
    		type :'POST',
    		url :'<?php echo base_url(); ?>index.php/welcome/follow',
    		data :{'writer_id':writer_id, 'writer_name':writer_name},
    		dataType :"json",
    		success:function(data){
    		    if(data == 2){
    		        $('button.unfollow'+writer_id).text('FOLLOW');
    		        $('button.unfollow'+writer_id).removeClass('btn-primary').addClass('btn-success');
    		        $('button.unfollow'+writer_id).attr('onclick','writerfollow('+writer_id+',"'+writer_name+'")');
    		        $('button.unfollow'+writer_id).removeClass('unfollow'+writer_id).addClass('follow'+writer_id);
    			    var followcount = parseInt(follcount)-1;
    			    $('#follcount'+writer_id).text(followcount);
    			    //console.log('writerunfollow success');
    				$('#snackbar').text('Unfollow success').addClass('show');
    				setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
    			}else{
    				//console.log('writerunfollow fail');
    				$('#snackbar').text('Unfollow fail').addClass('show');
    				setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
    			}
    		}
    	});
    }
</script>

<!-- Rating to all stories -->
<script type="text/javascript">
    $( document ).ready(function() {
    	$("input[name='star']").click(function(){
    		var rating = $(this).val();
    		var sid = "<?php echo $_GET['id'];?>";
    		$.ajax({
    			url:'<?php echo base_url();?>index.php/welcome/rating',
    			method: 'POST',
    			data: {'rating':rating,'sid':sid},
    			dataType:'json',
    			success: function(data){
    				if(data.status == 1){
    				    var ratinghtml = '';
    				    if((data.rating)) {
							var starNumber = (data.rating).split('.');
							for(var x=1;x<=starNumber[0];x++) {
								ratinghtml+='<span class="fa fa-star checked" style="color:rgb(60, 141, 188);padding-right:5px;" title="'+x+'"></span>';
							} if((starNumber[1])) { if (starNumber[1] != 0) {
								ratinghtml+='<span class="fa fa-star-half-full checked" style="color:rgb(60, 141, 188);padding-right:5px;" title="'+data.rating+'"></span>';
							x++;} } 
							var abcd = ''; if(starNumber[0] <= 0){ } 
							while (x<=5) { ratinghtml+='<span class="fa fa-star-o checked" style="color:rgb(60, 141, 188);padding-right:5px;"></span>';x++;}
						}
			            $('.ratingli').html(ratinghtml);
        				//$('li > span.fa.fa-star').css('color','#333');
        				//$('li > span.fa.fa-star').removeClass('fa-star').addClass('fa-star-o');
        			    /* $('li > span.fa.fa-star').removeClass('fa-star').addClass('fa-star-o');
        				for(var x=1; x <= rating; x++) {
        				    $('li > span.fa.fa-star-o:nth-child('+x+')').removeClass('fa-star-o').addClass('fa-star');
        				    $('li > span.fa.fa-star:nth-child('+x+')').css('color','#3c8dbc');
        				}*/
    			    	$('#snackbar').text('Rated Successfully').addClass('show');
    				    setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
    				}
    			}
    		})
    	});
    });
</script>

<!-- Suggest story to group for reading -->
<script type="text/javascript">
    function groupsuggest(id){
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>index.php/welcome/get_story_groupdata",
            data: {'id': id},
            success: function(data) {
                if(data == 'notlogin'){
                    $('#notloginmodal').trigger('click');
                    $('#groupsuggest').removeClass('in');
                    $('#groupsuggest').css('display', 'block');
    			}else if(data) {
    			    $('.storysuggesttogroup').html(data);
                	$('#groupsuggest').modal('show');
              	}
            }
    	});
    }
    
    function friend(id){
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>index.php/welcome/get_story_data",
            data: {'id':id},
            success: function(data) {
                if(data == 'notlogin'){
                    $('#notloginmodal').trigger('click');
                    $('#friendsuggest').removeClass('in');
                    $('#friendsuggest').css('display', 'block');
    			}else if(data) {
                	$('.storysuggesttofriend').html(data);
                	$('#friendsuggest').modal('show');
              	}
            }
    	});
    }
    
    function socialshare(id, seristorytype) {
        var seurl = '';
        if(seristorytype == "series") {
            seurl = "<?php echo base_url();?>new_series?id="+id+"&story_id="+id;
        }else if(seristorytype == "story") {
            seurl = "<?php echo base_url();?>only_story_view?id="+id;
        }else{
            seurl = "<?php echo base_url();?>";
        }
        $('.facebookshare').attr('onClick',"javascript:genericSocialShare('http://www.facebook.com/sharer.php?u="+encodeURIComponent(seurl)+"')");
        $('.whatsappshare').attr('onClick',"javascript:genericSocialShare('https://api.whatsapp.com/send?text="+encodeURIComponent(seurl)+"')");
        $('.twittershare').attr('onClick',"javascript:genericSocialShare('http://twitter.com/share?text="+encodeURIComponent(seurl)+"')");
        $('#copylinkshare').val(seurl);
    }
</script>

<script>
    /* nano story onclick model open increment views */
    function nanoviewsadd(sid){
        var nanoviewcount = $('.nanoviewcount'+sid).text();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>index.php/welcome/nanoviewsadd",
            data: {'sid':sid},
            success: function(data) {
    			if(data == 1) {
    			    $('.nanoviewcount'+sid).text(parseInt(nanoviewcount)+1);
    			    console.log('view incremented');
              	}
            }
    	});
    }
    
    function nanolike(storyid){
	    //var nanolikecount = $('span.nanolikecount'+storyid).html();
	    var nanolikecount = parseInt($('.nanolikecount'+storyid).text());
		$.ajax({
			type :'POST',
			url :'<?php echo base_url(); ?>index.php/welcome/nanolike/'+storyid,
			dataType :"json",
			success:function(data){
			    if(data == 1){
			        $('.favsbtn').css('color','#ff0000');
			        $('i.fa.fa-x.fa-heart-o.favsbtn').addClass('fa-heart').removeClass('fa-heart-o');
			        $('span.favsbtn'+storyid).attr('onclick','nanodislike('+storyid+')');
			        nanolikecount = nanolikecount+1;
			        $('.nanolikecount').html(nanolikecount);
                    //console.log('like Success');
                    $('#snackbar').text('You Liked Nano story.').addClass('show');
    				setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
			    }else{
			        //console.log('like Fail');
			        $('#snackbar').text('Failed to Like your Nano story.').addClass('show');
    				setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
			    }
			}
		});
	}
	
	function nanodislike(storyid){
	    //var nanolikecount = $('span.nanolikecount'+storyid).html();
	    var nanolikecount = parseInt($('.nanolikecount'+storyid).text());
		$.ajax({
			type :'POST',
			url :'<?php echo base_url(); ?>index.php/welcome/nanolike/'+storyid,
			dataType :"json",
			success:function(data){
			    console.log(data);
			    if(data == 2){
			        $('.favsbtn').css('color','#333');
			        $('i.fa.fa-heart.favsbtn').addClass('fa-heart-o fa-x').removeClass('fa-heart');
			        $('span.favsbtn'+storyid).attr('onclick','nanolike('+storyid+')');
			        nanolikecount = nanolikecount-1;
			        console.log('nanolikecount');
			        $('.nanolikecount').html(nanolikecount);
                    //console.log('Unlike Success');
                    $('#snackbar').text('You DisLiked Nano story.').addClass('show');
    				setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
			    }else{
			        //console.log('Unlike Fail');
			        $('#snackbar').text('Fail to remove Like your Nano story.').addClass('show');
    				setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
			    }
			}
		});
	}
	
    
    /*function nanolike(storyid){ // Nano story likes
        var nanolikecount = $('span.nanolikecount'+storyid).html();
        $.ajax({
    		type :'POST',
    		url :'<?php echo base_url(); ?>index.php/welcome/nanolike/'+storyid,
    		dataType :"json",
    		success:function(data){
    		    //console.log(data.length);
    		    if(data == 1){
    		        $('.nanolike'+storyid).css('color','#ff0000');
    		        $('i.fa.fa-2x.fa-heart-o.favsbtn').addClass('fa-heart').removeClass('fa-heart-o');
    		        $('span.nanolikecount'+storyid).html(parseInt(nanolikecount)+1);
    			    $('#snackbar').text('You Liked Nano story.').addClass('show');
    				setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
    			}else{
    			    $('#snackbar').text('Failed to Like your Nano story.').addClass('show');
    				setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
    			}
    		}
    	});
    }
    
    function nanodislike(storyid){ // Nano story dis likes
        var nanolikecount = $('span.nanolikecount'+storyid).html();
        $.ajax({
    		type :'POST',
    		url :'<?php echo base_url(); ?>index.php/welcome/nanolike/'+storyid,
    		dataType :"json",
    		success:function(data){
    		    if(data == 0){
    		        $('.nanolike'+storyid).css('color','#777');
    		        $('i.fa.fa-heart.favsbtn').addClass('fa-heart-o fa-x').removeClass('fa-heart');
    		        $('span.nanolikecount'+storyid).html(parseInt(nanolikecount)-1);
    			    $('#snackbar').text('You DisLiked Nano story.').addClass('show');
    				setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
    			}else{
    			    $('#snackbar').text('Failed to remove Like your Nano story.').addClass('show');
    				setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
    			}
    		}
    	});
    }*/
</script>

<script>
    function reportstories(userid, storyid){ // Report for stories, life etc
        $('#reportuserid').val(userid);
        $('#reportstoryid').val(storyid);
        $('#reportstories').modal('show');
    }
    function reportseries(userid, storyid){ // Report for series
        $('#reportuserid').val(userid);
        $('#reportstoryid').val(storyid);
        $('#reportstorytype').val('series');
        $('#reportstories').modal('show');
    }
    function reportstoriesdiv(){
        var userid = $('#reportuserid').val();
        var storyid = $('#reportstoryid').val();
        var type = $('#reportstorytype').val();
        var reportmsg = $('#reportmsg').val();
        $.ajax({
    		type :'POST',
    		url :'<?php echo base_url(); ?>index.php/welcome/reportstories',
    		data: {'reportcmt':reportmsg, 'report_storyid':storyid, 'report_userid':userid, 'type':type},
    		success:function(data){
    		    if(data == 1){
    			    $('#snackbar').text('Successfully Reported.').addClass('show');
    				setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
    				$('#reportstories').modal('hide');
    			}else if(data == 2){
    			    $('#snackbar').text('Please Enter Report Text.').addClass('show');
    				setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
    			}else{
    			    $('#snackbar').text('Failed to Report. Try Again').addClass('show');
    				setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
    				location.reload();
    			}
    		}
    	});
    }
    function yourscommpostlike(){
        $('#snackbar').text('You Can not Like the Story').addClass('show');
    	setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
    }
    function ongoingcomplet(sid){
        $('#yesongoingcomplet').attr('onClick','yesongoingcomplet('+sid+')');
        $('#noongoingcomplet').attr('onClick','noongoingcomplet('+sid+')');
        $('#ongoingcomplet').modal('show');
    }
    function yesongoingcomplet(sid){
        $.ajax({
    		type :'POST',
    		url :'<?php echo base_url(); ?>index.php/welcome/ongoingcomplet',
    		data: {'sid':sid},
    		success:function(data){
    		    if(data == 1){
    		        $('span#octext').text('Completed');
    		        $('#ongoingcomplet').modal('hide');
    		    }else{
    		        $('#ongoingcomplet').modal('hide');
    		    }
    		}
        });
    }
    function noongoingcomplet(sid){
        $('#ongoingcomplet').modal('hide');
    }
</script>


    </body>
</html>