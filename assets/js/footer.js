/* In Mobile hide signup,signin,forgotpwd etc popups use mobile app download */
    $(function () {
        $(".headsvj").click(function () {
            $("#writeapp").modal("hide");
        });
    });

    $(document).on('show.bs.modal', '.modal', function () {
        // run your validation... ( or shown.bs.modal )
        $('body').css('overflow', 'hidden');
    });
    $(document).on('hide.bs.modal', '.modal', function () {
        $('body').css('overflow', 'auto');
    });

// modal popup Language start
	function languages(){
		$.post(base_url+"welcome/languages",function(resultdata,status){
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
			url :base_url+'welcome/selectlang/'+language,
			success:function(data){
			    if(data == 1){
			        $('input[name="language"]').val(language);
			        location.reload();
			    }else{
			        location.href = base_url;
			    }
			}
		});
	}
// modal popup Language end

// modal popup signup start
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
// modal popup Language end
	
// Login  Script start
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
				location.reload();
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
// Login  Script end
	
// Forgot Password  request Script start
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
    	        $('.ferrorresend').html('<div style="display:flex; justify-content:center;font-weight:400"><h3 style="font-family: arial, sans-serif;font-size: 19px;">EMAIL SENT</h3>'+
    	        '<img src="'+base_url+'assets/landing/svg/check-circle-solid.svg" style="height:16px; margin: 21px 0px 0px 10px;"></div>');
    	        $('.forgotpwdresendbtn').text('RESEND').css('visibility','visible');
			}else if((result.status == 2) && (result.response == 'fail')){
			    $('#snackbar').text('The Email Id Entered is not found.').addClass('show');
    	        setTimeout(function(){ $('#snackbar').removeClass('show'); }, 4000);
			}else{
				$('.ferror').text('Please Enter Correct Email Id.');
			}
		});
	});
// Forgot Password  request Script end
	
// Forgot Password  new pwd Script start
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
// Forgot Password  new pwd Script end
	
// signup language popup selected button color change start
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
// signup language popup selected button color change end
	
//Sign up choose language start
	function chooselanguage(){
	    var choselanguage = $('#cslang').val();
	    if(choselanguage){
	    	$('.btnlangspin').html('<img src="'+base_url+'assets/landing/svg/spinner.svg" class="spinner">');
	    }
	    var userid = $('#userid').val();
		$.ajax({
			url: base_url+"welcome/chooselanguage",
			type: 'POST',
			data: {'choselanguage':choselanguage, 'userid':userid},
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
//Sign up choose language end
	
//Sign up select and deselect community start
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
				$('.choosecommsave').css({"display":"block!important", "background":"#eee", "color": "#fff"});
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
				$('#snackbar').text('Select minimum 2 Genres.').addClass('show');
                setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
			}
		});  
	});
//Sign up select and deselect community start	
	
// social logins after open language popup start
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
			//	location.reload();
			}
		});
	});
// social logins after open language popup end

