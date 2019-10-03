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
    
    function nanolike(storyid){ // Nano story likes
        var nanolikecount = $('span.nanolikecount'+storyid).html();
        $.ajax({
    		type :'POST',
    		url :'<?php echo base_url(); ?>index.php/welcome/nanolike/'+storyid,
    		dataType :"json",
    		success:function(data){
    		    if(data == 1){
    		        $('.nanolike'+storyid).css('color','#338ecf');
    		        $('span.nanolikecount'+storyid).html(parseInt(nanolikecount)+1);
    			    $('#snackbar').text('You Liked Nano story.').addClass('show');
    				setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
    			}else if(data == 2){
    			    $('#notloginmodal').trigger('click');
    			}else{
    			    $('#snackbar').text('You can not Like your Nano story.').addClass('show');
    				setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
    			}
    		}
    	});
    }
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
