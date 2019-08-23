<div id="snackbar"></div>
<div id="loginmodal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true"> <!-- Login Modal popup start -->
	<div class="modal-dialog msv">
		<div class="modal-content">
			<div class="modal-body">
				<div class="login-logo">
					<a href="<?php echo base_url('index.php'); ?>"><b>Story Carry</b></a>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="login-box-body" style="border-radius: 5px;border: 2px solid #e8e6e6;">
					<p class="login-box-msg">Sign in to start your session</p>
					<span class="text-danger lerror"><?php echo $this->session->flashdata('signinmsg'); ?></span>
					<form id="loginform" action="#" method="POST">
						<div class="form-group has-feedback">
							<input type="email" class="form-control" name="email" placeholder="Email">
							<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
							<span class="text-danger email"></span>
						</div>
						<div class="form-group has-feedback">
							<input type="password" class="form-control" name="password" placeholder="Password">
							<span class="glyphicon glyphicon-lock form-control-feedback"></span>
							<span class="text-danger password"></span>
						</div>
						<div class="row">
							<div class="col-xs-12">
								<center> <button type="submit" class="btn btn-primary">Sign In</button></center>
							</div>
						</div>
					</form>
					
					<div class="row"> 
						<div class="col-md-12"><center><p> - OR - </p></center></div>
						<div class="col-md-6">
							<a href="#" class="btn btn-facebook btn-block"><i class="fa fa-facebook"></i> Sign in</a>
						</div>
						<div class="col-md-6">
							<a href="#" class="btn btn-google btn-block"><i class="fa fa-google-plus"></i> Sign in</a>
						</div>
					</div> <hr>
					<div class="row">
						<div class="col-md-5">
							<a data-toggle="modal" data-target="#forgotpassmodal" data-dismiss="modal">Forgot password</a>
						</div>
						<div class="col-md-7 text-right">
							<a href="<?php echo base_url('index.php'); ?>" class="text-center">Register</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div> <!-- Login Modal popup end -->
