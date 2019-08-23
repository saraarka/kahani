<link rel="stylesheet" href="<?php echo base_url();?>assets/css/geners.css">
<script>
    $(document).ready(function(){ 
        $("#gener").addClass("active");
    });
</script>

<?php $readlatersids = get_storiesreadlater('readlater'); ?>
<div class="content-wrapper">
    <section class="content">
        <?php $pscount = 0; ?>
        <div class="main-container1 pd">
            <?php if(isset($genertopstories) && ($genertopstories->num_rows() > 0)){ 
                $pscount = $pscount+$genertopstories->num_rows(); ?>
    		    <div class="row pt-0">
    			    <div class="col-md-6 col-xs-8 pd-0">
    			    	<div class="titlei">TOP STORIES</div>
    			    </div>
    			    <div class="col-md-6 col-xs-4 pd-0">
    			        <?php if($genertopstories->num_rows() > 4){ ?>
    			    	<a href="<?php echo base_url().$this->uri->segment(1);?>/genre/<?php echo $this->uri->segment(3);?>/top">
    			    	    <div class="view pull-right">VIEW MORE</div>
    			    	</a>
    			    	<?php } ?>
    			    </div>
    		    </div><hr>
    		    <div id="StoryCont" class="StoryCont1" style="text-align:left;">
    				<div id="story-slider" class="story-slider series">
    			        <?php $i = 0; foreach($genertopstories->result() as $topstorysrow) { if($i < 4){ ?>
    			            <div class="card">
    				        	<div class="book-type"><?php echo $topstorysrow->gener;?></div>
    				        	<a href="<?php echo base_url($this->uri->segment(1).'/story/'.preg_replace('/\s+/', '-', $topstorysrow->title).'-'.$topstorysrow->sid);?>"  class="imagess-style">
        				        	<?php if(isset($topstorysrow->image) && !empty($topstorysrow->image)) { ?>
        				        	    <img src="<?php echo base_url();?>assets/images/<?php echo $topstorysrow->image; ?>" alt="<?php echo $topstorysrow->title;?>" class="imageme">
        				        	<?php }else{ ?>
        				        		<img src="<?php echo base_url();?>assets/images/series-stories.jpg" alt="<?php echo $topstorysrow->title;?>" class="imageme">
        				        	<?php } ?>
    				        	</a>
    				        	<div>
            						<font class="max-lines">
            							<a href="<?php echo base_url($this->uri->segment(1).'/story/'.preg_replace('/\s+/', '-', $topstorysrow->title).'-'.$topstorysrow->sid);?>" class="product-title"><?php echo $topstorysrow->title;?></a>
            						</font> 
            					</div>
    				        	<div class="flextest">
    				        		<font class="byname">By<font class="namehere">
    				        		    <a href="<?php echo base_url($this->uri->segment(1)."/".$topstorysrow->profile_name);?>" style="color: #000;">
    				        		        <?php echo $topstorysrow->name;?></a></font></font><br>
    				        	</div>
    				        	<div class="flextest" style="padding-top:4px;">
            						<font class = "episodes">
            							<font><?php $wordcount = explode(' ', $topstorysrow->story);
            							    $time = round(sizeof($wordcount)/50);	?>
            								<b><?php if($time == 0){ echo 1;}else{ echo $time;}?></b> Min Story &nbsp;</font>
            							<font>&nbsp;<i style="color: #3c8dbc" class="fa fa-eye" aria-hidden="true"></i><b> <?php echo $topstorysrow->views;?>&nbsp;</b></font>
            							<font>&nbsp;<i style="color: #3c8dbc" class="fa fa-star" aria-hidden="true"></i>
            								<b><?php if(isset($reviews21) && ($reviews21->num_rows()>0)) {
            									foreach($reviews21->result() as $reviews2) { 
            										if($reviews2->sid == $topstorysrow->sid) {
            											echo round($reviews2->rating);
            									} } } ?>
            								</b>
            							</font>
            						</font><br>
            					</div>
    				        	<div class="flextest" style="padding-top:6px">
    						        <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($topstorysrow->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
    							        <button class="read" onclick="yoursreadlater();"><i class="fa fa-bookmark"></i> Read later </button>
    							    <?php }else if(isset($this->session->userdata['logged_in']['user_id'])) { ?>
            							<?php if(isset($readlatersids) && (sizeof($readlatersids)>0) && in_array($topstorysrow->sid, $readlatersids)) { ?>
            								<button onclick="unreadlater(<?php echo $topstorysrow->sid;?>)" class="readdone notloginmodal readlaterbtnatr<?php echo $topstorysrow->sid;?>">
            								<i class="fa fa-check faicon<?php echo $topstorysrow->sid;?>"></i> Read later </button>
            							<?php }else { ?>
            								<button onclick="readlater(<?php echo $topstorysrow->sid;?>)" class="read notloginmodal readlaterbtnatr<?php echo $topstorysrow->sid;?>">
            								<i class="fa fa-bookmark faicon<?php echo $topstorysrow->sid;?>"></i> Read later </button>
            							<?php } ?>
            						<?php } else{ ?>
                                        <button class="read notloginmodal" data-toggle="modal" data-target="#loginmodal"><i class="fa fa-bookmark"></i> Read later </button>
                    				<?php } ?>
            						<button type="button" class="btn read dropdown-toggle pull-right" data-toggle="dropdown">
            							<span class=""><i class="fa fa-plus"></i></span>
            						</button>
            						<ul class="dropdown-menu list-inline dropvk">
            							<li onclick="groupsuggest(<?php echo $topstorysrow->sid; ?>);">
            								<a href="javascript:void(0);" data-toggle="modal" data-target="#groupsuggest" title="COMMUNITY"><i class="fa fa-users"></i></a>
            							</li>
            							<li onclick="friend(<?php echo $topstorysrow->sid;?>);">
            								<a href="javascript:void(0);" data-toggle="modal" data-target="#friendsuggest" title="SUGGEST"><i class="fa fa-user"></i></a>
            							</li>
            							<li onclick="socialshare(<?php echo $topstorysrow->sid;?>, 'story');">
            								<a data-toggle="modal" data-target="#soc" href="javascript:void(0);" title="SOCIAL">
            									<i class="fa fa-share-alt"></i>
            								</a>
            							</li>
            						</ul>
            					</div>
    				        </div>
    			        <?php } $i++; }?>
    			    </div>
    			</div>
			<?php } ?>
		</div><br>
		
		<div class="main-container1">
		    <?php if(isset($generstories) && ($generstories->num_rows() > 0)){ 
		        $pscount = $pscount+$generstories->num_rows(); ?>
    			<div class="row pt-0"> 
    			    <div class="col-md-6 col-xs-8 pd-0">
    			    	<div class="titlei">LATEST STORIES</div>
    			    </div>
    			</div><hr class="lin">
    			<div class="jc-m" id="loadmoreall" style="display:flex; flex-wrap:wrap;">
        			<?php foreach($generstories->result() as $storysrow) { ?>
            			<div class="cardls">
    			        	<div class="book-typels"><?php echo $storysrow->gener;?></div>
    		        		<a href="<?php echo base_url($this->uri->segment(1).'/story/'.preg_replace('/\s+/', '-', $storysrow->title).'-'.$storysrow->sid);?>" class="imagesls-style">
        		        		<?php if(isset($storysrow->image) && !empty($storysrow->image)) { ?>
        		                	<img src="<?php echo base_url();?>assets/images/<?php echo $storysrow->image; ?>" alt="<?php echo $storysrow->title;?>" class="imagemels">
        	                	<?php }else{ ?>
        	                		<img src="<?php echo base_url();?>assets/images/series-stories.jpg" alt="<?php echo $storysrow->title;?>" class="imagemels">
        	                	<?php } ?>
    	                	</a>
    		                <div>
    			            	<font class="max-linesls">
    			            		<a href="<?php echo base_url($this->uri->segment(1).'/story/'.preg_replace('/\s+/', '-', $storysrow->title).'-'.$storysrow->sid);?>" class="product-title"><?php echo $storysrow->title;?></a>
    			            	</font> 
    			            </div>
    			        	<div class="flextestls">
    			        		<font class="bynamels">By<font class="namehere">
    			        		    <a href="<?php echo base_url($this->uri->segment(1)."/".$storysrow->profile_name);?>" style="color: #000;"> <?php echo $storysrow->name;?></a></font></font><br>
    			        	</div>
    			        	<div class="flextestls" style="padding-top:4px;">
    			    	        <font class="episodesls">
    			    	        	<font>
    			    	        		<?php $wordcount = explode(' ', $storysrow->story);
    			    	        	    $time = round(sizeof($wordcount)/50);	?>
    			    	        		<b><?php if($time == 0){ echo 1;}else{ echo $time;}?></b> Min Story&nbsp;</font>
    			    	        	<font>&nbsp;<i style="color: #3c8dbc" class="fa fa-eye" aria-hidden="true"></i><b> <?php echo $storysrow->views;?>&nbsp;</b></font>
    			    	        	<font>&nbsp;<i style="color: #3c8dbc" class="fa fa-star" aria-hidden="true"></i>
    			    	        		<b>
    			    	        		<?php if(isset($reviews21) && ($reviews21->num_rows()>0)) {
    			    	        			foreach($reviews21->result() as $reviews2) { 
    			    	        				if($reviews2->sid == $storysrow->sid) {
    			    	        					echo round($reviews2->rating);
    			    	        				}
    			    	        		} } ?>
    			    	        		</b>
    			    	        	</font>
    			    	        </font><br>
    			            </div>
    			        	<div class="flextestls" style="padding-top:6px">
    			    	        <?php if(isset($this->session->userdata['logged_in']['user_id']) && ($storysrow->user_id == $this->session->userdata['logged_in']['user_id'])){ ?>
    			    		        <button class="read" onclick="yoursreadlater();"><i class="fa fa-bookmark"></i> Read later </button>
    			    		    <?php }else if(isset($this->session->userdata['logged_in']['user_id'])) { ?>
            			    		<?php if(isset($readlatersids) && (sizeof($readlatersids)>0) && in_array($storysrow->sid, $readlatersids)) { ?>
            			    			<button onclick="unreadlater(<?php echo $storysrow->sid;?>)" class="readdone notloginmodal readlaterbtnatr<?php echo $storysrow->sid;?>">
            			    			<i class="fa fa-check faicon<?php echo $storysrow->sid;?>"></i> Read later </button>
            			    		<?php }else { ?>
            			    			<button onclick="readlater(<?php echo $storysrow->sid;?>)" class="read notloginmodal readlaterbtnatr<?php echo $storysrow->sid;?>">
            			    			<i class="fa fa-bookmark faicon<?php echo $storysrow->sid;?>"></i> Read later </button>
            			    		<?php } ?>
                                <?php } else{ ?>
                                    <button class="read notloginmodal" data-toggle="modal" data-target="#loginmodal"><i class="fa fa-bookmark"></i> Read later </button>
                				<?php } ?>
        			    	    <button type="button" class="btn read dropdown-toggle pull-right" data-toggle="dropdown">
        			    		    <span class=""><i class="fa fa-plus"></i></span>
        			    	    </button>
        			    	    <ul class="dropdown-menu list-inline dropvk">
            			    		<li onclick="groupsuggest(<?php echo $storysrow->sid; ?>);">
            			    			<a href="javascript:void(0);" data-toggle="modal" data-target="#groupsuggest" title="COMMUNITY"><i class="fa fa-users"></i></a>
            			    		</li>
            			    		<li onclick="friend(<?php echo $storysrow->sid;?>);">
            			    			<a href="javascript:void(0);" data-toggle="modal" data-target="#friendsuggest" title="SUGGEST"><i class="fa fa-user"></i></a>
            			    		</li>
            			    		<li onclick="socialshare(<?php echo $storysrow->sid;?>, 'story');">
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
		</div><br>
		
		<?php if(isset($pscount) && ($pscount < 1)){ ?>
	        <center>
    	        <div style="margin:10.8% auto">
    	            <div style="width:150px;">
    	                <img src="<?php echo base_url();?>assets/images/nodata.svg" class="img-responsive" style="width:100%;" alt="No Data">
    	            </div>
    	            <div style="font-family: arial,sans-serif;margin-top:5px;">NO STORIES FOUND</div>
    	        </div>
	        </center>
		<?php } ?>
		
    </section>
</div>
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

<!-- Social Popup ---- -->
<div class="modal fade" id="soc">
	<div class="modal-dialog">
		<div class="modal-content socv ">
			<div class="modal-header" style="padding:8px 15px;">
				<button type="button" class="close" style="color:#000; opacity:initial; margin-top:0px;margin-bottom:-2px;" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h5 class="modal-title text-center" style="color:#808182;">SOCIAL MEDIA SHARE</h5>
			</div>
			<div class="" style="padding-top:5px;">
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

<script>
    $(document).ready(function(){
        var limit = 4;
        var start = 4;
        var action = 'inactive';
        function load_country_data(limit, start) {
            var generid = "<?php echo $this->uri->segment(3);?>";
            $.ajax({
                url:'<?php echo base_url().$this->uri->segment(1);?>/geners/'+generid,
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