
    $(document).on('show.bs.modal', '.modal', function () {
        // run your validation... ( or shown.bs.modal )
        $('body').css('overflow', 'hidden');
    });
    $(document).on('hide.bs.modal', '.modal', function () {
        $('body').css('overflow', 'auto');
    });
    
    $(document).ready(function() {
        $("a").click(function() {
            $('span.text-danger').empty();
        });
    });


/* Register/ Signup  Script */

	$( "form#signup" ).submit(function( event ) {
		event.preventDefault();
		$('span.text-danger').empty();
        $.ajax({
            type: 'POST',
            url: base_url+"welcome/signup",
            data: $("form#signup").serialize(),
            beforeSend: function() {
                $('.btnsignupspinner').html('<img src="'+base_url+'assets/landing/svg/spinner.svg" class="spinner">');
            },
            success: function(resultdata, status) {
                $('.btnsignupspinner').html('Sign Up');
                var result=JSON.parse(resultdata);
    			if(result.status == -1){
    				$.each(result.validations,function (p,q){
    					$('span.'+p).text(q);
    				});
    			}else if((result.status == 1) && (result.response)){
    				$('input').val('');
    				$('#userid').val(result.response);
    				$('#signupmodal').modal('hide');
    				$('#chooselanguage').modal('show');
    			}else{
    				console.log('Registration failed please try again.');
    				location.reload();
    			}
            }
		});
	});	
	
	//// Login  Script	
	$( "form#loginform" ).submit(function( event ) {
		event.preventDefault();
		$.post(base_url+"welcome/signin",$("form#loginform").serialize(),function(resultdata, status) {
			$('span.text-danger').empty();
			var result=JSON.parse(resultdata);
			if(result.status == -1){
				$.each(result.validations,function (p,q){
					$('span.'+p).text(q);
				});
			}else if((result.status == 1) && (result.response == 'success')){
			    $('.btnspinner').html('<img src="'+base_url+'assets/landing/svg/spinner.svg" class="spinner">');
				if(result.preferedlang){
				    location.href = base_url+result.preferedlang;
				}else{
				    location.href = base_url+"english";
				}
			}else if((result.status == 1) && (result.response.res == 'nolanguage') && (result.response.userid)){
			    $('.btnspinner').html('<img src="'+base_url+'assets/landing/svg/spinner.svg" class="spinner">');
			    $('#userid').val(result.response.userid);
			    $('#chooselanguage').modal('show');
			}else if((result.status == 1) && (result.response.res == 'nocommunities') && (result.response.userid)){
			    $('.btnspinner').html('<img src="'+base_url+'assets/landing/svg/spinner.svg" class="spinner">');
			    $('#userid').val(result.response.userid);
			    $('#cslang').val(result.response.writerlang);
			    $('#choosecommunity').modal('show');
			}else{
				$('.lerror').text('Incorrect Email id or Password.');
			}
		});
	});
	
	// Forgot Password  Script
	$( "form#forgotpassword" ).submit(function( event ) {
		event.preventDefault();
		$('.forgotpwdresendbtn').html('<img src="'+base_url+'assets/landing/svg/spinner.svg" class="spinner">');
		$.post(base_url+"forgotpassword",$("form#forgotpassword").serialize(),function(resultdata, status) {
			$('span.text-danger').empty();
			var result=JSON.parse(resultdata);
			if(result.status == -1){
				$.each(result.validations,function (p,q){
					$('span.'+p).text(q);
				});
			}else if((result.status == 1) && (result.response > 0)){
			    $('#fpwduserid').val(result.response);
    	        $('#forgotpassword').css('visibility','hidden');
    	        $('#forgotpassword').css('margin-top','-35px');
    	        $('.ferrorresend').html('<div style="display:flex; justify-content:center;font-weight:400"><h3 style="font-family: arial, sans-serif;">EMAIL SENT</h3>'+
    	        '<img src="'+base_url+'assets/landing/svg/check-circle-solid.svg" style="height:16px; padding: 21px 0px 0px 10px;"></div>');
    	        $('.forgotpwdresendbtn').text('RESEND').css('visibility','visible');
			}else if((result.status == 2) && (result.response == 'fail')){
			    $('#snackbar').text('The Email Id Entered is not found.').addClass('show');
    	        setTimeout(function(){ $('#snackbar').removeClass('show'); }, 5000);
			}else{
				$('.ferror').text('Please Enter Correct Email Id.');
			}
		});
	});
	
	// Forgot Password  new pwd Script
	$( "form#newpasswordform" ).submit(function( event ) {
		event.preventDefault();
		$.post(base_url+"newpassword",$("form#newpasswordform").serialize(),function(resultdata, status) {
			$('span.text-danger').empty();
			var result=JSON.parse(resultdata);
			if(result.status == -1){
				$.each(result.validations,function (p,q){
					$('span.'+p).text(q);
				});
			}else if((result.status == 1) && (result.response == 'success')){
			    $('.cpwdspinnerbtn').html('<img src="'+base_url+'assets/landing/svg/spinner.svg" class="spinner">');
			    $('#snackbar.show').css('z-index', '1111');
				$('#snackbar').text('Change Password Success. Please Login').addClass('show');
    	        setTimeout(function(){ $('#snackbar').removeClass('show'); }, 5000);
				setTimeout(function(){
					location.href = base_url;
				}, 3100);
			}else if((result.status == 2) && (result.response == 'fail')){
			    $('#snackbar').text('Failed to change Password.').addClass('show');
    	        setTimeout(function(){ $('#snackbar').removeClass('show'); }, 4000);
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
	
	function chooselangbtn(lang){
	    if(lang){
    	    $('#cslang').val(lang);
    	    $('.langbtn').css('background','#eee');
    	    $('.langbtn').css('color','#000');
    	    $('.'+lang).css('background','#3c8dbc');
    	    $('.'+lang).css('color','#fff');
    	    $('.chooselanguagebtn').css('color','#fff');
    	    $('.chooselanguagebtn').css('background','#3c8dbc');
	    }
	}
	
	//Sign up choose language
	function chooselanguage(){
	    var choselanguage = $('#cslang').val();
        if(choselanguage){
            $('.btnlangspin').html('<img src="'+base_url+'assets/landing/svg/spinner.svg" class="spinner">');
        }
	    var userid = $('#userid').val();
		$.ajax({
			url: base_url+"welcome/chooselanguage",
			type: 'POST',
			data: {'choselanguage':choselanguage, 'userid' : userid},
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
				$(this).removeClass('btn-default').addClass('btn-primary').css({"background":"#3c8dbc", "color": "#fff"});
			}else if($('#'+chosenid).hasClass('btn-primary')){
				$('#'+chosenid).removeClass('btn-primary').addClass('btn-default').css({"background":"#eee", "color":"#000"});
				$('.checkbox'+chosenid).prop('checked',false);
			}
			var choosecommcount = $('input[name="choosecomm[]"]:checked').length;
			if(choosecommcount >= 2){
				$('.choosecommsave').css({"display":"block", "background":"#3c8dbc", "color": "white"});
			}else{
				$('.choosecommsave').css({"display":"block!important", "background":"#eee", "color": "#bcb2b2"});
			}
		});
		
		//Sign up choose communities
		$( "form#choosecommu" ).submit(function( event ) {
			event.preventDefault();
			var choosecommcount = $('input[name="choosecomm[]"]:checked').length;
			var cslang = $('#cslang').val();
			var userid = $('#userid').val();
			if(choosecommcount >= 2){
			    $('.btncommspin').html('<img src="'+base_url+'assets/landing/svg/spinner.svg" class="spinner">');
				$.ajax({
					url: base_url+"welcome/choosecommu",
					type: 'POST',
					data: {'commids': commids, 'cslang': cslang, 'userid':userid },
					success: function (resultdata) {
						if((resultdata != 1) || (resultdata != 0)){
						    location.href = base_url+resultdata;
						}else{
						    location.href = base_url;
						}
					}
				});
			}else{
                $('#snackbar').text('Select minimum 2 Communities.').addClass('show');
                setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
			}
		});  
	});
	
	
	
	$( "form#socialfbg" ).submit(function( event ) {
		event.preventDefault();
		$.post(base_url+"welcome/socialfbg",$("form#socialfbg").serialize(),function(resultdata, status) {
			$('span.text-danger').empty();
			var result=JSON.parse(resultdata);
			if(result.status == -1){
				$.each(result.validations,function (p,q){
					$('span.'+p).text(q);
				});
			}else if((result.status == 1) && (result.response)){
				$('input').val('');
				$('#socialfbgmodal').modal('hide');
				$('#chooselanguage').modal('show');
			}else{
				console.log('Registration failed please try again.');
			}
		});
	});
	

    var lazyLoadInstance = new LazyLoad({
        elements_selector: ".lazy"
    });
