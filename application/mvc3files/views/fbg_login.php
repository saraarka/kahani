<!-- Facebook Login starts -->
<script>
window.fbAsyncInit = function() {
    // FB JavaScript SDK configuration and setup
    FB.init({
      appId      : '434373993974186', // FB App ID
      cookie     : true,  // enable cookies to allow the server to access the session
      xfbml      : true,  // parse social plugins on this page
      version    : 'v3.2' // use graph api version 2.8
    });
    // Check whether the user already logged in
    FB.getLoginStatus(function(response) {
        if (response.status === 'connected') {
            //getFbUserData(); //display user data
        }
    });
};

// Logout from facebook
function fbLogout() {
    FB.logout(function() {
        document.getElementById('fbLink').setAttribute("onclick","fbLogin()");
        location.href = "<?php echo base_url();?>welcome/logout";
    });
}

// Load the JavaScript SDK asynchronously
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

// Facebook login with JavaScript SDK
function fbLogin() {
    FB.login(function (response) {
        if (response.authResponse) {
            getFbUserData(); // Get and display the user profile data
        } else { 
            alert('User cancelled login or did not fully authorize.');
        }
    }, {scope: 'email'});
}

// Fetch the user profile data from facebook
function getFbUserData(){
    FB.api('/me', {fields: 'id,name,first_name,last_name,email,picture,gender,birthday'},
    function (response) {
        document.getElementById('fbLink').setAttribute("onclick","fbLogout()");
        //console.log(response);
        $.ajax({
			url: "<?php echo base_url();?>welcome/checkfacebooklogin",
			type: 'POST',
			data: {'id': response.id,'email': response.email },
			dataType: 'json',
			success: function (resultdata) {
				if((resultdata.status == 1) && (resultdata.lresponse == 'gotologin') && (resultdata.userid)){
                    $.ajax({
            			url: "<?php echo base_url();?>welcome/facebooklogin",
            			type: 'POST',
            			data: {'id': response.id, 'fname': response.first_name, 'lname': response.last_name, 'email': response.email, 'userid':resultdata.userid },
            			dataType: 'json',
            			success: function (lresultdata) {
            				if(lresultdata == 1){
            				    location.reload();
            				}
            			}
            		});
				}else if((resultdata.status == 1) && (resultdata.lresponse == 'gotocomm') && (resultdata.userid)){
				     console.log('gotocomm');
				     $('#userid').val(resultdata.userid);
				     $('#choosecommunity').modal('show');
				}else if((resultdata.status == 1) && (resultdata.lresponse == 'gotolang') && (resultdata.userid)){
				    console.log('gotolang');
				    $('#userid').val(resultdata.userid);
				    $('#chooselanguage').modal('show');
				}else if((resultdata.status == 1) && (resultdata.lresponse == 'gotofbgsignup')){
				    console.log('gotofbgsignup');
				    $('#loginmodal').modal('hide');  $('#signupmodal').modal('hide');  // hide sign & signup modal popups
				    $('#socialfbgmodal').modal('show');   // show social sign or signup modal popup
				    $('input[name="fbgname"]').val(response.name);
            		if(response.email){
            		    $('input[name="fbgemail"]').val(response.email);
            		    $('input[name="fbgemail"]').attr('readonly','readonly');
            		    $('input[name="fbgemail"]').css('opacity',1);
            		    $('input[name="fbgemail"]').css('background','#eee !important');
            		}
            		$('input[name="fbgid"]').val(response.id);
            		$('input[name="fbgtype"]').val('fb');
            		
				}else if(resultdata.status == 0){
				    alert('Facebook profile data not Found.');
				}else{
				    alert('Facebook profile not Found.');
				}
			}
		});
    });
}
</script>

<!-- Login with google -->
<script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>
<meta name="google-signin-client_id" content="487306368062-pahubqsosrjbfj9bnlpb7q7ujmju5tsv.apps.googleusercontent.com">
<script>
    function onSignIn(googleUser) {
        var profile = googleUser.getBasicProfile();
		$.ajax({
			url: "<?php echo base_url();?>welcome/checkgooglelogin",
			type: 'POST',
			data: {'id': profile.getId(),'email': profile.getEmail() },
			dataType: 'json',
			success: function (resultdata) {
				if((resultdata.status == 1) && (resultdata.lresponse == 'gotologin') && (resultdata.userid)){
                    $.ajax({
            			url: "<?php echo base_url();?>welcome/googlelogin",
            			type: 'POST',
            			data: {'id': profile.getId(), 'fname': profile.getGivenName(), 'lname': profile.getFamilyName(), 'email': profile.getEmail(), 'userid':resultdata.userid },
            			dataType: 'json',
            			success: function (lresultdata) {
            				if(lresultdata == 1){
            				    location.reload();
            				}
            			}
            		});
				}else if((resultdata.status == 1) && (resultdata.lresponse == 'gotocomm') && (resultdata.userid)){
				     console.log('gotocomm');
				     $('#userid').val(resultdata.userid);
				     $('#choosecommunity').modal('show');
				}else if((resultdata.status == 1) && (resultdata.lresponse == 'gotolang') && (resultdata.userid)){
				    console.log('gotolang');
				    $('#userid').val(resultdata.userid);
				    $('#chooselanguage').modal('show');
				}else if((resultdata.status == 1) && (resultdata.lresponse == 'gotofbgsignup')){
				    console.log('gotofbgsignup');
				    $('#loginmodal').modal('hide');  $('#signupmodal').modal('hide');  // hide sign & signup modal popups
				    $('#socialfbgmodal').modal('show');   // show social sign or signup modal popup
				    $('input[name="fbgname"]').val(profile.getGivenName());
            		if(profile.getEmail()){
            		    $('input[name="fbgemail"]').val(profile.getEmail());
            		    $('input[name="fbgemail"]').attr('readonly','readonly');
            		    $('input[name="fbgemail"]').css('opacity',1);
            		    $('input[name="fbgemail"]').css('background','#eee !important');
            		}
            		$('input[name="fbgid"]').val(profile.getId());
            		$('input[name="fbgtype"]').val('google');
            		
				}else if(resultdata.status == 0){
				    //alert('Google profile data not Found.');
				}else{
				    alert('Google profile not Found.');
				}
			}
		});
    }
    function signOut() {
        var auth2 = gapi.auth2.getAuthInstance();
        auth2.signOut().then(function () {
            auth2.disconnect();
            location.href = "<?php echo base_url();?>welcome/logout";
        });

    }
    function onLoad() {
        gapi.load('auth2', function() {
            gapi.auth2.init();
        });
    }
</script>