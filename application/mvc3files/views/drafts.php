<style>
    @media screen and (max-width:1050px){
        .content{
            padding:15px;
        }
        body{
            padding-left:10px;
            padding-right:10px;
        }
    }
    .modal.left.fade.in .modal-dialogv {
        left: -1px;
        top:-2px;
    }
</style>

<div class="">
    <section class="content">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8" style="background:#fff;padding-top:10px;box-shadow: 0 1px 1px 0 rgba(0,0,0,0.14), 0 2px 1px -1px rgba(0,0,0,0.12), 0 1px 3px 0 rgba(0,0,0,0.2);border-radius:3px;">
                <?php if(isset($drafts) && ($drafts->num_rows() > 0)) { ?>
                <div id="loadmoreall">
                    <?php foreach($drafts->result() as $draft) { ?>
                    <div class="deletedraft<?php echo $draft->sid;?>" style="">
                        <div class="row pt-0">
                            <div class="col-md-10 col-xs-10" style="word-wrap:break-word;padding-left:0;padding-right:0;">
                                <h2 style="margin-top:0;margin-bottom:5px;line-height: initial;-webkit-line-clamp: 1;display: -webkit-box;-webkit-box-orient: vertical;overflow: hidden; width:80%;"><?php echo $draft->title;?></h2>
                                <div style="margin:0; line-height: initial;-webkit-line-clamp: 1;display: -webkit-box;-webkit-box-orient: vertical;overflow: hidden; width:90%;">
                                    <?php echo strip_tags(substr($draft->story, 0, 50));?>
                                </div>
                            </div>
                            <div class="col-md-2 col-xs-1 pull-right" style="padding-left:0;padding-right:0;">
                                <div class="dropdown  pull-right">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" style="padding-top: 0px; padding-bottom: 10px;">
                					    <span><i class="fa fa-ellipsis-v"></i></span>
                					</a>
                					<ul class="dropdown-menu pull-right">
                    					<li class="desktopedit">
                    					    <?php if($draft->type == 'series') { ?>
                    						<a href="<?php echo base_url();?>series_series/<?php echo $draft->sid;?>"><i class="fa fa-edit pr-10"></i> EDIT</a>
                    						<?php }else { ?>
                    						<a href="<?php echo base_url();?>series_story/<?php echo $draft->sid;?>"><i class="fa fa-edit pr-10"></i> EDIT</a>
                    						<?php } ?>
                    					</li>
                    					<li class="mobileedit">
                    					    <?php if($draft->type == 'series') { ?>
                    						<a onclick="mobileseriesedit(<?php echo $draft->sid; ?>)" data-toggle="modal" data-target="#writeapp" id="notloginmodal"><i class="fa fa-edit pr-10"></i> EDIT</a>
                    						<?php } else { ?>
                    						<a onclick="mobilestoryedit(<?php echo $draft->sid; ?>)" data-toggle="modal" data-target="#writeapp" id="notloginmodal"><i class="fa fa-edit pr-10"></i> EDIT</a>
                    						<?php } ?>
                    					</li>   
                    					<li>
                    						<a href="javascript:void(0);" onclick="deletedraft(<?php echo $draft->sid;?>)"><i class="fa fa-trash pr-10"></i> DELETE</a>
                    					</li> 
                					</ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" style="padding-left:0;padding-right:0;">
                            <p>Last updated <?php echo date("F j, Y", strtotime($draft->date));?></p>
                            <hr style="margin-top:2px;">
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <div id="load_data_message"></div>
                <?php } else{ ?>
                    <center><div class="row" style="padding: 10px;"> No Stories were found in Drafts.</div></center>
                <?php } ?>
            </div>
            <div class="col-md-2"></div>
        </div>
    </section>
</div>
<script>
    function deletedraft(sid){
        $('.deletemessage').html('Are You Sure? Do you want to delete.');
        $('#confirmdelpopup').modal().one('click', '#delconfirmed', function (e) {
            $.ajax({
    			type: "POST",
                url: "<?php echo base_url();?>welcome/deletedraft",
                data: {'sid':sid, 'draft':'draft'},
    			success:function(data){
    			    if(data == 1){
    			        $('.deletedraft'+sid).hide();
                        $('#snackbar').text('Story Deleted Successfully.').addClass('show');
            	        setTimeout(function(){ $('#snackbar').removeClass('show'); }, 4000);
                        //setTimeout(function(){ location.reload(); }, 500);
    			    }
    			}
    		});
        });
    }
</script>
<script>
    $(document).ready(function(){
        var limit = 10;
        var start = 10;
        var action = 'inactive';
        function load_country_data(limit, start) {
            $.ajax({
                url:'<?php echo base_url();?>welcome/loadmoredrafts',
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
        if(action == 'inactive') {
            action = 'active';
            load_country_data(limit, start);
        }
        $(window).scroll(function(){
            if ($(window).scrollTop() >= (($("#loadmoreall").height() - $(window).height())*0.6) && action == 'inactive'){
                action = 'active';
                start = start + limit;
                setTimeout(function(){load_country_data(limit, start);}, 500);
            }
        });
    });
</script>
<script>
function mobilestoryedit(sid){
    if( isMobile.Android() ) document.getElementById("apptext").innerHTML = `DOWNLOAD <a style="color:blue;" href="https://play.google.com/store/apps/details?id=com.google.android.apps.inputmethod.hindi&hl=en_IN">GOOGLE INDIC</a> KEYBOARD & <a href="<?php echo base_url();?>series_story/${sid}" style="color:blue"> EDIT STORY </a> IN INDIAN LANGUAGES.`
    if( isMobile.iOS() ) document.getElementById("apptext").innerHTML = `DOWNLOAD <a href="https://apps.apple.com/ml/app/indic-keyboard-swalekh-flip/id1212717313" style="color:blue">SWALEKHA</a> KEYBOARD & <a href="<?php echo base_url();?>series_story/${sid}" style="color:blue"> EDIT STORY </a> IN INDIAN LANGUAGES.`
    if( isMobile.Windows() ) document.getElementById("apptext").innerHTML = `OPEN SITE ON DESKTOP`
}
</script>

<script>
function mobileseriesedit(sid){
    if( isMobile.Android() ) document.getElementById("apptext").innerHTML = `DOWNLOAD <a style="color:blue;" href="https://play.google.com/store/apps/details?id=com.google.android.apps.inputmethod.hindi&hl=en_IN">GOOGLE INDIC</a> KEYBOARD & <a href="<?php echo base_url();?>series_series/${sid}" style="color:blue"> EDIT STORY </a> IN INDIAN LANGUAGES.`
    if( isMobile.iOS() ) document.getElementById("apptext").innerHTML = `DOWNLOAD <a href="https://apps.apple.com/ml/app/indic-keyboard-swalekh-flip/id1212717313" style="color:blue">SWALEKHA</a> KEYBOARD & <a href="<?php echo base_url();?>series_series/${sid}" style="color:blue"> EDIT STORY </a> IN INDIAN LANGUAGES.`
    if( isMobile.Windows() ) document.getElementById("apptext").innerHTML = `OPEN SITE ON DESKTOP`
}
</script>