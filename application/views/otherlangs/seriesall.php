<link rel="stylesheet" href="<?php echo base_url();?>assets/css/seriesall.css">
<script>
    $(document).ready(function(){ 
        $("#series").addClass("active");
    });
</script>

<?php $readlatersids = get_storiesreadlater('readlater'); ?>
<div class="content-wrapper">
    <section class="content">
        <div class="main-container1">
            <?php if(isset($top_get_series) && ($top_get_series->num_rows() > 0)){ ?>
            <div class="row pt-0">
			    <div class="col-md-6 col-xs-8 pd-0">
			    	<div class="titlei">TOP SERIES</div>
			    </div>
			    <?php if($top_get_series->num_rows() > 4){ ?>
			    <div class="col-md-6 col-xs-4 pd-0">
			    	<a href="<?php echo base_url().$this->uri->segment(1);?>/series/top">
			    	    <div class="view pull-right">VIEW MORE</div>
			    	</a>
			    </div>
			    <?php } ?>
		    </div><hr>
		    <div class="">
		        <div id="StoryCont" class="StoryCont1" style="text-align:left;">
				    <div id="story-slider" class="story-slider series">
    				    <?php $i=0; foreach($top_get_series->result() as $topseriesrow) { if($i<4){  ?>
    				    	<div class="card">
        						<div class="book-type"><?php echo $topseriesrow->gener;?></div>
        						<a href="<?php echo base_url($this->uri->segment(1).'/series/'.preg_replace("~[^\p{M}\w]+~u", '-', $topseriesrow->title).'-'.$topseriesrow->sid.'/'.preg_replace("~[^\p{M}\w]+~u", '-', $topseriesrow->title).'-'.$topseriesrow->story_id);?>" class="imagesls-style">
        						    <?php if(isset($topseriesrow->image) && !empty($topseriesrow->image)) { ?>
            						    <img src="<?php echo base_url();?>assets/images/<?php echo $topseriesrow->image; ?>" alt="<?php echo $topseriesrow->title;?>" class="imageme">
            						<?php }else{ ?>
            							<img src="<?php echo base_url();?>assets/images/series-stories.jpg" alt="<?php echo $topseriesrow->title;?>" class="imageme">
            						<?php } ?>
            					</a>
        						<div>
        							<font class="max-lines">
        								<a href="<?php echo base_url($this->uri->segment(1).'/series/'.preg_replace("~[^\p{M}\w]+~u", '-', $topseriesrow->title).'-'.$topseriesrow->sid.'/'.preg_replace("~[^\p{M}\w]+~u", '-', $topseriesrow->title).'-'.$topseriesrow->story_id);?>">
        									<?php echo $topseriesrow->title;?>
        								</a>
        							</font> 
        						</div>
        						<div class="flextest">
        							<font class="byname">By<font class="namehere">
        							    <a href="<?php echo base_url($this->uri->segment(1).'/'.$topseriesrow->profile_name);?>" style="color:#000"> <?php echo $topseriesrow->name;?></a></font></font><br>
        						</div>
        						<div class="flextest" style="padding-top:4px;">
        							<font class="episodes">
        								<?php $keycount = get_episodecount($topseriesrow->sid); 
        								if(isset($keycount)){ echo $keycount; }else{ echo 0; }?> EPISODES | 
        								<?php $subsmemcount = get_storysubscount($topseriesrow->sid); 
        								if(isset($subsmemcount)){echo $subsmemcount; }else{echo 0; } ?> MEMBERS
        							</font><br>
        						</div>
        						<div class="flextest" style="padding-top:6px">
        							<?php if(isset($this->session->userdata['logged_in']['user_id']) && ($topseriesrow->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
        								<button class="read" onclick="yoursreadlater();"><i class="fa fa-bookmark"></i> Read later </button>
        							<?php }else{ ?>
        								<?php if(isset($readlatersids) && (sizeof($readlatersids)>0) && in_array($topseriesrow->sid, $readlatersids)) { ?>
        									<button onclick="unreadlater(<?php echo $topseriesrow->sid;?>)" class="readdone notloginmodal readlaterbtnatr<?php echo $topseriesrow->sid;?>">
        									<i class="fa fa-check faicon<?php echo $topseriesrow->sid;?>"></i> Read later </button>
        								<?php }else { ?>
        									<button onclick="readlater(<?php echo $topseriesrow->sid;?>)" class="read notloginmodal readlaterbtnatr<?php echo $topseriesrow->sid;?>">
        									<i class="fa fa-bookmark faicon<?php echo $topseriesrow->sid;?>"></i> Read later </button>
        								<?php } ?>
        							<?php } ?>
        							<button type="button" class="btn read dropdown-toggle pull-right" data-toggle="dropdown">
        								<span class=""><i class="fa fa-plus"></i></span>
        							</button>
        							<ul class="dropdown-menu list-inline dropvk">
        								<li onclick="groupsuggest(<?php echo $topseriesrow->sid; ?>);">
        									<a href="javascript:void(0);" data-toggle="modal" data-target="#groupsuggest" title="COMMUNITY"><i class="fa fa-users"></i></a>
        								</li>
        								<li onclick="friend(<?php echo $topseriesrow->sid;?>);">
        									<a href="javascript:void(0);" data-toggle="modal" data-target="#friendsuggest" title="SUGGEST"><i class="fa fa-user"></i></a>
        								</li>
        								<li onclick="socialshare(<?php echo $topseriesrow->sid;?>, 'series');">
        									<a data-toggle="modal" data-target="#soc" href="javascript:void(0);" title="SOCIAL">
        										<i class="fa fa-share-alt"></i>
        									</a>
        								</li>
        							</ul>
        						</div>
        					</div>        
    				    <?php }$i++;} ?>
				    </div>
			    </div>
		    </div>
		    <?php } ?>
        </div><br>
        
        <div class="main-container1">
            <?php if(isset($get_series) && ($get_series->num_rows() > 0)){ ?>
		    <div class="row pt-0">
		        <div class="col-md-6 col-xs-6 pd-0">
			    	<div class="titlei hidden-xs">LATEST SERIES </div>
			    	<div class="titlei hidden-md hidden-lg hidden-sm">NEW SERIES </div>
			    </div>
			    <div class="col-md-6 col-xs-6 pd-0">
			    	<div class="pull-right">
			    	   <select class="pull-right form-control" onchange="generfilter(this.value)">
    			        <option value=""> -- Select Gener -- </option>
    			        <?php if(isset($gener) && ($gener->num_rows() > 0)){ foreach($gener->result() as $generrow){ ?>
    			            <option value="<?php echo $generrow->id;?>"><?php echo $generrow->gener;?></option>
    			        <?php } } ?>
    			    </select> 
			    	</div>
			    </div>
		    </div><hr>
    	    <div class="jc-m" id="loadmoreall" style="display:flex; flex-wrap:wrap;">
    		    <?php foreach($get_series->result() as $seriesrow) { ?>
    				<div class="cardls">
					    <div class="book-typels"><?php echo $seriesrow->gener;?></div>
					    	<a href="<?php echo base_url($this->uri->segment(1).'/series/'.preg_replace("~[^\p{M}\w]+~u", '-', $seriesrow->title).'-'.$seriesrow->sid.'/'.preg_replace("~[^\p{M}\w]+~u", '-', $seriesrow->title).'-'.$seriesrow->story_id);?>" class="imagesls-style">
    					    	<?php if(isset($seriesrow->image) && !empty($seriesrow->image)) { ?>
    					    	    <img src="<?php echo base_url();?>assets/images/<?php echo $seriesrow->image; ?>" alt="<?php echo $seriesrow->title;?>" class="imagemels">
    					    	<?php }else{ ?>
    					    		<img src="<?php echo base_url();?>assets/images/series-stories.jpg" alt="<?php echo $seriesrow->title;?>" class="imagemels">
    					    	<?php } ?>
					    	</a>
					    	<div>
					    		<font class="max-linesls">
					    			<a href="<?php echo base_url($this->uri->segment(1).'/series/'.preg_replace("~[^\p{M}\w]+~u", '-', $seriesrow->title).'-'.$seriesrow->sid.'/'.preg_replace("~[^\p{M}\w]+~u", '-', $seriesrow->title).'-'.$seriesrow->story_id);?>">
					    				<?php echo $seriesrow->title;?>
					    			</a>
					    		</font> 
					    	</div>
    						<div class="flextestls">
    							<font class="bynamels">By<font class="nameherels">
    							    <a href="<?php echo base_url($this->uri->segment(1).'/'.$seriesrow->profile_name);?>" style="color:#000"> <?php echo $seriesrow->name;?></a></font></font><br>
    						</div>
        				    <div class="flextestls" style="padding-top:4px;">
        					    <font class="episodesls">
        						    <?php $keycount = get_episodecount($seriesrow->sid); 
        							if(isset($keycount)){ echo $keycount; }else{ echo 0; }?> EPISODES | 
        							<?php $subsmemcount = get_storysubscount($seriesrow->sid); 
        							if(isset($subsmemcount)){echo $subsmemcount; }else{echo 0; } ?> MEMBERS
        						</font><br>
        					</div>
							<div class="flextestls" style="padding-top:6px">
							    <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($seriesrow->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
    				                <button class="read" onclick="yoursreadlater();"><i class="fa fa-bookmark"></i> Read later </button>
    						        <?php }else{ ?>
    					            	<?php if(isset($readlatersids) && (sizeof($readlatersids)>0) && in_array($seriesrow->sid, $readlatersids)) { ?>
    					            		<button onclick="unreadlater(<?php echo $seriesrow->sid;?>)" class="readdone notloginmodal readlaterbtnatr<?php echo $seriesrow->sid;?>">
    					            		<i class="fa fa-check faicon<?php echo $seriesrow->sid;?>"></i> Read later </button>
    					            	<?php }else { ?>
    					            		<button onclick="readlater(<?php echo $seriesrow->sid;?>)" class="read notloginmodal readlaterbtnatr<?php echo $seriesrow->sid;?>">
    					            		<i class="fa fa-bookmark faicon<?php echo $seriesrow->sid;?>"></i> Read later </button>
    					            	<?php } ?>
    					            <?php } ?>
							        <button type="button" class="btn read dropdown-toggle pull-right" data-toggle="dropdown">
										<span class=""><i class="fa fa-plus"></i></span>
									</button>
									<ul class="dropdown-menu list-inline dropvk">
										<li onclick="groupsuggest(<?php echo $seriesrow->sid; ?>);">
											<a href="javascript:void(0);" data-toggle="modal" data-target="#groupsuggest" title="COMMUNITY"><i class="fa fa-users"></i></a>
										</li>
										<li onclick="friend(<?php echo $seriesrow->sid;?>);">
											<a href="javascript:void(0);" data-toggle="modal" data-target="#friendsuggest" title="SUGGEST"><i class="fa fa-user"></i></a>
										</li>
										<li onclick="socialshare(<?php echo $seriesrow->sid;?>, 'series');">
											<a data-toggle="modal" data-target="#soc" href="javascript:void(0);" title="SOCIAL">
												<i class="fa fa-share-alt"></i>
											</a>
										</li>
									</ul>
							    </div>
						</div>
			    <?php } ?>
			    <input type="hidden" id="typeseries" value="series">
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
				<button type="button" class="close" style="color:#000; opacity:initial; margin-top:0px;margin-bottom:-2px;" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h5 class="modal-title text-center" style="color:#808182;">SOCIAL MEDIA SHARE</h5>
			</div>
			<div class="" style="padding-top:10px;">
				<div class="row">
					<div class="col-md-12 pd-5v" style="margin:12px;padding-bottom:5px;">
						<a href="javascript:void(0);" class="facebookshare socsh">
						    <img src="<?php echo base_url();?>assets/svg/fb.svg" style="width:40px; height:40px;margin-top:-10px;"/><p class="socialsharepopupspan">Facebook</p></a>
					</div>
					<div class="col-md-12 pd-5v" style="margin:12px;padding-bottom:5px;">
					    <a href="javascript:void(0);" class="whatsappshare socsh">
						    <img src="<?php echo base_url();?>assets/svg/wa.svg" style="width:40px; height:40px;margin-top:-10px;"/><p class="socialsharepopupspan">Whatsapp</p></a>
					</div>
					<div class="col-md-12 pd-5v" style="margin:12px;padding-bottom:5px;">
						<a href="javascript:void(0);" class="twittershare socsh">
						    <img src="<?php echo base_url();?>assets/svg/twitter.svg" style="width:40px; height:40px;margin-top:-10px;"/> <p class="socialsharepopupspan">Twitter</p></a>
					</div>
					<div class="col-md-12 pd-5v" style="margin:12px;">
						<a href="javascript:void(0);" onclick="copylinkshare('#copylinkshare')" class="socsh">
						    <img src="<?php echo base_url();?>assets/svg/link.svg" style="width:40px;height:40px;margin-top:-10px;"/> <p class="socialsharepopupspan">Copy to link</p></a>
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
	function generfilter(generid){
		if((generid == 0) || (generid == '') || (generid == 'undefined') || (generid == ' ') || (generid == 'null')){
			location.href = "<?php echo $_SERVER['REQUEST_URI']; ?>";
		}else{
			$.ajax({
				type:'POST',
				url:'<?php echo base_url().$this->uri->segment(1);?>/geners',
				data:{'generid' : generid},
				success:function(resultdata){
					$('#loadmoreall').html(resultdata);
				}
			});
		}
	}
</script>
<script>
    $(document).ready(function(){
        var limit = 7;
        var start = 7;
        var action = 'inactive';
        function load_country_data(limit, start) {
            var typeseries = $('#typeseries').val();
            if(typeseries == 'series'){
                $.ajax({
                    url:'<?php echo base_url().$this->uri->segment(1);?>/viewallloadmore/series',
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
</script>

<script>
    var rightButton = $("#right-btn");
    var leftButton = $("#left-btn");
    var container = $("#StoryCont");
    var slideCont = $("#story-slider");
    if($("#story-slider > div").length<5){
      $('#right-btn').hide();
      $('#left-btn').hide();
    }
    var maxcount=$("#story-slider > div").length;
    var marLeft = 0, maxX = maxcount*214, diff = 0 ;
    
    function slide() {
    marLeft-=224;
    if( marLeft < -maxX ){ 
      marLeft = -maxX+183 ;
    }
      slideCont.animate({"margin-left" : marLeft + "px"}, 400);
    }
    
    function slideBack() {
      marLeft +=224;
      if ( marLeft > 0 ) { marLeft = 0 ;}
      slideCont.animate({"margin-left" : marLeft + "px"}, 400);
    }
    rightButton.click(slide);
    leftButton.click(slideBack);
    
    /*touch code from here*/
    
    $(container).on("mousedown touchstart", function(e) {
      
      var startX = e.pageX || e.originalEvent.touches[0].pageX;
      diff = 0;
    
      $(container).on("mousemove touchmove", function(e) {
        
          var xt = e.pageX || e.originalEvent.touches[0].pageX;
          diff = (xt - startX) * 100 / window.innerWidth;
        if( marLeft == 0 && diff > 10 ) { 
          event.preventDefault() ;
        } else if (  marLeft == -maxX && diff < -10 ) {
           event.preventDefault();   
        }
      });
    });
    
    $(container).on("mouseup touchend", function(e) {
      $(container).off("mousemove touchmove");
      if(  marLeft == 0 && diff > 4 ) { 
          sliderCont.animate({"margin-left" :  0 + "px"},100);
       } else if (  marLeft == -maxX  && diff < 4 ){
           sliderCont.animate({"margin-left" : -maxX  + "px"},100);  
       } else {
          if (diff < -10) {
            slide();
          } else if (diff > 10) {
            slideBack();
          } 
      }
    });

</script>
<!-- END STORIES -->

<script type="text/javascript">
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
    setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);		
}
</script>