<div class="modal fade" id="forgotpassmodal" role="dialog" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-sm" style="width: 35%;">
		<div class="modal-content">
			<div class="modal-body">
				<div class="login-logo">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4>Forgot Password ?</h4>
				</div>
				<div class="login-box-body" style="border-radius: 5px;border: 2px solid #e8e6e6;">
					<span class="text-danger ferror"><?php echo $this->session->flashdata('signinmsg'); ?></span>
					<form id="forgotpassword" action="#" method="POST">
						<div class="form-group has-feedback">
							<input type="email" class="form-control" name="femail" placeholder="Email">
							<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
							<span class="text-danger femail"></span>
						</div>
						<div class="row">
							<div class="col-xs-12">
								<center>
									<button type="submit" class="btn btn-primary">Reset Password</button>
								</center>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<style type="text/css">
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
.msv{
    width:33%;
}
@media (max-width:768px){
    .msv{
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
</style>
<script src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo base_url();?>assets/bower_components/fastclick/lib/fastclick.js"></script>
<script src="<?php echo base_url();?>assets/dist/js/adminlte.min.js"></script>
<script src="<?php echo base_url();?>assets/dist/js/demo.js"></script>
<script src="<?php echo base_url();?>assets/plugins/iCheck/icheck.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/dist/js/card/jquery-equal-height.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/dist/js/card/jquery-equal-height.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/dist/js/card/jquery-equal-height-old.js"></script>
<script src="https://flickity.metafizzy.co/flickity.pkgd.min.js"></script>
<script type="text/javascript">	
	$( "form#loginform" ).submit(function( event ) { // Login  Script
		event.preventDefault();
		$.post("<?php echo base_url();?>index.php/welcome/signin",$("form#loginform").serialize(),function(resultdata, status) {
			$('span.text-danger').empty();
			var result=JSON.parse(resultdata);
			if(result.status == -1){
				$.each(result.validations,function (p,q){
					$('span.'+p).text(q);
				});
			}else if((result.status == 1) && (result.response == 'success')){
				//alert('Login Success.');
				//location.reload();
				location.href = "<?php echo base_url();?>index.php/welcome/home";
			}else{
				$('.lerror').text('Please Enter Correct Email Id and Password.');
			}
		});
	});
	$( "form#forgotpassword" ).submit(function( event ) { // Forgot Password  Script
		event.preventDefault();
		$.post("<?php echo base_url();?>index.php/welcome/forgotpassword",$("form#forgotpassword").serialize(),function(resultdata, status) {
			$('span.text-danger').empty();
			var result=JSON.parse(resultdata);
			if(result.status == -1){
				$.each(result.validations,function (p,q){
					$('span.'+p).text(q);
				});
			}else if((result.status == 1) && (result.response == 'success')){
				$('span.ferror').text('Please Check your Email for new Password.');
				$('span.ferror').removeClass('text-danger').addClass('text-success');
				setTimeout(function(){
					$('#forgotpassmodal').modal('hide')
					location.reload()
				}, 5000);
			}else if((result.status == 2) && (result.response == 'notupdated')){
			    $('span.ferror').text('Forgot Password request Failed! Please try Again.');
			}else if((result.status == 3) && (result.response == 'nomail')){
			    $('span.ferror').text('Entered Email Id Not Found. Please check your Login Email Id.');
			}else{
				$('.ferror').text('Please Enter Correct Email Id.');
			}
		});
	});
</script>
<script type="text/javascript">
    function equal_height() {
        // Equal Card Height, Text Height and Title Height
        $('.jQueryEqualHeight1').jQueryEqualHeight('.card .card-body .card-title');
        $('.jQueryEqualHeight1').jQueryEqualHeight('.card .card-body .card-text');
        $('.jQueryEqualHeight1').jQueryEqualHeight('.card');
        
        $('.jQueryEqualHeight2').jQueryEqualHeight('.card .card-body .card-title');
        $('.jQueryEqualHeight2').jQueryEqualHeight('.card .card-body .card-text');
        $('.jQueryEqualHeight2').jQueryEqualHeight('.card');
        
        $('.jQueryEqualHeight3').jQueryEqualHeight('.card .card-body .card-title');
        $('.jQueryEqualHeight3').jQueryEqualHeight('.card .card-body .card-text');
        $('.jQueryEqualHeight3').jQueryEqualHeight('.card');
        
        $('.jQueryEqualHeight4').jQueryEqualHeight('.card .card-body .card-title');
        $('.jQueryEqualHeight4').jQueryEqualHeight('.card .card-body .card-text');
        $('.jQueryEqualHeight4').jQueryEqualHeight('.card');
        
        $('.jQueryEqualHeight5').jQueryEqualHeight('.card .card-body .card-title');
        $('.jQueryEqualHeight5').jQueryEqualHeight('.card .card-body .card-text');
        $('.jQueryEqualHeight5').jQueryEqualHeight('.card');
        
        $('.jQueryEqualHeight6').jQueryEqualHeight('.card .card-body .card-title');
        $('.jQueryEqualHeight6').jQueryEqualHeight('.card .card-body .card-text');
        $('.jQueryEqualHeight6').jQueryEqualHeight('.card');
        
        $('.jQueryEqualHeight7').jQueryEqualHeight('.card .card-body .card-title');
        $('.jQueryEqualHeight7').jQueryEqualHeight('.card .card-body .card-text');
        $('.jQueryEqualHeight7').jQueryEqualHeight('.card');
        
        $('.jQueryEqualHeightl1').jQueryEqualHeight('.card .card-body .card-title');
        $('.jQueryEqualHeightl1').jQueryEqualHeight('.card .card-body .card-text');
        $('.jQueryEqualHeightl1').jQueryEqualHeight('.card');
    }
    $(window).on('load', function(event) {
        equal_height();
    });
    $(window).resize(function(event) {
        equal_height();
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
	function readlater(id){
		$.ajax({
			type :'POST',
			url :'<?php echo base_url(); ?>index.php/welcome/readlater',
			data :{'sid':id, 'type':'readlater'},
			dataType :"json", 
			success:function(data){
                if(data == 1){
    		        $('a.readlaterbtn'+id).removeClass('btn-default').addClass('btn-primary');
    		        $('button.readlaterbtnatr'+id).attr('onclick','unreadlater('+id+')');
    		        $('.faicon'+id).removeClass('fa-bookmark').addClass('fa-check');
    		        $('#snackbar').text('Successfully added to Read later.').addClass('show');
    				setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
                }else{
                    //console.log(' Read Later Fail.');
                    $('#snackbar').text('Failed to add Read later.').addClass('show');
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
    		        $('a.readlaterbtn'+id).removeClass('btn-primary').addClass('btn-default');
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
			        $('button.subscribe').attr('onclick','unsubscribe('+id+')');
			        $('button.subscribe').removeClass('btn-success').addClass('btn-primary');
			        $('p.subscribers').text(subscribers+1+' Subscribers');
			        //console.log('subscribe success');
			        $('#snackbar').text('Successfully Subscribed Series').addClass('show');
    				setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
			    }else{
					//console.log('subscribe Fail');
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
			        $('button.subscribe').attr('onclick','subscribe('+id+')');
			        $('button.subscribe').removeClass('btn-primary').addClass('btn-success');
			        $('p.subscribers').text(subscribers-1+' Subscribers');
			        //console.log('unsubscribe success');
			        $('#snackbar').text('Successfully Unsubscribed Series').addClass('show');
    				setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
			    }else{
					//console.log('unsubscribe Fail');
					$('#snackbar').text('Fail to Unsubscribe Series').addClass('show');
    				setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
			    }
			}
		});
	}
	
	/* writerfollow writerunfollow Button and count in home page */
	function writerfollow(writer_id, writer_name) { // follow button 
        var follcount = $('#follcount'+writer_id).text();
        $.ajax({
    		type :'POST',
    		url :'<?php echo base_url(); ?>index.php/welcome/follow',
    		data :{'writer_id':writer_id, 'writer_name':writer_name},
    		dataType :"json",
    		success:function(data){
    		    if(data == 1){
    		        $('button.follow'+writer_id).text('Following');
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
    		        $('button.unfollow'+writer_id).text('Follow');
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
    		let searchParams = new URLSearchParams(window.location.search);
    		var sid = searchParams.get('id');
    		$.ajax({
    			url:'<?php echo base_url();?>index.php/welcome/rating',
    			method: 'POST',
    			data: {'rating':rating,'sid':sid},
    			dataType:'json',
    			success: function(data){
    				if(data == 1){
        				$('li > span.fa.fa-star').css('color','#333');
        				for(var x=1; x <= rating; x++) {
        				    $('li > span.fa.fa-star:nth-child('+x+')').css('color','#FFDF00');
        				}
    			    	//console.log('Rated success');
    			    	$('#snackbar').text('Rated success').addClass('show');
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
    			if(data) {
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
    			if(data) {
    			    //console.log(data);
                	$('.storysuggesttofriend').html(data);
                	$('#friendsuggest').modal('show');
              	}
            }
    	});
    }
</script>



    </body>
</html>