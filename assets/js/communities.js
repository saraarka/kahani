function commuunjoin(comm_id, gener) { // community unjoin button 
    $.ajax({
		type :'POST',
		url :base_url+'welcome/communities_join',
		data :{'comm_id':comm_id, 'gener':gener},
		dataType :"json",
		success:function(data){
		    if(data == 2){
		        $('button.unjoin'+comm_id).text('JOIN');
		        $('button.unjoin'+comm_id).removeClass('btn-success').addClass('btn-danger');
		        $('button.unjoin'+comm_id).attr('onclick','commujoin('+comm_id+',"'+gener+'")');
		        $('button.unjoin'+comm_id).removeClass('unjoin'+comm_id).addClass('join'+comm_id);
		        location.reload();
			    //alert('You Are Successfully Un Joined the Community.');
			}else{
			    alert('Failed to un join the Community.');
			}
		}
	});
}

$(document).ready(function(){ // without login load more
    var limit = 8;
    var start = 8;
    var action = 'inactive';
    function load_country_data(limit, start) {
        var loggedinuid = $('#loggedinuid').val();
        if((loggedinuid == 0) || (loggedinuid == '') || (loggedinuid == 'undefined')){
            $.ajax({
                url:base_url+'welcome/loadcommunities',
                method:"POST",
                data:{limit:limit, start:start},
                cache:false,
                success:function(data){
                    $('#loadmoreall').append(data);
                    if(data == '') {
                        $('#load_data_message').html("<center><div class='col-md-12' style='padding-top:20px;'> No More Results!</div></center>");
                        action = 'active';
                    }else{
                        $('#load_data_message').html("<center><div class='col-md-12' style='padding-top:20px;'> Loading ...</div></center>");
                        action = "inactive";
                    }
                }
            });
        }
    }
    if(action == 'inactive') {
        action = 'active';
        load_country_data(limit, start);
    } 
    $(window).scroll(function(){
        if($(window).scrollTop() + $(window).height() > $("#loadmoreall").height() && action == 'inactive'){
            action = 'active';
            start = start + limit;
            setTimeout(function(){load_country_data(limit, start);}, 500);
        }
    });
});


$(document).ready(function(){ // featured communities load more
    var flimit = 8;
    var fstart = 8;
    var faction = 'inactive';
    function fload_country_data(flimit, fstart) {
        var loggedinuid = $('#loggedinuid').val();
        if(loggedinuid){
            $.ajax({
                url:base_url+'welcome/floadcommunities',
                method:"POST",
                data:{limit:flimit, start:fstart},
                cache:false,
                success:function(data){
                    $('#floadmoreall').append(data);
                    if(data == '') {
                        $('#fload_data_message').html("<center><div class='col-md-12' style='padding-top:20px;'> No More Results!</div></center>");
                        faction = 'active';
                    }else{
                        $('#fload_data_message').html("<center><div class='col-md-12' style='padding-top:20px;'> Loading ...</div></center>");
                        faction = "inactive";
                    }
                }
            });
        }
    }
    if(faction == 'inactive') {
        faction = 'active';
        fload_country_data(flimit, fstart);
    } 
    $(window).scroll(function(){
        if($(window).scrollTop() + $(window).height() > $("#floadmoreall").height() && faction == 'inactive'){
            faction = 'active';
            fstart = fstart + flimit;
            setTimeout(function(){fload_country_data(flimit, fstart);}, 500);
        }
    });
});

$(document).ready(function(){ //joined communities loadmore
    var jlimit = 8;
    var jstart = 8;
    var jaction = 'inactive';
    function jload_country_data(jlimit, jstart) {
        var loggedinuid = $('#loggedinuid').val();
        if(loggedinuid){
            $.ajax({
                url:base_url+'welcome/jloadcommunities',
                method:"POST",
                data:{limit:jlimit, start:jstart},
                cache:false,
                success:function(data){
                    $('#jloadmoreall').append(data);
                    if(data == '') {
                        $('#jload_data_message').html("<center><div class='col-md-12' style='padding-top:20px;'></div></center>");
                        jaction = 'active';
                    }else{
                        $('#jload_data_message').html("<center><div class='col-md-12' style='padding-top:20px;'> Loading ...</div></center>");
                        jaction = "inactive";
                    }
                }
            });
        }
    }
    if(jaction == 'inactive') {
        jaction = 'active';
        jload_country_data(jlimit, jstart);
    } 
    $(window).scroll(function(){
        if($(window).scrollTop() + $(window).height() > $("#jloadmoreall").height() && jaction == 'inactive'){
            jaction = 'active';
            jstart = jstart + jlimit;
            setTimeout(function(){jload_country_data(jlimit, jstart);}, 500);
        }
    });
});


var lazyLoadInstance = new LazyLoad({
    elements_selector: ".lazy"
});