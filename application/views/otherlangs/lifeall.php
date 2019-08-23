<link rel="stylesheet" href="<?php echo base_url();?>assets/css/lifeall.css">

<?php $readlatersids = get_storiesreadlater('readlater'); ?>
<div class="content-wrapper">
    <section class="content">
        <div class="main-container1">
		    <div class="row pt-0">
		        <?php if(isset($lifetagslist) && ($lifetagslist->num_rows() > 0)){ ?>
		        <div class="tagv" style="display:flex;">
		                <div class="brv1 hidden-xs">Popular Tags :</div>
		                <button id="left-btnt" class="left-btnt right-btnt"><i class="fa fa-arrow-left" aria-hidden="true"></i></button>
		                <div id="tag1" class="tags1">
		                    <div id="tag2" class="tags2">
		                        <?php if(isset($lifetagslist) && ($lifetagslist->num_rows() > 0)){
		                        foreach($lifetagslist->result() as $lifetaglist){ ?>
		                            <div class="brv" style="display:inline-block;"><a href="<?php echo base_url().$this->uri->segment(1);?>/searchresult?type=life&searchtext=<?php echo $lifetaglist->tagname; ?>">
		                                <?php echo $lifetaglist->tagname; ?></a>
		                            </div>
		                        <?php } } ?>
		                    </div>
		                </div>
		                <button id="right-btnt" class="right-btnt right-btnt"><i class="fa fa-arrow-right" aria-hidden="true"></i></button>
	            </div>
	            <?php } ?>
		    </div>
		    <div class="row pt-0">
		        <?php if(isset($top_get_life) && ($top_get_life->num_rows() > 0)){ ?>
		    	<div class="col-md-6 col-xs-8 pd-0">
		    		<div class="titlei hidden-xs">Top Life Events</div>
		    		<div class="titlei hidden-sm hidden-md hidden-lg">top</div>
		    	</div>
		    	<?php if($top_get_life->num_rows() > 3) { ?>
		    	<div class="col-md-6 col-xs-4 pd-0">
		    		<div class="view pull-right">
		    		   <a href="<?php echo base_url().$this->uri->segment(1);?>/lifeevents/top">View More</a> 
		    		</div>
		    	</div>
		    	<?php } ?>
		    </div><hr>
		    <div id="StoryContl" class="StoryCont" >
				<div id="story-sliderl" class="story-slider" >
					<?php $i = 0; foreach($top_get_life->result() as $topliferow) { if($i < 3){  ?>
						<div class="card1">
							<a href="<?php echo base_url($this->uri->segment(1).'/story/'.preg_replace('/\s+/', '-', $topliferow->title).'-'.$topliferow->sid);?>" class="imagelife-style">
    							<?php if(isset($topliferow->image) && !empty($topliferow->image)) { ?>
    								<img src="<?php echo base_url();?>assets/images/<?php echo $topliferow->image; ?>" alt="<?php echo $topliferow->title;?>" class="imageme1">
    							<?php }else{ ?>
    								<img src="<?php echo base_url();?>assets/images/life.jpg" alt="<?php echo $topliferow->title;?>" class="imageme1">
    							<?php } ?>
							</a>	
							<div>
    							<font class="max-lines">
    								<a href="<?php echo base_url($this->uri->segment(1).'/story/'.preg_replace('/\s+/', '-', $topliferow->title).'-'.$topliferow->sid);?>">
    									<?php echo $topliferow->title;?>
    								</a>
    							</font> 
							</div>
							<div class="flextest">
								<?php if(($topliferow->writing_style == 'anonymous') && ($topliferow->type == 'life')){ ?>
									<font class="byname">By<font class="namehere"> Anonymous</font></font><br>
								<?php } else { ?>
									<font class="byname">By <font class="namehere">
									    <a href="<?php echo base_url().$this->uri->segment(1).'/'.$topliferow->profile_name;?>" style="color:#000"> <?php echo $topliferow->name;?></a>
								    </font></font><br>
								<?php } ?>
							</div>
							
							<div class="flextest" style="padding-top:4px;">
								<font class="lifeEvents-text"><?php echo mb_substr(strip_tags($topliferow->story),0,150);?> </font>
							</div>
						
							<div class="flextest" style="padding-top:6px">
								<?php if(isset($this->session->userdata['logged_in']['user_id']) && ($topliferow->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
									
										<button class="read" onclick="yoursreadlater();"><i class="fa fa-bookmark"></i> Read later </button>
									
								<?php }else{ ?>
									<?php if(isset($readlatersids) && (sizeof($readlatersids)>0) && in_array($topliferow->sid, $readlatersids)) { ?>
										<button onclick="unreadlater(<?php echo $topliferow->sid;?>)" class="readdone notloginmodal readlaterbtnatr<?php echo $topliferow->sid;?>">
										<i class="fa fa-check faicon<?php echo $topliferow->sid;?>"></i> Read later </button>
									<?php }else { ?>
										<button onclick="readlater(<?php echo $topliferow->sid;?>)" class="read notloginmodal readlaterbtnatr<?php echo $topliferow->sid;?>">
										<i class="fa fa-bookmark faicon<?php echo $topliferow->sid;?>"></i> Read later </button>
									<?php } ?>
								<?php } ?>
								
								<button type="button" class="btn read dropdown-toggle pull-right" data-toggle="dropdown">
									<span class=""><i class="fa fa-plus"></i></span>
								</button>
								<ul class="dropdown-menu list-inline dropvklife">
									<li onclick="groupsuggest(<?php echo $topliferow->sid; ?>);">
										<a href="javascript:void(0);" href="javascript:void(0);" data-toggle="modal" data-target="#groupsuggest" title="COMMUNITY"><i class="fa fa-users"></i></a>
									</li>
									<li onclick="friend(<?php echo $topliferow->sid;?>);">
										<a href="javascript:void(0);" data-toggle="modal" data-target="#friendsuggest" title="SUGGEST"><i class="fa fa-user"></i></a>
									</li>
									<li onclick="socialshare(<?php echo $topliferow->sid;?>, 'story');">
    									<a data-toggle="modal" data-target="#soc" href="javascript:void(0);" title="SOCIAL">
    										<i class="fa fa-share-alt"></i>
    									</a>
    								</li>
								</ul>
							</div>
						</div>
					<?php $i++; } } } ?>
				</div>
			</div>
			<br>
			
			<?php if(isset($get_life) && ($get_life->num_rows() > 0)){ ?>
			<div class="row pt-0">
		    	<div class="col-md-6 col-xs-12 pd-0">
		    		<div class="titlei">Latest life events</div>
		    	</div>
		    </div><hr>
		    <div id="loadmoreall" style="display:flex; flex-wrap:wrap;" class="vhw">
			    <?php foreach($get_life->result() as $liferow) { ?>
					<div class="card2">
						<a href="<?php echo base_url($this->uri->segment(1).'/story/'.preg_replace('/\s+/', '-', $liferow->title).'-'.$liferow->sid);?>" class="imagelife-style">
							<?php if(isset($liferow->image) && !empty($liferow->image)) { ?>
								<img src="<?php echo base_url();?>assets/images/<?php echo $liferow->image; ?>" alt="<?php echo $liferow->title;?>" class="imageme1">
							<?php }else{ ?>
								<img src="<?php echo base_url();?>assets/images/life.jpg" alt="<?php echo $liferow->title;?>" class="imageme1">
							<?php } ?>
						</a>	
							<div>
							<font class="max-lines">
								<a href="<?php echo base_url($this->uri->segment(1).'/story/'.preg_replace('/\s+/', '-', $liferow->title).'-'.$liferow->sid);?>">
									<?php echo $liferow->title;?>
								</a>
							</font> 
							</div>
							<div class="flextest">
								<?php if(($liferow->writing_style == 'anonymous') && ($liferow->type == 'life')){ ?>
									<font class="byname">By<font class="namehere"> Anonymous</font></font><br>
								<?php } else { ?>
									<font class="byname">By <font class="namehere">
									    <a href="<?php echo base_url().$this->uri->segment(1).'/'.$liferow->profile_name;?>" style="color:#000"> <?php echo $liferow->name;?></a>
								    </font></font><br>
								<?php } ?>
							</div>
							
							<div class="flextest" style="padding-top:4px;">
								<font class="lifeEvents-text"><?php echo mb_substr(strip_tags($liferow->story),0,150);?> </font>
							</div>
						
							<div class="flextest" style="padding-top:6px">
								<?php if(isset($this->session->userdata['logged_in']['user_id']) && ($liferow->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
									
										<button class="read" onclick="yoursreadlater();"><i class="fa fa-bookmark"></i> Read later </button>
									
								<?php }else{ ?>
									<?php if(isset($readlatersids) && (sizeof($readlatersids)>0) && in_array($liferow->sid, $readlatersids)) { ?>
										<button onclick="unreadlater(<?php echo $liferow->sid;?>)" class="readdone notloginmodal readlaterbtnatr<?php echo $liferow->sid;?>">
										<i class="fa fa-check faicon<?php echo $liferow->sid;?>"></i> Read later </button>
									<?php }else { ?>
										<button onclick="readlater(<?php echo $liferow->sid;?>)" class="read notloginmodal readlaterbtnatr<?php echo $liferow->sid;?>">
										<i class="fa fa-bookmark faicon<?php echo $liferow->sid;?>"></i> Read later </button>
									<?php } ?>
								<?php } ?>
								
								<button type="button" class="btn read dropdown-toggle pull-right" data-toggle="dropdown">
									<span class=""><i class="fa fa-plus"></i></span>
								</button>
								<ul class="dropdown-menu list-inline dropvklife">
									<li onclick="groupsuggest(<?php echo $liferow->sid; ?>);">
										<a href="javascript:void(0);" data-toggle="modal" data-target="#groupsuggest" title="COMMUNITY"><i class="fa fa-users"></i></a>
									</li>
									<li onclick="friend(<?php echo $liferow->sid;?>);">
										<a href="javascript:void(0);" data-toggle="modal" data-target="#friendsuggest" title="SUGGEST"><i class="fa fa-user"></i></a>
									</li>
									<li onclick="socialshare(<?php echo $liferow->sid;?>, 'story');">
    									<a data-toggle="modal" data-target="#soc" href="javascript:void(0);" title="SOCIAL">
    										<i class="fa fa-share-alt"></i>
    									</a>
    								</li>
								</ul>
							</div>
						</div>
				<?php } ?>
			</div>
			<div id="load_data_message"></div>
			<?php } ?>
    	</div>
    </section>
</div>

<!-- Social Popup ---- -->
<div class="modal fade" id="soc">
	<div class="modal-dialog">
		<div class="modal-content socv ">
			<div class="modal-header" style="padding:8px 15px;">
				<button type="button" class="close" style="color:#000; opacity:initial; margin-top:0px;" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h5 class="modal-title text-center" style="color:#808182;">SOCIAL MEDIA SHARE</h5>
			</div>
			<div class="" style="padding-top:10px;">
				<div class="row">
					<div class="col-md-12 pd-5v" style="margin:12px;">
						<a href="javascript:void(0);" class="facebookshare">
						    <img src="<?php echo base_url();?>assets/svg/fb.svg" style="width:40px; height:40px;margin-top:-10px;"/> <span class="socialsharepopupspan">Facebook</span></a>
					</div>
					<div class="col-md-12 pd-5v" style="margin:12px;">
					    <a href="javascript:void(0);" class="whatsappshare">
						    <img src="<?php echo base_url();?>assets/svg/wa.svg" style="width:40px; height:40px;margin-top:-10px;"/> <span class="socialsharepopupspan">Whatsapp</span></a>
					</div>
					<div class="col-md-12 pd-5v" style="margin:12px;">
						<a href="javascript:void(0);" class="twittershare">
						    <img src="<?php echo base_url();?>assets/svg/twitter.svg" style="width:40px; height:40px;margin-top:-10px;"/> <span class="socialsharepopupspan">Twitter</span></a>
					</div>
					<div class="col-md-12 pd-5v" style="margin:12px;">
						<a href="javascript:void(0);" onclick="copylinkshare('#copylinkshare')">
						    <img src="<?php echo base_url();?>assets/svg/link.svg" style="width:40px; height:40px;margin-top:-10px;"/> <span class="socialsharepopupspan">Copy to link</span></a>
					    <input type="hidden" id="copylinkshare" value="<?php echo base_url();?>">
					</div>
				</div>
			</div>
		</div>
	<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- Social popup ---- -->

<!-- group suggest popup code ---- -->
<div class="modal fade" id="groupsuggest" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
		    <div class="storysuggesttogroup"></div>
		</div>
	</div>
</div>
<!-- group suggest popup code ----------- -->
<!-- frind popup code ------>
<div class="modal fade" id="friendsuggest" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
		    <div class="storysuggesttofriend"></div>
		</div>
	</div>
</div>
<!--frind popup end ------------->

<script>
    $(document).ready(function(){
        var limit = 7;
        var start = 7;
        var action = 'inactive';
        function load_country_data(limit, start) {
            $.ajax({
                url:'<?php echo base_url().$this->uri->segment(1);?>/viewallloadmore/life',
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

var rightButtonl = $("#right-btnl");
var leftButtonl = $("#left-btnl");
var containerl = $("#StoryContl");
var slideContl = $("#story-sliderl");
if($("#story-sliderl > div").length<3){
  $('#right-btnl').hide();
  $('#left-btnl').hide();
}
var maxcountl=$("#story-sliderl > div").length;
var marLeftl = 0, maxXl = maxcountl*276, diffl = 0 ;

function slidel() {
marLeftl-=280;
if( marLeftl < -maxXl ){ 
  marLeftl = -maxXl+240 ;
}
  slideContl.animate({"margin-left" : marLeftl + "px"}, 500);
}

function slideBackl() {
  marLeftl +=280;
  if ( marLeftl > 0 ) { marLeftl = 0 ;}
  slideContl.animate({"margin-left" : marLeftl + "px"}, 500);
}
rightButtonl.click(slidel);
leftButtonl.click(slideBackl);

/*touch code from here*/

$(containerl).on("mousedown touchstart", function(e) {
  
  var startXl = e.pageX || e.originalEvent.touches[0].pageX;
  diffl = 0;

  $(containerl).on("mousemove touchmove", function(e) {
    
      var xtl = e.pageX || e.originalEvent.touches[0].pageX;
      diffl = (xtl - startXl) * 100 / window.innerWidth;
    if( marLeftl == 0 && diffl > 10 ) { 
      event.preventDefault() ;
    } else if (  marLeftl == -maxXl && diffl < -10 ) {
       event.preventDefault();   
    }
  });
});

$(containerl).on("mouseup touchend", function(e) {
  $(containerl).off("mousemove touchmove");
  if(  marLeftl == 0 && diffl > 4 ) { 
      sliderContl.animate({"margin-left" :  0 + "px"},100);
   } else if (  marLeftl == -maxXl  && diffl < 4 ){
       sliderContl.animate({"margin-left" : -maxXl  + "px"},100);  
   } else {
      if (diffl < -10) {
        slidel();
      } else if (diffl > 10) {
        slideBackl();
      } 
  }
});

</script>
<!-- END STORIES -->


<script>

var rightButtont = $("#right-btnt");
var leftButtont = $("#left-btnt");
var containert = $("#tag1");
var slideContt = $("#tag2");
if($("#tag2 > div").length<3){
  $('#right-btnt').hide();
  $('#left-btnt').hide();
}
var maxcountt=$("#tag2 > div").length;
var marLeftt = 0, maxXt = maxcountt*60, difft = 0 ;

function slidet() {
marLeftt-=100;
if( marLeftt < -maxXt ){ 
  marLeftt = -maxXt+100 ;
}
  slideContt.animate({"margin-left" : marLeftt + "px"}, 500);
}

function slideBackt() {
  marLeftt +=100;
  if ( marLeftt > 0 ) { marLeftt = 0 ;}
  slideContt.animate({"margin-left" : marLeftt + "px"}, 500);
}
rightButtont.click(slidet);
leftButtont.click(slideBackt);

/*touch code from here*/

$(containert).on("mousedown touchstart", function(e) {
  
  var startXt = e.pageX || e.originalEvent.touches[0].pageX;
  difft = 0;

  $(containert).on("mousemove touchmove", function(e) {
    
      var xtt = e.pageX || e.originalEvent.touches[0].pageX;
      difft = (xtt - startXt) * 100 / window.innerWidth;
    if( marLeftt == 0 && difft > 10 ) { 
      event.preventDefault() ;
    } else if (  marLeftt == -maxXt && difft < -10 ) {
       event.preventDefault();   
    }
  });
});

$(containert).on("mouseup touchend", function(e) {
  $(containert).off("mousemove touchmove");
  if(  marLeftt == 0 && difft > 4 ) { 
      sliderContt.animate({"margin-left" :  0 + "px"},100);
   } else if (  marLeftt == -maxXt  && difft < 4 ){
       sliderContt.animate({"margin-left" : -maxXt  + "px"},100);  
   } else {
      if (difft < -10) {
        slidet();
      } else if (difft > 10) {
        slideBackt();
      } 
  }
});

</script>
<!-- END STORIES -->

<script>
    function genericSocialShare(url){
        window.open(url,'sharer','toolbar=0,status=0,width=648,height=395');
        return true;
    }
    function copylinkshare(element) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).val()).select();
        document.execCommand("copy");
        $temp.remove();
        $('#snackbar').text('Link Copied to clipboard...').addClass('show');
        setTimeout(function(){ $('#snackbar').removeClass('show'); }, 4000);
    }
</script>