/* Read Later Button status readlater start */
    function yoursreadlater(){
        $('#snackbar').text('You Can not read later the Story').addClass('show');
    	setTimeout(function(){ $('#snackbar').removeClass('show'); }, 4000);
    }
	function readlater(id){
		$.ajax({
			type :'POST',
			url :base_url+'welcome/readlater',
			data :{'sid':id, 'type':'readlater'},
			dataType :"json", 
			success:function(data){
                if(data == 1){
    		        $('button.readlaterbtnatr'+id).removeClass('read').addClass('readdone');
    		        $('button.readbtnremove').removeClass('read').removeClass('readdone');
    		        $('button.readlaterbtnatr'+id).attr('onclick','unreadlater('+id+')');
    		        $('.faicon'+id).removeClass('fa-bookmark').addClass('fa-check');
    		        $('#snackbar').text('Story added to your library.').addClass('show');
    				setTimeout(function(){ $('#snackbar').removeClass('show'); }, 4000);
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
			url :base_url+'welcome/readlater',
			data :{'sid':id, 'type':'readlater'},
			dataType :"json", 
			success:function(data){
                if(data == 2){
    		        $('button.readlaterbtnatr'+id).removeClass('readdone').addClass('read');
    		        $('button.readbtnremove').removeClass('read').removeClass('readdone');
    		        $('button.readlaterbtnatr'+id).attr('onclick','readlater('+id+')');
    		        $('.faicon'+id).removeClass('fa-check').addClass('fa-bookmark');
    		        $('#snackbar').text('Successfully removed from Read later.').addClass('show');
    				setTimeout(function(){ $('#snackbar').removeClass('show'); }, 4000);
                }else{
                    //console.log(' Unread Fail. ');
                    $('#snackbar').text('Failed to remove from Read later.').addClass('show');
    				setTimeout(function(){ $('#snackbar').removeClass('show'); }, 4000);
                }
			}
		});
	}
/* Read Later Button status readlater start */
	
/* Favorite Button status favorite start */
	function favorite(id){
	    var favcount = parseInt($('.favcount').text());
	    $('.favbtn').css('color','#ff0000');
		$('i.fa.fa-heart-o.favbtn').addClass('fa-heart').removeClass('fa-heart-o');
		$.ajax({
			type :'POST',
			url :base_url+'welcome/readlater',
			data :{'sid':id, 'type':'favorite'},
			dataType :"json",
			success:function(data){
			    if(data == 1){
			        $('span.favbtn'+id).attr('onclick','unfavorite('+id+')');
			        favocount = favcount+1;
			        $('.favcount').html(favocount);
                    $('#snackbar').text('Story added to your library.').addClass('show');
    				setTimeout(function(){ $('#snackbar').removeClass('show'); }, 4000);
			    }else{
			    	$('.favbtn').css('color','#333');
			    	$('i.fa.fa-heart.favbtn').addClass('fa-heart-o').removeClass('fa-heart');
			        $('#snackbar').text('Failed to add your library.').addClass('show');
    				setTimeout(function(){ $('#snackbar').removeClass('show'); }, 4000);
			    }
			}
		});
	}
	function unfavorite(id){
	    var favcount = parseInt($('.favcount').text());
	    $('.favbtn').css('color','#333');
		$('i.fa.fa-heart.favbtn').addClass('fa-heart-o fa-2x').removeClass('fa-heart');
		$.ajax({
			type :'POST',
			url :base_url+'welcome/readlater',
			data :{'sid':id, 'type':'favorite'},
			dataType :"json",
			success:function(data){
			    if(data == 2){
			        $('span.favbtn'+id).attr('onclick','favorite('+id+')');
			        favocount = favcount-1;
			        $('.favcount').html(favocount);
                    //console.log('Unfavorite Success');
                    $('#snackbar').text('Story removed from your library.').addClass('show');
    				setTimeout(function(){ $('#snackbar').removeClass('show'); }, 4000);
			    }else{
			    	$('.favbtn').css('color','#ff0000');
					$('i.fa.fa-heart-o.favbtn').addClass('fa-heart').removeClass('fa-heart-o fa-2x');
			        $('#snackbar').text('Failed to remove from your library.').addClass('show');
    				setTimeout(function(){ $('#snackbar').removeClass('show'); }, 4000);
			    }
			}
		});
	}
	function yoursfavorite(){
	     $('#snackbar').text('You cannot favourite your own story.').addClass('show');
    	 setTimeout(function(){ $('#snackbar').removeClass('show'); }, 4000);
	}
/* Favorite Button status favorite end */

/* Subscribe Button status seriessubscribe start */
	function subscribe(id){
        var subscribers = parseInt($('p.subscribers').text());
		$.ajax({
			type :'POST',
			url :base_url+'welcome/readlater',
			data :{'sid':id, 'type':'seriessubscribe'},
			dataType :"json",
			success:function(data){
			    if(data == 1){
			        $('.subscribe').text('SUBSCRIBED');
			        $('.subscribe').attr('onclick','unsubscribe('+id+')');
			        $('.subscribe').removeClass('btn-success').addClass('btn-primary');
			        $('p.subscribers').text(subscribers+1+' SUBSCRIBERS');
			        $('#snackbar').text('You will be notified when new episode is added.').addClass('show');
    				setTimeout(function(){ $('#snackbar').removeClass('show'); }, 5000);
			    }else{
					$('#snackbar').text('Failed to Subscribed Series').addClass('show');
    				setTimeout(function(){ $('#snackbar').removeClass('show'); }, 4000);
			    }
			}
		});
	}
	function unsubscribe(id){
	    var subscribers = parseInt($('p.subscribers').text());
		$.ajax({
			type :'POST',
			url :base_url+'welcome/readlater',
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
/* Subscribe Button status seriessubscribe start end */
	
/* writerfollow writerunfollow Button and count in home page start */
	function yoursfollow(){
	    $('#snackbar').text('You Can not Follow the Writer.').addClass('show');
    	setTimeout(function(){ $('#snackbar').removeClass('show'); }, 4000);
	}
	function writerfollow(writer_id, writer_name) { // follow button 
        var follcount = $('#follcount'+writer_id).text();
        $.ajax({
    		type :'POST',
    		url :base_url+'welcome/follow',
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
    		url :base_url+'welcome/follow',
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
    			}else{
    				//console.log('writerunfollow fail');
    				$('#snackbar').text('Unfollow fail').addClass('show');
    				setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
    			}
    		}
    	});
    }
/* writerfollow writerunfollow Button and count in home page end */

/* Rating to all stories start */
function yoursrating(){
    $('#snackbar').text('You Cannot Rate your story').addClass('show');
    setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
}
$( document ).ready(function() {
    $('#stars').on('starrr:change', function(e, value) {
        var rating = value;
        var sid = $('#storyid').val();
        $.ajax({
			url:base_url+'welcome/rating',
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
                    $('#snackbar').text('Rated Successfully').addClass('show');
                    setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
				}
			}
        });
    });
});
/* Rating to all stories end */

/* Rating script downloaded */
    // Starrr plugin (https://github.com/dobtco/starrr)
var __slice = [].slice;

(function($, window) {
    var Starrr;

    Starrr = (function() {
        Starrr.prototype.defaults = {
            rating: void 0,
            numStars: 5,
            change: function(e, value) {}
        };

        function Starrr($el, options) {
            var i, _, _ref,
                _this = this;

            this.options = $.extend({}, this.defaults, options);
            this.$el = $el;
            _ref = this.defaults;
            for (i in _ref) {
                _ = _ref[i];
                if (this.$el.data(i) != null) {
                    this.options[i] = this.$el.data(i);
                }
            }
            this.createStars();
            this.syncRating();
            this.$el.on('mouseover.starrr', 'i', function(e) {
                return _this.syncRating(_this.$el.find('i').index(e.currentTarget) + 1);
            });
            this.$el.on('mouseout.starrr', function() {
                return _this.syncRating();
            });
            this.$el.on('click.starrr', 'i', function(e) {
                return _this.setRating(_this.$el.find('i').index(e.currentTarget) + 1);
            });
            this.$el.on('starrr:change', this.options.change);
        }

        Starrr.prototype.createStars = function() {
            var _i, _ref, _results;

            _results = [];
            for (_i = 1, _ref = this.options.numStars; 1 <= _ref ? _i <= _ref : _i >= _ref; 1 <= _ref ? _i++ : _i--) {
                _results.push(this.$el.append("<i class='fa fa-star-o'></i>"));
            }
            return _results;
        };

        Starrr.prototype.setRating = function(rating) {
            if (this.options.rating === rating) {
                //rating = void 0;  // click double time rating clear or rating 0
                rating = rating;
            }
            this.options.rating = rating;
            this.syncRating();
            return this.$el.trigger('starrr:change', rating);
        };

        Starrr.prototype.syncRating = function(rating) {
            var i, _i, _j, _ref;

            rating || (rating = this.options.rating);
            if (rating) {
                for (i = _i = 0, _ref = rating - 1; 0 <= _ref ? _i <= _ref : _i >= _ref; i = 0 <= _ref ? ++_i : --_i) {
                    this.$el.find('i').eq(i).removeClass('fa-star-o').addClass('fa-star');
                }
            }
            if (rating && rating < 5) {
                for (i = _j = rating; rating <= 4 ? _j <= 4 : _j >= 4; i = rating <= 4 ? ++_j : --_j) {
                    this.$el.find('i').eq(i).removeClass('fa-star').addClass('fa-star-o');
                }
            }
            if (!rating) {
                return this.$el.find('i').removeClass('fa-star').addClass('fa-star-o');
            }
        };

        return Starrr;

    })();
    return $.fn.extend({
        starrr: function() {
            var args, option;

            option = arguments[0], args = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
            return this.each(function() {
                var data;

                data = $(this).data('star-rating');
                if (!data) {
                    $(this).data('star-rating', (data = new Starrr($(this), option)));
                }
                if (typeof option === 'string') {
                    return data[option].apply(data, args);
                }
            });
        }
    });
})(window.jQuery, window);

$(function() {
    return $(".starrr").starrr();
});
/* Rating script downloaded end */

/* Suggest story to group and friend for reading start */
    function groupsuggest(id){
    	var loggedinuid = $('#loggedinuid').val();
    	if(loggedinuid){
    		$('#groupsuggest').modal('show');
			$.ajax({
				type: "POST",
				url: base_url+"welcome/get_story_groupdata",
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
		}else{
			$('#notloginmodal').trigger('click');
		}
    }
    
    function friend(id){
    	var loggedinuid = $('#loggedinuid').val();
    	if(loggedinuid){
    		$('#friendsuggest').modal('show');
			$.ajax({
				type: "POST",
				url: base_url+"welcome/get_story_data",
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
		}else{
			$('#notloginmodal').trigger('click');
		}
	}
/* Suggest story to group for reading end */

/* Social share start */
    function socialshare(id, seristorytype) {
        var seurl = '';
        if(seristorytype == "series") {
            seurl = base_url+"series/-"+id+"/-"+id;
        }else if(seristorytype == "story") {
            seurl = base_url+"story/-"+id;
        }else if(seristorytype == "nano") {
            seurl = base_url+"nano/"+id;
        }else{
            seurl = base_url;
        }
        $('.facebookshare').attr('onClick',"javascript:genericSocialShare('http://www.facebook.com/sharer.php?u="+encodeURIComponent(seurl)+"')");
        $('.whatsappshare').attr('onClick',"javascript:genericSocialShare('https://api.whatsapp.com/send?text="+encodeURIComponent(seurl)+"')");
        $('.twittershare').attr('onClick',"javascript:genericSocialShare('http://twitter.com/share?text="+encodeURIComponent(seurl)+"')");
        $('#copylinkshare').val(seurl);
    }
    function commusocialshare(commpostid, communityname) {
        var seurl = base_url;
        if(commpostid && communityname) {
            seurl = base_url+"community-story/"+communityname+"/"+commpostid;
        }
        $('.facebookshare').attr('onClick',"javascript:genericSocialShare('http://www.facebook.com/sharer.php?u="+encodeURIComponent(seurl)+"')");
        $('.whatsappshare').attr('onClick',"javascript:genericSocialShare('https://api.whatsapp.com/send?text="+encodeURIComponent(seurl)+"')");
        $('.twittershare').attr('onClick',"javascript:genericSocialShare('http://twitter.com/share?text="+encodeURIComponent(seurl)+"')");
        $('#copylinkshare').val(seurl);
    }
/* Social share end */

/* nano story onclick model open increment views start */
    function nanoviewsadd(sid){
        var nanoviewcount = $('.nanoviewcount'+sid).text();
        $.ajax({
            type: "POST",
            url: base_url+"welcome/nanoviewsadd",
            data: {'sid':sid},
            success: function(data) {
    			if(data == 1) {
    			    $('.nanoviewcount'+sid).text(parseInt(nanoviewcount)+1);
    			    console.log('view incremented');
    			    $('#sharescreen'+sid).removeAttr('onclick');
              	}
            }
    	});
    }
/* nano story onclick model open increment views end */
  
/* nano loke dislike start */  
    function nanolike(storyid){ // Nano story likes
        var nanolikecount = $('.nanolikecount'+storyid).first().text();
        $('.favbtn'+storyid).removeClass('fa-heart-o').addClass('fa-heart');
        $.ajax({
    		type :'POST',
    		url :base_url+'welcome/nanolike/'+storyid,
    		dataType :"json",
    		success:function(data){
    		    if(data == 1){
    		        $('.nanolikecount'+storyid).text(parseInt(nanolikecount)+1);
    		        $('.nanolike'+storyid).removeAttr('onclick').attr('onclick','nanodislike('+storyid+')');
    			    $('#snackbar').text('Liked Nano story.').addClass('show');
    				setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
    			}else{
    			    $('.favbtn'+storyid).removeClass('fa-heart').addClass('fa-heart-o');
    			    $('#snackbar').text('You cannot like your own nano-story.').addClass('show');
    				setTimeout(function(){ $('#snackbar').removeClass('show'); }, 5000);
    			}
    		}
    	});
    }
    function nanodislike(storyid) { // Nano story unlike
        var nanolikecount = $('.nanolikecount'+storyid).first().text();
        $('.favbtn'+storyid).removeClass('fa-heart').addClass('fa-heart-o');
        $.ajax({
    		type :'POST',
    		url :base_url+'welcome/nanolike/'+storyid,
    		dataType :"json",
    		success:function(data){
    		    if(data == 2){
    		        $('.nanolikecount'+storyid).text(parseInt(nanolikecount)-1);
    		        $('.nanolike'+storyid).removeAttr('onclick').attr('onclick','nanolike('+storyid+')');
    			    $('#snackbar').text('Unliked Nano story.').addClass('show');
    				setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
    			}else{
    			    console.log('unlike Failed');
    			}
    		}
    	});
    }
/* nano loke dislike end */ 

/* reports start */
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
    		url :base_url+'welcome/reportstories',
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
/* reports end */

    function yourscommpostlike(){
        $('#snackbar').text('You Can not Like the Story').addClass('show');
    	setTimeout(function(){ $('#snackbar').removeClass('show'); }, 4000);
    }
    function ongoingcomplet(sid){
        $('#yesongoingcomplet').attr('onClick','yesongoingcomplet('+sid+')');
        $('#noongoingcomplet').attr('onClick','noongoingcomplet('+sid+')');
        $('#ongoingcomplet').modal('show');
    }
    function yesongoingcomplet(sid){
        $.ajax({
    		type :'POST',
    		url :base_url+'welcome/ongoingcomplet',
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
    
    $(document).ready(function() {
        $("a").click(function() {
            $('span.text-danger').empty();
        });
    });


var isMobile = {
    Android: function() {
        return navigator.userAgent.match(/Android/i);
    },
    iOS: function() {
        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },
    Windows: function() {
        return navigator.userAgent.match(/IEMobile/i);
    },
};

if( isMobile.Android() ) document.getElementById("apptext").innerHTML = `DOWNLOAD <a style="color:blue;" href="https://play.google.com/store/apps/details?id=com.google.android.apps.inputmethod.hindi&hl=en_IN">GOOGLE INDIC</a> KEYBOARD & <a href="javascript:void(0);" data-toggle="modal" data-target="#modalRegister" id="acts" style="color:blue">START WRITING</a> IN INDIAN LANGUAGES.`
if( isMobile.iOS() ) document.getElementById("apptext").innerHTML = `DOWNLOAD <a href="https://apps.apple.com/ml/app/indic-keyboard-swalekh-flip/id1212717313" style="color:blue">SWALEKHA</a> KEYBOARD & <a href="javascript:void(0);" data-toggle="modal" data-target="#modalRegister" id="acts" style="color:blue">START WRITING</a> IN INDIAN LANGUAGES.`
if( isMobile.Windows() ) document.getElementById("apptext").innerHTML = `OPEN SITE ON DESKTOP`

