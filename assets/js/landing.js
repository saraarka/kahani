//<!-- Register/ Signup  Script -->

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
	
	
    /*function resendmail(email){
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
	}*/
	
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
	
